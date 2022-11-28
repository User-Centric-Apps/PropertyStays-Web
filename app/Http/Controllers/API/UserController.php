<?php
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\City;
use App\Models\Property;
use App\Models\Help;
use App\Models\HelpCategory;
use App\Models\HelpSubCategory;
use App\Models\SettingsApp;
use App\Models\Pages;
use App\Models\PropertiesBookingEnquiry;
use App\Models\Wishlist;
use App\Models\Orders;
use App\Models\OrdersItem;
use App\Models\User;
use App\Models\Feedback;
use App\Models\RentTypes;
use App\Models\PropertiesAmenities;
use App\Models\PropertiesRenttypes;
use App\Models\PropertiesSuitable;
use App\Models\PropertiesImages;
use URL;
use DB;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use Stripe;

   
class UserController extends BaseController
{
    use UploadTrait;
    public function userReviews(Request $request)
    {
        $token = $request->get('token');
        $property_id = $request->get('id');

        $comments = array();
        $comments_array = Feedback::select('feedback.*', 'users.name', 'users.profile_pic')
        ->leftJoin('users', 'users.id', '=', 'feedback.user_id')
        ->where('feedback.property_id', '=', $property_id)
        ->where('feedback.type', '=', 'Property')
        ->where('feedback.status', '=', 1)
        ->get();

        foreach($comments_array as $comment){

            $comments[] = array(
                'id' => $comment->id,
                'author' => $comment->name,
                'title' =>  $comment->type,
                'content' => $comment->comment,
                'date' => date('M Y', strtotime($comment->created_at)),
                'rate' => $comment->rating,
            );
        }

        $totalFeedback = count($comments_array);

        $Rating = Feedback::where('feedback.property_id', '=', $property_id)
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

        $result[]   =   array(
            'count'             => $totalFeedback,
            'rating'            => $totalRating,
            'review_desc'       => 'Desc',
            'comments'          => $comments,
            'canwrite'          => 0,
        );

        return response()->json($result);

    }

    public function userSubmitReview(Request $request)
    {
        $token = $request->get('token');
        $property_id = $request->get('id');

        $rules = array(
            'id' => 'required',
            'rating' => 'required',
        );

        $validation =  Validator::make($request->all(), $rules);

        if($validation->fails())
        {
            $result = array("status" => 0, "msg" => $validation->errors());
        } 
        else 
        {

            $post = $request->all();

            $item = new Feedback;
                $item->property_id = $post['id'];
                $item->user_id = $token;
                $item->comment = $post['content'];
                $item->rating = $post['rating'];
                $item->type = 'Property';
                $item->user_type = 'User';
                $item->save();

                $result = array("status" => 1, "msg" => "updated successfully");
        }

        return response()->json($result);

    }

    public function userSetPropertyFavorite(Request $request)
    {
        $token = $request->get('token');
        $property_id = $request->get('id');
        $status = $request->get('status');

        $statusWishlist = Wishlist::where('user_id', $token)
        ->where('property_id', $property_id)
        ->first();

        if($statusWishlist)
        {
            Wishlist::where('id', '=', $statusWishlist->id)->delete();
                $result = array("status" => 1, "msg" => "updated1 successfully");
        }
        else
        {
            $wishlist = new Wishlist;
            $wishlist->user_id = $token;
            $wishlist->property_id = $property_id;
            $wishlist->type = '1';
            $wishlist->save();
            $result = array("status" => 1, "msg" => "updated3 successfully");

        }

        return response()->json($result);

    }

    public function userFavouriteProperty(Request $request)
    {
        $token = $request->get('token');

        $result = array();

        $wishlists = array();

        if($token)
        {
            $wishlists = Wishlist::select('wishlists.id', 'properties.title', 'properties.image', 'properties.id as property_id', 'properties.original_price', 'properties.bed', 'properties.bath', 'properties.adults', 'properties.featured', 'wishlists.property_id', 'wishlists.created_at')
            ->leftjoin('properties', 'properties.id', '=', 'wishlists.property_id')
            ->where('wishlists.user_id', '=', $token)
            ->orderby('wishlists.id', 'desc')
            ->get();
        }
            
        if(count($wishlists) > 0)
        {
            foreach($wishlists as $item)
            {
                if($item->image){
                    $image = URL::asset('storage/app/public/uploads/properties/'.$item->image);
                }
                else
                {
                    $image  =   null;
                }

                $result[] = array(
                    "id" => $item->id,
                    "property_id" => $item->property_id,
                    "title" => $item->title,
                    'image' => $image,
                    'price' => '€'.$item->original_price.' per night',
                    'bed' => $item->bed,
                    'bath' => $item->bath,
                    'adults' => $item->adults,
                    'featured' => $item->featured,
                    'rating' => 0,
                    'reviews' => 0,
                );
            }
        }
        

        return $this->sendResponse($result, 'userFavouriteProperty found.');

    }

    public function userFavouriteTour(Request $request)
    {
        $token = $request->get('token');
        $property_id = $request->get('id');

        $wishlists = array();
        $wishlists = Wishlist::select('wishlists.id', 'properties.title', 'properties.image', 'properties.original_price', 'wishlists.property_id', 'wishlists.created_at')
            ->leftjoin('properties', 'properties.id', '=', 'wishlists.property_id')
            ->where('wishlists.user_id', '=', $user->id)
            ->where('wishlists.type', '=', 2)
            ->orderby('wishlists.id', 'desc')
            ->get();

        foreach($wishlists as $item)
        {
            if($item->image){
                $image = URL::asset('storage/app/public/uploads/tours/'.$item->image);
            }
            else
            {
                $image  =   null;
            }

            $result[] = array(
                "id" => $item->id,
                "title" => $item->title,
                'image' => $image,
                'price' => $item->original_price,
                'reviews' => 12,
            );
        }

        return $this->sendResponse($result, 'getSavedTrips found.');

    }

    public function getNewMessages(Request $request)
    {
        $token = $request->get('token');
        $property_id = $request->get('property_id');
        $message = $request->get('message');

        $userFirst = User::select('*')
        ->where('id', '=', $token)
        ->first();

        $item = new PropertiesBookingEnquiry;
        $item->property_id = $property_id;
        $item->name = $userFirst->name;
        $item->email = $userFirst->email;
        $item->mobile = $userFirst->mobile;
        $item->date = date('Y-m-d');
        $item->description = $message;
        $item->enquiry_type = 1;
        $item->save();

        $result = array("status" => 1, "msg" => "added successfully");

        return response()->json($result, 200);

    }

    public function getMessages(Request $request)
    {
        $token = $request->get('token');
        $result  = array();

        $pbEnquiry = PropertiesBookingEnquiry::select('properties_booking_enquiry.*', 'properties.title')
        ->leftJoin('properties', 'properties.id', '=', 'properties_booking_enquiry.property_id')
        ->leftJoin('users', 'users.id', '=', 'properties.user_id')
        ->where('properties.user_id', '=', $token)
        ->get();

        foreach($pbEnquiry as $item)
        {
            if($item->profile_pic)
            {
                $my_avatar = URL::asset('storage/app/public/uploads/customers/'.$item->profile_pic);
            }
            else
            {
                $my_avatar  =  "";
            }

            $sender_avatar = URL::asset('resources/assets/front-end/img/home/PropertyStays-icon.png');

            $content = $item->traveller.' Travellers ,'.$item->children.' Childrens';
            if($item->enquiry_type == 1)
            {
                if($item->date && $item->date_to)
                {
                    $date = $item->date.' to '.$item->date_to;
                }
                else
                {
                    $date = $item->date;
                }
                
            }
            else
            {
                $date = $item->date;
            }

            $result[]  = array(
                'id' => $item->id,
                'content' => $content,
                'sender_name' => $item->name.'('.$item->mobile.')',
                'sender_info' => $item->email,
                'sender_avatar' => $sender_avatar,
                'date' => $date,
                'avatar' => $my_avatar,
            ); 
        }

        return $this->sendResponse($result, 'getMessages found.');

    }

    public function getMessage(Request $request)
    {
        $token = $request->get('token');
        $result  = array();

        return $this->sendResponse($result, 'getMessage found.');

    }

    public function sendMessage(Request $request)
    {
        $token = $request->get('token');
        $result  = array();

        return $this->sendResponse($result, 'sendMessage found.');

    }

    public function getProfile(Request $request)
    {
        $token = $request->get('token');

        $item = User::select('*')
        ->where('id', '=', $token)
        ->first();

        $info = 'Verified';
        $result = '';

        if($item->profile_pic)
        {
            $my_avatar = URL::asset('storage/app/public/uploads/customers/'.$item->profile_pic);
        }
        else
        {
            $my_avatar  =  URL::asset('storage/app/public/uploads/customers/rahim-haji_1639699533.JPG');
        }

        if($item)
        {
            
            $result = array(
                'id' => $item->id,
                'email' => $item->email,
                'name' => $item->name,
                'surname' => $item->surname,
                'member_since' => date('F Y',  strtotime($item->created_at)),
                'verified_info' => $info,
                'avatar' => $my_avatar,
                'st_phone' => $item->mobile,
                'profile_pic' => $item->profile_pic,
                'address' => $item->address,
                'city' => $item->city,
                'country' => $item->country,
                'progress' => '1',
            );
        }

        return $this->sendResponse($result, 'getProfile found.');

    }

    public function updateProfile(Request $request)
    {
        $token = $request->get('token');
        $result  = array();
        $post = $request->all();
        header("Access-Control-Allow-Origin: *");
        if($token)
        {
            $User =  User::find($token);
            if($User)
            {
                $User->name = $post['name'];
                $User->surname = $post['surname'];
                $User->mobile = $post['st_phone'];
                $User->address = $post['address'];
                $User->city = $post['city'];
                $User->country = $post['country'];

                $User->save();


                $success['id'] =  $User->createToken('MyAuthApp')->plainTextToken; 
                $success['token'] =  $User->id;
                $success['user_display_name'] =  $User->name;
                $success['email'] =  $User->email;
                
                if($User->profile_pic)
                {
                    $success['profile_pic'] =  URL::asset('storage/app/public/uploads/customers/'.$User->profile_pic);
                }
                else
                {
                    $success['profile_pic'] =  URL::asset('storage/app/public/uploads/customers/rahim-haji_1639699533.JPG');
                }

                $progress = '0.3';

                /*if($User->name != '')
                {
                    $progress = '0.4';
                }
                if($User->name != '' && $User->surname != '')
                {
                    $progress = '0.5';
                }
                if($User->mobile != '' && $User->name != '' && $User->surname != '')
                {
                    $progress = '0.6';
                }
                if($User->mobile != '' && $User->name != '' && $User->surname != '' && $User->address != '')
                {
                    $progress = '0.7';
                }*/
                if($User->mobile != '' && $User->name != '' && $User->surname != '' && $User->address != '' && $User->city != '')
                {
                    $progress = '0.8';
                }
                if($User->mobile != '' && $User->name != '' && $User->surname != '' && $User->address != '' && $User->city != '' && $User->country != '')
                {
                    $progress = '1';
                }
                $success['progress'] =  $progress;

                echo json_encode($success);

            }
        }
        

        

    }

    public function updatePicture(Request $request)
    {
        $token = $request->get('token');
        $result  = array();

        if($token)
        {
            $User =  User::find($token);
            if($User)
            {
                $User->profile_pic = $post['profile_pic'];

                $User->save();
            }
        }
        

        return $this->sendResponse($result, 'updatePicture found.');

    }

    public function userChangeNotification(Request $request)
    {
        $token = $request->get('token');
        $notify = $request->get('notify'); //notify is 0 or 1
        $result  = array();
        if($token)
        {
            $User =  User::find($token);
            if($User)
            {
                $User->notification = $notify;
                $User->save();
            }
            $result = array(
                'status' => 1,
            );
        }

        return $this->sendResponse($result, 'getUserCurrency found.');

    }

    public function userNotification(Request $request)
    {
        $token = $request->get('token');
        $result  = array();

        if($token)
        {
            $User =  User::find($token);
            if($User)
            {
                $result = array(
                    'status' => $User->notification,
                );
            }
        }

        return $this->sendResponse($result, 'getUserCurrency found.');

    }

    public function getUserCurrency(Request $request)
    {
        $token = $request->get('token');
        $result  = array();

        if($token)
        {
            $User =  User::find($token);
            if($User)
            {
                $result = array(
                    'name' => $User->currency,
                );
            }
        }

        return $this->sendResponse($result, 'getUserCurrency found.');

    }

    public function setUserCurrency(Request $request)
    {
        $token = $request->get('token');
        $currency = $request->get('currency');
        $result  = array();

        if($token)
        {
            $User =  User::find($token);
            if($User)
            {
                $User->currency = $currency;
                $User->save();

                $result = array(
                    'name' => $User->currency,
                );
            }
        }

        return $this->sendResponse($result, 'setUserCurrency found.');

    }

    public function addProperty(Request $request)
    {
        $token = $request->get('token');
        $post = $request->all();
        $result  = array();

        $item = new Property;

        $item->user_id = $request->get('token');
        
        $item->save();

        if($request->has('renttype_id'))
        {
            $regarr = array('renttype_id' => $request->get('renttype_id'), 'property_id' => $item->id);
            $PropertiesRenttypes = PropertiesRenttypes::firstOrNew($regarr);
            $PropertiesRenttypes->renttype_id = $request->get('renttype_id');
            $PropertiesRenttypes->property_id = $item->id;
            $PropertiesRenttypes->save();
        } 

        $result = array("property_id" => $item->id, "msg" => $request->get('renttype_id'));

        return response()->json($result, 200);

    }



    public function updateProperty(Request $request)
    {
        $token = $request->get('token');
        $post = $request->all();
        $item = new Property;

        if($post['property_id'])
        {
            $property_id = intval($post['property_id']);
            $item = $item->find($property_id);
        }

        $item->user_id = $request->get('token');
        if($request->get('title'))
        {
            $item->title = $post['title'];
            $item->slug = Str::slug($post['title'], '-');
        }
        if($request->get('description'))
        {
            $item->description = $post['description'];
        }
        if($request->get('price'))
        {
            $item->original_price = $post['price'];
        }
        if($request->get('discount_price'))
        {
            $item->discount_price = $post['discount_price'];
        }
        if($request->get('sqft'))
        {
            $item->sqft = $post['sqft'];
        }
        if($request->get('bed'))
        {
            $item->bed = $post['bed'];
        }
        if($request->get('bath'))
        {
            $item->bath = $post['bath'];
        }
        if($request->get('adults'))
        {
            $item->adults = $post['adults'];
        }
        if($request->get('children'))
        {
            $item->children = $post['children'];
        }
        if($request->get('lat'))
        {
            $item->latitude = $post['lat'];
        }
        if($request->get('lng'))
        {
            $item->longitude = $post['lng'];
        }
        if($request->get('area'))
        {
            $item->area = $post['area'];
        }
        if($request->get('city_id'))
        {
            $item->city_id = $post['city_id'];
        }
        $item->country_id = 1;
        if($request->get('maximum_days'))
        {
            $item->maximum_days = $post['maximum_days'];
        }
        $item->ready_to_pay = ($request->get('ready_to_pay') == true) ? 1 : 0;
        
        $item->save();



        if($request->has('amenities'))
        {
            $amenities = array_filter($request->get('amenities'));
            if(!empty($amenities)){
                $amenities_ids = array();
                foreach($amenities as $amenity){
                    if($amenity)
                    {
                        $regarr = array('amenity_id' => $amenity, 'property_id' => $item->id);
                        $PropertiesAmenities = PropertiesAmenities::firstOrNew($regarr);
                        $PropertiesAmenities->amenity_id = $amenity;
                        $PropertiesAmenities->property_id = $item->id;
                        $PropertiesAmenities->save();
                        array_push($amenities_ids, $PropertiesAmenities->id);
                    }
                    PropertiesAmenities::whereNotIn('id', $amenities_ids)->where('property_id', '=', $item->id)->delete();
                }
            } 
            else
            {
                PropertiesAmenities::where('property_id', '=', $item->id)->delete();
            }
        } 
        else
        {
            PropertiesAmenities::where('property_id', '=', $item->id)->delete();
        }

        if($request->has('suitablefor'))
        {
            $property_suitables = array_filter($request->get('suitablefor'));
            if(!empty($property_suitables)){
                $property_suitables_ids = array();
                foreach($property_suitables as $suitbale){
                    if($suitbale)
                    {
                        $regarr = array('suitbale_id' => $suitbale, 'property_id' => $item->id);
                        $PropertiesSuitable = PropertiesSuitable::firstOrNew($regarr);
                        $PropertiesSuitable->suitbale_id = $suitbale;
                        $PropertiesSuitable->property_id = $item->id;
                        $PropertiesSuitable->save();
                        array_push($property_suitables_ids, $PropertiesSuitable->id);
                    }
                    PropertiesSuitable::whereNotIn('id', $property_suitables_ids)
                        ->where('property_id', '=', $item->id)->delete();
                }
            }
            else
            {
                PropertiesSuitable::where('property_id', '=', $item->id)->delete();
            }
        } 
        else
        {
            PropertiesSuitable::where('property_id', '=', $item->id)->delete();
        }

        $result = array("property_id" => $item->id, "status" => 1, "msg" => "Not Available");

        return response()->json($result, 200);

    }

    public function editProperty(Request $request)
    {
        $token = $request->get('token');
        $property_id = $request->get('property_id');
        $result  = array();

        return $this->sendResponse($result, 'editProperty found.');

    }

    public function myProperties(Request $request)
    {
        $token = $request->get('token');
        $result  = array();
        $rule   =   1;

        $items = Property::select('properties.*', 'cities.cityname')
        ->leftJoin('cities', 'cities.id', '=', 'properties.city_id')
        ->where('properties.type', '=', 1)
        ->where('properties.user_id', '=', $token)
        ->orderby('properties.id', 'desc')->get();

        if(count($items) > 0)
        {

            foreach($items as $item)
            {
                if($item->image)
                {
                    $image = URL::asset('storage/app/public/uploads/properties/'.$item->image);
                }
                else
                {
                    $image  =   null;
                }

               $result[] = array(
                    "id" => $item->id,
                    "title" => $item->title,
                    'image' => $image,
                    'status' => 'Published',
                    'rule' => $rule,
                );
            }
        }

        return $this->sendResponse($result, 'myProperties found.');

    }

    public function deleteProperty(Request $request)
    {
        $token = $request->get('token');
        $property_id = $request->get('property_id');
        $data = Properties::findOrFail($property_id);
        $this->UnlinkImage("properties/", $data->image);
        $data->delete();
        PropertiesAmenities::where('property_id','=', $property_id)->delete();
        PropertiesImages::where('property_id','=', $property_id)->delete();

    }

    public function bookingDates(Request $request)
    {
        $token = $request->get('token');

        $result = array("status" => 1, "msg" => "Not Available");

        return response()->json($result, 200);

        /*$property_id = $request->get('rental_id');
        $val['data'] = array(
            'check_in' => $request->get('from'),
            'check_out' => $request->get('to'),
            'adult_number' => $request->get('adults'),
            'child_number' => $request->get('children'),
            'infant_number' => 0,
        );

        $item = Property::select('*')
        ->where('id', '=', $property_id)
        ->first();

        $price_per_nights = $item->original_price;
        $start_ts = strtotime($request->get('from'));
        $end_ts = strtotime($request->get('to'));
        $diff = $end_ts - $start_ts;
        $nights =  round($diff / 86400);
        $price = $item->original_price;

        if($request->get('type') == 'rental')
        {
            $price = $price_per_nights*$nights;
            if($request->get('adults'))
            {
                $price = $price*$request->get('adults');
            }
            if($request->get('children'))
            {
                $price = $price*$request->get('children');
            }
        }
        if($request->get('type') == 'tour')
        {
            $check_in = $val['data']['check_in'];
            $check_out = $val['data']['check_out'];
            $adult_number = intval($val['data']['adult_number']);
            $child_number = intval($val['data']['child_number']);
            $infant_number = intval($val['data']['infant_number']);

            $adultsPrice = $item->adults*$adult_number;
            $childrensPrice = $item->children*$child_number;
            $infantsPrice = $item->infant*$infant_number;

            $price = ($adultsPrice)+($childrensPrice)+($infantsPrice);
        }
        if($price == 0)
        {
            $json = array("status" => 0, "msg" => "Not Available");
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($json);
            exit;
        }
        else
        {
            $result = array(
                'current_symbol' => '£',
                'currency' => 'eur',
                'price' => $price,
                'rule' => 0,
                'status' => 1,
                'ready_to_pay' => $item->ready_to_pay,
                'message' => 'Sorry! This rental cannot be booked all this period because of law terms for this city.',
            );
        }

        return response()->json($result, 200);*/

    }

    public function bookTour(Request $request)
    {
        $post = $request->all();
        $token = $request->get('token');
        $property_id = $post['rental_id'];

        $item = Property::select('*')
        ->where('id', '=', $property_id)
        ->first();

        if($item)
        {

            if($item->ready_to_pay == 1)
            {
                $check_in = $post['from'];
                $check_out = $post['to'];
                $adults = $post['adults'];
                $childrens = $post['children'];
                $infants = 0;

                if($item->type == 1)
                {
                    $start_ts = strtotime($request->get('from'));
                    $end_ts = strtotime($request->get('to'));
                    $diff = $end_ts - $start_ts;
                    $total_nights =  round($diff / 86400);

                    if($item->discount_price)
                    {
                        $pricess = $item->discount_price;
                    }
                    else
                    {
                        $pricess = $item->original_price;
                    }

                    $adultsPrice = $pricess*1;
                    $Amount = $adultsPrice*$adults*$total_nights;
                }
                else
                {
                    $check_out = '';
                    $total_nights = '';

                    $adultsPrice = $item->adults*1;
                    $childrensPrice = $item->children*1;
                    $infantsPrice = $item->infant*1;

                    $Amount = ($adultsPrice*$adults)+($childrensPrice*$childrens)+($infantsPrice*$infants);
                }

                $ord =  new Orders;
                $ord->user_id = $token;
                $ord->total_bookings = 1;
                $ord->total_bill = $Amount;
                $ord->payment_method = 'card';
                $ord->status = 'succeeded';
                $ord->order_transaction = '1234';
                $ord->balance_transaction = 'dsf';
                $ord->order_currency = 'AE';
                //Billing
                $ord->billing_name = $post['first_name']; //$charge->billing_details->name;
                $ord->billing_email = $post['email']; //$charge->billing_details->email;
                $ord->billing_phone = $post['phone']; //$charge->billing_details->phone;
                $ord->date = date('Y-m-d');
                $ord->paid = 1;
                $ord->save();


                $Order =  new OrdersItem;
                $Order->order_id = $ord->id;
                $Order->user_id = $token;
                $Order->property_id = $item->id;
                $Order->price = $item->original_price;
                //Options
                $Order->adults = $adults;
                $Order->childrens = $childrens;
                $Order->check_in = $check_in;
                $Order->check_out = $check_out;
                $Order->total_nights = $total_nights;
                //Options
                $Order->paid = 1;
                $Order->status = 'Pending';
                $Order->save();

                $result = array( 'success'   => true );
            }
            else
            {
                $Comment =  PropertiesBookingEnquiry::where('property_id', '=', $property_id)
                ->where('email', '=', $post['email'])
                ->where('enquiry_type', '=', $post['type'])
                ->first();

                if($Comment == null)
                {
                    $item = new PropertiesBookingEnquiry;
                    $item->property_id = $property_id;
                    $item->name = $post['first_name'];
                    $item->email = $post['email'];
                    $item->mobile = $post['phone'];
                    $item->date = $request->get('from');
                    $item->date_to = $request->get('to');
                    $item->traveller = $post['adults'];
                    $item->children = $post['children'];
                    $item->description = $post['specialReq'];
                    $item->enquiry_type = $post['type'];
                    $item->save();

                    $result = array( 'success'   => true );
                }
                else
                {
                    $result = array(
                        'status'  => false,
                        'message' => __( 'Can not save order.')
                    );
                }
            }

            
        }
        else
        {
            $result = array(
                    'status'  => false,
                    'message' => __( 'Can not save order.')
                );
        }

        return response()->json($result);

    }

    public function myTrips(Request $request)
    {
        $token = $request->get('token');
        $result  = array();

        $itemData = OrdersItem::select('orders_item.id', 'orders_item.adults', 'orders_item.childrens', 'orders_item.infants', 'orders_item.check_in', 'orders_item.check_out', 'orders_item.total_nights', 'orders_item.price', 'orders_item.status','orders_item.created_at', 'properties.title', 'properties.image', 'properties.original_price')
            ->leftjoin('properties', 'properties.id', '=', 'orders_item.property_id')
            ->where('orders_item.user_id', '=', $token)
            ->where('orders_item.order_type', '=', 'Property')
            ->where('properties.type', '=', 1)
            ->where('orders_item.paid', '=', 1)
            ->orderby('orders_item.id', 'desc')
            ->get();



        $User =  User::find($token);
        if($User)
        {
            if($User->currency == 'gbp')
            {
                $currency_symbol = '£';
            }
            else
            {
                $currency_symbol = '€';
            }
        }
        else
        {
            $currency_symbol = '£';
        }    

        if(count($itemData) > 0)
        {
            foreach($itemData as $item)
            {
                if($item->image){
                    $image = URL::asset('storage/app/public/uploads/properties/'.$item->image);
                }
                else
                {
                    $image  =   null;
                }

                $result[] = array(
                    'id' => $item->id,
                    'icon' => '',
                    'title' => $item->title,
                    'nights' => $item->total_nights.' nts',
                    'check_in' => date('d/m/y', strtotime($item->check_in)),
                    'check_out' => date('d/m/y', strtotime($item->check_out)),
                    'image' => $image,
                    'created_at' => date('d/m/y', strtotime($item->created_at)),
                    'execution_time' => $item->check_in.' - '.$item->check_out,
                    'cost' => number_format($item->price),
                    'currency' => $currency_symbol,
                    'status' => $item->status,
                    'st_booking_post_type' => 'st_tour',
                    'order_details' => $item->adults.' adults, '.$item->childrens.' childrens,'.$item->infants.' infants.',
                );
            }
        }

        return $this->sendResponse($result, 'My Trip Found!');

    }

    public function myTours(Request $request)
    {
        $token = $request->get('token');
        $result  = array();

        $itemData = OrdersItem::select('orders_item.id', 'orders_item.adults', 'orders_item.childrens', 'orders_item.infants', 'orders_item.check_in', 'orders_item.check_out', 'orders_item.total_nights', 'orders_item.price', 'orders_item.status','orders_item.created_at', 'properties.title', 'properties.image', 'properties.original_price')
            ->leftjoin('properties', 'properties.id', '=', 'orders_item.property_id')
            ->where('orders_item.user_id', '=', $token)
            ->where('orders_item.order_type', '=', 'Tour')
            ->where('properties.type', '=', 2)
            ->orderby('orders_item.id', 'desc')
            ->get();

        if(count($itemData) > 0)
        {
            foreach($itemData as $item)
            {
                if($item->image){
                    $image = URL::asset('storage/app/public/uploads/properties/'.$item->image);
                }
                else
                {
                    $image  =   null;
                }

                $result[] = array(
                    'id' => $item->id,
                    'icon' => '',
                    'title' => $item->title,
                    'nights' => $item->total_nights.' nts',
                    'check_in' => $item->check_in,
                    'check_out' => $item->check_out,
                    'image' => $image,
                    'created_at' => $item->created,
                    'execution_time' => $item->check_in.' - '.$item->check_out,
                    'cost' => $item->price,
                    'status' => $item->status,
                    'adults' => $item->adults,
                    'childrens' => $item->childrens,
                    'infants' => $item->infants,
                    'st_booking_post_type' => 'st_tour',
                    'order_details' => $item->adults.' adults, '.$item->childrens.' childrens,'.$item->infants.' infants.',
                );
            }
        }

        return $this->sendResponse($result, 'My Tours Found!');

    }

    public function myBookings(Request $request)
    {
        $token = $request->get('token');
        $result  = array();

        $itemData = PropertiesBookingEnquiry::select('properties_booking_enquiry.*', 'properties.title', 'properties.image')
            ->leftjoin('properties', 'properties.id', '=', 'properties_booking_enquiry.property_id')
            ->leftjoin('users', 'users.email', '=', 'properties_booking_enquiry.email')
            ->where('users.id', '=', $token)
            ->where('properties.user_id', '!=', $token)
            ->orderby('users.id', 'desc')
            ->get();

        $User =  User::find($token);
        if($User)
        {
            $currency = $User->currency;
            if($currency == 'gbp')
            {
                $currency_symbol = '£';
            }
            else
            {
                $currency_symbol = '€';
            }
        }
        else
        {
            $currency_symbol = '£';
        }

        if(count($itemData) > 0)
        {
            foreach($itemData as $item)
            {
                if($item->image){
                    $image = URL::asset('storage/app/public/uploads/properties/'.$item->image);
                }
                else
                {
                    $image  =   null;
                }

                $result[] = array(
                    'id' => $item->id,
                    'title' => $item->title,
                    'image' => $image,
                    'date' => $item->date,
                    'date_to' => $item->date_to,
                    'childrens' => $item->childrens,
                    'traveller' => $item->traveller,
                    'created_at' => $item->created,
                    'type' => $item->enquiry_type,
                    'currency' => $currency_symbol,
                );
            }
        }

        return $this->sendResponse($result, 'My Booking Found!');

    }

    public function bookingRequest(Request $request)
    {
        $token = $request->get('token');
        $property_id = $request->get('id');

        $item = Property::select('properties.*', 'cities.cityname', 'users.name', 'users.profile_pic', DB::raw('count(feedback.property_id) as total_comments'), DB::raw('count(feedback.rating) as total_rating'))
        ->leftJoin('feedback', 'feedback.property_id', '=', 'properties.id')
        ->leftJoin('cities', 'cities.id', '=', 'properties.city_id')
        ->leftJoin('users', 'users.id', '=', 'properties.user_id')
        ->where('properties.id', '=', $property_id)
        ->first();

        if($item->image)
        {
            $image = URL::asset('storage/app/public/uploads/properties/'.$item->image);
        }
        else
        {
            $image = '';
        }

        $result  = array();
        $result     =   array(
            "title" => $item->title,
            'image' => $image,
            'price' => $item->original_price,
            'rating' => $item->total_rating,
            'reviews_count' => $item->total_comments,
        );

        return response()->json($result);

    }

    public function bookingRequestDetails(Request $request)
    {
        $token = $request->get('token');
        $property_id = $request->get('rental_id');
        $val['data'] = array(
            'check_in' => $request->get('from'),
            'check_out' => $request->get('to'),
            'adult_number' => $request->get('adults'),
            'child_number' => $request->get('children'),
            'infant_number' => 0,
        );

        $item = Property::select('*')
        ->where('id', '=', $property_id)
        ->first();

        if($item)
        {
            $price_per_nights = $item->original_price;
            $start_ts = strtotime($request->get('from'));
            $end_ts = strtotime($request->get('to'));
            $diff = $end_ts - $start_ts;
            $nights =  round($diff / 86400);

            if($request->get('type') == 'rental')
            {
                $price = $price_per_nights*$nights;
                if($request->get('adults'))
                {
                    $price = $price*$request->get('adults');
                }
                if($request->get('children'))
                {
                    $price = $price*$request->get('children');
                }
            }
            if($request->get('type') == 'tour')
            {
                $check_in = $val['data']['check_in'];
                $check_out = $val['data']['check_out'];
                $adult_number = intval($val['data']['adult_number']);
                $child_number = intval($val['data']['child_number']);
                $infant_number = intval($val['data']['infant_number']);

                $adultsPrice = $item->adults*$adult_number;
                $childrensPrice = $item->children*$child_number;
                $infantsPrice = $item->infant*$infant_number;

                $price = ($adultsPrice)+($childrensPrice)+($infantsPrice);
            }
            if($price == 0)
            {
                $json = array("status" => 0, "msg" => "Not Available");
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($json);
                exit;
            }
            else
            {
                $result = array(
                    'current_symbol' => '£',
                    'currency' => 'eur',
                    'nights' => (float) $nights,
                    'price' => (float) $price_per_nights,
                    'total' => (float) $price,
                );
            }
        }

        

        return response()->json($result, 200);

    }

    public function cityRuleProperty(Request $request)
    {
        $city_id = $request->get('city_id');
        $cityDetail = City::where('id', '=', $city_id)->first();

        $locations = array(
                        'lati' => $cityDetail->latitude,
                        'lngg' => $cityDetail->longitude,
                    );

        return response()->json($locations, 200);

    }

    public function propertyImagesProperty(Request $request)
    {
        header('Content-type: application/json; charset=utf-8');
        $token = $request->get('token');
        $property_id = $request->get('rental');

        //Extention and Size
            $valid_extension = array("jpg","jpeg","png");
            $maxFileSize = 2097152;
        //Extention and Size

        $item = new Property;

        if($post['property_id'])
        {
            $property_id = intval($post['property_id']);
            $item = $item->find($property_id);
            
            if($request->has('file')) 
            {
                $image = $request->file('file');
                $fileSize = $image->getSize();
                $extension = $image->getClientOriginalExtension();

                if(in_array(strtolower($extension),$valid_extension))
                {
                    if($fileSize <= $maxFileSize)
                    {
                        $name = time();
                        $folder = '/uploads/properties/';
                        $filePath = $name. '.' . $image->getClientOriginalExtension();
                        $this->uploadOne($image, $folder, 'public', $name);
                        $item->image = $filePath;
                    }
                    else
                    {
                        $data = ['success' => false, 'message' => 'Upload issue'];
                        echo json_encode($data);
                    }

                }
                else
                {
                        $data = ['success' => false, 'message' => 'Upload issue'];
                        echo json_encode($data);
                }
            }
            $item->save();
        }
        else
        {
            $data = ['success' => false, 'message' => 'Upload issue'];
            echo json_encode($data);
        }
            
    }

    public function setUDID(Request $request)
    {
        $token = $request->get('token');
        $user_udid = $request->get('user_udid');
        $result  = array();
        $post = $request->all();
        if($token)
        {
            $User =  User::find($token);
            if($User)
            {
                $User->user_udid = $user_udid;
                $User->save();

                $json = array("status" => 1, "msg" => $user_udid);
                header('Content-type: application/json; charset=utf-8');
                return response()->json($json, 200);
            }
            else
            {
                $json = array("status" => 0, "msg" => "Error in username and password");
                header('Content-type: application/json; charset=utf-8');
                return response()->json($json, 200);
            }
        }
        else
        {
            $json = array("status" => 0, "msg" => "Error in username and password");
            header('Content-type: application/json; charset=utf-8');
                return response()->json($json, 200);
        }

    }
   
}