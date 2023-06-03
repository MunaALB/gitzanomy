<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User_model extends CI_Model {

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
                        ->get("user_auth")->num_rows();
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
                if(isset($data['user_id']) and $data['user_id']=='00'){
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
    
    function userRegister($x) {
        $userData=array(
            'name'          => $x['name'],
            'email'         => $x['email'],
            'country_code'  => $x['country_code'],
            'mobile'        => $x['mobile'],
            'password'      => $x['password'],
            'otp'           => $x['otp'],
            'created_at'    => $x['created_at'],
        );
        $insertData         = $this->insertDataTable('users',$userData);	
        $insert_id          = $this->db->insert_id();	
        if($insertData){
            $to             = $x['country_code'].$x['mobile'];
            //$this->sendSMS($to, "Your OTP is : '".$x['otp']."'",$x['otp']);
            return true;
        }else{
            return false;
        }
    }
    function socialLoginRegister($x) {
        unset($x['country_code']);unset($x['mobile']);
        if(isset($x['email']) and $x['email']){
            $x['email']             =$x['email'];
            $x['email_verification']=1;
        }else{
            $x['email']             ='';
            $x['email_verification']=0;
        }
        if(isset($x['image']) and $x['image']){
            $x['image']=$x['image'];
        }else{
            $x['image']='';
        }
        $loginData=array(
            'name'                  => $x['name'],
            'image'                 => $x['image'],
            'email'                 => $x['email'],
            'email_verification'    => $x['email_verification'],
            'otp'                   => $x['otp'],
            'login_type'            => $x['login_type'],
            'created_at'            => $x['created_at'],
            'status'                => 1,
        );
        if($x['login_type']==3){
            $loginData['fb_id'] = $x['fb_id'];
        }else{
            $loginData['google_id'] = $x['google_id'];
        }
        $insertData         = $this->insertDataTable('users',$loginData);	
        $insert_id          = $this->db->insert_id();	
        if($insertData){
            $x['user_id'] = $insert_id;
            //print_r($x);exit;
            return $UserData = $this->getDataAfterLogin($x);
        }else{
            return false;
        }
    }
    function userLoginEmail($x) {
        $this->db->where('email', $x['email']);
        $user = $this->db->get("users")->row_array();
        if(($user['status'])==1 and $user['email_verification']==1) {
            return array('status'=>true,'type'=>100);
        } else if(($user['status'])==2) { 
            return array('status'=>false,'type'=>101);
        }else if(($user['status'])==99) { 
            return array('status'=>false,'type'=>102);
        }else{
            $update = $this->db->query("update mi_users set otp = '".$x['otp']."' where email= '" . $x['email'] . "' ");
            if($update){
                $sendMail       = array('otp'=>$x['otp']);
                $to             = $x['email'];
                $this->send_mail($x['email'], 'Menzil Info', "Email Verification", ['heading' => 'Email Verification', 'body' => "Your OTP is : ".$x['otp']]);
                return array('status'=>false,'type'=>103);
            }else{
                return array('status'=>false,'type'=>104);
            }
        }
    }
    
    function userLoginMobile($x) {
        $this->db->where('country_code', $x['country_code']);
        $this->db->where('mobile', $x['mobile']);
        $user = $this->db->get("users")->row_array();
        if(($user['status'])==1) {
            return array('status'=>true,'type'=>100);
        } else if(($user['status'])==2) { 
            return array('status'=>false,'type'=>101);
        }else if(($user['status'])==99) { 
            return array('status'=>false,'type'=>102);
        }else{
            $update = $this->db->query("update zy_users set otp = '".$x['otp']."' where mobile= '" . $x['mobile'] . "' and country_code='".$x['country_code']."' ");
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
        $tlbName = "users";
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
        $update = $this->db->query("update mi_users set otp = '".$x['otp']."' where email= '" . $x['email'] . "' ");
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
        $update = $this->db->query("update zy_users set otp = '".$x['otp']."' where mobile= '" . $x['mobile'] . "'  and country_code='".$x['country_code']."'");
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
        $userId=$x['user_id'];unset($x['user_id']);
        $this->db->where('user_id', $userId);
        $result = $this->db->update('users', $x);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    function check_email_type($x) {
        $tlbName = "users";
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
        $tlbName = "users";
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
        $results = $this->db->get("users")->row_array();
        if ($results) {
            $update = $this->db->query("update mi_users set status = '1',email_verification='1' where user_id= '" . $results['user_id'] . "' ");
            if ($update) {
                $x['user_id'] = $results['user_id'];
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
        $results = $this->db->get("users")->row_array();
        if ($results) {
            $update = $this->db->query("update zy_users set status = '1' where user_id= '" . $results['user_id'] . "' ");
            if ($update) {
                $x['user_id'] = $results['user_id'];
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
        $results = $this->db->get("users")->row_array();
        if ($results) {
            $x['user_id'] = $results['user_id'];
            return $UserData = $this->getDataAfterLogin($x);
        } else {
            return false;
        }
    }
    
    function checkPasswordMobile($x) {
	$this->db->where('country_code', $x['country_code']);
	$this->db->where('mobile', $x['mobile']);
        $this->db->where('password', $x['password']);
        $results = $this->db->get("users")->row_array();
        if ($results) {
            $x['user_id'] = $results['user_id'];
            return $UserData = $this->getDataAfterLogin($x);
        } else {
            return false;
        }
    }
    
    function getDataAfterLogin($doc) {
        //print_r($doc);exit;
        $data = array(
            "auth_id" => null,
            "user_id" => $doc['user_id'],
            "device_type" => $doc['device_type'],
            "device_id" => $doc['device_id'],
            "device_token" => $doc['device_token'],
            "security_token" => $this->my_random_string($doc['device_id']),
            "created_at" => strtotime(date("Y-m-d H:i:s"))
        );
        $this->db->where("user_id", $doc['user_id'])
			->delete("user_auth");

        //Insert Token
        $this->db->insert("user_auth", $data);
        //Update Token in User Table
        $newData = $this->db->select("user_id,security_token,device_id")
                ->where("user_id", $data['user_id'])
                ->where("device_id", $data['device_id'])
                ->get("user_auth ")->row_array();
                    
                    $this->db->select('user_id,name,email,image,country_code,mobile,status,created_at');
                    $this->db->where('user_id', $data['user_id']);
        $getUserData = $this->db->get("users")->row_array();
        $getUserData['device_id']=$newData['device_id'];
        $getUserData['security_token']=$newData['security_token'];
        return $getUserData;
    }

    

    function getProfile($d) {
		$this->db->where('user_id', $d['user_id']);
        $data = $this->db->get("users")->row_array();
        unset($data['password']);
        return $data;
    }
    
    function profile($d) {
        $tlbName = "users";
        $user_id = $d['user_id'];
        unset($d['user_id']);
        $this->db->where('user_id', $user_id);
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
        $folder_name = "./uploads/user/";
        if (empty($errors) == true) {
            $data = move_uploaded_file($file_tmp, $folder_name . $file_name);
            if($uploadDb){
                $insertData=array(
                    'file_path' =>base_url() . "uploads/user/",
                    'file_name' =>$file_name,
                    'file_type' =>$file_ext[$countExt],
                );
                $inset=$this->insertDataTable('files',$insertData);
                $insert_id          = $this->db->insert_id();	
                return array('id'=>$insert_id,'image'=>base_url() . "uploads/user/" . $file_name);
            }else{
               return array('id'=>"0",'image'=>base_url() . "uploads/user/" . $file_name);
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
    function getProductDataResult($products,$data){
        $productArr=array();
        foreach ($products as $value) {
            //print_r($value);exit;
            $value['cart_quentity']='0';
            $value['is_fav']="0";
            $category=$this->getSingleDataRow('product_category','category_id="'.$value['category_id'].'" ');
            
            $productAttributes=array();
            if($value['attribute_group_id']){
                $product_attributes=$this->getTableDataArray('product_attribute','group_id="'.$value['attribute_group_id'].'" and product_id="'.$value['product_id'].'"');
                if($product_attributes){
                    foreach($product_attributes as $productAttribute){
                        $category_attribute_id=$this->getSingleDataRow('attribute','attribute_id="'.$productAttribute['attribute_id'].'" ');
                        $category_attribute_value=$this->getSingleDataRow('attribute_value','attribute_value_id="'.$productAttribute['attribute_value_id'].'" ');
                        $attrArr=array('attribute_id'=>$productAttribute['attribute_id'],'attribute_name'=>$category_attribute_id['name'],'attribute_value_id'=>$productAttribute['attribute_value_id'],'attribute_value'=>$category_attribute_value['value']);
                        array_push($productAttributes,$attrArr);
                    }
                }
            }
            
            $value['attributes']=$productAttributes;
            
            $value['category_name']=$category['name'];
            $subcategory=$this->getSingleDataRow('product_sub_category','sub_category_id="'.$value['sub_category_id'].'" ');
            $value['subcategory_name']=$subcategory['name'];

            $brand=$this->getSingleDataRow('brand','brand_id="'.$value['brand_id'].'" ');
            if($brand){
                $value['brand_name']=$brand['name'];
            }else{
                $value['brand_name']="";
            }
            if($value['discount']){
                $value['discount_price']=strval($value['price']-(($value['price']*$value['discount'])/100));
            }else{
                $value['discount_price']=strval($value['price']);
            }
            $product_cart=$this->getSingleDataRow('cart','user_id="'.$data['user_id'].'" and product_id="'.$value['product_id'].'"');
            if($product_cart){
                $value['cart_quentity']=$product_cart['quantity'];
            }
            $wishlist=$this->getSingleDataRow('wishlist','user_id="'.$data['user_id'].'" and product_id="'.$value['product_id'].'"');
            if($wishlist){
                 $value['is_fav']='1';
            }
            $productImages=array();
            //$value['rating']="4";
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
            array_push($productArr,$value);
        }
        return $productArr;
    }
    
    function getAttriutes($value,$data){
        $attributesArr=array();
        $product_attribute=$this->getTableDataArray('attribute_mapping','category_id="'.$value['category_id'].'" and sub_category_id="'.$value['sub_category_id'].'" and status=1');
        if($product_attribute){
            $product_attributeCount=count($product_attribute);
            $attribute = $this->db->select("attribute.*,pa.parent_id,pa.sub_parent_id,pa.product_attribute_id,pa.group_id")
                    ->where("pa.product_id",$value['product_id'])
                    ->where("attribute.status",1)
                    ->where("pa.is_primary",1)
                    ->join("product_attribute as pa", "pa.attribute_id=attribute.attribute_id")
                    ->get("attribute")->row_array();
                    //print_r($attribute);exit;
            if($attribute){
                $attribute_value = $this->db->select("attribute_value.*,pa.product_attribute_id,pa.parent_id,pa.sub_parent_id,pa.product_attribute_id,pa.group_id,pag.item_id,pag.item_no,pag.price,pag.quantity")
                            ->where("pa.product_id",$value['product_id'])
                            ->where("pa.is_primary",1)
                            ->where("attribute_value.status",1)
                            ->join("product_attribute as pa", "pa.attribute_value_id=attribute_value.attribute_value_id")
                            ->join("product_attribute_group as pag", "pag.attribute_group_id=pa.group_id")
                            ->group_by("pa.attribute_value_id")
                            ->get("attribute_value")->result_array();
                            //print_r($attribute_value);exit;
                if($attribute_value){
                    $colorArr=array();
                    foreach($attribute_value as $key=>$val){
                        $attributeSecond = $this->db->select("attribute.*,pa.parent_id,pa.sub_parent_id,pa.product_attribute_id,pa.group_id")
                                    ->where("pa.product_id",$value['product_id'])
                                    ->where("attribute.status",1)
                                    ->where("pa.is_primary",2)
                                    ->where("pa.parent_id",$val['product_attribute_id'])
                                    ->join("product_attribute as pa", "pa.attribute_id=attribute.attribute_id")
                                    //->join("product_attribute_group as pag", "pag.attribute_group_id=pa.group_id")
                                    ->get("attribute")->row_array();
                                    //print_r($attributeSecond);exit;
                        if($attributeSecond){
                            $attribute_value_second = $this->db->select("attribute_value.*,pa.product_attribute_id,pa.parent_id,pa.is_new,pa.sub_parent_id,pa.product_attribute_id,pa.group_id,pag.item_id,pag.item_no,pag.price,pag.quantity")
                                            ->where("pa.product_id",$value['product_id'])
                                            ->where("pa.is_primary",2)
                                            ->where("attribute_value.status",1)
                                            ->where("pa.parent_id",$val['product_attribute_id'])
                                            //->where("pa.sub_parent_id",$attributeSecond['product_attribute_id'])
                                            ->join("product_attribute as pa", "pa.attribute_value_id=attribute_value.attribute_value_id")
                                            ->join("product_attribute_group as pag", "pag.attribute_group_id=pa.group_id")
                                            ->group_by("pa.attribute_value_id")
                                            ->get("attribute_value")->result_array();
                                            //print_r($attribute_value_second);exit;
                            if($attribute_value_second){
                                $storageArr=array();
                                foreach($attribute_value_second as $keySecond=>$valSecond){
                                    if($valSecond['is_new']==0){
                                        $attributeThird = $this->db->select("attribute.*,pa.parent_id,pa.sub_parent_id,pa.product_attribute_id,pa.is_new,pa.group_id")
                                                    ->where("pa.product_id",$value['product_id'])
                                                    ->where("attribute.status",1)
                                                    ->where("pa.is_primary",3)
                                                    ->where("pa.parent_id",$val['product_attribute_id'])
                                                    ->where("pa.sub_parent_id",$valSecond['product_attribute_id'])
                                                    ->join("product_attribute as pa", "pa.attribute_id=attribute.attribute_id")
                                                    //->join("product_attribute_group as pag", "pag.attribute_group_id=pa.group_id")
                                                    ->get("attribute")->row_array();
                                            if($attributeThird){
                                                $attribute_value_third = $this->db->select("attribute_value.*,pa.product_attribute_id,pa.parent_id,pa.sub_parent_id,pa.product_attribute_id,pa.group_id,pag.item_id,pag.item_no,pag.price,pag.quantity")
                                                                ->where("pa.product_id",$value['product_id'])
                                                                ->where("pa.is_primary",3)
                                                                ->where("attribute_value.status",1)
                                                                ->where("pa.parent_id",$val['product_attribute_id'])
                                                                ->where("pa.sub_parent_id",$valSecond['product_attribute_id'])
                                                                ->join("product_attribute as pa", "pa.attribute_value_id=attribute_value.attribute_value_id")
                                                                ->join("product_attribute_group as pag", "pag.attribute_group_id=pa.group_id")
                                                                ->group_by("pa.attribute_value_id")
                                                                ->get("attribute_value")->result_array();
                                                            //print_r($attribute_value_third);exit;
                                                $attributeThird['attribute_value']=$attribute_value_third;
                                            }
                                    }else{
                                        $attributeThird = $this->db->select("attribute.*,pa.parent_id,pa.sub_parent_id,pa.product_attribute_id,pa.group_id")
                                                    ->where("pa.product_id",$value['product_id'])
                                                    ->where("attribute.status",1)
                                                    ->where("pa.is_primary",3)
                                                    ->where("pa.sub_parent_id",$valSecond['product_attribute_id'])
                                                    ->join("product_attribute as pa", "pa.attribute_id=attribute.attribute_id")
                                                    ->get("attribute")->row_array();
                                                    //print_r($attributeThird);exit;
                                            if($attributeThird){
                                                $attribute_value_third = $this->db->select("attribute_value.*,pa.parent_id,pa.sub_parent_id,pa.product_attribute_id,pa.group_id,pag.item_id,pag.item_no,pag.price,pag.quantity")
                                                                ->where("pa.product_id",$value['product_id'])
                                                                ->where("pa.is_primary",3)
                                                                ->where("attribute_value.status",1)
                                                                ->where("pa.sub_parent_id",$valSecond['product_attribute_id'])
                                                                ->join("product_attribute as pa", "pa.attribute_value_id=attribute_value.attribute_value_id")
                                                                ->join("product_attribute_group as pag", "pag.attribute_group_id=pa.group_id")
                                                                ->group_by("pa.attribute_value_id")
                                                                ->get("attribute_value")->result_array();
                                                            //print_r($attribute_value_third);exit;
                                                $attributeThird['attribute_value']=$attribute_value_third;
                                            }
                                    }
                                    // $valSecond['storage']=$attributeThird;
                                    $valSecond['attributes']=$attributeThird;
                                    array_push($storageArr,$valSecond);
                                }
                                $attributeSecond['attribute_value']=$storageArr;
                            }
                        }
                        // $val['color']=$attributeSecond;
                        $val['attributes']=$attributeSecond;
                        array_push($colorArr,$val);
                    }
                }
                $attribute['attribute_value']=$colorArr;
            }
            return $attribute;
        }else{
            return new stdClass();
        }
        
        print_r($attribute);exit;
        
        $attribute = $this->db->select("attribute.*,pa.product_attribute_id,pa.group_id")
                    ->where("pa.product_id",$value['product_id'])
                    ->where("attribute.status",1)
                    ->where("pa.is_primary",1)
                    ->join("product_attribute as pa", "pa.attribute_id=attribute.attribute_id")
                    ->get("attribute")->result_array();
        if($attribute){
            foreach($attribute as $key=>$val){
                $attribute_value = $this->db->select("attribute_value.*,pa.product_attribute_id,pa.group_id")
                            ->where("pa.product_id",$value['product_id'])
                            ->where("pa.group_id",$val['group_id'])
                            ->where("pa.is_primary",2)
                            ->where("attribute_value.status",1)
                            ->join("product_attribute as pa", "pa.attribute_value_id=attribute_value.attribute_value_id")
                            ->get("attribute_value")->result_array();
                $val['attribute_value']=$attribute_value;
                array_push($attributesArr,$val);
            }
        }
        

                    
        
        $attribute_mapping = $this->db->select("attribute.*,am.is_primary")
                    ->where("am.status",1)
                    ->where("am.category_id",$value['category_id'])
                    ->where("am.sub_category_id",$value['sub_category_id'])
                    ->where("am.type",1)
                    ->where("attribute.status",1)
                    ->join("attribute_mapping as am", "am.attribute_id=attribute.attribute_id")
                    ->order_by("am.is_primary", "ASC")
                    ->get("attribute")->result_array();
                    //print_r($getAttribute);exit;
        if($attribute_mapping){
            foreach($attribute_mapping as $key=>$mappingValue){
                $attribute_value = $this->db->select("attribute_value.*")
                    ->where("pa.product_id",$value['product_id'])
                    ->where("pa.attribute_id",$mappingValue['attribute_id'])
                    ->where("attribute_value.status",1)
                    ->join("product_attribute as pa", "pa.attribute_value_id=attribute_value.attribute_value_id")
                    ->get("attribute_value")->result_array();
                if($attribute_value){
                    $mappingValue['attributeValue']=$attribute_value;
                }else{
                    $mappingValue['attributeValue']=array();
                }
                array_push($attributesArr,$mappingValue);
            }
        }
        print_r($attributesArr);exit;





        $resultArr=array();
        $resultArr2=array();
        $getAttribute = $this->db->select("attribute.*")
                        ->where("am.status",1)
                        ->where("am.category_id",$value['category_id'])
                        ->where("am.sub_category_id",$value['sub_category_id'])
                        ->where("am.is_primary",1)
                        ->where("am.type",1)
                        ->where("attribute.status",1)
                        ->join("attribute_mapping as am", "am.attribute_id=attribute.attribute_id")
                        ->get("attribute")->row_array();
        $product_attribute=$this->getTableDataArrayGroupBy('product_attribute','product_id="'.$value['product_id'].'" and attribute_id="'.$getAttribute['attribute_id'].'"','attribute_value_id');
        if($product_attribute){
            foreach($product_attribute as $pa){
                //print_r($pa);exit;
                $getAttribue=$this->getSingleDataRow('attribute_value','attribute_value_id="'.$pa['attribute_value_id'].'" ');
                $obj['attribute_id']=$pa['attribute_id'];
                $obj['attribute']=$pa['attribute_id'];
                $obj['attribute_value']=$getAttribue['value'];
                $obj['attribute_value_id']=$getAttribue['attribute_value_id'];
                $obj['product_attribute_id']=$pa['product_attribute_id'];
                array_push($resultArr,$obj);
            }
        }
        $getAttribute['attribute']=$resultArr;

        $getAttribute2 = $this->db->select("attribute.*")
                        ->where("am.status",1)
                        ->where("am.category_id",$value['category_id'])
                        ->where("am.sub_category_id",$value['sub_category_id'])
                        ->where("am.is_primary",2)
                        ->where("am.type",1)
                        ->where("attribute.status",1)
                        ->join("attribute_mapping as am", "am.attribute_id=attribute.attribute_id")
                        ->get("attribute")->row_array();
        $product_attribute2=$this->getTableDataArrayGroupBy('product_attribute','product_id="'.$value['product_id'].'" and attribute_id="'.$getAttribute2['attribute_id'].'"','attribute_value_id');
        if($product_attribute2){
            foreach($product_attribute2 as $pa){
                //print_r($pa);exit;
                $getAttribue=$this->getSingleDataRow('attribute_value','attribute_value_id="'.$pa['attribute_value_id'].'" ');
                $obj['attribute_id']=$pa['attribute_id'];
                $obj['attribute']=$pa['attribute_id'];
                $obj['attribute_value']=$getAttribue['value'];
                $obj['attribute_value_id']=$getAttribue['attribute_value_id'];
                $obj['product_attribute_id']=$pa['product_attribute_id'];
                array_push($resultArr2,$obj);
            }
        }
        $getAttribute2['attribute']=$resultArr2;
        print_r($getAttribute);exit;

        
    }


    function getAttriutes_1_04_2020($value,$data){
        //print_r($value);exit;
        $resultArr=array();
        $ramArr=array();
        $colorArr=array();
        $ramValueId=0;
        $colorValueId=0;
        $ramChecker = $this->db->select("first_attribute_id,first")
                            ->where("product_id",$value['product_id'])
                            ->group_by('first')
                            ->get("product_attribute_mapping")->result_array();
                            //print_r($ramChecker);exit;

        if($ramChecker){
            $ram = $this->db->select("attribute.*,pa.group_id")
                        ->where("pa.category_id",$value['category_id'])
                        ->where("pa.sub_category_id",$value['sub_category_id'])
                        ->where("pa.product_id",$value['product_id'])
                        ->where("pa.attribute_id",$ramChecker[0]['first_attribute_id'])
                        ->where("attribute.status",1)
                        ->join("product_attribute as pa", "pa.attribute_id=attribute.attribute_id")
                        ->get("attribute")->row_array();
                        //print_r($ram);exit;
            if($ram){
                $ramArr=array();
                foreach($ramChecker as $key=>$attr){
                    if(isset($data['ram']) and $data['ram']){
                        $ramValueId=$data['ram'];
                    }else{
                        if($key==0){
                            $ramValueId=$attr['first'];
                        }
                    }
                    //echo $ramValueId;exit;
                    $getAttributeValue = $this->db->select("attribute_value.*,pa.group_id,pag.item_id")
                                    ->where("pa.category_id",$value['category_id'])
                                    ->where("pa.sub_category_id",$value['sub_category_id'])
                                    ->where("pa.attribute_id",$ram['attribute_id'])
                                    ->where("pa.product_id",$value['product_id'])
                                    ->where("pag.product_id",$value['product_id'])
                                    ->where("attribute_value.status",1)
                                    ->where("attribute_value.attribute_value_id",$attr['first'])
                                    ->join("product_attribute as pa", "pa.attribute_value_id=attribute_value.attribute_value_id")
                                    ->join("product_attribute_group as pag", "pag.attribute_group_id=pa.group_id")
                                    ->group_by('pa.attribute_value_id')
                                    ->get("attribute_value")->row_array();
                    //print_r($getAttributeValue);exit;   
                    array_push($ramArr,$getAttributeValue);
                }
                $ram['attribute_value']=$ramArr;
                //print_r($ram);exit;  
            }
        }

        if($ramValueId>0){
            $colorChecker = $this->db->select("second_attribute_id,second")
                            ->where("product_id",$value['product_id'])
                            ->where("first",$ramValueId)
                            //->group_by('second_attribute_id')
                            ->get("product_attribute_mapping")->result_array();
                            //print_r($colorChecker);exit;
            if($colorChecker){
                $color = $this->db->select("attribute.*,pa.group_id")
                            ->where("pa.category_id",$value['category_id'])
                            ->where("pa.sub_category_id",$value['sub_category_id'])
                            ->where("pa.product_id",$value['product_id'])
                            ->where("pa.attribute_id",$colorChecker[0]['second_attribute_id'])
                            ->where("attribute.status",1)
                            ->join("product_attribute as pa", "pa.attribute_id=attribute.attribute_id")
                            ->get("attribute")->row_array();
                            //print_r($color);exit;
                if($color){
                    $colorArr=array();
                    foreach($colorChecker as $key=>$attr){
                        if(isset($data['color']) and $data['color']){
                            $colorValueId=$data['color'];
                        }else{
                            if($key==0){
                                $colorValueId=$attr['second'];
                            }
                        }
                        $getAttributeValue = $this->db->select("attribute_value.*,pa.group_id,pag.item_id")
                                        ->where("pa.category_id",$value['category_id'])
                                        ->where("pa.sub_category_id",$value['sub_category_id'])
                                        ->where("pa.attribute_id",$color['attribute_id'])
                                        ->where("pa.product_id",$value['product_id'])
                                        ->where("pag.product_id",$value['product_id'])
                                        ->where("attribute_value.status",1)
                                        ->where("attribute_value.attribute_value_id",$attr['second'])
                                        ->join("product_attribute as pa", "pa.attribute_value_id=attribute_value.attribute_value_id")
                                        ->join("product_attribute_group as pag", "pag.attribute_group_id=pa.group_id")
                                        ->group_by('pa.attribute_value_id')
                                        ->get("attribute_value")->row_array();
                        //print_r($getAttributeValue);exit;   
                        array_push($colorArr,$getAttributeValue);
                    }
                    $color['attribute_value']=$colorArr;
                    //print_r($color);exit;  
                }
            }
        }
        //echo $colorValueId;exit;
        if($colorValueId>0){
            $storageChecker = $this->db->select("third_attribute_id,third")
                            ->where("product_id",$value['product_id'])
                            ->where("first",$ramValueId)
                            ->where("second",$colorValueId)
                            //->group_by('second_attribute_id')
                            ->get("product_attribute_mapping")->result_array();
                            //print_r($storageChecker);exit;
            if($storageChecker){
                $storage = $this->db->select("attribute.*,pa.group_id")
                            ->where("pa.category_id",$value['category_id'])
                            ->where("pa.sub_category_id",$value['sub_category_id'])
                            ->where("pa.product_id",$value['product_id'])
                            ->where("pa.attribute_id",$storageChecker[0]['third_attribute_id'])
                            ->where("attribute.status",1)
                            ->join("product_attribute as pa", "pa.attribute_id=attribute.attribute_id")
                            ->get("attribute")->row_array();
                            //print_r($storage);exit;
                if($storage){
                    $storageArr=array();
                    foreach($storageChecker as $key=>$attr){
                        if($key==0){
                            $storageValueId=$attr['third'];
                        }
                        $getAttributeValue = $this->db->select("attribute_value.*,pa.group_id,pag.item_id")
                                        ->where("pa.category_id",$value['category_id'])
                                        ->where("pa.sub_category_id",$value['sub_category_id'])
                                        ->where("pa.attribute_id",$storage['attribute_id'])
                                        ->where("pa.product_id",$value['product_id'])
                                        ->where("pag.product_id",$value['product_id'])
                                        ->where("attribute_value.status",1)
                                        ->where("attribute_value.attribute_value_id",$attr['third'])
                                        ->join("product_attribute as pa", "pa.attribute_value_id=attribute_value.attribute_value_id")
                                        ->join("product_attribute_group as pag", "pag.attribute_group_id=pa.group_id")
                                        ->group_by('pa.attribute_value_id')
                                        ->get("attribute_value")->row_array();
                        //print_r($getAttributeValue);exit;   
                        array_push($storageArr,$getAttributeValue);
                    }
                    $storage['attribute_value']=$storageArr;
                    //print_r($storage);exit;  
                }
            }
        }
        if($ram){
            array_push($resultArr,$ram);
        } if($color){
            array_push($resultArr,$color);
        } if($storage){
            array_push($resultArr,$storage);
        } 
        //print_r($storage);exit;
        return $resultArr;
    }

    function getAttriutes__olsd($value,$data){
        //print_r($value);exit;
        $resultArr2=array();
        $getAttribute = $this->db->select("attribute.*,pa.group_id,pag.item_id")
                        ->where("pa.category_id",$value['category_id'])
                        ->where("pa.sub_category_id",$value['sub_category_id'])
                        ->where("pa.product_id",$value['product_id'])
                        ->where("pag.product_id",$value['product_id'])
                        ->where("attribute.status",1)
                        ->join("product_attribute as pa", "pa.attribute_id=attribute.attribute_id")
                        ->join("product_attribute_group as pag", "pag.attribute_group_id=pa.group_id")
                        ->group_by('pa.attribute_id')
                        ->get("attribute")->result_array();
                        //print_r($getAttribute);exit;
        if($getAttribute){
            foreach($getAttribute as $key=>$attr){
                $getAttributeValue = $this->db->select("attribute_value.*,pa.group_id,pag.item_id")
                        ->where("pa.category_id",$value['category_id'])
                        ->where("pa.sub_category_id",$value['sub_category_id'])
                        ->where("pa.attribute_id",$attr['attribute_id'])
                        ->where("pa.product_id",$value['product_id'])
                        ->where("pag.product_id",$value['product_id'])
                        ->where("attribute_value.status",1)
                        ->join("product_attribute as pa", "pa.attribute_value_id=attribute_value.attribute_value_id")
                        ->join("product_attribute_group as pag", "pag.attribute_group_id=pa.group_id")
                        ->group_by('pa.attribute_value_id')
                        ->get("attribute_value")->result_array();
                $attr['attribute_value']=$getAttributeValue;
                array_push($resultArr2,$attr);
            }
        }
        return $resultArr2;
    }

    function getSpecification($value,$data){
        $resultArr2=array();
        $getAttribute = $this->db->select("attribute.*,ps.product_specification_id")
                        ->where("ps.category_id",$value['category_id'])
                        ->where("ps.sub_category_id",$value['sub_category_id'])
                        ->where("ps.product_id",$value['product_id'])
                        ->where("attribute.status",1)
                        ->join("product_specification as ps", "ps.attribute_id=attribute.attribute_id")
                        ->group_by('ps.attribute_id')
                        ->get("attribute")->result_array();
        if($getAttribute){
            foreach($getAttribute as $attr){
                $getAttributeValue = $this->db->select("attribute_value.*")
                        ->where("ps.product_specification_id",$attr['product_specification_id'])
                        ->where("attribute_value.status",1)
                        ->join("product_specification as ps", "ps.attribute_value_id=attribute_value.attribute_value_id")
                        ->get("attribute_value")->row_array();
                $attr['attribute_value']=$getAttributeValue;
                array_push($resultArr2,$attr);
            }
        }
        //print_r($resultArr2);exit;
        return $resultArr2;
    }

    function getFeatuers($value,$data){
        $resultArr2=array();
        $getAttribute = $this->db->select("featuers.*,pf.product_featuers_id,pf.value")
                        ->where("pf.product_id",$value['product_id'])
                        ->where("featuers.status",1)
                        ->join("product_featuers as pf", "pf.featuers_id=featuers.featuers_id")
                        ->get("featuers")->result_array();
                        //print_r($getAttribute);exit;
        return $getAttribute;
    }
    function getReviews($value,$data){
        $reviewArr=array();
        $product_review=$this->getTableDataArrayOrderBy('product_review','product_id="'.$data['product_id'].'"','id');
        //print_r($product_review);exit;
        if($product_review){
            foreach($product_review as $review){
                $users=$this->getSingleDataRow('users','user_id="'.$review['user_id'].'"');
                if($users){
                    $review['user_name']=$users['name'];
                    $review['user_image']=$users['image'];
                }else{
                    $review['user_name']="N/A";
                    $review['user_image']="";
                }
                array_push($reviewArr,$review);
            }
        }
        $userReview=$this->getSingleDataRow('product_review','product_id="'.$data['product_id'].'" and user_id="'.$data['user_id'].'"');
        if($userReview){
            $isReview="1";
        }else{
            $isReview="0";
        }
        $review_1=0;$review_2=0;$review_3=0;$review_4=0;$review_5=0;
        $one=$this->getTableDataArray('product_review','product_id="'.$data['product_id'].'" and rating="1"');
        if($one){
            $review_1=count($one);
        }
        $two=$this->getTableDataArray('product_review','product_id="'.$data['product_id'].'" and rating="2"');
        if($two){
            $review_2=count($two);
        }
        $three=$this->getTableDataArray('product_review','product_id="'.$data['product_id'].'" and rating="3"');
        if($three){
            $review_3=count($three);
        }
        $four=$this->getTableDataArray('product_review','product_id="'.$data['product_id'].'" and rating="4"');
        if($four){
            $review_4=count($four);
        }
        $five=$this->getTableDataArray('product_review','product_id="'.$data['product_id'].'" and rating="5"');
        if($five){
            $review_5=count($five);
        }
        $progressBar=array('review_1'=>$review_1,'review_2'=>$review_2,'review_3'=>$review_3,'review_4'=>$review_4,'review_5'=>$review_5);
        return array('reviews'=>$reviewArr,'isReview'=>$isReview,'progressBar'=>$progressBar);
    }

    function getProductDataRow($value,$data){
        
        $value['cart_quentity']='0';
        $value['is_fav']="0";
        $category=$this->getSingleDataRow('product_category','category_id="'.$value['category_id'].'" ');
            
        $productAttributes=array();
        if($value['attribute_group_id']){
            $product_attributes=$this->getTableDataArray('product_attribute','group_id="'.$value['attribute_group_id'].'" and product_id="'.$value['product_id'].'"');
            //print_r($product_attributes);exit;
            if($product_attributes){
                foreach($product_attributes as $productAttribute){
                    $category_attribute_id=$this->getSingleDataRow('attribute','attribute_id="'.$productAttribute['attribute_id'].'" ');
                    $category_attribute_value=$this->getSingleDataRow('attribute_value','attribute_value_id="'.$productAttribute['attribute_value_id'].'" ');
                    $attrArr=array('attribute_id'=>$productAttribute['attribute_id'],'attribute_name'=>$category_attribute_id['name'],'attribute_value_id'=>$productAttribute['attribute_value_id'],'attribute_value'=>$category_attribute_value['value']);
                    array_push($productAttributes,$attrArr);
                }
            }
        }
            
        $value['product_attributes']=$productAttributes;
        
        $value['category_name']=$category['name'];
        $subcategory=$this->getSingleDataRow('product_sub_category','sub_category_id="'.$value['sub_category_id'].'" ');
        $value['subcategory_name']=$subcategory['name'];

        $brand=$this->getSingleDataRow('brand','brand_id="'.$value['brand_id'].'" ');
        if($brand){
            $value['brand_name']=$brand['name'];
        }else{
            $value['brand_name']="";
        }
        $model=$this->getSingleDataRow('model','model_id="'.$value['model_id'].'" ');
        if($model){
            $value['model_name']=$model['name'];
        }else{
            $value['model_name']="";
        }
        if($value['discount']){
            $value['discount_price']=strval($value['price']-(($value['price']*$value['discount'])/100));
        }else{
            $value['discount_price']=strval($value['price']);
        }
        $product_cart=$this->getSingleDataRow('cart','user_id="'.$data['user_id'].'" and product_id="'.$value['product_id'].'" and item_id="'.$value['item_id'].'"');
        if($product_cart){
            $value['cart_quentity']=$product_cart['quantity'];
        }
        $wishlist=$this->getSingleDataRow('wishlist','user_id="'.$data['user_id'].'" and product_id="'.$value['product_id'].'"');
        if($wishlist){
            $value['is_fav']='1';
        }
        if($value['vendor_id']>0){
            $vendor=$this->getSingleDataRow('vendor','vendor_id="'.$value['vendor_id'].'"');
            if($vendor){
                $value['vendor_name']=$vendor['name'];
                $value['image']=$vendor['image'];
                $value['vendor_address']=$vendor['address'];
            }else{
                $value['vendor_name']="N/A";
                $value['vendor_image']="";
                $value['vendor_address']="";
            }
        }else{
            $value['vendor_name']="Admin";
            $value['vendor_image']="";
            $value['vendor_address']="";
        }
        $productImages=array();
        //$value['rating']="4";
        //print_r($value);exit;
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
        
        $getVendorArr=array();
        // $product_vendor = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.price,pag.quantity,pag.images")
        //                 ->where("products.status",1)
        //                 ->where("pag.group_id",0)
        //                 ->where("products.model_id",$value['model_id'])
        //                 ->where("products.model_id!=",0)
        //                 ->where("products.product_id!=",$value['product_id'])
        //                 ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
        //                 ->get("products")->result_array();


        $product_vendor = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.price,pag.quantity,pag.images")
                        ->where("products.status",1)
                        ->where("pag.group_id",0)
                        //->where("products.model_id",$value['model_id'])
                        //->where("products.model_id!=",0)
                        //->where("products.product_id!=",$value['product_id'])
                        ->where("products.product_id",$value['product_id'])
                        ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                        ->get("products")->result_array();
                        //print_r($product_vendor);exit;
        if($product_vendor){
            foreach($product_vendor as $pv){
                if($pv['vendor_id']==0){
                    $vendorArr['vendor_name']='Admin';
                    $vendorArr['product_id']=$pv['product_id'];
                    $vendorArr['item_id']=$pv['item_id'];
                    $vendorArr['price']=$pv['price'];
                    $vendorArr['image']=base_url('assets/vendor/images/logo_zanomy_white.png');
                }else{
                    $vendor=$this->getSingleDataRow('vendor','vendor_id="'.$pv['vendor_id'].'"');
                    if($vendor){
                        $vendorArr['vendor_name']=$vendor['name'];
                        $vendorArr['image']=$vendor['image'];
                    }else{
                        $vendorArr['vendor_name']="N/A";
                        $vendorArr['image']="";
                    }
                    $vendorArr['product_id']=$pv['product_id'];
                    $vendorArr['item_id']=$pv['item_id'];
                    $vendorArr['price']=$pv['price'];
                }
                array_push($getVendorArr,$vendorArr);
            }
        }
        $value['moreVendor']=$getVendorArr;
        
        $value['attributes']=$this->getAttriutes($value,$data);
        $value['specification']=$this->getSpecification($value,$data);
        $value['featuers']=$this->getFeatuers($value,$data);
        $value['reviews']=$this->getReviews($value,$data);
        $silimarProductsArr=array();
        $silimarProducts = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.price,pag.quantity,pag.images")
                        ->where("products.status",1)
                        ->where("pag.group_id",0)
                        ->where("pag.sub_category_id",$value['sub_category_id'])
                        ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                        ->limit(10,0)
                        ->group_by('products.model_mapped')
                        ->get("products")->result_array();
        if($silimarProducts){
            $silimarProductsArr=$this->getProductDataResult($silimarProducts,$data);
        }

        $value['silimar_product']=$silimarProductsArr;

        return $value;
    }
        
        function getProductDataRowOld($value,$data){
            $productArr=array();
            
            $value['cart_quentity']='0';
            $value['is_fav']="0";
            $category=$this->getSingleDataRow('category','id="'.$value['category_id'].'" ');

            $product_attribute_group=$this->getSingleDataRow('product_attribute_group','product_id="'.$value['product_id'].'" and group_id=0 ');
            $value['item_id']=$product_attribute_group['item_id'];
            $value['price']=$product_attribute_group['price'];
            $value['quantity']=$product_attribute_group['quantity'];
            $value['discount']=$product_attribute_group['discount'];
            
            $product_cart=$this->getSingleDataRow('cart','user_id="'.$data['user_id'].'" and item_id="'.$product_attribute_group['item_id'].'"');
            if($product_cart){
                $value['cart_quentity']=$product_cart['quantity'];
            }else{
                $value['cart_quentity']="0";
            }
            
            $productAttributes=array();
            if($product_attribute_group['attribute_group_id']){
                $product_attributes=$this->getTableDataArray('product_attribute','group_id="'.$product_attribute_group['attribute_group_id'].'" and product_id="'.$value['product_id'].'"');
                if($product_attributes){
                    foreach($product_attributes as $productAttribute){
                        $category_attribute_id=$this->getSingleDataRow('category_attribute','id="'.$productAttribute['attribute_id'].'" ');
                        $category_attribute_value=$this->getSingleDataRow('category_attribute_value','id="'.$productAttribute['attribute_value_id'].'" ');
                        $attrArr=array('attribute_id'=>$productAttribute['attribute_id'],'attribute_name'=>$category_attribute_id['name'],'attribute_value_id'=>$productAttribute['attribute_value_id'],'attribute_value'=>$category_attribute_value['value']);
                        array_push($productAttributes,$attrArr);
                    }
                }
            }
            
            $value['attributes']=$productAttributes;
            $itemsAttributes=array();
            
            $getAllAttribute=$this->getTableDataArrayGroupBy('product_attribute','product_id="'.$value['product_id'].'" and attribute_id="'.$value['primary_attribute'].'"','attribute_value_id');
            if($getAllAttribute){
                foreach($getAllAttribute as $attribute){
                  $array=$this->db->select('category_attribute_value.*,category_attribute.name as attribute_name')->where('category_attribute_value.id',$attribute['attribute_value_id'])->join('category_attribute','category_attribute_value.category_attribute_id=category_attribute.id')->from('category_attribute_value')->get()->row_array();
//                    print_r($array);exit;
                  $array['attribute_value']=[];
                  $item=[];
                    $getAllAttributeGroup=$this->db->select('distinct(group_id)')->where('product_id="'.$attribute['product_id'].'" and attribute_id="'.$value['primary_attribute'].'" and attribute_value_id="'.$attribute['attribute_value_id'].'"')->get('product_attribute')->result_array();
                    //print_r($getAllAttributeGroup);
                    foreach($getAllAttributeGroup as $specification){
                        $fetchData=$this->getTableDataArrayJoinAttribute(['attribute_value_id'=>$attribute['attribute_value_id'],'product_id'=>$attribute['product_id'],'group_id'=>$specification['group_id'],'attribute_id'=>$value['primary_attribute']]);
                        //print_r($fetchData);exit;
                        if($fetchData){
                            $product_cart=$this->getSingleDataRow('cart','user_id="'.$data['user_id'].'" and item_id="'.$fetchData['item_id'].'"');
                            if($product_cart){
                                $fetchData['cart_quentity']=$product_cart['quantity'];
                            }else{
                                $fetchData['cart_quentity']="0";
                            }
                        }
        
                        array_push($array['attribute_value'],$fetchData);
                   }
                    array_push($itemsAttributes,$array);
                }
            }
            $value['itemsAttributes']=$itemsAttributes;
            $value['category_name']=$category['name'];
            $subcategory=$this->getSingleDataRow('category','id="'.$value['sub_category_id'].'" ');
            if($subcategory){
                $value['subcategory_name']=$subcategory['name'];
            }else{
                $value['subcategory_name']="N/A";
            }
            
            $vendor=$this->getSingleDataRow('vendor','id="'.$value['vendor_id'].'" ');
            $value['vendor_name']=$vendor['name'];

            if($value['discount']){
                $value['discount_price']=strval($value['price']-(($value['price']*$value['discount'])/100));
            }else{
                $value['discount_price']=strval($value['price']);
            }

            $wishlist=$this->getSingleDataRow('wishlist','user_id="'.$data['user_id'].'" and product_id="'.$value['product_id'].'"');
            if($wishlist){
                 $value['is_fav']='1';
            }
            $productImages=array();
            if($product_attribute_group['images']){
                $images=$this->splitTrimData($product_attribute_group['images']);
                $imagesExp=explode(',',$images);
                if($imagesExp){
                    foreach ($imagesExp as $imgVal) {
                        $files=$this->getSingleDataRow('product_images','id="'.$imgVal.'"');
                        if($files){
                            $files['image']=$files['file_path'].$files['file_name'];
                            array_push($productImages,$files);
                        }
                    }
                }
            }
            $value['images']=$productImages;

            $productSpecification=array();
            $product_specification=$this->getTableDataArray('product_specification','product_id="'.$value['product_id'].'"');
            //print_r($product_attribute);exit;
            if($product_specification){
                foreach($product_specification as $specification){
                    $category_attribute=$this->getSingleDataRow('category_attribute','id="'.$specification['attribute_id'].'"');
                    $specification['attribute']=$category_attribute['name'];
                    array_push($productSpecification, $specification);
                }
            }
//                print_r($productAttribute);EXIT;
            $value['specification']=$productSpecification;

            $product_review=$this->getTableDataArray('product_review','product_id="'.$value['product_id'].'"');
            if($product_review){
                $value['review_count']=count($product_review);
            }else{
                $value['review_count']=0;
            }
            //print_r($value);exit;
            return $value;
        }
    
    function checkUser($data){
        $this->db->where('id',$data['user_id']);
        $appusers = $this->db->get('appusers')->result_array();
        if($appusers){
            return true;
        }else{
            return false;
        }
    }

    function adminSetting(){
        $this->db->where('status',1);
        $country_code = $this->db->get('country_code')->result_array();
        return array('country_code'=>$country_code);
    }
    
    
    function homepage($data){
        $userStatus=0;
        $mostViewsProductsArr = array();
        $topSellingProductsArr= array();
        $topBookingServiceArr=array();
        $this->db->where('status',1);
        $slider = $this->db->get('admin_slider')->result_array();

        if(isset($data['user_id']) and $data['user_id']){
            $this->db->where('user_id',$data['user_id']);
            $userData = $this->db->get('users')->row_array();
            if($userData){
                $userStatus=$userData['status'];
            }
        }
        $this->db->where('status',1);
        $slider = $this->db->get('admin_slider')->result_array();

        $this->db->where('status',1);
        $productCategory = $this->db->get('product_category')->result_array();

        $this->db->where('status',1);
        $serviceCategory = $this->db->get('service_category')->result_array();
        
        $mostViewsProducts = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.price,pag.quantity,pag.images")
                        ->where("products.status",1)
                        ->where("pag.group_id",0)
                        ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                        ->limit(10,0)
                        ->order_by('products.total_views','DESC')
                        ->group_by('products.model_mapped')
                        ->get("products")->result_array();
                        //echo $this->db->last_query();exit;
        if($mostViewsProducts){
            $mostViewsProductsArr=$this->getProductDataResult($mostViewsProducts,$data);
        }

        $topSellingProducts = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.price,pag.quantity,pag.images")
                        ->where("products.status",1)
                        ->where("pag.group_id",0)
                        ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                        ->limit(10,0)
                        ->order_by('products.top_selling','DESC')
                        ->group_by('products.model_mapped')
                        ->get("products")->result_array();
        if($topSellingProducts){
            $topSellingProductsArr=$this->getProductDataResult($topSellingProducts,$data);
        }

        $topBookingService = $this->db->select("service.*,sc.name as category_name,ssc.name as sub_category_name")
                        ->where("service.status",1)
                        ->where("v.status",1)
                        ->join("vendor as v", "v.vendor_id=service.vendor_id")
                        ->join("service_category as sc", "sc.category_id=service.category_id")
                        ->join("service_sub_category as ssc", "ssc.sub_category_id=service.sub_category_id")
                        ->limit(10,0)
                        ->order_by('service.total_booking','DESC')
                        ->get("service")->result_array();
        if($topBookingService){
            foreach($topBookingService as $service){
                if($service['discount']){
                    $service['discount_price']=strval($service['price']-(($service['price']*$service['discount'])/100));
                }else{
                    $service['discount_price']=strval($service['price']);
                }
                array_push($topBookingServiceArr,$service);
            }
        }
                        //print_r($topBookingService);exit;
        return array('slider'=>$slider,'productCategory'=>$productCategory,'mostViewsProducts'=>$mostViewsProductsArr,'topSellingProducts'=>$topSellingProductsArr,'serviceCategory'=>$serviceCategory,'mostBooking'=>$topBookingServiceArr,'user_status'=>$userStatus);
    }

    function getHomeViewAllProduct($data){
        $topSellingProductsArr= array();
        if($data['type']==1){
            $this->db->order_by('products.total_views','DESC');
        }else{
            $this->db->order_by('products.top_selling','DESC');
        }
        $topSellingProducts = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.price,pag.quantity,pag.images")
                    ->where("products.status",1)
                    ->where("pag.group_id",0)
                    ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                    ->limit($data['limit'],$data['start'])
                    ->group_by('products.model_mapped')
                    ->get("products")->result_array();
        if($topSellingProducts){
            $topSellingProductsArr=$this->getProductDataResult($topSellingProducts,$data);
        }   
        if($topSellingProductsArr){
            return array('list'=>$topSellingProductsArr);
        }else{
            return false;
        }
    }
    
    function getCategory($data){
        $this->db->where('status',1);
        $productCategory = $this->db->get('product_category')->result_array();
        if($productCategory){
            return array('category'=>$productCategory);
        }else{
            return false;
        }
    }

    function getSubCategory($data){
        $subCatArr=array();
        $this->db->where('status',1);
        $this->db->where('category_id',$data['category_id']);
        $productCategory = $this->db->get('product_sub_category')->result_array();
        if($productCategory){
            foreach($productCategory as $pc){
                $product_category=$this->getSingleDataRow('product_category','category_id="'.$pc['category_id'].'"');
                if($product_category){
                    $pc['category_name']=$product_category['name'];
                }else{
                    $pc['category_name']="N/A";
                }
                $featuredProducts = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.price,pag.quantity,pag.images")
                        ->where("products.sub_category_id",$pc['sub_category_id'])
                        ->where("products.status",1)
                        ->where("pag.group_id",0)
                        ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                        ->get("products")->result_array();
                        if($featuredProducts){
                            $pc['product_count']=strval(count($featuredProducts));
                        }else{
                            $pc['product_count']="0";
                        }
                        array_push($subCatArr,$pc);
            }
            return array('subCategory'=>$subCatArr);
        }else{
            return false;
        }
    }

    function getSubCategoryProduct($data){
        $featuredProductsArr  = array();
        $featuredProducts = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.price,pag.quantity,pag.images")
                        ->where("products.sub_category_id",$data['sub_category_id'])
                        ->where("products.status",1)
                        ->where("pag.group_id",0)
                        ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                        ->limit($data['limit'],$data['start'])
                        ->group_by('products.model_mapped')
                        ->get("products")->result_array();
        if($featuredProducts){
            $featuredProductsArr=$this->getProductDataResult($featuredProducts,$data);
        }
        if($featuredProductsArr){
            return array('product'=>$featuredProductsArr);
        }else{
            return false;
        }
    }

    function searchProduct($data){
        $featuredProductsArr  = array();
        $dbLike="products.status=1 and pag.group_id=0 and (products.name LIKE '%".$data['search']."%' )";
        $featuredProducts = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.price,pag.quantity,pag.images")
                            ->where($dbLike)
                            ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                            ->limit($data['limit'],$data['start'])
                            ->group_by('products.model_mapped')
                            ->get("products")->result_array();
        if($featuredProducts){
            $featuredProductsArr=$this->getProductDataResult($featuredProducts,$data);
        }
        if($featuredProductsArr){
            return array('product'=>$featuredProductsArr);
        }else{
            return false;
        }
    }

    function productDetail($data){
        $featuredProductsArr  = array();
        if(isset($data['item_id']) and $data['item_id']){
            $dbLike="products.status=1 and pag.item_id='".$data['item_id']."' and products.product_id='".$data['product_id']."'";
        }else{
            $dbLike="products.status=1 and pag.group_id=0  and products.product_id='".$data['product_id']."'";
        }
        $featuredProducts = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.price,pag.quantity,pag.images")
                                ->where($dbLike)
                                ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                                ->get("products")->row_array();
        //echo '<pre/>';print_r($featuredProducts);exit;
        if($featuredProducts){
            $featuredProductsArr=$this->getProductDataRow($featuredProducts,$data);
        }
        if($featuredProductsArr){
            return array('product'=>$featuredProductsArr);
        }else{
            return false;
        }
    }

    function getProductItem($data){
        $result=$this->getAttriutes($data,$data);
        if($result){
            return $result;
        }else{
            return false;
        }
        echo '<pre/>';print_r($result);exit;
        $resultArr='';
        $attribute_value_id=trim($data['attribute_value_id'],',');
        $expData=explode(',',$attribute_value_id);
        $countData=count($expData);
        if($countData==1){
            $featuredProductsArr=$this->getSingleDataRow('product_attribute_mapping','product_id="'.$data['product_id'].'" and first="'.$expData[0].'"');
        }else if($countData==2){
            $featuredProductsArr=$this->getSingleDataRow('product_attribute_mapping','product_id="'.$data['product_id'].'" and first="'.$expData[0].'" and second="'.$expData[1].'"');
        }else if($countData==3){
            $featuredProductsArr=$this->getSingleDataRow('product_attribute_mapping','product_id="'.$data['product_id'].'" and first="'.$expData[0].'" and second="'.$expData[1].'" and third="'.$expData[2].'"');
        }else{
            return false;
        }
        return $featuredProductsArr;
    }

    function addReview($x){
        $insert=array(
            'product_id'    => $x['product_id'],
            'user_id'       => $x['user_id'],
            'review'        => $x['review'],
            'rating'        => $x['rating'],
            'created_at'    => date('Y-m-d H:i:s'),
        );
        $insertData         = $this->insertDataTable('product_review',$insert);	
        if($insertData){
            $products=$this->getSingleDataRow('products','product_id="'.$x['product_id'].'"');
            if($products){
                if($products['rating']==0){
                    $rating=$x['rating'];
                }else{
                    $rating=intval(($products['rating']+$x['rating'])/2);
                }
                $updateArr=array('rating'=>$rating);
                $updateData=$this->updatedataTable('products','product_id="'.$x['product_id'].'"',$updateArr);
            }
            return true;
        }else{
            return false;
        }
    }

    function insertIntoCart($data,$productData){ 
        $products=$this->getSingleDataRow('products','product_id="'.$productData['product_id'].'"');
        $product=array(
            'user_id'       => $data['user_id'],
            'vendor_id'     => $products['vendor_id'],
            'product_id'    => $productData['product_id'],
            'item_id'       => $productData['item_id'],
            'price'         => $productData['price'],
            'discount'      => $data['discount'],
            'amount'        => $data['amount'],
            'quantity'      => 1,
            'total'         => $data['total']
        );
        $insetCart=$this->insertDataTable('cart',$product);
        if($insetCart){
            $updateArr=array(
                'quantity'      => $productData['quantity']-1
            );
            $updateData=$this->updatedataTable('product_attribute_group','item_id="'.$productData['item_id'].'"',$updateArr);
            return true;
        }else{
            return false;
        }
    }
        
    function updateIntoCart($data,$productData,$product_cart,$type){
        $updateArr=array(
            'price'         => $productData['price'],
            'discount'      => $data['discount'],
            'amount'        => $data['amount'],
            'quantity'      => $data['quantity'],
            'total'         => $data['total']
        );
        $insetCart=$this->updatedataTable('cart','cart_id="'.$product_cart['cart_id'].'"',$updateArr);
        if($insetCart){
            if($type==1){
                $productQty=$productData['quantity']-1;
            }else{
                $productQty=$productData['quantity']+1;
            }
            $updateArr=array(
                'quantity'      => $productQty
            );
            $updateData=$this->updatedataTable('product_attribute_group','item_id="'.$productData['item_id'].'"',$updateArr);
            return true;
        }else{
            return false;
        }
    }
    function deleteFromCart($product_cart){
        $product_cart=$this->getSingleDataRow('cart','cart_id="'.$product_cart['cart_id'].'"');
        $productData=$this->getSingleDataRow('product_attribute_group','item_id="'.$product_cart['item_id'].'"');
        $insetCart=$this->deleteDataTable('cart','cart_id="'.$product_cart['cart_id'].'"');
        if($insetCart){
            $updateArr=array(
                'quantity'      => $productData['quantity']+$product_cart['quantity']
            );
            $updateData=$this->updatedataTable('product_attribute_group','item_id="'.$product_cart['item_id'].'"',$updateArr);
            return true;
        }else{
            return false;
        }
    }
    
    function addToCart($data){
        $product_cart=$this->getSingleDataRow('cart','user_id="'.$data['user_id'].'" and item_id="'.$data['item_id'].'"');
        if($product_cart){
            if($data['type']==1){    ///increse quantity 
                $totalQuantity=$product_cart['quantity']+1;
                $productDataDiscount=$this->getSingleDataRow('products','product_id="'.$data['product_id'].'"');
                $productData=$this->getSingleDataRow('product_attribute_group','item_id="'.$data['item_id'].'"');
                if($productData['quantity']>0){
                    if($productDataDiscount['discount']){
                        $data['discount']=($productData['price']*$productDataDiscount['discount'])/100;
                    }else{
                        $data['discount']=0;
                    }
                    $data['amount']=$productData['price']-$data['discount'];
                    $data['quantity']=$totalQuantity;
                    $data['total']=$data['amount']*$data['quantity'];
                    $updateData=$this->updateIntoCart($data,$productData,$product_cart,1);
                    if($updateData){
                        return array('code'=>200,'status'=>true,'type'=>'success','message'=>'Quantity added successfully.');
                    }else{
                        return array('code'=>203,'status'=>false,'type'=>'data not increase','message'=>'Some error found.Try again.');
                    }
                }else{
                    return array('code'=>201,'status'=>false,'type'=>'quantity','message'=>'Out Of Stock');
                }
            }elseif($data['type']==2){                  ///decrease quantity
                $totalQuantity=$product_cart['quantity']-1;
                if($totalQuantity>0){
                    $productData=$this->getSingleDataRow('product_attribute_group','item_id="'.$data['item_id'].'"');
                    $productDataDiscount=$this->getSingleDataRow('products','product_id="'.$data['product_id'].'"');
                    if($productDataDiscount['discount']){
                        $data['discount']=($productData['price']*$productDataDiscount['discount'])/100;
                    }else{
                        $data['discount']=0;
                    }
                    $data['amount']=$productData['price']-$data['discount'];
                    $data['quantity']=$totalQuantity;
                    $data['total']=$data['amount']*$data['quantity'];
                    $updateData=$this->updateIntoCart($data,$productData,$product_cart,2);
                    if($updateData){
                        return array('code'=>200,'status'=>true,'type'=>'success','message'=>'Product remove from cart.');
                    }else{
                        return array('code'=>203,'status'=>false,'type'=>'Some erroe found.Try again.');
                    }
                }else{              //////delete here
                    $updateData=$this->deleteFromCart($product_cart);
                    if($updateData){
                        return array('code'=>205,'status'=>true,'type'=>'delete from cart','message'=>'Product remove from cart');
                    }else{
                        return array('code'=>203,'status'=>false,'type'=>'data not delete','message'=>'Try again.');
                    }
                }
            }else{
                $updateData=$this->deleteFromCart($product_cart);
                if($updateData){
                    return array('code'=>205,'status'=>true,'type'=>'delete from cart','message'=>'Product remove from cart');
                }else{
                    return array('code'=>203,'status'=>false,'type'=>'data not delete','message'=>'Try again.');
                }
            }
        }else{
            $productDataDiscount=$this->getSingleDataRow('products','product_id="'.$data['product_id'].'"');
            $productData=$this->getSingleDataRow('product_attribute_group','item_id="'.$data['item_id'].'"');
            //print_r($productData);exit;
            if($productData['quantity']>0){
                if($productDataDiscount['discount']){
                    $data['discount']=($productData['price']*$productDataDiscount['discount'])/100;
                }else{
                    $data['discount']=0;
                }
                $data['amount']=$productData['price']-$data['discount'];
                $data['total']=$data['amount'];
                $insetCart=$this->insertIntoCart($data,$productData);
                if($insetCart){
                    return array('code'=>200,'status'=>true,'type'=>'success','message'=>'Product added successfully');
                }else{
                    return array('code'=>202,'status'=>false,'type'=>'data not insert','message'=>'Some error found.try again.');
                }
            }else{
                return array('code'=>201,'status'=>false,'type'=>'quantity','message'=>'Out Of Stock');
            }
        }
    }


    function addToWishlist($data){
        $product_cart=$this->getSingleDataRow('wishlist','user_id="'.$data['user_id'].'" and product_id="'.$data['product_id'].'"');
        if($product_cart){
            $insetCart=$this->deleteDataTable('wishlist','wishlist_id="'.$product_cart['wishlist_id'].'"');
            if($insetCart){
                return array('code'=>200,'status'=>false,'message'=>'Remove From Whislist.');
            }else{
                return array('code'=>201,'status'=>false,'message'=>'Some Error Found.');
            }
        }else{
            $wishlistArr=array('user_id'=>$data['user_id'],'product_id'=>$data['product_id']);
            $insetCart=$this->insertDataTable('wishlist',$wishlistArr);
            if($insetCart){
                return array('code'=>200,'status'=>true,'message'=>'Add To Whislist.');
            }else{
                return array('code'=>201,'status'=>false,'message'=>'Some Error Found.');
            }
        }
    }

    function getMyCart($data){
        $cartArr=array();
        $totalAmount=0;
        $product_cart = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,,pag.quantity,pag.images,c.quantity as cart_quentity,c.price,c.discount,c.amount,c.total")
                        ->where("products.status",1)
                        ->where("c.user_id",$data['user_id'])
                        ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                        ->join("cart as c", "c.item_id=pag.item_id")
                        ->get("products")->result_array();
                        //print_r($product_cart);exit;
        if($product_cart){
            foreach($product_cart as $value){
                $category=$this->getSingleDataRow('product_category','category_id="'.$value['category_id'].'" ');
            
                $productAttributes=array();
                if($value['attribute_group_id']){
                    $product_attributes=$this->getTableDataArray('product_attribute','group_id="'.$value['attribute_group_id'].'" and product_id="'.$value['product_id'].'"');
                    //print_r($product_attributes);exit;
                    if($product_attributes){
                        foreach($product_attributes as $productAttribute){
                            $category_attribute_id=$this->getSingleDataRow('attribute','attribute_id="'.$productAttribute['attribute_id'].'" ');
                            $category_attribute_value=$this->getSingleDataRow('attribute_value','attribute_value_id="'.$productAttribute['attribute_value_id'].'" ');
                            $attrArr=array('attribute_id'=>$productAttribute['attribute_id'],'attribute_name'=>$category_attribute_id['name'],'attribute_value_id'=>$productAttribute['attribute_value_id'],'attribute_value'=>$category_attribute_value['value']);
                            array_push($productAttributes,$attrArr);
                        }
                    }
                }
                    
                $value['product_attributes']=$productAttributes;
                
                $value['category_name']=$category['name'];
                $subcategory=$this->getSingleDataRow('product_sub_category','sub_category_id="'.$value['sub_category_id'].'" ');
                $value['subcategory_name']=$subcategory['name'];

                $brand=$this->getSingleDataRow('brand','brand_id="'.$value['brand_id'].'" ');
                if($brand){
                    $value['brand_name']=$brand['name'];
                }else{
                    $value['brand_name']="";
                }
                $model=$this->getSingleDataRow('model','model_id="'.$value['model_id'].'" ');
                if($model){
                    $value['model_name']=$model['name'];
                }else{
                    $value['model_name']="";
                }
                if($value['discount']){
                    $value['discount_price']=strval($value['price']-(($value['price']*$value['discount'])/100));
                }else{
                    $value['discount_price']=strval($value['price']);
                }
                $productImages=array();
                //$value['rating']="4";
                //print_r($value);exit;
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
                $totalAmount=$totalAmount+$value['total'];
                array_push($cartArr,$value);
            }
            return array('status'=>true,'cart'=>$cartArr,'total_amount'=>$totalAmount);
        }else{
            return array('status'=>false,'cart'=>array());
        }
    }
    function getWishlist($data){
        $productFavArr=array();
        $product_cart = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.quantity,pag.images,pag.price")
                        ->where("products.status",1)
                        ->where("w.user_id",$data['user_id'])
                        ->where("pag.group_id",0)
                        ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                        ->join("wishlist as w", "w.product_id=products.product_id")
                        ->get("products")->result_array();
                        //print_r($product_cart);exit;
        
            foreach($product_cart as $value){
                $category=$this->getSingleDataRow('product_category','category_id="'.$value['category_id'].'" ');
            
                $productAttributes=array();
                if($value['attribute_group_id']){
                    $product_attributes=$this->getTableDataArray('product_attribute','group_id="'.$value['attribute_group_id'].'" and product_id="'.$value['product_id'].'"');
                    //print_r($product_attributes);exit;
                    if($product_attributes){
                        foreach($product_attributes as $productAttribute){
                            $category_attribute_id=$this->getSingleDataRow('attribute','attribute_id="'.$productAttribute['attribute_id'].'" ');
                            $category_attribute_value=$this->getSingleDataRow('attribute_value','attribute_value_id="'.$productAttribute['attribute_value_id'].'" ');
                            $attrArr=array('attribute_id'=>$productAttribute['attribute_id'],'attribute_name'=>$category_attribute_id['name'],'attribute_value_id'=>$productAttribute['attribute_value_id'],'attribute_value'=>$category_attribute_value['value']);
                            array_push($productAttributes,$attrArr);
                        }
                    }
                }
                    
                $value['product_attributes']=$productAttributes;
                
                $value['category_name']=$category['name'];
                $subcategory=$this->getSingleDataRow('product_sub_category','sub_category_id="'.$value['sub_category_id'].'" ');
                $value['subcategory_name']=$subcategory['name'];

                $brand=$this->getSingleDataRow('brand','brand_id="'.$value['brand_id'].'" ');
                if($brand){
                    $value['brand_name']=$brand['name'];
                }else{
                    $value['brand_name']="";
                }
                $model=$this->getSingleDataRow('model','model_id="'.$value['model_id'].'" ');
                if($model){
                    $value['model_name']=$model['name'];
                }else{
                    $value['model_name']="";
                }
                if($value['discount']){
                    $value['discount_price']=strval($value['price']-(($value['price']*$value['discount'])/100));
                }else{
                    $value['discount_price']=strval($value['price']);
                }
                $value['is_fav']="1";
                $productImages=array();
                //$value['rating']="4";
                //print_r($value);exit;
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
                array_push($productFavArr,$value);
            }
        return array('wishlist'=>$productFavArr);
    }


    function addAddress($data){
        $insertData=$this->insertDataTable('user_address',$data);	
        $insert_id = $this->db->insert_id();
        if($insertData){
            return true;
        }else{
            return false;
        }
    }
    
    function editAddress($data){
        $this->db->where('address_id', $data['address_id']);
        $result = $this->db->update('user_address', $data);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
    function getMyAddress($data){
        $userAddress=array();
        $user_address=$this->getTableDataArray('user_address','user_id="'.$data['user_id'].'"');
        if($user_address){
            foreach($user_address as $val){
                $country=$this->getSingleDataRow('country_code','country_code_id="'.$val['country_id'].'" ');
                $val['country_name']=$country['name'];
                array_push($userAddress,$val);
            }
            return array('user_address'=>$userAddress);
        }else{
            return false;
        }
    }
    
   




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////API MODULES////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function getServieCategory($data){
    $this->db->where('status',1);
    $productCategory = $this->db->get('service_category')->result_array();
    if($productCategory){
        return array('category'=>$productCategory);
    }else{
        return false;
    }
}

function getServiceSubCategory($data){
    $subCatArr=array();
    $this->db->where('status',1);
    $this->db->where('category_id',$data['category_id']);
    $productCategory = $this->db->get('service_sub_category')->result_array();
    if($productCategory){
        foreach($productCategory as $pc){
            $product_category=$this->getSingleDataRow('service_category','category_id="'.$pc['category_id'].'"');
            if($product_category){
                $pc['category_name']=$product_category['name'];
            }else{
                $pc['category_name']="N/A";
            }
            $topBookingService = $this->db->select("service.*")
                        ->where("service.status",1)
                        ->where("service.category_id",$data['category_id'])
                        ->where("service.sub_category_id",$pc['sub_category_id'])
                        ->where("v.status",1)
                        ->join("vendor as v", "v.vendor_id=service.vendor_id")
                        ->limit(10,0)
                        ->order_by('service.total_booking','DESC')
                        ->get("service")->result_array();
            $pc['vendor_count']=strval(count($topBookingService));
            array_push($subCatArr,$pc);
        }
        return array('subCategory'=>$subCatArr);
    }else{
        return false;
    }
}

function getServiceVendor($data){
    $vendorArr=array();
    $latitude=$data['latitude'];
    $longitude=$data['longitude'];
    $serviceVendor = $this->db->select("service.service_id,service.vendor_id,service.category_id,service.sub_category_id,service.rating,v.lat,v.lng,( 3959 * acos( cos( radians('$latitude') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians( lat ) ) ) ) AS distance")
                ->where("service.status",1)
                ->where("service.sub_category_id",$data['sub_category_id'])
                ->where("v.status",1)
                ->join("vendor as v", "v.vendor_id=service.vendor_id")
                ->group_by('service.vendor_id')
                //->having('distance<=',100)
                ->get("service")->result_array();
                //print_r($serviceVendor);exit;
    if($serviceVendor){
        foreach($serviceVendor as $vendorData){
            $vendorRow=$this->getSingleDataRow('vendor','vendor_id="'.$vendorData['vendor_id'].'" and status=1');
            if($vendorRow){
                $vendorObj=array('vendor_id'=>$vendorRow['vendor_id'],'name'=>$vendorRow['name'],'image'=>$vendorRow['image']);
                $serviceCount=0;
                $getAllService=$this->getTableDataArray('service','vendor_id="'.$vendorData['vendor_id'].'" and sub_category_id="'.$data['sub_category_id'].'" and status="1"');
                $serviceRating=$this->getTableDataArray('service','vendor_id="'.$vendorData['vendor_id'].'" and status="1"');
                if($serviceRating){
                    foreach($serviceRating as $service_data){
                        $serviceCount=$serviceCount+$service_data['rating'];
                    }
                    $serviceCount=intval($serviceCount/(count($serviceRating)));
                }
                $serviceCount=strval($serviceCount);
                $vendorObj['service_count']=strval(count($getAllService));
                $vendorObj['service_rating']=$serviceCount;
                $vendorObj['sub_category_id']=$data['sub_category_id'];

                $service_sub_category=$this->getSingleDataRow('service_sub_category','sub_category_id="'.$data['sub_category_id'].'"');
                $service_category=$this->getSingleDataRow('service_category','category_id="'.$service_sub_category['category_id'].'"');
                $vendorObj['category_id']=$service_category['category_id'];
                $vendorObj['category_name']=$service_category['name'];
                $vendorObj['sub_category_name']=$service_sub_category['name'];
                array_push($vendorArr,$vendorObj);
            }
        }
    }else{
        return false;
    }
    //print_r($vendorArr);exit;
    return array('vendor'=>$vendorArr);
}

function getService($data){
    $allServiceArr=array();
    
    $serviceVendor = $this->db->select("service.*,sc.name as category_name,ssc.name as sub_category_name")
                ->where("service.status",1)
                ->where("service.sub_category_id",$data['sub_category_id'])
                ->where("service.vendor_id",$data['vendor_id'])
                ->where("v.status",1)
                ->join("vendor as v", "v.vendor_id=service.vendor_id")
                ->join("service_category as sc", "sc.category_id=service.category_id")
                ->join("service_sub_category as ssc", "ssc.sub_category_id=service.sub_category_id")
                ->limit($data['limit'],$data['start'])
                ->get("service")->result_array();
                //print_r($serviceVendor);exit;
    if($serviceVendor){
        foreach($serviceVendor as $service){
            if($service['discount']){
                $service['discount_price']=strval($service['price']-(($service['price']*$service['discount'])/100));
            }else{
                $service['discount_price']=strval($service['price']);
            }
            array_push($allServiceArr,$service);
        }
        return array('service'=>$allServiceArr);
    }else{
        return false;
    }
}

function getServiceReviews($value,$data){
    $reviewArr=array();
    $product_review=$this->getTableDataArrayOrderBy('service_review','service_id="'.$data['service_id'].'"','id');
    //print_r($product_review);exit;
    if($product_review){
        foreach($product_review as $review){
            $users=$this->getSingleDataRow('users','user_id="'.$review['user_id'].'"');
            if($users){
                $review['user_name']=$users['name'];
                $review['user_image']=$users['image'];
            }else{
                $review['user_name']="N/A";
                $review['user_image']="";
            }
            array_push($reviewArr,$review);
        }
    }
    $userReview=$this->getSingleDataRow('service_review','service_id="'.$data['service_id'].'" and user_id="'.$data['user_id'].'"');
    if($userReview){
        $isReview="1";
    }else{
        $isReview="0";
    }
    $review_1=0;$review_2=0;$review_3=0;$review_4=0;$review_5=0;
    $one=$this->getTableDataArray('service_review','service_id="'.$data['service_id'].'" and rating="1"');
    if($one){
        $review_1=count($one);
    }
    $two=$this->getTableDataArray('service_review','service_id="'.$data['service_id'].'" and rating="2"');
    if($two){
        $review_2=count($two);
    }
    $three=$this->getTableDataArray('service_review','service_id="'.$data['service_id'].'" and rating="3"');
    if($three){
        $review_3=count($three);
    }
    $four=$this->getTableDataArray('service_review','service_id="'.$data['service_id'].'" and rating="4"');
    if($four){
        $review_4=count($four);
    }
    $five=$this->getTableDataArray('service_review','service_id="'.$data['service_id'].'" and rating="5"');
    if($five){
        $review_5=count($five);
    }
    $progressBar=array('review_1'=>$review_1,'review_2'=>$review_2,'review_3'=>$review_3,'review_4'=>$review_4,'review_5'=>$review_5);
    return array('reviews'=>$reviewArr,'isReview'=>$isReview,'progressBar'=>$progressBar);
}

function getServiceFeatuers($value,$data){
    $resultArr2=array();
    $getAttribute = $this->db->select("service_featuer.*")
                    ->where("service_id",$value['service_id'])
                    ->get("service_featuer")->result_array();
                    //print_r($getAttribute);exit;
    return $getAttribute;
}

function getServiceDetail($data){
    $value = $this->db->select("service.*")
                ->where("service.status",1)
                ->where("service.service_id",$data['service_id'])
                ->where("v.status",1)
                ->join("vendor as v", "v.vendor_id=service.vendor_id")
                ->get("service")->row_array();
    if($value){
        $category=$this->getSingleDataRow('service_category','category_id="'.$value['category_id'].'" ');
        $value['category_name']=$category['name'];
        $subcategory=$this->getSingleDataRow('service_sub_category','sub_category_id="'.$value['sub_category_id'].'" ');
        $value['subcategory_name']=$subcategory['name'];
        if($value['discount']){
            $value['discount_price']=strval($value['price']-(($value['price']*$value['discount'])/100));
        }else{
            $value['discount_price']=strval($value['price']);
        }
        
        $vendor=$this->getSingleDataRow('vendor','vendor_id="'.$value['vendor_id'].'"');
        if($vendor){
            $value['vendor_name']=$vendor['name'];
            $value['vendor_image']=$vendor['image'];
        }else{
            $value['vendor_name']="N/A";
            $value['vendor_image']="";
        }
        $value['reviews']=$this->getServiceReviews($value,$data);
        $value['featuers']=$this->getServiceFeatuers($value,$data);

        $silimarProductsArr=array();
        $silimarProducts = $this->db->select("service.*,sc.name as category_name,ssc.name as sub_category_name")
                ->where("service.status",1)
                ->where("service.sub_category_id",$value['sub_category_id'])
                ->where("v.status",1)
                ->join("vendor as v", "v.vendor_id=service.vendor_id")
                ->join("service_category as sc", "sc.category_id=service.category_id")
                ->join("service_sub_category as ssc", "ssc.sub_category_id=service.sub_category_id")
                ->get("service")->result_array();
        if($silimarProducts){
            foreach($silimarProducts as $service){
                if($service['discount']){
                    $service['discount_price']=strval($service['price']-(($service['price']*$service['discount'])/100));
                }else{
                    $service['discount_price']=strval($service['price']);
                }
                array_push($silimarProductsArr,$service);
            }
        }
        $value['silimar_service']=$silimarProductsArr;

        return $value;
    }else{
        return false;
    }
}

function addServiceReview($x){
    $insert=array(
        'service_id'    => $x['service_id'],
        'user_id'       => $x['user_id'],
        'review'        => $x['review'],
        'rating'        => $x['rating'],
        'created_at'    => date('Y-m-d H:i:s'),
    );
    $insertData         = $this->insertDataTable('service_review',$insert);	
    if($insertData){
        $products=$this->getSingleDataRow('service','service_id="'.$x['service_id'].'"');
        if($products){
            if($products['rating']==0){
                $rating=$x['rating'];
            }else{
                $rating=intval(($products['rating']+$x['rating'])/2);
            }
            $updateArr=array('rating'=>$rating);
            $updateData=$this->updatedataTable('service','service_id="'.$x['service_id'].'"',$updateArr);
        }
        return true;
    }else{
        return false;
    }
}



function serviceBooking($data){
    $serviceData=$this->getSingleDataRow('service','service_id="'.$data['service_id'].'" ');
    if($serviceData){
        if($serviceData['discount']>0){
            $amount     = ($serviceData['price']-(($serviceData['price']*$serviceData['discount'])/100));
        }else{
            $amount     = $serviceData['price'];
        }
        
        $bookingArr=array(
            'vendor_id'     => $serviceData['vendor_id'],
            'user_id'       => $data['user_id'],
            'service_id'    => $data['service_id'],
            'start_date'    => $data['start_date'],
            'start_time'    => $data['start_time'],
            'price'         => $serviceData['price'],
            'discount'      => $serviceData['discount'],
            'amount'        => $amount,
            'latitude'      => $data['latitude'], 
            'longitude'     => $data['longitude'], 
            'address'       => $data['address'], 
            'note'          => $data['note'], 
            'payment_type'  => 1, 
            'payment_status'=> 0, 
            'status'        => 0, 
            'created_at'    => date('Y-m-d H:i:s')
        );
        $results = $this->db->insert('service_booking', $bookingArr);
        if($results){
            $insert_id = $this->db->insert_id();
            return array('status'=>true,'code'=>100,'booking_id'=>$insert_id);
        }else{
            return array('status'=>false,'code'=>101,'booking_id'=>$insert_id);
        }
    }else{
        return array('status'=>false,'code'=>102,'booking_id'=>$insert_id);
    }
}

function myRequest($data){
    $requestArr=array();
    $service_booking=$this->getTableDataArrayOrderBy('service_booking','user_id="'.$data['user_id'].'" and status=0','booking_id');
    if($service_booking){
        foreach($service_booking as $booking){
            $serviceData=$this->getSingleDataRow('service','service_id="'.$booking['service_id'].'" ');
            $booking['service_image']=$serviceData['image'];
            $booking['service_name']=$serviceData['name'];
            array_push($requestArr,$booking);
        }
        return $requestArr;
    }else{
        return false;
    }
}

function myBooking($data){
    $activeArr=array();
    $completeArr=array();
    $active_service_booking=$this->getTableDataArrayOrderBy('service_booking','user_id="'.$data['user_id'].'" and (status=1 or status=2 or status=3)','booking_id');
    if($active_service_booking){
        foreach($active_service_booking as $booking){
            $serviceData=$this->getSingleDataRow('service','service_id="'.$booking['service_id'].'" ');
            $booking['service_image']=$serviceData['image'];
            $booking['service_name']=$serviceData['name'];
            array_push($activeArr,$booking);
        }
    }

    $complete_service_booking=$this->getTableDataArrayOrderBy('service_booking','user_id="'.$data['user_id'].'" and status=4','booking_id');
    if($complete_service_booking){
        foreach($complete_service_booking as $booking){
            $serviceData=$this->getSingleDataRow('service','service_id="'.$booking['service_id'].'" ');
            $booking['service_image']=$serviceData['image'];
            $booking['service_name']=$serviceData['name'];
            array_push($completeArr,$booking);
        }
    }
    return array('active_booking'=>$activeArr,'complete_booking'=>$completeArr);
}

function bookingDetail($data){
    $requestArr=array();
    $service_booking=$this->getSingleDataRow('service_booking','booking_id="'.$data['booking_id'].'" and ( status=1 or status=2 or status=3  or status=4)');
    if($service_booking){
        $serviceData=$this->getSingleDataRow('service','service_id="'.$service_booking['service_id'].'" ');
        $service_booking['service_image']=$serviceData['image'];
        $service_booking['service_name']=$serviceData['name'];

        $user=$this->getSingleDataRow('users','user_id="'.$service_booking['user_id'].'" ');
        $service_booking['user_name']=$user['name'];
        $service_booking['user_country_code']=$user['country_code'];
        $service_booking['user_mobile']=$user['mobile'];

        $vendor=$this->getSingleDataRow('vendor','vendor_id="'.$service_booking['vendor_id'].'" ');
        $service_booking['vendor_name']=$vendor['name'];
        $service_booking['vendor_country_code']=$vendor['country_code'];
        $service_booking['vendor_mobile']=$vendor['mobile'];
        $service_booking['vendor_address']=$vendor['address'];
        $service_booking['vendor_latitude']=$vendor['lat'];
        $service_booking['vendor_longitude']=$vendor['lng'];

        return $service_booking;
    }else{
        return false;
    }
}






        
///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////OLD MODULES//////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////   
        
}
////axios