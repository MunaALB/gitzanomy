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

        $required = array ('user_id','address_id','payment_type');
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            $userCheck              = $model->getSingleDataRow('users','user_id="'.$_REQUEST['user_id'].'"');
            if($userCheck){
                $placeOrder             = $model->placeOrder($_REQUEST); 
                if($placeOrder['status']){
                    $error                  = false;
                    $code                   = 200;
                    
                    if($langdata=='ar'){
                        $msg                    = "Order Place successfully.";
                    }else{
                        $msg                    = "Order Place successfully.";
                    }
                    $data                   = array('order_id'=>$placeOrder['order_id']);
                }else{
                    if($placeOrder['code']==101){
                        $error                  = true;
                        $code                   = 201;
                        
                        if($langdata=='ar'){
                            $msg                    = "Your Cart is empty.";
                        }else{
                            $msg                    = "Your Cart is empty.";
                        }
                        $data                   = new stdClass();
                    }else{
                        $error                  = true;
                        $code                   = 202;
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
                $code                   = 97;
                
                if($langdata=='ar'){
                    $msg                    = 'User not exist.';
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