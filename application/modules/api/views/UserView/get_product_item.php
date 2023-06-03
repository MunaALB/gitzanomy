<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    $model                      = new User_model();

    $getHeaderFunction          = $model->getHeaderFunction($_REQUEST,false);
    if($getHeaderFunction['status']){

        $required = array ('user_id','product_id');
        // $required = array ('user_id','product_id','attribute_value_id');
        // $required = array ('user_id','product_id','vendor_id','item_id','brand_id','model_id');
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            $check                  = $model->getProductItem($_REQUEST);
            if($check){
                $error                  = false;
                $code                   = 200;
                $msg                    = 'Product Item Detail';
                $data                   = $check;
            }else{
                $error                  = false;
                $code                   = 201;
                $msg                    = 'No data found.';
                $data                   = new stdClass();
            }
        }
    }else{
        $error                  = true;
        $code                   = 301;
        $msg                    = 'Authentication failed.';
        $data                   = new stdClass();
    }
}

echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));