<?php

namespace App\Http\Controllers;

use App\Models\ProductSubCategories;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Property;
use App\Models\Help;
use App\Models\HelpCategory;
use App\Models\HelpSubCategory;
use App\Models\SettingsApp;
use App\Models\Pages;
use DB;
use Mail;
use Artisan;
use Session;

class GeneralController extends Controller
{
    public function syedClears()
    {
        
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        Artisan::call('view:cache');
    
        echo "Reading";

    }

    public function currency($locale)
    {
        $currencyVal = SettingsApp::select('gbp', 'eur')->where('id', '=', 1)->first();
        if($locale == 'eur')
        {
            session()->put('value', $currencyVal->eur);
        }
        else
        {
            session()->put('value', $currencyVal->gbp);
        }
        session()->put('currency', $locale);
        return redirect()->back();
    }

    public function fetchCountry(Request $request)
    {
        $country_id = $request->get('country_id');
        $getCities = City::where('country_id', '=', $country_id)->orderBy('cityname', 'asc')->pluck("id", "cityname");
        return response()->json($getCities);

    }

    public function fetchCategory(Request $request)
    {
        $type = $request->get('type');
        $getCats = HelpCategory::where('type', '=', $type)->pluck("name","id");
        return response()->json($getCats);

    }

    public function fetchSubCategory(Request $request)
    {
        $help_cid = $request->get('help_cid');
        $getSubCats = HelpSubCategory::where('help_cid', '=', $help_cid)->pluck("sub_name","id");
        return response()->json($getSubCats);

    }

    public function home(Request $request)
    {
        if(!Session::has('currency'))
        {
            Session::put('value', 1);
            Session::put('currency', 'gbp');
        }
        

        $topcities = City::with(['properties'])->where('top', '=', 1)->where('country_id', '=', 1)->inRandomOrder()->limit(8)->get();

        $properties = array();
        $properties = Property::select('*')->where('featured', '=', 1)->where('type', '=', 1)->inRandomOrder()->limit(8)->get();

        $tours = array();
        $tours = Property::select('*')->where('type', '=', 2)->inRandomOrder()->limit(8)->get();

        $locations = City::orderBy('cityname', 'asc')->pluck('cityname' ,'id');
        
        return view('general.home', ['topcities' => $topcities, 'properties' => $properties, 'tours' => $tours, 'locations' => $locations]);
    }

    public function aboutUs(Request $request)
    {
        $item = Pages::select('*')->where('id', '=', 7)->first();
        return view('general.aboutus', ['item' => $item]);
    }

    public function contactUs(Request $request)
    {
        $item = Pages::select('*')->where('id', '=', 8)->first();
        return view('general.contactus', ['item' => $item]);
    }

    public function privacyPolicy(Request $request)
    {
        $item = Pages::select('*')->where('id', '=', 6)->first();
        return view('general.privacypolicy', ['item' => $item]);
    }

    public function TermsNConditions(Request $request)
    {
        $item = Pages::select('*')->where('id', '=', 5)->first();
        return view('general.termsandconditions', ['item' => $item]);
    }

    public function helpHosting(Request $request)
    {
        $item = Pages::select('*')->where('id', '=', 11)->first();
        $items = HelpCategory::select('*')->where('type', '=', 2)->get();
        return view('helps.hosting', ['items' => $items, 'item' => $item]);
    }

    public function hostingSubCategory($slug = null)
    {
        if($slug)
        {
            $page = Pages::select('*')->where('id', '=', 11)->first();

            $cat = HelpCategory::select('*')->where('slug', '=', $slug)->where('type', '=', 2)->first();

            if($cat)
            {
                $sub_cat = HelpSubCategory::select('*')->where('type', '=', 2)
                ->where('help_cid', '=', $cat->id)
                ->get();

                return view('helps.hosting-sub-category', ['page' => $page, 'cat' => $cat, 'sub_cat' => $sub_cat]);
            }
            else
            {
                return redirect('hosting-help');
            }
            
        }
        else
        {
            echo "Something wrong";
        }
        
    }

    public function hostingSubCategoryList($slug = null)
    {
        if($slug)
        {

            $page = Pages::select('*')->where('id', '=', 11)->first();

            $sub_cat = HelpSubCategory::select('helps_sub_category.id', 'helps_sub_category.sub_name', 'helps_sub_category.description', 'helps_category.name', 'helps_category.slug')
            ->leftJoin('helps_category', 'helps_category.id', '=', 'helps_sub_category.help_cid')
            ->where('helps_sub_category.type', '=', 2)
            ->where('helps_sub_category.slug', '=', $slug)
            ->first();

            $faqs = Help::select('*')
            ->where('type', '=', 2)
            ->where('sub_category_id', '=', $sub_cat->id)
            ->get();

            return view('helps.hosting-sub-category-details', ['page' => $page, 'sub_cat' => $sub_cat, 'faqs' => $faqs]);
        }
        else
        {
            echo "Something wrong";
        }
        
    }

    public function helpHostingDetail($slug = null)
    {
        if($slug)
        {

            $page = Pages::select('*')->where('id', '=', 11)->first();

            $helpdetail = Help::select('*')
            ->where('type', '=', 2)
            ->where('slug', '=', $slug)
            ->first();

            $sub_cat = HelpSubCategory::select('*', 'helps_category.name', 'helps_category.slug')
            ->leftJoin('helps_category', 'helps_category.id', '=', 'helps_sub_category.help_cid')
            ->where('helps_sub_category.type', '=', 2)
            ->where('helps_sub_category.id', '=', $helpdetail->sub_category_id)
            ->first();

            $relatedlist = array();
            $relatedlist = Help::select('helps.*')
            ->where('sub_category_id', '=', $helpdetail->sub_category_id)
            ->where('type', '=', 2)
            ->get();

            return view('helps.hosting-detail', ['page' => $page, 'helpdetail' => $helpdetail, 'sub_cat' => $sub_cat, 'relatedlist' => $relatedlist]);
        }
        else
        {
            echo "Something wrong";
        }
    }

    public function helpTraveling(Request $request)
    {
        $item = Pages::select('*')->where('id', '=', 10)->first();
        $items = HelpCategory::select('*')->where('type', '=', 1)->get();
        return view('helps.traveling', ['items' => $items, 'item' => $item]);
    }

    public function travelingSubCategory($slug = null)
    {
        if($slug)
        {
            $page = Pages::select('*')->where('id', '=', 10)->first();

            $cat = HelpCategory::select('*')->where('type', '=', 1)->where('slug', '=', $slug)->first();

            if($cat)
            {
                $sub_cat = HelpSubCategory::select('*')->where('type', '=', 1)
                ->where('help_cid', '=', $cat->id)
                ->get();

                return view('helps.traveling-sub-category', ['page' => $page, 'cat' => $cat, 'sub_cat' => $sub_cat]);
            }
            else
            {
                return redirect('traveling-help');
            }
        }
        else
        {
            echo "Something wrong";
        }
        
    }

    public function travelingSubCategoryList($slug = null)
    {
        if($slug)
        {

            $page = Pages::select('*')->where('id', '=', 10)->first();

            $sub_cat = HelpSubCategory::select('helps_sub_category.id', 'helps_sub_category.sub_name', 'helps_sub_category.description', 'helps_category.name', 'helps_category.slug')
            ->leftJoin('helps_category', 'helps_category.id', '=', 'helps_sub_category.help_cid')
            ->where('helps_sub_category.type', '=', 1)
            ->where('helps_sub_category.slug', '=', $slug)
            ->first();

            $faqs = Help::select('*')
            ->where('type', '=', 1)
            ->where('sub_category_id', '=', $sub_cat->id)
            ->get();

            return view('helps.traveling-sub-category-details', ['page' => $page, 'sub_cat' => $sub_cat, 'faqs' => $faqs]);
        }
        else
        {
            echo "Something wrong";
        }
        
    }

    public function helpTravelingDetail($slug = null)
    {
        if($slug)
        {

            $page = Pages::select('*')->where('id', '=', 10)->first();

            $helpdetail = Help::select('*')
            ->where('type', '=', 1)
            ->where('slug', '=', $slug)
            ->first();

            $sub_cat = HelpSubCategory::select('*', 'helps_category.name', 'helps_category.slug')
            ->leftJoin('helps_category', 'helps_category.id', '=', 'helps_sub_category.help_cid')
            ->where('helps_sub_category.type', '=', 1)
            ->where('helps_sub_category.id', '=', $helpdetail->sub_category_id)
            ->first();

            $relatedlist = array();
            $relatedlist = Help::select('helps.*')
            ->where('sub_category_id', '=', $helpdetail->sub_category_id)
            ->where('type', '=', 1)
            ->get();

            return view('helps.traveling-detail', ['page' => $page, 'helpdetail' => $helpdetail, 'sub_cat' => $sub_cat, 'relatedlist' => $relatedlist]);
        }
        else
        {
            echo "Something wrong";
        }
    }

    public function pages($slug = null)
    {
        if($slug)
        {
            $item = Pages::select('*')->where('slug', '=', $slug)->first();
            return view('general.single-page', ['item' => $item]);
        }
        else
        {
            echo "Something wrong";
        }
    }

    public function emailTemp() 
    {

        $email = 'danishah72@gmail.com';
        $view_pass = 123456;

        $data = array('name' => 'Syed Dani', 'email' => $email,'password' => $view_pass);

            $subject = 'Login Details';

            Mail::send('emails/send-password', $data, function($message) use ($email, $subject) {
              $message->from('info@propertystays.com', 'PropertyStays.com');
              $message->to($email)->subject($subject);
            });

        

        if (Mail::failures()) {
            dd(Mail::failures());
        }

        echo 'Sendt';

        //return view('emails.send-password', ['name' => 'Syed', 'email' => 'email@gmail.com', 'password' => 'password']);
    }
}
