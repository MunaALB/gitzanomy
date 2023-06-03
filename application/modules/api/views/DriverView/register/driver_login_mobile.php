<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = array();
}else{
    
    $model              = new Driver_model();
    $getHeaderFunction  = $model->getHeaderFunction($_REQUEST,false);
    $lang               = $getHeaderFunction['header']['lang'];
    
    $required           = array ('country_code','mobile' ,'password','device_type', 'device_id', 'device_token');
    $checkRequired=$model->check_requiredField($_REQUEST,$required);
    if($checkRequired['status']){
        $error      = true;
        $code       = 98;
        $msg        = $checkRequired['field'].' field is required.';
        $data       = new stdClass();
    }else{
//	$model->printRecord("register_req", $_REQUEST);
            $_REQUEST['password']                   = md5($_REQUEST['password']);
            $_REQUEST['otp']                        = rand(1000,9999);
            $sendOtp                                = $model->check_mobile($_REQUEST);
            if($sendOtp){
                
                    $checkPassword                  = $model->checkPasswordMobile($_REQUEST);
                    if($checkPassword){
                        
                        $userLogin                      = $model->userLoginMobile($_REQUEST);
                        if($userLogin['status']){
                            $checkPassword              = $model->checkPasswordMobile($_REQUEST);
                            if($checkPassword){
                                $error                  = false;
                                $code                   = 200;
                                $msg                    = 'Login successfully.';
                                $data                   = $checkPassword;
                            }else{
                                $error                  = true;
                                $code                   = 201;
                                $msg                    = 'Please enter correct password.';
                                $data                   = new stdClass();
                            }
                        }else{
                            if($userLogin['type']==101){
                                $error                  = true;
                                $code                   = 202;
                                $msg                    = 'You are blocked by admin';
                                $data                   = new stdClass();
                            }elseif($userLogin['type']==102){
                                $error                  = true;
                                $code                   = 206;
                                $msg                    = 'This account is permanently de-activated.';
                                $data                   = new stdClass();
                            }elseif($userLogin['type']==103){
                                $error                  = true;
                                $code                   = 203;
                                $msg                    = 'Otp send to your registered Mobile-No.';
                                $data                   = array('otp'=>strval($_REQUEST['otp']));
                            }else{
                                $error                  = true;
                                $code                   = 204;
                                $msg                    = 'Some error found.';
                                $data                   = new stdClass();
                            }
                        }
                    }else{
                        $error                  = true;
                        $code                   = 201;
                        $msg                    = 'Please enter correct password.';
                        $data                   = new stdClass();
                    }
                
            }else{
                $error                              = true;
                $code                               = 205;
                $msg                                = 'This Mobile is not registered.';
                $data                               = new stdClass();
            }
    }
}
echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));