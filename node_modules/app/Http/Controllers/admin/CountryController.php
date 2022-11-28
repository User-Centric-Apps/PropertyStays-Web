<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Yajra\Datatables\Datatables;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;
use App\Models\Country;
use App\Models\City;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    use UploadTrait;
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function viewCountry(Request $request)
    {
        if(request()->ajax())
        {

            $data = Country::select('*');

            return Datatables::of($data)
                ->addColumn('action', function ($data) 
                {

                    $abc = '';
                    $abc .= '<a href="'.url('admin/countries/manage/'.$data->id).'" class="btn blue btn-xs " title="Edit"><i class="fa fa-edit"></i> </a>';
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
        return view('admin.settings.countries.view');
    }

    public function manageCountry($id = null)
    {
        $item = array();
        $item = Country::select('*')
        ->where('id', '=', $id)
        ->first();

        return view('admin.settings.countries.manage', ['item' => $item]);
    }


    public function doSaveCountry(Request $request)
    {

        $post = $request->all();

        if($post['id'])
        {

            $id = intval($post['id']);
            $item = Country::find($id);

            if($item->count() > 0)
            {
                $item->cname = $post['cname'];
                $item->status = $post['status'];
                $item->save();

                return redirect('admin/countries')->with('success', 'Successfully Updated');
            }
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'cname' => 'required',
            ]);


            if($validator->passes()) 
            {
                $item = new Country;
                $item->cname = $post['cname'];
                $item->status = $post['status'];
                $item->save();

                return redirect('admin/countries')->with('success', 'Successfully Updated');
            }

            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

    }

    public function destroyCountry($id)
    {
        $data = Country::findOrFail($id);
        $data->delete();
    }

    public function viewCity(Request $request)
    {
        if(request()->ajax())
        {

            $data = City::select('cities.*', 'countries.cname')
            ->leftJoin('countries', 'countries.id', '=', 'cities.country_id');

            return Datatables::of($data)
                ->addColumn('action', function ($data) 
                {

                    $abc = '';
                    $abc .= '<a href="'.url('admin/cities/manage/'.$data->id).'" class="btn blue btn-xs " title="Edit"><i class="fa fa-edit"></i> </a>';
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
                ->editColumn('top', '@if($top == 1) <span class="label label-info">{{ "Yes" }} </span> @endif')
                ->rawColumns(['top', 'action'])
                ->make(true);
        }
        return view('admin.settings.cities.view');
    }

    public function manageCity($id = null)
    {
        $item = array();
        $item = City::select('*')
        ->where('id', '=', $id)
        ->first();

        $countries = array();
        $countries = Country::pluck('cname', 'id');

        return view('admin.settings.cities.manage', ['item' => $item, 'countries' => $countries]);
    }


    public function doSaveCity(Request $request)
    {

        $post = $request->all();

            //Extention and Size
                $valid_extension = array("jpg","jpeg","png");
                $maxFileSize = 2097152;
            //Extention and Size

        if($post['id'])
        {

            $id = intval($post['id']);
            $item = City::find($id);

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
                                $this->UnlinkImage("cities/", $item->image);
                            }
                            $name = Str::slug($request->get('cityname')).'_'.time().'img';
                            $folder = '/uploads/cities/';
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
                $item->cityname = $post['cityname'];
                $item->latitude = $post['latitude'];
                $item->longitude = $post['longitude'];
                $item->country_id = $post['country_id'];
                $item->description = $post['description'];
                $item->top = ($request->get('top') == 1) ? 1 : 0;
                $item->slug = Str::slug($post['cityname'], '-');

                if($request->has('image_side1')) 
                {
                    $image = $request->file('image_side1');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        if($fileSize <= $maxFileSize)
                        {
                            if($item->count()>0)
                            {
                                $this->UnlinkImage("cities/", $item->image_side1);
                            }
                            $name = Str::slug($request->get('cityname')).'_'.time().'img1';
                            $folder = '/uploads/cities/';
                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                            $this->uploadOne($image, $folder, 'public', $name);
                            $item->image_side1 = $filePath;

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
                $item->image_alt1 = $post['image_alt1'];
                if($post['image_alt1'] == '')
                {
                    $item->image_side1 = '';
                }

                if($request->has('image_side2')) 
                {
                    $image = $request->file('image_side2');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        if($fileSize <= $maxFileSize)
                        {
                            if($item->count()>0)
                            {
                                $this->UnlinkImage("cities/", $item->image_side2);
                            }
                            $name = Str::slug($request->get('cityname')).'_'.time().'img2';
                            $folder = '/uploads/cities/';
                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                            $this->uploadOne($image, $folder, 'public', $name);
                            $item->image_side2 = $filePath;

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
                $item->image_alt2 = $post['image_alt2'];
                if($post['image_alt2'] == '')
                {
                    $item->image_side2 = '';
                }

                if($request->has('image_side3')) 
                {
                    $image = $request->file('image_side3');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        if($fileSize <= $maxFileSize)
                        {
                            if($item->count()>0)
                            {
                                $this->UnlinkImage("cities/", $item->image_side3);
                            }
                            $name = Str::slug($request->get('cityname')).'_'.time().'img3';
                            $folder = '/uploads/cities/';
                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                            $this->uploadOne($image, $folder, 'public', $name);
                            $item->image_side3 = $filePath;

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
                $item->image_alt3 = $post['image_alt3'];
                if($post['image_alt3'] == '')
                {
                    $item->image_side3 = '';
                }

                if($request->has('image_side4')) 
                {
                    $image = $request->file('image_side4');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        if($fileSize <= $maxFileSize)
                        {
                            if($item->count()>0)
                            {
                                $this->UnlinkImage("cities/", $item->image_side4);
                            }
                            $name = Str::slug($request->get('cityname')).'_'.time().'img4';
                            $folder = '/uploads/cities/';
                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                            $this->uploadOne($image, $folder, 'public', $name);
                            $item->image_side4 = $filePath;

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
                $item->image_alt4 = $post['image_alt4'];
                if($post['image_alt4'] == '')
                {
                    $item->image_side4 = '';
                }

                if($request->has('image_side5')) 
                {
                    $image = $request->file('image_side5');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        if($fileSize <= $maxFileSize)
                        {
                            if($item->count()>0)
                            {
                                $this->UnlinkImage("cities/", $item->image_side5);
                            }
                            $name = Str::slug($request->get('cityname')).'_'.time().'img5';
                            $folder = '/uploads/cities/';
                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                            $this->uploadOne($image, $folder, 'public', $name);
                            $item->image_side5 = $filePath;

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
                $item->image_alt5 = $post['image_alt5'];
                if($post['image_alt5'] == '')
                {
                    $item->image_side5 = '';
                }

                $item->save();

                return redirect('admin/cities')->with('success', 'Successfully Updated');
            }
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'cityname' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);


            if($validator->passes()) 
            {
                $item = new City;
                $item->cityname = $post['cityname'];
                $item->latitude = $post['latitude'];
                $item->longitude = $post['longitude'];
                $item->country_id = $post['country_id'];
                $item->description = $post['description'];
                $item->top = ($request->get('top') == 1) ? 1 : 0;
                $item->slug = Str::slug($post['cityname'], '-');
                if($request->has('image')) 
                {
                    $image = $request->file('image');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        if($fileSize <= $maxFileSize)
                        {
                            $name = Str::slug($request->get('cityname')).'_'.time().'img';
                            $folder = '/uploads/cities/';
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

                if($request->has('image_side1')) 
                {
                    $image = $request->file('image_side1');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        if($fileSize <= $maxFileSize)
                        {
                            if($item->count()>0)
                            {
                                $this->UnlinkImage("cities/", $item->image_side1);
                            }
                            $name = Str::slug($request->get('cityname')).'_'.time().'img1';
                            $folder = '/uploads/cities/';
                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                            $this->uploadOne($image, $folder, 'public', $name);
                            $item->image_side1 = $filePath;

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
                $item->image_alt1 = $post['image_alt1'];

                if($request->has('image_side2')) 
                {
                    $image = $request->file('image_side2');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        if($fileSize <= $maxFileSize)
                        {
                            if($item->count()>0)
                            {
                                $this->UnlinkImage("cities/", $item->image_side2);
                            }
                            $name = Str::slug($request->get('cityname')).'_'.time().'img2';
                            $folder = '/uploads/cities/';
                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                            $this->uploadOne($image, $folder, 'public', $name);
                            $item->image_side2 = $filePath;

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
                $item->image_alt2 = $post['image_alt2'];

                if($request->has('image_side3')) 
                {
                    $image = $request->file('image_side3');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        if($fileSize <= $maxFileSize)
                        {
                            if($item->count()>0)
                            {
                                $this->UnlinkImage("cities/", $item->image_side3);
                            }
                            $name = Str::slug($request->get('cityname')).'_'.time().'img3';
                            $folder = '/uploads/cities/';
                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                            $this->uploadOne($image, $folder, 'public', $name);
                            $item->image_side3 = $filePath;

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
                $item->image_alt3 = $post['image_alt3'];

                if($request->has('image_side4')) 
                {
                    $image = $request->file('image_side4');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        if($fileSize <= $maxFileSize)
                        {
                            if($item->count()>0)
                            {
                                $this->UnlinkImage("cities/", $item->image_side4);
                            }
                            $name = Str::slug($request->get('cityname')).'_'.time().'img4';
                            $folder = '/uploads/cities/';
                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                            $this->uploadOne($image, $folder, 'public', $name);
                            $item->image_side4 = $filePath;

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
                $item->image_alt4 = $post['image_alt4'];

                if($request->has('image_side5')) 
                {
                    $image = $request->file('image_side5');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        if($fileSize <= $maxFileSize)
                        {
                            if($item->count()>0)
                            {
                                $this->UnlinkImage("cities/", $item->image_side5);
                            }
                            $name = Str::slug($request->get('cityname')).'_'.time().'img5';
                            $folder = '/uploads/cities/';
                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                            $this->uploadOne($image, $folder, 'public', $name);
                            $item->image_side5 = $filePath;

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
                $item->image_alt5 = $post['image_alt5'];
                $item->save();

                return redirect('admin/cities')->with('success', 'Successfully Updated');
            }

            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

    }

    public function destroyCity($id)
    {
        $data = City::findOrFail($id);
        $data->delete();
    }
}
