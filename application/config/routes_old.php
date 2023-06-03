<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']                 = 'web';



//----------------------------- Web Services Start Point --------------------------------//

//----------------------------- Web Services For User --------------------------------//
/*Login Module*/

$route['user/mobileRegister']               = 'api/UserApi/mobileRegister';
$route['user/verifyOtpMobile']              = 'api/UserApi/verifyOtpMobile';
$route['user/createOtpMobile']              = 'api/UserApi/createOtpMobile';
$route['user/userLoginMobile']              = 'api/UserApi/userLoginMobile';


/*Login Module*/

/*Profile Module*/
$route['user/resetPassword']                = 'api/UserApi/resetPassword';
$route['user/getProfile']                   = 'api/UserApi/getProfile';
$route['user/editProfile']                  = 'api/UserApi/editProfile';
$route['user/changePassword']               = 'api/UserApi/changePassword';
/*Profile Module*/

$route['user/uploadImage']                  = 'api/UserApi/uploadImage';
$route['user/adminSetting']                 = 'api/UserApi/adminSetting';

$route['user/getHomePage']                  = 'api/UserApi/getHomePage';
$route['user/getCategory']                  = 'api/UserApi/getCategory';
$route['user/getSubCategory']               = 'api/UserApi/getSubCategory';
$route['user/getSubCategoryProduct']        = 'api/UserApi/getSubCategoryProduct';
$route['user/searchProduct']                = 'api/UserApi/searchProduct';
$route['user/productDetail']                = 'api/UserApi/productDetail';
$route['user/getProductItem']               = 'api/UserApi/getProductItem';
$route['user/addReview']                    = 'api/UserApi/addReview';
$route['user/addToCart']                    = 'api/UserApi/addToCart';
$route['user/addToWishlist']                = 'api/UserApi/addToWishlist';
$route['user/getMyCart']                    = 'api/UserApi/getMyCart';
$route['user/getWishlist']                  = 'api/UserApi/getWishlist';
$route['user/getHomeViewAllProduct']        = 'api/UserApi/getHomeViewAllProduct';
$route['user/getHomeViewAllBooking']        = 'api/UserApi/getHomeViewAllBooking';

$route['user/getServiceCategory']           = 'api/UserApi/getServiceCategory';
$route['user/getServiceSubCategory']        = 'api/UserApi/getServiceSubCategory';
$route['user/getServiceVendor']             = 'api/UserApi/getServiceVendor';
$route['user/getService']                   = 'api/UserApi/getService';
$route['user/getServiceDetail']             = 'api/UserApi/getServiceDetail';
$route['user/addServiceReview']             = 'api/UserApi/addServiceReview';

$route['user/addAddress']                   = 'api/UserApi/addAddress';
$route['user/editAddress']                  = 'api/UserApi/editAddress';
$route['user/getMyAddress']                 = 'api/UserApi/getMyAddress';


$route['user/serviceBooking']               = 'api/UserApi/serviceBooking';
$route['user/myRequest']                    = 'api/UserApi/myRequest';
$route['user/myBooking']                    = 'api/UserApi/myBooking';
$route['user/bookingDetail']                = 'api/UserApi/bookingDetail';


$route['user/filterData']                   = 'api/UserApi/filterData';

$route['user/placeOrder']                   = 'api/UserApi/placeOrder';




//----------------------------- Web Services For User --------------------------------//

//----------------------------- Web Services For Driver ----------------------------------------------//
/*Login Module*/
$route['driver/driverLoginMobile']            = 'api/DriverApi/driverLoginMobile';
$route['driver/createOtpMobile']              = 'api/DriverApi/createOtpMobile';
$route['driver/verifyOtpMobile']              = 'api/DriverApi/verifyOtpMobile';

$route['driver/adminSetting']                 = 'api/DriverApi/adminSetting';
$route['driver/uploadImage']                  = 'api/DriverApi/uploadImage';

/*Login Module*/

/*Profile Module*/
$route['driver/resetPassword']                = 'api/DriverApi/resetPassword';
$route['driver/getProfile']                   = 'api/DriverApi/getProfile';
$route['driver/editProfile']                  = 'api/DriverApi/editProfile';
$route['driver/changePassword']               = 'api/DriverApi/changePassword';
/*Profile Module*/

$route['driver/homepage']                     = 'api/DriverApi/homepage';
$route['driver/orderDetail']                  = 'api/DriverApi/orderDetail';


/*Login Module*/
//----------------------------- Web Services For Driver ----------------------------------------------//
//
//----------------------------- Web Services End Point ---------------------------------//

//---------------------------------Vendor ----------------------------------------------//
$route['vendor']                            = 'vendor/Login/index';
$route['vendor/forgot-password']            = 'vendor/Login/forgot_password';
$route['vendor/reset-password']             = 'vendor/Login/reset_password';
$route['vendor/registration']               = 'vendor/Login/register';
$route['vendor/admin-verification']         = 'vendor/Login/admin_verification';
$route['vendor/logout']                     = 'vendor/Login/logout';
$route['vendor/dashboard']                  = 'vendor/Vendor/index';
$route['vendor/my-profile']                 = 'vendor/Vendor/my_profile';
$route['vendor/edit-profile']               = 'vendor/Vendor/edit_profile';
$route['vendor/change-password']            = 'vendor/Vendor/change_password';
$route['vendor/product-list']               = 'vendor/Home/product_list';
$route['vendor/add-new-product']            = 'vendor/Home/add_new_product';
$route['vendor/add-more-attribute/(:num)']  = 'vendor/Home/add_more_attribute';
$route['vendor/product-detail/(:num)']      = 'vendor/Home/product_detail';
$route['vendor/edit-product-detail/(:num)'] = 'vendor/Home/edit_product_detail';
$route['vendor/edit-attribute/(:num)/(:num)']      = 'vendor/Home/edit_product_attribute';


$route['vendor/service-list']                                   = 'vendor/Home/service_list';
$route['vendor/add-new-service']                                = 'vendor/Home/add_new_service';
$route['vendor/service-detail/(:any)']                          = 'vendor/Home/service_detail';
$route['vendor/edit-service-detail/(:any)']                     = 'vendor/Home/edit_service';
$route['vendor/subscription']                                   = 'vendor/Vendor/plan_list';

$route['vendor/booking-list']                                   = 'vendor/Vendor/booking_list';
$route['vendor/booking-detail/(:any)']                          = 'vendor/Vendor/booking_detail';

$route['vendor/order-list']                                     = 'vendor/Vendor/order_list';
$route['vendor/order-detail/(:any)']                            = 'vendor/Vendor/order_detail';
//---------------------------------Vendor ----------------------------------------------//

//---------------------------------- Website -------------------------------//
$route['default_controller'] = 'web';
$route['404_override'] = "errors/page_missing";
$route['translate_uri_dashes'] = FALSE;

$route['user-login']                                            = 'web/web/user_login';
$route['user-registration']                                     = 'web/web/user_registration';
$route['forgot-password']       = 'web/web/forgot_password';
//$route['verify-otp']            = 'web/web/verify_otp';
$route['reset-password']        = 'web/web/reset_password';


$route['product-category']                                      = 'web/web/product_category';
$route['product-subcategory/(:num)/(:any)']                     = 'web/web/product_subcategory';
$route['product-list/(:num)/(:num)/(:any)']                     = 'web/web/product_list';
$route['product-detail/(:any)/(:num)']                          = 'web/web/product_detail';
$route['product-detail/(:any)/(:num)/(:num)']                   = 'web/web/product_detail';
$route['product-detail/(:any)/(:num)/(:num)/(:num)']            = 'web/web/product_detail';
$route['product-detail/(:any)/(:num)/(:num)/(:num)/(:num)']     = 'web/web/product_detail';



//////////////////////////////USER PROFILE////////////////////
$route['my-account']            = 'web/User/my_account';
$route['edit-profile']          = 'web/User/edit_profile';
$route['change-password']       = 'web/User/change_password';
$route['upload-image']          = 'web/User/upload_image';
$route['my-cart']               = 'web/User/my_cart';
$route['checkout']              = 'web/User/checkout';

$route['my-favourite-product']  = 'web/User/my_favourite_product';

$route['success']               = 'web/User/success';
$route['failure']               = 'web/User/failure';
$route['logout']                = 'web/User/logout';
//////////////////////////////USER PROFILE////////////////////
//////////////////////////////Service Module////////////////////

$route['service-category']                          = 'web/web/service_category';

$route['service-subcategory/(:num)']                = 'web/web/service_subcategory';
$route['service-subcategory/(:num)/(:any)']         = 'web/web/service_subcategory';

$route['service-provider/(:num)']                   = 'web/web/service_provider';
$route['service-provider/(:num)/(:any)']            = 'web/web/service_provider';
$route['service-provider/(:num)/(:any)/(:any)']     = 'web/web/service_provider';

$route['service-list/(:num)/(:num)']                = 'web/web/service_list';
$route['service-list/(:num)/(:num)/(:any)']         = 'web/web/service_list';
$route['service-list/(:num)/(:num)/(:any)/(:any)']  = 'web/web/service_list';
$route['service-list/(:num)/(:num)/(:any)/(:any)/(:any)']= 'web/web/service_list';

$route['service-detail/(:num)']                     = 'web/web/service_detail';
$route['service-detail/(:num)/(:any)']              = 'web/web/service_detail';
$route['service-detail/(:num)/(:any)/(:any)']       = 'web/web/service_detail';
$route['service-detail/(:num)/(:any)/(:any)/(:any)']= 'web/web/service_detail';
//////////////////////////////Service Module////////////////////







$route['my-request']  = 'web/web/my_request';
$route['request-detail']  = 'web/web/request_detail';
$route['order-history']  = 'web/web/order_history';
$route['booking-history']  = 'web/web/booking_history';
$route['my-transaction']  = 'web/web/my_transaction';

$route['order-detail']  = 'web/web/order_detail';
$route['booking-detail']  = 'web/web/booking_detail';

$route['about-us']  = 'web/web/about_us';
$route['terms-and-condition']  = 'web/web/terms_and_condition';
$route['how-it-work']  = 'web/web/how_it_work';
$route['contact-us']  = 'web/web/contact_us';
$route['faq']  = 'web/web/faq';
//---------------------------------- Website -------------------------------//

//------------------------------------Admin Panel---------------------------------------//
//---------------------------------- Admin -------------------------------//

///vendor_id restriction on vendor product list detail
$route['admin']											= 'admin/Login/index';
$route['admin/dashboard']                    			= 'admin/Admin/index';
$route['admin/logout']                    				= 'admin/Admin/logout';

$route['admin/user-list']                    			= 'admin/Admin/user_list';
$route['admin/user-detail/(:any)']                    	= 'admin/Admin/user_detail';

$route['admin/product-vendor-list']          			= 'admin/Admin/product_vendor_list';
$route['admin/vendor-detail/(:num)']          			= 'admin/Admin/vendor_detail';

// $route['admin/vendor-product-list']          			= 'admin/Admin/vendor_product_list';

// $route['admin/service-vendor-list']          			= 'admin/Admin/service_vendor_list';
$route['admin/driver-list']                  			= 'admin/Admin/driver_list';
$route['admin/driver-detail/(:num)']                  	= 'admin/Admin/driver_detail';
$route['admin/add-driver']                  			= 'admin/Admin/add_driver';


$route['admin/vendor-service-list']          			= 'admin/Admin/vendor_service_list';
$route['admin/admin-service-list']           			= 'admin/Admin/admin_service_list';

// $route['admin/add-new-service']             			= 'admin/Admin/add_new_service';
// $route['admin/vendor-order-list']            			= 'admin/Admin/vendor_order_list';
// $route['admin/admin-order-list']             			= 'admin/Admin/admin_order_list';
// $route['admin/vendor-booking-list']          			= 'admin/Admin/vendor_booking_list';
// $route['admin/admin-booking-list']           			= 'admin/Admin/admin_booking_list';
// $route['admin/vendor-return-list']           			= 'admin/Admin/vendor_return_list';
// $route['admin/admin-return-list']            			= 'admin/Admin/admin_return_list';

$route['admin/add-new-product']              			= 'admin/Home/add_new_product';
$route['admin/add-more-attribute/(:num)']              	= 'admin/Home/add_more_attribute';
$route['admin/admin-product-list']           			= 'admin/Home/admin_product_list';
$route['admin/product-detail/(:num)']           		= 'admin/Home/product_detail';
$route['admin/edit-product-detail/(:num)']              = 'admin/Home/edit_product_detail';
$route['admin/edit-attribute/(:num)/(:num)']            = 'admin/Home/edit_product_attribute';



$route['admin/brand-list']     		           			= 'admin/Admin/brand_list';
$route['admin/brand-list/(:any)'] 						= 'admin/Admin/brand_list';

$route['admin/map-model']     		           			= 'admin/Admin/map_model';
$route['admin/model-list']     		           			= 'admin/Admin/model_list';
$route['admin/model-list/(:any)'] 						= 'admin/Admin/model_list';

$route['admin/category-list']                			= 'admin/Admin/category_list';
$route['admin/category-list/(:any)'] 					= 'admin/Admin/category_list';

$route['admin/subcategory-list']             			= 'admin/Admin/subcategory_list';
$route['admin/subcategory-list/(:any)']             	= 'admin/Admin/subcategory_list';

$route['admin/add-attribute']             				= 'admin/Admin/add_attribute';
$route['admin/add-attribute/(:any)']             	    = 'admin/Admin/add_attribute';
$route['admin/attribute-list']             				= 'admin/Admin/attribute_list';
$route['admin/attribute-list/(:any)']             		= 'admin/Admin/attribute_list';
$route['admin/map-attribute']             				= 'admin/Admin/map_attribute';
$route['admin/add-featuers']             				= 'admin/Admin/add_featuers';
$route['admin/add-featuers/(:any)']             		= 'admin/Admin/add_featuers';
$route['admin/map-featuers']             				= 'admin/Admin/map_featuers';


$route['admin/service-vendor-list']                                     = 'admin/Admin/service_vendor_list';
$route['admin/service-category-list']                			        = 'admin/Admin/service_category_list';
$route['admin/service-category-list/(:any)']                            = 'admin/Admin/service_category_list';

$route['admin/service-subcategory-list']             			        = 'admin/Admin/service_subcategory_list';
$route['admin/service-subcategory-list/(:any)']                         = 'admin/Admin/service_subcategory_list';

$route['admin/hub-list']                                                = 'admin/Admin/hub_list';
$route['admin/hub-list/(:any)']                                         = 'admin/Admin/hub_list';
$route['admin/city-list']                                               = 'admin/Admin/city_list';
$route['admin/city-list/(:any)']                                        = 'admin/Admin/city_list';
$route['admin/delivery-charge']                                         = 'admin/Admin/delivery_charge';
$route['admin/delivery-charge/(:any)']                                  = 'admin/Admin/delivery_charge';
$route['admin/order-status-management']                                 = 'admin/Admin/order_status_management';
$route['admin/order-status-management/(:any)']                          = 'admin/Admin/order_status_management';

$route['admin/vendor-order-list']                                       = 'admin/Admin/vendor_order_list';
$route['admin/admin-order-list']                                        = 'admin/Admin/admin_order_list';
$route['admin/order-detail/(:any)']                                     = 'admin/Admin/order_detail';
$route['admin/admin-order-detail/(:any)']                               = 'admin/Admin/admin_order_detail';
$route['admin/subscription-plan-list']                                  = 'admin/Admin/subscription_plan_list';
$route['admin/subscription-plan-list/(:any)']                           = 'admin/Admin/subscription_plan_list';
//---------------------------------- Admin -------------------------------//
//------------------------------------Admin Panel---------------------------------------//

$route['404_override'] = 'web/Web/not_found';
$route['translate_uri_dashes'] = FALSE;
