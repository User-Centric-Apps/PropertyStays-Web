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
use App\Models\Property;
use App\Models\Country;
use App\Models\Amenity;
use App\Models\RentTypes;
use App\Models\Suitable;
use App\Models\PropertiesAmenities;
use App\Models\PropertiesRenttypes;
use App\Models\PropertiesSuitable;
use App\Models\PropertiesImages;
use App\Models\User;
use App\Traits\UploadTrait;
use App\Models\PropertiesBookingEnquiry;
use App\Models\Feedback;

class PropertyController extends Controller
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
            ->where('properties.type', '=', 1);

            return Datatables::of($data)
                ->addColumn('action', function ($data) 
                {

                    $abc = '';

                    $abc .= '<a href="'.url('admin/properties/manage/'.$data->id).'" class="btn green btn-xs" title="Edit"><i class="fa fa-edit"></i> </a>';

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
        return view('admin.properties.view');
    }

    public function manageProperty($id = null)
    {
        $item = array();
        $item = Property::select('properties.*', 'cities.cityname')
            ->leftJoin('cities', 'cities.id', '=', 'properties.city_id')->where('properties.id', '=', $id)->first();

        $countries = array();
        $countries = Country::pluck('cname', 'id');

        $amenities = Amenity::where('status', '=', 1)->get();
        $renttypes = RentTypes::where('status', '=', 1)->get();
        $suitables = Suitable::where('status', '=', 1)->get();
        
        $hosts = User::orderBy('name', 'asc')->where(function($query) {
                    $query->where('type', '=', 1)
                        ->orWhere('type', '=', 3);
                    })->pluck('name', 'id');

        $property_amenities = array();
        $property_renttypes = array();
        $property_suitables = array();
        $recordImage = array();

        if($item)
        {
            $property_amenities = PropertiesAmenities::where('property_id', '=', $id)
            ->pluck('amenity_id', 'id')->toArray();

            $property_renttypes = PropertiesRenttypes::where('property_id', '=', $id)
            ->pluck('renttype_id', 'id')->toArray();

            $property_suitables = PropertiesSuitable::where('property_id', '=', $id)
            ->pluck('suitbale_id', 'id')->toArray();

            $recordImage = PropertiesImages::where('property_id', '=', $id)->get();
        }
        

        return view('admin.properties.manage', ['item' => $item, 'countries' => $countries, 'amenities' => $amenities, 'renttypes' => $renttypes, 'suitables' => $suitables, 'property_amenities' => $property_amenities, 'property_renttypes' => $property_renttypes, 'property_suitables' => $property_suitables, 'recordImage' => $recordImage, 'hosts' => $hosts]);
    }


    public function doSaveProperty(Request $request)
    {
        if(Auth::guard('admin')->user()->type != 1)
        {
          return redirect()->back()->with('danger', 'You dont have rights to perform this action.');
        }

        $feat = 'no';
        $msg = '';

        /*if($request->get('featured') == 1)
        {
            $countFeatruedProperty = Property::where('featured', '=', 1)->count();
            if($countFeatruedProperty >= 8)
            {
                $msg = 'Updated successfully, but you cannot make the property featured because already 8 Properties are set as featured.';
                $feat = 'yes';
            }
        }*/

        $post = $request->all();
        $valid_extension = array("jpg","jpeg","png");
        $maxFileSize = 12097152; 
        
        $item = new Property;

        if($post['id'])
        {
            $id = intval($post['id']);
            $item = $item->find($id);
            if($item->count() > 0)
            {
                $item->title = $post['title'];
                $item->user_id = $post['user_id'];
                $item->description = $post['description'];
                $item->original_price = $post['original_price'];
                $item->discount_price = $post['discount_price'];
                $item->sqft = $post['sqft'];
                $item->bed = $post['bed'];
                $item->bath = $post['bath'];
                $item->adults = $post['adults'];
                $item->children = $post['children'];
                $item->featured = ($request->get('featured') == 1) ? 1 : 0;
                $item->latitude = $post['latitude'];
                $item->longitude = $post['longitude'];
                $item->area = $post['area'];
                $item->city_id = $post['city_id'];
                $item->country_id = $post['country_id'];
                $item->video = $post['video'];
                $item->maximum_days = $post['maximum_days'];
                $item->ready_to_pay = ($request->get('ready_to_pay') == 1) ? 1 : 0;
                $item->cancellation = ($request->get('cancellation') == 1) ? 1 : 0;
                $item->status = $post['status'];
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
                                $this->UnlinkImage("properties/", $item->image);
                            }
                            $name = str_slug($request->get('title')).'_'.time();
                            $folder = '/uploads/properties/';
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
                    if(count($gallery) > 1)
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
                                                $this->UnlinkImage("properties/", $itemUpdate->image);
                                            }
                                            //Path Delete
                                            // Make a image name based on user name and current timestamp
                                            $name = $post['title']."_".time().rand(1,20);
                                            // Define folder path
                                            $folder = '/uploads/properties/';
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
                                            $name = $post['title']."_".time().rand(1,20);
                                            // Define folder path
                                            $folder = '/uploads/properties/';
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

                if($request->has('property_amenities'))
                {
                    $amenities = array_filter($request->get('property_amenities'));
                    if(!empty($amenities)){
                        $amenities_ids = array();
                        foreach($amenities as $amenity){
                            if($amenity)
                            {
                                $regarr = array('amenity_id' => $amenity, 'property_id' => $item->id);
                                $PropertiesAmenities = PropertiesAmenities::firstOrNew($regarr);
                                $PropertiesAmenities->amenity_id = $amenity;
                                $PropertiesAmenities->property_id = $item->id;
                                $PropertiesAmenities->save();
                                array_push($amenities_ids, $PropertiesAmenities->id);
                            }
                            PropertiesAmenities::whereNotIn('id', $amenities_ids)->where('property_id', '=', $item->id)->delete();
                        }
                    } 
                    else
                    {
                        PropertiesAmenities::where('property_id', '=', $item->id)->delete();
                    }
                } 
                else
                {
                    PropertiesAmenities::where('property_id', '=', $item->id)->delete();
                }

                if($request->has('property_renttypes'))
                {
                    $property_renttypes = array_filter($request->get('property_renttypes'));
                    if(!empty($property_renttypes)){
                        $property_renttypes_ids = array();
                        foreach($property_renttypes as $renttype){
                            if($renttype)
                            {
                                $regarr = array('renttype_id' => $renttype, 'property_id' => $item->id);
                                $PropertiesRenttypes = PropertiesRenttypes::firstOrNew($regarr);
                                $PropertiesRenttypes->renttype_id = $renttype;
                                $PropertiesRenttypes->property_id = $item->id;
                                $PropertiesRenttypes->save();
                                array_push($property_renttypes_ids, $PropertiesRenttypes->id);
                            }
                            PropertiesRenttypes::whereNotIn('id', $property_renttypes_ids)
                                ->where('property_id', '=', $item->id)->delete();
                        }
                    }
                    else
                    {
                        PropertiesRenttypes::where('property_id', '=', $item->id)->delete();
                    }
                } 
                else
                {
                    PropertiesRenttypes::where('property_id', '=', $item->id)->delete();
                }

                if($request->has('property_suitables'))
                {
                    $property_suitables = array_filter($request->get('property_suitables'));
                    if(!empty($property_suitables)){
                        $property_suitables_ids = array();
                        foreach($property_suitables as $suitbale){
                            if($suitbale)
                            {
                                $regarr = array('suitbale_id' => $suitbale, 'property_id' => $item->id);
                                $PropertiesSuitable = PropertiesSuitable::firstOrNew($regarr);
                                $PropertiesSuitable->suitbale_id = $suitbale;
                                $PropertiesSuitable->property_id = $item->id;
                                $PropertiesSuitable->save();
                                array_push($property_suitables_ids, $PropertiesSuitable->id);
                            }
                            PropertiesSuitable::whereNotIn('id', $property_suitables_ids)
                                ->where('property_id', '=', $item->id)->delete();
                        }
                    }
                    else
                    {
                        PropertiesSuitable::where('property_id', '=', $item->id)->delete();
                    }
                }
                else
                {
                    PropertiesSuitable::where('property_id', '=', $item->id)->delete();
                }

                if($feat == 'yes')
                {
                    return redirect('admin/properties')->with('success', $msg);
                }
                else
                {
                    return redirect('admin/properties')->with('success', 'Successfully Updated');
                }

                
            }
        }
        else
        {
            //Adding for New User

            $rules = array(
            'title' => 'required|string|max:255|unique:properties',
            'original_price' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096'
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
                $item->original_price = $post['original_price'];
                $item->discount_price = $post['discount_price'];
                $item->sqft = $post['sqft'];
                $item->bed = $post['bed'];
                $item->bath = $post['bath'];
                $item->adults = $post['adults'];
                $item->children = $post['children'];
                $item->featured = ($request->get('featured') == 1) ? 1 : 0;
                $item->latitude = $post['latitude'];
                $item->longitude = $post['longitude'];
                $item->area = $post['area'];
                $item->city_id = $post['city_id'];
                $item->country_id = $post['country_id'];
                $item->video = $post['video'];
                $item->ready_to_pay = ($request->get('ready_to_pay') == 1) ? 1 : 0;
                $item->maximum_days = $post['maximum_days'];
                $item->cancellation = ($request->get('cancellation') == 1) ? 1 : 0;
                $item->status = $post['status'];
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
                                $this->UnlinkImage("properties/", $item->image);
                            }
                            $name = Str::slug($request->get('title')).'_'.time();
                            $folder = '/uploads/properties/';
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
                    if(count($gallery) > 1)
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
                                                $this->UnlinkImage("properties/", $itemUpdate->image);
                                            }
                                            //Path Delete
                                            // Make a image name based on user name and current timestamp
                                            $name = $post['title']."_".time().rand(1,20);
                                            // Define folder path
                                            $folder = '/uploads/properties/';
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
                                            $name = $post['title']."_".time().rand(1,20);
                                            // Define folder path
                                            $folder = '/uploads/properties/';
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

                if($request->has('property_amenities'))
                {
                    $amenities = array_filter($request->get('property_amenities'));
                    if(!empty($amenities)){
                        $amenities_ids = array();
                        foreach($amenities as $amenity){
                            if($amenity)
                            {
                                $regarr = array('amenity_id' => $amenity, 'property_id' => $item->id);
                                $PropertiesAmenities = PropertiesAmenities::firstOrNew($regarr);
                                $PropertiesAmenities->amenity_id = $amenity;
                                $PropertiesAmenities->property_id = $item->id;
                                $PropertiesAmenities->save();
                                array_push($amenities_ids, $PropertiesAmenities->id);
                            }
                            PropertiesAmenities::whereNotIn('id', $amenities_ids)->where('property_id', '=', $item->id)->delete();
                        }
                    } 
                    else
                    {
                        PropertiesAmenities::where('property_id', '=', $item->id)->delete();
                    }
                } 
                else
                {
                    PropertiesAmenities::where('property_id', '=', $item->id)->delete();
                }

                if($request->has('property_renttypes'))
                {
                    $property_renttypes = array_filter($request->get('property_renttypes'));
                    if(!empty($property_renttypes)){
                        $property_renttypes_ids = array();
                        foreach($property_renttypes as $renttype){
                            if($renttype)
                            {
                                $regarr = array('renttype_id' => $renttype, 'property_id' => $item->id);
                                $PropertiesRenttypes = PropertiesRenttypes::firstOrNew($regarr);
                                $PropertiesRenttypes->renttype_id = $renttype;
                                $PropertiesRenttypes->property_id = $item->id;
                                $PropertiesRenttypes->save();
                                array_push($property_renttypes_ids, $PropertiesRenttypes->id);
                            }
                            PropertiesRenttypes::whereNotIn('id', $property_renttypes_ids)
                                ->where('property_id', '=', $item->id)->delete();
                        }
                    }
                    else
                    {
                        PropertiesRenttypes::where('property_id', '=', $item->id)->delete();
                    }
                } 
                else
                {
                    PropertiesRenttypes::where('property_id', '=', $item->id)->delete();
                }

                if($request->has('property_suitables'))
                {
                    $property_suitables = array_filter($request->get('property_suitables'));
                    if(!empty($property_suitables)){
                        $property_suitables_ids = array();
                        foreach($property_suitables as $suitbale){
                            if($suitbale)
                            {
                                $regarr = array('suitbale_id' => $suitbale, 'property_id' => $item->id);
                                $PropertiesSuitable = PropertiesSuitable::firstOrNew($regarr);
                                $PropertiesSuitable->suitbale_id = $suitbale;
                                $PropertiesSuitable->property_id = $item->id;
                                $PropertiesSuitable->save();
                                array_push($property_suitables_ids, $PropertiesSuitable->id);
                            }
                            PropertiesSuitable::whereNotIn('id', $property_suitables_ids)
                                ->where('property_id', '=', $item->id)->delete();
                        }
                    }
                    else
                    {
                        PropertiesSuitable::where('property_id', '=', $item->id)->delete();
                    }
                } 
                else
                {
                    PropertiesSuitable::where('property_id', '=', $item->id)->delete();
                }

                if($feat = 'yes')
                {
                    return redirect('admin/properties')->with('success', $msg);
                }
                else
                {
                    return redirect('admin/properties')->with('success', 'Successfully Updated');
                }
            }
        }
    }

    public function destroyProperty($id)
    {
        if(Auth::guard('admin')->user()->type == 1)
        {
            $data = Property::findOrFail($id);
            $this->UnlinkImage("properties/", $data->image);
            $data->delete();
            PropertiesAmenities::where('property_id','=', $id)->delete();
            PropertiesImages::where('property_id','=', $id)->delete();
        }
        
    }

    public function propertiesEnquiry(Request $request)
    {
        if(request()->ajax())
        {
            $data = PropertiesBookingEnquiry::select('properties_booking_enquiry.*', 'properties.title')
            ->leftJoin('properties', 'properties.id', '=', 'properties_booking_enquiry.property_id')
            ->where('properties_booking_enquiry.enquiry_type', '=', 'Properties');

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
        return view('admin.enquiries.properties');
    }

    public function propertiesFeedback(Request $request)
    {
        if(request()->ajax())
        {
            $data = Feedback::select('feedback.*', 'properties.title', 'users.name')
            ->leftJoin('properties', 'properties.id', '=', 'feedback.property_id')
            ->leftJoin('users', 'users.id', '=', 'feedback.user_id')
            ->where('feedback.type', '=', 'Property');

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
        return view('admin.properties.feedback');
    }

    public function destroyPropertyFeedback($id)
    {
        if(Auth::guard('admin')->user()->type == 1)
        {
            $data = Feedback::where('type', '=', 'Property')->findOrFail($id);
            $data->delete();
        }
        
    }

    public function notificationProperty(Request $request)
    {
        $properties = Property::select('properties.id', 'properties.title', 'properties.original_price', 'properties.image', 'properties.created_at', 'users.name')
            ->leftJoin('users', 'users.id', '=', 'properties.user_id')
            ->where('properties.status', '=', 0)
            ->where('properties.type', '=', 1)
            ->get();

        $tours = Property::select('properties.id', 'properties.title', 'properties.adults', 'properties.image', 'properties.created_at', 'users.name')
            ->leftJoin('users', 'users.id', '=', 'properties.user_id')
            ->where('properties.status', '=', 0)
            ->where('properties.type', '=', 2)
            ->get();    

        $users = User::select('*')->where('type', '=', 2)
            ->where('status', '=', 0)
            ->get();

        $hosts = User::select('*')
                ->where(function($query) {
                    $query->where('type', '=', 1)
                        ->orWhere('type', '=', 3);
                })
            ->where('status', '=', 0)
            ->get();
            
        return view('admin.properties.inactiveproperties', ['properties' => $properties, 'tours' => $tours, 'users' => $users, 'hosts' => $hosts]);
    }
}
