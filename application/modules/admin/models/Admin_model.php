<?php

class Admin_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    function apiCallHeader($path, $headerData, $bodyData) {
        $headers = array("user-id:".$headerData['user_id'],"Lang:" . $headerData['lang'], "DeviceId:" . $headerData['device_id'], "SecurityToken:" . $headerData['security_token'], "Content-Type:multipart/form-data");
        $url = base_url() . "driver/" . $path;
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
    

    function emailPushOrder($to, $title, $subject, $data) {
        
        ///////////////////////SENDGRID///////////////////
        require 'vendor/autoload.php';
        
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("dev.zanomy@gmail.com", $title);
        $email->setSubject($subject);
        $email->addTo($to, "New Order");
        // $email->addContent("text/plain", "Your OTP IS : ".$otp);
        $email->addContent(
            "text/html", $this->load->view('email/updateorder.php',$data,TRUE)
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

        //echo '<pre/>';print_r($data);exit;
        
        
       
    }

    public function order_detail_email($email,$order_id,$pushData,$users) {
        //$users	=   $this->getDataResultRow('users','user_id="'.$uploadImage['user_id'].'"');
        $pushData['users']=$users;
        $pushData['order_id']=$order_id;

        if($pushData['type']=='new_order'){
            $this->emailPushOrder($email, 'Zanomy', "Zanomy New Order", ['heading' => 'New Order', 'body' =>$pushData ]);
        }elseif($pushData['type']=='new_order'){
            $this->emailPushOrder($email, 'Zanomy', "Zanomy Inprocess Order", ['heading' => 'Inprocess Order', 'body' =>$pushData ]);
        }else{
            $this->emailPushOrder($email, 'Zanomy', "Zanomy Complete Order", ['heading' => 'Complete Order', 'body' =>$pushData ]);
        }
        
        return true;
    }
    
    public function admin_login($email, $password) {
//        $password = md5($password);
        $return = $this->db->where(['email' => $email, 'password' => $password])->get('admin');
//        print_r($return);exit;
        if ($return->num_rows()) {
            $result = $return->row_array();
            if ($result['status'] == 1) {
                return $result;
            } else {
                return ['error_type' => 201];
            }
        } else {
            return FALSE;
        }
    }

    public function check_privilege($param) {
        $url = $this->uri->segment(2);
        $type = 0;
        $privilege_menu = $this->db->where('sub_menu_title', $url)->get('privilege_submenu')->row_array();
        if ($privilege_menu) {
            $type = $privilege_menu['type'];
        }
        $subadmin = $this->db->where(['id' => $param['id'], 'status' => 1])->get('admin')->row_array();
        if ($subadmin) {
            if ($subadmin['privilege']) {
                $privilege = explode(',', trim($subadmin['privilege'], ','));
            } else {
                $privilege = [];
            }
            if (in_array($type, $privilege)) {
                return 2;
            } else {
                return 1;
            }
        } else {
            return 0;
        }
    }

    public function admin_login_22_06($email, $password) {
        $password = md5($password);
        $return = $this->db->where(['email' => $email, 'password' => $password])->get('admin');
        //print_r($return);exit;
        if ($return->num_rows()) {
            return $return->row_array();
        } else {
            return FALSE;
        }
    }

    public function getpassword() {
        $this->db->select('*');
        $this->db->from('admin');
        //print_r($_POST);exit();
        $this->db->where(array('password' => md5($_POST['password'])));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getpropertytype() {
        $this->db->select('*');
        $this->db->from($_POST['table']);
        $this->db->where(array('name' => $_POST['english']));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getDataByorderlimit($table, $where = '', $order_by="", $limit=100) {


        $this->db->order_by($order_by, 'DESC');

        if ($where) {
            $this->db->where($where);
        }
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->get($table);
        $result = $query->result_array();
        return ($result);
    }

    public function insertData($table, $data) {
        $this->db->insert($table, $data);
        $result = $this->db->insert_id();
        return $result;
    }

    public function update_data($data) {
        extract($data);
        $this->db->where('user_id', $user_id);
        $query = $this->db->update('user_help_support', array('reply' => $reply));
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function update_data_agent($data) {
        extract($data);
        $this->db->where('agent_id', $agent_id);
        $query = $this->db->update('agent_help_support', array('reply' => $reply));
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function insert($data = array()) {
        $insert = $this->db->insert_batch('files', $data);
        return $insert ? true : false;
    }

    public function getDataByorder($table, $order_by, $where = '') {

        if ($order_by) {
            $this->db->order_by($order_by, 'DESC');
        }
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        $result = $query->result();
        return ($result);
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

    function getTableDataArrayOrderBy($table, $where, $orderBY) {
        $this->db->where($where);
        $this->db->order_by($orderBY, 'DESC');
        $getEventTag = $this->db->get($table)->result_array();
        return $getEventTag;
    }

    public function getDataResultArrayGroupBy($table, $where, $order, $groupby) {
        if ($where) {
            $this->db->where($where);
        }
        if ($order) {
            $this->db->order_by($order, 'DESC');
        }
        if ($groupby) {
            $this->db->broup_by($groupby);
        }
        $query = $this->db->get($table);
        $result = $query->result_array();
        //echo "<pre>"; print_r($this->db->last_query());exit;
        return ($result);
    }

    public function getDataResultArray1($table) {
        $query = $this->db->get($table);
        $result = $query->result_array();
        return ($result);
    }

    public function getDataResultArrayorderby($table, $where, $order_by) {
        if ($where) {
            $this->db->where($where);
        }
        $this->db->order_by($order_by, 'DESC');
        $this->db->limit(10);
        $query = $this->db->get($table);
        $result = $query->result_array();
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

    function updatedataTable($table, $where, $data) {
        $this->db->where($where);
        $results = $this->db->update($table, $data);
        if ($results) {
            return true;
        } else {
            return false;
        }
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

    public function getRowData($condition, $table) {

        $query = $this->db->where($condition)
                ->get($table);

        return $query->row_array();
    }

    // function getVendorOrder($condition) {
    //     $orderList = [];
    //     $getOrders = $this->db->where($condition)->order_by('order_id', 'DESC')->get('orders')->result_array();
    //     if ($getOrders) {
    //         foreach ($getOrders as $vendor_order) {
    //             $getOrderItems = [];
    //             $orderItems = $this->db->select('ot.*,p.name as product_name,c.name as category_name')
    //                             ->where(['ot.order_id' => $vendor_order['order_id'], 'ot.vendor_id!=' => 0])
    //                             ->from('order_items ot')
    //                             ->join('products p', 'ot.product_id=p.product_id')
    //                             ->join('product_category c', 'p.category_id=c.category_id')
    //                             ->order_by('item_id', 'DESC')->get()->result_array();
    //             if ($orderItems) {
    //                 foreach ($orderItems as $items) {
    //                     $items['image'] = '';
    //                     $getItem = $this->getRowData(['item_id' => $items['item_id'], 'product_id' => $items['product_id']], 'product_attribute_group');
    //                     if($getItem){
    //                         if($getItem['images']){
    //                             $images = explode(',', $getItem['images']);
    //                             if ($images) {
    //                                 $getImage = $this->db->select('CONCAT(file_path,file_name) as image')->where(['product_images_id' => $images[0]])->get('product_images')->row_array();
    //                                 if ($getImage) {
    //                                     $items['image'] = $getImage['image'];
    //                                 }
    //                             } 
    //                         }
    //                     }
    //                     if ($items['vendor_id']) {
    //                         $this->db->select('vendor_id,business_type,name,email,image,country_code,mobile,address,lat,lng');
    //                         $vendor = $this->getRowData(['vendor_id' => $items['vendor_id']], 'vendor');
    //                         $items['vendor_detail'] = $vendor;
    //                     } else {
    //                         $items['vendor_detail'] = [];
    //                     }
    //                     array_push($getOrderItems, $items);
    //                 }
    //             }
    //             $vendor_order['order_items'] = $getOrderItems;
    //             $vendor_order['items_count'] = count($getOrderItems);
    //             $items_total = $this->db->select('SUM(ot.total) as total,SUM(ot.discount * ot.quantity) as discount')->where(['ot.order_id' => $vendor_order['order_id'], 'ot.vendor_id!=' => 0])->get('order_items ot')->row_array();
    //             $vendor_order['discount'] = $items_total['discount'];
    //             $vendor_order['items_total'] = $items_total['total'];
    //             $this->db->select('user_id,name,email,image,country_code,mobile');
    //             $user = $this->getRowData(['user_id' => $vendor_order['user_id']], 'users');
    //             $address = $this->db->select('u.*,c.name as country_name,ct.name as city_name')->where(['user_id' => $vendor_order['user_id'], 'address_id' => $vendor_order['address_id']])->from('user_address u')->join('city ct', 'u.city_id=ct.city_id')->join('country_code c', 'u.country_id=c.country_code_id')->get()->row_array();
    //             $vendor_order['user_detail'] = $user;
    //             $vendor_order['shipping_detail'] = $address;
    //             if ($getOrderItems) {
    //                 array_push($orderList, $vendor_order);
    //             }
    //         }
    //     }
    //     return $orderList;
    // }
    // function getOrder($condition) {
    //     $orderList = [];
    //     $getOrders = $this->db->select('Distinct(order_id),vendor_id')->where($condition)->order_by('order_id', 'DESC')->get('order_items')->result_array();
    //     if ($getOrders) {
    //         foreach ($getOrders as $vendor_order) {
    //             $condition['order_id'] = $vendor_order['order_id'];
    //             $condition['vendor_id'] = $vendor_order['vendor_id'];
    //             $vendor_order = $this->orderDetail($condition);
    //             array_push($orderList, $vendor_order);
    //         }
    //     }
    //     return $orderList;
    // }
    // function orderDetail($condition) {
    //     $getOrder = $this->getRowData(['order_id' => $condition['order_id'], 'status!=' => 0], 'orders');
    //     if ($getOrder) {
    //         if (isset($condition['vendor_id']) && $condition['vendor_id'] == 0) {
    //             $where = ['ot.order_id' => $getOrder['order_id'], 'ot.vendor_id' => 0];
    //         } else {
    //             $where = ['ot.order_id' => $getOrder['order_id'], 'ot.vendor_id!=' => 0];
    //         }
    //         $getOrderItems = [];
    //         $orderItems = $this->db->select('ot.*,p.name as product_name,c.name as category_name')
    //                         ->where($where)
    //                         ->from('order_items ot')
    //                         ->join('products p', 'ot.product_id=p.product_id')
    //                         ->join('product_category c', 'p.category_id=c.category_id')
    //                         ->order_by('item_id', 'DESC')->get()->result_array();
    //         if ($orderItems) {
    //             foreach ($orderItems as $items) {
    //                 $getItem = $this->getRowData(['item_id' => $items['item_id'], 'product_id' => $items['product_id']], 'product_attribute_group');
    //                 $images = explode(',', $getItem['images']);
    //                 if ($images) {
    //                     $getImage = $this->db->select('CONCAT(file_path,file_name) as image')->where(['product_images_id' => $images[0]])->get('product_images')->row_array();
    //                     if ($getImage) {
    //                         $items['image'] = $getImage['image'];
    //                     } else {
    //                         $items['image'] = '';
    //                     }
    //                 } else {
    //                     $items['image'] = '';
    //                 }
    //                 if ($items['vendor_id']) {
    //                     $this->db->select('vendor_id,business_type,name,email,image,country_code,mobile,address,lat,lng');
    //                     $vendor = $this->getRowData(['vendor_id' => $items['vendor_id']], 'vendor');
    //                     $items['vendor_detail'] = $vendor;
    //                 } else {
    //                     $items['vendor_detail'] = [];
    //                 }
    //                 array_push($getOrderItems, $items);
    //             }
    //         }
    //         $vendor_order = $getOrder;
    //         $vendor_order['order_items'] = $getOrderItems;
    //         $vendor_order['items_count'] = count($getOrderItems);
    //         $items_total = $this->db->select('SUM(ot.total) as total,SUM(ot.discount * ot.quantity) as discount')->where($where)->get('order_items ot')->row_array();
    //         $vendor_order['discount'] = $items_total['discount'];
    //         $vendor_order['items_total'] = $items_total['total'];
    //         $this->db->select('user_id,name,email,image,country_code,mobile');
    //         $user = $this->getRowData(['user_id' => $vendor_order['user_id']], 'users');
    //         $address = $this->db->select('u.*,c.name as country_name,ct.name as city_name')->where(['user_id' => $vendor_order['user_id'], 'address_id' => $vendor_order['address_id']])->from('user_address u')->join('city ct', 'u.city_id=ct.city_id')->join('country_code c', 'u.country_id=c.country_code_id')->get()->row_array();
    //         $vendor_order['user_detail'] = $user;
    //         $vendor_order['shipping_detail'] = $address;
    //         return $vendor_order;
    //     } else {
    //         return false;
    //     }
    // }
    // function getOrderSingleVendor($condition) {
    //     $orderList = [];
    //     $getOrders = $this->db->select('Distinct(order_id)')->where(['vendor_id' => $condition['vendor_id'], 'item_action!=' => 0])->order_by('order_id', 'DESC')->get('order_items')->result_array();
    //     if ($getOrders) {
    //         foreach ($getOrders as $vendor_order) {
    //             $condition['order_id'] = $vendor_order['order_id'];
    //             $vendor_order = $this->orderDetailSingleVendor($condition);
    //             array_push($orderList, $vendor_order);
    //         }
    //     }
    //     return $orderList;
    // }
    // function orderDetailSingleVendor($condition) {
    //     $getOrder = $this->getRowData(['order_id' => $condition['order_id'], 'status!=' => 0], 'orders');
    //     if ($getOrder) {
    //         $getOrderItems = [];
    //         $orderItems = $this->db->select('ot.*,p.name as product_name,c.name as category_name')->where(['order_id' => $condition['order_id'], 'ot.vendor_id' => $condition['vendor_id']])->from('order_items ot')->join('products p', 'ot.product_id=p.product_id')->join('product_category c', 'p.category_id=c.category_id')->order_by('item_id', 'DESC')->get()->result_array();
    //         foreach ($orderItems as $items) {
    //             $getItem = $this->getRowData(['item_id' => $items['item_id'], 'product_id' => $items['product_id']], 'product_attribute_group');
    //             $images = explode(',', $getItem['images']);
    //             if ($images) {
    //                 $getImage = $this->db->select('CONCAT(file_path,file_name) as image')->where(['product_images_id' => $images[0]])->get('product_images')->row_array();
    //                 if ($getImage) {
    //                     $items['image'] = $getImage['image'];
    //                 } else {
    //                     $items['image'] = '';
    //                 }
    //             } else {
    //                 $items['image'] = '';
    //             }
    //             array_push($getOrderItems, $items);
    //         }
    //         $vendor_order = $getOrder;
    //         $vendor_order['order_items'] = $getOrderItems;
    //         $vendor_order['items_count'] = count($getOrderItems);
    //         $items_total = $this->db->select('SUM(total) as total,SUM(discount) as discount')->where(['order_id' => $vendor_order['order_id'], 'vendor_id' => $condition['vendor_id']])->get('order_items')->row_array();
    //         $vendor_order['discount'] = $items_total['discount'];
    //         $vendor_order['items_total'] = $items_total['total'];
    //         $user = $this->getRowData(['user_id' => $getOrder['user_id']], 'users');
    //         $address = $this->db->select('u.*,c.name as country_name,ct.name as city_name')->where(['user_id' => $getOrder['user_id'], 'address_id' => $getOrder['address_id']])->from('user_address u')->join('city ct', 'u.city_id=ct.city_id')->join('country_code c', 'u.country_id=c.country_code_id')->get()->row_array();
    //         $vendor_order['user_detail'] = $user;
    //         $vendor_order['shipping_detail'] = $address;
    //         return $vendor_order;
    //     } else {
    //         return false;
    //     }
    // }


    function orderDetail($vendor_id, $order_id) {
        // $getOrder = $this->getRowData(['order_id' => $condition['order_id'], 'status!=' => 0], 'orders');
        $getOrder = $this->db->select("vendor_order.*,o.status,o.payment_type,o.user_status,o.user_id,o.address_id")
                        ->where("vendor_order.vendor_id", $vendor_id)
                        ->where("vendor_order.order_id", $order_id)
                        ->where("o.status", 1)
                        ->join("orders as o", "o.order_id=vendor_order.order_id")
                        ->get("vendor_order")->row_array();
        if ($getOrder) {
            $getOrderItems = [];
            $orderItems = $this->db->select('ot.*,p.name as product_name,c.name as category_name')->where(['order_id' => $order_id, 'ot.vendor_id' => $vendor_id])->from('order_items ot')->join('products p', 'ot.product_id=p.product_id')->join('product_category c', 'p.category_id=c.category_id')->order_by('item_id', 'DESC')->get()->result_array();
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

    function getBooking($condition) {
        $booking = $this->db->select('b.*,u.name as user_name,u.email,u.country_code,u.mobile,s.name as service_name,s.image as service_image,c.name as category_name')
                ->where($condition)
                ->from('service_booking b')
                ->order_by('booking_id', 'DESC')
                ->join('users u', 'u.user_id=b.user_id')
                ->join('service s', 's.service_id=b.service_id')
                ->join('service_category c', 's.category_id=c.category_id')
                ->get();

        return $booking;
    }

    function activeBookingList($type) {
        if ($type == 1) {
            $condition = '(b.status=1 or b.status=2 or b.status=3)';
        } elseif ($type == 2) {
            $condition = '(b.status=4)';
        } else {
            $condition = '(b.status=0 or b.status=5)';
        }
        $booking = $this->db->select('b.*,u.name as user_name,u.email,u.country_code,u.mobile,s.name as service_name,s.image as service_image,c.name as category_name')
                        ->where($condition)
                        ->from('service_booking b')
                        ->order_by('booking_id', 'DESC')
                        ->join('users u', 'u.user_id=b.user_id')
                        ->join('service s', 's.service_id=b.service_id')
                        ->join('service_category c', 's.category_id=c.category_id')
                        ->get()->result_array();
        ;

        return $booking;
    }

    function activeBookingDetail($id) {
        $condition = '(b.booking_id="' . $id . '")';
        $booking = $this->db->select('b.*,u.name as user_name,u.email,u.country_code,u.mobile,s.name as service_name,s.image as service_image,c.name as category_name')
                        ->where($condition)
                        ->from('service_booking b')
                        ->order_by('booking_id', 'DESC')
                        ->join('users u', 'u.user_id=b.user_id')
                        ->join('service s', 's.service_id=b.service_id')
                        ->join('service_category c', 's.category_id=c.category_id')
                        ->get()->row_array();
        ;

        return $booking;
    }

    function setFilterAttributes($param) {
        $returnArr=['sub_category_list'=>[],'brand_list'=>[],'model_list'=>[]];
        $subcategoryList = $this->Admin_model->getDataResultArray('product_sub_category', 'status=1 and category_id="' . $param['category_id'] . '"', 'sub_category_id');
        if ($subcategoryList) {
            $returnArr['sub_category_list'] = $subcategoryList;
        }
        if (isset($_POST['sub_category_id']) && $_POST['sub_category_id']) {
            $brandList = array();
            $query = $this->Admin_model->getDataResultArray('brand_mapping', 'status=1 and category_id="' . $param['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '"', 'brand_mapping_id');
            if ($query) {
                foreach ($query as $val) {
                    $brand = $this->Admin_model->getDataResultRow('brand', 'status=1 and brand_id="' . $val['brand_id'] . '" ', 'brand_mapping_id');
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
            $query = $this->Admin_model->getDataResultArray('model_mapping', 'status=1 and brand_mapping_id="' . $_POST['brand_id'] . '"', 'model_mapping_id');
            if ($query) {
                foreach ($query as $val) {
                    $res = $this->Admin_model->getDataResultRow('model', 'status=1 and model_id="' . $val['model_id'] . '"');
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

    function upload_image($x, $table, $directory) {
        $errors = array();
        $file_ext = explode('.', $_FILES[$x]['name']);
        $countExt = count($file_ext) - 1;
        $file_name = $this->my_random_string($file_ext[0]) . time() . '.' . $file_ext[$countExt];
        $file_tmp = $_FILES[$x]['tmp_name'];
        $file_name = urlencode($file_name);
        $folder_name = "./uploads/" . $directory . "/";
        if (empty($errors) == true) {
            $data = move_uploaded_file($file_tmp, $folder_name . $file_name);
            if ($uploadDb) {
                $insertData = array(
                    'file_path' => base_url() . "uploads/" . $directory . "/",
                    'file_name' => $file_name,
                    'file_type' => $file_ext[$countExt],
                );
                $inset = $this->insertDataTable($table, $insertData);
                $insert_id = $this->db->insert_id();
                return array('id' => $insert_id, 'image' => base_url() . "uploads/" . $directory . "/" . $file_name);
            } else {
                return array('id' => "0", 'image' => base_url() . "uploads/" . $directory . "/" . $file_name);
            }
        } else {
            return false;
        }
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

    function send_mail($to, $title, $subject, $data) {
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
        $this->email->from("dev@techgropse.com", "Zanomy");
// Receiver email address
        $this->email->to($to);
// Subject of email
        $this->email->subject($subject);
        $body = $this->load->view('email.php', $data, TRUE);
// Message in email
        $this->email->message($body);
        $result = $this->email->send();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}
