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
        $required = array ( 'user_id','old_password','password');

        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            

            $_REQUEST['old_password']           = md5($_REQUEST['old_password']);
            $_REQUEST['password']               = md5($_REQUEST['password']);
            $checkPassword                      = $model->getSingleDataRow('users','user_id="'.$_REQUEST['user_id'].'" and password="'.$_REQUEST['old_password'].'"');
            if($checkPassword){
                $updatedataTable                = $model->updatedataTable('users','user_id="'.$_REQUEST['user_id'].'"',array('password'=>$_REQUEST['password']));
                if($updatedataTable){
                    $error                          = false;
                    $code                           = 200;
                    if($langdata=='ar'){
                        $msg                        ='تم تغيير الرقم السري بنجاح';
                    }else{
                        $msg                    = 'Password changed successfully';
                    }
                    $data                           = new stdClass();
                }else{
                    $error                          = false;
                    $code                           = 202;
                    if($langdata=='ar'){
                        $msg                        = 'تم العثور على بعض الأخطاء';
                    }else{
                        $msg                    = 'Some Error Found';
                    }
                    $data                           = new stdClass();
                }
            }else{
                $error                          = false;
                $code                           = 201;
                
                if($langdata=='ar'){
                    $msg                        ='كلمة المرور القديمة غير صحيحة';
                }else{
                    $msg                            = 'old password incorrect.';
                }
                $data                           = new stdClass();
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