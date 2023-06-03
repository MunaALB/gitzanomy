<?php

    $model                      = new Driver_model();
    $getHeaderFunction          = $model->getHeaderFunction($_REQUEST,false);
    $lang                       = $getHeaderFunction['header']['lang'];
    
    $data           = $model->adminSetting();
    $error          = false;
    $code           = 200;
    $msg            = 'Admin setting';
    $data           = $data;
    
echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
