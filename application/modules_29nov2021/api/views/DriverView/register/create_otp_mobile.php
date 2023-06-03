<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    
    $model              = new Driver_model();
    $getHeaderFunction  = $model->getHeaderFunction($_REQUEST,false);
    $lang               = $getHeaderFunction['header']['lang'];
    
    $required           = array ( 'country_code','mobile');
    $checkRequired      = $model->check_requiredField($_REQUEST,$required);
    if($checkRequired['status']){
        $error      = true;
        $code       = 98;
        $msg        = $checkRequired['field'].' field is required.';
        $data       = new stdClass();
    }else{
        //	$model->printRecord("register_req", $_REQUEST);
        $_REQUEST['otp']                        = rand(1000,9999);
        $sendOtp                                = $model->check_mobile($_REQUEST);
        if($sendOtp){
            $createOtp                          = $model->createOtpMobile($_REQUEST);
            if($createOtp){
                $error                          = false;
                $code                           = 200;
                $msg                            = 'Otp send to your registered Mobile-No';
                $data                           = array('otp'=>strval($_REQUEST['otp']));
            }else{
                $error                          = true;
                $code                           = 202;
                $msg                            = 'Some error found.';
                $data                           = new stdClass();
            }
            
        }else{
            $error                              = true;
            $code                               = 201;
            $msg                                = 'This Mobile is not registered.';
            $data                               = new stdClass();
        }
    }
}
echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));