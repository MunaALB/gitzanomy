<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    $model                      = new Driver_model();

    $getHeaderFunction          = $model->getHeaderFunction($_REQUEST,true);
    //print_r($getHeaderFunction);exit;
    if($getHeaderFunction['status']){
        //print_r($headers);exit;
        //$model->printRecord("register_req", $headers);
        //Check Authentication
        $required = array ('driver_id');
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            //if($_REQUEST['user_id']==00 or $systemUser){
            $check                      = $model->getProfile($_REQUEST);
            if($check){
                $error                  = false;
                $code                   = 200;
                $msg                    = 'Profile Getting Sucessfully';
                $data                   = $check;
            }else{
                $error                  = true;
                $code                   = 97;
                $msg                    = 'Driver not exist.';
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