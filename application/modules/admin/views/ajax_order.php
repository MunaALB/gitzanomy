<?php

if ($_POST['method'] == 'assignForUpfrontAmount') {
    $driverId   = $_POST['driverId'];
    $orderId    = $_POST['orderId'];

    $createdTrackingId=strtotime(date('Y-m-d H:i:s')).rand(1000,9999);
    $createdTrackingDate=(date('Y-m-d H:i:s'));
    $inserData=array(
        'order_id'                      => $orderId,
        'driver_id'                     => $driverId,
        'upfront_tracking_id'           => $createdTrackingId,
        'upfront_status'                => "New Order Assigned",
        'upfront_tracking_created_at'   => $createdTrackingDate,
    );
    $inset = $this->Admin_model->insertData('order_upfront_tracking', $inserData);
    if ($inset) {
        $inserDriverData=array(
            'order_id'                      => $orderId,
            'driver_id'                     => $driverId,
            'driver_tracking_id'            => $createdTrackingId,
            'driver_order_type'             => 1,
            'driver_order_status'           => 1,
            'created_at'                    => $createdTrackingDate,
        );
        $inset = $this->Admin_model->insertData('driver_order', $inserDriverData);

        $orderUpdate=array('status'=>2,'driver_id'=>$driverId,'upfront_tracking_id'=>$createdTrackingId);
        $query = $this->Admin_model->updatedataTable('orders', ['order_id' => $orderId], $orderUpdate);
        $seenOrder = $this->Admin_model->updatedataTable('orders', ['order_id' => $orderId], array('is_seen'=>0));
        
        //////////////NOTIFICATION//////////////////////////
        //$order=$this->Admin_model->getDataResultRow('orders','order_id="'.$orderId.'"');
        //$userData=$this->Admin_model->getDataResultRow('users','driver_id="'.$driverId.'"');
        $user_auth=$this->Admin_model->getDataResultRow('driver_auth','driver_id="'.$driverId.'"');
        // print_r($pushData);exit;
        

        
            $pushData['title'] = "New Order Assigned";
            $pushData['body'] = "A new order id #".$orderId.". is assigned by the admin";
            $pushData['type'] = "assign_for_upfront_amount";
            
            $pushData['order_id'] = $orderId;
            $pushData['driver_order_id'] = $inset;
        
        $message = json_encode($pushData);
        if (isset($user_auth['device_type']) and $user_auth['device_type']) {
            if (isset($user_auth['device_type']) and $user_auth['device_type'] == 2) {
                $notify = $this->Admin_model->sendIosPush($user_auth['device_token'], $pushData);
            } else {
                $notify = $this->Admin_model->sendAndroidPush($user_auth['device_token'], $message);
            }
        }

        $insertArr=array(
            'order_id'  => $orderId,
            'driver_id'   => $driverId,
            'type'      => $pushData['type'],
            'title'     => $pushData['title'],
            'message'   => $pushData['body'],
            'driver_order_id'   => $pushData['driver_order_id'],
        );
        $inset=$this->Admin_model->insertData('driver_notifications',$insertArr);
        // exit;
        //////////////NOTIFICATION//////////////////////////
        
        $error = false;
        $code = 100;
        $msg = 'Category Unblock Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'assignForVendorPorduct') {
    $driverId   = $_POST['driverId'];
    $orderId    = $_POST['orderId'];
    $itemId     = $_POST['itemId'];
    // print_r($_POST);exit;
    $createdTrackingId=strtotime(date('Y-m-d H:i:s')).rand(1000,9999);
    $createdTrackingDate=(date('Y-m-d H:i:s'));
    $inserData=array(
        'order_id'                      => $orderId,
        'driver_id'                     => $driverId,
        'vendor_tracking_id'            => $createdTrackingId,
        'vendor_status'                 => 0,
        'vendor_tracking_created_at'    => $createdTrackingDate,
    );
    $inset = $this->Admin_model->insertData('order_vendor_tracking', $inserData);
    if ($inset) {
        $inserDriverData=array(
            'order_id'                      => $orderId,
            'driver_id'                     => $driverId,
            'driver_tracking_id'            => $createdTrackingId,
            'driver_order_type'             => 2,
            'driver_order_status'           => 1,
            'created_at'                    => $createdTrackingDate,
        );
        $inset = $this->Admin_model->insertData('driver_order', $inserDriverData);

        $orderUpdate=array('status'=>4,'is_seen'=>0);
        $query = $this->Admin_model->updatedataTable('orders', ['order_id' => $orderId], $orderUpdate);

        if($itemId){
            $itemId=explode(',',$itemId);
            if($itemId){
                foreach($itemId as $itm){
                    $orderItemUpdate=array('item_action'=>1,'driver_id'=>$driverId,'vendor_tracking_id'=>$createdTrackingId);
                    $query = $this->Admin_model->updatedataTable('order_items', ['order_item_id' => $itm], $orderItemUpdate);
                }
            }
        }
        //$seenOrder = $this->Admin_model->updatedataTable('orders', ['order_id' => $orderId], array('is_seen'=>0));
        
        //////////////NOTIFICATION//////////////////////////
        //$order=$this->Admin_model->getDataResultRow('orders','order_id="'.$orderId.'"');
        //$userData=$this->Admin_model->getDataResultRow('users','driver_id="'.$driverId.'"');
        $user_auth=$this->Admin_model->getDataResultRow('driver_auth','driver_id="'.$driverId.'"');
        // print_r($pushData);exit;
        

        
            $pushData['title'] = "New Order Assigned";
            $pushData['body'] = "A new order id #".$orderId.". is assigned by the admin";
            $pushData['type'] = "assign_for_vendor_porduct";
            
            $pushData['order_id'] = $orderId;
            $pushData['driver_order_id'] = $inset;
        
        $message = json_encode($pushData);
        if (isset($user_auth['device_type']) and $user_auth['device_type']) {
            if (isset($user_auth['device_type']) and $user_auth['device_type'] == 2) {
                $notify = $this->Admin_model->sendIosPush($user_auth['device_token'], $pushData);
            } else {
                $notify = $this->Admin_model->sendAndroidPush($user_auth['device_token'], $message);
            }
        }

        $insertArr=array(
            'order_id'  => $orderId,
            'driver_id'   => $driverId,
            'type'      => $pushData['type'],
            'title'     => $pushData['title'],
            'message'   => $pushData['body'],
            'driver_order_id'   => $pushData['driver_order_id'],
        );
        $inset=$this->Admin_model->insertData('driver_notifications',$insertArr);
        // exit;
        //////////////NOTIFICATION//////////////////////////

        $error = false;
        $code = 100;
        $msg = 'Category Unblock Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'assignForInternationalPorduct') {
    $driverId   = $_POST['driverId'];
    $orderId    = $_POST['orderId'];
    $itemId     = $_POST['itemId'];
    $note       = $_POST['note'];

    $createdTrackingId=strtotime(date('Y-m-d H:i:s')).rand(1000,9999);
    $createdTrackingDate=(date('Y-m-d H:i:s'));
    $inserData=array(
        'order_id'                              => $orderId,
        'driver_id'                             => $driverId,
        'international_tracking_id'             => $createdTrackingId,
        'international_status'                  => 0,
        'international_tracking_created_at'     => $createdTrackingDate,
    );
    $inset = $this->Admin_model->insertData('order_international_tracking', $inserData);
    if ($inset) {
        $inserDriverData=array(
            'order_id'                      => $orderId,
            'driver_id'                     => $driverId,
            'driver_tracking_id'            => $createdTrackingId,
            'driver_order_type'             => 4,
            'driver_order_status'           => 1,
            'international_note'            => $note,
            'created_at'                    => $createdTrackingDate,
        );
        $inset = $this->Admin_model->insertData('driver_order', $inserDriverData);

        $orderUpdate=array('status'=>4);
        $query = $this->Admin_model->updatedataTable('orders', ['order_id' => $orderId], $orderUpdate);
        if($itemId){
            $itemId=explode(',',$itemId);
            if($itemId){
                foreach($itemId as $itm){
                    $orderItemUpdate=array('item_action'=>3,'international_driver_id'=>$driverId,'international_tracking_id'=>$createdTrackingId);
                    $query = $this->Admin_model->updatedataTable('order_items', ['order_item_id' => $itm], $orderItemUpdate);
                    //echo $this->db->last_query();exit;
                }
            }
        }
        $seenOrder = $this->Admin_model->updatedataTable('orders', ['order_id' => $orderId], array('is_seen'=>0));
        
        //////////////NOTIFICATION//////////////////////////
        //$order=$this->Admin_model->getDataResultRow('orders','order_id="'.$orderId.'"');
        //$userData=$this->Admin_model->getDataResultRow('users','driver_id="'.$driverId.'"');
        $user_auth=$this->Admin_model->getDataResultRow('driver_auth','driver_id="'.$driverId.'"');
        // print_r($pushData);exit;
        

        
            $pushData['title'] = "New Order Assigned";
            $pushData['body'] = "A new order id #".$orderId.". is assigned by the admin";
            $pushData['type'] = "assign_for_international_porduct";
            
            $pushData['order_id'] = $orderId;
            $pushData['driver_order_id'] = $inset;
        
        $message = json_encode($pushData);
        if (isset($user_auth['device_type']) and $user_auth['device_type']) {
            if (isset($user_auth['device_type']) and $user_auth['device_type'] == 2) {
                $notify = $this->Admin_model->sendIosPush($user_auth['device_token'], $pushData);
            } else {
                $notify = $this->Admin_model->sendAndroidPush($user_auth['device_token'], $message);
            }
        }

        $insertArr=array(
            'order_id'  => $orderId,
            'driver_id'   => $driverId,
            'type'      => $pushData['type'],
            'title'     => $pushData['title'],
            'message'   => $pushData['body'],
            'driver_order_id'   => $pushData['driver_order_id'],
        );
        $inset=$this->Admin_model->insertData('driver_notifications',$insertArr);
        // exit;
        //////////////NOTIFICATION//////////////////////////

        $error = false;
        $code = 100;
        $msg = 'Category Unblock Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'assignForUserPorduct') {
    $driverId   = $_POST['driverId'];
    $orderId    = $_POST['orderId'];
    $itemId     = $_POST['itemId'];

    $createdTrackingId=strtotime(date('Y-m-d H:i:s')).rand(1000,9999);
    $createdTrackingDate=(date('Y-m-d H:i:s'));
    $inserData=array(
        'order_id'                      => $orderId,
        'driver_id'                     => $driverId,
        'drop_tracking_id'              => $createdTrackingId,
        'drop_status'                   => 0,
        'drop_tracking_created_at'      => $createdTrackingDate,
    );
    $inset = $this->Admin_model->insertData('order_drop_tracking', $inserData);
    if ($inset) {
        $inserDriverData=array(
            'order_id'                      => $orderId,
            'driver_id'                     => $driverId,
            'driver_tracking_id'            => $createdTrackingId,
            'driver_order_type'             => 3,
            'driver_order_status'           => 1,
            'created_at'                    => $createdTrackingDate,
        );
        $inset = $this->Admin_model->insertData('driver_order', $inserDriverData);

        $orderUpdate=array('status'=>4);
        $query = $this->Admin_model->updatedataTable('orders', ['order_id' => $orderId], $orderUpdate);

        if($itemId){
            $itemId=explode(',',$itemId);
            if($itemId){
                foreach($itemId as $itm){
                    $orderItemUpdate=array('item_action'=>2,'drop_driver_id'=>$driverId,'drop_tracking_id'=>$createdTrackingId);
                    $query = $this->Admin_model->updatedataTable('order_items', ['order_item_id' => $itm], $orderItemUpdate);
                }
            }
        }
        $seenOrder = $this->Admin_model->updatedataTable('orders', ['order_id' => $orderId], array('is_seen'=>0));
        
        //////////////NOTIFICATION//////////////////////////
        //$order=$this->Admin_model->getDataResultRow('orders','order_id="'.$orderId.'"');
        //$userData=$this->Admin_model->getDataResultRow('users','driver_id="'.$driverId.'"');
        $user_auth=$this->Admin_model->getDataResultRow('driver_auth','driver_id="'.$driverId.'"');
        // print_r($pushData);exit;
        

        
            $pushData['title'] = "New Order Assigned";
            $pushData['body'] = "A new order id #".$orderId.". is assigned by the admin";
            $pushData['type'] = "assign_for_user_orduct";
            
            $pushData['order_id'] = $orderId;
            $pushData['driver_order_id'] = $inset;
        
        $message = json_encode($pushData);
        if (isset($user_auth['device_type']) and $user_auth['device_type']) {
            if (isset($user_auth['device_type']) and $user_auth['device_type'] == 2) {
                $notify = $this->Admin_model->sendIosPush($user_auth['device_token'], $pushData);
            } else {
                $notify = $this->Admin_model->sendAndroidPush($user_auth['device_token'], $message);
            }
        }

        $insertArr=array(
            'order_id'  => $orderId,
            'driver_id'   => $driverId,
            'type'      => $pushData['type'],
            'title'     => $pushData['title'],
            'message'   => $pushData['body'],
            'driver_order_id'   => $pushData['driver_order_id'],
        );
        $inset=$this->Admin_model->insertData('driver_notifications',$insertArr);
        // exit;
        //////////////NOTIFICATION//////////////////////////

        $error = false;
        $code = 100;
        $msg = 'Category Unblock Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'verifyUpfrontAmount') {
    $orderId    = $_POST['orderId'];
    $getOrder=$this->Admin_model->getDataResultRow('orders','order_id="'.$orderId.'"');
    if($getOrder){
        // $orderUpdate=array('is_upfront_paid'=>1,'status'=>3,'is_seen'=>0);
        $orderUpdate=array('is_upfront_paid'=>1,'status'=>4,'is_seen'=>0);
        $query = $this->Admin_model->updatedataTable('orders', ['order_id' => $orderId], $orderUpdate);
        //////////////////TRANSACTION/////////////////////////
        $transaction=array(
            'order_id'  => $orderId,
            'user_id'   => $getOrder['user_id'],
            'amount'    => $getOrder['upfront_amount'],
            'type'      => 1,
        );
        $inset=$this->Admin_model->insertData('user_transaction',$transaction);
        //////////////////TRANSACTION/////////////////////////
        $orderTrackerUpdate=array('driver_order_status'=>4);
        $query = $this->Admin_model->updatedataTable('driver_order', ['order_id' => $orderId,'driver_tracking_id'=>$getOrder['upfront_tracking_id']], $orderTrackerUpdate);
        
        $error = true;
        $code = 100;
        $msg = 'Successfully Verified.';
        $data = array();
    }else{
        $error = true;
        $code = 101;
        $msg = 'Order Not Found';
        $data = array();
    }
    
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}


///////////////////////////////////////////CHANGE ORDER STATUS FOR USER BY ADMIN//////////
if ($_POST['method'] == 'changeOrderItemUserStatus') {
    $orderItemId    = $_POST['orderItemId'];
    $status         = $_POST['status'];

    $orderUpdate=array('user_status'=>$status);
    $query = $this->Admin_model->updatedataTable('order_items', ['order_item_id' => $orderItemId], $orderUpdate);
    if($query){
        $error = true;
        $code = 100;
        $msg = 'Successfully Verified.';
        $data = array();
    }else{
        $error = true;
        $code = 101;
        $msg = 'Order Not Found';
        $data = array();
    }
    
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'changeOrderUserStatus') {
    $orderId        = $_POST['orderId'];
    $status         = $_POST['status'];

    $orderUpdate=array('user_status'=>$status);
    $query = $this->Admin_model->updatedataTable('orders', ['order_id' => $orderId], $orderUpdate);
    if($query){
        //////////////NOTIFICATION//////////////////////////
        $order=$this->Admin_model->getDataResultRow('orders','order_id="'.$orderId.'"');
        $userData=$this->Admin_model->getDataResultRow('users','user_id="'.$order['user_id'].'"');
        $user_auth=$this->Admin_model->getDataResultRow('user_auth','user_id="'.$order['user_id'].'"');
        // print_r($pushData);exit;
        

        if($_POST['status']==1){
            $pushData['title'] = "New Order";
            $pushData['body'] = "Your order id #".$orderId.". is Mark as New by the admin";
            $pushData['type'] = "new_order";
            if(isset($userData['email']) and $userData['email']){
                $this->Admin_model->order_detail_email($userData['email'],$orderId,$pushData,$userData);
            }
        }elseif($_POST['status']==2){
            $pushData['title'] = "In-Process Order";
            $pushData['body'] = "Your order id #".$orderId.". In-Process by the admin";
            $pushData['type'] = "inprocess_order";
            if(isset($userData['email']) and $userData['email']){
                $this->Admin_model->order_detail_email($userData['email'],$orderId,$pushData,$userData);
            }
        }else{
            //////////////////TRANSACTION/////////////////////////
            $transaction=array(
                'order_id'  => $orderId,
                'user_id'   => $order['user_id'],
                'amount'    => $order['remain_amount'],
                'type'      => 0,
            );
            $inset=$this->Admin_model->insertData('user_transaction',$transaction);
            //////////////////TRANSACTION/////////////////////////

            $pushData['title'] = "Completed Order";
            $pushData['body'] = "Your order id #".$orderId.". Completed by the admin";
            $pushData['type'] = "complete_order";
            if(isset($userData['email']) and $userData['email']){
                $this->Admin_model->order_detail_email($userData['email'],$orderId,$pushData,$userData);
            }
        }
        
        $pushData['order_id'] = $orderId;
        
        $message = json_encode($pushData);
        if (isset($user_auth['device_type']) and $user_auth['device_type']) {
            if (isset($user_auth['device_type']) and $user_auth['device_type'] == 2) {
                $notify = $this->Admin_model->sendIosPush($user_auth['device_token'], $pushData);
            } else {
                $notify = $this->Admin_model->sendAndroidPush($user_auth['device_token'], $message);
            }
        }

        $insertArr=array(
            'order_id'  => $orderId,
            'user_id'   => $order['user_id'],
            'type'      => $pushData['type'],
            'title'     => $pushData['title'],
            'message'   => $pushData['body'],
        );
        $inset=$this->Admin_model->insertData('user_notifications',$insertArr);
        //////////////NOTIFICATION//////////////////////////
        $error = true;
        $code = 100;
        $msg = 'Successfully Verified.';
        $data = array();
    }else{
        $error = true;
        $code = 101;
        $msg = 'Order Not Found';
        $data = array();
    }
    
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'markAsComplete') {
    $orderId        = $_POST['orderId'];
    
    $orderUpdate=array('status'=>5);
    $query = $this->Admin_model->updatedataTable('orders', ['order_id' => $orderId], $orderUpdate);
    if($query){
        $error = true;
        $code = 100;
        $msg = 'Successfully Verified.';
        $data = array();
    }else{
        $error = true;
        $code = 101;
        $msg = 'Order Not Found';
        $data = array();
    }
    
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'receivedOnHub') {
    $orderId            = $_POST['orderId'];
    $driverId           = $_POST['driverId'];
    $tracking_id        = $_POST['tracking_id'];
    $type               = $_POST['type'];
    if($type==1){
        $query = $this->db->query("update zy_order_items set is_in_hub = '1' where order_id= '" . $orderId . "' and international_driver_id='".$driverId."' and international_tracking_id='".$tracking_id."'");
        $query = $this->db->query("update zy_driver_order set driver_order_status = '4' where order_id= '" . $orderId . "' and driver_id='".$driverId."' and driver_tracking_id='".$tracking_id."'");
    }else{
        $query = $this->db->query("update zy_order_items set is_in_hub = '1' where order_id= '" . $orderId . "' and driver_id='".$driverId."' and vendor_tracking_id='".$tracking_id."'");
        $query = $this->db->query("update zy_driver_order set driver_order_status = '4' where order_id= '" . $orderId . "' and driver_id='".$driverId."' and driver_tracking_id='".$tracking_id."'");
    }
    // echo $this->db->last_query();exit;
    
    if($query){
        $error = true;
        $code = 100;
        $msg = 'Successfully Verified.';
        $data = array();
    }else{
        $error = true;
        $code = 101;
        $msg = 'Order Not Found';
        $data = array();
    }
    
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

///////////////////////////////////////////CHANGE ORDER STATUS FOR USER BY ADMIN//////////



if ($_POST['method'] == 'assignForReturnTracking') {
    $driverId   = $_POST['driverId'];
    $orderId    = $_POST['orderId'];
    $itemId     = $_POST['itemId'];

    $createdTrackingId=strtotime(date('Y-m-d H:i:s')).rand(1000,9999);
    $createdTrackingDate=(date('Y-m-d H:i:s'));
    $inserData=array(
        'order_id'                      => $orderId,
        'driver_id'                     => $driverId,
        'return_tracking_id'            => $createdTrackingId,
        'return_status'                 => 0,
        'return_tracking_created_at'    => $createdTrackingDate,
    );
    $inset = $this->Admin_model->insertData('order_return_tracking', $inserData);
    if ($inset) {
        $inserDriverData=array(
            'order_id'                      => $orderId,
            'driver_id'                     => $driverId,
            'driver_tracking_id'            => $createdTrackingId,
            'driver_order_type'             => 5,
            'driver_order_status'           => 1,
            'created_at'                    => $createdTrackingDate,
        );
        $inset = $this->Admin_model->insertData('driver_order', $inserDriverData);

        $orderUpdate=array('status'=>4,'is_seen'=>0);
        $query = $this->Admin_model->updatedataTable('orders', ['order_id' => $orderId], $orderUpdate);
        // echo $itemId;exit;
        if($itemId){
            $itemId=explode(',',$itemId);
            if($itemId){
                foreach($itemId as $itm){
                    $orderItemUpdate=array('item_action'=>5,'return_driver_id'=>$driverId,'return_tracking_id'=>$createdTrackingId);
                    // print_r($orderItemUpdate);exit;
                    $query = $this->Admin_model->updatedataTable('order_items', ['order_item_id' => $itm], $orderItemUpdate);
                }
            }
        }
        //$seenOrder = $this->Admin_model->updatedataTable('orders', ['order_id' => $orderId], array('is_seen'=>0));
        
        //////////////NOTIFICATION//////////////////////////
        //$order=$this->Admin_model->getDataResultRow('orders','order_id="'.$orderId.'"');
        //$userData=$this->Admin_model->getDataResultRow('users','driver_id="'.$driverId.'"');
        $user_auth=$this->Admin_model->getDataResultRow('driver_auth','driver_id="'.$driverId.'"');
        // print_r($pushData);exit;
        

        
            $pushData['title'] = "New Order Assigned";
            $pushData['body'] = "A new order id #".$orderId.". is assigned by the admin";
            $pushData['type'] = "assign_for_vendor_porduct";
            
            $pushData['order_id'] = $orderId;
            $pushData['driver_order_id'] = $inset;
        
        $message = json_encode($pushData);
        if (isset($user_auth['device_type']) and $user_auth['device_type']) {
            if (isset($user_auth['device_type']) and $user_auth['device_type'] == 2) {
                $notify = $this->Admin_model->sendIosPush($user_auth['device_token'], $pushData);
            } else {
                $notify = $this->Admin_model->sendAndroidPush($user_auth['device_token'], $message);
            }
        }

        $insertArr=array(
            'order_id'  => $orderId,
            'driver_id'   => $driverId,
            'type'      => $pushData['type'],
            'title'     => $pushData['title'],
            'message'   => $pushData['body'],
            'driver_order_id'   => $pushData['driver_order_id'],
        );
        $inset=$this->Admin_model->insertData('driver_notifications',$insertArr);
        // exit;
        //////////////NOTIFICATION//////////////////////////

        $error = false;
        $code = 100;
        $msg = 'Category Unblock Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'receivedOnHubReturnItem') {
    $orderId            = $_POST['orderId'];
    $driverId           = $_POST['driverId'];
    $tracking_id        = $_POST['tracking_id'];
    $type               = $_POST['type'];
    if($type==1){
        $query = $this->db->query("update zy_order_items set is_return_in_hub = '1' where order_id= '" . $orderId . "' and return_driver_id='".$driverId."' and return_tracking_id='".$tracking_id."'");
        $query = $this->db->query("update zy_driver_order set driver_order_status = '4' where order_id= '" . $orderId . "' and driver_id='".$driverId."' and driver_tracking_id='".$tracking_id."'");
    }else{
        $query = $this->db->query("update zy_order_items set is_return_drop = '1' where order_id= '" . $orderId . "' and return_drop_driver_id='".$driverId."' and return_drop_tracking_id='".$tracking_id."'");
        $query = $this->db->query("update zy_driver_order set driver_order_status = '4' where order_id= '" . $orderId . "' and driver_id='".$driverId."' and driver_tracking_id='".$tracking_id."'");
    }
    // echo $this->db->last_query();exit;
    
    if($query){
        $error = true;
        $code = 100;
        $msg = 'Successfully Verified.';
        $data = array();
    }else{
        $error = true;
        $code = 101;
        $msg = 'Order Not Found';
        $data = array();
    }
    
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}


if ($_POST['method'] == 'assignForDropReturnTracking') {
    $driverId   = $_POST['driverId'];
    $orderId    = $_POST['orderId'];
    $itemId     = $_POST['itemId'];

    $createdTrackingId=strtotime(date('Y-m-d H:i:s')).rand(1000,9999);
    $createdTrackingDate=(date('Y-m-d H:i:s'));
    $inserData=array(
        'order_id'                      => $orderId,
        'driver_id'                     => $driverId,
        'return_drop_tracking_id'    => $createdTrackingId,
        'return_drop_status'            => 0,
        'return_drop_tracking_created_at'=> $createdTrackingDate,
    );
    $inset = $this->Admin_model->insertData('order_return_drop_tracking', $inserData);
    if ($inset) {
        $inserDriverData=array(
            'order_id'                      => $orderId,
            'driver_id'                     => $driverId,
            'driver_tracking_id'            => $createdTrackingId,
            'driver_order_type'             => 6,
            'driver_order_status'           => 1,
            'created_at'                    => $createdTrackingDate,
        );
        $inset = $this->Admin_model->insertData('driver_order', $inserDriverData);

        $orderUpdate=array('status'=>4,'is_seen'=>0);
        $query = $this->Admin_model->updatedataTable('orders', ['order_id' => $orderId], $orderUpdate);
        // echo $itemId;exit;
        if($itemId){
            $itemId=explode(',',$itemId);
            if($itemId){
                foreach($itemId as $itm){
                    $orderItemUpdate=array('item_action'=>6,'return_drop_driver_id'=>$driverId,'return_drop_tracking_id'=>$createdTrackingId);
                    // print_r($orderItemUpdate);exit;
                    $query = $this->Admin_model->updatedataTable('order_items', ['order_item_id' => $itm], $orderItemUpdate);
                }
            }
        }
        //$seenOrder = $this->Admin_model->updatedataTable('orders', ['order_id' => $orderId], array('is_seen'=>0));
        
        //////////////NOTIFICATION//////////////////////////
        //$order=$this->Admin_model->getDataResultRow('orders','order_id="'.$orderId.'"');
        //$userData=$this->Admin_model->getDataResultRow('users','driver_id="'.$driverId.'"');
        $user_auth=$this->Admin_model->getDataResultRow('driver_auth','driver_id="'.$driverId.'"');
        // print_r($pushData);exit;
        

        
            $pushData['title'] = "New Order Assigned";
            $pushData['body'] = "A new order id #".$orderId.". is assigned by the admin";
            $pushData['type'] = "assign_for_vendor_porduct";
            
            $pushData['order_id'] = $orderId;
            $pushData['driver_order_id'] = $inset;
        
        $message = json_encode($pushData);
        if (isset($user_auth['device_type']) and $user_auth['device_type']) {
            if (isset($user_auth['device_type']) and $user_auth['device_type'] == 2) {
                $notify = $this->Admin_model->sendIosPush($user_auth['device_token'], $pushData);
            } else {
                $notify = $this->Admin_model->sendAndroidPush($user_auth['device_token'], $message);
            }
        }

        $insertArr=array(
            'order_id'  => $orderId,
            'driver_id'   => $driverId,
            'type'      => $pushData['type'],
            'title'     => $pushData['title'],
            'message'   => $pushData['body'],
            'driver_order_id'   => $pushData['driver_order_id'],
        );
        $inset=$this->Admin_model->insertData('driver_notifications',$insertArr);
        // exit;
        //////////////NOTIFICATION//////////////////////////

        $error = false;
        $code = 100;
        $msg = 'Category Unblock Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}


if ($_POST['method'] == 'sendNotification') {
    // echo "sss";exit;
    $id=ltrim($_POST['id']);
    $id=rtrim($id);
    //echo $id;exit;
        $pushData['title'] = $_POST['title'];
        $pushData['body'] = $_POST['note'];
        $pushData['type'] = "user_notification";
        
        $pushData['order_id'] = '';
        $pushData['driver_order_id'] = '';
        $message = json_encode($pushData);
        if($id){
            $expId=explode(',',$id);
            if($expId){
                foreach($expId as $uid){
                    $user_auth=$this->Admin_model->getDataResultRow('driver_auth','driver_id="'.$uid.'"');
                    if (isset($user_auth['device_type']) and $user_auth['device_type']) {
                        if (isset($user_auth['device_type']) and $user_auth['device_type'] == 2) {
                            $notify = $this->Admin_model->sendIosPush($user_auth['device_token'], $pushData);
                        } else {
                            $notify = $this->Admin_model->sendAndroidPush($user_auth['device_token'], $message);
                        }
                    }
                }
            }
        }
        //echo $notify;exit;
        
        
        $error = false;
        $code = 100;
        $msg = 'Notification sent.';
        $data = array();
        echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}


if ($_POST['method'] == 'sendNotificationToAll') {
    
        $user_list = $this->Admin_model->getDataResultArray('users', 'status=1', 'user_id');
    
        $pushData['title'] = $_POST['title'];
        $pushData['body'] = $_POST['note'];
        $pushData['type'] = "user_notification";
        
        $pushData['order_id'] = '';
        $pushData['driver_order_id'] = '';
        $message = json_encode($pushData);
        if($user_list){
            foreach($user_list as $user){
                $uid=$user['user_id'];
                
                $user_auth=$this->Admin_model->getDataResultRow('driver_auth','driver_id="'.$uid.'"');
                if (isset($user_auth['device_type']) and $user_auth['device_type']) {
                    if (isset($user_auth['device_type']) and $user_auth['device_type'] == 2) {
                        $notify = $this->Admin_model->sendIosPush($user_auth['device_token'], $pushData);
                    } else {
                        $notify = $this->Admin_model->sendAndroidPush($user_auth['device_token'], $message);
                    }
                }
            }
        }
        //echo $notify;exit;
        
        
        $error = false;
        $code = 100;
        $msg = 'Notification sent.';
        $data = array();
        echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}




if ($_POST['method'] == 'changeDriver') {
    $driverId       = $_POST['driverId'];
    $orderId        = $_POST['orderId'];
    $trackingId     = $_POST['trackingId'];
    $oldDriverId    = $_POST['oldDriverId'];
    $driver_order=$this->Admin_model->getDataResultRow('driver_order','driver_id="'.$oldDriverId.'" and order_id="'.$orderId.'" and driver_tracking_id="'.$trackingId.'"');
    if($driver_order){
        if($driver_order['driver_order_type']==1){
            $orderItemUpdate=array('driver_id'=>$driverId);
            $query = $this->Admin_model->updatedataTable('orders', ['driver_id' => $oldDriverId,'upfront_tracking_id'=>$trackingId,'order_id'=>$orderId], $orderItemUpdate);
            $query = $this->Admin_model->updatedataTable('order_upfront_tracking', ['driver_id' => $oldDriverId,'upfront_tracking_id'=>$trackingId,'order_id'=>$orderId], $orderItemUpdate);
        }elseif($driver_order['driver_order_type']==2){
            $orderItemUpdate=array('driver_id'=>$driverId);
            $query = $this->Admin_model->updatedataTable('order_items', ['driver_id' => $oldDriverId,'vendor_tracking_id'=>$trackingId,'order_id'=>$orderId], $orderItemUpdate);
            $orderItemUpdate=array('driver_id'=>$driverId);
            $query = $this->Admin_model->updatedataTable('order_vendor_tracking', ['driver_id' => $oldDriverId,'vendor_tracking_id'=>$trackingId,'order_id'=>$orderId], $orderItemUpdate);
        }elseif($driver_order['driver_order_type']==3){
            $orderItemUpdate=array('drop_driver_id'=>$driverId);
            $query = $this->Admin_model->updatedataTable('order_items', ['drop_driver_id' => $oldDriverId,'drop_tracking_id'=>$trackingId,'order_id'=>$orderId], $orderItemUpdate);
            $orderItemUpdate=array('driver_id'=>$driverId);
            $query = $this->Admin_model->updatedataTable('order_drop_tracking', ['driver_id' => $oldDriverId,'drop_tracking_id'=>$trackingId,'order_id'=>$orderId], $orderItemUpdate);
        }elseif($driver_order['driver_order_type']==4){
            $orderItemUpdate=array('international_driver_id'=>$driverId);
            $query = $this->Admin_model->updatedataTable('order_items', ['international_driver_id' => $oldDriverId,'international_tracking_id'=>$trackingId,'order_id'=>$orderId], $orderItemUpdate);
            $orderItemUpdate=array('driver_id'=>$driverId);
            $query = $this->Admin_model->updatedataTable('order_international_tracking', ['driver_id' => $oldDriverId,'international_tracking_id'=>$trackingId,'order_id'=>$orderId], $orderItemUpdate);
        }elseif($driver_order['driver_order_type']==5){
            $orderItemUpdate=array('return_driver_id'=>$driverId);
            $query = $this->Admin_model->updatedataTable('order_items', ['return_driver_id' => $oldDriverId,'return_tracking_id'=>$trackingId,'order_id'=>$orderId], $orderItemUpdate);
            $orderItemUpdate=array('driver_id'=>$driverId);
            $query = $this->Admin_model->updatedataTable('order_return_tracking', ['driver_id' => $oldDriverId,'return_tracking_id'=>$trackingId,'order_id'=>$orderId], $orderItemUpdate);
        }elseif($driver_order['driver_order_type']==6){
            $orderItemUpdate=array('return_drop_driver_id'=>$driverId);
            $query = $this->Admin_model->updatedataTable('order_items', ['return_drop_driver_id' => $oldDriverId,'return_drop_tracking_id'=>$trackingId,'order_id'=>$orderId], $orderItemUpdate);
            $orderItemUpdate=array('driver_id'=>$driverId);
            $query = $this->Admin_model->updatedataTable('order_return_drop_tracking', ['driver_id' => $oldDriverId,'return_drop_tracking_id'=>$trackingId,'order_id'=>$orderId], $orderItemUpdate);
        }
        if($query){
            $orderItemUpdate=array('driver_id'=>$driverId);
            $query = $this->Admin_model->updatedataTable('driver_order', ['driver_id' => $oldDriverId,'driver_tracking_id'=>$trackingId,'order_id'=>$orderId], $orderItemUpdate);
            
            $error = false;
            $code = 100;
            $msg = 'Driver changed Successfully';
            $data = array();
        }else{
            $error = true;
            $code = 102;
            $msg = 'Error';
            $data = array();  
        }
    }else{
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();  
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));


    
}


        
