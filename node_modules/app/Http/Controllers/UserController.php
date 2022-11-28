<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use File;
use Session;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Feedback;
use App\Models\Orders;
use App\Models\OrdersItem;
use App\Models\Property;
use App\Models\Country;
use App\Models\Amenity;
use App\Models\RentTypes;
use App\Models\PropertiesAmenities;
use App\Models\PropertiesRenttypes;
use App\Models\PropertiesSuitable;
use App\Models\PropertiesImages;
use App\Models\PropertiesBookingEnquiry;
use App\Models\UsersHostPayment;
use Yajra\Datatables\Datatables;
use App\Models\Suitable;

class UserController extends Controller
{
    use UploadTrait;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Dashboard(Request $request)
    {
        return view('users.dashboard');
    }

    public function userTrips(Request $request)
    {
        $bookings = array();
        $bookings = OrdersItem::select('orders_item.id', 'orders_item.adults', 'orders_item.childrens', 'orders_item.infants', 'orders_item.check_in', 'orders_item.check_out', 'orders_item.total_nights', 'orders_item.price',  'orders_item.status', 'properties.title', 'properties.image', 'properties.original_price')
            ->leftjoin('properties', 'properties.id', '=', 'orders_item.property_id')
            ->where('orders_item.user_id', '=', Auth::user()->id)
            ->where('orders_item.order_type', '=', 'Property')
            ->where('properties.type', '=', 1)
            ->where('orders_item.paid', '=', 1)
            ->orderby('orders_item.id', 'desc')
            ->paginate(9);

        return view('users.bookings.trips', compact('bookings'));
    }

    public function userCancelTrip($sub_order_id)
    {
        if($sub_order_id)
        {
            //$this->sendEmail('Cancelled', $OiD, Auth::user()->email, Auth::user()->name);
            $variable = array('status' => 'Cancelled');
            OrdersItem::where('id', '=', $sub_order_id)->update($variable);

            return redirect()->back()->with('success', 'Trip cancelled successfully');
        }

        return redirect()->back()->with('danger', 'Something wrong, Please try again.');   
    }

    public function userRefundRequest($sub_order_id)
    {
        if($sub_order_id)
        {
            $variable = array('refund-request' => 1);
            OrdersItem::where('id', '=', $sub_order_id)->update($variable);

            return redirect()->back()->with('success', 'Refund Requested successfully');
        }

        return redirect()->back()->with('danger', 'Something wrong, Please try again.');   
    }

    public function userTours(Request $request)
    {
        $tours = array();
        $tours = OrdersItem::select('orders_item.id', 'orders_item.adult', 'orders_item.child', 'orders_item.check_in', 'orders_item.check_out', 'orders_item.total_nights', 'orders_item.price',  'orders_item.status', 'properties.title', 'properties.image', 'properties.original_price')
            ->leftjoin('properties', 'properties.id', '=', 'orders_item.property_id')
            ->where('orders_item.user_id', '=', Auth::user()->id)
            ->where('orders_item.order_type', '=', 'Tour')
            ->where('properties.type', '=', 2)
            ->where('orders_item.paid', '=', 1)
            ->orderby('orders_item.id', 'desc')
            ->paginate(9);

        return view('users.bookings.tour', compact('tours'));
    }

    public function userCancelTour($sub_order_id)
    {
        if($sub_order_id)
        {
            //$this->sendEmail('Cancelled', $OiD, Auth::user()->email, Auth::user()->name);
            $variable = array('status' => 'User-Cancelled');
            OrdersItem::where('id', '=', $sub_order_id)->update($variable);

            return redirect()->back()->with('success', 'Trip cancelled successfully');
        }

        return redirect()->back()->with('danger', 'Something wrong, Please try again.');   
    }

    /*public function userOrders(Request $request)
    {
        
        $orders = array();
        $orders = Orders::select('orders.id', 'orders.order_transaction', 'orders.total_bill', 'orders.payment_method', 'orders.date', 'orders.created_at')
            ->where('orders.user_id', '=', Auth::user()->id)
            ->where('orders.paid', '=', 1)
            ->orderby('orders.id', 'desc')
            ->paginate(9);
        return view('users.bookings.order', compact('orders'));
        
    }*/

    public function doSaveAccount(Request $request)
    {

        $rules = array(
            'name' => 'required|max:255',
            'mobile' => 'required',
        );

        $validation =  Validator::make($request->all(), $rules);

        if($validation->fails())
        {
            return redirect('home')->withInput($request->all())->withErrors($validation);
        } 
        else 
        {

            $post = $request->all();
            $User =  User::find(Auth::user()->id);
            if($User)
            {
                $User->name = $post['name'];
                $User->mobile = $post['mobile'];
                $User->whatsapp = $post['whatsapp'];
                $User->notification = ($request->get('notification') == 1) ? 1 : 0;

                $User->save();

                return redirect('home')->with('success', 'Successfully Updated'.$User->notification);
            }
            else
            {
                return redirect('home')->with('danger', 'Something wrong, Please try again later!');
            }

        }
    }

    public function userPassword(Request $request)
    {
        return view('users.profile.password');
    }

    public function doSavePassword(Request $request)
    {
        $rules = array(
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        );
        $validation =  Validator::make($request->all(), $rules);
        $password = $request->get('current_password');
        $user = User::where('id', '=', Auth::id())->first();
        if($validation->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        else 
        {
            if(Hash::check($password, $user->password))
            {
                $User =  User::find(Auth::id());
                $User->password = Hash::make($request->get('password'));
                $User->save();
                return redirect('home/#password')->with('success', 'Updated Succssfully');
            } 
            else
            {
                return redirect('home/#password')->with('danger', 'Invalid Current Password!');
            }
        }

    }

    public function myPicture() 
    {
      return view('user.mypicture');
    }

    public function doSavePicture(Request $request) 
    {
        $valid_extension = array("jpg","jpeg","png");
        $maxFileSize = 2097152;
        $User =  User::find(Auth::id());
        if($User->count() > 0)
        {
            //Profile Picture
                if($request->has('image')) 
                {
                    // Get image file
                    $image = $request->file('image');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        // Check file size
                        if($fileSize <= $maxFileSize)
                        {
                            //Path Delete
                            if($User->count()>0)
                            {
                                $this->UnlinkImage("customers/", $User->profile_pic);
                            }
                            //Path Delete
                            // Make a image name based on user name and current timestamp
                            $name = Str::slug($User->name).'_'.time();
                            // Define folder path
                            $folder = '/uploads/customers/';
                            // Make a file path where image will be stored [ folder path + file name + file extension]
                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                            // Upload image
                            $this->uploadOne($image, $folder, 'public', $name);
                            // Set user profile image path in database to filePath
                            $User->profile_pic = $filePath;

                        }
                        else
                        {
                            return redirect('home/#picture')->with('danger', 'Size exceeded!');
                        }

                    }
                    else
                    {
                        return redirect('home/#picture')->with('danger', 'Unknown Extention!');
                    }
                }
            //Profile Picture   
            
            $User->save();

            return redirect('home/#picture')->with('success', 'Successfully Updated');
        }
    }

    public function hostYourEarnings(Request $request)
    {
        $totalPayment = UsersHostPayment::where('host_id', '=', Auth::user()->id)
            ->sum('comm');

        $paid = UsersHostPayment::where('paid', '=', 1)
            ->where('host_id', '=', Auth::user()->id)
            ->sum('comm');

        $unpaid = UsersHostPayment::where('paid', '=', 0)
            ->where('host_id', '=', Auth::user()->id)
            ->sum('comm');
                
        return view('users.hosts.dashboard', ['paid' => $paid, 'unpaid' => $unpaid, 'totalPayment' => $totalPayment]);
    }

    public function hostManageBank(Request $request)
    {
                
        return view('users.hosts.manage-bank');
    }

    public function hostDoSaveBank(Request $request)
    {
        $User =  User::find(Auth::user()->id);
        $post = $request->all();
        if($User)
        {
            $User->account_title = $post['account_title'];
            $User->account_iban = $post['account_iban'];
            $User->account_branch = $post['account_branch'];
            $User->account_city = $post['account_city'];
            $User->save();

            return redirect('host/your-earnings')->with('success', 'Host Bank is added.');
        }
    }

    public function changeToTravellerAccount(Request $request)
    {
        $User =  User::find(Auth::user()->id);
        if($User)
        {
            $User->type = 3;//For Both
            $User->save();

            session()->put('user_type', 2);

            return redirect('home')->with('success', 'Traveller Account is activated.');
        }
    }

    public function changeToHostAccount(Request $request)
    {
        $User =  User::find(Auth::user()->id);
        if($User)
        {
            $User->type = 3;//For Both
            $User->save();

            session()->put('user_type', 1);

            return redirect('home')->with('success', 'Host Account is activated.');
        }
    }

    public function hostInbox(Request $request)
    {

        if(request()->ajax())
        {
            $data = PropertiesBookingEnquiry::select('properties_booking_enquiry.*', 'properties.title')
        ->leftJoin('properties', 'properties.id', '=', 'properties_booking_enquiry.property_id')
        ->where('properties.user_id', '=', Auth::user()->id);

            return Datatables::of($data)->addColumn('action', function ($data)
            {
          
                $abc = '';
                $abc .= '<button id="'.$data->id.'" class="delete btn red btn-xs " title="Delete"  ><i class="fa fa-times"></i> </button>';

                return '<div class="text-center">'.$abc.'</div>';
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
            ->editColumn('enquiry_type', '@if($enquiry_type == 1) <span class="label label-success">{{ "Properties" }} </span>  @else <span class="label label-danger">{{ "Tours" }}</span> @endif')
            ->rawColumns(['action', 'enquiry_type'])
            ->make(true);

        }

        return view('users.hosts.inbox');

    }

    public function removeInbox($id)
    {
        PropertiesBookingEnquiry::where('id', '=', $id)->delete();
    }

    public function hostProperties(Request $request)
    {
        $items = Property::select('properties.*', 'countries.cname', 'cities.cityname')
        ->leftJoin('countries', 'countries.id', '=', 'properties.country_id')
        ->leftJoin('cities', 'cities.id', '=', 'properties.city_id')
        ->where('countries.status', '=', 1)
        ->where('properties.type', '=', 1)
        ->where('properties.user_id', '=', Auth::id())
        ->orderby('properties.id', 'desc')
            ->paginate(9);

        return view('users.hosts.properties', compact('items'));
    }

    public function hostAddProperty($id = null)
    {
        if(Auth::user()->account_iban == null)
        {
            $itemCount = Property::where('user_id', '=', Auth::id())->count();
            if($itemCount > 1)
            {
                return redirect('host/manage-bank-detail')->with('danger', 'You need to add Bank Details first to view this page!');
            }
        }
        $item = array();
        $item = Property::select('properties.*', 'cities.cityname')
            ->leftJoin('cities', 'cities.id', '=', 'properties.city_id')->where('properties.id', '=', $id)->first();

        $countries = array();
        $countries = Country::pluck('cname', 'id');

        $amenities = Amenity::where('status', '=', 1)->get();
        $renttypes = RentTypes::where('status', '=', 1)->get();
        $suitables = Suitable::where('status', '=', 1)->get();

        $property_amenities = array();
        $property_renttypes = array();
        $property_suitables = array();
        $recordImage = array();

        if($item)
        {
            $property_amenities = PropertiesAmenities::where('property_id', '=', $id)
            ->pluck('amenity_id', 'id')->toArray();

            $property_renttypes = PropertiesRenttypes::where('property_id', '=', $id)
            ->pluck('renttype_id', 'id')->toArray();

            $property_suitables = PropertiesSuitable::where('property_id', '=', $id)
            ->pluck('suitbale_id', 'id')->toArray();

            $recordImage = PropertiesImages::where('property_id', '=', $id)->get();
        }

        return view('users.hosts.manage-property', ['item' => $item, 'countries' => $countries, 'amenities' => $amenities, 'renttypes' => $renttypes, 'suitables' => $suitables, 'property_amenities' => $property_amenities, 'property_renttypes' => $property_renttypes, 'property_suitables' => $property_suitables, 'recordImage' => $recordImage]);
    }

    public function doSaveHostProperty(Request $request)
    {

        $post = $request->all();
        $valid_extension = array("jpg","jpeg","png");
        $maxFileSize = 2097152; 
        
        $item = new Property;

        if($post['id'])
        {
            $id = intval($post['id']);
            $item = $item->find($id);
            if($item->count() > 0)
            {
                $item->title = $post['title'];
                $item->description = $post['description'];
                $item->original_price = $post['original_price'];
                $item->discount_price = $post['discount_price'];
                $item->sqft = $post['sqft'];
                $item->bed = $post['bed'];
                $item->bath = $post['bath'];
                $item->adults = $post['adults'];
                $item->children = $post['children'];
                //$item->featured = ($request->get('featured') == 1) ? 1 : 0;
                $item->latitude = $post['latitude'];
                $item->longitude = $post['longitude'];
                $item->area = $post['area'];
                $item->city_id = $post['city_id'];
                $item->country_id = $post['country_id'];
                $item->maximum_days = $post['maximum_days'];
                $item->video = $post['video'];
                $item->ready_to_pay = ($request->get('ready_to_pay') == 1) ? 1 : 0;
                $item->cancellation = ($request->get('cancellation') == 1) ? 1 : 0;
                $item->status = 0;
                $item->slug = Str::slug($post['title'], '-');
                
                if($request->has('image')) 
                {
                    $image = $request->file('image');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        if($fileSize <= $maxFileSize)
                        {
                            if($item->count()>0)
                            {
                                $this->UnlinkImage("properties/", $item->image);
                            }
                            $name = Str::slug($request->get('title')).'_'.time();
                            $folder = '/uploads/properties/';
                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                            $this->uploadOne($image, $folder, 'public', $name);
                            $item->image = $filePath;
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
                
                $item->save();

                if($request->has('group-a'))
                {
                    $gallery = $post['group-a'];

                    if(count($gallery) > 1)
                    {

                        $img_id_not = array();
                        foreach ($gallery as $parent)
                        {
                            $recordImage = PropertiesImages::where('property_id', '=', $item->id)
                            ->where('id', '=', $parent['img_id'])
                            ->first();
                            if($recordImage)
                            {
                                $img_ID = intval($recordImage->id);

                                $itemUpdate = new PropertiesImages;
                                $itemUpdate = $itemUpdate->find($img_ID);

                                if(isset($parent['image'])) 
                                {
                                    // Get image file
                                    $image = $parent['image'];
                                    $fileSize = $image->getSize();
                                    $extension = $image->getClientOriginalExtension();

                                    if(in_array(strtolower($extension),$valid_extension))
                                    {
                                        // Check file size
                                        if($fileSize <= $maxFileSize)
                                        {
                                            //Path Delete
                                            if($itemUpdate->count()>0)
                                            {
                                                $this->UnlinkImage("properties/", $itemUpdate->image);
                                            }
                                            //Path Delete
                                            // Make a image name based on user name and current timestamp
                                            $name = $post['title']."_".time().rand(1,20);
                                            // Define folder path
                                            $folder = '/uploads/properties/';
                                            // Make a file path where image will be stored [ folder path + file name + file extension]
                                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                                            // Upload image
                                            $this->uploadOne($image, $folder, 'public', $name);
                                            // Set user profile image path in database to filePath
                                            $itemUpdate->image = $filePath;

                                        }
                                    }
                                $itemUpdate->save();
                                }
                                array_push($img_id_not, $itemUpdate->id);
                            }
                            else
                            {
                                $itemAdd = new PropertiesImages;
                                $itemAdd->property_id = $item->id;
                                if($parent['image']) 
                                {
                                    // Get image file
                                    $image = $parent['image'];
                                    $fileSize = $image->getSize();
                                    $extension = $image->getClientOriginalExtension();

                                    if(in_array(strtolower($extension),$valid_extension))
                                    {
                                        // Check file size
                                        if($fileSize <= $maxFileSize)
                                        {
                                            // Make a image name based on user name and current timestamp
                                            $name = $post['title']."_".time().rand(1,20);
                                            // Define folder path
                                            $folder = '/uploads/properties/';
                                            // Make a file path where image will be stored [ folder path + file name + file extension]
                                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                                            // Upload image
                                            $this->uploadOne($image, $folder, 'public', $name);
                                            // Set user profile image path in database to filePath
                                            $itemAdd->image = $filePath;

                                        }
                                    }
                                }
                                $itemAdd->save();
                                array_push($img_id_not, $itemAdd->id);
                            }
                        }
                        PropertiesImages::where('property_id', '=', $item->id)->whereNotIn('id',$img_id_not)->delete();
                    }

                }

                if($request->has('property_amenities'))
                {
                    $amenities = array_filter($request->get('property_amenities'));
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

                if($request->has('property_renttypes'))
                {
                    $property_renttypes = array_filter($request->get('property_renttypes'));
                    if(!empty($property_renttypes)){
                        $property_renttypes_ids = array();
                        foreach($property_renttypes as $renttype){
                            if($renttype)
                            {
                                $regarr = array('renttype_id' => $renttype, 'property_id' => $item->id);
                                $PropertiesRenttypes = PropertiesRenttypes::firstOrNew($regarr);
                                $PropertiesRenttypes->renttype_id = $renttype;
                                $PropertiesRenttypes->property_id = $item->id;
                                $PropertiesRenttypes->save();
                                array_push($property_renttypes_ids, $PropertiesRenttypes->id);
                            }
                            PropertiesRenttypes::whereNotIn('id', $property_renttypes_ids)
                                ->where('property_id', '=', $item->id)->delete();
                        }
                    }
                    else
                    {
                        PropertiesRenttypes::where('property_id', '=', $item->id)->delete();
                    }
                } 
                else
                {
                    PropertiesRenttypes::where('property_id', '=', $item->id)->delete();
                }

                if($request->has('property_suitables'))
                {
                    $property_suitables = array_filter($request->get('property_suitables'));
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

                return redirect('host/properties')->with('success', 'Successfully Updated');
            }
        }
        else
        {
            //Adding for New User

            $rules = array(
            'title' => 'required|string|max:255|unique:properties',
            'original_price' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            );

            $validation =  Validator::make($request->all(), $rules);
                
            if($validation->fails())
            {
                return redirect()->back()->withInput($request->all())->withErrors($validation);
            } 
            else 
            {
                $item = new Property;
                $item->user_id = Auth::id();
                $item->title = $post['title'];
                $item->description = $post['description'];
                $item->original_price = $post['original_price'];
                $item->discount_price = $post['discount_price'];
                $item->sqft = $post['sqft'];
                $item->bed = $post['bed'];
                $item->bath = $post['bath'];
                $item->adults = $post['adults'];
                $item->children = $post['children'];
                //$item->featured = ($request->get('featured') == 1) ? 1 : 0;
                $item->latitude = $post['latitude'];
                $item->longitude = $post['longitude'];
                $item->area = $post['area'];
                $item->city_id = $post['city_id'];
                $item->country_id = $post['country_id'];
                $item->video = $post['video'];
                $item->maximum_days = $post['maximum_days'];
                $item->ready_to_pay = ($request->get('ready_to_pay') == 1) ? 1 : 0;
                $item->cancellation = ($request->get('cancellation') == 1) ? 1 : 0;
                $item->status = 0;
                $item->slug = Str::slug($post['title'], '-');
                
                if($request->has('image')) 
                {
                    $image = $request->file('image');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        if($fileSize <= $maxFileSize)
                        {
                            if($item->count()>0)
                            {
                                $this->UnlinkImage("properties/", $item->image);
                            }
                            $name = Str::slug($request->get('title')).'_'.time();
                            $folder = '/uploads/properties/';
                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                            $this->uploadOne($image, $folder, 'public', $name);
                            $item->image = $filePath;
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
                
                $item->save();

                if($request->has('group-a'))
                {
                    $gallery = $post['group-a'];

                    if(count($gallery) > 1)
                    {
                        $img_id_not = array();
                        foreach ($gallery as $parent)
                        {
                            $recordImage = PropertiesImages::where('property_id', '=', $item->id)
                            ->where('id', '=', $parent['img_id'])
                            ->first();
                            if($recordImage)
                            {
                                $img_ID = intval($recordImage->id);

                                $itemUpdate = new PropertiesImages;
                                $itemUpdate = $itemUpdate->find($img_ID);

                                if(isset($parent['image'])) 
                                {
                                    // Get image file
                                    $image = $parent['image'];
                                    $fileSize = $image->getSize();
                                    $extension = $image->getClientOriginalExtension();

                                    if(in_array(strtolower($extension),$valid_extension))
                                    {
                                        // Check file size
                                        if($fileSize <= $maxFileSize)
                                        {
                                            //Path Delete
                                            if($itemUpdate->count()>0)
                                            {
                                                $this->UnlinkImage("properties/", $itemUpdate->image);
                                            }
                                            //Path Delete
                                            // Make a image name based on user name and current timestamp
                                            $name = $post['title']."_".time().rand(1,20);
                                            // Define folder path
                                            $folder = '/uploads/properties/';
                                            // Make a file path where image will be stored [ folder path + file name + file extension]
                                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                                            // Upload image
                                            $this->uploadOne($image, $folder, 'public', $name);
                                            // Set user profile image path in database to filePath
                                            $itemUpdate->image = $filePath;

                                        }
                                    }
                                $itemUpdate->save();
                                }
                                array_push($img_id_not, $itemUpdate->id);
                            }
                            else
                            {
                                $itemAdd = new PropertiesImages;
                                $itemAdd->property_id = $item->id;
                                if($parent['image']) 
                                {
                                    // Get image file
                                    $image = $parent['image'];
                                    $fileSize = $image->getSize();
                                    $extension = $image->getClientOriginalExtension();

                                    if(in_array(strtolower($extension),$valid_extension))
                                    {
                                        // Check file size
                                        if($fileSize <= $maxFileSize)
                                        {
                                            // Make a image name based on user name and current timestamp
                                            $name = $post['title']."_".time().rand(1,20);
                                            // Define folder path
                                            $folder = '/uploads/properties/';
                                            // Make a file path where image will be stored [ folder path + file name + file extension]
                                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                                            // Upload image
                                            $this->uploadOne($image, $folder, 'public', $name);
                                            // Set user profile image path in database to filePath
                                            $itemAdd->image = $filePath;

                                        }
                                    }
                                }
                                $itemAdd->save();
                                array_push($img_id_not, $itemAdd->id);
                            }
                        }
                        PropertiesImages::where('property_id', '=', $item->id)->whereNotIn('id',$img_id_not)->delete();
                    }

                }    

                if($request->has('property_amenities'))
                {
                    $amenities = array_filter($request->get('property_amenities'));
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

                if($request->has('property_renttypes'))
                {
                    $property_renttypes = array_filter($request->get('property_renttypes'));
                    if(!empty($property_renttypes)){
                        $property_renttypes_ids = array();
                        foreach($property_renttypes as $renttype){
                            if($renttype)
                            {
                                $regarr = array('renttype_id' => $renttype, 'property_id' => $item->id);
                                $PropertiesRenttypes = PropertiesRenttypes::firstOrNew($regarr);
                                $PropertiesRenttypes->renttype_id = $renttype;
                                $PropertiesRenttypes->property_id = $item->id;
                                $PropertiesRenttypes->save();
                                array_push($property_renttypes_ids, $PropertiesRenttypes->id);
                            }
                            PropertiesRenttypes::whereNotIn('id', $property_renttypes_ids)
                                ->where('property_id', '=', $item->id)->delete();
                        }
                    }
                    else
                    {
                        PropertiesRenttypes::where('property_id', '=', $item->id)->delete();
                    }
                } 
                else
                {
                    PropertiesRenttypes::where('property_id', '=', $item->id)->delete();
                }

                if($request->has('property_suitables'))
                {
                    $property_suitables = array_filter($request->get('property_suitables'));
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

                return redirect('host/properties')->with('success', 'Successfully Updated');
            }
        }
    }

    public function deleteProperty($id)
    {
        $data = Properties::findOrFail($id);
        $this->UnlinkImage("properties/", $data->image);
        $data->delete();
        PropertiesAmenities::where('property_id','=', $id)->delete();
        PropertiesImages::where('property_id','=', $id)->delete();
    }

    public function hostTours(Request $request)
    {
        $items = Property::select('properties.*', 'countries.cname', 'cities.cityname')
        ->leftJoin('countries', 'countries.id', '=', 'properties.country_id')
        ->leftJoin('cities', 'cities.id', '=', 'properties.city_id')
        ->where('countries.status', '=', 1)
        ->where('properties.type', '=', 2)
        ->where('properties.user_id', '=', Auth::id())
        ->orderby('properties.id', 'desc')
            ->paginate(9);

        return view('users.hosts.tours', compact('items'));
    }

    public function hostAddTour($id = null)
    {
        $item = array();
        $item = Property::select('properties.*', 'cities.cityname')
            ->leftJoin('cities', 'cities.id', '=', 'properties.city_id')
            ->where('properties.type', '=', 2)
            ->where('properties.id', '=', $id)->first();

        $countries = array();
        $countries = Country::pluck('cname', 'id');
        $recordImage = array();

        if($item)
        {
            $recordImage = PropertiesImages::where('property_id', '=', $id)->get();
        }

        return view('users.hosts.manage-tour', ['item' => $item, 'countries' => $countries, 'recordImage' => $recordImage]);
    }

    public function doSaveHostTour(Request $request)
    {

        $post = $request->all();
        $valid_extension = array("jpg","jpeg","png");
        $maxFileSize = 2097152; 
        
        $item = new Property;

        if($post['id'])
        {
            $id = intval($post['id']);
            $item = $item->find($id);
            if($item->count() > 0)
            {
                $item->user_id = Auth::id();
                $item->title = $post['title'];
                $item->description = $post['description'];
                $item->tour_included = $post['tour_included'];
                $item->tour_excluded = $post['tour_excluded'];
                $item->tour_highlight = $post['tour_highlight'];
                $item->original_price = $post['original_price'];
                $item->adults = $post['adults'];
                $item->children = $post['children'];
                $item->infant = $post['infant'];
                $item->tour_type = 'daily';
                //$item->featured = ($request->get('featured') == 1) ? 1 : 0;
                $item->latitude = $post['latitude'];
                $item->longitude = $post['longitude'];
                $item->area = $post['area'];
                $item->city_id = $post['city_id'];
                $item->country_id = $post['country_id'];
                $item->video = $post['video'];
                $item->tour_duration = $post['duration'];
                $item->sqft = $post['sqft'];
                $item->ready_to_pay = ($request->get('ready_to_pay') == 1) ? 1 : 0;
                $item->cancellation = ($request->get('cancellation') == 1) ? 1 : 0;
                $item->status = 0;
                $item->type = 2;
                $item->slug = Str::slug($post['title'], '-');
                
                if($request->has('image')) 
                {
                    $image = $request->file('image');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        if($fileSize <= $maxFileSize)
                        {
                            if($item->count()>0)
                            {
                                $this->UnlinkImage("tours/", $item->image);
                            }
                            $name = Str::slug($request->get('title')).'_'.time().rand(1,20);
                            $folder = '/uploads/tours/';
                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                            $this->uploadOne($image, $folder, 'public', $name);
                            $item->image = $filePath;
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
                
                $item->save();

                if($request->has('group-a'))
                {
                    $gallery = $post['group-a'];
                    if(count($gallery) > 1)
                    {
                        $img_id_not = array();
                        foreach ($gallery as $parent)
                        {
                            $recordImage = PropertiesImages::where('property_id', '=', $item->id)
                            ->where('id', '=', $parent['img_id'])
                            ->first();
                            if($recordImage)
                            {
                                $img_ID = intval($recordImage->id);

                                $itemUpdate = new PropertiesImages;
                                $itemUpdate = $itemUpdate->find($img_ID);

                                if(isset($parent['image'])) 
                                {
                                    // Get image file
                                    $image = $parent['image'];
                                    $fileSize = $image->getSize();
                                    $extension = $image->getClientOriginalExtension();

                                    if(in_array(strtolower($extension),$valid_extension))
                                    {
                                        // Check file size
                                        if($fileSize <= $maxFileSize)
                                        {
                                            //Path Delete
                                            if($itemUpdate->count()>0)
                                            {
                                                $this->UnlinkImage("properties/", $itemUpdate->image);
                                            }
                                            //Path Delete
                                            // Make a image name based on user name and current timestamp
                                            $name = Str::slug($post['title'])."_".time().rand(1,20);
                                            // Define folder path
                                            $folder = '/uploads/tours/';
                                            // Make a file path where image will be stored [ folder path + file name + file extension]
                                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                                            // Upload image
                                            $this->uploadOne($image, $folder, 'public', $name);
                                            // Set user profile image path in database to filePath
                                            $itemUpdate->image = $filePath;

                                        }
                                    }
                                $itemUpdate->save();
                                }
                                array_push($img_id_not, $itemUpdate->id);
                            }
                            else
                            {
                                $itemAdd = new PropertiesImages;
                                $itemAdd->property_id = $item->id;
                                if($parent['image']) 
                                {
                                    // Get image file
                                    $image = $parent['image'];
                                    $fileSize = $image->getSize();
                                    $extension = $image->getClientOriginalExtension();

                                    if(in_array(strtolower($extension),$valid_extension))
                                    {
                                        // Check file size
                                        if($fileSize <= $maxFileSize)
                                        {
                                            // Make a image name based on user name and current timestamp
                                            $name = Str::slug($post['title'])."_".time().rand(1,20);
                                            // Define folder path
                                            $folder = '/uploads/tours/';
                                            // Make a file path where image will be stored [ folder path + file name + file extension]
                                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                                            // Upload image
                                            $this->uploadOne($image, $folder, 'public', $name);
                                            // Set user profile image path in database to filePath
                                            $itemAdd->image = $filePath;

                                        }
                                    }
                                }
                                $itemAdd->save();
                                array_push($img_id_not, $itemAdd->id);
                            }
                        }
                        PropertiesImages::where('property_id', '=', $item->id)->whereNotIn('id',$img_id_not)->delete();
                    }
                }

                return redirect('host/tours')->with('success', 'Successfully Updated');
            }
        }
        else
        {
            //Adding for New User

            $rules = array(
            'title' => 'required|string|max:255|unique:properties',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            );

            $validation =  Validator::make($request->all(), $rules);
                
            if($validation->fails())
            {
                return redirect()->back()->withInput($request->all())->withErrors($validation);
            } 
            else 
            {
                $item = new Property;
                $item->user_id = Auth::id();
                $item->title = $post['title'];
                $item->description = $post['description'];
                $item->tour_included = $post['tour_included'];
                $item->tour_excluded = $post['tour_excluded'];
                $item->tour_highlight = $post['tour_highlight'];
                $item->original_price = $post['original_price'];
                $item->adults = $post['adults'];
                $item->children = $post['children'];
                $item->infant = $post['infant'];
                $item->tour_type = 'daily';
                //$item->featured = ($request->get('featured') == 1) ? 1 : 0;
                $item->latitude = $post['latitude'];
                $item->longitude = $post['longitude'];
                $item->area = $post['area'];
                $item->city_id = $post['city_id'];
                $item->country_id = $post['country_id'];
                $item->video = $post['video'];
                $item->tour_duration = $post['duration'];
                $item->sqft = $post['sqft'];
                $item->ready_to_pay = ($request->get('ready_to_pay') == 1) ? 1 : 0;
                $item->cancellation = ($request->get('cancellation') == 1) ? 1 : 0;
                $item->status = 0;
                $item->type = 2;
                $item->slug = Str::slug($post['title'], '-');
                
                if($request->has('image')) 
                {
                    $image = $request->file('image');
                    $fileSize = $image->getSize();
                    $extension = $image->getClientOriginalExtension();

                    if(in_array(strtolower($extension),$valid_extension))
                    {
                        if($fileSize <= $maxFileSize)
                        {
                            if($item->count()>0)
                            {
                                $this->UnlinkImage("tours/", $item->image);
                            }
                            $name = Str::slug($request->get('title')).'_'.time().rand(1,20);
                            $folder = '/uploads/tours/';
                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                            $this->uploadOne($image, $folder, 'public', $name);
                            $item->image = $filePath;
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
                
                $item->save();

                if($request->has('group-a'))
                {
                    $gallery = $post['group-a'];
                    if(count($gallery) > 1)
                    {
                        $img_id_not = array();
                        foreach ($gallery as $parent)
                        {
                            $recordImage = PropertiesImages::where('property_id', '=', $item->id)
                            ->where('id', '=', $parent['img_id'])
                            ->first();
                            if($recordImage)
                            {
                                $img_ID = intval($recordImage->id);

                                $itemUpdate = new PropertiesImages;
                                $itemUpdate = $itemUpdate->find($img_ID);

                                if(isset($parent['image'])) 
                                {
                                    // Get image file
                                    $image = $parent['image'];
                                    $fileSize = $image->getSize();
                                    $extension = $image->getClientOriginalExtension();

                                    if(in_array(strtolower($extension),$valid_extension))
                                    {
                                        // Check file size
                                        if($fileSize <= $maxFileSize)
                                        {
                                            //Path Delete
                                            if($itemUpdate->count()>0)
                                            {
                                                $this->UnlinkImage("tours/", $itemUpdate->image);
                                            }
                                            //Path Delete
                                            // Make a image name based on user name and current timestamp
                                            $name = Str::slug($post['title'])."_".time().rand(1,20);
                                            // Define folder path
                                            $folder = '/uploads/tours/';
                                            // Make a file path where image will be stored [ folder path + file name + file extension]
                                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                                            // Upload image
                                            $this->uploadOne($image, $folder, 'public', $name);
                                            // Set user profile image path in database to filePath
                                            $itemUpdate->image = $filePath;

                                        }
                                    }
                                $itemUpdate->save();
                                }
                                array_push($img_id_not, $itemUpdate->id);
                            }
                            else
                            {
                                $itemAdd = new PropertiesImages;
                                $itemAdd->property_id = $item->id;
                                if($parent['image']) 
                                {
                                    // Get image file
                                    $image = $parent['image'];
                                    $fileSize = $image->getSize();
                                    $extension = $image->getClientOriginalExtension();

                                    if(in_array(strtolower($extension),$valid_extension))
                                    {
                                        // Check file size
                                        if($fileSize <= $maxFileSize)
                                        {
                                            // Make a image name based on user name and current timestamp
                                            $name = Str::slug($post['title'])."_".time().rand(1,20);
                                            // Define folder path
                                            $folder = '/uploads/tours/';
                                            // Make a file path where image will be stored [ folder path + file name + file extension]
                                            $filePath = $name. '.' . $image->getClientOriginalExtension();
                                            // Upload image
                                            $this->uploadOne($image, $folder, 'public', $name);
                                            // Set user profile image path in database to filePath
                                            $itemAdd->image = $filePath;

                                        }
                                    }
                                }
                                $itemAdd->save();
                                array_push($img_id_not, $itemAdd->id);
                            }
                        }
                        PropertiesImages::where('property_id', '=', $item->id)->whereNotIn('id',$img_id_not)->delete();
                    }
                }

                return redirect('host/tours')->with('success', 'Successfully Updated');
            }
        }
    }

    public function deleteTour($id)
    {
        $data = Properties::findOrFail($id);
        $this->UnlinkImage("tours/", $data->image);
        $data->delete();
        PropertiesImages::where('property_id','=', $id)->delete();
    }

    public function doSaveCommments(Request $request)
    {

        $rules = array(
            'property_id' => 'required',
            'rating' => 'required',
        );

        $validation =  Validator::make($request->all(), $rules);

        if($validation->fails())
        {
            return redirect()->back()->withInput($request->all())->withErrors($validation);
        } 
        else 
        {

            $post = $request->all();

            $Comment =  Feedback::where('property_id', '=', $post['property_id'])
            ->where('user_id', '=', Auth::id())
            ->first();

            if($Comment == null)
            {
                $item = new Feedback;
                $item->property_id = $post['property_id'];
                $item->user_id = Auth::id();
                $item->comment = $post['comment'];
                $item->rating = $post['rating'];
                $item->type = 'Property';
                $item->user_type = 'User';
                $item->save();

                return redirect()->back()->with('success', 'Comment Submitted Successfully!');
            }
            else
            {
                return redirect()->back()->with('danger', 'You already comment on it.');
            }
        }
    }

    public function hostViewProperty($property_id, Request $request)
    {

        if(request()->ajax())
        {
            $data = OrdersItem::select('orders_item.*', 'properties.code', 'properties.title', 'users.name', 'users.email', 'users.mobile')
        ->leftJoin('properties', 'properties.id', '=', 'orders_item.property_id')
        ->leftJoin('users', 'users.id', '=', 'orders_item.user_id')
        ->where('properties.id', '=', $property_id)
        ->where('properties.user_id', '=', Auth::id())
        ->where('orders_item.order_type', '=', 'Property');

            return Datatables::of($data)
            ->editColumn('created_at', function ($request) {
                return [
                  'display' => e($request->created_at->format('d-m-Y')),
                  'timestamp' => $request->created_at->timestamp
                ];
                })
            ->filterColumn('created_at', function ($query, $keyword) {
               $query->whereRaw("DATE_FORMAT(created_at,'%d-%m-%Y') LIKE ?", ["%$keyword%"]);
            })
            ->editColumn('status', '@if($status == "Pending") <span class="label label-info">{{ "Pending" }} </span> @elseif($status == "Check-In") <span class="label label-success">{{ "Check-In" }} </span> @elseif($status == "Check-Out") <span class="label label-danger">{{ "Check-Out" }} </span> @else <span class="label label-danger">{{ "" }}</span> @endif')
            ->rawColumns(['status', 'action'])
            ->make(true);

        }

        return view('users.hosts.view-property-orders', ['property_id' => $property_id]);

    }

    public function hostViewTour($property_id, Request $request)
    {

        if(request()->ajax())
        {
            $data = OrdersItem::select('orders_item.*', 'properties.code', 'properties.title', 'users.name', 'users.email', 'users.mobile')
        ->leftJoin('properties', 'properties.id', '=', 'orders_item.property_id')
        ->leftJoin('users', 'users.id', '=', 'orders_item.user_id')
        ->where('properties.id', '=', $property_id)
        ->where('properties.user_id', '=', Auth::id())
        ->where('orders_item.order_type', '=', 'Tour');

            return Datatables::of($data)
            ->editColumn('created_at', function ($request) {
                return [
                  'display' => e($request->created_at->format('d-m-Y')),
                  'timestamp' => $request->created_at->timestamp
                ];
                })
            ->filterColumn('created_at', function ($query, $keyword) {
               $query->whereRaw("DATE_FORMAT(created_at,'%d-%m-%Y') LIKE ?", ["%$keyword%"]);
            })
            ->rawColumns(['action'])
            ->make(true);

        }

        return view('users.hosts.view-tour-orders', ['property_id' => $property_id]);

    }
}
