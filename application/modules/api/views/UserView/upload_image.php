<?php

    $model                      = new User_model();
    $getHeaderFunction          = $model->getHeaderFunction($_REQUEST,false);
    $lang                       = $getHeaderFunction['header']['lang'];
    
    if(isset($getHeaderFunction['header']['lang'])){
        $langdata=$getHeaderFunction['header']['lang'];
    }else{
        $langdata='en';
    }
    
    if(isset($_FILES['image'])){
        $data = $model->upload_image("image",false);
        if ($data) {
                $error          = false;
                $code           = 200;
                
                if($langdata=='ar'){
                        $msg                        = 'تحميل صورة';
                }else{
                        $msg            = 'Image uploded';
                }
                $data           = $data;
        } else {
                $error          = true;
                $code           = 201;
                if($langdata=='ar'){
                        $msg                        = 'تم العثور على بعض الأخطاء';
                }else{
                        $msg                    = 'Some Error Found';
                }
                $data           = new stdClass();
        }
    }else{
            $error              = true;
            $code               = 202;
            
            if($langdata=='ar'){
                $msg                        = 'الرجاء تحديد ملف';
        }else{
                $msg                = 'please select a file.';
        }
            $data               = new stdClass();
    }
echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
