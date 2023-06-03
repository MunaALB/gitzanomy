<?php
if ($_POST['method'] == 'login') {
    $model = new User_model();
    $sessionData=array(
      "user_id"        => $_POST['user_id'],
      "device_id"       => $_POST['device_id'],
      "security_token"  => $_POST['security_token'],
    );
    $this->session->set_userdata('zanomy_user_logged_in', $sessionData);
    $user = $this->session->userdata('zanomy_user_logged_in');
    //print_r($user);exit;
    if ($user) {
        $error      = false;
        $code       = 200;
        $msg        = 'Attribute list.';
        $data       = array();
    } else {
        $error      = true;
        $code       = 201;
        $msg        = 'Attribute list.';
        $data       = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'addReview') {
    $model = new Api_model();
    $user = $this->session->userdata('zanomy_user_logged_in');
    //print_r($user);exit;
    $headerArr = ['user_id'=>'00','lang' => 'en', 'device_id' => '', 'security_token' => ''];
    $path                   = 'addReview';
    $strPost['user_id']     = $user['user_id'];
    $strPost['product_id']  = $_POST['product_id'];
    $strPost['rating']      = $_POST['rating'];
    $strPost['review']      = $_POST['review'];
    $strPost['is_web']      = "1";

    $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
    $returnData= json_decode($returnData,TRUE);
    //echo '<pre/>';print_r($returnData);exit;

    if ($returnData['error_code']==200) {
        $error      = false;
        $code       = 200;
        $msg        = $returnData['message'];
        $data       = $returnData['data'];
    } else {
        $error      = true;
        $code       = 201;
        $msg        = $returnData['message'];
        $data       = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}



if ($_POST['method'] == 'addToCart') {
    $model = new Api_model();
    $user = $this->session->userdata('zanomy_user_logged_in');
    //print_r($user);exit;
    $headerArr = ['user_id'=>'00','lang' => 'en', 'device_id' => '', 'security_token' => ''];
    $path                   = 'addToCart';
    $strPost['user_id']     = $user['user_id'];
    $strPost['product_id']  = $_POST['product_id'];
    $strPost['item_id']     = $_POST['item_id'];
    $strPost['type']        = $_POST['type'];
    $strPost['is_web']      = "1";

    $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
    $returnData= json_decode($returnData,TRUE);
    //echo '<pre/>';print_r($returnData);exit;

    if ($returnData['error_code']==200) {
        $error      = false;
        $code       = 200;
        $msg        = $returnData['message'];
        $data       = $returnData['data'];
    } else {
        $error      = true;
        $code       = 201;
        $msg        = $returnData['message'];
        $data       = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'addToWishlist') {
    $model = new Api_model();
    $user = $this->session->userdata('zanomy_user_logged_in');
    //print_r($user);exit;
    $headerArr = ['user_id'=>'00','lang' => 'en', 'device_id' => '', 'security_token' => ''];
    $path                   = 'addToWishlist';
    $strPost['user_id']     = $user['user_id'];
    $strPost['product_id']  = $_POST['product_id'];
    $strPost['is_web']      = "1";

    $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
    $returnData= json_decode($returnData,TRUE);
    //echo '<pre/>';print_r($returnData);exit;

    if ($returnData['error_code']==200) {
        $error      = false;
        $code       = 200;
        $msg        = $returnData['message'];
        $data       = $returnData['data'];
    } else {
        $error      = true;
        $code       = 201;
        $msg        = $returnData['message'];
        $data       = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'editProfile') {
    $model = new Api_model();
    $user = $this->session->userdata('zanomy_user_logged_in');
    //print_r($user);exit;
    $headerArr = ['user_id'=>'00','lang' => 'en', 'device_id' => '', 'security_token' => ''];
    $path                   = 'editProfile';
    $strPost['user_id']     = $user['user_id'];
    $strPost['name']        = $_POST['name'];
    $strPost['email']       = $_POST['email'];
    $strPost['is_web']      = "1";

    $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
    $returnData= json_decode($returnData,TRUE);
    //echo '<pre/>';print_r($returnData);exit;

    if ($returnData['error_code']==200) {
        $error      = false;
        $code       = 200;
        $msg        = $returnData['message'];
        $data       = $returnData['data'];
    } else {
        $error      = true;
        $code       = 201;
        $msg        = $returnData['message'];
        $data       = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
if ($_POST['method'] == 'changeProfile') {
    $model = new Api_model();
    $user = $this->session->userdata('zanomy_user_logged_in');
    //print_r($user);exit;
    $headerArr = ['user_id'=>'00','lang' => 'en', 'device_id' => '', 'security_token' => ''];
    $path                   = 'changePassword';
    $strPost['user_id']     = $user['user_id'];
    $strPost['old_password']= $_POST['old_password'];
    $strPost['password']    = $_POST['password'];
    $strPost['is_web']      = "1";

    $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
    $returnData= json_decode($returnData,TRUE);
    //echo '<pre/>';print_r($returnData);exit;

    if ($returnData['error_code']==200) {
        $error      = false;
        $code       = 200;
        $msg        = $returnData['message'];
        $data       = $returnData['data'];
    } else {
        $error      = true;
        $code       = 201;
        $msg        = $returnData['message'];
        $data       = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'addServiceReview') {
    $model = new Api_model();
    $user = $this->session->userdata('zanomy_user_logged_in');
    //print_r($user);exit;
    $headerArr = ['user_id'=>'00','lang' => 'en', 'device_id' => '', 'security_token' => ''];
    $path                   = 'addServiceReview';
    $strPost['user_id']     = $user['user_id'];
    $strPost['service_id']  = $_POST['service_id'];
    $strPost['rating']      = $_POST['rating'];
    $strPost['review']      = $_POST['review'];
    $strPost['is_web']      = "1";

    $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
    $returnData= json_decode($returnData,TRUE);
    //echo '<pre/>';print_r($returnData);exit;

    if ($returnData['error_code']==200) {
        $error      = false;
        $code       = 200;
        $msg        = $returnData['message'];
        $data       = $returnData['data'];
    } else {
        $error      = true;
        $code       = 201;
        $msg        = $returnData['message'];
        $data       = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'addAddress') {
    $model = new Api_model();
    $user = $this->session->userdata('zanomy_user_logged_in');
    //print_r($user);exit;
    $headerArr = ['user_id'=>'00','lang' => 'en', 'device_id' => '', 'security_token' => ''];
    $path                       = 'addAddress';
    $strPost['user_id']         = $user['user_id'];
    $strPost['name']            = $_POST['name'];
    $strPost['postal_code']     = $_POST['postal_code'];
    $strPost['country_code']    = $_POST['country_code'];
    $strPost['mobile']          = $_POST['mobile'];
    $strPost['geo_address']     = $_POST['geo_address'];
    $strPost['street_address']  = $_POST['street_address'];
    $strPost['house_no']        = $_POST['house_no'];
    $strPost['country_id']      = $_POST['country'];
    $strPost['city_id']         = $_POST['city'];
    $strPost['lat']             = "28.1245778";
    $strPost['lng']             = "78.152458";
    $strPost['is_web']          = "1";

    $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
    $returnData= json_decode($returnData,TRUE);
    //echo '<pre/>';print_r($returnData);exit;

    if ($returnData['error_code']==200) {
        $error      = false;
        $code       = 200;
        $msg        = $returnData['message'];
        $data       = $returnData['data'];
    } else {
        $error      = true;
        $code       = 201;
        $msg        = $returnData['message'];
        $data       = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
?>
