<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Session;
use Carbon\Carbon;
use Auth;
use DB;
use App\Models\Country;
use App\Models\City;
use App\Models\Amenity;
use App\Models\RentTypes;
use App\Models\Property;
use App\Models\OrdersItem;
use App\Models\User;
use App\Models\Feedback;

class AdminController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $totals = [ 
                    'countries' => Country::where('status', '=', 1)->count(), 
                    'cities' => City::count(), 
                    'amenities' => Amenity::where('status', '=', 1)->count(),
                    'renttypes' => RentTypes::where('status', '=', 1)->count(),
                    'tours' => Property::where('status', '=', 1)->where('type', '=', 2)->count(),
                    'tours_booking' => OrdersItem::where('order_type', '=', 'tour')->count(),
                    'tours_feedback' => Feedback::where('type', '=', 'Tour')->count(),
                    'properties' => Property::where('status', '=', 1)->where('type', '=', 1)->count(),
                    'properties_booking' => OrdersItem::where('order_type', '=', 'property')->where('status', '!=', 'Check-Out')->count(),
                    'properties_feedback' => Feedback::where('type', '=', 'Property')->count(),
                    'hosts' => User::where(function($query) {
                        $query->where('type', '=', 1)
                            ->orWhere('type', '=', 3);
                    })->count(),
                    'customers' => User::where(function($query) {
                        $query->where('type', '=', 2)
                            ->orWhere('type', '=', 3);
                    })->count(),
                    'inactive_prop' => Property::where('status', '=', 0)->where('type', '=', 1)->count(),
                    'staffs' => 0 ,
                ];

        return view('admin.welcome', compact('totals'));

    }
}
