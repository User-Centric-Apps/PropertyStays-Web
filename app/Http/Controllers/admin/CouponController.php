<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Yajra\Datatables\Datatables;
use App\Models\Coupons;
use App\Models\CouponsUsed;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use File;
use Session;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        if(request()->ajax())
        {
            $data = Coupons::select('coupons.id', 'name', 'code', 'discount_type', 'price', 'coupon_type' ,'validity', 'status', DB::raw("count(cu.coupon_id) as numc"), 'coupons.created_at')
            ->leftJoin('coupons_used as cu','coupons.id','=','cu.coupon_id')
            ->groupBy('coupons.id');

            return Datatables::of($data)
                ->addColumn('action', function ($data) 
                {

                    $abc = '';

                      $abc .= '<a href="'.url('admin/coupons/users-list/'.$data->id).'" class="btn blue btn-xs"><i class="fa fa-user"></i> </a>';

                      $abc .= '<a href="'.url('admin/coupons/manage/'.$data->id).'" class="btn green btn-xs" title="Edit"><i class="fa fa-edit"></i> </a>';


                      $abc .= '<button id="'.$data->id.'" class="delete btn red btn-xs" title="Delete"  ><i class="fa fa-times"></i> </button>';

                   

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
                ->editColumn('status', '<a href="{{url("admin/coupons/update-status/$id")}}"> @if($status == 1) <span class="label label-success">Active</span>  @else <span class="label label-danger">In Active</span> @endif </a>')
              ->rawColumns(['action', 'status'])
              ->make(true);
        }
        return view('admin.coupons.index');
    }

    public function manageCoupon($id = null)
    {
        $coupons = array();
        $coupons = Coupons::select('*')->where('id', '=', $id)->first();
        return view('admin.coupons.manage', ['coupons' => $coupons]);
    }


    public function doSaveCoupon(Request $request)
    {

        $post = $request->all();
        
        $coupon = new Coupons;

        if($post['id'])
        {
            $id = intval($post['id']);
            $coupon = $coupon->find($id);
            if($coupon->count() > 0)
            {
                
                $coupon->name = $post['name'];
                if($coupon->code != $post['code'])
                {
                    $couponVal = Coupons::where('code', '=', $post['code'])->first();
                    if($couponVal)
                    {
                        return redirect()->back()->with('danger', 'Code already exist!');
                    }
                    else
                    {
                        $coupon->code = $post['code'];
                    }
                }
                $coupon->category = $post['category'];
                $coupon->discount_type = $post['discount_type'];
                $coupon->max_value = $post['max_value'];
                $coupon->price = $post['price'];
                $coupon->validity = $post['validity'];
                $coupon->status = $post['status'];
                $coupon->coupon_affiliate = 0;
                $coupon->coupon_type = $post['coupon_type'];
                if($post['coupon_type']=='One Time Use')
                {
                  $coupon->coupon_limit = 0;
                }
                else
                {
                  $coupon->coupon_limit = $post['coupon_limit'];
                  $coupon->limit_per_user = $post['limit_per_user'];
                }
                $coupon->save();

                return redirect('admin/coupons')->with('success', 'Successfully Updated');
            }
        }
        else
        {
            //Adding for New User

            $rules = array(
            'name' => 'required|max:255',
            'code' => 'required|string|unique:coupons',
            );

            $validation =  Validator::make($request->all(), $rules);
                
            if($validation->fails())
            {
                return redirect()->back()->withInput($request->all())->withErrors($validation);
            } 
            else 
            {
                $coupon = new Coupons;
                $coupon->name = $post['name'];
                $coupon->code = $post['code'];
                $coupon->discount_type = $post['discount_type'];
                $coupon->max_value = $post['max_value'];
                $coupon->price = $post['price'];
                $coupon->validity = $post['validity'];
                $coupon->status = $post['status'];
                $coupon->coupon_affiliate = 0;
                $coupon->coupon_type = $post['coupon_type'];
                if($post['coupon_type']=='One Time Use')
                {
                  $coupon->coupon_limit = 0;
                }
                else
                {
                  $coupon->coupon_limit = $post['coupon_limit'];
                  $coupon->limit_per_user = $post['limit_per_user'];
                }
                $coupon->save();

                return redirect('admin/coupons')->with('success', 'Successfully Updated');

            }
         }
    }

    public function destroyCoupon($id)
    {
        $data = Coupons::findOrFail($id);
        $data->delete();
    }

    public function doUpdateCouponStatus($id)
    {
        $coupon = Coupons::find($id);
          if($coupon->status == 1)
               $coupon->status = 0;
            else
               $coupon->status = 1;
            $coupon->save();
          return redirect('admin/coupons')->with('success', 'Coupon status changed successfully!');
    }

    public function getCouponUsers($id)
    {
      $data = CouponsUsed::select('coupons_used.id','coupons_used.date','u.firstname','u.email','u.mobile')
      ->leftJoin('users as u','coupons_used.user_id','=','u.id')
      ->where('coupons_used.coupon_id', '=', $id)
      ->get();
      return view('admin.coupons.userinfo', ['data'=>$data]);
    }
}
