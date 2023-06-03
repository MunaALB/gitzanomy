<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DriverApi extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Driver_model');
        unset($_REQUEST['ci_session']);
    }
    
    public function index() {
        $this->load->view('index');
    }
    
    
    public function verifyOtpMobile() {
        $this->load->view('DriverView/register/verify_otp_mobile');
    }
    
    public function createOtpMobile() {
        $this->load->view('DriverView/register/create_otp_mobile');
    }
    
    public function driverLoginMobile() {
        $this->load->view('DriverView/register/driver_login_mobile');
    }

    public function adminSetting() {
        $this->load->view('DriverView/admin_setting');
    }
    
    
    
    
    
    public function resetPassword() {
        $this->load->view('DriverView/profile/reset_password');
    }
    
    public function getProfile() {
        $this->load->view('DriverView/profile/get_profile');
    }

    public function editProfile() {
        $this->load->view('DriverView/profile/edit_profile');
    }
    
    public function changePassword(){
        $this->load->view('DriverView/profile/change_password');
    }
    
    public function uploadImage() {
        $this->load->view('DriverView/upload_image');
    }
    
    public function homepage() {
        $this->load->view('DriverView/homepage');
    }

    public function collectUpfrontDetail() {
        $this->load->view('DriverView/collect_upfront_detail');
    }

    public function itemPickupFromVendorDetail() {
        $this->load->view('DriverView/item_pickup_from_vendor_detail');
    }

    public function itemDeliveredUserDetail() {
        $this->load->view('DriverView/item_delivered_user_detail');
    }

    public function internationalItemPickupDetail() {
        $this->load->view('DriverView/international_item_pickup_detail');
    }

    public function itemReturnPickUpFromUserDetail() {
        $this->load->view('DriverView/item_return_pickup_from_user_detail');
    }

    public function itemReturnDropToVendorDetail() {
        $this->load->view('DriverView/item_return_dropto_vendor_detail');
    }

    public function changeOrderStatus() {
        $this->load->view('DriverView/change_order_status');
    }
    
    public function recentOrderList() {
        $this->load->view('DriverView/recent_order_list');
    }

    public function completeMyJob() {
        $this->load->view('DriverView/complete_my_job');
    }
    
    
    public function activeOrderList() {
        $this->load->view('DriverView/active_order_list');
    }

    public function pastOrderList() {
        $this->load->view('DriverView/past_order_list');
    }

    public function returnOrderList() {
        $this->load->view('DriverView/return_order_list');
    }
    
    
    
    
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
}
