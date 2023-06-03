<?php

    $model                      = new Driver_model();
    $getHeaderFunction          = $model->getHeaderFunction($_REQUEST,false);
    $lang                       = $getHeaderFunction['header']['lang'];
    
    if(isset($_FILES['image'])){
        $data = $model->upload_image("image",false);
        if ($data) {
                $error          = false;
                $code           = 200;
                $msg            = 'Image uploded';
                $data           = $data;
        } else {
                $error          = true;
                $code           = 201;
                $msg            = 'Some Error Found';
                $data           = new stdClass();
        }
    }else{
            $error              = true;
            $code               = 202;
            $msg                = 'please select a file.';
            $data               = new stdClass();
    }
echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
