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
    $getHeaderFunction['status']=true;
    if($getHeaderFunction['status']){

        $required = array ('user_id');
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            // $userCheck                      = $model->getProfile($_REQUEST);
            // if($userCheck){
                // unset($_REQUEST['is_web']);
                $check                      = $model->getMyCart($_REQUEST,$langdata); 
                if($check['status']){
                    $error                  = false;
                    $code                   = 200;
                    if($langdata=='ar'){
                        $msg                        = 'سلة التسوق';
                    }else{
                        $msg                        = 'My Cart';
                    }
                    $data                   = $check;
                }else{
                    $error                  = true;
                    $code                   = 201;
                    if($langdata=='ar'){
                        $msg                        = 'السلة فارغة';
                    }else{
                        $msg                    = "Cart empty.";
                    }
                    
                    $data                   = new stdClass();
                }
            // }else{
            //     $error                  = true;
            //     $code                   = 97;
            //     $msg                    = 'User not exist.';
            //     $data                   = new stdClass();
            // }
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