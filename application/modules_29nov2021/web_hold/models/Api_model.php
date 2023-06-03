<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function apiCallHeader($path, $headerData, $bodyData) {
        $headers = array("user-id:".$headerData['user_id'],"Lang:" . $headerData['lang'], "DeviceId:" . $headerData['device_id'], "SecurityToken:" . $headerData['security_token'], "Content-Type:multipart/form-data");
        $url = base_url() . "user/" . $path;
       //$url = "http://auctionbuy.in/menzil_info/apiAgent/" . $path;
        //intialize cURL and send POST data
        $ch = @curl_init();
        @curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyData);
        @curl_setopt($ch, CURLOPT_URL, $url);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $myvar = @curl_exec($ch);
        curl_close($ch);
            //  echo '<pre/>';print_r($myvar);
        return $myvar;
    }

    function apiCall($path, $strPost) {
        $headers = array("Content-Type:multipart/form-data");
        $url = base_url() . "user/" . $path;
        //$url = "http://auctionbuy.in/menzil_info/apiAgent/" . $path;
        //intialize cURL and send POST data
        $ch = @curl_init();
        @curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $strPost);
        @curl_setopt($ch, CURLOPT_URL, $url);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $myvar = @curl_exec($ch);
        curl_close($ch);
//        echo '<pre/>';print_r($myvar);exit;
        return $myvar;
    }
    
    function getAddressWithCordinates($strPost) {
        $headers = array("Content-Type:multipart/form-data");
//        $url = base_url() . "user/" . $path;
         $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$strPost['latitude'].",".$strPost['longitude']."&sensor=true&key=AIzaSyCzPCjYZGjfQyRKanR7NMOyxmRAJIS0A-Y";
        //intialize cURL and send POST data
        $ch = @curl_init();
        @curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $strPost);
        @curl_setopt($ch, CURLOPT_URL, $url);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $myvar = @curl_exec($ch);
        curl_close($ch);
//        echo '<pre/>';print_r($myvar);exit;
        return $myvar;
    }

    function apiCallJSON($path, $strPost) {
        $url = base_url() . "user/" . $path;
        $ch = curl_init($url);
        $payload = $strPost;
        //print_r($payload);exit;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
        $url = base_url() . "user/" . $path;
        //intialize cURL and send POST data
        $ch = @curl_init();
        @curl_setopt($ch, CURLOPT_POST, true);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $strPost);
        @curl_setopt($ch, CURLOPT_URL, $url);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $myvar = @curl_exec($ch);
        curl_close($ch);
        return $myvar;
    }
    
    
    
    function getSingleDataRow($table,$where){
        if($where){ $this->db->where($where); }
        $getEventTag = $this->db->get($table)->row_array();
        return $getEventTag;
    }
    
    function sendMessage($data) {
        $getConversation = $this->db->query("SELECT c_id  FROM af_conversation  WHERE  (user_id='" . $data['user_id'] . "' AND vendor_id='" . $data['vendor_id'] . "')")->row_array();
        //print_r($getConversation);exit;
        $sender_id=$data['sender_id'];unset($data['sender_id']);
        $user_type=$data['user_type'];unset($data['user_type']);
        if ($getConversation) {
            $updated_at = array('updated_at' => strtotime(date('Y-m-d H:i:s')));
            $this->db->where('c_id', $getConversation['c_id']);
            $this->db->update('conversation', $updated_at);
            $reply = array('sender_id' => $sender_id,'user_type'=>$user_type, 'reply' => $data['message'], 'created_at' => strtotime(date('Y-m-d H:i:s')), 'c_id_fk' => $getConversation['c_id']);
            $conversation_reply = $this->db->insert('conversation_reply', $reply);
            $reply_insert_id = $this->db->insert_id();
        } else {
            $doc = array('user_id' => $data['user_id'], 'vendor_id' => $data['vendor_id'], 'created_at' => strtotime(date('Y-m-d H:i:s')), 'updated_at' => strtotime(date('Y-m-d H:i:s')));
            $conversation = $this->db->insert('conversation', $doc);
            $insert_id = $this->db->insert_id();
            $reply = array('sender_id' => $sender_id,'user_type'=>$user_type, 'reply' => $data['message'], 'created_at' => strtotime(date('Y-m-d H:i:s')), 'c_id_fk' => $insert_id);
            $conversation_reply = $this->db->insert('conversation_reply', $reply);
            $reply_insert_id = $this->db->insert_id();
        }
        if ($conversation_reply) {
        $getConversationList = $this->db->query("SELECT R.cr_id,R.created_at,R.reply as message,R.sender_id,R.user_type,R.c_id_fk  as c_id FROM af_conversation_reply R WHERE  R.cr_id='" . $reply_insert_id . "' ORDER BY R.cr_id ASC LIMIT 20")->row_array();
            return array('last_message'=>$getConversationList);
        } else {
            return false;
        }
    }
    
    
    function getMessageList($data){
        $messageListArr=array();
        $this->db->select('c_id,user_id,vendor_id');
        $this->db->where('vendor_id',$data['vendor_id']);
        $conversation = $this->db->get('conversation')->result_array();
        if($conversation){
            foreach($conversation as $value){
                $this->db->where('c_id_fk',$value['c_id']);
                $this->db->limit(1,0);
                $this->db->order_by('cr_id','DESC');
                $conversation_reply = $this->db->get('conversation_reply')->row_array();
                $value['message']=$conversation_reply['reply'];
                $value['created_at']=$conversation_reply['created_at'];
                $value['user_type']=$conversation_reply['user_type'];
                $users=$this->getSingleDataRow('users','id="'.$value['user_id'].'"');
                $vendor=$this->getSingleDataRow('vendor','id="'.$value['vendor_id'].'"');
                $value['user_name']=$users['name'];
                $value['email']=$users['email'];
                $value['mobile']=$users['mobile'];
                $value['vendor_name']=$vendor['name'];
                array_push($messageListArr,$value);
            }
            return array('message_list'=>$messageListArr);
        }else{
            return false;
        }
    }
    
    function getMessageDetail($data) {
        $user_id = $data['user_id'];
        $getConversationListArr = array();
//        $getConversationList = $this->db->query("SELECT R.cr_id,R.created_at,R.reply as message,R.user_id_fk,U.id as user_id,U.full_name,U.email,U.profile_image FROM user U, conversation_reply R WHERE R.user_id_fk=U.id and (NOT FIND_IN_SET('$user_id', delete_chat_user)) and R.c_id_fk='" . $data['c_id'] . "' ORDER BY R.cr_id DESC LIMIT " . $data['start'] . ",50")->result_array();
        ///print_r($getConversationList);exit;
        $getConversation = $this->db->query("SELECT c_id  FROM af_conversation  WHERE  (user_id='" . $data['user_id'] . "' AND vendor_id='" . $data['vendor_id'] . "')")->row_array();
        if($getConversation){
            $this->db->where('c_id_fk',$getConversation['c_id']);
            $this->db->order_by('cr_id','ASC');
            $getConversationList = $this->db->get('conversation_reply')->result_array();
            if($getConversationList){
                foreach($getConversationList as $value){
                    
                    $users=$this->getSingleDataRow('users','id="'.$data['user_id'].'"');
                    $vendor=$this->getSingleDataRow('vendor','id="'.$data['vendor_id'].'"');
                    $value['user_name']=$users['name'];
                    $value['vendor_name']=$vendor['name'];
                    
                    $value['user_image']=$users['image'];
                    $value['vendor_image']=$vendor['image'];
                    
                    $value['message']=$value['reply'];unset($value['reply']);
                    if ($value['sender_id'] == $data['user_id']) {
                         $value['is_sender'] = '1';
                    }else {
                        $value['is_sender'] = '0';
                    }
                    array_push($getConversationListArr, $value);
                }
                return array('message_data'=>$getConversationListArr);
            }else {
                return false;
            }
        }else{
            return false;
        }
    }
    
    

}
