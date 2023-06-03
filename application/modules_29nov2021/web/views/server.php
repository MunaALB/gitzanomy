<?php

    ///////////////////////////////////////PAYTABS//////////////////////////
    


    function goToPayTabs($data,$getUserData,$itemAmt,$itemQty,$itemName){
        //echo $itemAmt.'@'.$itemQty;exit;
        // $orderCharges=$data['delivery_charges']+$data['tax'];
        $orderCharges=$data['delivery_charges'];
        $amount=$data['total'];
        $discount=0;
        
//        $itemAmt="20 || 30 || 40";
//        $itemQty="1 || 2 || 3";
//        $itemName="pro1 || pro2 || pro3";
//        $orderCharges="50";
//        $amount="250";
//        $discount="20";
        
        $UserModel         = new User_model();
        //print_r($data);exit;
        $pt=array(
            "merchant_email" => "alashter.mohaned@gmail.com",
            "secret_key" => "Bl1Dl322Q2eUjb0GcS9F7u6KalL4IDIjZKXkN0mD2AymMz3YrcEzGKkR65VPJD9Io62b7pPaZowMXALpMpZt9jkgpg58UeQilTts",
            "site_url" => "http://zanomy.com",
             //"return_url" => "http://localhost/projects/api/organic/transaction-status",
             "return_url" => base_url()."success",
            "title" => $data['order_id'],
            "cc_first_name" => $getUserData['name'],
            "cc_last_name" => $getUserData['name'],
            "cc_phone_number" => $getUserData['user_id'],
             "phone_number" => $getUserData['mobile'],
            "email" =>  $getUserData['email'],
            "products_per_title" => $itemName,
            "unit_price" => $itemAmt,
            "quantity" => $itemQty,
            "other_charges" => $orderCharges,
            "amount" => $amount,
            "discount" => $discount,
             "currency" => "LYD",
             "reference_no" => $data['order_id'],
            "ip_customer" =>"1.1.1.0",
             "ip_merchant" =>"1.1.1.0",
            "billing_address" => "libya",
            "city" =>  "New Delhi",
            "state" =>  "New Delhi",
            "postal_code" =>  "201301",
            "country" => "BHR",
            "shipping_first_name" => $getUserData['name'],
            "shipping_last_name" => $getUserData['name'],
            "address_shipping" => 'libya',
             "state_shipping" => "New Delhi",
             "city_shipping" => "New Delhi",
             "postal_code_shipping" => "201301",
             "country_shipping" => "BHR",
            "msg_lang" => "English",
             "cms_with_version" => "PHP"
         ); 
//echo '<pre/>';print_r($pt);exit;
        $baseurl = 'https://www.paytabs.com/apiv2/create_pay_page';
        $returnDataApi = $UserModel->payTabs($baseurl, $pt);
        $returnArr = json_decode($returnDataApi,true);
        //print_r($returnArr);exit;
        return $returnArr;
    }


    function goToPayTabsBooking($data,$getUserData,$itemAmt,$itemQty,$itemName){
       
        
        $UserModel         = new User_model();
        //print_r($data);exit;
        $pt=array(
            "merchant_email" => "alashter.mohaned@gmail.com",
            "secret_key" => "Bl1Dl322Q2eUjb0GcS9F7u6KalL4IDIjZKXkN0mD2AymMz3YrcEzGKkR65VPJD9Io62b7pPaZowMXALpMpZt9jkgpg58UeQilTts",
            "site_url" => "http://zanomy.com",
             //"return_url" => "http://localhost/projects/api/organic/transaction-status",
             "return_url" => base_url('booking-transaction-updated'),
            "title" => $data['booking_id'],
            "cc_first_name" => $getUserData['name'],
            "cc_last_name" => $getUserData['name'],
            "cc_phone_number" => $getUserData['user_id'],
             "phone_number" => $getUserData['mobile'],
            "email" =>  $getUserData['email'],
            "products_per_title" => $itemName,
            "unit_price" => $itemAmt,
            "quantity" => $itemQty,
            "other_charges" => 0,
            "amount" => $data['amount'],
            "discount" => 0,
             "currency" => "LYD",
             "reference_no" => $data['booking_id'],
            "ip_customer" =>"1.1.1.0",
             "ip_merchant" =>"1.1.1.0",
            "billing_address" => "libya",
            "city" =>  "New Delhi",
            "state" =>  "New Delhi",
            "postal_code" =>  "201301",
            "country" => "BHR",
            "shipping_first_name" => $getUserData['name'],
            "shipping_last_name" => $getUserData['name'],
            "address_shipping" => 'libya',
             "state_shipping" => "New Delhi",
             "city_shipping" => "New Delhi",
             "postal_code_shipping" => "201301",
             "country_shipping" => "BHR",
            "msg_lang" => "English",
             "cms_with_version" => "PHP"
         ); 
//echo '<pre/>';print_r($pt);exit;
        $baseurl = 'https://www.paytabs.com/apiv2/create_pay_page';
        $returnDataApi = $UserModel->payTabs($baseurl, $pt);
        $returnArr = json_decode($returnDataApi,true);
        //print_r($returnArr);exit;
        return $returnArr;
    }


    if($_POST['method'] == 'payTabs'){
        //        $pt=array(
        //"merchant_email" => "h_alomran@yahoo.com",
        //"secret_key" => "TtFYHFEQ47TMAmOfhI6zJjfvyGgc2chVFWUnCzdGG7tgthwL0ClJVAfuhwGjIYfoU9LxIYdo6GFAYclYOGIKgYeyuVRdT7BOhnlZ"
        // ); 
        // 
        //        $baseurl = 'https://www.paytabs.com/apiv2/validate_secret_key';
        //            $returnDataApi = $this->UserModel->payTabs($baseurl, $pt);
        //            $returnArr = json_decode($returnDataApi,true);
    
    

        $UserModel         = new User_model();
        $user_logged_in = $this->session->userdata('zanomy_user_logged_in');
        $userId=$user_logged_in['user_id'];
        
        $getUserData = $UserModel->getSingleDataRow('users', 'user_id="'.$userId.'"');
        $retrunDta = $UserModel->getSingleDataRow('orders', 'order_id="'.$_POST['orderId'].'"');

        $order_items = $UserModel->getTableDataArray('order_items', 'order_id="'.$_POST['orderId'].'"');
            $itemAmt="";
            $itemQty="";
            $itemName="";
            foreach($order_items as $item){
                
                $packages = $UserModel->getSingleDataRow('products', 'product_id="'.$item['product_id'].'"');
                // $product_attribute_group = $UserModel->getSingleDataRow('product_attribute_group', 'item_id="'.$item['item_id'].'"');
                $itemName=$itemName.' || '.$packages['name'];

                $itemAmt=$itemAmt.' || '.$item['amount'];
                $itemQty=$itemQty.' || '.$item['quantity'];
            }
            $itemAmt=ltrim($itemAmt,' || ');
            $itemAmt=rtrim($itemAmt,' || ');
            $itemQty=ltrim($itemQty,' || ');
            $itemQty=rtrim($itemQty,' || ');
            $itemName=ltrim($itemName,' || ');
            $itemName=rtrim($itemName,' || ');
            //echo $itemName;exit;
            $goToPayTabsResponce=goToPayTabs($retrunDta,$getUserData,$itemAmt,$itemQty,$itemName);
            // print_r($goToPayTabsResponce);exit;    
            if($goToPayTabsResponce['response_code']==4012){
                    $error      = false;
                    $code       = '100';
                    $msg        = "Success";
                    $data       = $goToPayTabsResponce;
                }else{
                    $error      = false;
                    $code       = '101';
                    $msg        = "Payment Error";
                    $data       = array();
                }
        
        echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));
}


if($_POST['method'] == 'payTabsBoking'){
    
    $UserModel         = new User_model();
    $user_logged_in = $this->session->userdata('zanomy_user_logged_in');
    $userId=$user_logged_in['user_id'];
    
    $getUserData = $UserModel->getSingleDataRow('users', 'user_id="'.$userId.'"');
    $retrunDta = $UserModel->getSingleDataRow('service_booking', 'booking_id="'.$_POST['booking_id'].'"');

    $order_items = $UserModel->getSingleDataRow('service', 'service_id="'.$_POST['service_id'].'"');
        $itemAmt="";
        $itemQty="";
        $itemName="";
        
          $itemName=$itemName.' || '.$order_items['name'];

            $itemAmt=$itemAmt.' || '.$retrunDta['amount'];
            $itemQty=$itemQty.' || 1';
        
        $itemAmt=ltrim($itemAmt,' || ');
        $itemAmt=rtrim($itemAmt,' || ');
        $itemQty=ltrim($itemQty,' || ');
        $itemQty=rtrim($itemQty,' || ');
        $itemName=ltrim($itemName,' || ');
        $itemName=rtrim($itemName,' || ');
        //echo $itemName;exit;
        $goToPayTabsResponce=goToPayTabsBooking($retrunDta,$getUserData,$itemAmt,$itemQty,$itemName);
        // print_r($goToPayTabsResponce);exit;    
        if($goToPayTabsResponce['response_code']==4012){
                $error      = false;
                $code       = '100';
                $msg        = "Success";
                $data       = $goToPayTabsResponce;
            }else{
                $error      = false;
                $code       = '101';
                $msg        = "Payment Error";
                $data       = array();
            }
    
    echo json_encode(array('error'=>$error,'error_code'=>$code,'message'=>$msg,'data'=>$data));
}

?>