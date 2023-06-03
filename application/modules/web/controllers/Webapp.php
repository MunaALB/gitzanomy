<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Webapp extends MX_Controller {

    function __construct() {
        
        parent::__construct();
        $this->load->model(array('User_model', 'Api_model'));
        // $this->user_base_url="http://localhost/projects/zanomy/user/";
        $this->user_base_url = base_url('user/');
        if (isset($_COOKIE["zanomycookie"])) {
            "Hi " . $_COOKIE["zanomycookie"];
        } 
        /////////////////////////LANGUAGE////////////////////////////////
        if (!$this->session->userdata('zanomy_language_session')) {
            $language = "ar";
            $this->session->set_userdata('zanomy_language_session', $language);
            $session = $this->session->userdata('zanomy_language_session');
            // echo "<script>window.location.href='".base_url('/')."'</script>";
            $this->language_data = $language;
        } else {
            $this->language_data = $this->session->userdata('zanomy_language_session');
        }

        /////////////////////////Homepage Location Popup////////////////////////////////
        if (!$this->session->userdata('zanomy_user_logged_in')) {
            $user_id = strtotime(date('Y-m-d H:i:s'));
            $this->user_data = array('user_id' => $user_id, 'login_type' => 2);
            $this->user_cart = $this->getUserCart($user_id, $this->language_data);
            // print_r($this->user_cart);exit;
        } else {
            $this->user_data = $this->session->userdata('zanomy_user_logged_in');
            $user_id = $this->user_data['user_id'];
            $this->user_cart = $this->getUserCart($user_id, $this->language_data);
        }
        if (!$this->session->userdata('zanomy_location')) {
            $sessionData = array(
                "address" => "H-54545 New Road Libya",
                "lat" => "27.810886Al",
                "lng" => "16.386849",
            );
            $this->session->set_userdata('zanomy_location', $sessionData);
        }
        $user = $this->session->userdata('zanomy_user_logged_in');

        //print_r($user);exit;
    }
    
    public function product_detail() {
        $language_data = $this->language_data;
        $product_name = $this->uri->segment('2');
        $product_id = $this->uri->segment('3');
        $item_id = $this->uri->segment('4');
        $ram = $this->uri->segment('5');
        $color = $this->uri->segment('6');

        $login_type = $this->user_data['login_type'];
        $user_id = "00";
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['product_id'] = $product_id;
        $strPost['item_id'] = $item_id;
        // $strPost['ram'] = $ram;
        // $strPost['color'] = $color;
        $strPost['is_web'] = 1;

        $path = 'productDetail';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        // echo '<pre/>';print_r($returnData);exit;
        if ($returnData['error_code'] == 200) {
            $data['user_id'] = $user_id;
            $data['login_type'] = $login_type;
            $data['product'] = $returnData['data']['product'];
            $data['user_cart'] = $this->user_cart;
            if ($language_data == 'ar') {
                $data['view_link'] = 'view_ar/product_detail';
                $this->load->view('view_ar/layout/template', $data);
            } else {
                $data['view_link'] = 'product_detail';
                $this->load->view('layout/template', $data);
            }
        } else {
            //echo "<script>alert('No data found');</script>";
            echo "<script>window.location.href='" . base_url('no-data-found') . "'</script>";
        }
    }

    public function getUserCart($user_id, $lang) {
        //echo $lang;exit;
        // $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id' => $user_id, 'lang' => $lang, 'device_id' => '', 'security_token' => ''];
        $path = 'getMyCart';
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 2;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if ($returnData['error_code'] == 200) {
            return $returnData['data'];
        } else {
            return array();
        }
    }
    ////////////     Pagination Request 22/04/2021     /////////////
}
?>
    
