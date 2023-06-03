<?php
if(!$_REQUEST) {
    $error              = true;
    $code               = 99;
    $msg                = 'Please Send Data in Key and Value Pair';
    $data               = new stdClass();
}else{
    $model              = new User_model();
    $getHeaderFunction  = $model->getHeaderFunction($_REQUEST,false);
    $lang               = $getHeaderFunction['header']['lang'];
    
    $required           = array ('name','email' ,'country_code', 'mobile','password');
    $checkRequired      = $model->check_requiredField($_REQUEST,$required);
    if($checkRequired['status']){
        $error          = true;
        $code           = 98;
        $msg            = $checkRequired['field'].' field is required.';
        $data           = new stdClass();
    }else{
        //$model->printRecord("register_req", $_REQUEST);
        $_REQUEST['otp']                = rand(1000,9999);
        $_REQUEST['otp']                        = "1234";
        $_REQUEST['password']           = md5($_REQUEST['password']);
        $_REQUEST['created_at']         = strtotime(date('Y-m-d H:i:s'));
        if(isset($getHeaderFunction['header']['lang'])){
            $langdata=$getHeaderFunction['header']['lang'];
        }else{
            $langdata='en';
        }
        if(isset($_REQUEST['is_web']) and $_REQUEST['is_web']==2){
            unset($_REQUEST['is_web']);
            $langdata='ar';
        }

        $check_mobile               = $model->check_mobile($_REQUEST);
        if($check_mobile){ 
            $error                  = false;
            $code                   = 201;
            if($langdata=='ar'){
                $msg                        = 'الهاتف المحمول موجود بالفعل';
            }else{
                $msg                    = 'Mobile already exist.';
            }
            
            $data                   = new stdClass();
        }else{
            $check_email            = $model->check_email($_REQUEST);
            if($check_email){
                $error                  = false;
                $code                   = 202;
                if($langdata=='ar'){
                    $msg                        = 'البريد الالكتروني موجود مسبقا';
                }else{
                    $msg                    = 'Email already exist.';
                }
                
                $data                   = new stdClass();
            }else{
                $sendOtp                = $model->userRegister($_REQUEST);
                if($sendOtp){
                    $error              = false;
                    $code               = 200;
                    if($langdata=='ar'){
                        $msg                        = 'إرسال Otp إلى رقم هاتفك المحمول المسجل';
                        $msg                        = 'ارجو ادخال الرمز هذا : 1234';
                    }else{
                        // $msg                = 'Otp send to your registered Mobile-No';
                        $msg                = 'Please enter this code: 1234';
                    }
                    
                    // $data               = array('otp'=>strval($_REQUEST['otp']).'ارجو ادخال الرمز هذا : ');
                    $data               = array('otp'=>'1234 :'.'ارجو ادخال الرمز هذا  ');
                }else{
                    $error              = true;
                    $code               = 203;
                    if($langdata=='ar'){
                        $msg                        = 'تعذر على الخادم تقديم أي استجابة. الرجاء معاودة المحاولة في وقت لاحق';
                    }else{
                        $msg                = 'Server could not get any responce.Please try again later.';
                    }
                    
                    $data               = new stdClass();
                }
            }
        }
    }
}
echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));