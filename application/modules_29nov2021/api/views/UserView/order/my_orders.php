<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    $model                      = new User_model();

    $getHeaderFunction          = $model->getHeaderFunction($_REQUEST,true);
    //$getHeaderFunction['status']=true;
    if($getHeaderFunction['status']){

        $required = array ('user_id');
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            
            $myOrders                  = $model->myOrders($_REQUEST);
            if($myOrders){
                $error                  = false;
                $code                   = 200;
                $msg                    = 'My Orders';
                $data                   = $myOrders;
            }else{
                $error                  = true;
                $code                   = 201;
                $msg                    = 'No Orders Avaliable.';
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