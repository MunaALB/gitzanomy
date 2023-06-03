<?php
if(!$_REQUEST) {
    $error      = true;
    $code       = 99;
    $msg        = 'Please Send Data in Key and Value Pair';
    $data       = new stdClass();
}else{
    $model                      = new User_model();

    $getHeaderFunction          = $model->getHeaderFunction($_REQUEST,true);
    //$getHeaderFunction['status']=true;
    if($getHeaderFunction['status']){

        // $required = array ('user_id','order_id','total_amount','payment_status','txn_id','reference_id');
        $required = array ('user_id','order_id','total_amount','payment_status','txn_id','type');
        $checkRequired=$model->check_requiredField($_REQUEST,$required);
        if($checkRequired['status']){
            $error      = true;
            $code       = 98;
            $msg        = $checkRequired['field'].' field is required.';
            $data       = new stdClass();
        }else{
            
            
            

            if($_REQUEST['type']==1){
                $productData        = $model->getSingleDataRow('orders','order_id="'.$_REQUEST['order_id'].'"');
            }else{
                $productData        = $model->getSingleDataRow('service_booking','booking_id="'.$_REQUEST['order_id'].'"');
            }
                if($productData){
                    $check              = $model->orderPayment($_REQUEST); 
                    
                    if(isset($isWeb)){
                         if($check['status']){
                            $error                  = false;
                            $code                   = 200;
                            $msg                    = "Your order payment done successfully";
                            $data                   = new stdClass();
                            //echo '<script>alert("Payment Successful. Redirecting to your orders.");</script>';
                        }else{
                            $error                  = true;
                            $code                   = 201;
                            $msg                    = "Payment Declined";
                            $data                   = new stdClass();
                            //echo '<script>alert("Payment Declined");</script>';
                        }
                         //echo '<script>window.location.href="'.base_url('my-orders').'";</script>';
                         //exit;
                     }else{
                         if($check['status']){
                            $error                  = false;
                            $code                   = 200;
                            $msg                    = "Your order payment done successfully";
                            $data                   = new stdClass();
                        }else{
                            $error                  = true;
                            $code                   = 201;
                            $msg                    = "Payment Declined";
                            $data                   = new stdClass();
                        }
                     }
                }else{
                    $error                  = true;
                    $code                   = 207;
                    $msg                    = "Order not found.";
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







