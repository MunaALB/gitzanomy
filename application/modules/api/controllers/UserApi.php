<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserApi extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        unset($_REQUEST['ci_session']);
    }
    
    public function index() {
        $this->load->view('index');
    }
    
    
  
    
    
    
    public function mobileRegister() {  ////////////////DONE
        $this->load->view('UserView/register/mobile_register');
    }
    
    public function verifyOtpMobile() { ////////////////DONE
        $this->load->view('UserView/register/verify_otp_mobile');
    }
    
    public function createOtpMobile() { ////////////////DONE
        $this->load->view('UserView/register/create_otp_mobile');
    }
    
    public function userLoginMobile() { ////////////////DONE
        $this->load->view('UserView/register/user_login_mobile');
    }
    
    
    public function createOtpGuestMobile() { ////////////////DONE
        $this->load->view('UserView/register/create_otp_guest_mobile');
    }

    public function verifyGuestMobile() { ////////////////DONE
        $this->load->view('UserView/register/verify_guest_mobile');
    }
    
    
    
    public function resetPassword() {  ////////////////DONE
        $this->load->view('UserView/profile/reset_password');
    }
    
    public function getProfile() {  ////////////////DONE
        $this->load->view('UserView/profile/get_profile');
    }

    public function editProfile() {  ////////////////DONE
        $this->load->view('UserView/profile/edit_profile');
    }
    
    public function changePassword(){  ////////////////DONE
        $this->load->view('UserView/profile/change_password');
    }
    
    public function uploadImage() {  ////////////////DONE
        $this->load->view('UserView/upload_image');
    }
    
    
    public function adminSetting() {  ////////////////DONE
        $this->load->view('UserView/admin_setting');
    }

    public function getHomePage() {               //Done
        $this->load->view('UserView/get_home_page');
    }

    public function getCategory() {               //Done
        $this->load->view('UserView/get_category');
    }

    public function getSubCategory() {               //Done
        $this->load->view('UserView/get_sub_category');
    }

    public function getSubCategoryProduct() {               //Done
        $this->load->view('UserView/get_sub_category_product');
    }

    public function getBrandProduct() {               //Done
        $this->load->view('UserView/get_brand_product');
    }
    
    public function searchProduct() {               //Done
        $this->load->view('UserView/search_product');
    }
    
    public function searchProductWithCategory() {               //Done
        $this->load->view('UserView/search_product_with_category');
    }

    public function productDetail() {               //Done
        $this->load->view('UserView/product_detail');
    }
    
    public function getProductItem() {
        $this->load->view('UserView/get_product_item');
    }

    public function addReview() {             //Done
        $this->load->view('UserView/add_review');
    }

    public function addToCart() {             //Done
        $this->load->view('UserView/add_to_cart');
    }
    
    public function addToWishlist() {             //Done
        $this->load->view('UserView/add_to_wishlist');
    }

    public function getMyCart() {               //Done
        $this->load->view('UserView/get_my_cart');
    }

    public function getWishlist() {               //Done
        $this->load->view('UserView/get_wishlist');
    }

    public function getHomeViewAllProduct() {               //Done
        $this->load->view('UserView/get_home_view_all_product');
    }
    
    public function getHomeViewAllBooking() {               //Done
        $this->load->view('UserView/get_home_view_all_booking');
    }
    

    public function getServiceCategory() {               //Done
        $this->load->view('UserView/service/get_service_category');
    }

    public function getServiceSubCategory() {              //Done
        $this->load->view('UserView/service/get_service_sub_category');
    }

    public function getServiceVendor() {             //Done
        $this->load->view('UserView/service/get_service_vendor');
    }

    public function getService() {             //Done
        $this->load->view('UserView/service/get_service');
    }

    public function getServiceDetail() {             //Done
        $this->load->view('UserView/service/get_service_detail');
    }

    public function addServiceReview() {
        $this->load->view('UserView/service/add_service_review');
    }
    
    public function serviceBooking() {
        $this->load->view('UserView/service/service_booking');
    }

    public function myRequest() {
        $this->load->view('UserView/service/my_request');
    }
    
    public function requestDetail() {
        $this->load->view('UserView/service/request_detail');
    }


    public function myBooking() {
        $this->load->view('UserView/service/my_booking');
    }

    public function bookingDetail() {
        $this->load->view('UserView/service/booking_detail');
    }
    
    public function searchService() {
        $this->load->view('UserView/search_service');
    }


    public function filterData() {
        $this->load->view('UserView/filter_data');
    }


    public function placeOrder() {
        $this->load->view('UserView/place_order');
    }

    public function orderPayment() {
        $this->load->view('UserView/order/order_payment');
    }
    
    public function myOrders() {
        $this->load->view('UserView/order/my_orders');
    }

    public function orderDetail() {
        $this->load->view('UserView/order/order_detail');
    }

    public function couponList() {
        $this->load->view('UserView/order/coupon_list');
    }
    
    public function checkCoupon() {
        $this->load->view('UserView/order/check_coupon');
    }

    public function applyCoupon() {
        $this->load->view('UserView/order/apply_coupon');
    }

    public function cancelOrderProduct() {
        $this->load->view('UserView/order/cancel_order_product');
    }

    public function returnOrderProduct() {
        $this->load->view('UserView/order/return_order_product');
    }
    
    public function help_n_support() {
        $this->load->view('UserView/help_n_support');
    }
    /////////////////////////////////////////////////////////////////
    public function addAddress() {
        $this->load->view('UserView/add_address');
    }
    
    public function editAddress() {
        $this->load->view('UserView/edit_address');
    }
    
    public function getMyAddress() {
        $this->load->view('UserView/get_my_address');
    }

    public function notification() {
        $this->load->view('UserView/notification');
    }
    
    public function transactionList() {
        $this->load->view('UserView/transaction_list');
    }

    public function getNotes() {
        $this->load->view('UserView/profile/get_notes');
    }

    public function test() {
        $this->load->view('UserView/test');
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
}
