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
        $required = array ('driver_id');
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            $check                              = $model->getProfile($_REQUEST);
            if($check){
                $errorEmail=false;
                if(isset($_REQUEST['email']) and $_REQUEST['email']){
                    $checkEmail                       = $model->getSingleDataRow('driver','email="'.$_REQUEST['email'].'" and driver_id!="'.$_REQUEST['driver_id'].'"');
                    if($checkEmail){
                        $errorEmail=true;
                    }
                }
                if($errorEmail){
                    $error                  = true;
                    $code                   = 202;
                    $msg                    = 'Email is already exist.';
                    $data                   = new stdClass();
                }else{
                    unset($_REQUEST['is_web']);
                    $editProfile                    = $model->profile($_REQUEST);
                    if($editProfile){
                        $check                      = $model->getProfile($_REQUEST);
                        if($check){
                            $error                  = false;
                            $code                   = 200;
                            $msg                    = 'Profile Updated Sucessfully';
                            $data                   = $check;
                        }else{
                            $error                  = true;
                            $code                   = 201;
                            $msg                    = 'Some Error Found';
                            $data                   = new stdClass();
                        }
                    }else{
                        $error                  = true;
                        $code                   = 201;
                        $msg                    = 'Some Error Found';
                        $data                   = new stdClass();
                    }
                }
            }else{
                $error                  = true;
                $code                   = 97;
                $msg                    = 'User not exist.';
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