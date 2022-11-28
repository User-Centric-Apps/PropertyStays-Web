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
use App\Models\RentTypes;
use App\Models\Amenity;
use App\Models\Suitable;
use URL;
   
class GeneralController extends BaseController
{

    public function currency()
    {
        $currencyVal = SettingsApp::select('gbp', 'eur', 'comission')->where('id', '=', 1)->first();
        return $this->sendResponse($currencyVal, 'Currency fetched.');
    }

    public function fetchCountry(Request $request)
    {
        $country_id = $request->get('country_id');
        $getCities = City::where('country_id', '=', $country_id)->pluck("cityname","id");
        return $this->sendResponse($getCities, 'Country fetched.');

    }

    public function fetchCategory(Request $request)
    {
        $type = $request->get('type');
        $getCats = HelpCategory::where('type', '=', $type)->pluck("name","id");
        return $this->sendResponse($getCats, 'Category fetched.');

    }

    public function fetchSubCategory(Request $request)
    {
        $help_cid = $request->get('help_cid');
        $getSubCats = HelpSubCategory::where('help_cid', '=', $help_cid)->pluck("sub_name","id");
        return $this->sendResponse($getSubCats, 'Sub Category Fetched');

    }

    public function fetchRentalTypes(Request $request)
    {
        $getRentTypes = RentTypes::get();

        $result = array();
        foreach($getRentTypes as $item)
        {
            $result[] = array(
                "id" => $item->id,
                "title" => $item->name,
            );
        }

        return $this->sendResponse($result, 'fetchRentalTypes fetched.');

    }

    public function fetchSuitableFor(Request $request)
    {
        $getSuitable = Suitable::get();

        $result = array();
        foreach($getSuitable as $item)
        {
            $result[] = array(
                "id" => $item->id,
                "title" => $item->suitable_name,
            );
        }

        return $this->sendResponse($result, 'fetchSuitableFor fetched.');

    }

    public function fetchAmenities(Request $request)
    {
        $getAmenity = Amenity::get();

        $result = array();
        foreach($getAmenity as $item)
        {
            $result[] = array(
                "id" => $item->id,
                "title" => $item->name,
            );
        }

        return $this->sendResponse($result, 'fetchAmenities fetched.');

    }

    public function fetchHelpCategory(Request $request)
    {
        $type = $request->get('type');
        $getHostingCategory = HelpCategory::select('*')->where('type', '=', $type)->get();

        $result = array();
        foreach($getHostingCategory as $item)
        {
            $result[] = array(
                "id" => $item->id,
                "name" => $item->name,
            );
        }

        return $this->sendResponse($result, 'getHostingCategory fetched.');

    }

    public function fetchSubHelpCategory(Request $request)
    {
        $type = $request->get('type');
        $getHelpSubCategory = HelpSubCategory::select('*')
            ->where('type', '=', $type)
            ->get();

        $result = array();
        foreach($getHelpSubCategory as $item)
        {
            $result[] = array(
                "id" => $item->id,
                "sub_name" => $item->sub_name,
            );
        }

        return $this->sendResponse($result, 'getHelpSubCategory fetched.');

    }

    public function fetchHelpDetail(Request $request)
    {
        $sub_category_id = $request->get('sub_category_id');
        $getHostingDetail = Help::select('*')
            ->where('sub_category_id', '=', $sub_category_id)
            ->get();

        $result = array();
        foreach($getHostingDetail as $item)
        {
            $result[] = array(
                "title" => $item->title,
                "description" => $item->description,
            );
        }    

        return $this->sendResponse($result, 'fetchHostingDetail fetched.');

    }

    public function fetchPages(Request $request)
    {
        $slug = $request->get('slug');
        $item = Pages::select('*')->where('slug', '=', $slug)->first();

        $result = array(
            "title" => $item->title,
            "image" => URL::asset('storage/app/public/uploads/pages/'.$item->image),
            "description" => $item->description,
        );

        return $this->sendResponse($result, 'fetchPages fetched.');

    }

    public function sendContactMessage(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $subject = $request->get('subject');
        $message = $request->get('message');

        $result = array("status" => 1, "msg" => "sent successfully to ".$name);

        return $this->sendResponse($result, 'fetchPages fetched.');

    }
   
}