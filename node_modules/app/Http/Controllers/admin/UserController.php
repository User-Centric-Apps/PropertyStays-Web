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
use Illuminate\Support\Facades\Hash;
use App\Traits\UploadTrait;
use App\Models\User;
use App\Models\UsersHostPayment;
use App\Models\UsersHostPaymentHistory;

class UserController extends Controller
{
    use UploadTrait;
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function viewCustomer(Request $request)
    {
        if(request()->ajax())
        {
            $data = User::select('*')->where(function($query) {
                        $query->where('type', '=', 2)
                            ->orWhere('type', '=', 3);
                    });

            return Datatables::of($data)
                ->addColumn('action', function ($data) 
                {
                    if(Auth::guard('admin')->user()->type == 1)
                    {
                        return '<div class="btn-group pull-right"><a href="'.url('admin/customers/manage/'.$data->id).'" class="btn green btn-xs" title="Edit"><i class="fa fa-edit"></i> </a><button id="'.$data->id.'" class="delete btn red btn-xs" title="Delete"  ><i class="fa fa-times"></i> </button></div>';
                    }
                    else
                    {
                        return '<div class="btn-group pull-right"><a href="'.url('admin/teachers/manage/'.$data->id).'" class="btn green btn-xs" title="Edit"><i class="fa fa-edit"></i> </a></div>';
                    }
              
                })
                ->editColumn('status', '@if($status == 1) {{ "Active" }} @else {{ "InActive" }} @endif')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.users.customers.index');
    }

    public function manageCustomer($id = null)
    {
        $user = array();
        $user = User::select('*')->where('id', '=', $id)->first();

        return view('admin.users.customers.manage', ['user' => $user]);
    }


    public function doSaveCustomer(Request $request)
    {
        if(Auth::guard('admin')->user()->type != 1)
        {
          return redirect()->back()->with('danger', 'You dont have rights to perform this action.');
        }

        $post = $request->all();
        $valid_extension = array("jpg","jpeg","png");
        $maxFileSize = 2097152; 
        
        $user = new User;

        if($post['id'])
        {
            $id = intval($post['id']);
            $user = $user->find($id);
            if($user->count() > 0)
            {
                $user->name = $post['name'];

                if(isset($post['password']))
                {
                  if($post['password']!='')
                  {
                    $user->password = Hash::make($post['password']);
                    $user->view_pass = $post['password'];
                  }
                }
                $user->mobile = $post['mobile'];
                $user->whatsapp = $post['whatsapp'];
                $user->status = $post['status'];
                

                
                //profile_pic
                    if($request->has('profile_pic')) 
                    {
                        // Get image file
                        $image = $request->file('profile_pic');
                        $fileSize = $image->getSize();
                        $extension = $image->getClientOriginalExtension();

                        

                        if(in_array(strtolower($extension),$valid_extension))
                        {
                            if($fileSize <= $maxFileSize)
                            {
                                if($user->count()>0)
                                {
                                    $this->UnlinkImage("customers/", $user->profile_pic);
                                }
                                $name = Str::slug($request->get('name')).'_'.time();
                                $folder = '/uploads/customers/';
                                $filePath = $name. '.' . $image->getClientOriginalExtension();
                                $this->uploadOne($image, $folder, 'public', $name);
                                $user->profile_pic = $filePath;
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
                //profile_pic
                
                $user->save();

                return redirect('admin/customers')->with('success', 'Successfully Updated');
            }
        }
        else
        {
            //Adding for New User

            $rules = array(
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            );

            $validation =  Validator::make($request->all(), $rules);
                
            if($validation->fails())
            {
                return redirect()->back()->withInput($request->all())->withErrors($validation);
            } 
            else 
            {
                $user = new User;
                $user->name = $post['name'];
                $user->email = $post['email'];
                $user->password = Hash::make($post['password']);
                $user->view_pass = $post['password'];
                $user->mobile = $post['mobile'];
                $user->whatsapp = $post['whatsapp'];
                $user->status = $post['status'];
                $user->joined = date('Y-m-d');
                $user->type = $post['type'];
                    
                
                // Check if a profile image has been uploaded
                    if($request->has('profile_pic')) 
                    {
                        // Get image file
                        $image = $request->file('profile_pic');
                        //Path Delete
                        if($user->count()>0)
                        {
                            $this->UnlinkImage("customers/", $user->profile_pic);
                        }
                        //Path Delete
                        // Make a image name based on user name and current timestamp
                        $name = Str::slug($request->get('name')).'_'.time();
                        // Define folder path
                        $folder = '/uploads/customers/';
                        // Make a file path where image will be stored [ folder path + file name + file extension]
                        $filePath = $name. '.' . $image->getClientOriginalExtension();
                        // Upload image
                        $this->uploadOne($image, $folder, 'public', $name);
                        // Set user profile image path in database to filePath
                        $user->profile_pic = $filePath;
                    }
                //Check if a profile image has been uploaded

                $user->save();

                return redirect('admin/customers')->with('success', 'Successfully Updated');

            }
         }
    }

    public function destroyCustomer($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
    }

    public function viewHost(Request $request)
    {
        if(request()->ajax())
        {
            $data = User::select('*')
                ->where(function($query) {
                    $query->where('type', '=', 1)
                        ->orWhere('type', '=', 3);
                });

            return Datatables::of($data)
                ->addColumn('action', function ($data) 
                {
                    if(Auth::guard('admin')->user()->type == 1)
                    {
                        return '<div class="btn-group pull-right"><a href="'.url('admin/hosts/manage/'.$data->id).'" class="btn green btn-xs" title="Edit"><i class="fa fa-edit"></i> </a><button id="'.$data->id.'" class="delete btn red btn-xs" title="Delete"  ><i class="fa fa-times"></i> </button></div>';
                    }
                    else
                    {
                        return '<div class="btn-group pull-right"><a href="'.url('admin/hosts/manage/'.$data->id).'" class="btn green btn-xs" title="Edit"><i class="fa fa-edit"></i> </a></div>';
                    }
              
                })
                ->editColumn('status', '@if($status == 1) {{ "Active" }} @else {{ "InActive" }} @endif')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.users.hosts.index');
    }

    public function manageHost($id = null)
    {
        $user = array();
        $user = User::select('*')->where('id', '=', $id)->first();

        return view('admin.users.hosts.manage', ['user' => $user]);
    }


    public function doSaveHost(Request $request)
    {
        if(Auth::guard('admin')->user()->type != 1)
        {
          return redirect()->back()->with('danger', 'You dont have rights to perform this action.');
        }

        $post = $request->all();
        $valid_extension = array("jpg","jpeg","png");
        $maxFileSize = 2097152; 
        
        $user = new User;

        if($post['id'])
        {
            $id = intval($post['id']);
            $user = $user->find($id);
            if($user->count() > 0)
            {
                $user->name = $post['name'];

                if(isset($post['password']))
                {
                  if($post['password']!='')
                  {
                    $user->password = Hash::make($post['password']);
                    $user->view_pass = $post['password'];
                  }
                }
                $user->mobile = $post['mobile'];
                $user->whatsapp = $post['whatsapp'];
                $user->status = $post['status'];
                $user->account_title = $post['account_title'];
                $user->account_iban = $post['account_iban'];
                $user->account_branch = $post['account_branch'];
                $user->account_city = $post['account_city'];
                

                
                //profile_pic
                    if($request->has('profile_pic')) 
                    {
                        // Get image file
                        $image = $request->file('profile_pic');
                        $fileSize = $image->getSize();
                        $extension = $image->getClientOriginalExtension();

                        

                        if(in_array(strtolower($extension),$valid_extension))
                        {
                            if($fileSize <= $maxFileSize)
                            {
                                if($user->count()>0)
                                {
                                    $this->UnlinkImage("customers/", $user->profile_pic);
                                }
                                $name = Str::slug($request->get('name')).'_'.time();
                                $folder = '/uploads/customers/';
                                $filePath = $name. '.' . $image->getClientOriginalExtension();
                                $this->uploadOne($image, $folder, 'public', $name);
                                $user->profile_pic = $filePath;
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
                //profile_pic
                
                $user->save();

                return redirect('admin/hosts')->with('success', 'Successfully Updated');
            }
        }
        else
        {
            //Adding for New User

            $rules = array(
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            );

            $validation =  Validator::make($request->all(), $rules);
                
            if($validation->fails())
            {
                return redirect()->back()->withInput($request->all())->withErrors($validation);
            } 
            else 
            {
                $user = new User;
                $user->name = $post['name'];
                $user->email = $post['email'];
                $user->password = Hash::make($post['password']);
                $user->view_pass = $post['password'];
                $user->mobile = $post['mobile'];
                $user->whatsapp = $post['whatsapp'];
                $user->status = $post['status'];
                $user->joined = date('Y-m-d');
                $user->type = $post['type'];
                $user->account_title = $post['account_title'];
                $user->account_iban = $post['account_iban'];
                $user->account_branch = $post['account_branch'];
                $user->account_city = $post['account_city'];
                    
                
                // Check if a profile image has been uploaded
                    if($request->has('profile_pic')) 
                    {
                        // Get image file
                        $image = $request->file('profile_pic');
                        //Path Delete
                        if($user->count()>0)
                        {
                            $this->UnlinkImage("customers/", $user->profile_pic);
                        }
                        //Path Delete
                        // Make a image name based on user name and current timestamp
                        $name = Str::slug($request->get('name')).'_'.time();
                        // Define folder path
                        $folder = '/uploads/customers/';
                        // Make a file path where image will be stored [ folder path + file name + file extension]
                        $filePath = $name. '.' . $image->getClientOriginalExtension();
                        // Upload image
                        $this->uploadOne($image, $folder, 'public', $name);
                        // Set user profile image path in database to filePath
                        $user->profile_pic = $filePath;
                    }
                //Check if a profile image has been uploaded

                $user->save();

                return redirect('admin/hosts')->with('success', 'Successfully Updated');

            }
         }
    }

    public function destroyHost($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
    }

    public function hostPayments(Request $request)
    {
        if(request()->ajax())
        {
            $data = UsersHostPayment::select('users_host_payment.*', 'properties.title', 'users.name', 'orders_item.order_id', 'orders_item.price')
            ->leftJoin('properties', 'properties.id', '=', 'users_host_payment.property_id')
            ->leftJoin('orders_item', 'orders_item.property_id', '=', 'properties.id')
            ->leftJoin('users', 'users.id', '=', 'users_host_payment.host_id');

            return Datatables::of($data)
            ->addColumn('action', function ($data) 
            {
                if($data->paid == 0)
                {
                    return '<div class="btn-group pull-right"><a href="'.url('admin/host-payments/manage/'.$data->host_id).'" class="btn green btn-xs" title="Edit"><i class="fa fa-edit"></i> </a></div>';
                }
          
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
            ->editColumn('paid', '@if($paid == 1) <span class="label label-success">{{ "Paid"}} </span>  @else <span class="label label-danger">{{"Not Paid"}}</span> @endif')
            ->rawColumns(['action', 'paid'])
            ->make(true);
        }
        return view('admin.users.hosts.payment');
    }

    public function manageHostPayments($host_id = null)
    {

        $host_detail = User::select('*')
            ->where('type', '=', 1)
            ->where('id', '=', $host_id)
            ->first();

        if($host_detail)
        {
            $host_paid = UsersHostPayment::
            where('paid', '=', 1)->where('host_id', '=', $host_detail->id)
            ->sum('comm');

            $host_un_paid = UsersHostPayment::
            where('paid', '=', 0)->where('host_id', '=', $host_detail->id)
            ->sum('comm');

            return view('admin.users.hosts.manage-payment', ['host_detail' => $host_detail, 'host_paid' => $host_paid, 'host_un_paid' => $host_un_paid]);
        }
        else
        {
            echo "Something wrong!";
        }
        
    }


    public function doSaveHostPayments(Request $request)
    {

        $post = $request->all();

        $checkPayment = UsersHostPayment::select('*')
            ->where('host_id', '=', $post['host_id'])
            ->where('paid', '=', 0)
            ->first();

        if($checkPayment)
        {
            $uhpHistory_Item = new UsersHostPaymentHistory;
            $uhpHistory_Item->commission_paid = $post['host_un_paid'];
            $uhpHistory_Item->account_title = $post['account_title'];
            $uhpHistory_Item->account_iban = $post['account_iban'];
            $uhpHistory_Item->account_branch = $post['account_branch'];
            $uhpHistory_Item->account_city = $post['account_city'];
            $uhpHistory_Item->payment_type = $post['payment_type'];
            $uhpHistory_Item->payment_ref = $post['payment_ref'];
            $uhpHistory_Item->save();

            $arr = array('paid' => 1, 'uhph_id' => $uhpHistory_Item->id);
            UsersHostPayment::where('host_id', '=', $post['host_id'])->where('paid', '=', 0)->update($arr);

            return redirect('admin/host-payments')->with('success', 'Successfully Updated');
        }
        else
        {

            return redirect('admin/host-payments')->with('danger', 'Something wrong, We cannot update.');

        }
    }
}
