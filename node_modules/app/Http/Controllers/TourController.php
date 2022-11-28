<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertiesImages;
use App\Models\Feedback;
use App\Models\PropertiesBookingEnquiry;
use Illuminate\Support\Facades\Validator;
use DB;
use Mail;
use App\Rules\ReCaptcha;

class TourController extends Controller
{

    public function tours(Request $request)
    {
        $post = array();

        $tours = new Property;

        if($request->has('location'))
        {
            $post['location'] = $request->get('location');
        }

        if($request->has('min_price'))
        {
            $post['min_price'] = $request->get('min_price');
            $post['max_price'] = $request->get('max_price');
        }

        if($request->has('keywords'))
        {
            $post['keywords'] = $request->get('keywords');
        }

        if($request->has('orderby'))
        {
            if($request->get('orderby') == 'high_p')
            {
                $order_by = 'desc';
                $sort_by = 'original_price';
            } 
            else if($request->get('orderby') == 'low_p') 
            {
                $order_by = 'asc';
                $sort_by = 'original_price';
            } 
            else if($request->get('orderby') == 'old') 
            {
                $order_by = 'asc';
                $sort_by = 'id';
            } 
            else 
            {
                $order_by = 'desc';
                $sort_by = 'id';
            }
            $tours = $tours->tourLists($post, $sort_by, $order_by);
        }
        else
        {
            $tours = $tours->tourLists($post);
        }

        $tours->appends($request->except('page'));

        return view('tours.tour-list', compact('tours'));
    }

    public function tourDetails($slug = null)
    {
        if($slug)
        {
            $item = array();
            $item = Property::select('properties.*', 'countries.cname', 'cities.cityname', 'users.name')
            ->where('properties.slug', '=', $slug)
            ->leftJoin('countries', 'countries.id', '=', 'properties.country_id')
            ->leftJoin('cities', 'cities.id', '=', 'properties.city_id')
            ->leftJoin('users', 'users.id', '=', 'properties.user_id')
            ->where('countries.status', '=', 1)
            ->first();

            $item_images = array();
            $item_images = PropertiesImages::select('*')
            ->where('property_id', '=', $item->id)
            ->get();

            $feedback = array();
            $feedback = Feedback::select('feedback.*', 'users.name')
            ->leftJoin('users', 'users.id', '=', 'feedback.user_id')
            ->where('feedback.property_id', '=', $item->id)
            ->where('feedback.type', '=', 'Tour')
            ->where('feedback.status', '=', 1)
            ->get();

            return view('tours.detail', ['item_images' => $item_images, 'item' => $item, 'feedback' => $feedback]);
        }
        else
        {
            echo "Tour not found!";
        }
    }

    public function doSaveEnquiryBooking(Request $request)
    {

        $rules = array(
            'property_id' => 'required',
            'email' => 'required',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        );

        $post = $request->all();

        $validation =  Validator::make($request->all(), $rules);

        if($validation->fails())
        {
            return redirect()->back()->withInput($request->all())->withErrors($validation);
        } 
        else 
        {

            $Comment =  PropertiesBookingEnquiry::where('property_id', '=', $post['property_id'])
            ->where('email', '=', $post['email'])
            ->where('enquiry_type', '=', $post['enquiry_type'])
            ->first();

            if($Comment == null)
            {
                $item = new PropertiesBookingEnquiry;
                $item->property_id = $post['property_id'];
                $item->name = $post['name'];
                $item->email = $post['email'];
                $item->mobile = $post['mobile'];
                $item->date = $post['date'];
                $item->traveller = $post['traveller'];
                $item->description = $post['description'];
                $item->enquiry_type = $post['enquiry_type'];
                $item->save();

                return redirect()->back()->with('success_msg', 'You successfully sent enquiry! Thank you!');
            }
            else
            {
                return redirect()->back()->with('danger_msg', 'You already enquired for this Property!');
            }
        }
    }

}
