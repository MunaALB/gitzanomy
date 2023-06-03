<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    $model                      = new User_model();

    $getHeaderFunction          = $model->getHeaderFunction($_REQUEST,false);
    if(isset($getHeaderFunction['header']['lang'])){
        $langdata=$getHeaderFunction['header']['lang'];
    }else{
        $langdata='en';
    }
    if($getHeaderFunction['status']){

        $required = array ('user_id','product_id');
        // $required = array ('user_id','product_id','vendor_id','item_id','brand_id','model_id');
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            
            $check                  = $model->productDetail($_REQUEST,$langdata);
            if($check){
                $error                  = false;
                $code                   = 200;
                if($langdata=='ar'){
                    $msg                        = 'تفاصيل المنتج';
                }else{
                    $msg                        = 'Product Detail';
                }
                $data                   = $check;
            }else{
                $error                  = false;
                $code                   = 201;
                if($langdata=='ar'){
                    $msg                        = 'لاتوجد بيانات';
                }else{
                    $msg                    = 'No data found.';
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