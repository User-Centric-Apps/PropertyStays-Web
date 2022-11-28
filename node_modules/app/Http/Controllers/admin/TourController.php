<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use Session;
use Auth;
use DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use App\Models\Country;
use App\Models\Property;
use App\Models\PropertiesImages;
use App\Models\User;
use App\Traits\UploadTrait;
use App\Models\PropertiesBookingEnquiry;
use App\Models\Feedback;

class TourController extends Controller
{
    use UploadTrait;
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function view(Request $request)
    {
        if(request()->ajax())
        {
            $data = Property::select('properties.*', 'countries.cname', 'cities.cityname', 'users.name')
            ->leftJoin('countries', 'countries.id', '=', 'properties.country_id')
            ->leftJoin('cities', 'cities.id', '=', 'properties.city_id')
            ->leftJoin('users', 'users.id', '=', 'properties.user_id')
            ->where('countries.status', '=', 1)
            ->where('properties.type', '=', 2);

            return Datatables::of($data)
                ->addColumn('action', function ($data) 
                {

                    $abc = '';

                    $abc .= '<a href="'.url('admin/tours/manage/'.$data->id).'" class="btn green btn-xs" title="Edit"><i class="fa fa-edit"></i> </a>';

                    if(Auth::guard('admin')->user()->type == 1)
                    {
                      $abc .= '<button id="'.$data->id.'" class="delete btn red btn-xs" title="Delete"  ><i class="fa fa-times"></i> </button>';
                    }

                    return '<div class="btn-group pull-right">'.$abc.'</div>';
              
                })
                ->editColumn('created_at', function ($request) {
                    return [
                      'display' => e($request->created_at->format('d-m-Y')),
                      'timestamp' => $request->created_at->timestamp
                    ];
                })
                ->filterColumn('created_at', function ($query, $keyword) {
                    $query->whereRaw("DATE_FORMAT(created_at,'%d-%m-%Y') LIKE ?", ["%$keyword%"]);
                })
                ->editColumn('status', '@if($status == 1) <span class="label label-success">{{ "Active"}} </span>  @else <span class="label label-danger">{{"Inactive"}}</span> @endif')
                ->editColumn('featured', '@if($featured == 1) <span class="label label-success">{{ "Featured" }} </span>  @else @endif')
                ->rawColumns(['action', 'status', 'featured'])
                ->make(true);
        }
        return view('admin.tours.view');
    }

    public function manageTour($id = null)
    {
        $item = array();
        $item = Property::select('properties.*', 'cities.cityname')
            ->leftJoin('cities', 'cities.id', '=', 'properties.city_id')->where('properties.id', '=', $id)->first();

        $countries = array();
        $countries = Country::pluck('cname', 'id');
        $hosts = User::where('type', '=', 1)->pluck('name', 'id');

        $recordImage = array();

        if($item)
        {
            $recordImage = PropertiesImages::where('property_id', '=', $id)->get();
        }
        

        return view('admin.tours.manage', ['item' => $item, 'countries' => $countries, 'recordImage' => $recordImage, 'hosts' => $hosts]);
    }


    public function doSaveTour(Request $request)
    {
        if(Auth::guard('admin')->user()->type != 1)
        {
          return redirect()->back()->with('danger', 'You dont have rights to perform this action.');
        }

        $post = $request->all();
        $valid_extension = array("jpg","jpeg","png");
        $maxFileSize = 2097152; 
        
        $item = new Property;

        if($post['id'])
        {
            $id = intval($post['id']);
            $item = $item->find($id);
            if($item->count() > 0)
            {
                $item->user_id = $post['user_id'];
                $item->title = $post['title'];
                $item->description = $post['description'];
                $item->tour_included = $post['tour_included'];
                $item->tour_excluded = $post['tour_excluded'];
                $item->tour_highlight = $post['tour_highlight'];
                $item->adults = $post['adults'];
                $item->children = $post['children'];
                $item->infant = $post['infant'];
                $item->tour_type = $post['tour_type'];
                $item->featured = ($request->get('featured') == 1) ? 1 : 0;
                $item->latitude = $post['latitude'];
                $item->longitude = $post['longitude'];
                $item->area = $post['area'];
                $item->city_id = $post['city_id'];
                $item->country_id = $post['country_id'];
                $item->video = $post['video'];
                $item->tour_duration = $post['tour_duration'];
                $item->sqft = $post['sqft'];
                $item->ready_to_pay = ($request->get('ready_to_pay') == 1) ? 1 : 0;
                $item->cancellation = ($request->get('cancellation') == 1) ? 1 : 0;
                $item->status = $post['status'];
                $item->type = 2;
                $item->slug = Str::slug($post['title'], '-');
                
                if($request->has('image')) 
                {
                    $image = $request->file('image');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        if($fileSize <= $maxFileSize)
                        {
                            if($item->count()>0)
                            {
                                $this->UnlinkImage("tours/", $item->image);
                            }
                            $name = Str::slug($request->get('title')).'_'.time().rand(1,20);
                            $folder = '/uploads/tours/';
                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                            $this->uploadOne($image, $folder, 'public', $name);
                            $item->image = $filePath;
                        }
                        else
                        {
                            return redirect()->back()->with('danger', 'Size exceeded!');
                        }

                    }
                    else
                    {
                        return redirect()->back()->with('danger', 'Unknown Extention!');
                    }
                }
                
                $item->save();

                if($request->has('group-a'))
                {
                    $gallery = $post['group-a'];

                    if(count($gallery) > 0)
                    {

                        $img_id_not = array();
                        foreach ($gallery as $parent)
                        {
                            $recordImage = PropertiesImages::where('property_id', '=', $item->id)
                            ->where('id', '=', $parent['img_id'])
                            ->first();
                            if($recordImage)
                            {
                                $img_ID = intval($recordImage->id);

                                $itemUpdate = new PropertiesImages;
                                $itemUpdate = $itemUpdate->find($img_ID);

                                if(isset($parent['image'])) 
                                {
                                    // Get image file
                                    $image = $parent['image'];
                                    $fileSize = $image->getSize();
                                    $extension = $image->getClientOriginalExtension();

                                    if(in_array(strtolower($extension),$valid_extension))
                                    {
                                        // Check file size
                                        if($fileSize <= $maxFileSize)
                                        {
                                            //Path Delete
                                            if($itemUpdate->count()>0)
                                            {
                                                $this->UnlinkImage("tours/", $itemUpdate->image);
                                            }
                                            //Path Delete
                                            // Make a image name based on user name and current timestamp
                                            $name = Str::slug($post['title'])."_".time().rand(1,20);
                                            // Define folder path
                                            $folder = '/uploads/tours/';
                                            // Make a file path where image will be stored [ folder path + file name + file extension]
                                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                                            // Upload image
                                            $this->uploadOne($image, $folder, 'public', $name);
                                            // Set user profile image path in database to filePath
                                            $itemUpdate->image = $filePath;

                                        }
                                    }
                                $itemUpdate->save();
                                }
                                array_push($img_id_not, $itemUpdate->id);
                            }
                            else
                            {
                                $itemAdd = new PropertiesImages;
                                $itemAdd->property_id = $item->id;
                                if($parent['image']) 
                                {
                                    // Get image file
                                    $image = $parent['image'];
                                    $fileSize = $image->getSize();
                                    $extension = $image->getClientOriginalExtension();

                                    if(in_array(strtolower($extension),$valid_extension))
                                    {
                                        // Check file size
                                        if($fileSize <= $maxFileSize)
                                        {
                                            // Make a image name based on user name and current timestamp
                                            $name = Str::slug($post['title'])."_".time().rand(1,20);
                                            // Define folder path
                                            $folder = '/uploads/tours/';
                                            // Make a file path where image will be stored [ folder path + file name + file extension]
                                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                                            // Upload image
                                            $this->uploadOne($image, $folder, 'public', $name);
                                            // Set user profile image path in database to filePath
                                            $itemAdd->image = $filePath;

                                        }
                                    }
                                }
                                $itemAdd->save();
                                array_push($img_id_not, $itemAdd->id);
                            }
                        }
                        PropertiesImages::where('property_id', '=', $item->id)->whereNotIn('id',$img_id_not)->delete();
                    }

                }

                return redirect('admin/tours')->with('success', 'Successfully Updated');
            }
        }
        else
        {
            //Adding for New User

            $rules = array(
            'title' => 'required|string|max:255|unique:properties',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            );

            $validation =  Validator::make($request->all(), $rules);
                
            if($validation->fails())
            {
                return redirect()->back()->withInput($request->all())->withErrors($validation);
            } 
            else 
            {
                $item = new Property;
                $item->user_id = $post['user_id'];
                $item->title = $post['title'];
                $item->description = $post['description'];
                $item->tour_included = $post['tour_included'];
                $item->tour_excluded = $post['tour_excluded'];
                $item->tour_highlight = $post['tour_highlight'];
                $item->adults = $post['adults'];
                $item->children = $post['children'];
                $item->infant = $post['infant'];
                $item->tour_type = $post['tour_type'];
                $item->sqft = $post['sqft'];
                $item->featured = ($request->get('featured') == 1) ? 1 : 0;
                $item->latitude = $post['latitude'];
                $item->longitude = $post['longitude'];
                $item->area = $post['area'];
                $item->city_id = $post['city_id'];
                $item->country_id = $post['country_id'];
                $item->video = $post['video'];
                $item->tour_duration = $post['tour_duration'];
                $item->ready_to_pay = ($request->get('ready_to_pay') == 1) ? 1 : 0;
                $item->cancellation = ($request->get('cancellation') == 1) ? 1 : 0;
                $item->status = $post['status'];
                $item->type = 2;
                $item->slug = Str::slug($post['title'], '-');
                
                if($request->has('image')) 
                {
                    $image = $request->file('image');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        if($fileSize <= $maxFileSize)
                        {
                            if($item->count()>0)
                            {
                                $this->UnlinkImage("tours/", $item->image);
                            }
                            $name = Str::slug($request->get('title')).'_'.time();
                            $folder = '/uploads/tours/';
                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                            $this->uploadOne($image, $folder, 'public', $name);
                            $item->image = $filePath;
                        }
                        else
                        {
                            return redirect()->back()->with('danger', 'Size exceeded!');
                        }

                    }
                    else
                    {
                        return redirect()->back()->with('danger', 'Unknown Extention!');
                    }
                }
                
                $item->save();

                    if($request->has('group-a'))
                    {
                        $gallery = $post['group-a'];
                        $img_id_not = array();
                        if(count($gallery) > 1)
                        {

                            foreach ($gallery as $parent)
                            {
                                $recordImage = PropertiesImages::where('property_id', '=', $item->id)
                                ->where('id', '=', $parent['img_id'])
                                ->first();
                                if($recordImage)
                                {
                                    $img_ID = intval($recordImage->id);

                                    $itemUpdate = new PropertiesImages;
                                    $itemUpdate = $itemUpdate->find($img_ID);

                                    if(isset($parent['image'])) 
                                    {
                                        // Get image file
                                        $image = $parent['image'];
                                        $fileSize = $image->getSize();
                                        $extension = $image->getClientOriginalExtension();

                                        if(in_array(strtolower($extension),$valid_extension))
                                        {
                                            // Check file size
                                            if($fileSize <= $maxFileSize)
                                            {
                                                //Path Delete
                                                if($itemUpdate->count()>0)
                                                {
                                                    $this->UnlinkImage("tours/", $itemUpdate->image);
                                                }
                                                //Path Delete
                                                // Make a image name based on user name and current timestamp
                                                $name = Str::slug($post['title'])."_".time().rand(1,20);
                                                // Define folder path
                                                $folder = '/uploads/tours/';
                                                // Make a file path where image will be stored [ folder path + file name + file extension]
                                                $filePath = $name. '.' . $image->getClientOriginalExtension();
                                                // Upload image
                                                $this->uploadOne($image, $folder, 'public', $name);
                                                // Set user profile image path in database to filePath
                                                $itemUpdate->image = $filePath;

                                            }
                                        }
                                    $itemUpdate->save();
                                    }
                                    array_push($img_id_not, $itemUpdate->id);
                                }
                                else
                                {
                                    $itemAdd = new PropertiesImages;
                                    $itemAdd->property_id = $item->id;
                                    if($parent['image']) 
                                    {
                                        // Get image file
                                        $image = $parent['image'];
                                        $fileSize = $image->getSize();
                                        $extension = $image->getClientOriginalExtension();

                                        if(in_array(strtolower($extension),$valid_extension))
                                        {
                                            // Check file size
                                            if($fileSize <= $maxFileSize)
                                            {
                                                // Make a image name based on user name and current timestamp
                                                $name = Str::slug($post['title'])."_".time().rand(1,20);
                                                // Define folder path
                                                $folder = '/uploads/tours/';
                                                // Make a file path where image will be stored [ folder path + file name + file extension]
                                                $filePath = $name. '.' . $image->getClientOriginalExtension();
                                                // Upload image
                                                $this->uploadOne($image, $folder, 'public', $name);
                                                // Set user profile image path in database to filePath
                                                $itemAdd->image = $filePath;

                                            }
                                        }
                                    }
                                    $itemAdd->save();
                                    array_push($img_id_not, $itemAdd->id);
                                }
                            }
                        PropertiesImages::where('property_id', '=', $item->id)->whereNotIn('id',$img_id_not)->delete();
                        }
                    }

                return redirect('admin/tours')->with('success', 'Successfully Updated');
            }
        }
    }

    public function destroyTour($id)
    {
        if(Auth::guard('admin')->user()->type == 1)
        {
            $data = Property::findOrFail($id);
            $this->UnlinkImage("tours/", $data->image);
            $data->delete();
            PropertiesImages::where('property_id','=', $id)->delete();
        }
        
    }

    public function toursEnquiry(Request $request)
    {
        if(request()->ajax())
        {
            $data = PropertiesBookingEnquiry::select('properties_booking_enquiry.*', 'properties.title')
            ->leftJoin('properties', 'properties.id', '=', 'properties_booking_enquiry.property_id')
            ->where('properties_booking_enquiry.enquiry_type', '=', 'Tours');

            return Datatables::of($data)
            ->addColumn('action', function ($data)
            {

                  $abc = '<a href="#" class="btn btn-xs red"><i class="fa fa-times"></i> </a>';

                return '<div class="text-center">'.$abc.'</div>';
            })
            ->editColumn('created_at', function ($request) {
                return [
                  'display' => e($request->created_at->format('d-m-Y')),
                  'timestamp' => $request->created_at->timestamp
                ];
            })
            ->filterColumn('created_at', function ($query, $keyword) {
               $query->whereRaw("DATE_FORMAT(created_at,'%d-%m-%Y') LIKE ?", ["%$keyword%"]);
            })
            ->rawColumns(['action'])
            ->make(true);

        }
        return view('admin.enquiries.tours');
    }

    public function toursFeedback(Request $request)
    {
        if(request()->ajax())
        {
            $data = Feedback::select('feedback.*', 'properties.title', 'users.name')
            ->leftJoin('properties', 'properties.id', '=', 'feedback.property_id')
            ->leftJoin('users', 'users.id', '=', 'feedback.user_id')
            ->where('feedback.type', '=', 'Tour');

            return Datatables::of($data)
            ->addColumn('action', function ($data)
            {

                  $abc = '<button id="'.$data->id.'" class="delete btn red btn-xs" title="Delete"  ><i class="fa fa-times"></i> </button>';

                return '<div class="text-center">'.$abc.'</div>';
            })
            ->editColumn('created_at', function ($request) {
                return [
                  'display' => e($request->created_at->format('d-m-Y')),
                  'timestamp' => $request->created_at->timestamp
                ];
            })
            ->filterColumn('created_at', function ($query, $keyword) {
               $query->whereRaw("DATE_FORMAT(created_at,'%d-%m-%Y') LIKE ?", ["%$keyword%"]);
            })
            ->rawColumns(['action'])
            ->make(true);

        }
        return view('admin.tours.feedback');
    }

    public function destroyTourFeedback($id)
    {
        if(Auth::guard('admin')->user()->type == 1)
        {
            $data = Feedback::where('type', '=', 'Tour')->findOrFail($id);
            $data->delete();
        }
        
    }
}
