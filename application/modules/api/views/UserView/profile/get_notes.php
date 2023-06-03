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
    //print_r($getHeaderFunction);exit;
    $getHeaderFunction['status']=true;
    if($getHeaderFunction['status']){
        //print_r($headers);exit;
        //$model->printRecord("register_req", $headers);
        //Check Authentication
        $required = array ('user_id');
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            
            //if($_REQUEST['user_id']==00 or $systemUser){
            $check                      = $model->getNotes($_REQUEST);
            if($check){
                $error                  = false;
                $code                   = 200;
                if($langdata=='ar'){
                    $msg                        = 'My Notebook';
                }else{
                    $msg                    = 'My Notebook';
                }
                $data                   = array('notes'=>$check);
            }else{
                $error                  = true;
                $code                   = 97;
                if($langdata=='ar'){
                    $msg                        = 'My Notebook';
                }else{
                    $msg                    = 'My Notebook';
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