<?php

function allPropertiesCount()
{
	return  App\Models\City::with(['properties'])->orderBy('cityname', 'asc')
	->get();
}

function getHostMenu()
{
	return  App\Models\Pages::select('*')->where('type', 1)->get();

}

function getOtherMenu()
{
	return  App\Models\Pages::select('*')->where('type', '=', 2)->orderBy('title', 'asc')->get();

}

function getTravellerCat()
{
	return  App\Models\HelpCategory::select('*')->where('type', '=', 1)->orderBy('id', 'asc')->get();

}

function getHostCat()
{
	return  App\Models\HelpCategory::select('*')->where('type', '=', 2)->orderBy('id', 'asc')->get();

}

function checkWishList($property_id, $user_id)
{
	return App\Models\Wishlist::where('type', '=', 1)->where('property_id', '=', $property_id)->where('user_id', '=', $user_id)->count();

}

function inActiveProp()
{
	return  App\Models\Property::where('type', '=', 1)->where('status', '=', 0)->count();

}