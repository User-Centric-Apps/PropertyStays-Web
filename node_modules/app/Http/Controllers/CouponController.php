<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Coupons;
use App\Models\CouponsUsed;
use DB;

class CouponController extends Controller
{
    public function __construct() 
    {
        $this->middleware(['auth']);
    }

    public function checkCoupon(Request $res)
    {
        $code = $res->input('code');

        $userId = Auth::user()->id;

        if(!$code){
            return ['error' => '<div class="alert alert-danger">Please Insert The Coupon Code </div>'];
        }

        $coupon = DB::table('coupons')
                ->where('code', $code)
                ->first();

        if(!$coupon) {
            return ['error' => '<div class="alert alert-danger">Wrong Coupon Code Entered</div>'];
        }

        $isUsed = DB::table('coupons_used')
                ->where('user_id', $userId)
                ->where('coupon_id', $coupon->id)
                ->exists();

        if($isUsed){
            return ['error' => '<div class="alert alert-warning">This Coupon Have Already Used</div>'];
        }

        return [
            'discount_price' => $coupon->price,
            'coupon_id' => $coupon->id,
            'msg' => '<div class="alert alert-success">Applied successfully!</div>'
        ];
    }

    public function redeemCoupon($coupon_id, $orderID)
    {

        $userId = Auth::user()->id;

        if($coupon_id)
        {
            $coupon = Coupons::where('id', $coupon_id)->first();

            if($coupon->coupon_type == 'One Time Use')
            {
                $isUsed = CouponsUsed::where('user_id', $userId)->where('coupon_id', $coupon->id)
                      ->exists();
                if(!$isUsed)
                {
                    DB::table('coupons_used')
                    ->insert([
                        'coupon_id' => $coupon->id,
                        'order_id' => $orderID,
                        'user_id' => $userId,
                        'category' => 'Orders',
                        'discount_price' => $coupon->price,
                        'date' => date('Y-m-d')
                    ]);

                    return 1;
                }
            }
            else
            {
                //Check the Coupon Limit in Many Time Use
                $couponLimit = CouponsUsed::where('coupon_id', $coupon->id)
                      ->count();

                //Check the User Per limit
                $userPerLimit = CouponsUsed::where('user_id', $userId)->where('coupon_id', $coupon->id)->count();   

                if($coupon->coupon_limit >= $couponLimit || $coupon->limit_per_user >= $userPerLimit)
                {
                    DB::table('coupons_used')
                    ->insert([
                        'coupon_id' => $coupon->id,
                        'order_id' => $orderID,
                        'user_id' => $userId,
                        'category' => 'Orders',
                        'discount_price' => $coupon->price,
                        'date' => date('Y-m-d')
                    ]);

                    return 1;
                }
            }
        }

        return 0; 
    }
}
