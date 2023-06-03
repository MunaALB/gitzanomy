<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    $model                          = new User_model();
    $headers                        = getallheaders();
    $document                       = array();
    $document['device_id']      = isset($headers['device-id']) ? $headers['device-id'] : (isset($headers['Device-Id']) ? $headers['Device-Id'] : "");
    $document['security_token'] = isset($headers['security-token']) ? $headers['security-token'] : (isset($headers['Security-Token']) ? $headers['Security-Token'] : "");
    $lang                       = isset($headers['lang']) ? $headers['lang'] : (isset($headers['Lang']) ? $headers['Lang'] : "en");
    $systemUser                 = isset($headers['user-id']) ? "1" : (isset($headers['User-Id']) ? "1" : "0");
    
    $required                       = array ( 'user_id','password');
    
    $checkRequired                  = $model->check_requiredField($_REQUEST,$required);
    if($checkRequired['status']){
        $error      = true;
        $code       = 98;
        $msg        = $checkRequired['field'].' field is required.';
        $data       = new stdClass();
    }else{
        //	$model->printRecord("register_req", $_REQUEST);

        if(isset($getHeaderFunction['header']['lang'])){
            $langdata=$getHeaderFunction['header']['lang'];
        }else{
            $langdata='en';
        }

        $getProfile                             = $model->getProfile($_REQUEST);
        if($getProfile){
            $_REQUEST['password']               = md5($_REQUEST['password']);
            $createOtp                          = $model->changePassword($_REQUEST);
            if($createOtp){
                $error                          = false;
                $code                           = 200;
                $msg                            = 'Password changed successfully.';
                if($langdata=='ar'){
                    $msg                        = 'تم تغيير الرقم السري بنجاح';
                }else{
                    $msg                = 'Password changed successfully';
                }
                $data                           = new stdClass();
            }else{
                $error                          = false;
                $code                           = 201;
                if($langdata=='ar'){
                    $msg                        = 'تعذر على الخادم تقديم أي استجابة. الرجاء معاودة المحاولة في وقت لاحق';
                }else{
                    $msg                = 'Server could not get any responce.Please try again later.';
                }
                $data                           = new stdClass();
            }
        }else{
            $error                          = false;
            $code                           = 97;
            if($langdata=='ar'){
                $msg                        = 'المستخدم غير متوفر';
            }else{
                $msg                    = 'User not exist.';
            }
            $data                           = new stdClass();
        }
    }
}
echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));