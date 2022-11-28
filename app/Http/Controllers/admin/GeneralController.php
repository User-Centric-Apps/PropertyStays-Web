<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Yajra\Datatables\Datatables;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Help;
use App\Models\HelpCategory;
use App\Models\HelpSubCategory;
use App\Models\SettingsApp;
use App\Models\Pages;

class GeneralController extends Controller
{
    use UploadTrait;
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function help(Request $request)
    {
        if(request()->ajax())
        {

            $data = Help::select('helps.*', 'helps_sub_category.sub_name', 'helps_category.name', 'helps_category.type')
            ->leftJoin('helps_category', 'helps_category.id', '=', 'helps.category_id')
            ->leftJoin('helps_sub_category', 'helps_sub_category.id', '=', 'helps.sub_category_id');

            return Datatables::of($data)
                ->addColumn('action', function ($data) 
                {

                    $abc = '';
                    $abc .= '<a href="'.url('admin/help/manage/'.$data->id).'" class="btn blue btn-xs " title="Edit"><i class="fa fa-edit"></i> </a>';
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
                ->editColumn('type', '@if($type == 1) {{ "Travellings" }} @elseif($type == 2) {{ "Hosts" }} @else {{ "General" }} @endif')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.settings.helps.view');
    }

    public function manageHelp($id = null)
    {
        $item = array();
        $item = Help::select('helps.*', 'helps_sub_category.sub_name', 'helps_category.name', 'helps_category.type')->leftJoin('helps_category', 'helps_category.id', '=', 'helps.category_id')->leftJoin('helps_sub_category', 'helps_sub_category.id', '=', 'helps.sub_category_id')->where('helps.id', '=', $id)->first();

        return view('admin.settings.helps.manage', ['item' => $item]);
    }


    public function doSaveHelp(Request $request)
    {

        $post = $request->all();

        if($post['id'])
        {

            $id = intval($post['id']);
            $item = Help::find($id);

            if($item->count() > 0)
            {
                $item->title = $post['title'];
                $item->description = $post['description'];
                $item->category_id = $post['category_id'];
                $item->sub_category_id = $post['sub_category_id'];
                $item->type = $post['type'];
                $item->slug = Str::slug($post['title'], '-');
                $item->save();

                return redirect('admin/help')->with('success', 'Successfully Updated');
            }
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'category_id' => 'required',
                'sub_category_id' => 'required',
            ]);


            if($validator->passes()) 
            {
                $item = new Help;
                $item->title = $post['title'];
                $item->description = $post['description'];
                $item->category_id = $post['category_id'];
                $item->sub_category_id = $post['sub_category_id'];
                $item->type = $post['type'];
                $item->slug = Str::slug($post['title'], '-');
                $item->save();

                return redirect('admin/help')->with('success', 'Successfully Updated');
            }

            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

    }

    public function destroyHelp($id)
    {
        $data = Help::findOrFail($id);
        $data->delete();
    }

    public function helpSubCategories(Request $request)
    {
        if(request()->ajax())
        {

            $data = HelpSubCategory::select('helps_sub_category.*', 'helps_category.name')
            ->leftJoin('helps_category', 'helps_category.id', '=', 'helps_sub_category.help_cid');

            return Datatables::of($data)
                ->addColumn('action', function ($data) 
                {

                    $abc = '';
                    $abc .= '<a href="'.url('admin/help-sub-categories/manage/'.$data->id).'" class="btn blue btn-xs " title="Edit"><i class="fa fa-edit"></i> </a>';
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
                ->editColumn('type', '@if($type == 1) {{ "Travellings" }} @elseif($type == 2) {{ "Hosts" }} @else {{ "General" }} @endif')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.settings.helps.help-sub-category');
    }

    public function manageSubHelpCategories($id = null)
    {
        $item = array();
        $item = HelpSubCategory::select('*')
        ->where('id', '=', $id)
        ->first();

        $helpcategories = array();
        $helpcategories = HelpCategory::pluck('name', 'id');

        return view('admin.settings.helps.manage-help-sub-category', ['item' => $item, 'helpcategories' => $helpcategories ]);
    }


    public function doSaveSubHelpCategories(Request $request)
    {

        $post = $request->all();

        if($post['id'])
        {

            $id = intval($post['id']);
            $item = HelpSubCategory::find($id);

            if($item->count() > 0)
            {
                $item->sub_name = $post['sub_name'];
                $item->description = $post['description'];
                $item->help_cid = $post['help_cid'];
                $item->type = $post['type'];
                $item->slug = Str::slug($post['sub_name'], '-');
                $item->save();

                return redirect('admin/help-sub-categories')->with('success', 'Successfully Updated');
            }
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'sub_name' => 'required',
                'help_cid' => 'required',
            ]);


            if($validator->passes()) 
            {
                $item = new HelpSubCategory;
                $item->sub_name = $post['sub_name'];
                $item->description = $post['description'];
                $item->help_cid = $post['help_cid'];
                $item->type = $post['type'];
                $item->slug = Str::slug($post['sub_name'], '-');
                $item->save();

                return redirect('admin/help-sub-categories')->with('success', 'Successfully Updated');
            }

            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

    }

    public function destroySubHelpCategories($id)
    {
        $data = HelpSubCategory::findOrFail($id);
        $data->delete();
    }

    public function helpCategories(Request $request)
    {
        if(request()->ajax())
        {

            $data = HelpCategory::select('*');

            return Datatables::of($data)
                ->addColumn('action', function ($data) 
                {

                    $abc = '';
                    $abc .= '<a href="'.url('admin/help-categories/manage/'.$data->id).'" class="btn blue btn-xs " title="Edit"><i class="fa fa-edit"></i> </a>';
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
                ->editColumn('type', '@if($type == 1) {{ "Travellings" }} @elseif($type == 2) {{ "Hosts" }} @else {{ "General" }} @endif')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.settings.helps.help-category');
    }

    public function manageHelpCategories($id = null)
    {
        $item = array();
        $item = HelpCategory::select('*')
        ->where('id', '=', $id)
        ->first();

        return view('admin.settings.helps.manage-help-category', ['item' => $item]);
    }


    public function doSaveHelpCategories(Request $request)
    {

        $post = $request->all();

        if($post['id'])
        {

            $id = intval($post['id']);
            $item = HelpCategory::find($id);

            if($item->count() > 0)
            {
                $item->name = $post['name'];
                $item->description = $post['description'];
                $item->icon = $post['icon'];
                $item->type = $post['type'];
                $item->slug = Str::slug($post['name'], '-');
                $item->save();

                return redirect('admin/help-categories')->with('success', 'Successfully Updated');
            }
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'icon' => 'required',
                'type' => 'required',
            ]);


            if($validator->passes()) 
            {
                $item = new HelpCategory;
                $item->name = $post['name'];
                $item->description = $post['description'];
                $item->icon = $post['icon'];
                $item->type = $post['type'];
                $item->slug = Str::slug($post['name'], '-');
                $item->save();

                return redirect('admin/help-categories')->with('success', 'Successfully Updated');
            }

            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

    }

    public function destroyHelpCategories($id)
    {
        $data = HelpCategory::findOrFail($id);
        $data->delete();
    }

    public function manageAppSettings()
    {
        $item = array();
        $item = SettingsApp::select('*')
        ->where('id', '=', 1)
        ->first();

        return view('admin.settings.settings_app.manage', ['item' => $item]);
    }

    public function doSaveAppSettings(Request $request)
    {

        $post = $request->all();

        $id = 1;
        $item = SettingsApp::find($id);

        if($item->count() > 0)
        {
            $item->comission = $post['comission'];
            $item->gbp = $post['gbp'];
            $item->eur = $post['eur'];
            $item->save();

            return redirect('admin/app-settings')->with('success', 'Successfully Updated');
        }

    }

    public function pages(Request $request)
    {
        if(request()->ajax())
        {

            $data = Pages::select('*');

            return Datatables::of($data)
                ->addColumn('action', function ($data) 
                {
                    return '<div class="btn-group pull-right"><a href="'.url('admin/page/manage/'.$data->id).'" class="btn blue btn-xs " title="Edit"><i class="fa fa-edit"></i> </a></div>';
                    
              
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
        return view('admin.settings.pages.index');
    }

    public function managePage($id = null)
    {
        $item = array();
        $item = Pages::select('*')
        ->where('id', '=', $id)
        ->first();

        return view('admin.settings.pages.manage', ['item' => $item]);
    }


    public function doSavePage(Request $request)
    {

        $post = $request->all();

        //Extention and Size
                $valid_extension = array("jpg","jpeg","png");
                $maxFileSize = 2097152;
            //Extention and Size

        if($post['id'])
        {

            $id = intval($post['id']);
            $item = Pages::find($id);

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
                                $this->UnlinkImage("pages/", $item->image);
                            }
                            $name = Str::slug($request->get('title')).'_'.time();
                            $folder = '/uploads/pages/';
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

                $item->title = $post['title'];
                $item->sub_title = $post['sub_title'];
                $item->description = $post['description'];
                $item->meta = $post['meta'];
                $item->keywords = $post['keywords'];
                $item->date = date('Y-m-d');
                $item->admin_id = Auth::guard('admin')->user()->id;
                $item->save();

                return redirect('admin/pages')->with('success', 'Successfully Updated');
            }
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);


            if($validator->passes()) 
            {
                $item = new Pages;
                $item->title = $post['title'];
                $item->sub_title = $post['sub_title'];
                $item->description = $post['description'];
                $item->meta = $post['meta'];
                $item->keywords = $post['keywords'];
                $item->date = date('Y-m-d');
                $item->admin_id = Auth::guard('admin')->user()->id;
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
                            $name = Str::slug($request->get('title')).'_'.time();
                            $folder = '/uploads/pages/';
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

                return redirect('admin/pages')->with('success', 'Successfully Updated');
            }

            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

    }

    public function deletePage($id)
    {
        /*$data = Pages::findOrFail($id);
        $data->delete();*/
    }
}
