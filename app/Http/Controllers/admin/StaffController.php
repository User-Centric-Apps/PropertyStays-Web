<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;
use App\Models\Admin;
use Carbon\Carbon;
use Mail;

class StaffController extends Controller
{
    use UploadTrait;
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function viewServiceProvider(Request $request)
    {
        if(request()->ajax())
        {
            $data = Admin::select('id', 'name', 'email', 'mobile', 'status', 'last_login', 'joined')
                ->where('admins.type', '=', 4);

            return Datatables::of($data)
                ->filterColumn('fullname', function($query, $keyword) {
                        $query->whereRaw("CONCAT(name,' ',lastname) like ?", ["%{$keyword}%"]);
                })
                ->addColumn('action', function ($data) 
                {

                    $abc = '';

                    $abc .= '<a href="'.url('admin/staff/admin/manage/'.$data->id).'" class="btn blue btn-xs " title="Edit"><i class="fa fa-edit"></i> </a>';
                    if(Auth::guard('admin')->user()->type == 1)
                    {

                      $abc .= '<button id="'.$data->id.'" class="delete btn red btn-xs " title="Delete"  ><i class="fa fa-times"></i> </button>';

                    }

                    return '<div class="btn-group pull-right">'.$abc.'</div>';
                    
              
                })
                ->editColumn('status', '@if($status == 1) <span class="label label-info">{{ "Active"}} </span>  @else <span class="label label-danger">{{"Inactive"}}</span> @endif')
              ->rawColumns(['action', 'status'])
              ->make(true);
        }
        return view('admin.users.staffs.service-provider');
    }

    public function manageServiceProvider($id = null)
    {
        $user = array();
        $user = Admin::select('*')
        ->where('admins.id', '=', $id)
        ->where('admins.type', '=', 4)
        ->first();
        return view('admin.users.staffs.service-provider-manage', ['user' => $user]);
    }


    public function doSaveServiceProvider(Request $request)
    {

        if(Auth::guard('admin')->user()->type != 1)
        {
          return redirect()->back()->with('danger', 'You dont have rights to perform this action.');
        }
        
        $user = new Admin;

        $post = $request->all();

        if($post['id'])
        {
            $id = intval($post['id']);
            $user = $user->find($id);
            if($user->count() > 0)
            { 
                $user->name = $post['name'];
                $user->mobile = $post['mobile'];
                if(isset($post['password']))
                {
                  if($post['password']!='')
                  {
                    $user->password = Hash::make($post['password']);
                  }
                }
                $user->status = $post['status'];
                $user->type = $post['type']; //2 for Admin, 3 for Editor, 4 for ServiceProvider
                $user->save();

                return redirect('admin/service-provider')->with('success', 'Successfully Updated');
                
            }
        }
        else
        {
            //Adding for New User

            $rules = array(
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|min:6'
            );

            $validation =  Validator::make($request->all(), $rules);
                
            if($validation->fails())
            {
                return redirect()->back()->withInput($request->all())->withErrors($validation);
            } 
            else 
            {
                $user = new Admin;
                $user->name = $post['name'];
                $user->email = $post['email'];
                $user->mobile = $post['mobile'];
                $user->password = Hash::make($post['password']);
                $user->status = $post['status'];
                $user->joined = date('Y-m-d');
                $user->type = $post['type']; //2 for Admin, 3 for Editor, 4 for ServiceProvider

                

                $user->save();

                /*$data = array('name' => $user->name, 'email' => $user->email,'password' => $user->view_pass, 'type' => 'global');

                $subject = 'Login Details';
                $userEmail = $user->email;

                Mail::send('emails/send-password', $data, function($message) use ($userEmail, $subject) {
                    $message->from('info@rsiartaward.com', 'RSI ART AWARD COMETITIONS');
                    $message->to($userEmail)->subject($subject);
                });*/

                return redirect('admin/service-provider')->with('success', 'Successfully Updated');

            }
         }
    }

    public function destroyServiceProvider($id)
    {
        if(Auth::guard('admin')->user()->type==1)
        {
            $data = Admin::findOrFail($id);
            $data->delete();
        }
    }

    public function viewStaff(Request $request)
    {
        if(request()->ajax())
        {
            $data = Admin::select('id', 'name', 'email', 'mobile', 'status', 'last_login', 'joined')
                ->where(function($query) {
                        $query->where('admins.type', '=', 2)
                            ->orWhere('admins.type', '=', 3);
                });

            return Datatables::of($data)
                ->filterColumn('fullname', function($query, $keyword) {
                        $query->whereRaw("CONCAT(name,' ',lastname) like ?", ["%{$keyword}%"]);
                })
                ->addColumn('action', function ($data) 
                {

                    $abc = '';

                    $abc .= '<a href="'.url('admin/staff/manage/'.$data->id).'" class="btn blue btn-xs " title="Edit"><i class="fa fa-edit"></i> </a>';
                    if(Auth::guard('admin')->user()->type == 1)
                    {

                      $abc .= '<button id="'.$data->id.'" class="delete btn red btn-xs " title="Delete"  ><i class="fa fa-times"></i> </button>';

                    }

                    return '<div class="btn-group pull-right">'.$abc.'</div>';
                    
              
                })
                ->editColumn('status', '@if($status == 1) <span class="label label-info">{{ "Active"}} </span>  @else <span class="label label-danger">{{"Inactive"}}</span> @endif')
              ->rawColumns(['action', 'status'])
              ->make(true);
        }
        return view('admin.users.staffs.view');
    }

    public function manageStaff($id = null)
    {
        $user = array();
        $user = Admin::select('*')
        ->where('admins.id', '=', $id)
        ->where('admins.type', '!=', 1)
        ->first();
        return view('admin.users.staffs.manage-staff', ['user' => $user]);
    }


    public function doSaveStaff(Request $request)
    {

        if(Auth::guard('admin')->user()->type != 1)
        {
          return redirect()->back()->with('danger', 'You dont have rights to perform this action.');
        }
        
        $user = new Admin;

        $post = $request->all();

        if($post['id'])
        {
            $id = intval($post['id']);
            $user = $user->find($id);
            if($user->count() > 0)
            { 
                $user->name = $post['name'];
                $user->mobile = $post['mobile'];
                if(isset($post['password']))
                {
                  if($post['password']!='')
                  {
                    $user->password = Hash::make($post['password']);
                  }
                }
                $user->status = $post['status'];
                $user->type = $post['type']; //2 for Admin, 3 for Editor, 4 for ServiceProvider
                $user->save();

                return redirect('admin/staff')->with('success', 'Successfully Updated');
                
            }
        }
        else
        {
            //Adding for New User

            $rules = array(
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|min:6'
            );

            $validation =  Validator::make($request->all(), $rules);
                
            if($validation->fails())
            {
                return redirect()->back()->withInput($request->all())->withErrors($validation);
            } 
            else 
            {
                $user = new Admin;
                $user->name = $post['name'];
                $user->email = $post['email'];
                $user->mobile = $post['mobile'];
                $user->password = Hash::make($post['password']);
                $user->status = $post['status'];
                $user->joined = date('Y-m-d');
                $user->type = $post['type']; //2 for Admin, 3 for Editor, 4 for ServiceProvider

                

                $user->save();

                /*$data = array('name' => $user->name, 'email' => $user->email,'password' => $user->view_pass, 'type' => 'global');

                $subject = 'Login Details';
                $userEmail = $user->email;

                Mail::send('emails/send-password', $data, function($message) use ($userEmail, $subject) {
                    $message->from('info@rsiartaward.com', 'RSI ART AWARD COMETITIONS');
                    $message->to($userEmail)->subject($subject);
                });*/

                return redirect('admin/staff')->with('success', 'Successfully Updated');

            }
         }
    }

    public function destroyStaff($id)
    {
        if(Auth::guard('admin')->user()->type == 1)
        {
            $data = Admin::findOrFail($id);
            $data->delete();
        }
    }
}
