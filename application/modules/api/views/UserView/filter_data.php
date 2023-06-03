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

        $required = array ('category_id','sub_category_id','limit');
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            if(isset($_REQUEST['start']) and $_REQUEST['start']){
                $_REQUEST['start']=$_REQUEST['start'];
            }else{
                $_REQUEST['start']=0;
            }
            $check                  = $model->filterData($_REQUEST,$langdata); 
            if($check['product']){
                $error                  = false;
                $code                   = 200;
                if($langdata=='ar'){
                    $msg                        = 'قائمة المنتجات';
                }else{
                    $msg                    = 'Product List';
                }
                $data                   = $check;
            }else{
                $error                  = false;
                $code                   = 201;
                if($langdata=='ar'){
                    $msg                        = 'لاتوجد بيانات';
                }else{
                    $msg                    = 'No data found.';
                }
                $data                   = $check;
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