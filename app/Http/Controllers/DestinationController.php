<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Property;
use App\Models\PropertiesImages;
use App\Models\PropertiesAmenities;
use App\Models\Feedback;
use App\Models\Pages;
use DB;
use Mail;
use Artisan;
use Session;

class DestinationController extends Controller
{

    public function destination(Request $request)
    {
        $item = Pages::select('*')->where('id', '=', 9)->first();

        $tops = City::with(['properties'])->where('top', '=', 1)->where('country_id', '=', 1)->limit(20)->get();
        $others = City::with(['properties'])->where('top', '=', 0)->where('country_id', '=', 1)->limit(20)->get();
        $worldwide = City::with(['properties'])->where('country_id', '!=', 1)->get();
        return view('destinations.destination', ['tops' => $tops, 'others' => $others, 'worldwide' => $worldwide, 'item' => $item]);
    }

    public function destinationMoreLocation(Request $request)
    {
        $item = Pages::select('*')->where('id', '=', 9)->first();
        
        $items = City::with(['properties']);

        $items = $items->groupBy('id')->paginate(12);;

        return view('destinations.view-alldestinations', ['items' => $items, 'item' => $item]);
        
    }

    public function destinationLocations($slug = null)
    {
        if($slug)
        {
            $cityitem = City::select('*')->where('slug', '=', $slug)->first();

            $properties = array();
            $properties = Property::select('*')
            ->where('type', '=', 1)
            ->where('city_id', '=', $cityitem->id)
            ->get();

            $tours = array();
            $tours = Property::select('*')
            ->where('type', '=', 2)
            ->where('city_id', '=', $cityitem->id)
            ->get();

            return view('destinations.locations', ['cityitem' => $cityitem, 'properties' => $properties, 'tours' => $tours]);
        }
        else
        {
            echo "Something wrong";
        }
        
    }

    public function rentalDetails($slug = null)
    {
        if(!Session::has('currency'))
        {
            Session::put('value', 1);
            Session::put('currency', 'gbp');
        }
        if($slug)
        {

            $item = array();
            $item = Property::select('properties.*', 'users.name', 'users.joined', 'users.profile_pic')
            ->leftJoin('users', 'users.id', '=', 'properties.user_id')
            ->where('properties.slug', '=', $slug)
            ->first();

            $item_images = array();
            $item_images = PropertiesImages::select('*')
            ->where('property_id', '=', $item->id)
            ->get();

            $item_amenities = array();
            $item_amenities = PropertiesAmenities::select('amenities.name', 'amenities.image')
            ->leftJoin('amenities', 'amenities.id', '=', 'properties_amenities.amenity_id')
            ->where('properties_amenities.property_id', '=', $item->id)
            ->get();

            $feedback = array();
            $feedback = Feedback::select('feedback.*', 'users.name')
            ->leftJoin('users', 'users.id', '=', 'feedback.user_id')
            ->where('feedback.property_id', '=', $item->id)
            ->where('feedback.type', '=', 'Property')
            ->where('feedback.status', '=', 1)
            ->get();
            
            return view('destinations.single-rental-detail', ['item' => $item, 'item_images' => $item_images, 'item_amenities' => $item_amenities, 'feedback' => $feedback]);
        }
        else
        {
            echo "Something wrong";
        }
    }

    public function searchProperty(Request $request)
    {
        if(!Session::has('currency'))
        {
            Session::put('value', 1);
            Session::put('currency', 'gbp');
        }
        $post = array();

        $properties = new Property;

        if($request->has('location'))
        {
            $post['location'] = $request->get('location');
        }

        if($request->has('adults'))
        {
            $post['adults'] = $request->get('adults');
        }
        
        if($request->has('bed'))
        {
            $post['bed'] = $request->get('bed');
        }
        
        if($request->has('bath'))
        {
            $post['bath'] = $request->get('bath');
        }

        if($request->has('childrens'))
        {
            $post['childrens'] = $request->get('childrens');
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
            $properties = $properties->propertyLists($post, $sort_by, $order_by);
        }
        else
        {
            $properties = $properties->propertyLists($post);
        }



        $properties->appends($request->except('page'));

        return view('destinations.searchproperty', compact('properties'));
        
    }
}
