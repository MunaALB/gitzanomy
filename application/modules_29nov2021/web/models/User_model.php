<?php

// require 'aws/aws-autoloader.php';

// use Aws\S3\S3Client;

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper('custom_helper');
    }

    public function vendor_login($email, $password) {
        $email = $email;
        $password = md5($password); //change hash function
        $return = $this->db->where(['email' => $email, 'password' => $password])->get('vendor');
        // echo $this->db->last_query();
        if ($return->num_rows()) {
            return $return->row_array();
        } else {
            return FALSE;
        }
    }

    public function addData($table, $insertArr) {
        $query = $this->db->insert($table, $insertArr);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    public function getData($condition, $table, $limit, $order, $sort) {
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->where($condition)
                ->order_by($order, $sort)
                ->get($table);
        return $query->result_array();
    }

    function deleteDataTable($table, $where) {
        $results = $this->db->where($where)
                ->delete($table);
        if ($results) {
            return true;
        } else {
            return false;
        }
    }

    public function getRowData($condition, $table) {

        $query = $this->db->where($condition)
                ->get($table);

        return $query->row_array();
    }

    public function updateData($condition, $table, $updateArr) {
        $this->db->where($condition);
        $query = $this->db->update($table, $updateArr);
        //  echo $this->db->last_query();
        if ($query) {
            return $this->db->get_where($table, $condition)->row_array();
        } else {
            return array();
        }
    }

    function getSingleDataRow($table, $where) {
        if ($where) {
            $this->db->where($where);
        }
        $getEventTag = $this->db->get($table)->row_array();
        return $getEventTag;
    }

    function getTableDataArray($table, $where) {
        if ($where) {
            $this->db->where($where);
        }
        $getEventTag = $this->db->get($table)->result_array();
        return $getEventTag;
    }

    function getTableDataArrayLimit($table, $where, $limit, $start) {
        if ($where) {
            $this->db->where($where);
        }
        if ($limit) {
            $this->db->limit(10, 0);
        }
        $getEventTag = $this->db->get($table)->result_array();
        return $getEventTag;
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

    function upload_file($x, $user_id) {
        $errors = array();
        $file_ext = explode('.', $_FILES[$x]['name']);
        $file_extLen = count($file_ext) - 1;
        $file_name = $this->my_random_string($file_ext[0]) . time() . '.' . $file_ext[$file_extLen];
        $file_tmp = $_FILES[$x]['tmp_name'];
        $file_name = urlencode($file_name);
        $uploadPath = 'uploads/user/';

//        $folder_name = "./uploads/user/";

        if (empty($errors) == true) {
//            $data = move_uploaded_file($file_tmp, $folder_name . $file_name);
//            if ($data) {
//                $arr['image'] = base_url() . "uploads/user/" . $file_name;
//                //print_r($arr);exit;
//                $this->db->where('user_id', $user_id);
//                $this->db->update('users', $arr);
//                return base_url() . "uploads/user/" . $file_name;
//            }


            $reponse = uploadToS3($file_tmp, $file_name, $uploadPath);
            if ($reponse) {
                if (isset($reponse['imagepath']) && $reponse['imagepath']) {
                    $arr['image'] = 'https://zanomy.s3.us-east-2.amazonaws.com/user/' . $file_name;
                    //print_r($arr);exit;
                    $this->db->where('user_id', $user_id);
                    $this->db->update('users', $arr);
                    return 'https://zanomy.s3.us-east-2.amazonaws.com/user/' . $file_name;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function requestDetail($data) {
        $allRequest = $this->db->select("request.*,u.name,u.image")
                        ->where("request.request_id", $data['request_id'])
                        ->where("request.agent_id", $data['agent_id'])
                        ->join("users as u", "request.user_id=u.user_id")
                        ->get("request")->row_array();
        if ($allRequest) {
            return $allRequest;
        } else {
            return false;
        }
    }

    function payTabs($path, $bodyData) {

        $url = $path;
        //intialize cURL and send POST data
        $ch = @curl_init();
        @curl_setopt($ch, CURLOPT_POST, true);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyData);
        @curl_setopt($ch, CURLOPT_URL, $url);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $myvar = @curl_exec($ch);
        curl_close($ch);
        //echo '<pre/>';print_r($myvar);exit;
        return $myvar;
    }

}

?>