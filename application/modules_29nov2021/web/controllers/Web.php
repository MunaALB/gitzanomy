<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('User_model', 'Api_model'));
        // $this->user_base_url="http://localhost/projects/zanomy/user/";
        $this->user_base_url = base_url('user/');
        if (isset($_COOKIE["zanomycookie"])) {
            "Hi " . $_COOKIE["zanomycookie"];
        } else {
            //$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            // $actual_link =@base_url($_SERVER[REQUEST_URI]);
            $actual_link = base_url();
            setcookie("zanomycookie", strtotime(date('Y-m-d H:i:s')) . rand(1000, 9999), time() + 30 * 24 * 60 * 60);
            echo "<script>window.location.href='" . $actual_link . "'</script>";
            //echo "<script>window.location.href='".base_url('/')."'</script>";
        }
        //if($_SERVER['SERVER_NAME']!="www.zanomy.com"){
        // echo "<script>window.location.href='https://www.zanomy.com'</script>";
        //echo "<script>window.location.href='".base_url()."'</script>";
        //}
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
        // echo $this->language_data;exit;
        /////////////////////////LANGUAGE////////////////////////////////
        /////////////////////////Homepage Location Popup////////////////////////////////
        if (!$this->session->userdata('zanomy_home_pops_session')) {
            $this->home_pop_data = false;
        } else {
            $this->home_pop_data = true;
        }
        /////////////////////////Homepage Location Popup////////////////////////////////
        if (!$this->session->userdata('zanomy_user_logged_in')) {
            $user_id = $_COOKIE["zanomycookie"];
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

    public function user_login() {
        $language_data = $this->language_data;
        $user_id = $this->user_data['user_id'];
        $data['user_id'] = $user_id;
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $path = 'adminSetting';
        $strPost['user_id'] = $user_id;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        $data['user_cart'] = $this->user_cart;
        $data['country_code'] = $returnData['data']['country_code'];
        //echo '<pre/>';print_r($data);exit;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/user_login';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'user_login';
            $this->load->view('layout/template', $data);
        }
    }

    public function user_registration() {
        $language_data = $this->language_data;
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $data['language_data'] = $this->language_data;

        $headerArr = ['user_id' => $user_id, 'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $path = 'adminSetting';
        $strPost['user_id'] = $user_id;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        $data['user_cart'] = $this->user_cart;
        $data['country_code'] = $returnData['data']['country_code'];
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/user_registration';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'user_registration';
            $this->load->view('layout/template', $data);
        }
    }

    public function forgot_password() {
        $language_data = $this->language_data;
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id' => $user_id, 'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $path = 'adminSetting';
        $strPost['user_id'] = $user_id;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        $data['user_cart'] = $this->user_cart;
        $data['country_code'] = $returnData['data']['country_code'];

        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/forgot_password';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'forgot_password';
            $this->load->view('layout/template', $data);
        }
    }

    // public function verify_otp() {
    //     $data['view_link'] = 'verify_otp';
    //     $this->load->view('layout/template', $data);
    // }
    public function reset_password() {
        $language_data = $this->language_data;
        $data['user_id'] = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $data['user_cart'] = $this->user_cart;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/reset_password';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'reset_password';
            $this->load->view('layout/template', $data);
        }
    }

    public function index() {
        $language_data = $this->language_data;
        //echo $language_data;exit;
        $data['home_pop_data'] = $this->home_pop_data;
        $login_type = $this->user_data['login_type'];
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $data['user_id'] = $user_id;
        $data['login_type'] = $login_type;

        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $path = 'getHomePage';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        // echo '<pre/>';print_r($returnData);exit;
        $data['homepage'] = $returnData ? $returnData['data'] : [];
        $data['user_cart'] = $this->user_cart;
        // echo '<pre/>';print_r($data);exit;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/index';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'index';
            $this->load->view('layout/template', $data);
        }
    }

    public function product_category() {
        $language_data = $this->language_data;
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id' => $user_id, 'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $path = 'getCategory';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        if ($returnData && $returnData['error_code'] == 200) {
            $data['category'] = $returnData['data']['category'];
        } else {
            $data['category'] = array();
        }
        
        
        if ($language_data == 'ar') {
            $data['user_cart'] = $this->user_cart;
            $data['view_link'] = 'view_ar/product_category';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['user_cart'] = $this->user_cart;
            $data['view_link'] = 'product_category';
            $this->load->view('layout/template', $data);
        }
        
        /*$data['user_cart'] = $this->user_cart;
        $data['view_link'] = 'product_category';
        $this->load->view('layout/template', $data);*/
    }

    public function product_subcategory() {
        $language_data = $this->language_data;
        $categoryId = $this->uri->segment('2');

        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $strPost['category_id'] = $categoryId;
        $path = 'getSubCategory';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        if ($returnData['error_code'] == 200) {
            $data['subcategory'] = $returnData['data']['subCategory'];
        } else {
            $data['subcategory'] = array();
        }
        $data['user_cart'] = $this->user_cart;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/product_subcategory';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'product_subcategory';
            $this->load->view('layout/template', $data);
        }
    }

    public function product_list() {
        $language_data = $this->language_data;
        //echo $this->input->get('your_get_variable', TRUE);exit;
        $categoryId = $this->uri->segment('2');
        $subCategoryId = $this->uri->segment('3');
        $new = $this->uri->segment('4');

        $login_type = $this->user_data['login_type'];
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $data['user_id'] = $user_id;
        $data['login_type'] = $login_type;

        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['category_id'] = $categoryId;
        $strPost['sub_category_id'] = $subCategoryId;
        if (is_numeric($new)) {
            $strPost['offer_id'] = $new;
        }

        ////////////     Pagination Request 22/04/2021     /////////////
        $strPost['web_limit'] = 18;
//        $strPost['start'] = 0;
        ////////////     Pagination Request 22/04/2021     /////////////
        $strPost['limit'] = 120;
        $strPost['is_web'] = 1;
        ////////////////////FILTER////////////////////
        $value1Arr = array();
        $sendValue1 = "";
        $sendValue2 = "";
        $sendValue3 = "";
        for ($i = 1; $i <= 3; $i++) {
            if ($i == 1) {
                $getValue1 = $this->input->get('pid', TRUE);
            } elseif ($i == 2) {
                $getValue1 = $this->input->get('qid', TRUE);
            } else {
                $getValue1 = $this->input->get('lid', TRUE);
            }
            if ($getValue1) {
                $getValue1 = explode('-', $getValue1);
                if ($getValue1) {
                    foreach ($getValue1 as $val) {
                        if ($val) {
                            $val = explode('@', $val);
                            //print_r($val);exit;
                            if ($val[1]) {
                                if ($i == 1) {
                                    if ($sendValue1) {
                                        $sendValue1 = $sendValue1 . '&' . $val[1];
                                    } else {
                                        $sendValue1 = $val[1];
                                    }
                                    //echo $sendValue1;exit;
                                } elseif ($i == 2) {
                                    if ($sendValue2) {
                                        $sendValue2 = $sendValue2 . '&' . $val[1];
                                    } else {
                                        $sendValue2 = $val[1];
                                    }
                                    array_push($value1Arr, $val[1]);
                                } else {
                                    if ($sendValue3) {
                                        $sendValue3 = $sendValue3 . '&' . $val[1];
                                    } else {
                                        $sendValue3 = $val[1];
                                    }
                                    array_push($value1Arr, $val[1]);
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

        $getSid = $this->input->get('sid', TRUE);
        if ($getSid) {
            $strPost['specification'] = $getSid;
        }

        $getBid = $this->input->get('bid', TRUE);
        if ($getBid) {
            $strPost['brand_id'] = $getBid;
        }

        $mnid = $this->input->get('mnid', TRUE);
        if (isset($mnid) and $mnid) {
            $strPost['min_price'] = $mnid;
        } else {
            $strPost['min_price'] = 1;
        }
        $mxid = $this->input->get('mxid', TRUE);
        if (isset($mxid) and $mxid) {
            $strPost['max_price'] = $mxid;
        } else {
            $strPost['max_price'] = 400000;
        }
//////////////////FILTER////////////////////
// echo "<pre/>";print_r($strPost);exit;
        $path = 'filterData';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
//        echo '<pre/>';print_r($returnData);exit;
        if ($returnData['error_code'] == 200) {
            $data['product'] = $returnData['data']['product'];
            $data['filterData'] = $returnData['data']['filter_data'];
            $data['total_count'] = $returnData['data']['total_product_count'];
            $data['total_count'] = $data['total_count'] / 18;
        } else {
            $data['product'] = array();
            $data['filterData'] = $returnData['data']['filter_data'];
            $data['total_count'] = 0;
        }

        $data['product_sub_category'] = "";
        $product_sub_category = $this->User_model->getSingleDataRow('product_sub_category', 'sub_category_id="' . $subCategoryId . '"');
        if ($product_sub_category) {
            if ($product_sub_category['banner']) {
                $data['product_sub_category'] = $product_sub_category['banner'];
            }
        }
//        echo "<pre/>";print_r($data);exit;
        $data['user_cart'] = $this->user_cart;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/product_list';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'product_list';
            $this->load->view('layout/template', $data);
        }
    }

    public function top_selling_product() {
        $language_data = $this->language_data;
        $user_id = $this->user_data['user_id'];
        $login_type = $this->user_data['login_type'];
        $data['base_url'] = $this->user_base_url;
        $data['user_id'] = $user_id;
        $data['login_type'] = $login_type;

        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['type'] = 2;
        $strPost['limit'] = 20;
        $strPost['is_web'] = 1;

        $path = 'getHomeViewAllProduct';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if ($returnData['error_code'] == 200) {
            $data['product'] = $returnData['data']['list'];
        } else {
            $data['product'] = array();
        }

        $data['user_cart'] = $this->user_cart;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/top_selling_product';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'top_selling_product';
            $this->load->view('layout/template', $data);
        }
    }

    public function most_viewed_product() {
        $language_data = $this->language_data;
        $user_id = $this->user_data['user_id'];
        $login_type = $this->user_data['login_type'];
        $data['base_url'] = $this->user_base_url;
        $data['user_id'] = $user_id;
        $data['login_type'] = $login_type;

        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['type'] = 1;
        $strPost['limit'] = 20;
        $strPost['is_web'] = 1;

        $path = 'getHomeViewAllProduct';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if ($returnData['error_code'] == 200) {
            $data['product'] = $returnData['data']['list'];
        } else {
            $data['product'] = array();
        }

        $data['user_cart'] = $this->user_cart;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/most_viewed_product';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'most_viewed_product';
            $this->load->view('layout/template', $data);
        }
    }

    public function search_product() {
        $language_data = $this->language_data;
        $search = urldecode(str_replace('%20', ' ', $this->uri->segment(2)));
        //echo $search=$this->uri->segment('2');exit;
        $user_id = $this->user_data['user_id'];
        $login_type = $this->user_data['login_type'];
        $data['base_url'] = $this->user_base_url;
        $data['user_id'] = $user_id;
        $data['login_type'] = $login_type;

        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['search'] = $search;
        $strPost['limit'] = 100;
        $strPost['is_web'] = 1;

        $path = 'searchProduct';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        // echo '<pre/>';print_r($returnData['data']['filter_data']['categoryList']);exit;
        if ($returnData['error_code'] == 200) {
            $data['product'] = $returnData['data']['product'];
            $data['filterData'] = $returnData['data']['filter_data'];
        } else {
            $data['product'] = array();
            $data['filterData'] = $returnData['data']['filter_data'];
        }

        $data['user_cart'] = $this->user_cart;
        // $data['view_link'] = 'search_product';
        // $this->load->view('layout/template', $data);

        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/search_product';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'search_product';
            $this->load->view('layout/template', $data);
        }
    }

    public function most_booking_service() {
        $language_data = $this->language_data;
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['limit'] = 20;
        $strPost['is_web'] = 1;

        $path = 'getHomeViewAllBooking';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if ($returnData['error_code'] == 200) {
            $data['service'] = $returnData['data']['list'];
        } else {
            $data['service'] = array();
        }

        $data['user_cart'] = $this->user_cart;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/most_booking_service';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'most_booking_service';
            $this->load->view('layout/template', $data);
        }
    }

    public function product_detail() {
        $language_data = $this->language_data;
        $product_name = $this->uri->segment('2');
        $product_id = $this->uri->segment('3');
        $item_id = $this->uri->segment('4');
        $ram = $this->uri->segment('5');
        $color = $this->uri->segment('6');

        $login_type = $this->user_data['login_type'];
        $user_id = $this->user_data['user_id'];
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
        //echo '<pre/>';print_r($returnData);exit;
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

    public function product_review() {
        $language_data = $this->language_data;
        $product_id = $this->uri->segment('2');
        $order_id = $this->uri->segment('3');
        $name = $this->uri->segment('4');

        $login_type = $this->user_data['login_type'];
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['product_id'] = $product_id;
        $strPost['is_web'] = 1;

        $path = 'productDetail';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if ($returnData['error_code'] == 200) {
            $data['user_id'] = $user_id;
            $data['login_type'] = $login_type;
            $data['product'] = $returnData['data']['product'];
            $data['user_cart'] = $this->user_cart;

            $checkReviewUser = $this->User_model->getRowData('order_id="' . $order_id . '" and product_id="' . $product_id . '" and user_id="' . $user_id . '"', 'product_review');
            if ($checkReviewUser) {
                $data['given_user'] = $checkReviewUser;
            } else {
                $data['given_user'] = false;
            }

            $product_cart = $this->db->select('u.*')
                            ->where("orders.order_id", $order_id)
                            ->where("orders.user_id", $user_id)
                            ->where("oi.product_id", $product_id)
                            ->join("order_items as oi", "oi.order_id=orders.order_id")
                            ->join("users as u", "u.user_id=orders.user_id")
                            ->get("orders")->row_array();
            // echo '<pre/>';print_r($product_cart);exit;
            if ($product_cart) {
                $data['combine_error'] = $product_cart;
            } else {
                $data['combine_error'] = false;
            }
            $data['order_id'] = $order_id;
            $data['product_id'] = $product_id;
            $data['user_id'] = $user_id;
            if ($language_data == 'ar') {
                // $data['view_link'] = 'view_ar/product_review';
                // $this->load->view('view_ar/layout/template', $data);
                $data['view_link'] = 'product_review';
                $this->load->view('layout/template', $data);
            } else {
                $data['view_link'] = 'product_review';
                $this->load->view('layout/template', $data);
            }
        } else {
            //echo "<script>alert('No data found');</script>";
            echo "<script>window.location.href='" . base_url('no-data-found') . "'</script>";
        }
    }

    public function quick_view_product_detail() {
        $product_name = $this->uri->segment('2');
        $product_id = $this->uri->segment('3');
        $item_id = $this->uri->segment('4');
        $ram = $this->uri->segment('5');
        $color = $this->uri->segment('6');

        $user_id = $this->user_data['user_id'];
        $login_type = $this->user_data['login_type'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id' => $user_id, 'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['product_id'] = $product_id;
        $strPost['item_id'] = $item_id;
        // $strPost['ram'] = $ram;
        // $strPost['color'] = $color;
        $strPost['is_web'] = 1;

        $path = 'productDetail';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if ($returnData['error_code'] == 200) {
            $data['user_id'] = $user_id;
            $data['login_type'] = $login_type;
            $data['product'] = $returnData['data']['product'];
            $data['user_cart'] = $this->user_cart;
            $data['view_link'] = 'product_detail_quick_view';
            $this->load->view('product_detail_quick_view', $data);
        } else {
            //echo "<script>alert('No data found');</script>";
            echo "<script>window.location.href='" . base_url('no-data-found') . "'</script>";
        }
    }

    public function service_category() {
        $language_data = $this->language_data;
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $path = 'getServiceCategory';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        if ($returnData['error_code'] == 200) {
            $data['category'] = $returnData['data']['category'];
        } else {
            $data['category'] = array();
        }
        $data['user_cart'] = $this->user_cart;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/service_category';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'service_category';
            $this->load->view('layout/template', $data);
        }
    }

    public function service_subcategory() {
        $language_data = $this->language_data;
        $latitude = "28.124578";
        $longitude = "78.124578";
        $zanomy_location = $this->session->userdata('zanomy_location');
        if ($zanomy_location) {
            if (isset($zanomy_location['lat']) and $zanomy_location['lat'] and isset($zanomy_location['lng']) and $zanomy_location['lng']) {
                $latitude = $zanomy_location['lat'];
                $longitude = $zanomy_location['lng'];
            }
        }
        $category_id = $this->uri->segment('2');
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['category_id'] = $category_id;
        $strPost['latitude'] = $latitude;
        $strPost['longitude'] = $longitude;
        $strPost['is_web'] = 1;
        $path = 'getServiceSubCategory';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        if ($returnData['error_code'] == 200) {
            $data['subCategory'] = $returnData['data']['subCategory'];
        } else {
            $data['subCategory'] = array();
        }
        $data['user_cart'] = $this->user_cart;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/service_subcategory';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'service_subcategory';
            $this->load->view('layout/template', $data);
        }
    }

    public function service_provider() {
        $language_data = $this->language_data;
        $latitude = "28.124578";
        $longitude = "78.124578";
        $zanomy_location = $this->session->userdata('zanomy_location');
        if ($zanomy_location) {
            if (isset($zanomy_location['lat']) and $zanomy_location['lat'] and isset($zanomy_location['lng']) and $zanomy_location['lng']) {
                $latitude = $zanomy_location['lat'];
                $longitude = $zanomy_location['lng'];
            }
        }
        $sub_category_id = $this->uri->segment('2');
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['sub_category_id'] = $sub_category_id;
        $strPost['latitude'] = $latitude;
        $strPost['longitude'] = $longitude;
        $strPost['is_web'] = 1;
        $path = 'getServiceVendor';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        // echo '<pre/>';print_r($returnData['data']);exit;
        if ($returnData['error_code'] == 200) {
            $data['vendor'] = $returnData['data']['vendor'];
        } else {
            $data['vendor'] = array();
        }
        $data['user_cart'] = $this->user_cart;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/service_provider';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'service_provider';
            $this->load->view('layout/template', $data);
        }
    }

    public function service_list() {
        $language_data = $this->language_data;
        $sub_category_id = $this->uri->segment('2');
        $vendor_id = $this->uri->segment('3');
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['vendor_id'] = $vendor_id;
        $strPost['sub_category_id'] = $sub_category_id;
        $strPost['limit'] = 10;
        $strPost['is_web'] = 1;
        $path = 'getService';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        //echo '<pre/>';print_r($returnData['data']);exit;
        if ($returnData['error_code'] == 200) {
            $data['service'] = $returnData['data']['service'];
        } else {
            $data['service'] = array();
        }
        $service_sub_category = $this->User_model->getSingleDataRow('service_sub_category', 'sub_category_id="' . $sub_category_id . '"');
        if (isset($service_sub_category['banner']) and $service_sub_category['banner']) {
            $data['banner'] = $service_sub_category['banner'];
        } else {
            $data['banner'] = "";
        }
        $data['user_cart'] = $this->user_cart;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/service_list';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'service_list';
            $this->load->view('layout/template', $data);
        }
    }

    public function service_detail() {
        $language_data = $this->language_data;
        $latitude = "28.124578";
        $longitude = "78.124578";
        $address = "H-54545 New Road Libya";
        $zanomy_location = $this->session->userdata('zanomy_location');
        if ($zanomy_location) {
            if (isset($zanomy_location['lat']) and $zanomy_location['lat'] and isset($zanomy_location['lng']) and $zanomy_location['lng']) {
                $latitude = $zanomy_location['lat'];
                $longitude = $zanomy_location['lng'];
                $address = $zanomy_location['address'];
            }
        }

        $service_id = $this->uri->segment('2');

        $user_id = $this->user_data['user_id'];
        $login_type = $this->user_data['login_type'];
        $data['base_url'] = $this->user_base_url;
        $data['latitude'] = $latitude;
        $data['longitude'] = $longitude;
        $data['address'] = $address;

        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['service_id'] = $service_id;
        $strPost['is_web'] = 1;

        $path = 'getServiceDetail';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        if ($returnData['error_code'] == 200) {
            $data['user_id'] = $user_id;
            $data['login_type'] = $login_type;
            $data['service'] = $returnData['data'];
            $data['user_cart'] = $this->user_cart;
            if ($language_data == 'ar') {
                $data['view_link'] = 'view_ar/service_detail';
                $this->load->view('view_ar/layout/template', $data);
            } else {
                $data['view_link'] = 'service_detail';
                $this->load->view('layout/template', $data);
            }
        } else {
            echo "<script>alert('No data found');</script>";
            echo "<script>window.location.href='" . base_url('/') . "'</script>";
        }
    }

    public function brand_list() {
        $language_data = $this->language_data;
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $brand = $this->User_model->getTableDataArrayLimit('brand', 'status=1', '100', '0');

        $data['brand_list'] = $brand;
        $data['user_id'] = $user_id;
        $data['user_cart'] = $this->user_cart;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/brand_list';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'brand_list';
            $this->load->view('layout/template', $data);
        }
    }

    public function product_by_brand() {
        $language_data = $this->language_data;
        $categoryId = $this->uri->segment('2');
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $strPost['user_id'] = $user_id;
        $strPost['brand_id'] = $categoryId;
        $strPost['limit'] = 120;
        $strPost['is_web'] = 1;

        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];

        $path = 'getBrandProduct';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        // echo '<pre/>';print_r($returnData);exit;
        if ($returnData['error_code'] == 200) {
            $data['product'] = $returnData['data']['product'];
            $data['filterData'] = $returnData['data']['filter_data'];
        } else {
            $data['product'] = array();
            $data['filterData'] = $returnData['data']['filter_data'];
        }

        $data['user_id'] = $user_id;
        $data['user_cart'] = $this->user_cart;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/brand_product_list';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'brand_product_list';
            $this->load->view('layout/template', $data);
        }
    }

    // public function my_account() {
    //     $data['view_link'] = 'my_account';
    //     $this->load->view('layout/template', $data);
    // }
    // public function edit_profile() {
    //     $data['view_link'] = 'edit_profile';
    //     $this->load->view('layout/template', $data);
    // }



    public function my_transaction() {
        $data['view_link'] = 'my_transaction';
        $this->load->view('layout/template', $data);
    }

    // public function edit_password() {
    //     $data['view_link'] = 'edit_password';
    //     $this->load->view('layout/template', $data);
    // }




    public function mobile_about_us() {
        $this->load->view('mobile_about_us');
    }

    public function mobile_faq() {
        $this->load->view('mobile_faq');
    }

    public function mobile_terms_and_condition() {
        $this->load->view('mobile_terms_and_condition');
    }

    public function mobile_privacy_policy() {
        $this->load->view('mobile_privacy_policy');
    }

    public function about_us() {
        $language_data = $this->language_data;
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $path = 'adminSetting';
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        if (isset($returnData['data']['subject']) and $returnData['data']['subject']) {
            $data['subject'] = $returnData['data']['subject'];
        } else {
            $data['subject'] = array();
        }
        //echo '<pre/>';print_r($returnData);exit;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/about_us';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'about_us';
            $this->load->view('layout/template', $data);
        }
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
        $language_data = $this->language_data;
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $path = 'adminSetting';
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        if (isset($returnData['data']['subject']) and $returnData['data']['subject']) {
            $data['subject'] = $returnData['data']['subject'];
        } else {
            $data['subject'] = array();
        }
        //echo '<pre/>';print_r($returnData);exit;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/contact_us';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'contact_us';
            $this->load->view('layout/template', $data);
        }
    }

    public function faq() {
        $data['view_link'] = 'faq';
        $this->load->view('layout/template', $data);
    }

    public function ajax() {
        $this->load->view('ajax_server');
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

    public function not_found() {

        // if(isset($_REQUEST['payment_reference']) and $_REQUEST['payment_reference']){
        //     $user_logged_in = $this->session->userdata('zanomy_user_logged_in');
        //     $pt=array(
        //         "merchant_email" => "alashter.mohaned@gmail.com",
        //         "secret_key" => "Bl1Dl322Q2eUjb0GcS9F7u6KalL4IDIjZKXkN0mD2AymMz3YrcEzGKkR65VPJD9Io62b7pPaZowMXALpMpZt9jkgpg58UeQilTts",
        //         "payment_reference" => $_REQUEST['payment_reference']
        //      ); 
        //     $baseurl = 'https://www.paytabs.com/apiv2/verify_payment';
        //     $returnDataApi = $this->User_model->payTabs($baseurl, $pt);
        //     $returnArr = json_decode($returnDataApi,true);
        //     // echo $returnArr['response_code'].'/';
        //     //print_r($returnArr);exit;
        //     if($returnArr['response_code']==100){
        //         $insertArr=[
        //             'user_id' => $user_logged_in['user_id'] != '' ? $user_logged_in['user_id'] : '',
        //             "order_id"  => $returnArr['reference_no'],
        //             "txn_id"    => $returnArr['transaction_id'],
        //             "total_amount"    => $returnArr['amount'],
        //             "reference_id"    => $_REQUEST['payment_reference'],
        //             "payment_status"    => "1",
        //             "is_web"    => "1",
        //             "type"      =>2
        //         ];
        //         $headerArr = [
        //             'device_id' => $user_logged_in['device_id'],
        //             'security_token' => $user_logged_in['security_token'],
        //             'lang'=>"en"
        //         ];
        //         // echo '<pre/>';print_r($insertArr);exit;
        //         $ppath = 'orderPayment';
        //         $result = $this->Api_model->apiCallHeader($ppath, $headerArr, $insertArr);
        //         $checkoutData = json_decode($result,true);
        //         //echo '<pre/>';print_r($checkoutData);exit;
        //         // redirect('order-detail/'.$returnArr['reference_no']);
        //         redirect('/');
        //     }elseif($returnArr['response_code']==481 or $returnArr['response_code']==482){
        //         $insertArr=[
        //             'user_id' => $user_logged_in['user_id'] != '' ? $user_logged_in['user_id'] : '',
        //             "order_id"  => $returnArr['reference_no'],
        //             "txn_id"    => $returnArr['transaction_id'],
        //             "total_amount"    => $returnArr['amount'],
        //             "reference_id"    => $_REQUEST['payment_reference'],
        //             "payment_status"    => "2",
        //             "is_web"    => "1",
        //         ];
        //         $headerArr = [
        //             'device_id' => $user_logged_in['device_id'],
        //             'security_token' => $user_logged_in['security_token']
        //         ];
        //         $ppath = 'orderPayment';
        //         $result = $this->User_model->apiCallHeader($ppath, $headerArr, $insertArr);
        //         $checkoutData = json_decode($result,true);
        //         redirect('order-fail');
        //     }else{
        //         redirect('invalid-transaction');
        //     }
        // }


        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;

        $data['user_id'] = $user_id;
        $data['user_cart'] = $this->user_cart;
        $data['view_link'] = 'pages/not_found';
        $this->load->view('layout/template', $data);
    }

    //////////////////////////////COOKIE/////////////////////////////////////////////////
    public function my_cart() {
        $language_data = $this->language_data;
        $data['user_data'] = [];

        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $data['user_cart'] = $this->user_cart;
        //echo '<pre/>';print_r($data);exit;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/user/my_cart';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'user/my_cart';
            $this->load->view('layout/template', $data);
        }
    }

    public function address() {
        $language_data = $this->language_data;
        // $data['user_data'] = $this->user_profile;
        $data['user_data'] = [];
        // echo '<pre/>';print_r($this->user_data);exit;
        $user_id = $this->user_data['user_id'];
        $login_type = $this->user_data['login_type'];
        $data['user_id'] = $user_id;
        $data['login_type'] = $login_type;
        $data['base_url'] = $this->user_base_url;
        $data['user_cart'] = $this->user_cart;
        //echo '<pre/>';print_r($data['user_cart']);exit;
        $headerArr = ['user_id' => $user_id, 'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $path = 'adminSetting';
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        $data['country_code'] = array();
        $data['city'] = array();
        if ($returnData['error_code'] == 200) {
            if (isset($returnData['data']['country_code']) and $returnData['data']['country_code']) {
                $data['country_code'] = $returnData['data']['country_code'];
            }
            if (isset($returnData['data']['city']) and $returnData['data']['city']) {
                $data['city'] = $returnData['data']['city'];
            }
        }
        //echo '<pre/>';print_r($returnData);exit;

        $headerArr = ['user_id' => $user_id, 'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $path = 'getMyAddress';
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        $data['getAddress'] = array();
        $data['getAddressCount'] = 0;
        if ($returnData['error_code'] == 200) {
            if (isset($returnData['data']['user_address']) and $returnData['data']['user_address']) {
                $data['getAddress'] = $returnData['data']['user_address'];
                $data['getAddressCount'] = count($returnData['data']['user_address']);
            }
        }
        //echo '<pre/>';print_r($returnData);exit;

        $headerArr = ['user_id' => $user_id, 'lang' => 'en', 'device_id' => '', 'security_token' => ''];
        $path = 'couponList';
        $strPost['user_id'] = $user_id;
        $strPost['is_web'] = 1;
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        //echo '<pre/>';print_r($returnData);exit;
        $data['couponList'] = array();
        if ($returnData['error_code'] == 200) {
            if (isset($returnData['data']['couponArr']) and $returnData['data']['couponArr']) {
                $data['couponList'] = $returnData['data']['couponArr'];
            }
        }
        // echo '<pre/>';print_r($data);exit;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/user/address';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'user/address';
            $this->load->view('layout/template', $data);
        }
    }

    public function transaction_status() {











        echo "success";
        print_r($_REQUEST);
        exit;
        // $user_logged_in = $this->session->userdata('customer_logged_in');

        $pt = array(
            "merchant_email" => "alashter.mohaned@gmail.com",
            "secret_key" => "Bl1Dl322Q2eUjb0GcS9F7u6KalL4IDIjZKXkN0mD2AymMz3YrcEzGKkR65VPJD9Io62b7pPaZowMXALpMpZt9jkgpg58UeQilTts",
            "payment_reference" => $_REQUEST['payment_reference']
        );
        $baseurl = 'https://www.paytabs.com/apiv2/verify_payment';
        $returnDataApi = $this->User_model->payTabs($baseurl, $pt);
        $returnArr = json_decode($returnDataApi, true);
        // echo $returnArr['response_code'].'/';
        echo '<pre>';
        print_r($returnArr);
        exit;
        if ($returnArr['response_code'] == 100) {
            $insertArr = [
                'user_id' => $user_logged_in['user_id'] != '' ? $user_logged_in['user_id'] : '',
                "order_id" => $returnArr['reference_no'],
                "txn_id" => $returnArr['transaction_id'],
                "total_amount" => $returnArr['amount'],
                "reference_id" => $_REQUEST['payment_reference'],
                "payment_status" => "1",
                "is_web" => "1",
            ];
            $headerArr = [
                'device_id' => $user_logged_in['device_id'],
                'security_token' => $user_logged_in['security_token'],
                'lang' => "en"
            ];

            // echo '<pre/>';print_r($insertArr);exit;
            $ppath = 'orderPayment';
            $result = $this->User_model->apiCallHeader($ppath, $headerArr, $insertArr);
            $checkoutData = json_decode($result, true);
            //echo '<pre/>';print_r($checkoutData);exit;
            redirect('order-success');
        } elseif ($returnArr['response_code'] == 481 or $returnArr['response_code'] == 482) {
            $insertArr = [
                'user_id' => $user_logged_in['user_id'] != '' ? $user_logged_in['user_id'] : '',
                "order_id" => $returnArr['reference_no'],
                "txn_id" => $returnArr['transaction_id'],
                "total_amount" => $returnArr['amount'],
                "reference_id" => $_REQUEST['payment_reference'],
                "payment_status" => "2",
                "is_web" => "1",
            ];
            $headerArr = [
                'device_id' => $user_logged_in['device_id'],
                'security_token' => $user_logged_in['security_token']
            ];
            $ppath = 'orderPayment';
            $result = $this->User_model->apiCallHeader($ppath, $headerArr, $insertArr);
            $checkoutData = json_decode($result, true);
            redirect('order-fail');
        } else {
            redirect('invalid-transaction');
        }
















        print_r($_REQUEST);
        exit;
        $language_data = $this->language_data;
        $orderId = $this->uri->segment('2');
        if (isset($orderId) and $orderId) {
            $data['user_data'] = $this->user_profile;

            $user_id = $this->user_data['user_id'];

            $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
            $path = 'orderDetail';
            $strPost['order_id'] = $orderId;
            $strPost['user_id'] = $user_id;
            $strPost['is_web'] = 1;
            $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
            $returnData = json_decode($returnData, TRUE);
            //print_r($returnData);exit;
            if ($returnData['error_code'] == 200) {
                $data['orderDetail'] = $returnData['data']['list'];
            }
        } else {
            $data['orderDetail'] = array();
        }
        $data['base_url'] = $this->user_base_url;
        $data['user_cart'] = $this->user_cart;
        //echo '<pre/>';print_r($data);exit;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/pages/success';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'pages/success';
            $this->load->view('layout/template', $data);
        }
    }

    public function order_success() {

        $language_data = $this->language_data;
        $orderId = $this->uri->segment('2');
        if (isset($orderId) and $orderId) {
            $data['user_data'] = $this->user_profile;

            $user_id = $this->user_data['user_id'];

            $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
            $path = 'orderDetail';
            $strPost['order_id'] = $orderId;
            $strPost['user_id'] = $user_id;
            $strPost['is_web'] = 1;
            $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
            $returnData = json_decode($returnData, TRUE);
            //print_r($returnData);exit;
            if ($returnData['error_code'] == 200) {
                $data['orderDetail'] = $returnData['data']['list'];
            }
        } else {
            $data['orderDetail'] = array();
        }
        $data['base_url'] = $this->user_base_url;
        $data['user_cart'] = $this->user_cart;
        //echo '<pre/>';print_r($data);exit;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/pages/success';
            $this->load->view('view_ar/layout/template', $data);
        } else {
            $data['view_link'] = 'pages/success';
            $this->load->view('layout/template', $data);
        }
    }

    public function ajaxserver() {
        $this->load->view('server');
    }

    //////////////////////////////COOKIE/////////////////////////////////////////////////
    ////////////     Pagination Request 22/04/2021     /////////////

    public function load_more_products() {
        $language_data = $this->language_data;
        //echo $this->input->get('your_get_variable', TRUE);exit;
        $categoryId = $this->input->post('category_id');
        $subCategoryId = $this->input->post('sub_category_id');
        $new = $this->input->post('new');

        $login_type = $this->user_data['login_type'];
        $user_id = $this->user_data['user_id'];
        $data['base_url'] = $this->user_base_url;
        $data['user_id'] = $user_id;
        $data['login_type'] = $login_type;

        $headerArr = ['user_id' => $user_id, 'lang' => $language_data, 'device_id' => '', 'security_token' => ''];
        $strPost['user_id'] = $user_id;
        $strPost['category_id'] = $categoryId;
        $strPost['sub_category_id'] = $subCategoryId;
        if (is_numeric($new)) {
            $strPost['offer_id'] = $new;
        }


        $strPost['web_limit'] = 18;
        $strPost['start'] = $this->input->post('start');

        $strPost['limit'] = 120;
        $strPost['is_web'] = 1;
        ////////////////////FILTER////////////////////
        $value1Arr = array();
        $sendValue1 = "";
        $sendValue2 = "";
        $sendValue3 = "";
        for ($i = 1; $i <= 3; $i++) {
            if ($i == 1) {
                $getValue1 = $this->input->get('pid', TRUE);
            } elseif ($i == 2) {
                $getValue1 = $this->input->get('qid', TRUE);
            } else {
                $getValue1 = $this->input->get('lid', TRUE);
            }
            if ($getValue1) {
                $getValue1 = explode('-', $getValue1);
                if ($getValue1) {
                    foreach ($getValue1 as $val) {
                        if ($val) {
                            $val = explode('@', $val);
                            //print_r($val);exit;
                            if ($val[1]) {
                                if ($i == 1) {
                                    if ($sendValue1) {
                                        $sendValue1 = $sendValue1 . '&' . $val[1];
                                    } else {
                                        $sendValue1 = $val[1];
                                    }
                                    //echo $sendValue1;exit;
                                } elseif ($i == 2) {
                                    if ($sendValue2) {
                                        $sendValue2 = $sendValue2 . '&' . $val[1];
                                    } else {
                                        $sendValue2 = $val[1];
                                    }
                                    array_push($value1Arr, $val[1]);
                                } else {
                                    if ($sendValue3) {
                                        $sendValue3 = $sendValue3 . '&' . $val[1];
                                    } else {
                                        $sendValue3 = $val[1];
                                    }
                                    array_push($value1Arr, $val[1]);
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

        $getSid = $this->input->get('sid', TRUE);
        if ($getSid) {
            $strPost['specification'] = $getSid;
        }

        $getBid = $this->input->get('bid', TRUE);
        if ($getBid) {
            $strPost['brand_id'] = $getBid;
        }

        $mnid = $this->input->get('mnid', TRUE);
        if (isset($mnid) and $mnid) {
            $strPost['min_price'] = $mnid;
        } else {
            $strPost['min_price'] = 1;
        }
        $mxid = $this->input->get('mxid', TRUE);
        if (isset($mxid) and $mxid) {
            $strPost['max_price'] = $mxid;
        } else {
            $strPost['max_price'] = 400000;
        }
////////////////////FILTER////////////////////
//        echo '<pre>';print_r($strPost);die;
        $path = 'filterData';
        $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
        $returnData = json_decode($returnData, TRUE);
        if ($returnData['error_code'] == 200) {
            $data['product'] = $returnData['data']['product'];
            $data['filterData'] = $returnData['data']['filter_data'];
            $data['total_count'] = $returnData['data']['total_product_count'];
            $data['total_count'] = $data['total_count'] / 18;
        } else {
            $data['product'] = array();
            $data['filterData'] = $returnData['data']['filter_data'];
            $data['total_count'] = 0;
        }
        $products = [];
        if ($data['product']) {
            foreach ($data['product'] as $product) {
                $product_element = '<div class="product-layout col-md-4 col-sm-6 col-xs-12">' .
                        '<div class="product-item-container">' .
                        '<div class="left-block">' .
                        '<div class="product-image-container ' . (isset($product['images'][1]) ? "second_img" : '') . '">' .
                        '<a href="' . base_url('product-detail/' . (preg_replace('/[^a-zA-Z0-9_.]/', '-', $product['name'])) . '/' . $product['product_id']) . '" title="' . $product['name'] . '">';
                if (isset($product['images'][0])):
                    $product_element .= '<img src="' . $product['images'][0]['image'] . '" class="img-1 img-responsive" alt="320 X 320">';
                    if (isset($product['images'][1])):
                        $product_element .= '<img src="' . $product['images'][1]['image'] . '" class="img-2 img-responsive" alt="320 X 320">';
                    endif;
                else:
                    $product_element .= '<img src="' . base_url() . 'assets/web/images/product/320/2.2.jpg" class="img-1 img-responsive" alt="320 X 320">';
                endif;
                $product_element .= '</a>' .
                        '</div>' .
                        '<div class="button-group so-quickview cartinfo--left">';
                if ($user_id == "00"):
                    $product_element .= '<button type="button" onclick="loginRequired(this,1);" class="addToCart btn-button" title="Add to cart">  <i class="fa fa-shopping-basket"></i>
                                                    <span>Add to cart </span>   
                                                </button>';
                else:
                    if ($product['quantity'] == 0):
                        $product_element .= '<button type="button" onclick="loginRequired(this,2);" class="addToCart btn-button" title="Add to cart">  <i class="fa fa-shopping-basket"></i>
                                                        <span>Add to cart </span>   
                                                    </button>';
                    else:
                        $product_element .= '<button type="button" onclick="addToCart(this,' . $product['product_id'] . ',' . $product['item_id'] . ',1);" class="addToCart btn-button" title="Add to cart">  <i class="fa fa-shopping-basket"></i>
                                                        <span>Add to cart </span>   
                                                    </button>';
                    endif;
                endif;

                if ($login_type == "2"):
                    $product_element .= '<button type="button" onclick="loginRequired(this,1);" class="wishlist btn-button" title="Add to Wish List"><i class="fa fa-heart"></i><span>Add to Wish List</span></button> ';
                else:
                    if ($product['is_fav'] == 0):
                        $product_element .= '<button type="button" onclick="addToWishlist(this,' . $product['product_id'] . ');" class="wishlist btn-button" title="Add to Wish List"><i class="fa fa-heart"></i><span>Add to Wish List</span></button>';
                    else:
                        $product_element .= '<button type="button" onclick="addToWishlist(this,' . $product['product_id'] . ');" class="wishlist btn-button" title="Add to Wish List"><i class="fa fa-heart" style="background:red;"></i><span>Remove from Wish List</span></button>';
                    endif;
                endif;
                $product_element .= '<a class="iframe-link btn-button quickview quickview_handler visible-lg" href="' . base_url('quick-view-product-detail/' . (preg_replace('/[^a-zA-Z0-9_.]/', '-', $product['name'])) . '/' . $product['product_id']) . '" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>' .
                        '</div>' .
                        '</div>' .
                        '<div class="right-block">' .
                        '<div class="caption">' .
                        '<h4><a href="' . base_url('product-detail/' . (preg_replace('/[^a-zA-Z0-9_.]/', '-', $product['name'])) . '/' . $product['product_id']) . '" title="Pride Mobility Chair">' . $product['name'] . '</a></h4>' .
                        '<div class="price"> <span class="price-new">' . $product['discount_price'] . ' LYD</span>';
                if ($product['discount'] > 0):
                    $product_element .= '<span class="price-old">' . $product['price'] . ' LYD</span>';
                endif;
                $product_element .= '</div>' .
                        '</div>' .
                        '</div>' .
                        '</div>' .
                        '</div>';
                array_push($products, $product_element);
            }
        }

//        $data['product_sub_category'] = "";
//        $product_sub_category = $this->User_model->getSingleDataRow('product_sub_category', 'sub_category_id="'.$subCategoryId.'"');
//        if($product_sub_category){
//            if($product_sub_category['banner']){
//                $data['product_sub_category'] = $product_sub_category['banner'];
//            }
//        }
//        echo "<pre/>";print_r($data);exit;
//        $data['user_cart'] = $this->user_cart;
//        if($language_data=='ar'){
//            $data['view_link'] = 'view_ar/product_list';
//            $this->load->view('view_ar/layout/template', $data);
//        }else{
//            $data['view_link'] = 'product_list';
//            $this->load->view('layout/template', $data);
//        }

        echo json_encode(['products'=>$products]);die;
    }

    ////////////     Pagination Request 22/04/2021     /////////////
}
?>
    
