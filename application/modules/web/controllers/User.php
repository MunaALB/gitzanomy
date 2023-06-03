<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('User_model','Api_model'));
        //$this->user_base_url="http://localhost/projects/zanomy/user/";
        $this->user_base_url=base_url('user/');
        // print_r($this->session->userdata('zanomy_user_logged_in'));exit;
        if (!$this->session->userdata('zanomy_user_logged_in')) {
           redirect('');

            // $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
            // $path = 'adminSetting';
            // $strPost['user_id'] = $user_id;
            // $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
            // $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;

        } else {
            /////////////////////////LANGUAGE////////////////////////////////
            if(!$this->session->userdata('zanomy_language_session')){
                $language   = "en";
                $this->session->set_userdata('zanomy_language_session', $language);
                $session = $this->session->userdata('zanomy_language_session');
                // echo "<script>window.location.href='".base_url('/')."'</script>";
                $this->language_data=$language;
            }else{
                $this->language_data = $this->session->userdata('zanomy_language_session');
            }
            /////////////////////////LANGUAGE////////////////////////////////

            $this->user_data = $this->session->userdata('zanomy_user_logged_in');
            $this->user_cart=$this->getUserCart();
            $user = $this->session->userdata('zanomy_user_logged_in');
            $headerArr = ['user_id'=>$user['user_id'],'lang' => 'en', 'device_id' => '', 'security_token' => ''];
            $path = 'getProfile';
            $strPost['user_id'] = $user['user_id'];
            $strPost['is_web'] = 1;
            $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
            $returnData= json_decode($returnData,TRUE);
            if($returnData['error_code']==200){
                $this->user_profile = $returnData['data'];
            }else{
                echo "<script>alert('".$returnData['message']."');</script>";
                echo "<script>window.location.href='".base_url('/')."'</script>";
            }
        }
    }


    public function my_account() {
        $language_data = $this->language_data;
        $data['user_data'] = $this->user_profile;
        $user_id = $this->user_data['user_id'];

        $this->db->where("user_id='".$user_id."' and user_status=3");
        $orders = $this->db->get('orders')->result_array();
        if($orders){
            $data['orderCount']=count($orders);
        }else{
            $data['orderCount']=0;
        }

        $this->db->where("user_id='".$user_id."' and status=4");
        $orders = $this->db->get('service_booking')->result_array();
        if($orders){
            $data['bookingCount']=count($orders);
        }else{
            $data['bookingCount']=0;
        }
        //echo '<pre/>';print_r($data);exit;
        $data['base_url'] = $this->user_base_url;
        $data['user_cart'] = $this->user_cart;
        if($language_data=='ar'){
            $data['view_link'] = 'view_ar/user/my_account';
            $this->load->view('view_ar/layout/template', $data);
        }else{
            $data['view_link'] = 'user/my_account';
            $this->load->view('layout/template', $data);
        }
    }
    public function edit_profile() {
        $language_data = $this->language_data;
        $data['user_data'] = $this->user_profile;
        
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $data['user_cart'] = $this->user_cart;
        if($language_data=='ar'){
            $data['view_link'] = 'view_ar/user/edit_profile';
            $this->load->view('view_ar/layout/template', $data);
        }else{
            $data['view_link'] = 'user/edit_profile';
            $this->load->view('layout/template', $data);
        }
    }

    public function change_password() {
        $language_data = $this->language_data;
        $data['user_data'] = $this->user_profile;
        
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $data['user_cart'] = $this->user_cart;
        if($language_data=='ar'){
            $data['view_link'] = 'view_ar/user/change_password';
            $this->load->view('view_ar/layout/template', $data);
        }else{
            $data['view_link'] = 'user/change_password';
            $this->load->view('layout/template', $data);
        }
    }
    function upload_image(){
        $language_data = $this->language_data;
        $uriSegment=$this->uri->segment(2);
        $user_id = $this->user_data['user_id'];
        $url = $_POST['url'];
        // print_r($_POST);exit;
        //print_r($_FILES);exit;
        if(($_FILES['image']['name'])){
            $uploadImage	=   $this->User_model->upload_file('image',$user_id);
            if($uploadImage){
                redirect($language_data.'/'.$url);
            }else{
                echo '<script>alert("Image not uploaded");</script>';
                redirect($language_data.'/'.$url);
            }
        }else{
            echo '<script>alert("Image not uploaded");</script>';
            redirect($language_data.'/'.$uriSegment);
        }
    }

    


    public function my_favourite_product() {
        $language_data = $this->language_data;
        $data['user_data'] = $this->user_profile;
        
        $user_id = $this->user_data['user_id'];

        $headerArr = ['user_id'=>$user_id,'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $path = 'getWishlist';
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        if($returnData['error_code']==200){
            $data['wishlist'] = $returnData['data']['wishlist'];
        }else{
            $data['wishlist'] = array();
        }
        $data['base_url'] = $this->user_base_url;
        $data['user_cart'] = $this->user_cart;
        //echo '<pre/>';print_r($returnData);exit;
        if($language_data=='ar'){
            $data['view_link'] = 'view_ar/user/my_favourite_product';
            $this->load->view('view_ar/layout/template', $data);
        }else{
            $data['view_link'] = 'user/my_favourite_product';
            $this->load->view('layout/template', $data);
        }
    }

    public function checkout() {
        $language_data = $this->language_data;
        $data['user_data'] = $this->user_profile;
        
        $user_id = $this->user_data['user_id'];
        $data['user_id'] = $user_id;
        $data['base_url'] = $this->user_base_url;
        $data['user_cart'] = $this->user_cart;
        //echo '<pre/>';print_r($data['user_cart']);exit;
        $headerArr = ['user_id'=>$user_id,'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $path = 'adminSetting';
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        $data['country_code']=array();
        $data['city']=array();
        if($returnData['error_code']==200){
            if(isset($returnData['data']['country_code']) and $returnData['data']['country_code']){
                $data['country_code']=$returnData['data']['country_code'];
            }
            if(isset($returnData['data']['city']) and $returnData['data']['city']){
                $data['city']=$returnData['data']['city'];
            }
        }
        //echo '<pre/>';print_r($returnData);exit;

        $headerArr = ['user_id'=>$user_id,'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $path = 'getMyAddress';
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        $data['getAddress']=array();
        $data['getAddressCount']=0;
        if($returnData['error_code']==200){
            if(isset($returnData['data']['user_address']) and $returnData['data']['user_address']){
                $data['getAddress']=$returnData['data']['user_address'];
                $data['getAddressCount']=count($returnData['data']['user_address']);
            }
        }
        //echo '<pre/>';print_r($returnData);exit;

        $headerArr = ['user_id'=>$user_id,'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $path = 'couponList';
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        
        $data['couponList']=array();
        if($returnData['error_code']==200){
            if(isset($returnData['data']['couponArr']) && $returnData['data']['couponArr']){
                $data['couponList']=$returnData['data']['couponArr'];
            }
        }
        //echo '<pre/>';print_r($data['couponList']);exit;
        if($language_data=='ar'){
            $data['view_link'] = 'view_ar/user/checkout';
            $this->load->view('view_ar/layout/template', $data);
        }else{
            $data['view_link'] = 'user/checkout';
            $this->load->view('layout/template', $data);
        }
    }

    public function success() {









        //print_r($_REQUEST);exit;
        if(isset($_REQUEST['payment_reference']) and $_REQUEST['payment_reference']){
            $user_logged_in = $this->session->userdata('zanomy_user_logged_in');
        
            $pt=array(
                "merchant_email" => "alashter.mohaned@gmail.com",
                "secret_key" => "Bl1Dl322Q2eUjb0GcS9F7u6KalL4IDIjZKXkN0mD2AymMz3YrcEzGKkR65VPJD9Io62b7pPaZowMXALpMpZt9jkgpg58UeQilTts",
                "payment_reference" => $_REQUEST['payment_reference']
             ); 
            $baseurl = 'https://www.paytabs.com/apiv2/verify_payment';
            $returnDataApi = $this->User_model->payTabs($baseurl, $pt);
            $returnArr = json_decode($returnDataApi,true);
            // echo $returnArr['response_code'].'/';
            //print_r($returnArr);exit;
            if($returnArr['response_code']==100){
                $insertArr=[
                    'user_id' => $user_logged_in['user_id'] != '' ? $user_logged_in['user_id'] : '',
                    "order_id"  => $returnArr['reference_no'],
                    "txn_id"    => $returnArr['transaction_id'],
                    "total_amount"    => $returnArr['amount'],
                    "reference_id"    => $_REQUEST['payment_reference'],
                    "payment_status"    => "1",
                    "is_web"    => "1",
                    "type"      =>1
                ];
                $headerArr = [
                    'device_id' => $user_logged_in['device_id'],
                    'security_token' => $user_logged_in['security_token'],
                    'lang'=>"en"
                ];
    
                // echo '<pre/>';print_r($insertArr);exit;
                $ppath = 'orderPayment';
                $result = $this->Api_model->apiCallHeader($ppath, $headerArr, $insertArr);
                $checkoutData = json_decode($result,true);
                //echo '<pre/>';print_r($checkoutData);exit;
                // redirect('order-detail/'.$returnArr['reference_no']);
                redirect('/');
            }elseif($returnArr['response_code']==481 or $returnArr['response_code']==482){
                $insertArr=[
                    'user_id' => $user_logged_in['user_id'] != '' ? $user_logged_in['user_id'] : '',
                    "order_id"  => $returnArr['reference_no'],
                    "txn_id"    => $returnArr['transaction_id'],
                    "total_amount"    => $returnArr['amount'],
                    "reference_id"    => $_REQUEST['payment_reference'],
                    "payment_status"    => "2",
                    "is_web"    => "1",
                ];
                $headerArr = [
                    'device_id' => $user_logged_in['device_id'],
                    'security_token' => $user_logged_in['security_token']
                ];
                $ppath = 'orderPayment';
                $result = $this->User_model->apiCallHeader($ppath, $headerArr, $insertArr);
                $checkoutData = json_decode($result,true);
                redirect('order-fail');
            }else{
                redirect('invalid-transaction');
            }
        }else{
            $language_data = $this->language_data;
            $orderId=$this->uri->segment('3');
            if(isset($orderId) and $orderId){
                $data['user_data'] = $this->user_profile;
            
                $user_id = $this->user_data['user_id'];
    
                $headerArr = ['user_id'=>$user_id,'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
                $path = 'orderDetail';
                $strPost['order_id'] = $orderId;
                $strPost['user_id'] = $user_id;
                $strPost['is_web'] = 1;
                $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
                $returnData= json_decode($returnData,TRUE);
                //print_r($returnData);exit;
                if($returnData['error_code']==200){
                    $data['orderDetail'] = $returnData['data']['list'];
                }
            }else{
                $data['orderDetail'] = array();
            }
            $data['base_url'] = $this->user_base_url;
            $data['user_cart'] = $this->user_cart;
            //echo '<pre/>';print_r($data);exit;
            if($language_data=='ar'){
                $data['view_link'] = 'view_ar/pages/success';
                $this->load->view('view_ar/layout/template', $data);
            }else{
                $data['view_link'] = 'pages/success';
                $this->load->view('layout/template', $data);
            }
        }
        










        
    }


    


    public function failure() {
        $data['view_link'] = 'pages/fail';
        $this->load->view('layout/template', $data);
    }


    public function order_history() {
        $language_data = $this->language_data;
        $data['user_data'] = $this->user_profile;
        
        $user_id = $this->user_data['user_id'];

        $headerArr = ['user_id'=>$user_id,'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $path = 'myOrders';
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        if($returnData['error_code']==200){
            $data['activerOrderList'] = $returnData['data']['activerOrderList'];
            $data['completedOrdersList'] = $returnData['data']['completedOrdersList'];
        }else{
            $data['activerOrderList'] = array();
            $data['completedOrdersList'] = array();
        }
        $data['base_url'] = $this->user_base_url;
        $data['user_cart'] = $this->user_cart;
        //echo '<pre/>';print_r($returnData);exit;
        if($language_data=='ar'){
            $data['view_link'] = 'view_ar/user/order_history';
            $this->load->view('view_ar/layout/template', $data);
        }else{
            $data['view_link'] = 'user/order_history';
            $this->load->view('layout/template', $data);
        }
    }

    public function order_detail() {
        $language_data = $this->language_data;
        $orderId=$this->uri->segment('3');
        $data['user_data'] = $this->user_profile;
        
        $user_id = $this->user_data['user_id'];

        $headerArr = ['user_id'=>$user_id,'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $path = 'orderDetail';
        $strPost['order_id'] = $orderId;
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 2;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        // echo '<pre/>';print_r($returnData);exit;
        if($returnData['error_code']==200){
            $data['orderDetail'] = $returnData['data']['list'];
            $data['base_url'] = $this->user_base_url;
            $data['user_id'] = $user_id;
            $data['order_id'] = $orderId;
            $data['user_cart'] = $this->user_cart;
            // echo '<pre/>';print_r($returnData);exit;
            if($language_data=='ar'){
                $data['view_link'] = 'view_ar/user/order_detail';
                $this->load->view('view_ar/layout/template', $data);
            }else{
                $data['view_link'] = 'user/order_detail';
                $this->load->view('layout/template', $data);
            }
        }else{
            echo "<script>alert('".$returnData['message']."');</script>";
            echo "<script>window.location.href='".base_url('order-history')."'</script>";
        }
        
    }

    public function user_bill() {
        $orderId=$this->uri->segment('3');
        $data['user_data'] = $this->user_profile;
        
        $user_id = $this->user_data['user_id'];

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $path = 'orderDetail';
        $strPost['order_id'] = $orderId;
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        if($returnData['error_code']==200){
            $data['orderDetail'] = $returnData['data']['list'];
            $data['base_url'] = $this->user_base_url;
            $data['user_cart'] = $this->user_cart;
            //echo '<pre/>';print_r($returnData);exit;
            
            $data['view_link'] = 'user/user_bill';
            $this->load->view('layout/template', $data);
        }else{
            echo "<script>alert('".$returnData['message']."');</script>";
            echo "<script>window.location.href='".base_url('order-history')."'</script>";
        }
        
    }

    public function my_request() {
        $language_data = $this->language_data;
        $data['user_data'] = $this->user_profile;
        
        $user_id = $this->user_data['user_id'];

        $headerArr = ['user_id'=>$user_id,'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $path = 'myRequest';
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        if($returnData['error_code']==200){
            $data['request'] = $returnData['data']['request'];
        }else{
            $data['request'] = array();
        }
        $data['base_url'] = $this->user_base_url;
        $data['user_cart'] = $this->user_cart;
        //echo '<pre/>';print_r($returnData);exit;
        if($language_data=='ar'){
            $data['view_link'] = 'view_ar/user/my_request';
            $this->load->view('view_ar/layout/template', $data);
        }else{
            $data['view_link'] = 'user/my_request';
            $this->load->view('layout/template', $data);
        }
    }

    public function request_detail() {
        $language_data = $this->language_data;
        $bookingId=$this->uri->segment('3');
        $data['user_data'] = $this->user_profile;
        
        $user_id = $this->user_data['user_id'];

        $headerArr = ['user_id'=>$user_id,'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $path = 'requestDetail';
        $strPost['booking_id'] = $bookingId;
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if($returnData['error_code']==200){
            $data['requestDetail'] = $returnData['data']['detail'];
            $data['base_url'] = $this->user_base_url;
            $data['user_cart'] = $this->user_cart;
            //echo '<pre/>';print_r($returnData);exit;
            if($language_data=='ar'){
                $data['view_link'] = 'view_ar/user/request_detail';
                $this->load->view('view_ar/layout/template', $data);
            }else{
                $data['view_link'] = 'user/request_detail';
                $this->load->view('layout/template', $data);
            }
        }else{
            // echo "<script>alert('".$returnData['message']."');</script>";
            echo "<script>window.location.href='".base_url('no-data-found')."'</script>";
        }
    }
    
    public function booking_history() {
        $language_data = $this->language_data;
        $data['user_data'] = $this->user_profile;
        
        $user_id = $this->user_data['user_id'];

        $headerArr = ['user_id'=>$user_id,'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $path = 'myBooking';
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        if($returnData['error_code']==200){
            $data['active_booking'] = $returnData['data']['active_booking'];
            $data['complete_booking'] = $returnData['data']['complete_booking'];
        }else{
            $data['active_booking'] = array();
            $data['complete_booking'] = array();
        }
        $data['base_url'] = $this->user_base_url;
        $data['user_cart'] = $this->user_cart;
        //echo '<pre/>';print_r($returnData);exit;
        if($language_data=='ar'){
            $data['view_link'] = 'view_ar/user/booking_history';
            $this->load->view('view_ar/layout/template', $data);
        }else{
            $data['view_link'] = 'user/booking_history';
            $this->load->view('layout/template', $data);
        }
    }

    public function booking_detail() {
        $language_data = $this->language_data;
        $bookingId=$this->uri->segment('3');
        $data['user_data'] = $this->user_profile;
        
        $user_id = $this->user_data['user_id'];

        $headerArr = ['user_id'=>$user_id,'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $path = 'bookingDetail';
        $strPost['booking_id'] = $bookingId;
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if($returnData['error_code']==200){
            $data['requestDetail'] = $returnData['data']['detail'];
            $data['base_url'] = $this->user_base_url;
            $data['user_cart'] = $this->user_cart;
            //echo '<pre/>';print_r($returnData);exit;
            if($language_data=='ar'){
                $data['view_link'] = 'view_ar/user/booking_detail';
                $this->load->view('view_ar/layout/template', $data);
            }else{
                $data['view_link'] = 'user/booking_detail';
                $this->load->view('layout/template', $data);
            }
        }else{
            // echo "<script>alert('".$returnData['message']."');</script>";
            echo "<script>window.location.href='".base_url('no-data-found')."'</script>";
        }
    }

    





















    public function booking_success() {
        if(isset($_REQUEST['payment_reference']) and $_REQUEST['payment_reference']){
            $user_logged_in = $this->session->userdata('zanomy_user_logged_in');
        
            $pt=array(
                "merchant_email" => "alashter.mohaned@gmail.com",
                "secret_key" => "Bl1Dl322Q2eUjb0GcS9F7u6KalL4IDIjZKXkN0mD2AymMz3YrcEzGKkR65VPJD9Io62b7pPaZowMXALpMpZt9jkgpg58UeQilTts",
                "payment_reference" => $_REQUEST['payment_reference']
             ); 
            $baseurl = 'https://www.paytabs.com/apiv2/verify_payment';
            $returnDataApi = $this->User_model->payTabs($baseurl, $pt);
            $returnArr = json_decode($returnDataApi,true);
            // echo $returnArr['response_code'].'/';
            //print_r($returnArr);exit;
            if($returnArr['response_code']==100){
                $insertArr=[
                    'user_id' => $user_logged_in['user_id'] != '' ? $user_logged_in['user_id'] : '',
                    "order_id"  => $returnArr['reference_no'],
                    "txn_id"    => $returnArr['transaction_id'],
                    "total_amount"    => $returnArr['amount'],
                    "reference_id"    => $_REQUEST['payment_reference'],
                    "payment_status"    => "1",
                    "is_web"    => "1",
                    "type"      =>2
                ];
                $headerArr = [
                    'device_id' => $user_logged_in['device_id'],
                    'security_token' => $user_logged_in['security_token'],
                    'lang'=>"en"
                ];
    
                // echo '<pre/>';print_r($insertArr);exit;
                $ppath = 'orderPayment';
                $result = $this->Api_model->apiCallHeader($ppath, $headerArr, $insertArr);
                $checkoutData = json_decode($result,true);
                //echo '<pre/>';print_r($checkoutData);exit;
                // redirect('order-detail/'.$returnArr['reference_no']);
                redirect('/');
            }elseif($returnArr['response_code']==481 or $returnArr['response_code']==482){
                $insertArr=[
                    'user_id' => $user_logged_in['user_id'] != '' ? $user_logged_in['user_id'] : '',
                    "order_id"  => $returnArr['reference_no'],
                    "txn_id"    => $returnArr['transaction_id'],
                    "total_amount"    => $returnArr['amount'],
                    "reference_id"    => $_REQUEST['payment_reference'],
                    "payment_status"    => "2",
                    "is_web"    => "1",
                ];
                $headerArr = [
                    'device_id' => $user_logged_in['device_id'],
                    'security_token' => $user_logged_in['security_token']
                ];
                $ppath = 'orderPayment';
                $result = $this->User_model->apiCallHeader($ppath, $headerArr, $insertArr);
                $checkoutData = json_decode($result,true);
                redirect('order-fail');
            }else{
                redirect('invalid-transaction');
            }
        }else{

            $data['view_link'] = 'pages/booking_success';
            $this->load->view('layout/template', $data);
        }
    }
    public function booking_failure() {
        $data['view_link'] = 'pages/booking_failure';
        $this->load->view('layout/template', $data);
    }
    
    public function ajax() {
        $this->load->view('ajax_server');
    }

    public function getUserCart(){
        $user_id = $this->user_data['user_id'];
        $language_data = $this->language_data;
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id'=>$user_id,'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $path = 'getMyCart';
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if($returnData['error_code']==200){
            return $returnData['data'];
        }else{
            return array();
        }
    }


    public function user_transaction() {
        $language_data = $this->language_data;
        $data['user_data'] = $this->user_profile;
        
        $user_id = $this->user_data['user_id'];

        $headerArr = ['user_id'=>$user_id,'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $path = 'transactionList';
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        // echo '<pre/>';print_r($returnData);exit;
        
        $data['list'] = $returnData['data'];
        $data['base_url'] = $this->user_base_url;
        $data['user_cart'] = $this->user_cart;
        //echo '<pre/>';print_r($returnData);exit;
        if($language_data=='ar'){
            $data['view_link'] = 'view_ar/user/user_transaction';
            $this->load->view('view_ar/layout/template', $data);
        }else{
            $data['view_link'] = 'user/user_transaction';
            $this->load->view('layout/template', $data);
        }
        
    }

    public function my_notebook() {
        $language_data = $this->language_data;
        $data['user_data'] = $this->user_profile;
        
        $user_id = $this->user_data['user_id'];

        $headerArr = ['user_id'=>$user_id,'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $path = 'getNotes';
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        // echo '<pre/>';print_r($returnData);exit;
        if(isset($returnData['data']['notes']) and $returnData['data']['notes']){
            $data['list'] = $returnData['data']['notes'];
        }else{
            $data['list'] = array();
        }
        
        $data['base_url'] = $this->user_base_url;
        $data['user_cart'] = $this->user_cart;
        //echo '<pre/>';print_r($returnData);exit;
        if($language_data=='ar'){
            // $data['view_link'] = 'view_ar/user/user_notebook';
            // $this->load->view('view_ar/layout/template', $data);
            $data['view_link'] = 'user/user_notebook';
            $this->load->view('view_ar/layout/template', $data);
        }else{
            $data['view_link'] = 'user/user_notebook';
            $this->load->view('layout/template', $data);
        }
        
    }

    public function logout() {
        $query = $this->session->unset_userdata('zanomy_user_logged_in');
        redirect('/');
    }
    
}
?>
    