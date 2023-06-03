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

$route['user/createOtpGuestMobile']         = 'api/UserApi/createOtpGuestMobile';
$route['user/verifyGuestMobile']            = 'api/UserApi/verifyGuestMobile';

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
$route['user/getBrandProduct']              = 'api/UserApi/getBrandProduct';
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
$route['user/searchService']                = 'api/UserApi/searchService';

$route['user/addAddress']                   = 'api/UserApi/addAddress';
$route['user/editAddress']                  = 'api/UserApi/editAddress';
$route['user/getMyAddress']                 = 'api/UserApi/getMyAddress';

$route['user/serviceBooking']               = 'api/UserApi/serviceBooking';
$route['user/myRequest']                    = 'api/UserApi/myRequest';
$route['user/requestDetail']                = 'api/UserApi/requestDetail';
$route['user/myBooking']                    = 'api/UserApi/myBooking';
$route['user/bookingDetail']                = 'api/UserApi/bookingDetail';

$route['user/filterData']                   = 'api/UserApi/filterData';

$route['user/placeOrder']                   = 'api/UserApi/placeOrder';

$route['user/myOrders']                     = 'api/UserApi/myOrders';
$route['user/orderDetail']                  = 'api/UserApi/orderDetail';

$route['user/couponList']                   = 'api/UserApi/couponList';
$route['user/applyCoupon']                  = 'api/UserApi/applyCoupon';
$route['user/cancelOrderProduct']           = 'api/UserApi/cancelOrderProduct';
$route['user/help_n_support']               = 'api/UserApi/help_n_support';
$route['user/notification']                 = 'api/UserApi/notification';

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
$route['driver/collectUpfrontDetail']         = 'api/DriverApi/collectUpfrontDetail';
$route['driver/itemPickupFromVendorDetail']   = 'api/DriverApi/itemPickupFromVendorDetail';
$route['driver/itemDeliveredUserDetail']      = 'api/DriverApi/itemDeliveredUserDetail';
$route['driver/internationalItemPickupDetail']      = 'api/DriverApi/internationalItemPickupDetail';
$route['driver/changeOrderStatus']            = 'api/DriverApi/changeOrderStatus';
$route['driver/recentOrderList']              = 'api/DriverApi/recentOrderList';
$route['driver/completeMyJob']                = 'api/DriverApi/completeMyJob';

$route['driver/activeOrderList']              = 'api/DriverApi/activeOrderList';
$route['driver/pastOrderList']                = 'api/DriverApi/pastOrderList';
$route['driver/returnOrderList']              = 'api/DriverApi/returnOrderList';
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


$route['vendor/bulk-upload-product']         = 'vendor/Bulk/bulk_upload_product';


$route['vendor/service-list']                                   = 'vendor/Home/service_list';
$route['vendor/add-new-service']                                = 'vendor/Home/add_new_service';
$route['vendor/service-detail/(:any)']                          = 'vendor/Home/service_detail';
$route['vendor/edit-service-detail/(:any)']                     = 'vendor/Home/edit_service';
$route['vendor/subscription']                                   = 'vendor/Vendor/plan_list';

$route['vendor/booking-list']                                   = 'vendor/Vendor/booking_list';
$route['vendor/booking-detail/(:any)']                          = 'vendor/Vendor/booking_detail';

$route['vendor/order-list']                                     = 'vendor/Vendor/order_list';
$route['vendor/order-detail/(:any)']                            = 'vendor/Vendor/order_detail';

$route['vendor/request-list']                                   = 'vendor/Vendor/request_list';
$route['vendor/request-detail/(:any)']                          = 'vendor/Vendor/request_detail';


$route['vendor/terms-and-condition']                            = 'vendor/Login/terms_and_condition';
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

$route['quick-view-product-detail/(:any)/(:num)']               = 'web/web/quick_view_product_detail';
$route['quick-view-product-detail/(:any)/(:num)/(:num)']        = 'web/web/quick_view_product_detail';

$route['top-selling-product']                                   = 'web/web/top_selling_product';
$route['most-viewed-product']                                   = 'web/web/most_viewed_product';
$route['search-product/(:any)']                                 = 'web/web/search_product';
$route['most-booking-service']                                  = 'web/web/most_booking_service';

//////////////////////////////USER PROFILE////////////////////
$route['my-account']            = 'web/User/my_account';
$route['checkout']              = 'web/User/checkout';
$route['edit-profile']          = 'web/User/edit_profile';
$route['change-password']       = 'web/User/change_password';
$route['upload-image']          = 'web/User/upload_image';
//////////////////////////COOKIE//////////////////////////////
$route['my-cart']               = 'web/Web/my_cart';
$route['address']               = 'web/Web/address';
//////////////////////////COOKIE//////////////////////////////


$route['my-favourite-product']  = 'web/User/my_favourite_product';

$route['success']               = 'web/User/success';
$route['success/(:num)']               = 'web/User/success';
$route['failure']               = 'web/User/failure';

$route['booking-success']       = 'web/User/booking_success';
$route['booking-failure']       = 'web/User/booking_failure';

$route['order-history']         = 'web/User/order_history';
$route['order-detail/(:num)']   = 'web/User/order_detail';

$route['my-request']            = 'web/User/my_request';
$route['request-detail/(:num)'] = 'web/User/request_detail';

$route['booking-history']       = 'web/User/booking_history';
$route['booking-detail/(:num)'] = 'web/User/booking_detail';
$route['user-bill/(:num)']             = 'web/User/user_bill';

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

$route['brand-list']                                = 'web/web/brand_list';
$route['product-by-brand/(:num)']                   = 'web/web/product_by_brand';
$route['product-by-brand/(:num)/(:any)']            = 'web/web/product_by_brand';
//////////////////////////////Service Module////////////////////











$route['my-transaction']  = 'web/web/my_transaction';




$route['about-us']  = 'web/web/about_us';
$route['privacy-policy']  = 'web/web/privacy_policy';
$route['terms-and-condition']  = 'web/web/terms_and_condition';
$route['how-it-work']  = 'web/web/how_it_work';
$route['contact-us']  = 'web/web/contact_us';
$route['faq']  = 'web/web/faq';


$route['mobile-about-us']  = 'web/web/mobile_about_us';
$route['mobile-privacy-policy']  = 'web/web/mobile_privacy_policy';
$route['mobile-terms-and-condition']  = 'web/web/mobile_terms_and_condition';
$route['mobile-faq']  = 'web/web/mobile_faq';
//---------------------------------- Website -------------------------------//

//------------------------------------Admin Panel---------------------------------------//
//---------------------------------- Admin -------------------------------//
$route['admin']											= 'admin/Login/index';
$route['admin/dashboard']                    			= 'admin/Admin/index';
$route['admin/logout']                    				= 'admin/Admin/logout';

$route['admin/user-list']                    			= 'admin/Admin/user_list';
$route['admin/user-detail/(:any)']                    	= 'admin/Admin/user_detail';

$route['admin/product-vendor-list']          			= 'admin/Admin/product_vendor_list';
$route['admin/vendor-detail/(:num)']          			= 'admin/Admin/vendor_detail';



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
$route['admin/vendor-product-list']          			= 'admin/Home/vendor_product_list';
$route['admin/vendor-unverified-product-list']          = 'admin/Home/vendor_unverified_product_list';
$route['admin/vendor-rejected-product-list']            = 'admin/Home/vendor_rejected_product_list';


$route['admin/brand-mapping']     		           	    = 'admin/Admin/brand_mapping';
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


$route['admin/subscription-plan-list']                                  = 'admin/Admin/subscription_plan_list';
$route['admin/subscription-plan-list/(:any)']                           = 'admin/Admin/subscription_plan_list';


$route['admin/vendor-service-list']                                     = 'admin/Admin/vendor_service_list';
$route['admin/vendor-service-detail/(:any)']                            = 'admin/Admin/service_detail';

$route['admin/upfront-management']                                      = 'admin/Admin/upfront_management';

$route['admin/vendor-booking-list']                                     = 'admin/Admin/vendor_booking_list';
$route['admin/vendor-complted-booking-list']                            = 'admin/Admin/vendor_complted_booking_list';
$route['admin/vendor-booking-detail/(:any)']          			        = 'admin/Admin/booking_detail';

$route['admin/vendor-request-list']                                     = 'admin/Admin/vendor_request_list';
$route['admin/vendor-request-detail/(:any)']          			        = 'admin/Admin/request_detail';


 


 $route['admin/new-order-list']                                         = 'admin/Order/new_order_list';
 $route['admin/new-order-detail/(:any)']                                = 'admin/Order/new_order_detail';

 $route['admin/upfront-payment-order-list']                             = 'admin/Order/upfront_payment_order_list';
 $route['admin/upfront-payment-order-detail/(:any)']                    = 'admin/Order/upfront_payment_order_detail';
 $route['admin/assigned-driver-for-vendor-product/(:any)']              = 'admin/Order/assigned_driver_for_vendor_product';
 $route['admin/assigned-driver-for-user-product/(:any)']                = 'admin/Order/assigned_driver_for_user_product';


 $route['admin/verified-upfront-payment-order-list']                    = 'admin/Order/verified_upfront_payment_order_list';
 $route['admin/verified-upfront-payment-order-detail/(:any)']                    = 'admin/Order/verified_upfront_payment_order_detail';

 $route['admin/inprocess-order-list']                                   = 'admin/Order/inprocess_order_list';
 $route['admin/in-process-order-detail/(:any)']                         = 'admin/Order/inprocess_order_detail';
 
 $route['admin/completed-order-list']                                   = 'admin/Order/completed_order_list';
 $route['admin/completed-order-detail/(:any)']                          = 'admin/Order/completed_order_detail';

$route['admin/vendor-order-list']                                       = 'admin/Order/vendor_order_list';
$route['admin/admin-order-list']                                        = 'admin/Order/admin_order_list';
$route['admin/order-detail/(:any)']                                     = 'admin/Order/order_detail';
$route['admin/admin-order-detail/(:any)']                               = 'admin/Order/admin_order_detail';
$route['admin/vendor-order-detail/(:num)/(:num)']                      = 'admin/Admin/vendor_order_detail';



$route['admin/bulk-category-list']                                      = 'admin/Bulk/bulk_category_list';
$route['admin/bulk-subcategory-list']                                   = 'admin/Bulk/bulk_subcategory_list';
$route['admin/bulk-service-category-list']                              = 'admin/Bulk/bulk_service_category_list';
$route['admin/bulk-service-subcategory-list']                           = 'admin/Bulk/bulk_service_subcategory_list';
$route['admin/bulk-brand-list']                                         = 'admin/Bulk/bulk_brand_list';


$route['admin/bulk-upload-product']                                     = 'admin/Bulk/bulk_upload_product';
$route['admin/edit-bulk-upload-product']                                = 'admin/Bulk/edit_bulk_upload_product';



$route['admin/sub-admin-list']                                          = 'admin/Admin/sub_admin_list';
$route['admin/sub-admin-list/(:any)']                                   = 'admin/Admin/sub_admin_list';
$route['admin/support-reason-list']                                     = 'admin/Admin/support_reason_list';
$route['admin/support-reason-list/(:any)']                              = 'admin/Admin/support_reason_list';
$route['admin/user-query-list']                                         = 'admin/Admin/user_query_list';
$route['admin/vendor-query-list']                                       = 'admin/Admin/vendor_query_list';
$route['admin/driver-query-list']                                       = 'admin/Admin/driver_query_list';
$route['admin/banner-management']                                       = 'admin/Admin/banner_list';
$route['admin/banner-management/(:any)']                                = 'admin/Admin/banner_list';
$route['admin/vendor-commission-management']                            = 'admin/Admin/vendor_commission_management';


$route['admin/unauthorized-access']                                     = 'admin/Access/unauthorized_access';
$route['admin/vendor-commission']                                       = 'admin/Admin/vendor_commission';

$route['admin/add-coupons']                                             = 'admin/Home/add_coupons';
$route['admin/coupons-list']                                            = 'admin/Home/coupons_list';
$route['admin/edit-driver-detail/(:num)']                       = 'admin/Admin/edit_driver';


$route['admin/set-most-viewed-products']                                = 'admin/Settings/set_most_viewed_products';
$route['admin/set-most-selling-products']                               = 'admin/Settings/set_most_selling_products';
$route['admin/set-popular-service']                                     = 'admin/Settings/set_popular_service';
$route['admin/about-us']                                                = 'admin/Settings/about_us';
$route['admin/privacy-policy']                                          = 'admin/Settings/privacy_policy';
$route['admin/term-conditions']                                         = 'admin/Settings/term_conditions';
$route['admin/edit-about-us']                                           = 'admin/Settings/edit_about_us';
$route['admin/edit-privacy-policy']                                     = 'admin/Settings/edit_privacy_policy';
$route['admin/edit-term-conditions']                                    = 'admin/Settings/edit_term_conditions';
//---------------------------------- Admin -------------------------------//
//------------------------------------Admin Panel---------------------------------------//

$route['404_override'] = 'web/Web/not_found';
$route['translate_uri_dashes'] = FALSE;




