<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\GeneralController;
use App\Http\Controllers\API\DestinationController;
use App\Http\Controllers\API\UserController;

//General Functions
Route::post('currency', [GeneralController::class, 'currency']);
Route::get('fetch-country', [GeneralController::class, 'fetchCountry']);
Route::get('fetch-categories', [GeneralController::class, 'fetchCategory']);
Route::get('fetch-sub-categories', [GeneralController::class, 'fetchSubCategory']);
Route::get('fetch-rental-types', [GeneralController::class, 'fetchRentalTypes']);
Route::get('fetch-suitables-for', [GeneralController::class, 'fetchSuitableFor']);
Route::get('fetch-amenities', [GeneralController::class, 'fetchAmenities']);
Route::get('fetch-pages', [GeneralController::class, 'fetchPages']);

//Help Function
Route::get('fetch-help-category', [GeneralController::class, 'fetchHelpCategory']);
Route::get('fetch-help-sub-category', [GeneralController::class, 'fetchSubHelpCategory']);
Route::get('fetch-help-detail', [GeneralController::class, 'fetchHelpDetail']);

Route::get('fetch-toploc', [DestinationController::class, 'getTopLoc']);
Route::get('fetch-allloc', [DestinationController::class, 'getAllLoc']);
Route::get('fetch-homes', [DestinationController::class, 'getHomes']);
Route::get('fetch-tour', [DestinationController::class, 'getTour']);
Route::get('fetch-tours', [DestinationController::class, 'getTours']);
Route::get('fetch-lastminute', [DestinationController::class, 'getLastMinute']);
Route::post('find-city', [DestinationController::class, 'findCity']);
Route::post('property-detail', [DestinationController::class, 'propertyDetail']);
Route::post('tour-detail', [DestinationController::class, 'tourDetail']);
Route::post('contact-message', [GeneralController::class, 'sendContactMessage']);
Route::get('fetch-location', [DestinationController::class, 'getLocationAll']);


//Properties
Route::post('properties/search', [DestinationController::class, 'searchProperties']);


//User Favorite
Route::post('user/setpropertyfavorite', [UserController::class, 'userSetPropertyFavorite']);
Route::post('user/getfavoriterentals', [UserController::class, 'userFavouriteProperty']);
Route::post('user/getfavoritetrips', [UserController::class, 'userFavouriteTour']);
//User Favorite

//User
    Route::get('user/getprofile', [UserController::class, 'getProfile']);
    Route::post('user/updateprofile', [UserController::class, 'updateProfile']);
    Route::get('user/updatepicture', [UserController::class, 'updatePicture']);

//User

Route::post('user/reviews', [UserController::class, 'userReviews']);
Route::post('user/submit-review', [UserController::class, 'userSubmitReview']);


Route::post('user/currency', [UserController::class, 'getUserCurrency']);
Route::post('user/set-currency', [UserController::class, 'setUserCurrency']);

Route::post('user/notification_status', [UserController::class, 'userNotification']);
Route::post('user/change_notification', [UserController::class, 'userChangeNotification']);

//User Properties
Route::get('user/my-properties', [UserController::class, 'myProperties']);
Route::post('user/add-property', [UserController::class, 'addProperty']);
Route::post('user/update-property', [UserController::class, 'updateProperty']);
Route::post('user/edit-property', [UserController::class, 'editProperty']);
Route::post('user/delete-property', [UserController::class, 'deleteProperty']);
Route::get('user/add-property-cityrule', [UserController::class, 'cityRuleProperty']);
Route::post('user/add-property-propertyimages', [UserController::class, 'propertyImagesProperty']);

//User Booking
Route::post('user/bookingdates', [UserController::class, 'bookingDates']);
Route::post('user/booktour', [UserController::class, 'bookTour']);

//User Tours
Route::post('user/my-trips', [UserController::class, 'myTrips']);
Route::post('user/my-tours', [UserController::class, 'myTours']);
Route::post('user/my-bookings', [UserController::class, 'myBookings']);
Route::post('user/bookingrequest', [UserController::class, 'bookingRequest']);
Route::post('user/bookingrequestdetails', [UserController::class, 'bookingRequestDetails']);


//Messages Services
Route::post('user/get-new-messages', [UserController::class, 'getNewMessages']);
Route::post('user/get-messages', [UserController::class, 'getMessages']);
Route::post('user/send-message', [UserController::class, 'sendMessage']);
Route::post('user/set-udid', [UserController::class, 'setUDID']);

Route::post('login', [AuthController::class, 'signin']);
Route::post('login-udid', [AuthController::class, 'getUDID']);
Route::post('register', [AuthController::class, 'signup']);
Route::post('forget-password', [AuthController::class, 'forgetPassword']);

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('blogs', BlogController::class);
});
