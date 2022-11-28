<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Orders;
use App\Models\OrdersItem;
use App\Models\Property;
use App\Http\Controllers\CouponController;
use Stripe;
use Session;
use App\Rules\ReCaptcha;
use Mail;
use Carbon\Carbon;
use App\Models\SettingsApp;

class OrderController extends Controller
{
    protected $CouponController;

    public function __construct(CouponController $CouponController) 
    {
        $this->middleware(['auth']);
        $this->CouponController = $CouponController;
    }

    public function createCart(Request $request)
    {
        $rules = array(
            'property_id' => 'required',
            'adults' => 'required',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        );
        $validation =  Validator::make($request->all(), $rules);
        if ($validation->fails())
        {
            return redirect()->back()->with('danger', 'Something wrong!');

        }
        else
        {
            $post = $request->all();

            $type = $post['type'];
            $propertyId = $post['property_id'];
            $property = Property::select('*')->where('id', '=', $propertyId)->first();

            if(Auth::user()->id == $property->user_id)
            {
                return redirect()->back()->with('danger', 'You cannot book your own property!');
            }
            
            $check_in = $post['check_in'];
            $adults = $post['adults'];
            $childrens = $post['childrens'];
            $infants = $post['infants'];

            if($type == 1)
            {
                $check_out = $post['check_out'];
                $total_nights = $post['total_nights'];

                if($property->discount_price)
                {
                    $pricess = $property->discount_price;
                }
                else
                {
                    $pricess = $property->original_price;
                }

                $adultsPrice = $pricess*Session::get('value');
                $Amount = $adultsPrice*$adults*$total_nights;
            }
            else
            {
                $check_out = '';
                $total_nights = '';

                $adultsPrice = $property->adults*Session::get('value');
                $childrensPrice = $property->children*Session::get('value');
                $infantsPrice = $property->infant*Session::get('value');

                $Amount = ($adultsPrice*$adults)+($childrensPrice*$childrens)+($infantsPrice*$infants);
            }
            
            Cart::add($property->id, $property->title, 1, $Amount, 0, ['type' => $post['type'], 'image' => $property->image, 'adults' => $adults, 'childrens' => $childrens, 'infants' => $infants, 'adultsprice' => $adultsPrice, 'check_in' => $check_in, 'check_out' => $check_out, 'total_nights' => $total_nights,'currency' => Session::get('currency')]);
        
            return redirect('checkout')->with('success',  __('Add to cart successfully, Please continue shopping OR go to top right corner for cart details.'));

        }
        
    }

    public function removePropertyFromCart($propertyId)
    {
        Cart::remove($propertyId);
        return redirect()->back()->with('success',  __('Product Removed successfully'));
    }

    public function destroyCart()
    {
        Cart::destroy();
        return redirect()->back()->with('success',  __('Cart Removed successfully'));
    }

    public function myCart()
    {
        return view('users.cart');
    }

    public function checkOut()
    {
        $settingApp = SettingsApp::select('comission')->first();
        return view('users.checkout', ['settingApp' => $settingApp]);
    }

    public function placeOrder(Request $request)
    {

        $rules = array(
            'billing_name' => 'required',
            'billing_email' => 'required',
            'billing_phone' => 'required',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        );
        $validation =  Validator::make($request->all(), $rules);
        if ($validation->fails())
        {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else
        {
            $post = $request->all();

            $abc = Orders::where('user_id', '=', Auth::user()->id)->whereBetween('created_at', [now()->subMinutes(1), now()])->first();

            if($abc)
            {
                return redirect()->back()->with('danger', 'You cannot repeat your action before 1 mintutes, Thank you ');
            }
            {

            $paid_bill = round($post['paid_bill']*100);

                try 
                {
                    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                    // Create a Customer:
                    $customer = Stripe\Customer::create(array(
                        'email' => $post['billing_email']
                    ));

                    $charge = Stripe\Charge::create ([
                            "amount" => $paid_bill,
                            "currency" => Session::get('currency'),
                            'source'  => $request->stripeToken
                    ]);

                    $Response_Status = $charge->status;

                    if($Response_Status == 'succeeded')
                    {

                        $ord =  new Orders;
                        $ord->user_id = Auth::user()->id;
                        $ord->total_bookings = Cart::count();
                        $ord->total_bill = $post['paid_bill'];// $charge->amount
                        $ord->payment_method = 'card';
                        if(isset($post['coupon_field_id']))
                        {
                            $ord->total_bill_before_coupon = $post['total_bill_before_coupon'];
                            //$ord->total_bill_before_wallet = $post['total_bill_before_wallet'];
                            $this->CouponController->redeemCoupon($post['coupon_field_id'], $ord->id);
                            $ord->coupon_id = $post['coupon_field_id'];
                        }
                        
                        $ord->status = $charge->status;
                        $ord->order_transaction = $charge->id;
                        $ord->balance_transaction = $charge->balance_transaction;
                        $ord->order_currency = $charge->currency;
                        //Billing
                        $ord->billing_name = $post['billing_name']; //$charge->billing_details->name;
                        $ord->billing_email = $post['billing_email']; //$charge->billing_details->email;
                        $ord->billing_phone = $post['billing_phone']; //$charge->billing_details->phone;
                        $ord->date = date('Y-m-d');
                        $ord->paid = 1;
                        $ord->save();

                        // Now, when iterating over the content of the cart, you can access the model.
                        foreach(Cart::content() as $row) 
                        {
                            $Order =  new OrdersItem;
                            $Order->order_id = $ord->id;
                            $Order->user_id = Auth::user()->id;
                            $Order->property_id = $row->id;
                            $Order->price = $row->price;

                            //Options
                            $Order->adults = ($row->options->has('adults') ? $row->options->adults : '');
                            $Order->childrens = ($row->options->has('childrens') ? $row->options->childrens : '');
                            $Order->infants = ($row->options->has('infants') ? $row->options->infants : '');

                            $Order->check_in = ($row->options->has('check_in') ? $row->options->check_in : '');
                            $Order->check_out = ($row->options->has('check_out') ? $row->options->check_out : '');
                            $Order->total_nights = ($row->options->has('total_nights') ? $row->options->total_nights : '');
                            //Options

                            $Order->paid = 1;
                            $Order->status = 'Pending';
                            $Order->save();
                        }

                        Cart::destroy();
                        $this->emailPlaceOrder($ord->id, $ord->billing_name, $ord->billing_email);
                        return redirect('confirmation-order/'.$ord->id)->with('success', 'Payment has been successfully processed.');
                    }
                    else
                    {
                        return redirect()->back()->with('danger', 'Something wrong, Please try again later.');
                    }
                }
                catch (\Stripe\Exception\InvalidRequestException $e) 
                {
                  return redirect()->back()->with('danger', $e->getError()->message);
                }

            }

        }
    }

    public function confirmationOrder($order_id)
    {
        $orderList = OrdersItem::select('orders_item.order_id', 'orders_item.adults', 'orders_item.childrens', 'orders_item.infants', 'orders_item.check_in', 'orders_item.check_out', 'orders_item.total_nights', 'orders_item.price', 'properties.title', 'properties.original_price', 'properties.image', 'properties.area', 'properties.slug', 'users.name', 'uhost.name as hostname')
            ->leftjoin('properties', 'properties.id', '=', 'orders_item.property_id')
            ->leftjoin('users', 'users.id', '=', 'orders_item.user_id')
            ->leftjoin('users as uhost', 'uhost.id', '=', 'properties.user_id')
            ->where('orders_item.order_id', '=', $order_id)
            ->get();
        if(count($orderList) > 0)
        {
            $settingApp = SettingsApp::select('comission')->first();
            return view('users.confirmation', ['orderList' => $orderList, 'order_id' => $order_id, 'settingApp' => $settingApp]);
        }
        else
        {
            return 'Something wrong,please try again later.';
        }
    }

    public function RecieveResultMethod(Request $request)
    {
        $post = $request->only('c');
        $encryptedData=$post['c'];

        $decryptedData = $this->decrypt($encryptedData, "C59MBLSBOQVFDRQ");

        $read= simplexml_load_string($decryptedData);
        $ResponseMsg = $read->Header[0]->ResponseMsg;
        $OrderID = $read->Body[0]->PaymentInformation[0]->OrderID;
        $paymentdate = $read->Body[0]->PaymentInformation[0]->PaymentDate;
        $paymenttime = $read->Body[0]->PaymentInformation[0]->PaymentTime;

        //echo $OrderID;

        if($ResponseMsg == 'success')
        {
            Cart::destroy();
            $value_update = array('payment_status' => $ResponseMsg);
            OrdersPayment::where('order_id', '=', $OrderID)->update($value_update);

            $update_payment_type = array('payment_type' => 'card');
            Orders::where('id', '=', $OrderID)->update($update_payment_type);
            SubOrders::where('oid', '=', $OrderID)->update($update_payment_type);

            $this->sendEmail('Received', $OrderID, Auth::user()->email, Auth::user()->name);
            return view('payment.RecieveResult', ['ResponseMsg' =>$ResponseMsg, 'OrderID' =>$OrderID, 'paymentdate' =>$paymentdate, 'paymenttime' =>$paymenttime]);
        }
        else
        {
            Orders::where('id','=', $OrderID)->delete();
            OrdersPayment::where('order_id','=', $OrderID)->delete();

            $sublist = SubOrders::select("*")->where('oid', '=', $OrderID)->get();

            foreach($sublist as $row) 
            {

                $get_ProductsSize = ProductsSize::select('*')->where('pid', '=', $row->pid)->where('size', '=', $row->size)->first();
                if($get_ProductsSize)
                {
                    $get_ProductsSize->remaining = (int)$get_ProductsSize->remaining+(int)$row->quantity;
                    $get_ProductsSize->save();                
                }
                SubOrders::where('oid','=', $OrderID)->delete();
            }
            return redirect('checkout')->with('danger', 'payment unsuccessful due to '.$ResponseMsg.', Please try again or choose cash payment method!');
        }

          

        
    }

    public function myOrders()
    {
        $data = Orders::select('orders.id', 'orders.status', 'orders.order_transaction', 'orders.total_bill', 'orders.quantity', 'orders.payment_method', 'orders.area_type', 'orders.created_at')
        ->where('orders.user_id', '=', Auth::user()->id)
        ->orderBy('orders.created_at', 'DESC')
        ->get();
        return view('user.myorders', ['data' => $data]);
    }

    public function manageOrder($order_id = null)
    {

        
        $orders = array();
        $orders = Orders::select('id', 'orders.status', 'orders.area_type', 'orders.area', 'orders.street', 'orders.building', 'orders.flat', 'orders.landmark', 'orders.latitude', 'orders.longitude', 'orders.special_note', 'orders.collection_date')
        ->where('user_id', '=', Auth::user()->id)
        ->where('id', '=', $order_id)
        ->first();

        if($orders->status == 'User-Cancelled')
        {
            return redirect()->back()->with('danger', 'You cannot modify the order !');
        }

        $orderDetails = array();
        $orderDetails = OrdersItem::select('orders_item.quantity', 'orders_item.color', 'orders_item.status', 'orders_item.quantity', 'products.title', 'products.image')
        ->leftjoin('products', 'products.id', '=', 'orders_item.product_id')
        ->where('orders_item.user_id', '=', Auth::user()->id)
        ->where('orders_item.order_id', '=', $order_id)
        ->get();

        return view('user.myorder-change', ['orders' => $orders, 'orderDetails' => $orderDetails]);
    }

    public function doSaveUpdateOrder(Request $request)
    {

        $post = $request->all();

        $validator = Validator::make($request->all(), [

            'id' => 'required',
            'collection_date' => 'required',
            'special_note' => 'required',

        ]);
        
        if ($validator->passes()) 
        {

            if($post['id'])
            {
                $order = Orders::find($post['id']);

                $order->area = $post['area'];
                $order->street = $post['street'];
                $order->building = $post['building'];
                $order->flat = $post['flat'];
                $order->landmark = $post['landmark'];
                $order->latitude = $post['latitude'];
                $order->longitude = $post['longitude'];
                $order->special_note = $post['special_note'];
                $order->collection_date = $post['collection_date'];
                $order->save();

                //$this->sendEmail('Received', $order->oid, Auth::user()->email, Auth::user()->name);

                return redirect('my-order/change-location/'.$order->id)->with('success', 'updated successfully');

            }

        }
        else
        {
            return redirect()->back()->with(['error'=>$validator->errors()->all()]);
        }


       

    }

    public function cancelOrder($order_id)
    {
        if($order_id)
        {
            //$this->sendEmail('Cancelled', $OiD, Auth::user()->email, Auth::user()->name);
            $variable = array('status' => 'User-Cancelled');
            Orders::where('id', '=', $order_id)->update($variable);
            OrdersItem::where('order_id', '=', $order_id)->update($variable);
        }

        return redirect()->back()->with('danger', 'Order Cancelled successfully');    
    }

    public function mySubOrders($order_id)
    {
        $data = OrdersItem::select('orders_item.quantity', 'orders_item.color', 'orders_item.size', 'orders_item.price', 'orders_item.status', 'orders_item.paid', 'products.title', 'products.image')
        ->leftjoin('products', 'products.id', '=', 'orders_item.product_id')
        ->where('orders_item.user_id', '=', Auth::user()->id)
        ->where('orders_item.order_id', '=', $order_id)
        ->orderBy('orders_item.created_at', 'DESC')
        ->get();
        return view('user.mysuborders', ['data' => $data, 'order_id' => $order_id]);
    }

    public function cancelSubOrder($sub_order_id)
    {
        $suborder = OrdersItem::findOrFail($sub_order_id);
        $suborder->status = 'User-Cancelled';
        $suborder->save();

        //$this->sendEmail('Cancelled', $suborder->oid, Auth::user()->email, Auth::user()->name);

        return redirect()->back()->with('danger', 'Order Cancelled successfully');    
    }

    public function myInvoice($id)
    {
        $get_Order = Orders::select('*')->where('id', '=', $id)->first();

        if($get_Order)
        {
            $subordr = SubOrders::select('suborders.oid', 'suborders.quantity', 'suborders.payment', 'suborders.size', 'suborders.student_name', 'users.name', 'products.name as pname')->leftjoin('products', 'products.id', '=', 'suborders.pid')->leftjoin('users', 'users.id', '=', 'suborders.uid')->where('suborders.oid', '=', $id)->get();

            return view('user.myinvoice', ['get_Order' => $get_Order, 'subordr' => $subordr]);
        }
        else
        {
            return redirect()->back()->with('danger', 'Some error in Invoice, Please try again later!'); 
        }
        

           
    }



    public function emailPlaceOrder($orderID, $customerName, $customerEmail)
    {

        if($orderID)
        {
            $orderList = OrdersItem::select('orders_item.order_id', 'orders_item.adults', 'orders_item.childrens', 'orders_item.infants', 'orders_item.check_in', 'orders_item.check_out', 'orders_item.total_nights', 'orders_item.price', 'properties.title', 'properties.original_price', 'properties.image', 'properties.area', 'properties.slug', 'users.name', 'uhost.name as hostname')
            ->leftjoin('properties', 'properties.id', '=', 'orders_item.property_id')
            ->leftjoin('users', 'users.id', '=', 'orders_item.user_id')
            ->leftjoin('users as uhost', 'uhost.id', '=', 'properties.user_id')
            ->where('orders_item.order_id', '=', $orderID)->get();

            $subject = 'Status for order #'.$orderID;

            if($orderList)
            {
                $data = array('orderID' => $orderID, 'customerName' => $customerName, 'orderList' => $orderList);
                Mail::send('emails/booking', $data, function($message) use ($customerEmail, $subject) {
                      $message->from('info@propertystays.com', 'PropertyStays.com');
                      $message->to($customerEmail)->subject($subject);
                });
            }
            
        }

        
    }
}
