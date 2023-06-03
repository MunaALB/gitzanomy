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

        $required = array ('product_id','user_id');
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
                $productData                = $model->getSingleDataRow('products','product_id="'.$_REQUEST['product_id'].'"');
                if($productData){
                    $check                  = $model->addToWishlist($_REQUEST); 
                    if($check['status']){
                        $error                  = false;
                        $code                   = $check['code'];
                        $msg                    = $check['message'];
                        $data                   = new stdClass();
                    }else{
                        $error                  = true;
                        $code                   = $check['code'];
                        $msg                    = $check['message'];
                        $data                   = new stdClass();
                    }
                }else{
                    $error                  = true;
                    $code                   = 207;
                    if($langdata=='ar'){
                        $msg                        = 'الصنف غير موجود';
                    }else{
                        $msg                    = "Product not found.";
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