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
    //$getHeaderFunction['status']=true;
    if($getHeaderFunction['status']){

        $required = array ('email','subject_id','message');
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            
            $myOrders                  = $model->help_n_support($_REQUEST);
            if($myOrders){
                $error                  = false;
                $code                   = 200;
                
                if($langdata=='ar'){
                    $msg                    = 'Query Submitted';
                }else{
                    $msg                    = 'Query Submitted';
                }
                $data                   = new stdClass();
            }else{
                $error                  = true;
                $code                   = 201;
                if($langdata=='ar'){
                    $msg                        = 'تم العثور على بعض الأخطاء';
                }else{
                    $msg                = 'Some error found.';
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