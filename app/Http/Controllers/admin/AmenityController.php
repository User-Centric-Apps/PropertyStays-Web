<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Session;
use Auth;
use DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;
use App\Models\Amenity;
use App\Models\RentTypes;
use App\Models\Suitable;

class AmenityController extends Controller
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

            $data = Amenity::select('*');

            return Datatables::of($data)
                ->addColumn('action', function ($data) 
                {
                    $abc = '';
                    $abc .= '<a href="'.url('admin/amenities/manage/'.$data->id).'" class="btn blue btn-xs " title="Edit"><i class="fa fa-edit"></i> </a>';
                    if(Auth::guard('admin')->user()->type == 1)
                    {

                      $abc .= '<button id="'.$data->id.'" class="delete btn red btn-xs " title="Delete"  ><i class="fa fa-times"></i> </button>';

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
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.settings.amenities.view');
    }

    public function manageAmenities($id = null)
    {
        $item = array();
        $item = Amenity::select('*')
        ->where('id', '=', $id)
        ->first();

        return view('admin.settings.amenities.manage', ['item' => $item]);
    }


    public function doSaveAmenities(Request $request)
    {

        $post = $request->all();

        if($post['id'])
        {
            //Extention and Size
                $valid_extension = array("jpg","jpeg","png");
                $maxFileSize = 2097152;
            //Extention and Size

            $id = intval($post['id']);
            $item = Amenity::find($id);

            if($item->count() > 0)
            {
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
                                $this->UnlinkImage("amenities/", $item->image);
                            }
                            $name = Str::slug($request->get('name')).'_'.time();
                            $folder = '/uploads/amenities/';
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
                $item->name = $post['name'];
                $item->save();

                return redirect('admin/amenities')->with('success', 'Successfully Updated');
            }
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);


            if($validator->passes()) 
            {
                $image = $request->file('image');
                $name = Str::slug($request->get('name')).'_'.time();
                $folder = '/uploads/amenities/';
                $filePath = $name. '.' . $image->getClientOriginalExtension();
                $this->uploadOne($image, $folder, 'public', $name);
                $post['image'] = $filePath;

                Amenity::create($post);

                return redirect('admin/amenities')->with('success', 'Successfully Updated');
            }

            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

    }

    public function destroyAmenities($id)
    {
        $data = Amenity::findOrFail($id);
        $data->delete();
    }

    public function viewRentalType(Request $request)
    {
        if(request()->ajax())
        {

            $data = RentTypes::select('*');

            return Datatables::of($data)
                ->addColumn('action', function ($data) 
                {

                    $abc = '';
                    $abc .= '<a href="'.url('admin/rental-type/manage/'.$data->id).'" class="btn blue btn-xs " title="Edit"><i class="fa fa-edit"></i> </a>';
                    if(Auth::guard('admin')->user()->type == 1)
                    {

                      $abc .= '<button id="'.$data->id.'" class="delete btn red btn-xs " title="Delete"  ><i class="fa fa-times"></i> </button>';

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
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.settings.renttypes.view');
    }

    public function manageRentalType($id = null)
    {
        $item = array();
        $item = RentTypes::select('*')
        ->where('id', '=', $id)
        ->first();

        return view('admin.settings.renttypes.manage', ['item' => $item]);
    }


    public function doSaveRentalType(Request $request)
    {

        $post = $request->all();

        if($post['id'])
        {
            //Extention and Size
                $valid_extension = array("jpg","jpeg","png");
                $maxFileSize = 2097152;
            //Extention and Size

            $id = intval($post['id']);
            $item = RentTypes::find($id);

            if($item->count() > 0)
            {
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
                                $this->UnlinkImage("renttypes/", $item->image);
                            }
                            $name = Str::slug($request->get('name')).'_'.time();
                            $folder = '/uploads/renttypes/';
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
                $item->name = $post['name'];
                $item->save();

                return redirect('admin/rental-type')->with('success', 'Successfully Updated');
            }
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);


            if($validator->passes()) 
            {
                $image = $request->file('image');
                $name = Str::slug($request->get('name')).'_'.time();
                $folder = '/uploads/renttypes/';
                $filePath = $name. '.' . $image->getClientOriginalExtension();
                $this->uploadOne($image, $folder, 'public', $name);
                $post['image'] = $filePath;

                RentTypes::create($post);

                return redirect('admin/rental-type')->with('success', 'Successfully Updated');
            }

            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

    }

    public function destroyRentalType($id)
    {
        $data = RentTypes::findOrFail($id);
        $data->delete();
    }

    public function viewSuitable(Request $request)
    {
        if(request()->ajax())
        {

            $data = Suitable::select('*');

            return Datatables::of($data)
                ->addColumn('action', function ($data) 
                {

                    $abc = '';
                    $abc .= '<a href="'.url('admin/suitable/manage/'.$data->id).'" class="btn blue btn-xs " title="Edit"><i class="fa fa-edit"></i> </a>';
                    if(Auth::guard('admin')->user()->type == 1)
                    {

                      $abc .= '<button id="'.$data->id.'" class="delete btn red btn-xs " title="Delete"  ><i class="fa fa-times"></i> </button>';

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
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.settings.suitables.view');
    }

    public function manageSuitable($id = null)
    {
        $item = array();
        $item = Suitable::select('*')
        ->where('id', '=', $id)
        ->first();

        return view('admin.settings.suitables.manage', ['item' => $item]);
    }


    public function doSaveSuitable(Request $request)
    {

        $post = $request->all();

        if($post['id'])
        {
            //Extention and Size
                $valid_extension = array("jpg","jpeg","png");
                $maxFileSize = 2097152;
            //Extention and Size

            $id = intval($post['id']);
            $item = Suitable::find($id);

            if($item->count() > 0)
            {
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
                                $this->UnlinkImage("suitables/", $item->image);
                            }
                            $name = Str::slug($request->get('suitable_name')).'_'.time();
                            $folder = '/uploads/suitables/';
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
                $item->suitable_name = $post['suitable_name'];
                $item->save();

                return redirect('admin/suitables')->with('success', 'Successfully Updated');
            }
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'suitable_name' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);


            if($validator->passes()) 
            {
                $image = $request->file('image');
                $name = Str::slug($request->get('suitable_name')).'_'.time();
                $folder = '/uploads/suitables/';
                $filePath = $name. '.' . $image->getClientOriginalExtension();
                $this->uploadOne($image, $folder, 'public', $name);
                $post['image'] = $filePath;

                Suitable::create($post);

                return redirect('admin/suitables')->with('success', 'Successfully Updated');
            }

            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

    }

    public function destroySuitable($id)
    {
        $data = Suitable::findOrFail($id);
        $data->delete();
    }
}
