<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    $model                          = new Driver_model();
    $headers                        = getallheaders();
    $document                       = array();
    $document['device_id']      = isset($headers['device-id']) ? $headers['device-id'] : (isset($headers['Device-Id']) ? $headers['Device-Id'] : "");
    $document['security_token'] = isset($headers['security-token']) ? $headers['security-token'] : (isset($headers['Security-Token']) ? $headers['Security-Token'] : "");
    $lang                       = isset($headers['lang']) ? $headers['lang'] : (isset($headers['Lang']) ? $headers['Lang'] : "en");
    $systemUser                 = isset($headers['user-id']) ? "1" : (isset($headers['User-Id']) ? "1" : "0");
    
    $required                       = array ( 'driver_id','password');
    
    $checkRequired                  = $model->check_requiredField($_REQUEST,$required);
    if($checkRequired['status']){
        $error      = true;
        $code       = 98;
        $msg        = $checkRequired['field'].' field is required.';
        $data       = new stdClass();
    }else{
        //	$model->printRecord("register_req", $_REQUEST);

        $getProfile                             = $model->getProfile($_REQUEST);
        if($getProfile){
            $_REQUEST['password']               = md5($_REQUEST['password']);
            $createOtp                          = $model->changePassword($_REQUEST);
            if($createOtp){
                $error                          = false;
                $code                           = 200;
                $msg                            = 'Password changed successfully.';
                $data                           = new stdClass();
            }else{
                $error                          = false;
                $code                           = 201;
                $msg                            = 'Some error found.';
                $data                           = new stdClass();
            }
        }else{
            $error                          = false;
            $code                           = 97;
            $msg                            = 'User not exist.';
            $data                           = new stdClass();
        }
    }
}
echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));