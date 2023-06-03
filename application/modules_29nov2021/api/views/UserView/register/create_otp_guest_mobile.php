<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    
    $model              = new User_model();
    $getHeaderFunction  = $model->getHeaderFunction($_REQUEST,false);
    $lang               = $getHeaderFunction['header']['lang'];
    
    $required           = array ('mobile','password');
    $checkRequired      = $model->check_requiredField($_REQUEST,$required);
    if($checkRequired['status']){
        $error      = true;
        $code       = 98;
        $msg        = $checkRequired['field'].' field is required.';
        $data       = new stdClass();
    }else{
        //	$model->printRecord("register_req", $_REQUEST);
        $_REQUEST['otp']                = rand(1000,9999);
        $_REQUEST['otp']                        = "1234";
        $_REQUEST['country_code']       = '218';
        $_REQUEST['password']           = md5($_REQUEST['password']);
        $_REQUEST['created_at']         = strtotime(date('Y-m-d H:i:s'));
        if(isset($getHeaderFunction['header']['lang'])){
            $langdata=$getHeaderFunction['header']['lang'];
        }else{
            $langdata='en';
        }
        $sendOtp                                = $model->check_mobile_guest($_REQUEST);
        //print_r($sendOtp);exit;
        if($sendOtp){
            $createOtp                          = $model->createOtpMobile($_REQUEST);
            if($createOtp){
                $error                          = false;
                $code                           = 200;
                if($langdata=='ar'){
                    $msg                        = 'إرسال Otp إلى رقم هاتفك المحمول المسجل';
                    $msg                        = 'ارجو ادخال الرمز هذا : 1234';
                }else{
                    $msg                = 'Otp send to your registered Mobile-No';
                    $msg                = 'Please enter this code: 1234';
                }
                $msg                        = 'ارجو ادخال الرمز هذا : 1234';
                $data                           = array('otp'=>strval($_REQUEST['otp']));
            }else{
                $error                          = true;
                $code                           = 202;
                if($langdata=='ar'){
                    $msg                        = 'تعذر على الخادم تقديم أي استجابة. الرجاء معاودة المحاولة في وقت لاحق';
                }else{
                    $msg                = 'Server could not get any responce.Please try again later.';
                }
                $data                           = new stdClass();
            }
            
        }else{
            $error                              = false;
                $code                           = 200;
                if($langdata=='ar'){
                    $msg                        = 'إرسال Otp إلى رقم هاتفك المحمول المسجل';
                }else{
                    $msg                = 'Otp send to your registered Mobile-No';
                }
                $msg                        = 'ارجو ادخال الرمز هذا : 1234';
                $data                           = array('otp'=>strval($_REQUEST['otp']));
        }
    }
}
echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));
