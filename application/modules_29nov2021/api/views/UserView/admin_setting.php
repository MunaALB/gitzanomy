<?php

    $model                      = new User_model();
    $getHeaderFunction          = $model->getHeaderFunction($_REQUEST,false);
    $lang                       = $getHeaderFunction['header']['lang'];
    if(isset($getHeaderFunction['header']['lang'])){
        $langdata=$getHeaderFunction['header']['lang'];
    }else{
        $langdata='en';
    }
    $data           = $model->adminSetting($langdata);
    $error          = false;
    $code           = 200;
    if($langdata=='ar'){
        $msg                    = 'إعداد المسؤول';
    }else{
        $msg                    = 'Admin setting';
    }
    
    $data           = $data;
    
echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
