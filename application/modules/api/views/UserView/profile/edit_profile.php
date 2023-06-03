<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    $model                      = new User_model();

    $getHeaderFunction          = $model->getHeaderFunction($_REQUEST,true);
    if(isset($getHeaderFunction['header']['lang'])){
        $langdata=$getHeaderFunction['header']['lang'];
    }else{
        $langdata='en';
    }
    if($getHeaderFunction['status']){
        $required = array ('user_id');
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            

            $check                              = $model->getProfile($_REQUEST);
            if($check){
                $errorEmail=false;
                if(isset($_REQUEST['email']) and $_REQUEST['email']){
                    $checkEmail                       = $model->getSingleDataRow('users','email="'.$_REQUEST['email'].'" and user_id!="'.$_REQUEST['user_id'].'"');
                    if($checkEmail){
                        $errorEmail=true;
                    }
                }
                if($errorEmail){
                    $error                  = true;
                    $code                   = 202;
                    if($langdata=='ar'){
                        $msg                        = 'البريد الالكتروني موجود مسبقا';
                    }else{
                        $msg                    = 'Email already exist.';
                    }
                    $data                   = new stdClass();
                }else{
                    unset($_REQUEST['is_web']);
                    $editProfile                    = $model->profile($_REQUEST);
                    if($editProfile){
                        $check                      = $model->getProfile($_REQUEST);
                        if($check){
                            $error                  = false;
                            $code                   = 200;
                            
                            if($langdata=='ar'){
                                $msg                        = 'تم تحديث الملف الشخصي بنجاح';
                            }else{
                                $msg                    = 'Profile Updated Sucessfully';
                            }
                            $data                   = $check;
                        }else{
                            $error                  = true;
                            $code                   = 201;
                            if($langdata=='ar'){
                                $msg                        = 'تم العثور على بعض الأخطاء';
                            }else{
                                $msg                    = 'Some Error Found';
                            }
                            $data                   = new stdClass();
                        }
                    }else{
                        $error                  = true;
                        $code                   = 201;
                        
                        if($langdata=='ar'){
                            $msg                        = 'تم العثور على بعض الأخطاء';
                        }else{
                            $msg                    = 'Some Error Found';
                        }
                        $data                   = new stdClass();
                    }
                }
            }else{
                $error                  = true;
                $code                   = 97;
                if($langdata=='ar'){
                    $msg                        = 'المستخدم غير متوفر';
                }else{
                    $msg                    = 'User not exist.';
                }
                $data                   = new stdClass();
            }
        }
    }else{
        $error                  = true;
        $code                   = 301;
        if($langdata=='ar'){
            $msg                        = 'المصادقة فشلت';
        }else{
            $msg                        = 'Authentication failed';
        }
        $data                   = new stdClass();
    }
}

echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));