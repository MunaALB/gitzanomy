<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    $model                      = new Driver_model();
    $getHeaderFunction          = $model->getHeaderFunction($_REQUEST,true);
    if($getHeaderFunction['status']){
        $required = array ( 'driver_id','old_password','password');

        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            $_REQUEST['old_password']           = md5($_REQUEST['old_password']);
            $_REQUEST['password']               = md5($_REQUEST['password']);
            $checkPassword                      = $model->getSingleDataRow('driver','driver_id="'.$_REQUEST['driver_id'].'" and password="'.$_REQUEST['old_password'].'"');
            if($checkPassword){
                $updatedataTable                = $model->updatedataTable('driver','driver_id="'.$_REQUEST['driver_id'].'"',array('password'=>$_REQUEST['password']));
                if($updatedataTable){
                    $error                          = false;
                    $code                           = 200;
                    $msg                            = 'Password changed successfully.';
                    $data                           = new stdClass();
                }else{
                    $error                          = false;
                    $code                           = 202;
                    $msg                            = 'Some error found.';
                    $data                           = new stdClass();
                }
            }else{
                $error                          = false;
                $code                           = 201;
                $msg                            = 'old password incorrect.';
                $data                           = new stdClass();
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