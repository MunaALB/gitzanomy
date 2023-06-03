<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = array();
}else{
    
    $model              = new User_model();
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
            $_REQUEST['otp']                        = "1234";

            if(isset($getHeaderFunction['header']['lang'])){
                $langdata=$getHeaderFunction['header']['lang'];
            }else{
                $langdata='en';
            }
            if(isset($_REQUEST['is_web']) and $_REQUEST['is_web']==2){
                unset($_REQUEST['is_web']);
                $langdata='ar';
            }

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
                                
                                if($langdata=='ar'){
                                    $msg            = 'تم تسجيل الدخول بنجاح';
                                }else{
                                    $msg                    = 'Login successfully.';
                                }
                                $data                   = $checkPassword;
                            }else{
                                $error                  = true;
                                $code                   = 201;
                                if($langdata=='ar'){
                                    $msg            = 'يرجى إدخال كلمة المرور الصحيحة';
                                }else{
                                    $msg                    = 'Please enter correct password.';
                                }
                                $data                   = new stdClass();
                            }
                        }else{
                            if($userLogin['type']==101){
                                $error                  = true;
                                $code                   = 202;
                                if($langdata=='ar'){
                                    $msg            = 'أنت محظور من قبل المشرف';
                                }else{
                                    $msg            = 'You are blocked by admin.';
                                }
                                $data                   = new stdClass();
                            }elseif($userLogin['type']==102){
                                $error                  = true;
                                $code                   = 206;
                                if($langdata=='ar'){
                                    $msg                        = 'تم إلغاء تنشيط هذا الحساب بشكل دائم';
                                }else{
                                    $msg            = 'This account is permanently de-activated.';
                                }
                                $data                   = new stdClass(); 
                            }elseif($userLogin['type']==103){
                                $error                  = true;
                                $code                   = 203;
                                if($langdata=='ar'){
                                    $msg                        = 'إرسال Otp إلى رقم هاتفك المحمول المسجل';
                                    $msg                        = 'ارجو ادخال الرمز هذا : 1234';
                                }else{
                                    // $msg                = 'Otp send to your registered Mobile-No';
                                    $msg                = 'Please enter this code: 1234';
                                }
                                $msg                        = 'ارجو ادخال الرمز هذا : 1234';
                                $data                   = array('otp'=>strval($_REQUEST['otp']));
                            }else{
                                $error                  = true;
                                $code                   = 204;
                                if($langdata=='ar'){
                                    $msg                        = 'تعذر على الخادم تقديم أي استجابة. الرجاء معاودة المحاولة في وقت لاحق';
                                }else{
                                    $msg                = 'Server could not get any responce.Please try again later.';
                                }
                                $data                   = new stdClass();
                            }
                        }
                    }else{
                        $error                  = true;
                        $code                   = 201;
                        
                        if($langdata=='ar'){
                            $msg            = 'يرجى إدخال كلمة المرور الصحيحة';
                        }else{
                            $msg                    = 'Please enter correct password.';
                        }
                        $data                   = new stdClass();
                    }
                
            }else{
                $error                              = true;
                $code                               = 205;
                if($langdata=='ar'){
                    $msg            = 'هذا الجوال غير مسجل';
                }else{
                    $msg                        = 'This Mobile is not registered';
                }
                $data                               = new stdClass();
            }
    }
}
echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));