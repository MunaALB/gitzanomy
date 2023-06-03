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
        $required                   = array ('user_id');
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
            if($checkRequired['status']){
                $error              = true;
                $code               = 98;
                $msg                = $checkRequired['field'].' field is required.';
                $data               = new stdClass();
            }else{
                $check                      = $model->getProfile($_REQUEST);
                if($check){
                    $data                   = $model->myRequest($_POST,$langdata);
                    if($data){
                        $error              = false;
                        $code               = 200;
                        
                        if($langdata=='ar'){
                            $msg                        = 'طلبي';
                        }else{
                            $msg                = 'My Request.';
                        }
                        $data               = array('request'=>$data);
                    }else{
                        $error              = true;
                        $code               = 201;
                        
                        if($langdata=='ar'){
                            $msg                        = 'الطلب غير موجود';
                        }else{
                            $msg                = 'Request not found.';
                        }
                        $data               = new stdClass();
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
    
echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
