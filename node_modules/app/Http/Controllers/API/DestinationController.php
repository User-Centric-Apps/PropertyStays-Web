<?php
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\City;
use App\Models\Property;
use App\Models\PropertiesImages;
use App\Models\PropertiesAmenities;
use App\Models\Feedback;
use App\Models\Pages;
use App\Models\Amenity;
use App\Models\Suitable;
use URL;
use DB;
use Illuminate\Support\Str;
   
class DestinationController extends BaseController
{

    public function getTopLoc(Request $request)
    {
        $top = City::with(['properties'])
            ->where('top', '=', 1)
            ->where('country_id', '=', 1)
            ->skip(0)
            ->take(10)
            ->get();

        $result = array();
        foreach($top as $item)
        {
            $price = rand(15,99);
            $image = URL::asset('storage/app/public/uploads/cities/'.$item->image);

            $result[] = array(
                "id" => $item->id,
                "title" => $item->cityname,
                'image' => $image,
                'average' => $item->properties->count(),
                'rating' => 0,
            );
        }

        return $this->sendResponse($result, 'getTopLoc fetched.');
    }

    public function getAllLoc(Request $request)
    {
        $top = City::with(['properties'])
            ->where('country_id', '=', 1)->has('properties')
            ->orderBy('cityname', 'asc')
            ->get();

        $result = array();
        foreach($top as $item)
        {
            $price = rand(15,99);
            $image = URL::asset('storage/app/public/uploads/cities/'.$item->image);
            $result[] = array(
                "id" => $item->id,
                "title" => $item->cityname,
                'image' => $image,
                'average' => $item->properties->count(),
            );
        }

        return $this->sendResponse($result, 'getAllLoc fetched.');
    }

    public function getLocationAll(Request $request)
    {
        $top = City::where('country_id', '=', 1)
            ->orderBy('cityname', 'asc')
            ->get();

        $result = array();
        foreach($top as $item)
        {
            $price = rand(15,99);
            $image = URL::asset('storage/app/public/uploads/cities/'.$item->image);
            $result[] = array(
                "id" => $item->id,
                "title" => $item->cityname,
                'image' => $image,
                'average' => $item->properties->count(),
            );
        }

        return $this->sendResponse($result, 'getAllLoc fetched.');
    }

    public function getHomes(Request $request)
    {
        $token = $request->get('token');

        if($token != 0)
        {
            $getHomes = Property::select('properties.id', 'properties.title', 'properties.image', 'properties.description', 'properties.original_price', DB::raw("(SELECT '1' FROM wishlists WHERE user_id=$token and property_id=properties.id) as isInFavorite"), 'properties.adults', 'properties.bed', 'properties.bath')
            //->leftJoin('feedback', 'feedback.property_id', '=', 'properties.id')
            ->where('properties.type', '=', 1)
            ->skip(0)
            ->take(10)
            ->get();

            if(count($getHomes) == 0)
            {
                $getHomes = Property::select('properties.id', 'properties.title', 'properties.image', 'properties.description', 'properties.original_price', 'cancellation as isInFavorite', 'properties.adults', 'properties.bed', 'properties.bath', 'properties.featured')
                ->where('properties.type', '=', 1)
                ->where('properties.featured', '=', 1)
                ->skip(0)
                ->take(10)
                ->get();
            }
        }
        else
        {
            $getHomes = Property::select('properties.id', 'properties.title', 'properties.image', 'properties.description', 'properties.original_price', 'cancellation as isInFavorite', 'properties.adults', 'properties.bed', 'properties.bath', 'properties.featured')
            ->where('properties.type', '=', 1)
            ->where('properties.featured', '=', 1)
            ->skip(0)
            ->take(10)
            ->get();
        }

        $result = array();
        foreach($getHomes as $item)
        {
            $image = URL::asset('storage/app/public/uploads/properties/'.$item->image);

            if($item->isInFavorite == null)
            {
                $item->isInFavorite = 0;
            }
            
            $result[] = array(
                "id" => $item->id,
                "title" => Str::words(strip_tags($item->title), 10,'...'),
                'image' => $image,
                'price' => '£'.$item->original_price,
                'rating' => 0,
                'reviews' => 0,
                'featured' => $item->featured,
                'review_desc' => 'Right',
                'isInFavorite' => $item->isInFavorite
            );
        }
        return $this->sendResponse($result, 'getHomes fetched.');
    }

    public function getTour(Request $request)
    {
        $getTour = Property::where('featured', '=', 1)
        ->where('type', '=', 2)->skip(0)->take(10)->get();

        $result = array();
        foreach($getTour as $item)
        {
            $image = URL::asset('storage/app/public/uploads/tours/'.$item->image);
            $result[]   =   array(
                "id" => $item->id,
                "title" => Str::words(strip_tags($item->title), 10,'...'),
                'image' => $image,
                "description" => preg_replace("/\r|\n/", "", strip_tags($item->description)),
                'price' => '£'.$item->adults,
                'reviews' => '0 reviews',
            );
        }

        return $this->sendResponse($result, 'getTour fetched.');
    }

    public function getTours(Request $request)
    {
        $getTours = Property::where('featured', '=', 1)
        ->where('type', '=', 2)->get();

        $result = array();
        foreach($getTours as $item)
        {
            $image = URL::asset('storage/app/public/uploads/tours/'.$item->image);
            $result[]   =   array(
                "id" => $item->id,
                "title" => Str::words(strip_tags($item->title), 10,'...'),
                'image' => $image,
                "description" => preg_replace("/\r|\n/", "", strip_tags($item->description)),
                'price' => '£'.$item->adults,
                'reviews' => '0 reviews',
            );
        }

        return response()->json($result, 200);
    }

    public function getLastMinute(Request $request)
    {
        $token = $request->get('token');

        if($token != 0)
        {
            $getLastMinute = Property::select('properties.id', 'properties.title', 'properties.image', 'properties.description', 'properties.original_price', DB::raw("(SELECT '1' FROM wishlists WHERE user_id=$token and property_id=properties.id) as isInFavorite"), 'properties.adults', 'properties.bed', 'properties.bath')
                ->where('properties.featured', '=', 1)
            //->leftJoin('feedback', 'feedback.property_id', '=', 'properties.id')
            ->where('properties.type', '=', 1)
            ->skip(0)
            ->take(7)
            ->get();

            if(count($getLastMinute) == 0)
            {
                $getLastMinute = Property::select('properties.id', 'properties.title', 'properties.image', 'properties.description', 'properties.original_price', 'cancellation as isInFavorite', 'properties.adults', 'properties.bed', 'properties.bath', 'properties.featured')
                ->where('properties.type', '=', 1)
                ->where('properties.featured', '=', 1)
                ->skip(0)
                ->take(7)
                ->get();
            }
        }
        else
        {
            $getLastMinute = Property::select('properties.id', 'properties.title', 'properties.image', 'properties.description', 'properties.original_price', 'cancellation as isInFavorite', 'properties.adults', 'properties.bed', 'properties.bath', 'properties.featured')
            ->where('properties.type', '=', 1)
            ->where('properties.featured', '=', 1)
            ->skip(0)
            ->take(7)
            ->get();
        }

        

        $result = array();
        foreach($getLastMinute as $item)
        {
            $image = URL::asset('storage/app/public/uploads/properties/'.$item->image);
            $images = array();
            $image_array = PropertiesImages::select('image')->where('property_id', '=', $item->id)->skip(0)->take(5)->get();

            if(count($image_array) > 0)
            {
                foreach($image_array as $img)
                {
                    $images[] = URL::asset('storage/app/public/uploads/properties/'.$img->image);
                }
            }
            else
            {
                $images = array();
            }

            if($item->isInFavorite == null)
            {
                $item->isInFavorite = 0;
            }

            $result[]   =   array(
                "id" => $item->id,
                "title" => Str::words(strip_tags($item->title), 10,'...'),
                "isInFavorite" => $item->isInFavorite,
                'image' => $image,
                'images' => $images,
                "description" => preg_replace("/\r|\n/", "", strip_tags($item->description)),
                'price' => '£'.$item->original_price,
                'bed' => $item->bed,
                'bath' => $item->bath,
                'adults' => $item->adults,
                'featured' => $item->featured,
                'rating' => 0,
                'reviews' => '0 reviews',
            );
        }

        return $this->sendResponse($result, 'getLastMinute fetched.');
    }

    public function findCity(Request $request)
    {
        $token = $request->get('token');
        $places     =   $locations      =   $tours  =   array();
        $city_id = $request->get('loc_id');

        $cityDetail = City::where('id', '=', $city_id)->first();

        if($cityDetail)
        {
            if($token != 0)
            {
                $getPlaces = Property::select('properties.id', 'properties.title', 'properties.image', 'properties.description', 'properties.original_price', 'properties.adults', 'properties.bed', 'properties.bath', DB::raw("(SELECT '1' FROM wishlists WHERE user_id=$token and property_id=properties.id) as isInFavorite"))
                    ->where('type', '=', 1)
                    ->where('city_id', '=', $city_id)
                    ->get();
            }
            else
            {
                $getPlaces = Property::select('properties.id', 'properties.title', 'properties.image', 'properties.description', 'properties.original_price', 'cancellation as isInFavorite', 'properties.adults', 'properties.bed', 'properties.bath', 'properties.featured')
                    ->where('type', '=', 1)
                    ->where('city_id', '=', $city_id)
                    ->get();
            }  

            foreach($getPlaces as $item)
            {
                
                if($item->image){
                    $image = URL::asset('storage/app/public/uploads/properties/'.$item->image);
                }else{
                    $image  =   null;
                }
                $price      =   $item->original_price;
                $type       =   'Rental';

                if($item->isInFavorite == null)
                {
                    $item->isInFavorite = 0;
                }

                $places[]   =   array(
                    "id" => $item->id,
                    "title" => Str::words(strip_tags($item->title), 10,'...'),
                    "details" => Str::words(strip_tags($item->description), 7,'...'),
                    'image' => $image,
                    'isInFavorite' => $item->isInFavorite,
                    'bed' => $item->bed,
                    'bath' => $item->bath,
                    'adults' => $item->adults,
                    'featured' => $item->featured,
                    'price' => '£'.$price,
                    'rating' => 0,
                    'reviews' => '0 reviews',
                );
                if(isset($item->latitude) && $item->longitude != '')
                {
                    $locations[] = array(
                        'lat' => $item->latitude,
                        'lng' => $item->longitude,
                    );
                }
            }

            $getTours = Property::where('type', '=', 2)
            ->where('city_id', '=', $city_id)
            ->get();

            foreach($getTours as $item)
            {
                
                if($item->image){
                    $image = URL::asset('storage/app/public/uploads/tours/'.$item->image);
                }else{
                    $image  =   null;
                }
                $price      =   $item->original_price;
                $type       =   'Tour';

                $tours[]   =   array(
                    "id" => $item->id,
                    "title" => Str::words(strip_tags($item->title), 10,'...'),
                    "details" => Str::words(strip_tags($item->description), 7,'...'),
                    'image' => $image,
                    'price' => 'Book for £'.$price.' p/p',
                );
                if($item->latitude!=0 && $item->longitude != '')
                {
                    $locations[] = array(
                        'lat' => $item->latitude,
                        'lng' => $item->longitude,
                    );
                }
            }

            $images = array();

            if($cityDetail->image_side1)
            {
                array_push($images, URL::asset('storage/app/public/uploads/cities/'.$cityDetail->image_side1));
            }
            if($cityDetail->image_side2)
            {
                array_push($images, URL::asset('storage/app/public/uploads/cities/'.$cityDetail->image_side2));
            }
            if($cityDetail->image_side3)
            {
                array_push($images, URL::asset('storage/app/public/uploads/cities/'.$cityDetail->image_side3));
            }
            if($cityDetail->image_side4)
            {
                array_push($images, URL::asset('storage/app/public/uploads/cities/'.$cityDetail->image_side4));
            }
            if($cityDetail->image_side5)
            {
                array_push($images, URL::asset('storage/app/public/uploads/cities/'.$cityDetail->image_side5));
            }

            $result[]   =   array(
                "id" => $cityDetail->id,
                "title" => $cityDetail->cityname,
                'images'=> $images,
                'content' => $cityDetail->description,
                'places'=> $places,
                'locations' => $locations,
                'tours' => $tours
            );
        }
        else
        {
            $result[]   =   array(
                "id" => $request->all(),
                "title" => "",
                'images'=> [],
                'content' => "",
                'places'=> [],
                'locations' => [],
                'tours' => []
            );
        }

        return response()->json($result);
    }

    public function propertyDetail(Request $request)
    {
        $token = $request->get('token');
        $property_id = $request->get('id');
        $tours  =   array();

        $item = array();

        if($token != 0)
        {
            $item = Property::select('properties.*', DB::raw("(SELECT '1' FROM wishlists WHERE user_id=$token and property_id=properties.id) as isInFavorite"), 'users.name', 'users.profile_pic')
            ->leftJoin('users', 'users.id', '=', 'properties.user_id')
            //->leftJoin('feedback', 'feedback.property_id', '=', 'properties.id')
            ->where('properties.id', '=', $property_id)->first();
        }
        else
        {
            $item = Property::select('properties.*', DB::raw("(SELECT '1' FROM wishlists WHERE property_id=properties.id) as isInFavorite"), 'users.name', 'users.profile_pic')
            ->leftJoin('users', 'users.id', '=', 'properties.user_id')
            ->where('properties.id', '=', $property_id)->first();
        }

        $item_images = array();
        $images = array();
        $item_amenities = array();
        $amenities_list = array();
        $feedback = array();

        if($item)
        {
            $item_images = PropertiesImages::select('*')
            ->where('property_id', '=', $item->id)
            ->get();
            if(count($item_images) > 0)
            {
                foreach($item_images as $img)
                {
                    if($img)
                    {
                        $image = URL::asset('storage/app/public/uploads/properties/'.$img->image);
                    }
                    else
                    {
                        $image = '';
                    }
                    
                    $images[]   =   array(
                        'image' => $image,
                    );
                }
            }

            $item_amenities = PropertiesAmenities::select('amenities.id', 'amenities.name', 'amenities.image')
            ->leftJoin('amenities', 'amenities.id', '=', 'properties_amenities.amenity_id')
            ->where('properties_amenities.property_id', '=', $item->id)
            ->get();

            if(count($item_amenities) > 0)
            {
                foreach($item_amenities as $amenitie)
                {
                    $amenities_list[]   = array(
                        'id' => $amenitie->id,
                        'name' => $amenitie->name,
                        'icon' => URL::asset('storage/app/public/uploads/amenities/'.$amenitie->image),
                    );
                }
            }

            $feedback = Feedback::select('feedback.*', 'users.name')
            ->leftJoin('users', 'users.id', '=', 'feedback.user_id')
            ->where('feedback.property_id', '=', $item->id)
            ->where('feedback.type', '=', 'Property')
            ->where('feedback.status', '=', 1)
            ->get();

            $totalFeedback = count($feedback);

            $Rating = Feedback::where('feedback.property_id', '=', $item->id)
            ->where('feedback.type', '=', 'Property')
            ->where('feedback.status', '=', 1)->sum('rating');

            if($totalFeedback > 0)
            {
                $totalRating = number_format($Rating/$totalFeedback, 0);
            }
            else
            {
                $totalRating = 0;
            }

            

        }

        if($item->profile_pic)
        {
            $avatar = URL::asset('storage/app/public/uploads/customers/'.$item->profile_pic);
        }
        else
        {
            $avatar = URL::asset('resources/assets/front-end/img/home/PropertyStays-icon.png');
        }

        if($item->isInFavorite == null)
        {
            $item->isInFavorite = 0;
        }
            
        $result = array(
            "id" => $item->id,
            "title" => $item->title,
            'image' => $images[0],
            'images' => $images,
            'isInFavorite' => $item->isInFavorite,
            'type' => 'rental',
            'location' => $item->area,
            'original_price' => $item->original_price,
            'price' => '£'.$item->original_price,
            'rating' => $totalRating,
            'reviews_count' => count($feedback),
            'owner' => array(
                'id' => $item->user_id,
                'name' => $item->name,
                'image' => $avatar,
            ),
            'amenities' => $amenities_list,
            'content' => $item->description,
            'featured' => $item->featured,
            'bedrooms' => $item->bed,
            'bath' => $item->bath,
            'adults' => $item->adults,
            'size' => $item->sqft,
            'url' => url('rental/'.$item->slug),
            "title" => $item->title,
            'ready_to_pay' => $item->ready_to_pay,
            'positions' => array(
                'lng' => $item->longitude,
                'lat' => $item->latitude,
            ),
        );

        return response()->json($result);
    }

    public function tourDetail(Request $request)
    {
        $token = $request->get('token');
        $tour_id = $request->get('tour_id');

        $item = array();
        $item = Property::select('properties.*', 'cities.cityname', 'users.name', 'users.profile_pic', DB::raw('count(feedback.property_id) as total_comments'))
        ->leftJoin('feedback', 'feedback.property_id', '=', 'properties.id')
        ->leftJoin('cities', 'cities.id', '=', 'properties.city_id')
        ->leftJoin('users', 'users.id', '=', 'properties.user_id')
        ->where('properties.id', '=', $tour_id)
        ->first();

        $item_images = array();
        $feedback = array();

        if($item)
        {
            $item_images = PropertiesImages::select('*')
            ->where('property_id', '=', $item->id)
            ->get();

            foreach($item_images as $img)
            {
                if($img)
                {
                    $image = URL::asset('storage/app/public/uploads/tours/'.$img->image);
                }
                else
                {
                    $image = '';
                }
                
                $images[]   =   array(
                    'image' => $image,
                );
            }

            $feedback = Feedback::select('feedback.*', 'users.name')
            ->leftJoin('users', 'users.id', '=', 'feedback.user_id')
            ->where('feedback.property_id', '=', $item->id)
            ->where('feedback.type', '=', 'Tour')
            ->where('feedback.status', '=', 1)
            ->get();
        }
        
        $isInFavorite = 1;

        if($item->profile_pic)
        {
            $avatar = URL::asset('storage/app/public/uploads/customers/'.$item->profile_pic);;
        }else{
            $avatar = URL::asset('resources/assets/front-end/img/home/PropertyStays-icon.png');
        }
            
        $result = array(
            "id" => $item->id,
            "title" => $item->title,
            "cityname" => $item->cityname,
            'images' => $images,
            'isInFavorite' => $isInFavorite,
            'location' => $item->area,
            'tour_duration' => $item->tour_duration,
            'tour_type' => $item->tour_type,
            'adults' => $item->adults,
            'children' => $item->children,
            'infant' => $item->infant,
            'rating' => $item->total_comments,
            'owner' => array(
                'id' => $item->user_id,
                'name' => $item->name,
                'image' => $avatar,
            ),
            'content' => $item->description,
            'tour_included' => $item->tour_included,
            'tour_excluded' => $item->tour_excluded,
            'tour_highlight' => $item->tour_highlight,
            'url' => url('rental/'.$item->slug),
            'positions' => array(
                'lng' => $item->longitude,
                'lat' => $item->latitude,
            ),
        );

        return response()->json($result);
    }

    public function searchProperties(Request $request)
    {
        $token = $request->get('token');
        $search = $request->all();

        if($token != 0)
        {
            $itemData = Property::select('properties.id', 'properties.title', 'properties.image', 'properties.description', 'properties.original_price', 'properties.adults', 'properties.bed', 'properties.bath', DB::raw("(SELECT '1' FROM wishlists WHERE user_id=$token and property_id=properties.id) as isInFavorite"))
                ->where('type', '=', 1);
        }
        else
        {
            $itemData = Property::select('properties.id', 'properties.title', 'properties.image', 'properties.description', 'properties.original_price', 'cancellation as isInFavorite', 'properties.adults', 'properties.bed', 'properties.bath', 'properties.featured')
                ->where('type', '=', 1);
        }

        if(isset($search['loc_id']))
        {
            if($request->get('loc_id') != 'undefined')
            {
                $itemData = $itemData->where('properties.city_id', $request->get('loc_id'));
            }
        }

        if(isset($search['adults']))
        {    
            if($request->get('adults'))
            {
                $itemData = $itemData->where('properties.adults', '=',$request->get('adults'));
            }
        }
        if(isset($search['childs']))
        {
            if($request->get('childs') != 0)
            {
                $itemData = $itemData->where('properties.children', '=', $request->get('childs'));
            }
        }
        /*if($request->get('property_type'))
        {
            $itemData = $itemData->where('properties.bath', $request->get('bath'));
        }
        if($request->get('date_from'))
        {
            $itemData = $itemData->where('properties.bath', $request->get('bath'));
        }
        if($request->get('date_to'))
        {
            $itemData = $itemData->where('properties.bath', $request->get('bath'));
        }*/

        $itemData = $itemData->groupBy('properties.id')->get();

        $result = array();
        foreach($itemData as $item)
        {

            if($item->isInFavorite == null)
            {
                $item->isInFavorite = 0;
            }

            $image = URL::asset('storage/app/public/uploads/properties/'.$item->image);
            $result[]   =   array(
                "id" => $item->id,
                "title" => Str::words(strip_tags($item->title), 10,'...'),
                "isInFavorite" => $item->isInFavorite,
                'image' => $image,
                "description" => preg_replace("/\r|\n/", "", strip_tags($item->description)),
                'price' => '£'.$item->original_price,
                'bed' => $item->bed,
                'bath' => $item->bath,
                'adults' => $item->adults,
                'featured' => $item->featured,
                'rating' => 0,
                'reviews' => 0,
            );
        }

        return $this->sendResponse($result, 'searchProperties fetched.');

    }
   
}