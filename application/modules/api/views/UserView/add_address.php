<?php
    $model                      = new User_model();
    $getHeaderFunction          = $model->getHeaderFunction($_REQUEST,true);
    if(isset($getHeaderFunction['header']['lang'])){
        $langdata=$getHeaderFunction['header']['lang'];
    }else{
        $langdata='en';
    }
    if($getHeaderFunction['status']){
        $required                   = array ('user_id','country_code','mobile','name','geo_address','street_address','city_id','lat','lng');
        
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error              = true;
            $code               = 98;
            $msg                = $checkRequired['field'].' field is required.';
            $data               = new stdClass();
        }else{
            unset($_REQUEST['is_web']);
            $check                      = $model->addAddress($_REQUEST); 
            if($check){
                $error                  = false;
                $code                   = 200;
                
                if($langdata=='ar'){
                    $msg                        = 'تم حفظ العنوان بنجاح';
                }else{
                    $msg                    = "Address saved successfully.";
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
    
echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
