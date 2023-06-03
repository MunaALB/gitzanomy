<?php
// require 'aws/aws-autoloader.php';

// use Aws\S3\S3Client;

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
        $this->load->helper('custom_helper');
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
//        $folder_name = "./uploads/driver/";
        $uploadPath = "/uploads/driver/";
        if (empty($errors) == true) {
//            $data = move_uploaded_file($file_tmp, $folder_name . $file_name);
            $result = 0;
            $reponse = uploadToS3($file_tmp, $file_name,$uploadPath);
            if ($reponse) {
                if (isset($reponse['imagepath']) && $reponse['imagepath']) {
                    $result = $reponse['imagepath'];
                } else {
                    $result = 0;
                }
            } else {
                $result = 0;
            }
            if($uploadDb && $result){
                $insertData=array(
                    'file_path' =>base_url() . "uploads/driver/",
                    'file_name' =>$file_name,
                    'file_type' =>$file_ext[$countExt],
                );
                $inset=$this->insertDataTable('files',$insertData);
                $insert_id          = $this->db->insert_id();	
                return array('id'=>$insert_id,'image'=>'https://zanomy.s3.us-east-2.amazonaws.com/driver/' . $file_name);
            }else{
//               return array('id'=>"0",'image'=>base_url() . "uploads/driver/" . $file_name);
                if($result){
                    return array('id'=>"0",'image'=>'https://zanomy.s3.us-east-2.amazonaws.com/driver/'.$file_name);
                }else{
                    return false;
                }
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
        $activerOrder   = $this->getTableDataArray('driver_order','driver_id="'.$data['driver_id'].'" and (driver_order_status=1 or driver_order_status=2 or driver_order_status=3) ');
        $activerOrderCount=count($activerOrder);
        $pastOrder      = $this->getTableDataArray('driver_order','driver_id="'.$data['driver_id'].'" and (driver_order_status=4) ');
        $pastOrderCount=count($pastOrder);
        $returnOrder    = $this->getTableDataArray('driver_order','driver_id="'.$data['driver_id'].'" and (driver_order_status=3255) ');
        $returnOrderCount=count($returnOrder);

        $where='driver_order.driver_id="'.$data['driver_id'].'" and (driver_order.driver_order_status=1 or driver_order.driver_order_status=2 or driver_order.driver_order_status=3)';
        $recentOrder = $this->db->select("driver_order.*,o.upfront_amount as amount,o.address_id")
                        ->where($where)
                        ->join("orders as o", "o.order_id=driver_order.order_id")
                        ->order_by('driver_order.driver_order_id', 'DESC')
                        ->limit(5,0)
                        ->get("driver_order")->result_array();
        $recentOrderArr=array();
        if($recentOrder){
            foreach($recentOrder as $order){
                if($order['driver_order_type']==1){
                    $getOrders   = $this->getSingleDataRow('orders','order_id="'.$order['order_id'].'" ');
                    if($getOrders){
                        $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
                        if($user_address){
                            $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['geo_address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                        }else{
                            $order['user_address']=new stdClass();
                        }
                    }
                }elseif($order['driver_order_type']==2){
                    $totalAmt=0;
                    $getOrders   = $this->getTableDataArray('order_items','order_id="'.$order['order_id'].'" and (vendor_tracking_id="'.$order['driver_tracking_id'].'") ');
                    if($getOrders){
                        foreach($getOrders as $odr){
                            $totalAmt=$totalAmt+$odr['total'];
                        }
                    }
                    $order['amount']=$totalAmt;
                    if(isset($getOrders[0]['vendor_id']) and $getOrders[0]['vendor_id']){
                        $user_address   = $this->getSingleDataRow('vendor','vendor_id="'.$getOrders[0]['vendor_id'].'" ');
                        if($user_address){
                            $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                        }else{
                            $order['user_address']=new stdClass();
                        }
                    }else{
                       $order['user_address']=new stdClass(); 
                    }
                    
                }elseif($order['driver_order_type']==3){
                    $totalAmt=0;
                    $getOrders   = $this->getTableDataArray('order_items','order_id="'.$order['order_id'].'" and (drop_tracking_id="'.$order['driver_tracking_id'].'") ');
                    if($getOrders){
                        foreach($getOrders as $odr){
                            $totalAmt=$totalAmt+$odr['total'];
                        }
                    }
                    $order['amount']=$totalAmt;
                    $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
                    if($user_address){
                        $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['geo_address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                    }else{
                        $order['user_address']=new stdClass();
                    }
                }elseif($order['driver_order_type']==4){
                    $totalAmt=0;
                    $getOrders   = $this->getTableDataArray('order_items','order_id="'.$order['order_id'].'" and (international_driver_id="'.$order['driver_tracking_id'].'") ');
                    if($getOrders){
                        foreach($getOrders as $odr){
                            $totalAmt=$totalAmt+$odr['total'];
                        }
                    }
                    $order['amount']=$totalAmt;
                    $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
                    if($user_address){
                        $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['geo_address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                    }else{
                        $order['user_address']=new stdClass();
                    }
                }elseif($order['driver_order_type']==5){
                    $totalAmt=0;
                    $getOrders   = $this->getTableDataArray('order_items','order_id="'.$order['order_id'].'" and (return_tracking_id="'.$order['driver_tracking_id'].'") ');
                    // echo $this->db->last_query();exit;
                    if($getOrders){
                        foreach($getOrders as $odr){
                            $totalAmt=$totalAmt+$odr['total'];
                        }
                    }
                    $order['amount']=$totalAmt;
                    $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
                    if($user_address){
                        $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['geo_address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                    }else{
                        $order['user_address']=new stdClass();
                    }
                }elseif($order['driver_order_type']==6){
                    $totalAmt=0;
                    $getOrders   = $this->getTableDataArray('order_items','order_id="'.$order['order_id'].'" and (return_drop_tracking_id="'.$order['driver_tracking_id'].'") ');
                    if($getOrders){
                        foreach($getOrders as $odr){
                            $totalAmt=$totalAmt+$odr['total'];
                        }
                    }
                    $order['amount']=$totalAmt;


                    if(isset($getOrders[0]['vendor_id']) and $getOrders[0]['vendor_id']){
                        $user_address   = $this->getSingleDataRow('vendor','vendor_id="'.$getOrders[0]['vendor_id'].'" ');
                        if($user_address){
                            $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                        }else{
                            $order['user_address']=new stdClass();
                        }
                    }else{
                       $order['user_address']=new stdClass(); 
                    }
                }
                array_push($recentOrderArr,$order);
            }
        }
        return array('active_order'=>$activerOrderCount,'past_order'=>$pastOrderCount,'return_order'=>$returnOrderCount,'recent_order'=>$recentOrderArr);
    }


    function recentOrderList($data){
        
        $where='driver_order.driver_id="'.$data['driver_id'].'" and (driver_order.driver_order_status=1 or driver_order.driver_order_status=2 or driver_order.driver_order_status=3)';
        $recentOrder = $this->db->select("driver_order.*,o.upfront_amount as amount,o.address_id")
                        ->where($where)
                        ->join("orders as o", "o.order_id=driver_order.order_id")
                        ->order_by('driver_order.driver_order_id', 'DESC')
                        ->get("driver_order")->result_array();
        $recentOrderArr=array();
        if($recentOrder){
            foreach($recentOrder as $order){
                if($order['driver_order_type']==1){
                    $getOrders   = $this->getSingleDataRow('orders','order_id="'.$order['order_id'].'" ');
                    if($getOrders){
                        $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
                        if($user_address){
                            $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['geo_address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                        }else{
                            $order['user_address']=new stdClass();
                        }
                    }
                }elseif($order['driver_order_type']==2){
                    $totalAmt=0;
                    $getOrders   = $this->getTableDataArray('order_items','order_id="'.$order['order_id'].'" and (vendor_tracking_id="'.$order['driver_tracking_id'].'") ');
                    if($getOrders){
                        foreach($getOrders as $odr){
                            $totalAmt=$totalAmt+$odr['total'];
                        }
                    }
                    $order['amount']=$totalAmt;
                    if(isset($getOrders[0]['vendor_id']) and $getOrders[0]['vendor_id']){
                        $user_address   = $this->getSingleDataRow('vendor','vendor_id="'.$getOrders[0]['vendor_id'].'" ');
                        if($user_address){
                            $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                        }else{
                            $order['user_address']=new stdClass();
                        }
                    }else{
                        $order['user_address']=new stdClass();
                    }
                }elseif($order['driver_order_type']==3){
                    $totalAmt=0;
                    $getOrders   = $this->getTableDataArray('order_items','order_id="'.$order['order_id'].'" and (drop_tracking_id="'.$order['driver_tracking_id'].'") ');
                    if($getOrders){
                        foreach($getOrders as $odr){
                            $totalAmt=$totalAmt+$odr['total'];
                        }
                    }
                    $order['amount']=$totalAmt;
                    $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
                    if($user_address){
                        $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['geo_address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                    }else{
                        $order['user_address']=new stdClass();
                    }
                }elseif($order['driver_order_type']==4){
                    $totalAmt=0;
                    $getOrders   = $this->getTableDataArray('order_items','order_id="'.$order['order_id'].'" and (international_driver_id="'.$order['driver_tracking_id'].'") ');
                    if($getOrders){
                        foreach($getOrders as $odr){
                            $totalAmt=$totalAmt+$odr['total'];
                        }
                    }
                    $order['amount']=$totalAmt;
                    $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
                    if($user_address){
                        $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['geo_address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                    }else{
                        $order['user_address']=new stdClass();
                    }
                }elseif($order['driver_order_type']==5){
                    $totalAmt=0;
                    $getOrders   = $this->getTableDataArray('order_items','order_id="'.$order['order_id'].'" and (return_tracking_id="'.$order['driver_tracking_id'].'") ');
                    if($getOrders){
                        foreach($getOrders as $odr){
                            $totalAmt=$totalAmt+$odr['total'];
                        }
                    }
                    $order['amount']=$totalAmt;
                    $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
                    if($user_address){
                        $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['geo_address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                    }else{
                        $order['user_address']=new stdClass();
                    }
                }elseif($order['driver_order_type']==6){
                    $totalAmt=0;
                    $getOrders   = $this->getTableDataArray('order_items','order_id="'.$order['order_id'].'" and (return_drop_tracking_id="'.$order['driver_tracking_id'].'") ');
                    if($getOrders){
                        foreach($getOrders as $odr){
                            $totalAmt=$totalAmt+$odr['total'];
                        }
                    }
                    $order['amount']=$totalAmt;


                    if(isset($getOrders[0]['vendor_id']) and $getOrders[0]['vendor_id']){
                        $user_address   = $this->getSingleDataRow('vendor','vendor_id="'.$getOrders[0]['vendor_id'].'" ');
                        if($user_address){
                            $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                        }else{
                            $order['user_address']=new stdClass();
                        }
                    }else{
                       $order['user_address']=new stdClass(); 
                    }
                }
                array_push($recentOrderArr,$order);
            }
            return array('recent_order'=>$recentOrderArr);
        }else{
            return false;
        }
    }


    function collectUpfrontDetail($data){
        $where='driver_order.driver_id="'.$data['driver_id'].'" and driver_order.driver_order_id="'.$data['driver_order_id'].'" and driver_order.order_id="'.$data['order_id'].'"';
        $order = $this->db->select("driver_order.*,o.upfront_amount as amount,o.address_id")
                        ->where($where)
                        ->join("orders as o", "o.order_id=driver_order.order_id")
                        ->get("driver_order")->row_array();
        if($order){
            $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
            if($user_address){
                $order['user_detail']=$user_address;
            }else{
                $order['user_detail']=new stdClass();
            }

            $user_address   = $this->getSingleDataRow('driver','driver_id="'.$data['driver_id'].'" ');
            if($user_address){
                unset($user_address['password']);
                $order['driver_detail']=$user_address;
            }else{
                $order['driver_detail']=new stdClass();
            }
            
            $order_statusArr=array();
            $order_status = $this->getTableDataArray('order_status','type=3 and (order_type_id=1) ');
            if($order_status){
                foreach($order_status as $stats){
                    $getCheck= $this->getSingleDataRow('order_upfront_tracking','order_id="'.$data['order_id'].'" and driver_id="'.$data['driver_id'].'" and upfront_tracking_id="'.$data['driver_tracking_id'].'" and upfront_status="'.$stats['status_id'].'"');
                    if($getCheck){
                        $stats['is_checked']="1";
                    }else{
                        $stats['is_checked']="0";
                    }
                    array_push($order_statusArr,$stats);
                }
            }
            $order['order_status']=$order_statusArr;
            $order['order_upfront_tracking']   = $this->getTableDataArray('order_upfront_tracking','order_id="'.$data['order_id'].'" and driver_id="'.$data['driver_id'].'" and upfront_tracking_id="'.$data['driver_tracking_id'].'"');
            return array('detail'=>$order);
        }
    }

    function itemPickupFromVendorDetail($data){
        $where='driver_order.driver_id="'.$data['driver_id'].'" and driver_order.driver_order_id="'.$data['driver_order_id'].'" and driver_order.order_id="'.$data['order_id'].'"';
        $order = $this->db->select("driver_order.*,o.upfront_amount as amount,o.address_id")
                        ->where($where)
                        ->join("orders as o", "o.order_id=driver_order.order_id")
                        ->get("driver_order")->row_array();
        if($order){

            $totalAmt=0;
            $getOrderItems=array();
            $getOrders = $this->db->select('ot.*,p.name as product_name,c.name as category_name')
                                ->where('ot.order_id',$data['order_id'])
                                ->where('ot.vendor_tracking_id',$data['driver_tracking_id'])
                                ->from('order_items ot')
                                ->join('products p', 'ot.product_id=p.product_id')
                                ->join('product_category c', 'p.category_id=c.category_id')
                                ->order_by('item_id', 'DESC')->get()->result_array();
            if($getOrders){
                foreach($getOrders as $items){
                    $totalAmt=$totalAmt+$items['total'];

                    $items['image'] = '';
                    $getItem = $this->getSingleDataRow('product_attribute_group','item_id="'.$items['item_id'].'" and product_id="'.$items['product_id'].'"');
                    //echo '<pre/>';print_r($getItem);exit;
                    if($getItem){
                        if($getItem['images']){
                            $images = explode(',', $getItem['images']);
                            if ($images) {
                                $getImage = $this->db->select('CONCAT(file_path,file_name) as image')->where(['product_images_id' => $images[0]])->get('product_images')->row_array();
                                if ($getImage) {
                                    $items['image'] = $getImage['image'];
                                }
                            }
                        }
                    }
                    array_push($getOrderItems, $items);
                }
            }

            $order['amount']=$totalAmt;
            $order['order_item']=$getOrderItems;
            if(isset($getOrders[0]['vendor_id']) and $getOrders[0]['vendor_id']){
                $vendor_address   = $this->getSingleDataRow('vendor','vendor_id="'.$getOrders[0]['vendor_id'].'" ');
                if($vendor_address){
                    $order['vendor_detail']=$vendor_address;
                }else{
                    $order['vendor_detail']=new stdClass();
                }
            }else{
                $order['vendor_detail']=new stdClass();
            }
            

            $user_address   = $this->getSingleDataRow('driver','driver_id="'.$data['driver_id'].'" ');
            if($user_address){
                unset($user_address['password']);
                $order['driver_detail']=$user_address;
            }else{
                $order['driver_detail']=new stdClass();
            }
            
            $order_statusArr=array();
            $order_status = $this->getTableDataArray('order_status','type=3 and (order_type_id=2) ');
            if($order_status){
                foreach($order_status as $stats){
                    $getCheck= $this->getSingleDataRow('order_vendor_tracking','order_id="'.$data['order_id'].'" and driver_id="'.$data['driver_id'].'" and vendor_tracking_id="'.$data['driver_tracking_id'].'" and vendor_status="'.$stats['status_id'].'"');
                    if($getCheck){
                        $stats['is_checked']="1";
                    }else{
                        $stats['is_checked']="0";
                    }
                    array_push($order_statusArr,$stats);
                }
            }
            $order['order_status']=$order_statusArr;

            $order['order_upfront_tracking']   = $this->getTableDataArray('order_vendor_tracking','order_id="'.$data['order_id'].'" and driver_id="'.$data['driver_id'].'" and vendor_tracking_id="'.$data['driver_tracking_id'].'"');
            return array('detail'=>$order);
        }
    }

    function itemDeliveredUserDetail($data){
        $where='driver_order.driver_id="'.$data['driver_id'].'" and driver_order.driver_order_id="'.$data['driver_order_id'].'" and driver_order.order_id="'.$data['order_id'].'"';
        $order = $this->db->select("driver_order.*,o.upfront_amount,o.remain_amount,o.total,o.address_id")
                        ->where($where)
                        ->join("orders as o", "o.order_id=driver_order.order_id")
                        ->get("driver_order")->row_array();
        if($order){

            $totalAmt=0;
            $getOrderItems=array();
            $getOrders = $this->db->select('ot.*,p.name as product_name,c.name as category_name')
                                ->where('ot.order_id',$data['order_id'])
                                ->where('ot.drop_tracking_id',$data['driver_tracking_id'])
                                ->from('order_items ot')
                                ->join('products p', 'ot.product_id=p.product_id')
                                ->join('product_category c', 'p.category_id=c.category_id')
                                ->order_by('item_id', 'DESC')->get()->result_array();
            if($getOrders){
                foreach($getOrders as $items){
                    $totalAmt=$totalAmt+$items['total'];

                    $items['image'] = '';
                    $getItem = $this->getSingleDataRow('product_attribute_group','item_id="'.$items['item_id'].'" and product_id="'.$items['product_id'].'"');
                    //echo '<pre/>';print_r($getItem);exit;
                    if($getItem){
                        if($getItem['images']){
                            $images = explode(',', $getItem['images']);
                            if ($images) {
                                $getImage = $this->db->select('CONCAT(file_path,file_name) as image')->where(['product_images_id' => $images[0]])->get('product_images')->row_array();
                                if ($getImage) {
                                    $items['image'] = $getImage['image'];
                                }
                            }
                        }
                    }
                    array_push($getOrderItems, $items);
                }
            }

            $order['amount']=$totalAmt;
            $order['order_item']=$getOrderItems;
            $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
            if($user_address){
                $order['user_detail']=$user_address;
            }else{
                $order['user_detail']=new stdClass();
            }
            

            $user_address   = $this->getSingleDataRow('driver','driver_id="'.$data['driver_id'].'" ');
            if($user_address){
                unset($user_address['password']);
                $order['driver_detail']=$user_address;
            }else{
                $order['driver_detail']=new stdClass();
            }
            $order_statusArr=array();
            $order_status = $this->getTableDataArray('order_status','type=3 and (order_type_id=3) ');
            if($order_status){
                foreach($order_status as $stats){
                    $getCheck= $this->getSingleDataRow('order_drop_tracking','order_id="'.$data['order_id'].'" and driver_id="'.$data['driver_id'].'" and drop_tracking_id="'.$data['driver_tracking_id'].'" and drop_status="'.$stats['status_id'].'"');
                    if($getCheck){
                        $stats['is_checked']="1";
                    }else{
                        $stats['is_checked']="0";
                    }
                    array_push($order_statusArr,$stats);
                }
            }
            $order['order_status']=$order_statusArr;
            $order['order_upfront_tracking']   = $this->getTableDataArray('order_drop_tracking','order_id="'.$data['order_id'].'" and driver_id="'.$data['driver_id'].'" and drop_tracking_id="'.$data['driver_tracking_id'].'"');
            return array('detail'=>$order);
        }
    }


    function internationalItemPickupDetail($data){
        $where='driver_order.driver_id="'.$data['driver_id'].'" and driver_order.driver_order_id="'.$data['driver_order_id'].'" and driver_order.order_id="'.$data['order_id'].'"';
        $order = $this->db->select("driver_order.*,o.upfront_amount,o.remain_amount,o.total,o.address_id")
                        ->where($where)
                        ->join("orders as o", "o.order_id=driver_order.order_id")
                        ->get("driver_order")->row_array();
        if($order){

            $totalAmt=0;
            $getOrderItems=array();
            $getOrders = $this->db->select('ot.*,p.name as product_name,c.name as category_name')
                                ->where('ot.order_id',$data['order_id'])
                                ->where('ot.international_tracking_id',$data['driver_tracking_id'])
                                ->from('order_items ot')
                                ->join('products p', 'ot.product_id=p.product_id')
                                ->join('product_category c', 'p.category_id=c.category_id')
                                ->order_by('item_id', 'DESC')->get()->result_array();
            if($getOrders){
                foreach($getOrders as $items){
                    $totalAmt=$totalAmt+$items['total'];

                    $items['image'] = '';
                    $getItem = $this->getSingleDataRow('product_attribute_group','item_id="'.$items['item_id'].'" and product_id="'.$items['product_id'].'"');
                    //echo '<pre/>';print_r($getItem);exit;
                    if($getItem){
                        if($getItem['images']){
                            $images = explode(',', $getItem['images']);
                            if ($images) {
                                $getImage = $this->db->select('CONCAT(file_path,file_name) as image')->where(['product_images_id' => $images[0]])->get('product_images')->row_array();
                                if ($getImage) {
                                    $items['image'] = $getImage['image'];
                                }
                            }
                        }
                    }
                    array_push($getOrderItems, $items);
                }
            }

            $order['amount']=$totalAmt;
            $order['order_item']=$getOrderItems;
            $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
            if($user_address){
                $order['user_detail']=$user_address;
            }else{
                $order['user_detail']=new stdClass();
            }
            

            $user_address   = $this->getSingleDataRow('driver','driver_id="'.$data['driver_id'].'" ');
            if($user_address){
                unset($user_address['password']);
                $order['driver_detail']=$user_address;
            }else{
                $order['driver_detail']=new stdClass();
            }
            $order_statusArr=array();
            $order_status = $this->getTableDataArray('order_status','type=3 and (order_type_id=4) ');
            if($order_status){
                foreach($order_status as $stats){
                    $getCheck= $this->getSingleDataRow('order_international_tracking','order_id="'.$data['order_id'].'" and driver_id="'.$data['driver_id'].'" and international_tracking_id="'.$data['driver_tracking_id'].'" and international_status="'.$stats['status_id'].'"');
                    if($getCheck){
                        $stats['is_checked']="1";
                    }else{
                        $stats['is_checked']="0";
                    }
                    array_push($order_statusArr,$stats);
                }
            }
            $order['order_status']=$order_statusArr;
            $order['order_upfront_tracking']   = $this->getTableDataArray('order_international_tracking','order_id="'.$data['order_id'].'" and driver_id="'.$data['driver_id'].'" and international_tracking_id="'.$data['driver_tracking_id'].'"');
            return array('detail'=>$order);
        }
    }

    function itemReturnPickupFromUserDetail($data){
        $where='driver_order.driver_id="'.$data['driver_id'].'" and driver_order.driver_order_id="'.$data['driver_order_id'].'" and driver_order.order_id="'.$data['order_id'].'"';
        $order = $this->db->select("driver_order.*,o.upfront_amount as amount,o.address_id")
                        ->where($where)
                        ->join("orders as o", "o.order_id=driver_order.order_id")
                        ->get("driver_order")->row_array();
        if($order){

            $totalAmt=0;
            $getOrderItems=array();
            $getOrders = $this->db->select('ot.*,p.name as product_name,c.name as category_name')
                                ->where('ot.order_id',$data['order_id'])
                                ->where('ot.return_tracking_id',$data['driver_tracking_id'])
                                ->from('order_items ot')
                                ->join('products p', 'ot.product_id=p.product_id')
                                ->join('product_category c', 'p.category_id=c.category_id')
                                ->order_by('item_id', 'DESC')->get()->result_array();
            if($getOrders){
                foreach($getOrders as $items){
                    $totalAmt=$totalAmt+$items['total'];

                    $items['image'] = '';
                    $getItem = $this->getSingleDataRow('product_attribute_group','item_id="'.$items['item_id'].'" and product_id="'.$items['product_id'].'"');
                    //echo '<pre/>';print_r($getItem);exit;
                    if($getItem){
                        if($getItem['images']){
                            $images = explode(',', $getItem['images']);
                            if ($images) {
                                $getImage = $this->db->select('CONCAT(file_path,file_name) as image')->where(['product_images_id' => $images[0]])->get('product_images')->row_array();
                                if ($getImage) {
                                    $items['image'] = $getImage['image'];
                                }
                            }
                        }
                    }
                    array_push($getOrderItems, $items);
                }
            }

            $order['amount']=$totalAmt;
            $order['order_item']=$getOrderItems;
            
            
            $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
            if($user_address){
                $order['user_detail']=$user_address;
            }else{
                $order['user_detail']=new stdClass();
            }


            $user_address   = $this->getSingleDataRow('driver','driver_id="'.$data['driver_id'].'" ');
            if($user_address){
                unset($user_address['password']);
                $order['driver_detail']=$user_address;
            }else{
                $order['driver_detail']=new stdClass();
            }
            
            $order_statusArr=array();
            $order_status = $this->getTableDataArray('order_status','type=3 and (order_type_id=5) ');
            if($order_status){
                foreach($order_status as $stats){
                    $getCheck= $this->getSingleDataRow('order_return_tracking','order_id="'.$data['order_id'].'" and driver_id="'.$data['driver_id'].'" and return_tracking_id="'.$data['driver_tracking_id'].'" and return_status="'.$stats['status_id'].'"');
                    if($getCheck){
                        $stats['is_checked']="1";
                    }else{
                        $stats['is_checked']="0";
                    }
                    array_push($order_statusArr,$stats);
                }
            }
            $order['order_status']=$order_statusArr;

            $order['order_upfront_tracking']   = $this->getTableDataArray('order_return_tracking','order_id="'.$data['order_id'].'" and driver_id="'.$data['driver_id'].'" and return_tracking_id="'.$data['driver_tracking_id'].'"');
            return array('detail'=>$order);
        }
    }

    function itemReturnDropToVendorDetail($data){
        $where='driver_order.driver_id="'.$data['driver_id'].'" and driver_order.driver_order_id="'.$data['driver_order_id'].'" and driver_order.order_id="'.$data['order_id'].'"';
        $order = $this->db->select("driver_order.*,o.upfront_amount as amount,o.address_id")
                        ->where($where)
                        ->join("orders as o", "o.order_id=driver_order.order_id")
                        ->get("driver_order")->row_array();
        if($order){

            $totalAmt=0;
            $getOrderItems=array();
            $getOrders = $this->db->select('ot.*,p.name as product_name,c.name as category_name')
                                ->where('ot.order_id',$data['order_id'])
                                ->where('ot.return_drop_tracking_id',$data['driver_tracking_id'])
                                ->from('order_items ot')
                                ->join('products p', 'ot.product_id=p.product_id')
                                ->join('product_category c', 'p.category_id=c.category_id')
                                ->order_by('item_id', 'DESC')->get()->result_array();
            if($getOrders){
                foreach($getOrders as $items){
                    $totalAmt=$totalAmt+$items['total'];

                    $items['image'] = '';
                    $getItem = $this->getSingleDataRow('product_attribute_group','item_id="'.$items['item_id'].'" and product_id="'.$items['product_id'].'"');
                    //echo '<pre/>';print_r($getItem);exit;
                    if($getItem){
                        if($getItem['images']){
                            $images = explode(',', $getItem['images']);
                            if ($images) {
                                $getImage = $this->db->select('CONCAT(file_path,file_name) as image')->where(['product_images_id' => $images[0]])->get('product_images')->row_array();
                                if ($getImage) {
                                    $items['image'] = $getImage['image'];
                                }
                            }
                        }
                    }
                    array_push($getOrderItems, $items);
                }
            }

            $order['amount']=$totalAmt;
            $order['order_item']=$getOrderItems;
            
            
            // $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
            // if($user_address){
            //     $order['user_detail']=$user_address;
            // }else{
            //     $order['user_detail']=new stdClass();
            // }

            if(isset($getOrders[0]['vendor_id']) and $getOrders[0]['vendor_id']){
                $vendor_address   = $this->getSingleDataRow('vendor','vendor_id="'.$getOrders[0]['vendor_id'].'" ');
                if($vendor_address){
                    $order['vendor_detail']=$vendor_address;
                }else{
                    $order['vendor_detail']=new stdClass();
                }
            }else{
                $order['vendor_detail']=new stdClass();
            }


            $user_address   = $this->getSingleDataRow('driver','driver_id="'.$data['driver_id'].'" ');
            if($user_address){
                unset($user_address['password']);
                $order['driver_detail']=$user_address;
            }else{
                $order['driver_detail']=new stdClass();
            }
            
            $order_statusArr=array();
            $order_status = $this->getTableDataArray('order_status','type=3 and (order_type_id=6) ');
            if($order_status){
                foreach($order_status as $stats){
                    $getCheck= $this->getSingleDataRow('order_return_drop_tracking','order_id="'.$data['order_id'].'" and driver_id="'.$data['driver_id'].'" and return_drop_tracking_id="'.$data['driver_tracking_id'].'" and return_drop_status="'.$stats['status_id'].'"');
                    if($getCheck){
                        $stats['is_checked']="1";
                    }else{
                        $stats['is_checked']="0";
                    }
                    array_push($order_statusArr,$stats);
                }
            }
            $order['order_status']=$order_statusArr;

            $order['order_upfront_tracking']   = $this->getTableDataArray('order_return_drop_tracking','order_id="'.$data['order_id'].'" and driver_id="'.$data['driver_id'].'" and return_drop_tracking_id="'.$data['driver_tracking_id'].'"');
            return array('detail'=>$order);
        }
    }

    
    
    function changeOrderStatus($data){
        $where='driver_order.driver_id="'.$data['driver_id'].'" and driver_order.driver_order_id="'.$data['driver_order_id'].'" and driver_order.order_id="'.$data['order_id'].'"';
        $order = $this->db->select("driver_order.*,o.upfront_amount as amount,o.address_id")
                        ->where($where)
                        ->join("orders as o", "o.order_id=driver_order.order_id")
                        ->get("driver_order")->row_array();
        if($order){
            if($data['driver_order_type']==1){
                $insertData=array(
                    'order_id'              => $data['order_id'],
                    'driver_id'             => $data['driver_id'],
                    'upfront_tracking_id'   => $data['driver_tracking_id'],
                    'upfront_status'        => $data['upfront_status'],
                    'upfront_tracking_created_at'  => date('Y-m-d H:i:s'),
                );
                $inset=$this->insertDataTable('order_upfront_tracking',$insertData);
                if($inset){
                    $update = $this->db->query("update zy_driver_order set driver_order_status = '2' where driver_order_id= '" . $data['driver_order_id'] . "'");
                    return true;
                }else{
                    return false;
                }
            }elseif($data['driver_order_type']==2){
                $insertData=array(
                    'order_id'              => $data['order_id'],
                    'driver_id'             => $data['driver_id'],
                    'vendor_tracking_id'    => $data['driver_tracking_id'],
                    'vendor_status'         => $data['upfront_status'],
                    'vendor_tracking_created_at'  => date('Y-m-d H:i:s'),
                );
                $inset=$this->insertDataTable('order_vendor_tracking',$insertData);
                if($inset){
                    $update = $this->db->query("update zy_driver_order set driver_order_status = '2' where driver_order_id= '" . $data['driver_order_id'] . "'");
                    return true;
                }else{
                    return false;
                }
            }elseif($data['driver_order_type']==3){
                $insertData=array(
                    'order_id'              => $data['order_id'],
                    'driver_id'             => $data['driver_id'],
                    'drop_tracking_id'      => $data['driver_tracking_id'],
                    'drop_status'           => $data['upfront_status'],
                    'drop_tracking_created_at'  => date('Y-m-d H:i:s'),
                );
                $inset=$this->insertDataTable('order_drop_tracking',$insertData);
                if($inset){
                    $update = $this->db->query("update zy_driver_order set driver_order_status = '2' where driver_order_id= '" . $data['driver_order_id'] . "'");
                    return true;
                }else{
                    return false;
                }
            }elseif($data['driver_order_type']==4){
                $insertData=array(
                    'order_id'              => $data['order_id'],
                    'driver_id'             => $data['driver_id'],
                    'international_tracking_id'      => $data['driver_tracking_id'],
                    'international_status'           => $data['upfront_status'],
                    'international_tracking_created_at'  => date('Y-m-d H:i:s'),
                );
                $inset=$this->insertDataTable('order_international_tracking',$insertData);
                if($inset){
                    $update = $this->db->query("update zy_driver_order set driver_order_status = '2' where driver_order_id= '" . $data['driver_order_id'] . "'");
                    return true;
                }else{
                    return false;
                }
            }elseif($data['driver_order_type']==5){
                $insertData=array(
                    'order_id'              => $data['order_id'],
                    'driver_id'             => $data['driver_id'],
                    'return_tracking_id'      => $data['driver_tracking_id'],
                    'return_status'           => $data['upfront_status'],
                    'return_tracking_created_at'  => date('Y-m-d H:i:s'),
                );
                $inset=$this->insertDataTable('order_return_tracking',$insertData);
                if($inset){
                    $update = $this->db->query("update zy_driver_order set driver_order_status = '2' where driver_order_id= '" . $data['driver_order_id'] . "'");
                    return true;
                }else{
                    return false;
                }
            }elseif($data['driver_order_type']==6){
                $insertData=array(
                    'order_id'              => $data['order_id'],
                    'driver_id'             => $data['driver_id'],
                    'return_drop_tracking_id'      => $data['driver_tracking_id'],
                    'return_drop_status'           => $data['upfront_status'],
                    'return_drop_tracking_created_at'  => date('Y-m-d H:i:s'),
                );
                $inset=$this->insertDataTable('order_return_drop_tracking',$insertData);
                if($inset){
                    $update = $this->db->query("update zy_driver_order set driver_order_status = '2' where driver_order_id= '" . $data['driver_order_id'] . "'");
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function completeMyJob($data){
        $where='driver_order.driver_id="'.$data['driver_id'].'" and driver_order.driver_order_id="'.$data['driver_order_id'].'" and driver_order.order_id="'.$data['order_id'].'"';
        $order = $this->db->select("driver_order.*,o.upfront_amount as amount,o.address_id")
                        ->where($where)
                        ->join("orders as o", "o.order_id=driver_order.order_id")
                        ->get("driver_order")->row_array();
                        // echo $this->db->last_query();exit;
                        //print_r($order);exit;
        if($order){
            $update = $this->db->query("update zy_driver_order set driver_order_status = '3' where driver_order_id= '" . $data['driver_order_id'] . "'");
            if($update){
                //////////////////////////////////////////////////////////
                // $driver_order   = $this->getSingleDataRow('driver_order','driver_order_id="'.$data['driver_order_id'].'" ');
                // if($driver_order){
                //     if($driver_order['driver_order_type']==2){
                //         $update = $this->db->query("update zy_order_items set is_in_hub = '1' where order_id= '" . $data['order_id'] . "' and driver_id='".$data['driver_id']."' and vendor_tracking_id='".$driver_order['driver_tracking_id']."'");
                //     }
                // }
                /////////////////////////////////////////////////////////////////////
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    
    
    function activeOrderList($data){
        
        $where='driver_order.driver_id="'.$data['driver_id'].'" and (driver_order.driver_order_status=1 or driver_order.driver_order_status=2 or driver_order.driver_order_status=3)';
        $recentOrder = $this->db->select("driver_order.*,o.upfront_amount as amount,o.address_id")
                        ->where($where)
                        ->join("orders as o", "o.order_id=driver_order.order_id")
                        ->order_by('driver_order.driver_order_id', 'DESC')
                        ->get("driver_order")->result_array();
        $recentOrderArr=array();
        if($recentOrder){
            foreach($recentOrder as $order){
                if($order['driver_order_type']==1){
                    $getOrders   = $this->getSingleDataRow('orders','order_id="'.$order['order_id'].'" ');
                    if($getOrders){
                        $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
                        if($user_address){
                            $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['geo_address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                        }else{
                            $order['user_address']=new stdClass();
                        }
                    }
                }elseif($order['driver_order_type']==2){
                    $totalAmt=0;
                    $getOrders   = $this->getTableDataArray('order_items','order_id="'.$order['order_id'].'" and (vendor_tracking_id="'.$order['driver_tracking_id'].'") ');
                    if($getOrders){
                        foreach($getOrders as $odr){
                            $totalAmt=$totalAmt+$odr['total'];
                        }
                    }
                    $order['amount']=$totalAmt;
                    if(isset($getOrders[0]['vendor_id']) and $getOrders[0]['vendor_id']){
                        $user_address   = $this->getSingleDataRow('vendor','vendor_id="'.$getOrders[0]['vendor_id'].'" ');
                        if($user_address){
                            $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                        }else{
                            $order['user_address']=new stdClass();
                        }
                    }else{
                        $order['user_address']=new stdClass();
                    }
                }elseif($order['driver_order_type']==3){
                    $totalAmt=0;
                    $getOrders   = $this->getTableDataArray('order_items','order_id="'.$order['order_id'].'" and (drop_tracking_id="'.$order['driver_tracking_id'].'") ');
                    if($getOrders){
                        foreach($getOrders as $odr){
                            $totalAmt=$totalAmt+$odr['total'];
                        }
                    }
                    $order['amount']=$totalAmt;
                    $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
                    if($user_address){
                        $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['geo_address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                    }else{
                        $order['user_address']=new stdClass();
                    }
                }
                array_push($recentOrderArr,$order);
            }
            return array('recent_order'=>$recentOrderArr);
        }else{
            return false;
        }
    }

    function pastOrderList($data){
        
        $where='driver_order.driver_id="'.$data['driver_id'].'" and (driver_order.driver_order_status=4)';
        $recentOrder = $this->db->select("driver_order.*,o.upfront_amount as amount,o.address_id")
                        ->where($where)
                        ->join("orders as o", "o.order_id=driver_order.order_id")
                        ->order_by('driver_order.driver_order_id', 'DESC')
                        ->get("driver_order")->result_array();
        $recentOrderArr=array();
        if($recentOrder){
            foreach($recentOrder as $order){
                if($order['driver_order_type']==1){
                    $getOrders   = $this->getSingleDataRow('orders','order_id="'.$order['order_id'].'" ');
                    if($getOrders){
                        $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
                        if($user_address){
                            $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['geo_address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                        }else{
                            $order['user_address']=new stdClass();
                        }
                    }
                }elseif($order['driver_order_type']==2){
                    $totalAmt=0;
                    $getOrders   = $this->getTableDataArray('order_items','order_id="'.$order['order_id'].'" and (vendor_tracking_id="'.$order['driver_tracking_id'].'") ');
                    if($getOrders){
                        foreach($getOrders as $odr){
                            $totalAmt=$totalAmt+$odr['total'];
                        }
                    }
                    $order['amount']=$totalAmt;
                    if(isset($getOrders[0]['vendor_id']) and $getOrders[0]['vendor_id']){
                        $user_address   = $this->getSingleDataRow('vendor','vendor_id="'.$getOrders[0]['vendor_id'].'" ');
                        if($user_address){
                            $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                        }else{
                            $order['user_address']=new stdClass();
                        }
                    }else{
                        $order['user_address']=new stdClass();
                    }
                }elseif($order['driver_order_type']==3){
                    $totalAmt=0;
                    $getOrders   = $this->getTableDataArray('order_items','order_id="'.$order['order_id'].'" and (drop_tracking_id="'.$order['driver_tracking_id'].'") ');
                    if($getOrders){
                        foreach($getOrders as $odr){
                            $totalAmt=$totalAmt+$odr['total'];
                        }
                    }
                    $order['amount']=$totalAmt;
                    $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
                    if($user_address){
                        $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['geo_address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                    }else{
                        $order['user_address']=new stdClass();
                    }
                }elseif($order['driver_order_type']==4){
                    $totalAmt=0;
                    $order['amount']=$totalAmt;
                    $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
                    if($user_address){
                        $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['geo_address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                    }else{
                        $order['user_address']=new stdClass();
                    }
                }
                array_push($recentOrderArr,$order);
            }
            return array('recent_order'=>$recentOrderArr);
        }else{
            return false;
        }
    }

    function returnOrderList($data){
        
        $where='driver_order.driver_id="'.$data['driver_id'].'" and (driver_order.driver_order_status=5554)';
        $recentOrder = $this->db->select("driver_order.*,o.upfront_amount as amount,o.address_id")
                        ->where($where)
                        ->join("orders as o", "o.order_id=driver_order.order_id")
                        ->order_by('driver_order.driver_order_id', 'DESC')
                        ->get("driver_order")->result_array();
        $recentOrderArr=array();
        if($recentOrder){
            foreach($recentOrder as $order){
                if($order['driver_order_type']==1){
                    $getOrders   = $this->getSingleDataRow('orders','order_id="'.$order['order_id'].'" ');
                    if($getOrders){
                        $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
                        if($user_address){
                            $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['geo_address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                        }else{
                            $order['user_address']=new stdClass();
                        }
                    }
                }elseif($order['driver_order_type']==2){
                    $totalAmt=0;
                    $getOrders   = $this->getTableDataArray('order_items','order_id="'.$order['order_id'].'" and (vendor_tracking_id="'.$order['driver_tracking_id'].'") ');
                    if($getOrders){
                        foreach($getOrders as $odr){
                            $totalAmt=$totalAmt+$odr['total'];
                        }
                    }
                    $order['amount']=$totalAmt;
                    if(isset($getOrders[0]['vendor_id']) and $getOrders[0]['vendor_id']){
                        $user_address   = $this->getSingleDataRow('vendor','vendor_id="'.$getOrders[0]['vendor_id'].'" ');
                        if($user_address){
                            $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                        }else{
                            $order['user_address']=new stdClass();
                        }
                    }else{
                        $order['user_address']=new stdClass();
                    }
                }elseif($order['driver_order_type']==3){
                    $totalAmt=0;
                    $getOrders   = $this->getTableDataArray('order_items','order_id="'.$order['order_id'].'" and (drop_tracking_id="'.$order['driver_tracking_id'].'") ');
                    if($getOrders){
                        foreach($getOrders as $odr){
                            $totalAmt=$totalAmt+$odr['total'];
                        }
                    }
                    $order['amount']=$totalAmt;
                    $user_address   = $this->getSingleDataRow('user_address','address_id="'.$order['address_id'].'" ');
                    if($user_address){
                        $order['user_address']=array('name'=>$user_address['name'],'address'=>$user_address['geo_address'],'lat'=>$user_address['lat'],'lng'=>$user_address['lng']);
                    }else{
                        $order['user_address']=new stdClass();
                    }
                }
                array_push($recentOrderArr,$order);
            }
            return array('recent_order'=>$recentOrderArr);
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