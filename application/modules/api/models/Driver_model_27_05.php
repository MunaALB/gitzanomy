<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Driver_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->load->helper('push_helper');
        date_default_timezone_set('Asia/Kolkata');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////CHECK USER AUTH////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    function check_requiredField($obj, $required) {
        $dataError['status'] = false;
        foreach ($required as $field) {
            if (empty($obj[$field])) {
                $dataError['status'] = true;
                $dataError['field'] = $field;
                break;
            }
        }
        return $dataError;
    }

    function is_valid_header($param) {
        $num = $this->db->select("auth_id")
                        ->where("device_id", $param['device_id'])
                        ->where("security_token", $param['security_token'])
                        ->get("driver_auth")->num_rows();
        if ($num > 0) {
            return true;
        } elsE {
            return false;
        }
    }
    function getHeaderFunction($data,$isChecked){
        $headers                    = getallheaders();
        $document                   = array();
        $document['device_id']      = isset($headers['Deviceid']) ? $headers['Deviceid'] : "";
        $document['security_token'] = isset($headers['Securitytoken']) ? $headers['Securitytoken'] : "";
        $document['lang']           = isset($headers['Lang']) ? $headers['Lang'] : "en";
        if($isChecked){
            if(isset($data['is_web']) and $data['is_web']){
                return array('status'=>true,'header'=>$document);
            }else{
                $exist                      = $this->is_valid_header($document);
                if($exist){
                    return array('status'=>true,'header'=>$document);
                }else{
                    return array('status'=>false,'header'=>$document);
                }
            }
        }else{
            if(isset($data['is_web']) and $data['is_web']){
                return array('status'=>true,'header'=>$document);
            }else{
                if(isset($data['driver_id']) and $data['driver_id']=='00'){
                    return array('status'=>true,'header'=>$document);
                }else{
                    $exist                      = $this->is_valid_header($document);
                    if($exist){
                        return array('status'=>true,'header'=>$document);
                    }else{
                        return array('status'=>false,'header'=>$document);
                    }
                }
            }
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////CHECK USER AUTH////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    
    ///////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////PUSH NOTIFICATION////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    function sendIosPush($deviceToken, $msg_data) {
        $deviceToken = $deviceToken; //  iPad 5s Gold prod
        ///$deviceToken = ''; //  iPad 5s Gold prod
        $passphrase = '12345';

        $msg = $msg_data;
        $message = $msg;
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'apns_cert/developement_ck.pem'); // Pem file to generated // openssl pkcs12 -in pushcert.p12 -out pushcert.pem -nodes -clcerts // .p12 private key generated from Apple Developer Account
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        //$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx); // production
        $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx); // developement
        //echo "<p>Connection Open</p>";
        if (!$fp) {
            //echo "<p>Failed to connect!<br />Error Number: " . $err . " <br />Code: " . $errstrn . "</p>";
            return;
        } else {
            //echo "<p>Sending notification!</p>";
        }
        $body['aps'] = array('alert' => array('title' => $msg_data['title'], 'body' => $msg_data['body']), 'sound' => 'default', 'extra1' => '10', 'extra2' => 'value');
        $body['data'] = array('type' => $message['type'], 'data' => $message);
        $payload = json_encode($body);
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        //var_dump($msg)
        $result = fwrite($fp, $msg, strlen($msg));
        if (!$result)
        // echo '<p>Message not delivered ' . PHP_EOL . '!</p>';
            $res = false;
        else
        // echo '<p>Message successfully delivered ' . PHP_EOL . '!</p>';
            $res = true;
        fclose($fp);
        return $res;
    }

    // Push for Pharmacies Device
    function sendAndroidPush($deviceToken, $msg) {
        $registrationIDs = $deviceToken;
        $message = $msg;
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'to' => $registrationIDs,
            'data' => array("msg" => $message)
        );
        $headers = array(
            "Authorization: key=AIzaSyDZLuLy5Db84cw0dqJ-5cOvvRZuYPdDIQw",
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function sendMailTamplet($to,$title,$subject,$type,$data) {
        //print_r($data);exit;
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'gropse.com';
        $config['smtp_port'] = 587;
        $config['smtp_user'] = "ashutosh@gropse.com";
        $config['smtp_pass'] = "ashutosh@123";
	$config['mailtype'] = "html";
        $config['charset'] = "iso-8859-1";
        $this->load->library('email', $config);

        $this->email->set_newline("\r\n");
 
        // Sender email address
        $this->email->from("ashutosh@gropse.com", $title);
        // Receiver email address
        $this->email->to($to);
        // Subject of email
        $this->email->subject($subject);
		
        if($type=="welcome"){
            $data = array(
                'data'=>''
            );
            $body = $this->load->view('email/welcome.php',$data,TRUE);
        }
        else if($type=="register"){
            //print_r($data);exit;
            // $body = $this->load->view('email/register.php',$data,TRUE);
             $body ='Your OTP is : '.$data['otp'];
        }else if($type=="forgot"){
            $body = $this->load->view('email/forgot.php',$data,TRUE);
        }else if($type=="cod"){
            $data = array(
                'order_id'	=>$data['order_id'],
                'amount'	=>$data['amount'],
                'items'		=>$data['items']
            );
            $body = $this->load->view('UserView/email/cod.php',$data,TRUE);
        }else{
            $data = array(
                'data'=>''
            );
            $body = $this->load->view('email/welcome.php',$data,TRUE);
        }
		
        // Message in email
        $this->email->message($body); 
        $exec=$this->email->send();
		//echo $exec;exit;
        return true;
    }
    
    
    function send_mail($to, $title, $subject,$data) {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'techgropse.com';
        $config['smtp_port'] = 587;
        $config['smtp_user'] = "dev@techgropse.com";
        $config['smtp_pass'] = "dev@123";
        $config['mailtype'] = 'html';
        $config['charset'] = "iso-8859-1";
        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        // Sender email address
        $this->email->from("dev@techgropse.com", $title);
        // Receiver email address
        $this->email->to($to);
        // Subject of email
        $this->email->subject($subject);
        $body = $this->load->view('email/email.php', $data, TRUE);   
        // Message in email
        $this->email->message($body);
        $result = $this->email->send();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
///////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////PUSH NOTIFICATION////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
    
    
///////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////USER MODULE////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
    function sendSMS($numbers, $msg, $otp) {
        $mobileNumber = $numbers;
        $message = $msg;
        $urls = "https://control.msg91.com/api/sendotp.php?authkey=186459AqGo87k1E5a2287d0&mobile=" . $mobileNumber . "&message=" . $message . "&sender=EVTOTP&otp=" . $otp . "";
        $data = file_get_contents($urls);
        $dataJson = json_decode($data, true);
    }
    
    
    
    
    function userLoginMobile($x) {
        $this->db->where('country_code', $x['country_code']);
        $this->db->where('mobile', $x['mobile']);
        $user = $this->db->get("driver")->row_array();
        if(($user['status'])==1) {
            return array('status'=>true,'type'=>100);
        } else if(($user['status'])==2) { 
            return array('status'=>false,'type'=>101);
        }else if(($user['status'])==99) { 
            return array('status'=>false,'type'=>102);
        }else{
            $update = $this->db->query("update zy_driver set otp = '".$x['otp']."' where mobile= '" . $x['mobile'] . "' and country_code='".$x['country_code']."' ");
            if($update){
                $to             = $x['country_code'].$x['mobile'];
                //$this->sendSMS($to, "Your OTP is : '".$x['otp']."'",$x['otp']);
                return array('status'=>false,'type'=>103);
            }else{
                return array('status'=>false,'type'=>104);
            }
        }
    }

    function check_email($x) {
        $tlbName = "driver";
        $this->db->where('email', $x['email']);
        $query = $this->db->get($tlbName)->row_array();
        if ($query) {
            $data = $query;
        } else {
            $data = false;
        }
        return $data;
    }

    function createOtpEmail($x){
        $update = $this->db->query("update driver_id set otp = '".$x['otp']."' where email= '" . $x['email'] . "' ");
        if($update){
            $sendMail       = array('otp'=>$x['otp']);
            $to             = $x['email'];
            $this->send_mail($x['email'], 'Menzil Info', "Email Verification", ['heading' => 'Email Verification', 'body' => "Your OTP is : ".$x['otp']]);
            return true;
        }else{
            return false;
        }
    }
    
    function createOtpMobile($x){
        $update = $this->db->query("update zy_driver set otp = '".$x['otp']."' where mobile= '" . $x['mobile'] . "'  and country_code='".$x['country_code']."'");
        if($update){
            $to    = $x['country_code'].$x['mobile'];
            //$this->sendSMS($to, "Your OTP is : '".$x['otp']."'",$x['otp']);
            return true;
        }else{
            return false;
        }
    }

    function changePassword($x){
        //print_r($x);exit;
        $userId=$x['driver_id'];unset($x['driver_id']);
        $this->db->where('driver_id', $userId);
        $result = $this->db->update('driver', $x);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    function check_email_type($x) {
        $tlbName = "driver";
        $this->db->where('email', $x['email']);
        $this->db->where('user_type', $x['user_type']);
        $query = $this->db->get($tlbName)->row_array();
        if ($query) {
            $data = true;
        } else {
            $data = false;
        }
        return $data;
    }

    function check_mobile($x) {
        $tlbName = "driver";
        $this->db->where('country_code', $x['country_code']);
        $this->db->where('mobile', $x['mobile']);
        $query = $this->db->get($tlbName)->row_array();
        if ($query) {
            $data = $query;
        } else {
            $data = false;
        }
        return $data;
    }
	

    
    function check_OTP_Email($x) {
	$this->db->where('email', $x['email']);
        $this->db->where('otp', $x['otp']);
        $results = $this->db->get("driver")->row_array();
        if ($results) {
            $update = $this->db->query("update mi_driver set status = '1',email_verification='1' where driver_id= '" . $results['driver_id'] . "' ");
            if ($update) {
                $x['driver_id'] = $results['driver_id'];
                return $UserData = $this->getDataAfterLogin($x);
            }else{
                return false;
            }
        } else {
            return false;
        }
    }
    
    function check_OTP_Mobile($x) {
	$this->db->where('country_code', $x['country_code']);
	$this->db->where('mobile', $x['mobile']);
        $this->db->where('otp', $x['otp']);
        $results = $this->db->get("driver")->row_array();
        if ($results) {
            $update = $this->db->query("update zy_driver set status = '1' where driver_id= '" . $results['driver_id'] . "' ");
            if ($update) {
                $x['driver_id'] = $results['driver_id'];
                return $UserData = $this->getDataAfterLogin($x);
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    function checkPasswordEmail($x) {
	$this->db->where('email', $x['email']);
        $this->db->where('password', $x['password']);
        $results = $this->db->get("driver")->row_array();
        if ($results) {
            $x['driver_id'] = $results['driver_id'];
            return $UserData = $this->getDataAfterLogin($x);
        } else {
            return false;
        }
    }
    
    function checkPasswordMobile($x) {
	$this->db->where('country_code', $x['country_code']);
	$this->db->where('mobile', $x['mobile']);
        $this->db->where('password', $x['password']);
        $results = $this->db->get("driver")->row_array();
        if ($results) {
            $x['driver_id'] = $results['driver_id'];
            return $UserData = $this->getDataAfterLogin($x);
        } else {
            return false;
        }
    }
    
    function getDataAfterLogin($doc) {
        //print_r($doc);exit;
        $data = array(
            "auth_id" => null,
            "driver_id" => $doc['driver_id'],
            "device_type" => $doc['device_type'],
            "device_id" => $doc['device_id'],
            "device_token" => $doc['device_token'],
            "security_token" => $this->my_random_string($doc['device_id']),
            "created_at" => strtotime(date("Y-m-d H:i:s"))
        );
        $this->db->where("driver_id", $doc['driver_id'])
			->delete("driver_auth");

        //Insert Token
        $this->db->insert("driver_auth", $data);
        //Update Token in User Table
        $newData = $this->db->select("driver_id,security_token,device_id")
                ->where("driver_id", $data['driver_id'])
                ->where("device_id", $data['device_id'])
                ->get("driver_auth ")->row_array();
                    
                    $this->db->select('driver_id,name,email,image,country_code,mobile,status,created_at');
                    $this->db->where('driver_id', $data['driver_id']);
        $getUserData = $this->db->get("driver")->row_array();
        $getUserData['device_id']=$newData['device_id'];
        $getUserData['security_token']=$newData['security_token'];
        return $getUserData;
    }

    function adminSetting(){
        $this->db->where('status',1);
        $country_code = $this->db->get('country_code')->result_array();
        return array('country_code'=>$country_code);
    }
    

    function getProfile($d) {
		$this->db->where('driver_id', $d['driver_id']);
        $data = $this->db->get("driver")->row_array();
        unset($data['password']);
        return $data;
    }
    
    function profile($d) {
        $tlbName = "driver";
        $driver_id = $d['driver_id'];
        unset($d['driver_id']);
        $this->db->where('driver_id', $driver_id);
        $result = $this->db->update($tlbName, $d);
        if ($result) {
            return true;
        } else {
            return true;
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////USER MODULE////////////////////////////////////////////////////////////
   ///////////////////////////////////////////////////////////////////////////////////////////////
 
    ///////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////Generic Modules//////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////
    function getSingleDataRow($table,$where){
        if($where){ $this->db->where($where); }
        $getEventTag = $this->db->get($table)->row_array();
        return $getEventTag;
    }
    function getTableDataArrayLimit($table,$where){
        if($where){ $this->db->where($where); }
        $this->db->limit(10,0);
        $getEventTag = $this->db->get($table)->result_array();
        return $getEventTag;
    }
    function getTableDataArray($table,$where){
        if($where){ $this->db->where($where); }
        $getEventTag = $this->db->get($table)->result_array();
        return $getEventTag;
    }
    function getTableDataArrayGroupBy($table,$where,$groupBy){
        if($where){ $this->db->where($where); }
        $this->db->group_by($groupBy);
        $getEventTag = $this->db->get($table)->result_array();
        return $getEventTag;
    }
    function getTableDataArrayOrderBy($table,$where,$orderBY){
        $this->db->where($where);
        $this->db->order_by($orderBY,'DESC');
        $getEventTag = $this->db->get($table)->result_array();
        return $getEventTag;
    }
    function insertDataTable($table,$doc){
        $results = $this->db->insert($table, $doc);
        if($results){
            return true;
        }else{
            return false;
        }
    }
    function updatedataTable($table,$where,$data){
        $this->db->where($where);
        $results = $this->db->update($table, $data);
        if($results){
            return true;
        }else{
            return false;
        }
    }
    function deleteDataTable($table,$where){
        $results=$this->db->where($where)
		        ->delete($table);
        if($results){
            return true;
        }else{
            return false;
        }
    }

    function escapeString($val) {
        $db = get_instance()->db->conn_id;
        $val = mysqli_real_escape_string($db, $val);
        return $val;
    }

    function sanitize($input) {
        if (is_array($input)) {
            foreach ($input as $var => $val) {
                $output[$var] = sanitize($val);
            }
        } else {
            if (get_magic_quotes_gpc()) {
                $input = stripslashes($input);
            }
            $input = $this->cleanInput($input);
            $output = $this->escapeString($input);
        }
        return $output;
    }

    function cleanInput($input) {
        $search = array(
            '@<script[^>]*?>.*?</script>@si', // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
        );
        $output = preg_replace($search, '', $input);
        return $output;
    }

    function makeBase64Img($image) {
        $data = str_replace(" ", "+", $image);
        $data = base64_decode($data);
        $im = imagecreatefromstring($data);
        $fileName = rand(5, 115) . time() . ".png";
        //$imageName = "C://xampp/htdocs/refhop/Source/assets/images/".$fileName;
        //$imageName = "/home/allwashes/public_html/allwashes.com/appshow/assets/images/".$fileName;

        $imageName = base_url() . "/assets/images/" . $fileName;
        if ($im !== false) {
            imagepng($im, $imageName);
            imagedestroy($im);
        } else {
            echo 'An error occurred.';
        }
        return $fileName;
    }

    function convert_date($x) {
        $date = date_create($x);
        $new = date_format($date, "M d, Y");
        return $new;
    }

    function printRecord($name, $content) {
        $myfile = fopen('logs/' . $name . "log.txt", "w");
        if (is_array($content)) {
            $content = json_encode($content);
        }
        fwrite($myfile, $content);
        fclose($myfile);
    }

    function my_random_string($char) {
        $characters = $char;
        $length = 20;
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////Generic Modules//////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////
    
    function distance($lat1, $lon1, $lat2, $lon2, $unit) {
	// echo $lat1.' / '.$lat2.' / '.$lon1.' / '.$lon2.' / '.$unit;  exit();
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
    
    
    function upload_image($x,$uploadDb) {
        $errors = array();
        $file_ext = explode('.', $_FILES[$x]['name']);
        $countExt=count($file_ext)-1;
        $file_name = $this->my_random_string($file_ext[0]) . time() . '.' . $file_ext[$countExt];
        $file_tmp = $_FILES[$x]['tmp_name'];
        $file_name = urlencode($file_name);
        $folder_name = "./uploads/driver/";
        if (empty($errors) == true) {
            $data = move_uploaded_file($file_tmp, $folder_name . $file_name);
            if($uploadDb){
                $insertData=array(
                    'file_path' =>base_url() . "uploads/driver/",
                    'file_name' =>$file_name,
                    'file_type' =>$file_ext[$countExt],
                );
                $inset=$this->insertDataTable('files',$insertData);
                $insert_id          = $this->db->insert_id();	
                return array('id'=>$insert_id,'image'=>base_url() . "uploads/driver/" . $file_name);
            }else{
               return array('id'=>"0",'image'=>base_url() . "uploads/driver/" . $file_name);
            }
            
        } else {
            return false;
        }
    }

    function getImageArray($doc) {
        $data = array();
        $exp = explode(',', $doc);
        $expCount = count($exp);
        for ($i = 0; $i < $expCount; $i++) {
            $imgArr = $this->db->query("SELECT CONCAT(file_path,file_name) as image,file_type FROM user_files WHERE  id='" . $exp[$i] . "' ")->row_array();
            array_push($data, $imgArr);
        }
        return $data;
    }

    function splitTrimData($data){
        $data=ltrim($data,',');
        $data=rtrim($data,',');
        return $data;
    }
    function explodeTrimData($data) {
        $data = ltrim($data, ',');
        $data = rtrim($data, ',');
        if($data){
            $data= explode(',', $data);
            return $data;
        }else{
            return false;
        }
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////Generic Modules//////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////


    ///////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////API MODULES//////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////
    function homepage($data){
        $orders = $this->db->select("h.name as pickup_location,ua.*,oi.group,orders.*")
                        ->where("oi.driver_id",$data['driver_id'])
                        ->where("oi.item_action",2)
                        ->join("order_items as oi", "oi.order_id=orders.order_id")
                        ->join("user_address as ua", "ua.address_id=orders.address_id")
                        ->join("hubs as h", "h.id=oi.hub_id")
                        ->group_by("oi.group,oi.hub_id")
                        ->get("orders")->result_array();
        if($orders){
            return $orders;
        }else{
            return false;
        }
    }

    function orderDetail($data){
        $ItemArr=array();
        $totalAmt="0";
        $orders = $this->db->select("ua.*,orders.*")
                        ->where("orders.order_id",$data['order_id'])
                        ->join("user_address as ua", "ua.address_id=orders.address_id")
                        ->get("orders")->row_array();
                        //print_r($orders);exit;
        if($orders){
            $order_items = $this->db->select("order_items.*,h.name as pickup_location,pag.images")
                    ->where("order_items.driver_id",$data['driver_id'])
                    ->where("order_items.order_id",$data['order_id'])
                    ->where("order_items.group",$data['group'])
                    ->join("product_attribute_group as pag", "pag.item_id=order_items.item_id")
                    ->join("hubs as h", "h.id=order_items.hub_id")
                    ->get("order_items")->result_array();
                    
            if($order_items){
                foreach($order_items as $value){
                    $totalAmt=$totalAmt+$value['total'];
                    $products = $this->db->select("*")
                                ->where("status",1)
                                ->where("product_id",$value['product_id'])
                                ->get("products")->row_array();
                    $value['product_name']=$products['name'];
                    
                    if($value['vendor_id']>0){
                        $vendor = $this->db->select("vendor.*")
                        ->where("vendor_id",$value['vendor_id'])
                        ->get("vendor")->row_array();
                        $value['vendor_mobile']=$vendor['mobile'];
                        $value['vendor_name']=$vendor['name'];
                        $value['vendor_email']=$vendor['email'];
                        $value['vendor_country_code']=$vendor['country_code'];
                        $value['vendor_image']=$vendor['image'];
                    }else{
                        $vendor = $this->db->select("vendor.*")
                        ->where("vendor_id",$value['vendor_id'])
                        ->get("vendor")->row_array();
                        $value['vendor_mobile']="";
                        $value['vendor_name']="Admin";
                        $value['vendor_email']="";
                        $value['vendor_country_code']="";
                        $value['vendor_image']="";
                    }
                    
                    $productImages=array();
                    if($value['images']){
                        $images=$this->splitTrimData($value['images']);
                        $imagesExp=explode(',',$images);
                        if($imagesExp){
                            foreach ($imagesExp as $imgVal) {
                                $files=$this->getSingleDataRow('product_images','product_images_id="'.$imgVal.'"');
                                if($files){
                                    $files['image']=$files['file_path'].$files['file_name'];
                                    array_push($productImages,$files);
                                }
                            }
                        }
                    }
                    $value['images']=$productImages;
                    array_push($ItemArr,$value);
                }
            }
            //print_r($ItemArr);exit;
            $orders['order_item']=$ItemArr;
            $orders['order_amount']=strval($totalAmt);
            return $orders;
        }else{
            return false;
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////API MODULES////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        





        
///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////OLD MODULES//////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////   
        
}
////axios