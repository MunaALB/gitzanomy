<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MX_Controller {

    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Kolkata");
        $this->load->model('Admin_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        $this->load->helper('string');
        $this->load->library('session');
        $this->load->library('form_validation');
        // if (!$this->session->userdata('admin_logged_in')) {
        //     redirect('admin');
        // }
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin');
        } else {
            $admin_login = $this->session->userdata('admin_logged_in');
            $urlExceptions = $this->uri->segment(3);
            if ($urlExceptions != 'ajax' && $urlExceptions != 'ajax_method') {
                if ($admin_login['type']) {
                    $result = $this->Admin_model->check_privilege(['id' => $admin_login['id']]);
                    if ($result == 0) {
                        echo '<script>alert("This account is blocked by superadmin.");window.location.href="admin/logout";</script>';
                    } else if ($result == 1) {
                        redirect('admin/unauthorized-access');
                    }
                }
            }
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

    function splitTrimData($data) {
        $data = ltrim($data, ',');
        $data = rtrim($data, ',');
        return $data;
    }

    function new_order_list() {
        $orderArr = array();
        $filter_condition = [];
        if (isset($_POST['vendor_id']) && $_POST['vendor_id']) {
//            $filter_condition = ['vendor_id' => $_POST['vendor_id']];
        }
        if (isset($_POST['user_id']) && $_POST['user_id']) {
            $filter_condition = ['user_id' => $_POST['user_id']];
        }
        if ($filter_condition) {
            $this->db->where($filter_condition);
        }
        $order = $this->getTableDataArray('orders', 'status=1');
        if ($order) {
            foreach ($order as $list) {
                $users = $this->getSingleDataRow('users', 'user_id="' . $list['user_id'] . '"');
                if ($users) {
                    $list['user_name'] = $users['name'];
                } else {
                    $list['user_name'] = "N/A";
                }
                array_push($orderArr, $list);
            }
        }
        $vendor_list = $this->Admin_model->getDataResultArray('vendor', 'business_type=1 and status!=99', 'vendor_id');
        $data['vendor_list'] = $vendor_list;
        $user_list = $this->Admin_model->getDataResultArray('users', 'status!=99', 'user_id');
        $data['user_list'] = $user_list;
        $data['order_list'] = $orderArr;
        $data['view_link'] = 'orders/new_order_list';
        $this->load->view('layout/template', $data);
    }

    function new_order_detail() {
        $order_id = $this->uri->segment(3);
        $orderArr = array();
        $isAnyVendorProduct = 0;
        $order = $this->getSingleDataRow('orders', 'status=1 and order_id="' . $order_id . '"');
        //echo '<pre/>';print_r($order);exit;
        if ($order) {
            $seenOrder = $this->Admin_model->updatedataTable('orders', ['order_id' => $order_id], array('is_seen' => 1));
            $getOrderItems = array();
            //$orderItems= $this->Admin_model->getDataResultArray('order_items', 'order_id="'.$order_id.'"', 'order_item_id');
            $orderItems = $this->db->select('ot.*,p.name as product_name,c.name as category_name')
                            ->where('ot.order_id', $order_id)
                            ->from('order_items ot')
                            ->join('products p', 'ot.product_id=p.product_id')
                            ->join('product_category c', 'p.category_id=c.category_id')
                            ->order_by('item_id', 'DESC')->get()->result_array();
            //echo '<pre/>';print_r($orderItems);exit;
            if ($orderItems) {
                foreach ($orderItems as $items) {
                    if ($items['is_in_hub'] == 0) {
                        $isAnyVendorProduct++;
                    }
                    $items['image'] = '';
                    $getItem = $this->getSingleDataRow('product_attribute_group', 'item_id="' . $items['item_id'] . '" and product_id="' . $items['product_id'] . '"');
                    //echo '<pre/>';print_r($getItem);exit;
                    if ($getItem) {
                        if ($getItem['images']) {
                            $images = explode(',', $getItem['images']);
                            if ($images) {
                                $getImage = $this->db->select('CONCAT(file_path,file_name) as image')->where(['product_images_id' => $images[0]])->get('product_images')->row_array();
                                if ($getImage) {
                                    $items['image'] = $getImage['image'];
                                }
                            }
                        }
                    }
                    if ($items['vendor_id']) {
                        $this->db->select('vendor_id,business_type,name,email,image,country_code,mobile,address,lat,lng');
                        $vendor = $this->getSingleDataRow('vendor', 'vendor_id="' . $items['vendor_id'] . '"');
                        $items['vendor_detail'] = $vendor;
                    } else {
                        $items['vendor_detail'] = [];
                    }
                    array_push($getOrderItems, $items);
                }
            }
            $order['isAnyVendorProduct'] = $isAnyVendorProduct;
            $order['order_items'] = $getOrderItems;
            $order['items_count'] = count($getOrderItems);
            $users = $this->getSingleDataRow('users', 'user_id="' . $order['user_id'] . '"');
            $data['driver_list'] = $this->Admin_model->getDataResultArray('driver', 'status=1', 'driver_id');
            $order['user_detail'] = $users;
            $address = $this->db->select('u.*,c.name as country_name,ct.name as city_name')->where(['user_id' => $order['user_id'], 'address_id' => $order['address_id']])->from('user_address u')->join('city ct', 'u.city_id=ct.city_id')->join('country_code c', 'u.country_id=c.country_code_id')->get()->row_array();
            $order['shipping_detail'] = $address;
            $data['order'] = $order;
        } else {
            $data['order'] = array();
        }
        //echo '<pre/>';print_r($data);exit;
        $data['view_link'] = 'orders/new_order_detail';
        $this->load->view('layout/template', $data);
    }

    function upfront_payment_order_list() {
        $orderArr = array();
        $order = $this->getTableDataArray('orders', 'status=2');
        if ($order) {
            foreach ($order as $list) {
                $users = $this->getSingleDataRow('users', 'user_id="' . $list['user_id'] . '"');
                if ($users) {
                    $list['user_name'] = $users['name'];
                } else {
                    $list['user_name'] = "N/A";
                }
                array_push($orderArr, $list);
            }
        }
        $data['order_list'] = $orderArr;
        $data['view_link'] = 'orders/upfront_payment_order_list';
        $this->load->view('layout/template', $data);
    }

    function upfront_payment_order_detail() {
        $order_id = $this->uri->segment(3);
        $orderArr = array();
        $order = $this->getSingleDataRow('orders', 'status=2 and order_id="' . $order_id . '"');
        if ($order) {
            $seenOrder = $this->Admin_model->updatedataTable('orders', ['order_id' => $order_id], array('is_seen' => 1));
            $getOrderItems = array();
            //$orderItems= $this->Admin_model->getDataResultArray('order_items', 'order_id="'.$order_id.'"', 'order_item_id');
            $orderItems = $this->db->select('ot.*,p.name as product_name,c.name as category_name')
                            ->where('ot.order_id', $order_id)
                            ->from('order_items ot')
                            ->join('products p', 'ot.product_id=p.product_id')
                            ->join('product_category c', 'p.category_id=c.category_id')
                            ->order_by('item_id', 'DESC')->get()->result_array();
            //echo '<pre/>';print_r($orderItems);exit;
            if ($orderItems) {
                foreach ($orderItems as $items) {
                    $items['image'] = '';
                    $getItem = $this->getSingleDataRow('product_attribute_group', 'item_id="' . $items['item_id'] . '" and product_id="' . $items['product_id'] . '"');
                    //echo '<pre/>';print_r($getItem);exit;
                    if ($getItem) {
                        if ($getItem['images']) {
                            $images = explode(',', $getItem['images']);
                            if ($images) {
                                $getImage = $this->db->select('CONCAT(file_path,file_name) as image')->where(['product_images_id' => $images[0]])->get('product_images')->row_array();
                                if ($getImage) {
                                    $items['image'] = $getImage['image'];
                                }
                            }
                        }
                    }



                    if ($items['vendor_id']) {
                        $this->db->select('vendor_id,business_type,name,email,image,country_code,mobile,address,lat,lng');
                        $vendor = $this->getSingleDataRow('vendor', 'vendor_id="' . $items['vendor_id'] . '"');
                        $items['vendor_detail'] = $vendor;
                    } else {
                        $items['vendor_detail'] = [];
                    }
                    array_push($getOrderItems, $items);
                }
            }
            $order['order_items'] = $getOrderItems;
            $order['items_count'] = count($getOrderItems);
            $users = $this->getSingleDataRow('users', 'user_id="' . $order['user_id'] . '"');
            $data['driver_list'] = $this->Admin_model->getDataResultArray('driver', 'status=1', 'driver_id');
            $order['user_detail'] = $users;
            $address = $this->db->select('u.*,c.name as country_name,ct.name as city_name')->where(['user_id' => $order['user_id'], 'address_id' => $order['address_id']])->from('user_address u')->join('city ct', 'u.city_id=ct.city_id')->join('country_code c', 'u.country_id=c.country_code_id')->get()->row_array();
            $order['shipping_detail'] = $address;
            //////////////////////////////////UPFRONT TRACKER////////////////////////////
            $order_statusArr = array();
            $order_status = $this->getTableDataArray('order_status', 'type=3 and (order_type_id=1) ');
            if ($order_status) {
                foreach ($order_status as $stats) {
                    $getCheck = $this->getSingleDataRow('order_upfront_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $order['driver_id'] . '" and upfront_tracking_id="' . $order['upfront_tracking_id'] . '" and upfront_status="' . $stats['status_id'] . '"');
                    if ($getCheck) {
                        $stats['is_checked'] = "1";
                        $stats['tracker_date'] = $getCheck['upfront_tracking_created_at'];
                    } else {
                        $stats['is_checked'] = "0";
                        $stats['tracker_date'] = "";
                    }
                    array_push($order_statusArr, $stats);
                }
            }
            $order['order_status'] = $order_statusArr;
            $order['order_status_count'] = count($order_statusArr);
            $order['order_upfront_tracking'] = $this->getTableDataArray('order_upfront_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $order['driver_id'] . '" and upfront_tracking_id="' . $order['upfront_tracking_id'] . '"');

            $driver_address = $this->getSingleDataRow('driver', 'driver_id="' . $order['driver_id'] . '" ');
            if ($driver_address) {
                unset($driver_address['password']);
                $order['driver_detail'] = $driver_address;
            } else {
                $order['driver_detail'] = array();
            }
            //////////////////////////////////UPFRONT TRACKER////////////////////////////
            $data['order'] = $order;
        } else {
            $data['order'] = array();
        }
        // echo '<pre/>';print_r($data);exit;
        $data['view_link'] = 'orders/upfront_payment_order_detail';
        $this->load->view('layout/template', $data);
    }

    ////////////////////////////Assigend driver for vendor product/////
    function assigned_driver_for_vendor_product() {
        $order_id = $this->uri->segment(3);
        $orderArr = array();
        $order = $this->getSingleDataRow('orders', '(status=1 or status=3 or status=4) and order_id="' . $order_id . '"');
        if ($order) {
            $getAdminOrderItems = array();
            $getOrderItems = array();
            $orderItems = $this->db->select('ot.*,p.name as product_name,p.product_from,c.name as category_name')
                            ->where('ot.order_id', $order_id)
                            ->where('ot.is_in_hub', 0)
                            ->from('order_items ot')
                            ->join('products p', 'ot.product_id=p.product_id')
                            ->join('product_category c', 'p.category_id=c.category_id')
                            ->order_by('item_id', 'DESC')->get()->result_array();
            //echo '<pre/>';print_r($orderItems);exit;
            if ($orderItems) {
                foreach ($orderItems as $items) {
                    $items['image'] = '';
                    $getItem = $this->getSingleDataRow('product_attribute_group', 'item_id="' . $items['item_id'] . '" and product_id="' . $items['product_id'] . '"');
                    //echo '<pre/>';print_r($getItem);exit;
                    if ($getItem) {
                        if ($getItem['images']) {
                            $images = explode(',', $getItem['images']);
                            if ($images) {
                                $getImage = $this->db->select('CONCAT(file_path,file_name) as image')->where(['product_images_id' => $images[0]])->get('product_images')->row_array();
                                if ($getImage) {
                                    $items['image'] = $getImage['image'];
                                }
                            }
                        }
                    }
                    if ($items['vendor_id']) {
                        $this->db->select('vendor_id,business_type,name,email,image,country_code,mobile,address,lat,lng');
                        $vendor = $this->getSingleDataRow('vendor', 'vendor_id="' . $items['vendor_id'] . '"');
                        $items['vendor_detail'] = $vendor;
                    } else {
                        $items['vendor_detail'] = [];
                    }
                    if ($items['vendor_id'] == 0) {
                        array_push($getAdminOrderItems, $items);
                    } else {
                        array_push($getOrderItems, $items);
                    }
                }
                $order['order_items'] = $getOrderItems;
                $order['admin_order_items'] = $getAdminOrderItems;
                $order['items_count'] = count($getOrderItems);
                $users = $this->getSingleDataRow('users', 'user_id="' . $order['user_id'] . '"');
                $data['driver_list'] = $this->Admin_model->getDataResultArray('driver', 'status=1', 'driver_id');
                $order['user_detail'] = $users;
                $address = $this->db->select('u.*,c.name as country_name,ct.name as city_name')->where(['user_id' => $order['user_id'], 'address_id' => $order['address_id']])->from('user_address u')->join('city ct', 'u.city_id=ct.city_id')->join('country_code c', 'u.country_id=c.country_code_id')->get()->row_array();
                $order['shipping_detail'] = $address;
                $data['order'] = $order;
            } else {
                $data['order'] = array();
            }
        } else {
            $data['order'] = array();
        }
        // echo '<pre/>';print_r($data);exit;
        $data['view_link'] = 'orders/assigned_driver_for_vendor_product';
        $this->load->view('layout/template', $data);
    }

    ////////////////////////////Assigend driver for vendor product/////
    ////////////////////////////Assigend driver for delivery product///////////////////
    function assigned_driver_for_user_product() {
        $order_id = $this->uri->segment(3);
        $orderArr = array();
        $order = $this->getSingleDataRow('orders', '(status=1 or status=3 or status=4) and order_id="' . $order_id . '"');
        // print_r($order);exit;
        if ($order) {
            $getOrderItems = array();
            $orderItems = $this->db->select('ot.*,p.name as product_name,c.name as category_name')
                            ->where('ot.order_id', $order_id)
                            ->where('ot.user_status!=',5)
                            //->where('ot.is_in_hub',0)
                            ->from('order_items ot')
                            ->join('products p', 'ot.product_id=p.product_id')
                            ->join('product_category c', 'p.category_id=c.category_id')
                            ->order_by('item_id', 'DESC')->get()->result_array();
            // echo '<pre/>';print_r($orderItems);exit;
            if ($orderItems) {
                foreach ($orderItems as $items) {
                    $items['image'] = '';
                    $getItem = $this->getSingleDataRow('product_attribute_group', 'item_id="' . $items['item_id'] . '" and product_id="' . $items['product_id'] . '"');
                    //echo '<pre/>';print_r($getItem);exit;
                    if ($getItem) {
                        if ($getItem['images']) {
                            $images = explode(',', $getItem['images']);
                            if ($images) {
                                $getImage = $this->db->select('CONCAT(file_path,file_name) as image')->where(['product_images_id' => $images[0]])->get('product_images')->row_array();
                                if ($getImage) {
                                    $items['image'] = $getImage['image'];
                                }
                            }
                        }
                    }
                    if ($items['vendor_id']) {
                        $this->db->select('vendor_id,business_type,name,email,image,country_code,mobile,address,lat,lng');
                        $vendor = $this->getSingleDataRow('vendor', 'vendor_id="' . $items['vendor_id'] . '"');
                        $items['vendor_detail'] = $vendor;
                    } else {
                        $items['vendor_detail'] = [];
                    }



                    //////////////////////////////////Vendor Assigned TRACKER////////////////////////////
                    $vendorItemStatusArr = array();
                    if ($items['driver_id'] > 0) {
                        $order_status = $this->getTableDataArray('order_status', 'type=3 and (order_type_id=2) ');
                        if ($order_status) {
                            foreach ($order_status as $stats) {
                                $getCheck = $this->getSingleDataRow('order_vendor_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $items['driver_id'] . '" and vendor_tracking_id="' . $items['vendor_tracking_id'] . '" and vendor_status="' . $stats['status_id'] . '"');
                                if ($getCheck) {
                                    $stats['is_checked'] = "1";
                                    $stats['tracker_date'] = $getCheck['vendor_tracking_id'];
                                } else {
                                    $stats['is_checked'] = "0";
                                    $stats['tracker_date'] = "";
                                }
                                array_push($vendorItemStatusArr, $stats);
                            }
                        }
                        $driver_address = $this->getSingleDataRow('driver', 'driver_id="' . $items['driver_id'] . '" ');
                        if ($driver_address) {
                            unset($driver_address['password']);
                            $items['vendor_driver_detail'] = $driver_address;
                        } else {
                            $items['vendor_driver_detail'] = array();
                        }
                        $items['vendor_item_tracking'] = $this->getTableDataArray('order_vendor_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $items['driver_id'] . '" and vendor_tracking_id="' . $items['vendor_tracking_id'] . '"');
                    }
                    $items['vendor_item_status'] = $vendorItemStatusArr;
                    $items['vendor_item_status_count'] = count($vendorItemStatusArr);
                    //////////////////////////////////Vendor Assigned TRACKER////////////////////////////
                    //////////////////////////////////Drop Order TRACKER////////////////////////////
                    $dropItemStatusArr = array();
                    if ($items['drop_driver_id'] > 0) {
                        $order_status = $this->getTableDataArray('order_status', 'type=3 and (order_type_id=3) ');
                        if ($order_status) {
                            foreach ($order_status as $stats) {
                                $getCheck = $this->getSingleDataRow('order_drop_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $items['drop_driver_id'] . '" and drop_tracking_id="' . $items['drop_tracking_id'] . '" and drop_status="' . $stats['status_id'] . '"');
                                if ($getCheck) {
                                    $stats['is_checked'] = "1";
                                    $stats['tracker_date'] = $getCheck['drop_tracking_created_at'];
                                } else {
                                    $stats['is_checked'] = "0";
                                    $stats['tracker_date'] = "";
                                }
                                array_push($dropItemStatusArr, $stats);
                            }
                        }
                        $driver_address = $this->getSingleDataRow('driver', 'driver_id="' . $items['drop_driver_id'] . '" ');
                        if ($driver_address) {
                            unset($driver_address['password']);
                            $items['drop_driver_detail'] = $driver_address;
                        } else {
                            $items['drop_driver_detail'] = array();
                        }
                        $items['drop_item_tracking'] = $this->getTableDataArray('order_drop_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $items['drop_driver_id'] . '" and drop_tracking_id="' . $items['drop_tracking_id'] . '"');
                    }
                    $items['drop_item_status'] = $dropItemStatusArr;
                    $items['drop_item_status_count'] = count($dropItemStatusArr);
                    //////////////////////////////////Drop Order TRACKER////////////////////////////



                    array_push($getOrderItems, $items);
                }
            }
            $order['order_items'] = $getOrderItems;
            $order['items_count'] = count($getOrderItems);
            $users = $this->getSingleDataRow('users', 'user_id="' . $order['user_id'] . '"');
            $data['driver_list'] = $this->Admin_model->getDataResultArray('driver', 'status=1', 'driver_id');
            $order['user_detail'] = $users;
            $address = $this->db->select('u.*,c.name as country_name,ct.name as city_name')->where(['user_id' => $order['user_id'], 'address_id' => $order['address_id']])->from('user_address u')->join('city ct', 'u.city_id=ct.city_id')->join('country_code c', 'u.country_id=c.country_code_id')->get()->row_array();
            $order['shipping_detail'] = $address;
            $data['order'] = $order;
        } else {
            $data['order'] = array();
        }
        // echo '<pre/>';print_r($data);exit;
        $data['view_link'] = 'orders/assigned_driver_for_user_product';
        $this->load->view('layout/template', $data);
    }

    ////////////////////////////Assigend driver for delivery product///////////////////


    function verified_upfront_payment_order_list() {
        $orderArr = array();
        $order = $this->getTableDataArray('orders', 'status=3');
        if ($order) {
            foreach ($order as $list) {
                $users = $this->getSingleDataRow('users', 'user_id="' . $list['user_id'] . '"');
                if ($users) {
                    $list['user_name'] = $users['name'];
                } else {
                    $list['user_name'] = "N/A";
                }
                array_push($orderArr, $list);
            }
        }
        $data['order_list'] = $orderArr;
        $data['view_link'] = 'orders/verified_upfront_payment_order_list';
        $this->load->view('layout/template', $data);
    }

    function verified_upfront_payment_order_detail() {
        $order_id = $this->uri->segment(3);
        $orderArr = array();
        $isAnyVendorProduct = 0;
        $order = $this->getSingleDataRow('orders', 'status=3 and order_id="' . $order_id . '"');
        if ($order) {
            $seenOrder = $this->Admin_model->updatedataTable('orders', ['order_id' => $order_id], array('is_seen' => 1));
            $getOrderItems = array();
            //$orderItems= $this->Admin_model->getDataResultArray('order_items', 'order_id="'.$order_id.'"', 'order_item_id');
            $orderItems = $this->db->select('ot.*,p.name as product_name,c.name as category_name')
                            ->where('ot.order_id', $order_id)
                            ->from('order_items ot')
                            ->join('products p', 'ot.product_id=p.product_id')
                            ->join('product_category c', 'p.category_id=c.category_id')
                            ->order_by('item_id', 'DESC')->get()->result_array();
            //echo '<pre/>';print_r($orderItems);exit;
            if ($orderItems) {
                foreach ($orderItems as $items) {
                    if ($items['is_in_hub'] == 0) {
                        $isAnyVendorProduct++;
                    }
                    $items['image'] = '';
                    $getItem = $this->getSingleDataRow('product_attribute_group', 'item_id="' . $items['item_id'] . '" and product_id="' . $items['product_id'] . '"');
                    //echo '<pre/>';print_r($getItem);exit;
                    if ($getItem) {
                        if ($getItem['images']) {
                            $images = explode(',', $getItem['images']);
                            if ($images) {
                                $getImage = $this->db->select('CONCAT(file_path,file_name) as image')->where(['product_images_id' => $images[0]])->get('product_images')->row_array();
                                if ($getImage) {
                                    $items['image'] = $getImage['image'];
                                }
                            }
                        }
                    }



                    if ($items['vendor_id']) {
                        $this->db->select('vendor_id,business_type,name,email,image,country_code,mobile,address,lat,lng');
                        $vendor = $this->getSingleDataRow('vendor', 'vendor_id="' . $items['vendor_id'] . '"');
                        $items['vendor_detail'] = $vendor;
                    } else {
                        $items['vendor_detail'] = [];
                    }
                    array_push($getOrderItems, $items);
                }
            }
            $order['isAnyVendorProduct'] = $isAnyVendorProduct;
            $order['order_items'] = $getOrderItems;
            $order['items_count'] = count($getOrderItems);
            $users = $this->getSingleDataRow('users', 'user_id="' . $order['user_id'] . '"');
            $data['driver_list'] = $this->Admin_model->getDataResultArray('driver', 'status=1', 'driver_id');
            $order['user_detail'] = $users;
            $address = $this->db->select('u.*,c.name as country_name,ct.name as city_name')->where(['user_id' => $order['user_id'], 'address_id' => $order['address_id']])->from('user_address u')->join('city ct', 'u.city_id=ct.city_id')->join('country_code c', 'u.country_id=c.country_code_id')->get()->row_array();
            $order['shipping_detail'] = $address;
            //////////////////////////////////UPFRONT TRACKER////////////////////////////
            $order_statusArr = array();
            $order_status = $this->getTableDataArray('order_status', 'type=3 and (order_type_id=1) ');
            if ($order_status) {
                foreach ($order_status as $stats) {
                    $getCheck = $this->getSingleDataRow('order_upfront_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $order['driver_id'] . '" and upfront_tracking_id="' . $order['upfront_tracking_id'] . '" and upfront_status="' . $stats['status_id'] . '"');
                    if ($getCheck) {
                        $stats['is_checked'] = "1";
                        $stats['tracker_date'] = $getCheck['upfront_tracking_created_at'];
                    } else {
                        $stats['is_checked'] = "0";
                        $stats['tracker_date'] = "";
                    }
                    array_push($order_statusArr, $stats);
                }
            }
            $order['order_status'] = $order_statusArr;
            $order['order_status_count'] = count($order_statusArr);
            $order['order_upfront_tracking'] = $this->getTableDataArray('order_upfront_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $order['driver_id'] . '" and upfront_tracking_id="' . $order['upfront_tracking_id'] . '"');

            $driver_address = $this->getSingleDataRow('driver', 'driver_id="' . $order['driver_id'] . '" ');
            if ($driver_address) {
                unset($driver_address['password']);
                $order['driver_detail'] = $driver_address;
            } else {
                $order['driver_detail'] = array();
                ;
            }
            //////////////////////////////////UPFRONT TRACKER////////////////////////////
            $data['order'] = $order;
        } else {
            $data['order'] = array();
        }
        // echo '<pre/>';print_r($data);exit;
        $data['view_link'] = 'orders/verified_upfront_payment_order_detail';
        $this->load->view('layout/template', $data);
    }

    function inprocess_order_list() {
        $orderArr = array();
        $filter_condition = [];
        if (isset($_POST['vendor_id']) && $_POST['vendor_id']) {
//            $filter_condition = ['vendor_id' => $_POST['vendor_id']];
        }
        if (isset($_POST['user_id']) && $_POST['user_id']) {
            $filter_condition = ['user_id' => $_POST['user_id']];
        }
        if ($filter_condition) {
            $this->db->where($filter_condition);
        }
        $order = $this->getTableDataArray('orders', 'status=4');
        if ($order) {
            foreach ($order as $list) {
                $users = $this->getSingleDataRow('users', 'user_id="' . $list['user_id'] . '"');
                if ($users) {
                    $list['user_name'] = $users['name'];
                } else {
                    $list['user_name'] = "N/A";
                }
                array_push($orderArr, $list);
            }
        }
        $vendor_list = $this->Admin_model->getDataResultArray('vendor', 'business_type=1 and status!=99', 'vendor_id');
        $data['vendor_list'] = $vendor_list;
        $user_list = $this->Admin_model->getDataResultArray('users', 'status!=99', 'user_id');
        $data['user_list'] = $user_list;
        $data['order_list'] = $orderArr;
        $data['view_link'] = 'orders/inprocess_order_list';
        $this->load->view('layout/template', $data);
    }

    function inprocess_order_detail() {
        $order_id = $this->uri->segment(3);
        $orderArr = array();
        $isAnyVendorProduct = 0;
        $isdeliveredProduct = 0;
        $order = $this->getSingleDataRow('orders', 'status=4 and order_id="' . $order_id . '"');
        if ($order) {
            $seenOrder = $this->Admin_model->updatedataTable('orders', ['order_id' => $order_id], array('is_seen' => 1));
            $getOrderItems = array();
            //$orderItems= $this->Admin_model->getDataResultArray('order_items', 'order_id="'.$order_id.'"', 'order_item_id');
            $orderItems = $this->db->select('ot.*,p.name as product_name,c.name as category_name')
                            ->where('ot.order_id', $order_id)
                            ->from('order_items ot')
                            ->join('products p', 'ot.product_id=p.product_id')
                            ->join('product_category c', 'p.category_id=c.category_id')
                            ->order_by('item_id', 'DESC')->get()->result_array();
            // echo '<pre/>';print_r($orderItems);exit;
            if ($orderItems) {
                foreach ($orderItems as $items) {
                    // if($items['is_in_hub']==0){
                    //     $isAnyVendorProduct++;
                    // }
                    if ($items['driver_id'] == 0 and $items['vendor_id'] != 0) {
                        $isAnyVendorProduct++;
                    }

                    if ($items['drop_driver_id'] == 0) {
                        $isdeliveredProduct++;
                    }
                    $items['image'] = '';
                    $getItem = $this->getSingleDataRow('product_attribute_group', 'item_id="' . $items['item_id'] . '" and product_id="' . $items['product_id'] . '"');
                    //echo '<pre/>';print_r($getItem);exit;
                    if ($getItem) {
                        if ($getItem['images']) {
                            $images = explode(',', $getItem['images']);
                            if ($images) {
                                $getImage = $this->db->select('CONCAT(file_path,file_name) as image')->where(['product_images_id' => $images[0]])->get('product_images')->row_array();
                                if ($getImage) {
                                    $items['image'] = $getImage['image'];
                                }
                            }
                        }
                    }

                    if ($items['vendor_id']) {
                        $this->db->select('vendor_id,business_type,name,email,image,country_code,mobile,address,lat,lng');
                        $vendor = $this->getSingleDataRow('vendor', 'vendor_id="' . $items['vendor_id'] . '"');
                        $items['vendor_detail'] = $vendor;
                    } else {
                        $items['vendor_detail'] = [];
                    }

                    //////////////////////////////////Vendor Assigned TRACKER////////////////////////////
                    $vendorItemStatusArr = array();
                    if ($items['driver_id'] > 0) {
                        $order_status = $this->getTableDataArray('order_status', 'type=3 and (order_type_id=2) ');
                        if ($order_status) {
                            foreach ($order_status as $stats) {
                                $getCheck = $this->getSingleDataRow('order_vendor_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $items['driver_id'] . '" and vendor_tracking_id="' . $items['vendor_tracking_id'] . '" and vendor_status="' . $stats['status_id'] . '"');
                                // echo '<pre/>';print_r($getCheck);exit;
                                if ($getCheck) {
                                    $stats['is_checked'] = "1";
                                    $stats['tracker_date'] = $getCheck['drop_tracking_created_at'];
                                } else {
                                    $stats['is_checked'] = "0";
                                    $stats['tracker_date'] = "";
                                }
                                array_push($vendorItemStatusArr, $stats);
                            }
                        }
                        $driver_address = $this->getSingleDataRow('driver', 'driver_id="' . $items['driver_id'] . '" ');
                        if ($driver_address) {
                            unset($driver_address['password']);
                            $items['vendor_driver_detail'] = $driver_address;
                        } else {
                            $items['vendor_driver_detail'] = array();
                        }
                        $items['vendor_item_tracking'] = $this->getTableDataArray('order_vendor_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $items['driver_id'] . '" and vendor_tracking_id="' . $items['vendor_tracking_id'] . '"');
                    }
                    $items['vendor_item_status'] = $vendorItemStatusArr;
                    $items['vendor_item_status_count'] = count($vendorItemStatusArr);
                    //////////////////////////////////Vendor Assigned TRACKER////////////////////////////
                    //////////////////////////////////Drop Order TRACKER////////////////////////////
                    $dropItemStatusArr = array();
                    if ($items['drop_driver_id'] > 0) {
                        $order_status = $this->getTableDataArray('order_status', 'type=3 and (order_type_id=3) ');
                        if ($order_status) {
                            foreach ($order_status as $stats) {
                                $getCheck = $this->getSingleDataRow('order_drop_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $items['drop_driver_id'] . '" and drop_tracking_id="' . $items['drop_tracking_id'] . '" and drop_status="' . $stats['status_id'] . '"');
                                if ($getCheck) {
                                    $stats['is_checked'] = "1";
                                    $stats['tracker_date'] = $getCheck['drop_tracking_created_at'];
                                } else {
                                    $stats['is_checked'] = "0";
                                    $stats['tracker_date'] = "";
                                }
                                array_push($dropItemStatusArr, $stats);
                            }
                        }
                        $driver_address = $this->getSingleDataRow('driver', 'driver_id="' . $items['drop_driver_id'] . '" ');
                        if ($driver_address) {
                            unset($driver_address['password']);
                            $items['drop_driver_detail'] = $driver_address;
                        } else {
                            $items['drop_driver_detail'] = array();
                        }
                        $items['drop_item_tracking'] = $this->getTableDataArray('order_drop_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $items['drop_driver_id'] . '" and drop_tracking_id="' . $items['drop_tracking_id'] . '"');
                    }
                    $items['drop_item_status'] = $dropItemStatusArr;
                    $items['drop_item_status_count'] = count($dropItemStatusArr);
                    //////////////////////////////////Drop Order TRACKER////////////////////////////

                    array_push($getOrderItems, $items);
                }
            }
            // echo '<pre/>';print_r($getOrderItems);exit;
            $order['isAnyVendorProduct'] = $isAnyVendorProduct;
            //echo '<pre/>';print_r($order);exit;
            $order['isdeliveredProduct'] = $isdeliveredProduct;
            $order['order_items'] = $getOrderItems;
            $order['items_count'] = count($getOrderItems);
            $users = $this->getSingleDataRow('users', 'user_id="' . $order['user_id'] . '"');
            $data['driver_list'] = $this->Admin_model->getDataResultArray('driver', 'status=1', 'driver_id');
            $order['user_detail'] = $users;
            $address = $this->db->select('u.*,c.name as country_name,ct.name as city_name')->where(['user_id' => $order['user_id'], 'address_id' => $order['address_id']])->from('user_address u')->join('city ct', 'u.city_id=ct.city_id')->join('country_code c', 'u.country_id=c.country_code_id')->get()->row_array();
            $order['shipping_detail'] = $address;

            //////////////////////////////////UPFRONT TRACKER////////////////////////////
            $order_statusArr = array();
            if ($order['driver_id'] > 0) {
                $order_status = $this->getTableDataArray('order_status', 'type=3 and (order_type_id=1) ');
                if ($order_status) {
                    foreach ($order_status as $stats) {
                        $getCheck = $this->getSingleDataRow('order_upfront_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $order['driver_id'] . '" and upfront_tracking_id="' . $order['upfront_tracking_id'] . '" and upfront_status="' . $stats['status_id'] . '"');
                        if ($getCheck) {
                            $stats['is_checked'] = "1";
                            $stats['tracker_date'] = $getCheck['upfront_tracking_created_at'];
                        } else {
                            $stats['is_checked'] = "0";
                            $stats['tracker_date'] = "";
                        }
                        array_push($order_statusArr, $stats);
                    }
                }
            }
            $order['order_status'] = $order_statusArr;
            $order['order_status_count'] = count($order_statusArr);
            $order['order_upfront_tracking'] = $this->getTableDataArray('order_upfront_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $order['driver_id'] . '" and upfront_tracking_id="' . $order['upfront_tracking_id'] . '"');

            $driver_address = $this->getSingleDataRow('driver', 'driver_id="' . $order['driver_id'] . '" ');
            if ($driver_address) {
                unset($driver_address['password']);
                $order['driver_detail'] = $driver_address;
            } else {
                $order['driver_detail'] = array();
            }
            //////////////////////////////////UPFRONT TRACKER////////////////////////////


            $data['order'] = $order;
        } else {
            $data['order'] = array();
        }
        // echo '<pre/>';print_r($data);exit;
        $data['view_link'] = 'orders/inprocess_order_detail';
        $this->load->view('layout/template', $data);
    }

    function completed_order_list() {
        $orderArr = array();
        $filter_condition = [];
        if (isset($_POST['vendor_id']) && $_POST['vendor_id']) {
//            $filter_condition = ['vendor_id' => $_POST['vendor_id']];
        }
        if (isset($_POST['user_id']) && $_POST['user_id']) {
            $filter_condition = ['user_id' => $_POST['user_id']];
        }
        if ($filter_condition) {
            $this->db->where($filter_condition);
        }
        $order = $this->getTableDataArray('orders', 'status=5');
        if ($order) {
            foreach ($order as $list) {
                $users = $this->getSingleDataRow('users', 'user_id="' . $list['user_id'] . '"');
                if ($users) {
                    $list['user_name'] = $users['name'];
                } else {
                    $list['user_name'] = "N/A";
                }
                array_push($orderArr, $list);
            }
        }
        $vendor_list = $this->Admin_model->getDataResultArray('vendor', 'business_type=1 and status!=99', 'vendor_id');
        $data['vendor_list'] = $vendor_list;
        $user_list = $this->Admin_model->getDataResultArray('users', 'status!=99', 'user_id');
        $data['user_list'] = $user_list;
        $data['order_list'] = $orderArr;
        $data['view_link'] = 'orders/completed_order_list';
        $this->load->view('layout/template', $data);
    }

    function completed_order_detail() {
        $order_id = $this->uri->segment(3);
        $orderArr = array();
        $isAnyVendorProduct = 0;
        $isdeliveredProduct = 0;
        $order = $this->getSingleDataRow('orders', 'status=5 and order_id="' . $order_id . '"');
        if ($order) {
            $seenOrder = $this->Admin_model->updatedataTable('orders', ['order_id' => $order_id], array('is_seen' => 1));
            $getOrderItems = array();
            //$orderItems= $this->Admin_model->getDataResultArray('order_items', 'order_id="'.$order_id.'"', 'order_item_id');
            $orderItems = $this->db->select('ot.*,p.name as product_name,c.name as category_name')
                            ->where('ot.order_id', $order_id)
                            ->from('order_items ot')
                            ->join('products p', 'ot.product_id=p.product_id')
                            ->join('product_category c', 'p.category_id=c.category_id')
                            ->order_by('item_id', 'DESC')->get()->result_array();
            // echo '<pre/>';print_r($orderItems);exit;
            if ($orderItems) {
                foreach ($orderItems as $items) {
                    if ($items['is_in_hub'] == 0) {
                        $isAnyVendorProduct++;
                    }
                    if ($items['drop_driver_id'] == 0) {
                        $isdeliveredProduct++;
                    }
                    $items['image'] = '';
                    $getItem = $this->getSingleDataRow('product_attribute_group', 'item_id="' . $items['item_id'] . '" and product_id="' . $items['product_id'] . '"');
                    //echo '<pre/>';print_r($getItem);exit;
                    if ($getItem) {
                        if ($getItem['images']) {
                            $images = explode(',', $getItem['images']);
                            if ($images) {
                                $getImage = $this->db->select('CONCAT(file_path,file_name) as image')->where(['product_images_id' => $images[0]])->get('product_images')->row_array();
                                if ($getImage) {
                                    $items['image'] = $getImage['image'];
                                }
                            }
                        }
                    }

                    if ($items['vendor_id']) {
                        $this->db->select('vendor_id,business_type,name,email,image,country_code,mobile,address,lat,lng');
                        $vendor = $this->getSingleDataRow('vendor', 'vendor_id="' . $items['vendor_id'] . '"');
                        $items['vendor_detail'] = $vendor;
                    } else {
                        $items['vendor_detail'] = [];
                    }

                    //////////////////////////////////Vendor Assigned TRACKER////////////////////////////
                    $vendorItemStatusArr = array();
                    if ($items['driver_id'] > 0) {
                        $order_status = $this->getTableDataArray('order_status', 'type=3 and (order_type_id=2) ');
                        if ($order_status) {
                            foreach ($order_status as $stats) {
                                $getCheck = $this->getSingleDataRow('order_vendor_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $items['driver_id'] . '" and vendor_tracking_id="' . $items['vendor_tracking_id'] . '" and vendor_status="' . $stats['status_id'] . '"');
                                // echo '<pre/>';print_r($getCheck);exit;
                                if ($getCheck) {
                                    $stats['is_checked'] = "1";
                                    $stats['tracker_date'] = $getCheck['drop_tracking_created_at'];
                                } else {
                                    $stats['is_checked'] = "0";
                                    $stats['tracker_date'] = "";
                                }
                                array_push($vendorItemStatusArr, $stats);
                            }
                        }
                        $driver_address = $this->getSingleDataRow('driver', 'driver_id="' . $items['driver_id'] . '" ');
                        if ($driver_address) {
                            unset($driver_address['password']);
                            $items['vendor_driver_detail'] = $driver_address;
                        } else {
                            $items['vendor_driver_detail'] = array();
                        }
                        $items['vendor_item_tracking'] = $this->getTableDataArray('order_vendor_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $items['driver_id'] . '" and vendor_tracking_id="' . $items['vendor_tracking_id'] . '"');
                    }
                    $items['vendor_item_status'] = $vendorItemStatusArr;
                    $items['vendor_item_status_count'] = count($vendorItemStatusArr);
                    //////////////////////////////////Vendor Assigned TRACKER////////////////////////////
                    //////////////////////////////////Drop Order TRACKER////////////////////////////
                    $dropItemStatusArr = array();
                    if ($items['drop_driver_id'] > 0) {
                        $order_status = $this->getTableDataArray('order_status', 'type=3 and (order_type_id=3) ');
                        if ($order_status) {
                            foreach ($order_status as $stats) {
                                $getCheck = $this->getSingleDataRow('order_drop_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $items['drop_driver_id'] . '" and drop_tracking_id="' . $items['drop_tracking_id'] . '" and drop_status="' . $stats['status_id'] . '"');
                                if ($getCheck) {
                                    $stats['is_checked'] = "1";
                                    $stats['tracker_date'] = $getCheck['drop_tracking_created_at'];
                                } else {
                                    $stats['is_checked'] = "0";
                                    $stats['tracker_date'] = "";
                                }
                                array_push($dropItemStatusArr, $stats);
                            }
                        }
                        $driver_address = $this->getSingleDataRow('driver', 'driver_id="' . $items['drop_driver_id'] . '" ');
                        if ($driver_address) {
                            unset($driver_address['password']);
                            $items['drop_driver_detail'] = $driver_address;
                        } else {
                            $items['drop_driver_detail'] = array();
                        }
                        $items['drop_item_tracking'] = $this->getTableDataArray('order_drop_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $items['drop_driver_id'] . '" and drop_tracking_id="' . $items['drop_tracking_id'] . '"');
                    }
                    $items['drop_item_status'] = $dropItemStatusArr;
                    $items['drop_item_status_count'] = count($dropItemStatusArr);
                    //////////////////////////////////Drop Order TRACKER////////////////////////////

                    array_push($getOrderItems, $items);
                }
            }
            // echo '<pre/>';print_r($getOrderItems);exit;
            $order['isAnyVendorProduct'] = $isAnyVendorProduct;
            $order['isdeliveredProduct'] = $isdeliveredProduct;
            $order['order_items'] = $getOrderItems;
            $order['items_count'] = count($getOrderItems);
            $users = $this->getSingleDataRow('users', 'user_id="' . $order['user_id'] . '"');
            $data['driver_list'] = $this->Admin_model->getDataResultArray('driver', 'status=1', 'driver_id');
            $order['user_detail'] = $users;
            $address = $this->db->select('u.*,c.name as country_name,ct.name as city_name')->where(['user_id' => $order['user_id'], 'address_id' => $order['address_id']])->from('user_address u')->join('city ct', 'u.city_id=ct.city_id')->join('country_code c', 'u.country_id=c.country_code_id')->get()->row_array();
            $order['shipping_detail'] = $address;

            //////////////////////////////////UPFRONT TRACKER////////////////////////////
            $order_statusArr = array();
            if ($order['driver_id'] > 0) {
                $order_status = $this->getTableDataArray('order_status', 'type=3 and (order_type_id=1) ');
                if ($order_status) {
                    foreach ($order_status as $stats) {
                        $getCheck = $this->getSingleDataRow('order_upfront_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $order['driver_id'] . '" and upfront_tracking_id="' . $order['upfront_tracking_id'] . '" and upfront_status="' . $stats['status_id'] . '"');
                        if ($getCheck) {
                            $stats['is_checked'] = "1";
                            $stats['tracker_date'] = $getCheck['upfront_tracking_created_at'];
                        } else {
                            $stats['is_checked'] = "0";
                            $stats['tracker_date'] = "";
                        }
                        array_push($order_statusArr, $stats);
                    }
                }
            }
            $order['order_status'] = $order_statusArr;
            $order['order_status_count'] = count($order_statusArr);
            $order['order_upfront_tracking'] = $this->getTableDataArray('order_upfront_tracking', 'order_id="' . $order['order_id'] . '" and driver_id="' . $order['driver_id'] . '" and upfront_tracking_id="' . $order['upfront_tracking_id'] . '"');

            $driver_address = $this->getSingleDataRow('driver', 'driver_id="' . $order['driver_id'] . '" ');
            if ($driver_address) {
                unset($driver_address['password']);
                $order['driver_detail'] = $driver_address;
            } else {
                $order['driver_detail'] = array();
            }
            //////////////////////////////////UPFRONT TRACKER////////////////////////////


            $data['order'] = $order;
        } else {
            $data['order'] = array();
        }
        // echo '<pre/>';print_r($data);exit;
        $data['view_link'] = 'orders/completed_order_detail';
        $this->load->view('layout/template', $data);
    }

    public function ajax_method() {
        //print_r($_POST);exit;
        $this->load->view('ajax_order');
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

    public function ajax() {
        //print_r($_POST);exit;
        $this->load->view('ajaxserver');
    }

    public function logout() {
        $this->session->unset_userdata('admin_logged_in');
        redirect('admin');
    }

}

?>
    