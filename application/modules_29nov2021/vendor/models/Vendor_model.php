<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_model extends CI_Model {

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

    function sendAndroidPush($deviceToken, $msg) {
        $registrationIDs = $deviceToken;
        $message = $msg;
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'to' => $registrationIDs,
            'data' => array("msg" => $message)
        );
        $headers = array(
            "Authorization: key=AAAAo0ntOwY:APA91bFfvL-SXk1KhZGqgzMkXuR44RFdbCfwPklt1HSeWirqA8W9v9VAyJAg8ATaoL1NJygPIejw7uxVhNMezmCsVXBn0zJvhu1Kqd0qJXnZAmLFStT43q12GrgWexDZHZgX474Zemp-",
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

    function sendIosPush($deviceToken, $msg_data) {
        $deviceToken = $deviceToken; //  iPad 5s Gold prod
        ///$deviceToken = ''; //  iPad 5s Gold prod
        $passphrase = '12345';

        $msg = $msg_data;
        $message = $msg;
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'apns_cert/ck_production.pem'); // Pem file to generated // openssl pkcs12 -in pushcert.p12 -out pushcert.pem -nodes -clcerts // .p12 private key generated from Apple Developer Account
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
    
    function emailPushBooking($to, $title, $subject, $data) {
        
        ///////////////////////SENDGRID///////////////////
        require 'vendor/autoload.php';
        
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("dev.zanomy@gmail.com", $title);
        $email->setSubject($subject);
        $email->addTo($to, "New Order");
        // $email->addContent("text/plain", "Your OTP IS : ".$otp);
        $email->addContent(
            "text/html", $this->load->view('email/email.php',$data,TRUE)
        );
        $sendgrid = new \SendGrid('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');
        if($sendgrid->send($email)){
            return "success";
        }else{
            return "fail";
        }exit;
        // exit;
        // try {
        //     echo '<pre/>';
        //     $response = $sendgrid->send($email);
        //     print $response->statusCode() . "\n";
        //     print_r($response->headers());
        //     print $response->body() . "\n";
        // } catch (Exception $e) {
        //     echo 'Caught exception: '. $e->getMessage() ."\n";
        // }
        ///////////////////////SENDGRID///////////////////

        
       
    }

    public function deleteData($table, $fname, $id) {
        $this->db->where($fname, $id);
        $this->db->delete($table);
        return true;
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

    function get_category() {
        $query = $this->db->get('category');
        return $query;
    }

    function get_sub_category($category_id) {
        $query = $this->db->get_where('category', array('subcategory_category_id' => $parent_id));
        return $query;
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

    function getcategoryAttribute($subCategoryId) {
        $getAttributeArr = array();
        $categoryAttr = $this->getData(['sub_category_id' => $subCategoryId, 'type' => 1, 'status' => 1], 'category_attribute', '', '', '');
        if ($categoryAttr) {
            foreach ($categoryAttr as $value) {
                $val = $value['id'];
                $categoryAttrVal = $this->getData(['attribute_id' => $val], 'category_attribute_value', '', '', '');
                $value['attribute_value'] = $categoryAttrVal;
                array_push($getAttributeArr, $value);
            }
            return $getAttributeArr;
        } else {
            return false;
        }
    }

    function getcategorySpecification($subCategoryId) {
        $getAttributeArr = array();
        $categoryAttr = $this->getData(['sub_category_id' => $subCategoryId, 'type' => 2, 'status' => 1], 'category_attribute', '', '', '');
        //echo '<pre>';print_r($categoryAttr);exit;
        if ($categoryAttr) {
            return $categoryAttr;
        } else {
            return false;
        }
    }

    function getProductFeatures($condition) {
        $featureAttr = $this->db->where($condition)->select('product_attribute.*,category_attribute.title,category_attribute_value.value')->join('category_attribute', 'category_attribute.id=product_attribute.attribute_id')->join('category_attribute_value', 'category_attribute_value.id=product_attribute.attribute_value_id')->from('product_attribute')->get()->result_array();
        //echo '<pre>';print_r($categoryAttr);exit;
        if ($featureAttr) {
            return $featureAttr;
        } else {
            return false;
        }
    }

    function getProductSpecification($condition) {
        $featureAttr = $this->db->where($condition)->select('product_specification.*,category_attribute.title')->join('category_attribute', 'category_attribute.id=product_specification.attribute_id')->from('product_specification')->get()->result_array();
        //echo '<pre>';print_r($categoryAttr);exit;
        if ($featureAttr) {
            return $featureAttr;
        } else {
            return false;
        }
    }

    public function getDataResultArray($table, $where, $order) {
        if ($where) {
            $this->db->where($where);
        }
        if ($order) {
            $this->db->order_by($order, 'DESC');
        }
        $query = $this->db->get($table);
        $result = $query->result_array();
        //echo "<pre>"; print_r($this->db->last_query());exit;
        return ($result);
    }

    public function getDataResultRow($table, $where) {
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        $result = $query->row_array();
        return ($result);
    }

    function getBooking($condition) {
        $booking = $this->db->select('b.*,u.name as user_name,u.email,u.country_code,u.mobile,s.name as service_name,s.name_ar as service_name_ar,s.image as service_image,c.name as category_name,c.name_ar as category_name_ar')
                ->where($condition)
                ->from('service_booking b')
                ->join('users u', 'u.user_id=b.user_id')
                ->join('service s', 's.service_id=b.service_id')
                ->join('service_category c', 's.category_id=c.category_id')
                ->order_by('booking_id', 'DESC')
                ->get();

        return $booking;
    }

    function getOrder($condition) {
        $orderList = [];
        $getOrders = $this->db->select('Distinct(order_id)')->where(['vendor_id' => $condition['vendor_id'], 'item_action!=' => 0])->order_by('order_id', 'DESC')->get('order_items')->result_array();
        if ($getOrders) {
            foreach ($getOrders as $vendor_order) {
                $condition['order_id'] = $vendor_order['order_id'];
                $vendor_order = $this->orderDetail($condition);
                array_push($orderList, $vendor_order);
            }
        }
        return $orderList;
    }

    function orderDetail($vendor_id,$order_id) {
        // $getOrder = $this->getRowData(['order_id' => $condition['order_id'], 'status!=' => 0], 'orders');
        $getOrder = $this->db->select("vendor_order.*,o.status,o.payment_type,o.user_status,o.user_id,o.address_id")
                        ->where("vendor_order.vendor_id", $vendor_id)
                        ->where("vendor_order.order_id", $order_id)
                        ->where("o.status", 1)
                        ->join("orders as o", "o.order_id=vendor_order.order_id")
                        ->get("vendor_order")->row_array();
        if ($getOrder) {
            $getOrderItems = [];
            $orderItems = $this->db->select('ot.*,p.name as product_name,c.name as category_name,p.name_ar as product_name_ar,c.name_ar as category_name_ar')->where(['order_id' => $order_id, 'ot.vendor_id' => $vendor_id])->from('order_items ot')->join('products p', 'ot.product_id=p.product_id')->join('product_category c', 'p.category_id=c.category_id')->order_by('item_id', 'DESC')->get()->result_array();
            foreach ($orderItems as $items) {
                $getItem = $this->getRowData(['item_id' => $items['item_id'], 'product_id' => $items['product_id']], 'product_attribute_group');
                if ($getItem['images']) {
                    $images = explode(',', $getItem['images']);
                    if ($images) {
                        $getImage = $this->db->select('CONCAT(file_path,file_name) as image')->where(['product_images_id' => $images[0]])->get('product_images')->row_array();
                        if ($getImage) {
                            $items['image'] = $getImage['image'];
                        } else {
                            $items['image'] = '';
                        }
                    } else {
                        $items['image'] = '';
                    }
                } else {
                    $items['image'] = '';
                }
                array_push($getOrderItems, $items);
            }
            $vendor_order = $getOrder;
            $vendor_order['order_items'] = $getOrderItems;
            $vendor_order['items_count'] = count($getOrderItems);
            $items_total = $this->db->select('SUM(total) as total,SUM(discount) as discount')->where(['order_id' => $order_id, 'vendor_id' => $vendor_id])->get('order_items')->row_array();
            $vendor_order['discount'] = $items_total['discount'];
            $vendor_order['items_total'] = $items_total['total'];
            $user = $this->getRowData(['user_id' => $getOrder['user_id']], 'users');
            $address = $this->db->select('u.*,c.name as country_name,ct.name as city_name')->where(['user_id' => $getOrder['user_id'], 'address_id' => $getOrder['address_id']])->from('user_address u')->join('city ct', 'u.city_id=ct.city_id')->join('country_code c', 'u.country_id=c.country_code_id')->get()->row_array();
            $vendor_order['user_detail'] = $user;
            $vendor_order['shipping_detail'] = $address;
            return $vendor_order;
        } else {
            return false;
        }
    }
    
        function setFilterAttributes($param) {
        $returnArr=['sub_category_list'=>[],'brand_list'=>[],'model_list'=>[]];
        $subcategoryList = $this->Vendor_model->getDataResultArray('product_sub_category', 'status=1 and category_id="' . $param['category_id'] . '"', 'sub_category_id');
        if ($subcategoryList) {
            $returnArr['sub_category_list'] = $subcategoryList;
        }
        if (isset($_POST['sub_category_id']) && $_POST['sub_category_id']) {
            $brandList = array();
            $query = $this->Vendor_model->getDataResultArray('brand_mapping', 'status=1 and category_id="' . $param['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '"', 'brand_mapping_id');
            if ($query) {
                foreach ($query as $val) {
                    $brand = $this->Vendor_model->getDataResultRow('brand', 'status=1 and brand_id="' . $val['brand_id'] . '" ', 'brand_mapping_id');
                    if ($brand) {
                        $val['name'] = $brand['name'];
                        array_push($brandList, $val);
                    }
                }
            }
            if ($brandList) {
                $returnArr['brand_list'] = $brandList;
            }
        }

        if (isset($_POST['brand_id']) && $_POST['brand_id']) {
            $modelList = array();
            $query = $this->Vendor_model->getDataResultArray('model_mapping', 'status=1 and brand_mapping_id="' . $_POST['brand_id'] . '"', 'model_mapping_id');
            if ($query) {
                foreach ($query as $val) {
                    $res = $this->Vendor_model->getDataResultRow('model', 'status=1 and model_id="' . $val['model_id'] . '"');
                    if ($res) {
                        $val['name'] = $res['name'];
                        array_push($modelList, $val);
                    }
                }
            }
            if ($modelList) {
                $returnArr['model_list'] = $modelList;
            }
        }
        return $returnArr;
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

    function remove_special_character($string) {
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        return $string;
    }

}

?>