<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;

class StripeController extends Controller
{
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose phpcodingstuff.com"
        ]);
   
        Session::flash('success', 'Payment successful!');
           
        return back();
    }

    public function handleGet()
    {
        return view('general.stripe');
    }
  
    public function handlePost(Request $request)
    {
        
        try 
        {
            Stripe\Stripe::setApiKey('sk_test_51JP2q5HtoAefYlJfW4PzSQTiFgvmddmLZfUIKxnNKAoOxlhmsYmxC3SYNvl1bYOitE0PwjoOk874RIrYa7DjzHoH00JmYOKDmS');
            // Create a Customer:
            $customer = Customer::create(array(
                'email' => "danishah72@gmail.com",
                'source'  => $request->stripeToken
            ));

            $charge = Stripe\Charge::create ([
                    "amount" => 100 * 150,
                    "currency" => Session::get('currency'),
                    "description" => "Online Payment" 
            ]);

            $Response_Status = $charge->status;

            if($Response_Status == 'succeeded')
            {
                $Response_TID = $charge->id;
                $Response_Object = $charge->object;
                $Response_Amount = $charge->amount;
                $Response_Transaction = $charge->balance_transaction;
                $Response_Currency = $charge->currency;
                $Response_email = $charge->billing_details->email;
                $Response_name = $charge->billing_details->name;
                $Response_phone = $charge->billing_details->phone;
                Session::flash('success', 'Payment has been successfully processed.');
            }
            else
            {
                Session::flash('success', 'Something wrong, Please try again later.');
            }
            
  
        }
        catch (\Stripe\Exception\InvalidRequestException $e) 
        {
          // Invalid parameters were supplied to Stripe's API
            Session::flash('success', $e->getError()->message);
        } 
          
        return back();
    }
}
