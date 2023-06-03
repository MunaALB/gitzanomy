<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('User_model','Api_model'));
        // $this->user_base_url="http://localhost/projects/zanomy/user/";
        $this->user_base_url=base_url('user/');
        if (!$this->session->userdata('zanomy_user_logged_in')) {
            $this->user_data = array('user_id'=>"00");
            $this->user_cart=array();
        } else {
            $this->user_data = $this->session->userdata('zanomy_user_logged_in');
            $this->user_cart=$this->getUserCart();
        }
        if (!$this->session->userdata('zanomy_location')) {
            $sessionData=array(
                "address"        => "H-54545 New Road Libya",
                "lat"       => "27.810886Al",
                "lng"  => "16.386849",
            );
            $this->session->set_userdata('zanomy_location', $sessionData);
        }
        $user = $this->session->userdata('zanomy_user_logged_in');
        //print_r($user);exit;
    }


    public function user_login() {
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $path = 'adminSetting';
        $strPost['user_id'] = $user_id;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        $data['user_cart'] = $this->user_cart;
        $data['country_code'] = $returnData['data']['country_code'];
        //echo '<pre/>';print_r($data);exit;
        $data['view_link'] = 'user_login';
        $this->load->view('layout/template', $data);
    }
    public function user_registration() {
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $path = 'adminSetting';
        $strPost['user_id'] = $user_id;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        $data['user_cart'] = $this->user_cart;
        $data['country_code'] = $returnData['data']['country_code'];
        
        $data['view_link'] = 'user_registration';
        $this->load->view('layout/template', $data);
    }
    public function forgot_password() {
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $path = 'adminSetting';
        $strPost['user_id'] = $user_id;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        $data['user_cart'] = $this->user_cart;
        $data['country_code'] = $returnData['data']['country_code'];

        $data['view_link'] = 'forgot_password';
        $this->load->view('layout/template', $data);
    }
    // public function verify_otp() {
    //     $data['view_link'] = 'verify_otp';
    //     $this->load->view('layout/template', $data);
    // }
    public function reset_password() {
        $data['user_id'] = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $data['user_cart'] = $this->user_cart;

        $data['view_link'] = 'reset_password';
        $this->load->view('layout/template', $data);
    }




    public function index() {
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $data['user_id'] = $user_id;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $path = 'getHomePage';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        $data['homepage'] = $returnData['data'];
        $data['user_cart'] = $this->user_cart;
        $data['view_link'] = 'index';
        $this->load->view('layout/template', $data);
    }

    public function product_category() {
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $path = 'getCategory';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        if($returnData['error_code']==200){
            $data['category'] = $returnData['data']['category'];
        }else{
            $data['category'] = array();
        }
        $data['user_cart'] = $this->user_cart;
        $data['view_link'] = 'product_category';
        $this->load->view('layout/template', $data);
    }

    public function product_subcategory() {
        $categoryId=$this->uri->segment('2');
        
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $strPost['category_id'] = $categoryId;
        $path = 'getSubCategory';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        if($returnData['error_code']==200){
            $data['subcategory'] = $returnData['data']['subCategory'];
        }else{
            $data['subcategory'] = array();
        }
        $data['user_cart'] = $this->user_cart;
        $data['view_link'] = 'product_subcategory';
        $this->load->view('layout/template', $data);
    }
    
    public function product_list() {
        //echo $this->input->get('your_get_variable', TRUE);exit;
        $categoryId=$this->uri->segment('2');
        $subCategoryId=$this->uri->segment('3');

        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $data['user_id'] = $user_id;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['category_id'] = $categoryId;
        $strPost['sub_category_id'] = $subCategoryId;
        $strPost['limit'] = 120;
        $strPost['is_web'] = 1;
        ////////////////////FILTER////////////////////
        $value1Arr=array(); 
        $sendValue1="";$sendValue2="";$sendValue3="";
        for($i=1;$i<=3;$i++){
            if($i==1){
                $getValue1=$this->input->get('pid', TRUE);
            }elseif($i==2){
                $getValue1=$this->input->get('qid', TRUE);
            }else{
                $getValue1=$this->input->get('lid', TRUE);
            }
            if($getValue1){
                $getValue1=explode('-',$getValue1);
                if($getValue1){
                    foreach($getValue1 as $val){
                        if($val){
                            $val=explode('@',$val);
                            //print_r($val);exit;
                            if($val[1]){
                                if($i==1){
                                    if($sendValue1){
                                        $sendValue1=$sendValue1.'&'.$val[1];
                                    }else{
                                        $sendValue1=$val[1];
                                    }
                                    //echo $sendValue1;exit;
                                }elseif($i==2){
                                    if($sendValue2){
                                        $sendValue2=$sendValue2.'&'.$val[1];
                                    }else{
                                        $sendValue2=$val[1];
                                    }
                                    array_push($value1Arr,$val[1]);
                                }else{
                                    if($sendValue3){
                                        $sendValue3=$sendValue3.'&'.$val[1];
                                    }else{
                                        $sendValue3=$val[1];
                                    }
                                    array_push($value1Arr,$val[1]);
                                }
                            }
                        }
                    }
                }
            }
        }
        $strPost['value_id_1'] = $sendValue1;
        $strPost['value_id_2'] = $sendValue2;
        $strPost['value_id_3'] = $sendValue3;

        $getSid=$this->input->get('sid', TRUE);
        if($getSid){
            $strPost['specification'] = $getSid;
        }
////////////////////FILTER////////////////////
//echo "<pre/>";print_r($strPost);exit;
        $path = 'filterData';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if($returnData['error_code']==200){
            $data['product'] = $returnData['data']['product'];
            $data['filterData'] = $returnData['data']['filter_data'];
        }else{
            $data['product'] = array();
            $data['filterData'] = $returnData['data']['filter_data'];
        }

        $data['product_sub_category'] = "";
        $product_sub_category = $this->User_model->getSingleDataRow('product_sub_category', 'sub_category_id="'.$subCategoryId.'"');
        if($product_sub_category){
            if($product_sub_category['banner']){
                $data['product_sub_category'] = $product_sub_category['banner'];
            }
        }
        //echo "<pre/>";print_r($data);exit;
        $data['user_cart'] = $this->user_cart;
        $data['view_link'] = 'product_list';
        $this->load->view('layout/template', $data);
    }
    
    public function top_selling_product() {
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $data['user_id'] = $user_id;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['type'] = 2;
        $strPost['limit'] = 20;
        $strPost['is_web'] = 1;

        $path = 'getHomeViewAllProduct';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if($returnData['error_code']==200){
            $data['product'] = $returnData['data']['list'];
        }else{
            $data['product'] = array();
        }

        $data['user_cart'] = $this->user_cart;
        $data['view_link'] = 'top_selling_product';
        $this->load->view('layout/template', $data);
    }
    
    public function most_viewed_product() {
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $data['user_id'] = $user_id;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['type'] = 1;
        $strPost['limit'] = 20;
        $strPost['is_web'] = 1;

        $path = 'getHomeViewAllProduct';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if($returnData['error_code']==200){
            $data['product'] = $returnData['data']['list'];
        }else{
            $data['product'] = array();
        }

        $data['user_cart'] = $this->user_cart;
        $data['view_link'] = 'most_viewed_product';
        $this->load->view('layout/template', $data);
    }
    
    public function search_product() {
        $search=str_replace('%20',' ',$this->uri->segment(2));
        //echo $search=$this->uri->segment('2');exit;
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $data['user_id'] = $user_id;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['search'] = $search;
        $strPost['limit'] = 100;
        $strPost['is_web'] = 1;

        $path = 'searchProduct';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if($returnData['error_code']==200){
            $data['product'] = $returnData['data']['product'];
        }else{
            $data['product'] = array();
        }

        $data['user_cart'] = $this->user_cart;
        $data['view_link'] = 'search_product';
        $this->load->view('layout/template', $data);
    }

    public function most_booking_service() {
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['limit'] = 20;
        $strPost['is_web'] = 1;

        $path = 'getHomeViewAllBooking';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if($returnData['error_code']==200){
            $data['service'] = $returnData['data']['list'];
        }else{
            $data['service'] = array();
        }

        $data['user_cart'] = $this->user_cart;
        $data['view_link'] = 'most_booking_service';
        $this->load->view('layout/template', $data);
    }
    
    public function product_detail() {
        $product_name=$this->uri->segment('2');
        $product_id=$this->uri->segment('3');
        $item_id=$this->uri->segment('4');
        $ram=$this->uri->segment('5');
        $color=$this->uri->segment('6');

        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['product_id'] = $product_id;
        $strPost['item_id'] = $item_id;
        // $strPost['ram'] = $ram;
        // $strPost['color'] = $color;
        $strPost['is_web'] = 1;
        
        $path = 'productDetail';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if($returnData['error_code']==200){
            $data['user_id'] = $user_id;
            $data['product'] = $returnData['data']['product'];
            $data['user_cart'] = $this->user_cart;
            $data['view_link'] = 'product_detail';
            $this->load->view('layout/template', $data);
        }else{
            //echo "<script>alert('No data found');</script>";
            echo "<script>window.location.href='".base_url('no-data-found')."'</script>";
        }
    }
    
    public function quick_view_product_detail() {
        $product_name=$this->uri->segment('2');
        $product_id=$this->uri->segment('3');
        $item_id=$this->uri->segment('4');
        $ram=$this->uri->segment('5');
        $color=$this->uri->segment('6');

        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['product_id'] = $product_id;
        $strPost['item_id'] = $item_id;
        // $strPost['ram'] = $ram;
        // $strPost['color'] = $color;
        $strPost['is_web'] = 1;
        
        $path = 'productDetail';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if($returnData['error_code']==200){
            $data['user_id'] = $user_id;
            $data['product'] = $returnData['data']['product'];
            $data['user_cart'] = $this->user_cart;
            $data['view_link'] = 'product_detail_quick_view';
            $this->load->view('product_detail_quick_view', $data);
        }else{
            //echo "<script>alert('No data found');</script>";
            echo "<script>window.location.href='".base_url('no-data-found')."'</script>";
        }
    }







    public function service_category() {
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $path = 'getServiceCategory';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        if($returnData['error_code']==200){
            $data['category'] = $returnData['data']['category'];
        }else{
            $data['category'] = array();
        }
        $data['user_cart'] = $this->user_cart;
        $data['view_link'] = 'service_category';
        $this->load->view('layout/template', $data);
    }

    public function service_subcategory() {
        $latitude="28.124578";
        $longitude="78.124578";
        $zanomy_location = $this->session->userdata('zanomy_location');
        if($zanomy_location){
            if(isset($zanomy_location['lat']) and $zanomy_location['lat'] and isset($zanomy_location['lng']) and $zanomy_location['lng']){
                $latitude=$zanomy_location['lat'];
                $longitude=$zanomy_location['lng'];
            }
        }
        $category_id=$this->uri->segment('2');
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['category_id'] = $category_id;
        $strPost['latitude'] = $latitude;
        $strPost['longitude'] = $longitude;
        $strPost['is_web'] = 1;
        $path = 'getServiceSubCategory';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        if($returnData['error_code']==200){
            $data['subCategory'] = $returnData['data']['subCategory'];
        }else{
            $data['subCategory'] = array();
        }
        $data['user_cart'] = $this->user_cart;
        $data['view_link'] = 'service_subcategory';
        $this->load->view('layout/template', $data);
    }

    public function service_provider() {
        $latitude="28.124578";
        $longitude="78.124578";
        $zanomy_location = $this->session->userdata('zanomy_location');
        if($zanomy_location){
            if(isset($zanomy_location['lat']) and $zanomy_location['lat'] and isset($zanomy_location['lng']) and $zanomy_location['lng']){
                $latitude=$zanomy_location['lat'];
                $longitude=$zanomy_location['lng'];
            }
        }
        $sub_category_id=$this->uri->segment('2');
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['sub_category_id'] = $sub_category_id;
        $strPost['latitude'] = $latitude;
        $strPost['longitude'] = $longitude;
        $strPost['is_web'] = 1;
        $path = 'getServiceVendor';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        if($returnData['error_code']==200){
            $data['vendor'] = $returnData['data']['vendor'];
        }else{
            $data['vendor'] = array();
        }
        $data['user_cart'] = $this->user_cart;
        $data['view_link'] = 'service_provider';
        $this->load->view('layout/template', $data);
    }

    public function service_list() {
        $sub_category_id=$this->uri->segment('2');
        $vendor_id=$this->uri->segment('3');
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['vendor_id'] = $vendor_id;
        $strPost['sub_category_id'] = $sub_category_id;
        $strPost['limit'] = 10;
        $strPost['is_web'] = 1;
        $path = 'getService';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        if($returnData['error_code']==200){
            $data['service'] = $returnData['data']['service'];
        }else{
            $data['service'] = array();
        }
        $service_sub_category=$this->User_model->getSingleDataRow('service_sub_category','sub_category_id="'.$sub_category_id.'"');
        if(isset($service_sub_category['banner']) and $service_sub_category['banner']){
            $data['banner'] = $service_sub_category['banner'];
        }else{
            $data['banner'] = "";
        }
        $data['user_cart'] = $this->user_cart;
        $data['view_link'] = 'service_list';
        $this->load->view('layout/template', $data);
    }


    public function service_detail() {
        $latitude="28.124578";
        $longitude="78.124578";
        $address="H-54545 New Road Libya";
        $zanomy_location = $this->session->userdata('zanomy_location');
        if($zanomy_location){
            if(isset($zanomy_location['lat']) and $zanomy_location['lat'] and isset($zanomy_location['lng']) and $zanomy_location['lng']){
                $latitude=$zanomy_location['lat'];
                $longitude=$zanomy_location['lng'];
                $address=$zanomy_location['address'];
            }
        }

        $service_id=$this->uri->segment('2');

        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $data['latitude'] = $latitude;
        $data['longitude'] = $longitude;
        $data['address'] = $address;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['service_id'] = $service_id;
        $strPost['is_web'] = 1;
        
        $path = 'getServiceDetail';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if($returnData['error_code']==200){
            $data['user_id'] = $user_id;
            $data['service'] = $returnData['data'];
            $data['user_cart'] = $this->user_cart;
            $data['view_link'] = 'service_detail';
            $this->load->view('layout/template', $data);
        }else{
            echo "<script>alert('No data found');</script>";
            echo "<script>window.location.href='".base_url('/')."'</script>";
        }
    }
    










    
    
    
  
   

    public function my_account() {
        $data['view_link'] = 'my_account';
        $this->load->view('layout/template', $data);
    }
    public function edit_profile() {
        $data['view_link'] = 'edit_profile';
        $this->load->view('layout/template', $data);
    }
    
    
    
    public function my_transaction() {
        $data['view_link'] = 'my_transaction';
        $this->load->view('layout/template', $data);
    }
    public function edit_password() {
        $data['view_link'] = 'edit_password';
        $this->load->view('layout/template', $data);
    }
    
    
    
    
     public function mobile_about_us() {
         $this->load->view('mobile_about_us');
    }
    
     public function mobile_faq() {
        $this->load->view('mobile_faq');
    }
    
     public function mobile_terms_and_condition() {
         $this->load->view('mobile_terms_and_condition');
    }
    
    
    public function about_us() {
        $data['view_link'] = 'about_us';
        $this->load->view('layout/template', $data);
    }

    public function privacy_policy() {
        $data['view_link'] = 'privacy_policy';
        $this->load->view('layout/template', $data);
    }

    public function terms_and_condition() {
        $data['view_link'] = 'terms_and_condition';
        $this->load->view('layout/template', $data);
    }
    public function how_it_work() {
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $data['view_link'] = 'how_it_work';
        $this->load->view('layout/template', $data);
    }
    public function contact_us() {
        $data['view_link'] = 'contact_us';
        $this->load->view('layout/template', $data);
    }
    public function faq() {
        $data['view_link'] = 'faq';
        $this->load->view('layout/template', $data);
    }

    public function ajax() {
        $this->load->view('ajax_server');
    }
    
    public function getUserCart(){
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id'=>$user_id,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
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

    public function not_found() {
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        
        $data['user_id'] = $user_id;
        $data['user_cart'] = $this->user_cart;
        $data['view_link'] = 'pages/not_found';
        $this->load->view('layout/template', $data);
        
    }

    
}
?>
    