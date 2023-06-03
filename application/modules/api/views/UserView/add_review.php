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

        $required = array ('user_id','order_id','product_id','rating','review');
        // $required = array ('user_id','product_id','vendor_id','item_id','brand_id','model_id');
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            

            $userCheck                      = $model->getProfile($_REQUEST);
            if($userCheck){
                $check                      = $model->addReview($_REQUEST);
                if($check){
                    $error                  = false;
                    $code                   = 200;
                    
                    if($langdata=='ar'){
                        $msg                        = 'تمت إضافة المراجعة';
                    }else{
                        $msg                    = 'Review added.';
                    }
                    $data                   = new stdClass();
                }else{
                    $error                  = false;
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