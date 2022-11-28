<?php
use Illuminate\Support\Facades\Route;

Auth::routes();

//Admin
Route::get('admin/login','admin\Auth\LoginController@getLogin')->name('adminLogin');
Route::post('admin/login', 'admin\Auth\LoginController@postLogin')->name('adminLoginPost');
Route::get('admin/logout', 'admin\Auth\LoginController@logout')->name('adminLogout');
Route::get('syed-clear', 'GeneralController@syedClears');

Route::group(['middleware' => 'auth:admin'], function () {
    
    Route::get('admin', 'admin\AdminController@index');
    Route::get('admin/home', 'admin\AdminController@index');
    Route::get('admin/dashboard', 'admin\AdminController@index');

    Route::get('admin/app-settings', 'admin\GeneralController@manageAppSettings');
    Route::post('admin/app-settings/save', 'admin\GeneralController@doSaveAppSettings');

    Route::get('admin/host-payments', 'admin\UserController@hostPayments');
    Route::get('admin/host-payments/manage/{id?}', 'admin\UserController@manageHostPayments');
    Route::post('admin/host-payments/save', 'admin\UserController@doSaveHostPayments');

    //Web pages
    Route::get('admin/pages', 'admin\GeneralController@pages');
    Route::get('admin/page/manage/{id?}', 'admin\GeneralController@managePage');
    Route::post('admin/page/save', 'admin\GeneralController@doSavePage');
    Route::get('admin/page/delete/{id}', 'admin\GeneralController@deletePage');

    //Booking Module
    Route::get('admin/order/properties', 'admin\OrderController@propertiesOrder');
        Route::get('admin/update-order/property/{id?}', 'admin\OrderController@updatePropertiesOrder');
        Route::post('admin/update-order-property/save', 'admin\OrderController@doSavePropertiesOrder');
    Route::get('admin/order/tours', 'admin\OrderController@toursOrder');

    //Blog
    Route::get('admin/blog', 'admin\BlogController@index');
    Route::get('admin/blog/manage/{id?}', 'admin\BlogController@manageBlog');
    Route::post('admin/blog/save', 'admin\BlogController@doSaveBlog');
    Route::get('admin/blog/delete/{id}', 'admin\BlogController@deleteBlog');
    Route::post('admin/image/upload', 'admin\BlogController@uploadImage');

    //Coupons
    Route::get('admin/coupons', 'admin\CouponController@index');
    Route::get('admin/coupons/manage/{id?}', 'admin\CouponController@manageCoupon');
    Route::post('admin/coupons/save', 'admin\CouponController@doSaveCoupon');
    Route::get('admin/coupons/destroy/{id}', 'admin\CouponController@destroyCoupon');
    Route::get('admin/coupons/update-status/{id?}', 'admin\CouponController@doUpdateCouponStatus');
    Route::get('admin/coupons/users-list/{id}', 'admin\CouponController@getCouponUsers');

    //Countries
    Route::get('admin/countries', 'admin\CountryController@viewCountry');
    Route::get('admin/countries/manage/{id?}', 'admin\CountryController@manageCountry');
    Route::post('admin/countries/save', 'admin\CountryController@doSaveCountry');
    Route::get('admin/countries/destroy/{id}', 'admin\CountryController@destroyCountry'); 

    //Cities
    Route::get('admin/cities', 'admin\CountryController@viewCity');
    Route::get('admin/cities/manage/{id?}', 'admin\CountryController@manageCity');
    Route::post('admin/cities/save', 'admin\CountryController@doSaveCity');
    Route::get('admin/cities/destroy/{id}', 'admin\CountryController@destroyCity'); 

    //Properties
    Route::get('admin/properties', 'admin\PropertyController@view');
    Route::get('admin/properties/manage/{id?}', 'admin\PropertyController@manageProperty');
    Route::post('admin/properties/save', 'admin\PropertyController@doSaveProperty');
    Route::get('admin/properties/destroy/{id}', 'admin\PropertyController@destroyProperty');

        Route::get('admin/enquiry/properties', 'admin\PropertyController@propertiesEnquiry');
        Route::get('admin/feedback/properties', 'admin\PropertyController@propertiesFeedback');
        Route::get('admin/feedback/property/destroy/{id}', 'admin\TourController@destroyPropertyFeedback');

    Route::get('admin/needs-approval', 'admin\PropertyController@notificationProperty');    

    //Tours
    Route::get('admin/tours', 'admin\TourController@view');
    Route::get('admin/tours/manage/{id?}', 'admin\TourController@manageTour');
    Route::post('admin/tours/save', 'admin\TourController@doSaveTour');
    Route::get('admin/tours/destroy/{id}', 'admin\TourController@destroyTour');

        Route::get('admin/enquiry/tours', 'admin\TourController@toursEnquiry');
        Route::get('admin/feedback/tours', 'admin\TourController@toursFeedback');
        Route::get('admin/feedback/tour/destroy/{id}', 'admin\TourController@destroyTourFeedback');

    //Hosts
    Route::get('admin/hosts', 'admin\UserController@viewHost');
    Route::get('admin/hosts/manage/{id?}', 'admin\UserController@manageHost');
    Route::post('admin/hosts/save', 'admin\UserController@doSaveHost');
    Route::get('admin/hosts/destroy/{id}', 'admin\UserController@destroyHost'); 

    //Customers
    Route::get('admin/customers', 'admin\UserController@viewCustomer');
    Route::get('admin/customers/manage/{id?}', 'admin\UserController@manageCustomer');
    Route::post('admin/customers/save', 'admin\UserController@doSaveCustomer');
    Route::get('admin/customers/destroy/{id}', 'admin\UserController@destroyCustomer'); 

    //Staffs
    Route::get('admin/service-provider', 'admin\StaffController@viewServiceProvider');
    Route::get('admin/service-provider/manage/{id?}', 'admin\StaffController@manageServiceProvider');
    Route::post('admin/service-provider/save', 'admin\StaffController@doSaveServiceProvider');
    Route::get('admin/service-provider/destroy/{id}', 'admin\StaffController@destroyServiceProvider'); 

    Route::get('admin/staff', 'admin\StaffController@viewStaff');
    Route::get('admin/staff/manage/{id?}', 'admin\StaffController@manageStaff');
    Route::post('admin/staff/save', 'admin\StaffController@doSaveStaff');
    Route::get('admin/staff/destroy/{id}', 'admin\StaffController@destroyStaff'); 

    //Amenities
    Route::get('admin/amenities', 'admin\AmenityController@view');
    Route::get('admin/amenities/manage/{id?}', 'admin\AmenityController@manageAmenities');
    Route::post('admin/amenities/save', 'admin\AmenityController@doSaveAmenities');
    Route::get('admin/amenities/destroy/{id}', 'admin\AmenityController@destroyAmenities');

    //Rental Type
    Route::get('admin/rental-type', 'admin\AmenityController@viewRentalType');
    Route::get('admin/rental-type/manage/{id?}', 'admin\AmenityController@manageRentalType');
    Route::post('admin/rental-type/save', 'admin\AmenityController@doSaveRentalType');
    Route::get('admin/rental-type/destroy/{id}', 'admin\AmenityController@destroyRentalType'); 

    //Suitables
    Route::get('admin/suitables', 'admin\AmenityController@viewSuitable');
    Route::get('admin/suitable/manage/{id?}', 'admin\AmenityController@manageSuitable');
    Route::post('admin/suitable/save', 'admin\AmenityController@doSaveSuitable');
    Route::get('admin/suitable/destroy/{id}', 'admin\AmenityController@destroySuitable'); 

    //Help
    Route::get('admin/help', 'admin\GeneralController@help');
    Route::get('admin/help/manage/{id?}', 'admin\GeneralController@manageHelp');
    Route::post('admin/help/save', 'admin\GeneralController@doSaveHelp');
    Route::get('admin/help/destroy/{id}', 'admin\GeneralController@destroyHelp');

        Route::get('admin/help-sub-categories', 'admin\GeneralController@helpSubCategories');
        Route::get('admin/help-sub-categories/manage/{id?}', 'admin\GeneralController@manageSubHelpCategories');
        Route::post('admin/help-sub-categories/save', 'admin\GeneralController@doSaveSubHelpCategories');
        Route::get('admin/help-sub-categories/destroy/{id}', 'admin\GeneralController@destroySubHelpCategories');

        Route::get('admin/help-categories', 'admin\GeneralController@helpCategories');
        Route::get('admin/help-categories/manage/{id?}', 'admin\GeneralController@manageHelpCategories');
        Route::post('admin/help-categories/save', 'admin\GeneralController@doSaveHelpCategories');
        Route::get('admin/help-categories/destroy/{id}', 'admin\GeneralController@destroyHelpCategories');

});

Route::get('/', function () {
    return view('general.home');
});
Route::get('currency/{locale}', 'GeneralController@currency');
Route::get('fetch-country', 'GeneralController@fetchCountry');
Route::get('fetch-categories', 'GeneralController@fetchCategory');
Route::get('fetch-sub-categories', 'GeneralController@fetchSubCategory');

Route::post('post-login', 'Auth\LoginController@postLogin');
Route::post('newregister', 'Auth\RegisterController@register')->name('newregister');
Route::get('register-otp/{id}', 'Auth\RegisterController@registerStep2');
Route::post('validateotp', 'Auth\RegisterController@submitOtp');
Route::get('resendotp/{id}', 'Auth\RegisterController@reSendOTP');

Route::get('auth/{provider}', 'Auth\RegisterController@redirect');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@callback');

Route::get('/logout','Auth\LoginController@logout');

Route::get('/', 'GeneralController@home');
Route::get('/page/{slug?}', 'GeneralController@pages');
Route::get('about-us', 'GeneralController@aboutUs');
Route::get('contact-us', 'GeneralController@contactUs');
Route::get('privacy-policy', 'GeneralController@privacyPolicy');
Route::get('terms-and-conditions', 'GeneralController@TermsNConditions');
Route::get('search', 'DestinationController@searchProperty');

Route::get('hosting-help', 'GeneralController@helpHosting');
Route::get('hosting-help/sub-category/{slug?}', 'GeneralController@hostingSubCategory');
Route::get('hosting-help/sub-category-list/{slug?}', 'GeneralController@hostingSubCategoryList');
Route::get('hosting-help/detail/{slug?}', 'GeneralController@helpHostingDetail');

Route::get('traveling-help', 'GeneralController@helpTraveling');
Route::get('traveling-help/sub-category/{slug?}', 'GeneralController@travelingSubCategory');
Route::get('traveling-help/sub-category-list/{slug?}', 'GeneralController@travelingSubCategoryList');
Route::get('traveling-help/detail/{slug?}', 'GeneralController@helpTravelingDetail');

Route::get('host-setup', 'HostController@hostSetup');
Route::get('host-insurance', 'HostController@hostInsurance');
Route::get('host-safety', 'HostController@hostSafety');
Route::get('hosting-safety', 'HostController@hostSafety');
Route::get('listing-properties', 'HostController@listingProperties');

Route::get('all-destinations', 'DestinationController@destination');
Route::get('all-destinations/more', 'DestinationController@destinationMoreLocation');
Route::get('location/{slug?}', 'DestinationController@destinationLocations');
Route::get('rental/{slug?}', 'DestinationController@rentalDetails');

Route::get('all-tours', 'TourController@tours');
Route::get('tour/{slug?}', 'TourController@tourDetails');
    Route::post('enquiry/place/save', 'TourController@doSaveEnquiryBooking');

Route::get('blog', 'BlogController@blog');
Route::get('blog/detail/{slug}', 'BlogController@blogDetail');


Route::get('emailtemp', 'GeneralController@emailTemp');

Route::group(['middleware' => 'auth'], function () 
{

    Route::get('/home', 'UserController@Dashboard');

    Route::post('my-account/save', 'UserController@doSaveAccount');
    Route::post('my-password/save', 'UserController@doSavePassword');
    Route::post('my-picture/save', 'UserController@doSavePicture');
    Route::post('user/feedback', 'UserController@doSaveCommments');

    Route::get('host/your-earnings', 'UserController@hostYourEarnings');
    Route::get('host/manage-bank-detail', 'UserController@hostManageBank');
    Route::post('host/bank-detail/save', 'UserController@hostDoSaveBank');
    Route::get('host/traveller-account', 'UserController@changeToTravellerAccount');
    Route::get('host/host-account', 'UserController@changeToHostAccount');
    Route::get('host/inbox', 'UserController@hostInbox');
    Route::get('host/inbox/destroy/{propertyId}', 'UserController@removeInbox');

    Route::get('host/properties', 'UserController@hostProperties');
    Route::get('host/manage-property/{id?}', 'UserController@hostAddProperty');
    Route::post('host/property/save', 'UserController@doSaveHostProperty');
    Route::get('host/property/destroy/{id?}', 'UserController@deleteProperty');
    Route::get('host/view-property/{id?}', 'UserController@hostViewProperty');

    Route::get('host/tours', 'UserController@hostTours');
    Route::get('host/manage-tour/{id?}', 'UserController@hostAddTour');
    Route::post('host/tour/save', 'UserController@doSaveHostTour');
    Route::get('host/tour/destroy/{id?}', 'UserController@deleteTour');
    Route::get('host/view-tour/{id?}', 'UserController@hostViewTour');

    //Route::get('my-orders', 'UserController@userOrders');
    Route::get('my-trips', 'UserController@userTrips');
    Route::get('trip/cancel/{id?}', 'UserController@userCancelTrip');
    Route::get('trip/refund-request/{id?}', 'UserController@userRefundRequest');
    Route::get('my-tours', 'UserController@userTours');
    Route::get('tour/cancel/{id?}', 'UserController@userCancelTour');

    Route::post('add-cart', 'OrderController@createCart');
    Route::get('/remove/{propertyId}', 'OrderController@removePropertyFromCart');
    Route::get('/empty', 'OrderController@destroyCart');
    Route::get('cart', 'OrderController@myCart');
    Route::get('checkout', 'OrderController@checkOut');
    Route::post('place-order', 'OrderController@placeOrder');
    Route::get('confirmation-order/{order_id?}', 'OrderController@confirmationOrder');
    Route::get('sub-order/manage/{id}', 'OrderController@manageSubOrder');
    Route::get('sub-order/delete/{id}', 'OrderController@deleteSubOrder');
    Route::post('RecieveResult', 'OrderController@RecieveResultMethod');
    Route::get('order/invoice/{id}', 'OrderController@myInvoice');

    Route::get('checkCoupon', 'CouponController@checkCoupon');

    Route::get('my-wishlist', 'WishlistController@propertyWishlist');
    Route::get('property/wishlist/{property_id?}/{property_type?}', 'WishlistController@addWishlist');
    Route::get('wishlist/destroy/{id?}', 'WishlistController@destroyProperty');

    Route::get('stripe', 'StripeController@stripe');
    Route::post('stripe', 'StripeController@stripePost');

    Route::get('/stripe-payment', 'StripeController@handleGet');
    Route::post('/stripe-payment', 'StripeController@handlePost')->name('stripe.payment');

});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
