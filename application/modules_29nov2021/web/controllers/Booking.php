<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('User_model','Api_model'));
        
        $language_data='en';
        if(isset($_REQUEST['payment_reference']) and $_REQUEST['payment_reference']){
            // $user_logged_in = $this->session->userdata('zanomy_user_logged_in');
            // $user_logged_in=array('user_id'=>40,'device_id'=>46544,'security_token'=>'security_token');
        
            $pt=array(
                "merchant_email" => "alashter.mohaned@gmail.com",
                "secret_key" => "Bl1Dl322Q2eUjb0GcS9F7u6KalL4IDIjZKXkN0mD2AymMz3YrcEzGKkR65VPJD9Io62b7pPaZowMXALpMpZt9jkgpg58UeQilTts",
                "payment_reference" => $_REQUEST['payment_reference']
             ); 
            $baseurl = 'https://www.paytabs.com/apiv2/verify_payment';
            $returnDataApi = $this->User_model->payTabs($baseurl, $pt);
            $returnArr = json_decode($returnDataApi,true);
            // echo $returnArr['response_code'].'/';
            // echo "success";print_r($returnArr);exit;
            if($returnArr['response_code']==100){

                $this->db->where('booking_id',$returnArr['reference_no']); 
                $service_booking = $this->db->get('service_booking')->row_array();

                $insertArr=[
                    'user_id' => $service_booking['user_id'] != '' ? $service_booking['user_id'] : '',
                    "order_id"  => $returnArr['reference_no'],
                    "txn_id"    => $returnArr['transaction_id'],
                    "total_amount"    => $returnArr['amount'],
                    "reference_id"    => $_REQUEST['payment_reference'],
                    "payment_status"    => "1",
                    "is_web"    => "1",
                    "type"      =>2
                ];
                // echo '<pre/>';print_r($insertArr);exit;
                $headerArr = ['user_id'=>$service_booking['user_id'],'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
    
                // echo '<pre/>';print_r($insertArr);exit;
                $ppath = 'orderPayment';
                $result = $this->Api_model->apiCallHeader($ppath, $headerArr, $insertArr);
                $checkoutData = json_decode($result,true);
                // echo '<pre/>';print_r($checkoutData);exit;
                // redirect('order-detail/'.$returnArr['reference_no']);
                redirect('/');
            }elseif($returnArr['response_code']==481 or $returnArr['response_code']==482){
                // $insertArr=[
                //     'user_id' => $user_logged_in['user_id'] != '' ? $user_logged_in['user_id'] : '',
                //     "order_id"  => $returnArr['reference_no'],
                //     "txn_id"    => $returnArr['transaction_id'],
                //     "total_amount"    => $returnArr['amount'],
                //     "reference_id"    => $_REQUEST['payment_reference'],
                //     "payment_status"    => "2",
                //     "is_web"    => "1",
                //     "type"      =>2
                // ];
                // // echo '<pre/>';print_r($insertArr);exit;
                // $headerArr = ['user_id'=>$user_logged_in['user_id'],'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
    
                // // echo '<pre/>';print_r($insertArr);exit;
                // $ppath = 'orderPayment';
                // $result = $this->Api_model->apiCallHeader($ppath, $headerArr, $insertArr);
                // $checkoutData = json_decode($result,true);
                // // echo '<pre/>';print_r($checkoutData);exit;
                // // redirect('order-detail/'.$returnArr['reference_no']);
                
                redirect('order-fail');
            }else{
                redirect('invalid-transaction');
            }
        }


    }

    function apiCallHeader($path, $headerData, $bodyData) {
        $headers = array("user-id:".$headerData['user_id'],"Lang:" . $headerData['lang'], "DeviceId:" . $headerData['device_id'], "SecurityToken:" . $headerData['security_token'], "Content-Type:multipart/form-data");
        $url = base_url() . "user/" . $path;
       //$url = "http://auctionbuy.in/menzil_info/apiAgent/" . $path;
        //intialize cURL and send POST data
        $ch = @curl_init();
        @curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyData);
        @curl_setopt($ch, CURLOPT_URL, $url);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $myvar = @curl_exec($ch);
        curl_close($ch);
             //echo '<pre/>';print_r($myvar);
        return $myvar;
    }


    public function booking_transaction_updated() {
        echo "method Call ";exit;
        $language_data = $this->language_data;
        $user_id = $this->user_data['user_id'];
        $data['user_id'] = $user_id;
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id'=>$user_id,'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $path = 'adminSetting';
        $strPost['user_id'] = $user_id;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData= json_decode($returnData,TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        $data['user_cart'] = $this->user_cart;
        $data['country_code'] = $returnData['data']['country_code'];
        //echo '<pre/>';print_r($data);exit;
        if($language_data=='ar'){
            $data['view_link'] = 'view_ar/user_login';
            $this->load->view('view_ar/layout/template', $data);
        }else{
            $data['view_link'] = 'user_login';
            $this->load->view('layout/template', $data);
        }
    }
    
    

    //////////////////////////////COOKIE/////////////////////////////////////////////////
    
}
?>
    