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
    $getHeaderFunction['status']=true;
    if($getHeaderFunction['status']){
        //print_r($headers);exit;
        //$model->printRecord("register_req", $headers);
        //Check Authentication
        $required = array ('driver_id','driver_order_id','order_id');
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
                //print_r($check);exit;
                
                $homepage               = $model->completeMyJob($_REQUEST);
                if($homepage){
                    $error                  = false;
                    $code                   = 200;
                    $msg                    = 'Job successfully completed.';
                    $data                   = new stdClass();
                }else{
                    $error                  = false;
                    $code                   = 201;
                    $msg                    = 'Some error found.';
                    $data                   = new stdClass();
                }
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