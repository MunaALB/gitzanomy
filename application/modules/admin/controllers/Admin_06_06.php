<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

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
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin');
        }
    }

    public function index() {
        $users = $this->Admin_model->getDataResultArray('users', 'status!=99', 'user_id');
        if ($users) {
            $data['users_count'] = count($users);
        } else {
            $data['product_count'] = 0;
        }
        $vendor = $this->Admin_model->getDataResultArray('vendor', 'status!=99', 'vendor_id');
        if ($vendor) {
            $data['vendor_count'] = count($vendor);
        } else {
            $data['vendor_count'] = 0;
        }
        $driver = $this->Admin_model->getDataResultArray('driver', 'status!=99', 'driver_id');
        if ($driver) {
            $data['driver_count'] = count($driver);
        } else {
            $data['driver_count'] = 0;
        }
        $featuredProductsArr = array();
        $featuredProducts = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.quantity,pag.price,pag.images,pc.name as category_name,psc.name as sub_category_name")
                        ->where("pag.group_id", 0)
                        ->where("products.status!=", 99)
                        ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                        ->join("product_category as pc", "pc.category_id=products.category_id")
                        ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
                        ->order_by('products.created_at', 'DESC')
                        ->limit(5, 0)
                        ->get("products")->result_array();
        if ($featuredProducts) {
            $featuredProductsArr = $this->getProductDataResult($featuredProducts);
        }

        $services = $this->db->select("service.*,c.name as category_name,sb_c.name as sub_category_name")
                        ->where("service.status!=", 99)
                        ->order_by('service.created_at', 'DESC')
                        ->limit(5, 0)
                        ->join("service_category as c", "c.category_id=service.category_id")
                        ->join("service_sub_category as sb_c", "sb_c.sub_category_id=service.sub_category_id")
                        ->get("service")->result_array();

        $data['product_list'] = $featuredProductsArr;
        //print_r($data['product']);exit;
        $data['services'] = $services;
        $data['view_link'] = 'index';
        $this->load->view('layout/template', $data);
    }

    public function user_list() {
        $data['user_list'] = $this->Admin_model->getDataResultArray('users', 'status!=99', 'user_id');
        //echo '<pre/>';print_r($data['user_list']);exit;
        $data['view_link'] = 'user/user_list';
        $this->load->view('layout/template', $data);
    }

    public function user_detail() {
        $id = $this->uri->segment(3);
        $data['user_detail'] = $this->Admin_model->getDataResultRow('users', 'user_id="' . $id . '" and status!=99');
        //echo '<pre/>';print_r($data);exit;
        if ($data['user_detail']) {
            $data['view_link'] = 'user/user_detail';
            $this->load->view('layout/template', $data);
        } else {
            echo '<script>alert("Data not found");</script>';
            echo '<script>window.location.href="' . base_url('admin/user-list') . '"</script>';
        }
    }

    public function product_vendor_list() {
        $vendorArr = array();
        $vendor_list = $this->Admin_model->getDataResultArray('vendor', 'business_type=1 and status!=99', 'vendor_id');
        if ($vendor_list) {
            foreach ($vendor_list as $list) {
                $product_list = $this->Admin_model->getDataResultArray('products', 'vendor_id="' . $list['vendor_id'] . '" and status!=99', 'product_id');
                if ($product_list) {
                    $list['product_count'] = count($product_list);
                } else {
                    $list['product_count'] = 0;
                }
                array_push($vendorArr, $list);
            }
        }
        $data['vendor_list'] = $vendorArr;
        $data['view_link'] = 'vendor/product_vendor_list';
        $this->load->view('layout/template', $data);
    }

    public function service_vendor_list() {
        $vendorArr = array();
        $vendor_list = $this->Admin_model->getDataResultArray('vendor', 'business_type=2 and status!=99', 'vendor_id');
        if ($vendor_list) {
            foreach ($vendor_list as $list) {
                $service_list = $this->Admin_model->getDataResultArray('service', 'vendor_id="' . $list['vendor_id'] . '" and status!=99', 'service_id');
                if ($service_list) {
                    $list['service_count'] = count($service_list);
                } else {
                    $list['service_count'] = 0;
                }
                array_push($vendorArr, $list);
            }
        }
        $data['vendor_list'] = $vendorArr;
        $data['view_link'] = 'vendor/service_vendor_list';
        $this->load->view('layout/template', $data);
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

    function getProductDataResult($products) {
        $productArr = array();
        foreach ($products as $value) {
            //print_r($value);exit;
            $value['cart_quentity'] = '0';
            $value['is_fav'] = "0";
            $category = $this->getSingleDataRow('product_category', 'category_id="' . $value['category_id'] . '" ');

            $productAttributes = array();
            if ($value['attribute_group_id']) {
                $product_attributes = $this->getTableDataArray('product_attribute', 'group_id="' . $value['attribute_group_id'] . '" and product_id="' . $value['product_id'] . '"');
                if ($product_attributes) {
                    foreach ($product_attributes as $productAttribute) {
                        $category_attribute_id = $this->getSingleDataRow('attribute', 'attribute_id="' . $productAttribute['attribute_id'] . '" ');
                        $category_attribute_value = $this->getSingleDataRow('attribute_value', 'attribute_value_id="' . $productAttribute['attribute_value_id'] . '" ');
                        $attrArr = array('attribute_id' => $productAttribute['attribute_id'], 'attribute_name' => $category_attribute_id['name'], 'attribute_value_id' => $productAttribute['attribute_value_id'], 'attribute_value' => $category_attribute_value['value']);
                        array_push($productAttributes, $attrArr);
                    }
                }
            }

            $value['attributes'] = $productAttributes;

            $value['category_name'] = $category['name'];
            $subcategory = $this->getSingleDataRow('product_sub_category', 'sub_category_id="' . $value['sub_category_id'] . '" ');
            $value['subcategory_name'] = $subcategory['name'];

            $brand = $this->getSingleDataRow('brand', 'brand_id="' . $value['brand_id'] . '" ');
            if ($brand) {
                $value['brand_name'] = $brand['name'];
            } else {
                $value['brand_name'] = "";
            }
            if ($value['discount']) {
                $value['discount_price'] = strval($value['price'] - (($value['price'] * $value['discount']) / 100));
            } else {
                $value['discount_price'] = strval($value['price']);
            }

            $productImages = array();
            //$value['rating']="4";
            if ($value['images']) {
                $images = $this->splitTrimData($value['images']);
                $imagesExp = explode(',', $images);
                if ($imagesExp) {
                    foreach ($imagesExp as $imgVal) {
                        $files = $this->getSingleDataRow('product_images', 'product_images_id="' . $imgVal . '"');
                        if ($files) {
                            $files['image'] = $files['file_path'] . $files['file_name'];
                            array_push($productImages, $files);
                        }
                    }
                }
            }
            $value['images'] = $productImages;
            array_push($productArr, $value);
        }
        return $productArr;
    }

    public function vendor_detail() {
        $id = $this->uri->segment(3);
        $user_detail = $this->Admin_model->getDataResultRow('vendor', 'vendor_id="' . $id . '" and status!=99');
        //echo '<pre/>';print_r($data);exit;
        if ($user_detail) {
            if ($user_detail['hub_id']) {
                $hub = $this->Admin_model->getDataResultRow('hubs', ['id' => $user_detail['hub_id']]);
                if ($hub) {
                    $user_detail['hub_name'] = $hub['name'];
                } else {
                    $user_detail['hub_name'] = 'N/A';
                }
            }
            $featuredProductsArr = array();
            $featuredProducts = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.price,pag.quantity,pag.images")
                            ->where("products.vendor_id", $id)
                            ->where("pag.group_id", 0)
                            ->where("products.status!=", 99)
                            ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                            ->get("products")->result_array();
            if ($featuredProducts) {
                $featuredProductsArr = $this->getProductDataResult($featuredProducts);
            }
            $services = $this->db->select("service.*,c.name as category_name,sb_c.name as sub_category_name")
                            ->where("service.vendor_id", $id)
                            ->where("service.status!=", 99)
                            ->join("service_category as c", "c.category_id=service.category_id")
                            ->join("service_sub_category as sb_c", "sb_c.sub_category_id=service.sub_category_id")
                            ->get("service")->result_array();

            $data['service_list'] = $services;
            if ($user_detail['business_type'] == 1) {
                // $order = $this->Admin_model->getOrderSingleVendor(['vendor_id' => $id, 'status !=' => 0]);
                $ordersArr=array();
                $orders = $this->db->select("vendor_order.*,o.status,o.payment_type,o.user_status,o.user_id")
                        ->where("vendor_order.vendor_id", $id)
                        ->where("o.status", 1)
                        ->join("orders as o", "o.order_id=vendor_order.order_id")
                        ->order_by("o.created_at", "DESC")
                        ->get("vendor_order")->result_array();
            if ($orders) {
                foreach($orders as $list){
                    $order_items = $this->Admin_model->getDataResultArray('order_items', 'order_id="'.$list['order_id'].'" and vendor_id="'.$id.'"','order_item_id');
                    $list['items_count']=count($order_items);
                    array_push($ordersArr,$list);
                }
            }
                $data['order_list'] = $ordersArr;
                $data['booking_list'] = [];
            } else {
                $data['order_list'] = [];
                $booking = $this->Admin_model->getBooking(['b.vendor_id' => $id])->result_array();
                $data['booking_list'] = $booking;
            }
//            echo '<pre>';print_r($data['order_list']);exit;
            $data['vendor_detail'] = $user_detail;
            $data['vendor_product'] = $featuredProductsArr;
            $data['vendor_order'] = array();
            $data['vendor_booking'] = array();
            $data['vendor_transaction'] = array();
            $data['view_link'] = 'vendor/vendor_detail';
            $this->load->view('layout/template', $data);
        } else {
            echo '<script>alert("Data not found");</script>';
            echo '<script>window.location.href="' . base_url('admin/product-vendor-list') . '"</script>';
        }
    }

    public function driver_list() {
        $data['driver_list'] = $this->Admin_model->getDataResultArray('driver', 'status!=99', 'driver_id');
        $data['view_link'] = 'driver/driver_list';
        $this->load->view('layout/template', $data);
    }

    public function add_driver() {
        $data['country_code'] = $this->Admin_model->getDataResultArray('country_code', 'status=1', 'country_code_id');
        $data['view_link'] = 'driver/add_driver';
        $this->load->view('layout/template', $data);
    }

    public function driver_detail() {
        $id = $this->uri->segment(3);
        $user_detail = $this->Admin_model->getDataResultRow('driver', 'driver_id="' . $id . '" and status!=99');
        if ($user_detail) {
            $data['driver_detail'] = $user_detail;
            $data['pending_order'] = array();
            $data['completed_order'] = array();
            $data['cancelled_order'] = array();
            $data['view_link'] = 'driver/driver_detail';
            $this->load->view('layout/template', $data);
        } else {
            echo '<script>alert("Data not found");</script>';
            echo '<script>window.location.href="' . base_url('admin/driver-list') . '"</script>';
        }
    }

    // public function vendor_product_list() {
    //     $data['view_link'] = 'vendor_product_list';
    //     $this->load->view('layout/template', $data);
    // }

    public function admin_service_list() {
        $data['view_link'] = 'admin_service_list';
        $this->load->view('layout/template', $data);
    }

    public function add_new_service() {
        $data['view_link'] = 'add_new_service';
        $this->load->view('layout/template', $data);
    }

    public function vendor_booking_list() {
        $booking = $this->Admin_model->activeBookingList('1');
        $data['booking_list'] = $booking;
        $data['view_link'] = 'booking/vendor_booking_list';
        $this->load->view('layout/template', $data);
    }

    public function vendor_complted_booking_list() {
        $booking = $this->Admin_model->activeBookingList('2');
        $data['booking_list'] = $booking;
        $data['view_link'] = 'booking/vendor_complted_booking_list';
        $this->load->view('layout/template', $data);
    }

    public function booking_detail() {
        $id = $this->uri->segment(3);
        $booking = $this->Admin_model->activeBookingDetail($id);
        if ($booking) {
            if ($booking['vendor_id']) {
                $vendor = $this->Admin_model->getDataResultRow('vendor', 'vendor_id="' . $booking['vendor_id'] . '"');
                if ($vendor) {
                    $booking['vendor_name'] = $vendor['name'];
                } else {
                    $booking['vendor_name'] = "N/A";
                }
            } else {
                $booking['vendor_name'] = "N/A";
            }
            $data['booking'] = $booking;
            $data['view_link'] = 'booking/booking_detail';
            $this->load->view('layout/template', $data);
        } else {
            echo "<script>alert('Booking not found.');window.location.href='" . base_url() . "vendor/vendor-booking-list';</script>";
        }
    }

    public function vendor_request_list() {
        $booking = $this->Admin_model->activeBookingList('3');
        $data['booking_list'] = $booking;
        $data['view_link'] = 'booking/vendor_request_list';
        $this->load->view('layout/template', $data);
    }

    public function request_detail() {
        $id = $this->uri->segment(3);
        $booking = $this->Admin_model->activeBookingDetail($id);
        if ($booking) {
            if ($booking['vendor_id']) {
                $vendor = $this->Admin_model->getDataResultRow('vendor', 'vendor_id="' . $booking['vendor_id'] . '"');
                if ($vendor) {
                    $booking['vendor_name'] = $vendor['name'];
                } else {
                    $booking['vendor_name'] = "N/A";
                }
            } else {
                $booking['vendor_name'] = "N/A";
            }
            $data['booking'] = $booking;
            $data['view_link'] = 'booking/request_detail';
            $this->load->view('layout/template', $data);
        } else {
            echo "<script>alert('Booking not found.');window.location.href='" . base_url() . "vendor/vendor-booking-list';</script>";
        }
    }

    public function admin_booking_list() {
        $data['view_link'] = 'admin_booking_list';
        $this->load->view('layout/template', $data);
    }

    public function vendor_return_list() {
        $data['view_link'] = 'vendor_return_list';
        $this->load->view('layout/template', $data);
    }

    public function add_attribute() {
        $data['attribute'] = $this->Admin_model->getDataResultArray('attribute', '', 'attribute_id');
        if (isset($_POST['addAttr'])) {
            $id = $this->uri->segment(3);
            if ($id) {
                $arr = array('name' => $_POST['name'], 'name_ar' => $_POST['name_ar'], 'status' => 1);
                $insert = $this->Admin_model->updatedataTable('attribute', 'attribute_id="' . $id . '"', $arr);
                if ($insert) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Attribute Updated Successfully.</div>');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some Error Found.</div>');
                }
            } else {
                $arr = array('name' => $_POST['name'], 'name_ar' => $_POST['name_ar'], 'status' => 1);
                $insert = $this->Admin_model->addData('attribute', $arr);
                if ($insert) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Attribute Added Successfully.</div>');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some Error Found.</div>');
                }
            }
            redirect('admin/add-attribute');
        } else {
            $id = $this->uri->segment(3);
            if ($id) {
                $data['single_attribute'] = $this->Admin_model->getDataResultRow('attribute', 'attribute_id="' . $id . '"');
                $data['view_link'] = 'attribute/add_attribute';
                $this->load->view('layout/template', $data);
            } else {
                $data['single_attribute'] = array();
                $data['view_link'] = 'attribute/add_attribute';
                $this->load->view('layout/template', $data);
            }
        }
    }

    public function attribute_list() {
        $where = '';
        if (isset($_POST['attribute'])) {
            $where = ['attribute_id' => $_POST['attribute']];
        } else {
            $where = [];
        }

        $data['attribute_list'] = $this->Admin_model->getDataResultArray('attribute', 'status=1', 'attribute_id');
        $attribute_value_list = $this->Admin_model->getDataResultArray('attribute_value', $where, 'attribute_value_id');
        $data['attribute_value_list'] = $attribute_value_list;

        if (isset($_POST['addValue'])) {
            $id = $this->uri->segment(3);
            if ($id) {
                $arr = array('value' => $_POST['english'], 'value_ar' => $_POST['arabic']);
                $insert = $this->Admin_model->updatedataTable('attribute_value', 'attribute_value_id="' . $id . '"', $arr);
                if ($insert) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Attribute Updated Successfully.</div>');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some Error Found.</div>');
                }
            } else {
                $attribute = $_POST['attribute'];
                $english = $_POST['english'];
                $arabic = $_POST['arabic'];
                if ($english) {
                    foreach ($english as $key => $val) {
                        $obj = array(
                            'attribute_id' => $attribute,
                            'value' => $val,
                            'value_ar' => $arabic[$key],
                            'status' => 1,
                        );
                        $insert = $this->Admin_model->addData('attribute_value', $obj);
                    }
                    if ($insert) {
                        $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Attribute Value Added Successfully.</div>');
                    } else {
                        $this->session->set_flashdata('response', '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some Error Found.</div>');
                    }
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some Error Found.</div>');
                }
            }
            redirect('admin/attribute-list');
        } else {
            $id = $this->uri->segment(3);
            if ($id) {
                $data['single_attribute_value'] = $this->Admin_model->getDataResultRow('attribute_value', 'attribute_value_id="' . $id . '"');
                $data['view_link'] = 'attribute/attribute_list';
                //echo '<pre/>';print_r($data);exit;
                $this->load->view('layout/template', $data);
            } else {
                $data['view_link'] = 'attribute/attribute_list';
                $this->load->view('layout/template', $data);
            }
        }
    }

    public function map_attribute() {
        $data['category_list'] = $this->Admin_model->getDataResultArray('product_category', 'status=1', 'category_id');
        $data['attribute'] = $this->Admin_model->getDataResultArray('attribute', 'status=1', 'attribute_id');
        $data['view_link'] = 'attribute/map_attribute';
        $this->load->view('layout/template', $data);
    }

    public function add_featuers() {
        $data['featuers'] = $this->Admin_model->getDataResultArray('featuers', '', 'featuers_id');
        if (isset($_POST['addAttr'])) {
            $id = $this->uri->segment(3);
            if ($id) {
                $arr = array('name' => $_POST['name'], 'name_ar' => $_POST['name_ar'], 'status' => 1);
                $insert = $this->Admin_model->updatedataTable('featuers', 'featuers_id="' . $id . '"', $arr);
                if ($insert) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Featuers Updated Successfully.</div>');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some Error Found.</div>');
                }
            } else {
                $arr = array('name' => $_POST['name'], 'name_ar' => $_POST['name_ar'], 'status' => 1);
                $insert = $this->Admin_model->addData('featuers', $arr);
                if ($insert) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Featuers Added Successfully.</div>');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some Error Found.</div>');
                }
            }
            redirect('admin/add-featuers');
        } else {
            $id = $this->uri->segment(3);
            if ($id) {
                $data['single_featuers'] = $this->Admin_model->getDataResultRow('featuers', 'featuers_id="' . $id . '"');
                $data['view_link'] = 'attribute/add_featuers';
                $this->load->view('layout/template', $data);
            } else {
                $data['single_featuers'] = array();
                //echo '<pre/>';print_r($data);exit;
                $data['view_link'] = 'attribute/add_featuers';
                $this->load->view('layout/template', $data);
            }
        }
    }

    public function map_featuers() {
        $data['category_list'] = $this->Admin_model->getDataResultArray('product_category', 'status=1', 'category_id');
        $data['featuers'] = $this->Admin_model->getDataResultArray('featuers', 'status=1', 'featuers_id');
        //echo '<pre/>';print_r($data);exit;
        $data['view_link'] = 'attribute/map_featuers';
        $this->load->view('layout/template', $data);
    }

    public function brand_list() {
        $id = $this->uri->segment(3);
        if (isset($id)) {
            $brand_list = $this->Admin_model->getDataResultArray('brand', '', 'brand_id');
            $edit = $this->Admin_model->getDataResultRow('brand', ['brand_id' => $id], '');
            $this->form_validation->set_rules('english', 'English', 'required');
            if ($this->form_validation->run() == False) {
                $data['edit'] = $edit;
                $data['brand_list'] = $brand_list;
                $data['view_link'] = 'brand_list';
                $this->load->view('layout/template', $data);
            } else {
                $updated_images = $this->update_img('image_update', 'uploads/', $edit['image']);
                $update = [
                    'name' => $this->input->post('english'),
                    'name_ar' => $this->input->post('arabic'),
                    'image' => $updated_images,
                ]; //echo '<pre>'; print_r($update);exit;
                $query = $this->Admin_model->updatedataTable('brand', ['brand_id' => $id], $update);
                if ($query) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Updated Successfully.</div>');
                    redirect('admin/brand-list');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while updating.</div>');
                    redirect('admin/brand-list');
                }
            }
        } else {
            $brand_list = $this->Admin_model->getDataResultArray('brand', '', 'brand_id');
            $this->form_validation->set_rules('english', 'English', 'required');
            if ($this->form_validation->run() == False) {
                $data['brand_list'] = $brand_list;
                $data['view_link'] = 'brand_list';
                $this->load->view('layout/template', $data);
            } else {
                $images = $this->upload_img('image', 'uploads/');
                $insertArr = [
                    'name' => ucwords($this->input->post('english')),
                    'name_ar' => ucwords($this->input->post('arabic')),
                    'image' => $images,
                    'status' => 1
                ];
                //echo "<pre>";print_r($insertArr);exit; 

                $returnData = $this->Admin_model->insertData('brand', $insertArr);
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Added Successfully.</div>');
                    redirect('admin/brand-list');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while adding.</div>');
                    redirect('admin/brand-list');
                }
            }
        }
    }

    public function model_list() {
        $where = [];
        $id = $this->uri->segment(3);
        $brand_list = $this->Admin_model->getDataResultArray('brand', '', 'brand_id');
        if (isset($_POST['Brand'])) {
            $where = ['brand_id' => $_POST['Brand']];
        } else {
            $where = [];
        }
        $model_list = $this->Admin_model->getDataResultArray('model', $where, 'model_id');
        if (isset($id)) {
            $edit = $this->Admin_model->getDataResultRow('model', ['model_id' => $id], '');
            $this->form_validation->set_rules('english', 'English', 'required');
            if ($this->form_validation->run() == False) {
                $data['edit'] = $edit;
                $data['model_list'] = $model_list;
                $data['brand_list'] = $brand_list;
                //echo '<pre/>';print_r($data);exit;
                $data['view_link'] = 'model/model';
                $this->load->view('layout/template', $data);
            } else {
                $update = [
                    'brand_id' => $this->input->post('brand'),
                    'name' => ucwords($this->input->post('english')),
                    'name_ar' => ucwords($this->input->post('arabic'))
                ]; //echo '<pre>'; print_r($update);exit;
                $query = $this->Admin_model->updatedataTable('model', ['model_id' => $id], $update);
                if ($query) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Updated Successfully.</div>');
                    redirect('admin/model-list');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while updating.</div>');
                    redirect('admin/model-list');
                }
            }
        } else {
            $this->form_validation->set_rules('english', 'English', 'required');
            if ($this->form_validation->run() == False) {
                $data['model_list'] = $model_list;
                $data['brand_list'] = $brand_list;
                $data['view_link'] = 'model/model';
                $this->load->view('layout/template', $data);
            } else {
                $insertArr = [
                    'brand_id' => $this->input->post('brand'),
                    'name' => ucwords($this->input->post('english')),
                    'name_ar' => ucwords($this->input->post('arabic')),
                    'status' => 1
                ];
                //echo "<pre>";print_r($insertArr);exit; 

                $returnData = $this->Admin_model->insertData('model', $insertArr);
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Added Successfully.</div>');
                    redirect('admin/model-list');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while adding.</div>');
                    redirect('admin/model-list');
                }
            }
        }
    }

    public function map_model() {
        $data['category_list'] = $this->Admin_model->getDataResultArray('product_category', 'status=1', 'category_id');
        $data['brand_list'] = $this->Admin_model->getDataResultArray('brand', 'status=1', 'brand_id');
        $data['view_link'] = 'model/map_model';
        $this->load->view('layout/template', $data);
    }

    public function category_list() {
        $id = $this->uri->segment(3);
        if (isset($id)) {
            $category_list = $this->Admin_model->getDataResultArray('product_category', 'status!=99', 'category_id');
            $edit = $this->Admin_model->getDataResultRow('product_category', ['category_id' => $id, 'status!=' => 99], '');
            //echo '<pre>'; print_r($edit);exit;
            if ($edit) {
                $this->form_validation->set_rules('english', 'English', 'required');
                if ($this->form_validation->run() == False) {
                    $data['edit'] = $edit;
                    $data['category_list'] = $category_list;
                    $data['view_link'] = 'category/category_list';
                    $this->load->view('layout/template', $data);
                } else {
                    $updated_images = $this->update_img('image_update', 'uploads/', $edit['image']);
                    $update = [
                        'name' => $this->input->post('english'),
                        'name_ar' => $this->input->post('arabic'),
                        'image' => $updated_images,
                    ]; //echo '<pre>'; print_r($update);exit;
                    $query = $this->Admin_model->updatedataTable('product_category', ['category_id' => $id], $update);
                    if ($query) {
                        $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Updated Successfully.</div>');
                        redirect('admin/category-list');
                    } else {
                        $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while updating.</div>');
                        redirect('admin/category-list');
                    }
                }
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Category not found.</div>');
                redirect('admin/category-list');
            }
        } else {
            $category_list = $this->Admin_model->getDataResultArray('product_category', 'status!=99', 'category_id');
            $this->form_validation->set_rules('english', 'English', 'required');
            if ($this->form_validation->run() == False) {
                $category_ids = '';
                $data['category_ids'] = $category_ids;
                $data['category_list'] = $category_list;
                $data['view_link'] = 'category/category_list';
                $this->load->view('layout/template', $data);
            } else {
                $images = $this->upload_img('image', 'uploads/');
                $insertArr = [
                    'name' => ucwords($this->input->post('english')),
                    'name_ar' => ucwords($this->input->post('arabic')),
                    'image' => $images,
                    'status' => 1
                ];
                //echo "<pre>";print_r($insertArr);exit; 

                $returnData = $this->Admin_model->insertData('product_category', $insertArr);
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Added Successfully.</div>');
                    redirect('admin/category-list');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while adding.</div>');
                    redirect('admin/category-list');
                }
            }
        }
    }

    public function subcategory_list() {
        $where = ['status!=' => 99];
        $id = $this->uri->segment(3);
        $category_list = $this->Admin_model->getDataResultArray('product_category', 'status=1', 'category_id');
        if (isset($_POST['Category'])) {
            $where = ['category_id' => $_POST['Category'], 'status!=' => 99];
        } else {
            $where = ['status!=' => 99];
        }
        $sub_category_list = $this->Admin_model->getDataResultArray('product_sub_category', $where, 'sub_category_id');
        if (isset($id)) {
            $category_list = $this->Admin_model->getDataResultArray('product_category', 'status=1', 'category_id');
            $edit = $this->Admin_model->getDataResultRow('product_sub_category', ['sub_category_id' => $id, 'status!=' => 99], '');
            if ($edit) {
                $this->form_validation->set_rules('english', 'English', 'required');
                if ($this->form_validation->run() == False) {
                    $data['edit'] = $edit;
                    $data['sub_category_list'] = $sub_category_list;
                    $data['category_list'] = $category_list;
                    $data['view_link'] = 'category/subcategory_list';
                    $this->load->view('layout/template', $data);
                } else {
                    $updated_images = $this->update_img('image_update', 'uploads/', $edit['image']);
                    $updated_images_banner = $this->update_img('bannerImage', 'uploads/', $edit['banner']);
                    $update = [
                        'category_id' => $this->input->post('category'),
                        'name' => ucwords($this->input->post('english')),
                        'name_ar' => ucwords($this->input->post('arabic')),
                        'image' => $updated_images,
                        'banner' => $updated_images_banner
                    ]; //echo '<pre>'; print_r($update);exit;
                    $query = $this->Admin_model->updatedataTable('product_sub_category', ['sub_category_id' => $id], $update);
                    if ($query) {
                        $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Updated Successfully.</div>');
                        redirect('admin/subcategory-list');
                    } else {
                        $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while updating.</div>');
                        redirect('admin/subcategory-list');
                    }
                }
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Sub-Category not found.</div>');
                redirect('admin/subcategory-list');
            }
        } else {
            $this->form_validation->set_rules('english', 'English', 'required');
            if ($this->form_validation->run() == False) {
                $data['sub_category_list'] = $sub_category_list;
                $data['category_list'] = $category_list;
                $data['view_link'] = 'category/subcategory_list';
                $this->load->view('layout/template', $data);
            } else {

                $images = $this->upload_img('image', 'uploads/');
                $images_banner = $this->upload_img('bannerImage', 'uploads/');
                if (isset($_POST['is_brand']) and $_POST['is_brand']) {
                    $_POST['is_brand'] = 1;
                } else {
                    $_POST['is_brand'] = 0;
                }
                if (isset($_POST['is_model']) and $_POST['is_model']) {
                    if ($_POST['is_brand'] == 0) {
                        $_POST['is_model'] = 0;
                    } else {
                        $_POST['is_model'] = 1;
                    }
                } else {
                    $_POST['is_model'] = 0;
                }
                $insertArr = [
                    'category_id' => $this->input->post('category'),
                    'name' => ucwords($this->input->post('english')),
                    'name_ar' => ucwords($this->input->post('arabic')),
                    'image' => $images,
                    'banner' => $images_banner,
                    'is_brand' => $_POST['is_brand'],
                    'is_model' => $_POST['is_model'],
                    'status' => 1,
                    'created_at' => time()
                ];
                //echo "<pre>";print_r($insertArr);exit; 
                $returnData = $this->Admin_model->insertData('product_sub_category', $insertArr);
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Added Successfully.</div>');
                    redirect('admin/subcategory-list');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while adding.</div>');
                    redirect('admin/subcategory-list');
                }
            }
        }
    }

    public function service_category_list() {
        $id = $this->uri->segment(3);
        if (isset($id)) {
            $category_list = $this->Admin_model->getDataResultArray('service_category', 'status!=99', 'category_id');
            $edit = $this->Admin_model->getDataResultRow('service_category', ['category_id' => $id, 'status!=' => 99], '');
//            echo '<pre>'; print_r($category_list);exit;
            if ($edit) {
                $this->form_validation->set_rules('english', 'English', 'required');
                if ($this->form_validation->run() == False) {
                    $data['edit'] = $edit;
                    $data['category_list'] = $category_list;
                    $data['view_link'] = 'category/service_category_list';
                    $this->load->view('layout/template', $data);
                } else {
                    $updated_images = $this->update_img('image_update', 'uploads/', $edit['image']);
                    $update = [
                        'name' => $this->input->post('english'),
                        'name_ar' => $this->input->post('arabic'),
                        'image' => $updated_images,
                    ]; //echo '<pre>'; print_r($update);exit;
                    $query = $this->Admin_model->updatedataTable('service_category', ['category_id' => $id], $update);
                    if ($query) {
                        $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Updated Successfully.</div>');
                        redirect('admin/service-category-list');
                    } else {
                        $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while updating.</div>');
                        redirect('admin/service-category-list');
                    }
                }
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Category not found.</div>');
                redirect('admin/service-category-list');
            }
        } else {
            $category_list = $this->Admin_model->getDataResultArray('service_category', 'status!=99', 'category_id');
//            echo '<pre>'; print_r($category_list);exit;
            $this->form_validation->set_rules('english', 'English', 'required');
            if ($this->form_validation->run() == False) {
                $category_ids = '';
                $data['category_ids'] = $category_ids;
                $data['category_list'] = $category_list;
                $data['view_link'] = 'category/service_category_list';
                $this->load->view('layout/template', $data);
            } else {
                $images = $this->upload_img('image', 'uploads/');
                $insertArr = [
                    'name' => ucwords($this->input->post('english')),
                    'name_ar' => ucwords($this->input->post('arabic')),
                    'image' => $images,
                    'status' => 1
                ];
                //echo "<pre>";print_r($insertArr);exit; 

                $returnData = $this->Admin_model->insertData('service_category', $insertArr);
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Added Successfully.</div>');
                    redirect('admin/service-category-list');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while adding.</div>');
                    redirect('admin/service-category-list');
                }
            }
        }
    }

    public function service_subcategory_list() {
        $where = ['status!=' => 99];
        $id = $this->uri->segment(3);
        $category_list = $this->Admin_model->getDataResultArray('service_category', 'status=1', 'category_id');
        if (isset($_POST['Category'])) {
            $where = ['category_id' => $_POST['Category'], 'status!=' => 99];
        } else {
            $where = ['status!=' => 99];
        }

        $sub_category_list = $this->Admin_model->getDataResultArray('service_sub_category', $where, 'sub_category_id');
//        echo $this->db->last_query();
//        echo '<pre>';
//        print_r($sub_category_list);
//        exit;
        if (isset($id)) {
            $category_list = $this->Admin_model->getDataResultArray('service_category', 'status=1', 'category_id');
            $edit = $this->Admin_model->getDataResultRow('service_sub_category', ['sub_category_id' => $id, 'status!=' => 99], '');
            if ($edit) {
                $this->form_validation->set_rules('english', 'English', 'required');
                if ($this->form_validation->run() == False) {
                    $data['edit'] = $edit;
                    $data['sub_category_list'] = $sub_category_list;
                    $data['category_list'] = $category_list;
                    $data['view_link'] = 'category/service_subcategory_list';
                    $this->load->view('layout/template', $data);
                } else {
                    $updated_images = $this->update_img('image_update', 'uploads/', $edit['image']);
                    $updated_images_banner = $this->update_img('bannerImage', 'uploads/', $edit['banner']);
                    $update = [
                        'category_id' => $this->input->post('category'),
                        'name' => ucwords($this->input->post('english')),
                        'name_ar' => ucwords($this->input->post('arabic')),
                        'image' => $updated_images,
                        'banner' => $updated_images_banner
                    ]; //echo '<pre>'; print_r($update);exit;
                    $query = $this->Admin_model->updatedataTable('service_sub_category', ['sub_category_id' => $id], $update);
                    if ($query) {
                        $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Updated Successfully.</div>');
                        redirect('admin/service-subcategory-list');
                    } else {
                        $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while updating.</div>');
                        redirect('admin/service-subcategory-list');
                    }
                }
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Sub-Category not found.</div>');
                redirect('admin/service-subcategory-list');
            }
        } else {
            $this->form_validation->set_rules('english', 'English', 'required');
            if ($this->form_validation->run() == False) {
                $data['sub_category_list'] = $sub_category_list;
                $data['category_list'] = $category_list;

//                    echo '<pre>'; print_r($category_list);exit;
                $data['view_link'] = 'category/service_subcategory_list';
                $this->load->view('layout/template', $data);
            } else {

                $images = $this->upload_img('image', 'uploads/');
                $images_banner = $this->upload_img('bannerImage', 'uploads/');

                $insertArr = [
                    'category_id' => $this->input->post('category'),
                    'name' => ucwords($this->input->post('english')),
                    'name_ar' => ucwords($this->input->post('arabic')),
                    'image' => $images,
                    'banner' => $images_banner,
                    'status' => 1,
                    'created_at' => time()
                ];
                //echo "<pre>";print_r($insertArr);exit; 
                $returnData = $this->Admin_model->insertData('service_sub_category', $insertArr);
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Added Successfully.</div>');
                    redirect('admin/service-subcategory-list');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while adding.</div>');
                    redirect('admin/service-subcategory-list');
                }
            }
        }
    }

    public function hub_list() {
        $id = $this->uri->segment(3);
        $hub_list = $this->Admin_model->getDataResultArray('hubs', 'status!=99', 'id');
        if (isset($id)) {
            $edit = $this->Admin_model->getDataResultRow('hubs', ['id' => $id, 'status!=' => 99], '');
            if ($edit) {
                $this->form_validation->set_rules('english', 'Hub Name (En)', 'required');
                if ($this->form_validation->run() == False) {
                    $data['edit'] = $edit;
                    $data['hub_list'] = $hub_list;
                    $data['view_link'] = 'delivery_charges/hub_list';
                    $this->load->view('layout/template', $data);
                } else {
                    $update = [
                        'name' => $this->input->post('english'),
                        'name_ar' => $this->input->post('arabic'),
                    ];
                    $query = $this->Admin_model->updatedataTable('hubs', ['id' => $id], $update);
                    if ($query) {
                        $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Updated Successfully.</div>');
                        redirect('admin/hub-list');
                    } else {
                        $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while updating.</div>');
                        redirect('admin/hub-list');
                    }
                }
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Hub not found.</div>');
                redirect('admin/hub-list');
            }
        } else {
            $this->form_validation->set_rules('english', 'Hub Name (En)', 'required');
            if ($this->form_validation->run() == False) {
                $category_ids = '';
                $data['category_ids'] = $category_ids;
                $data['hub_list'] = $hub_list;
                $data['view_link'] = 'delivery_charges/hub_list';
                $this->load->view('layout/template', $data);
            } else {
                $insertArr = [
                    'name' => ucwords($this->input->post('english')),
                    'name_ar' => ucwords($this->input->post('arabic')),
                    'status' => 1
                ];
                //echo "<pre>";print_r($insertArr);exit; 

                $returnData = $this->Admin_model->insertData('hubs', $insertArr);
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Added Successfully.</div>');
                    redirect('admin/hub-list');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while adding.</div>');
                    redirect('admin/hub-list');
                }
            }
        }
    }

    public function city_list() {
        $city_list = $this->Admin_model->getDataResultArray('city', 'status!=99', 'city_id');
        $id = $this->uri->segment(3);
        if (isset($id)) {
            $edit = $this->Admin_model->getDataResultRow('city', ['city_id' => $id, 'status!=' => 99], '');
            //echo '<pre>'; print_r($edit);exit;
            if ($edit) {
                $this->form_validation->set_rules('city_name', 'City Name', 'required');
                if ($this->form_validation->run() == False) {
                    $data['edit'] = $edit;
                    $data['city_list'] = $city_list;
                    $data['view_link'] = 'delivery_charges/city_list';
                    $this->load->view('layout/template', $data);
                } else {
                    $update = [
                        'name' => $this->input->post('city_name'),
                        'name_ar' => $this->input->post('city_name_ar'),
                    ];
                    $query = $this->Admin_model->updatedataTable('city', ['city_id' => $id], $update);
                    if ($query) {
                        $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Updated Successfully.</div>');
                        redirect('admin/city-list');
                    } else {
                        $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while updating.</div>');
                        redirect('admin/city-list');
                    }
                }
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> City not found.</div>');
                redirect('admin/city-list');
            }
        } else {

            $this->form_validation->set_rules('city_name', 'City Name', 'required');
            if ($this->form_validation->run() == False) {
                $category_ids = '';
                $data['category_ids'] = $category_ids;
                $data['city_list'] = $city_list;
                $data['view_link'] = 'delivery_charges/city_list';
                $this->load->view('layout/template', $data);
            } else {
                $insertArr = [
                    'name' => ucwords($this->input->post('city_name')),
                    'name_ar' => ucwords($this->input->post('city_name_ar')),
                    'status' => 1
                ];
                //echo "<pre>";print_r($insertArr);exit; 

                $returnData = $this->Admin_model->insertData('city', $insertArr);
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Added Successfully.</div>');
                    redirect('admin/city-list');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while adding.</div>');
                    redirect('admin/city-list');
                }
            }
        }
    }

    public function delivery_charge() {
        $id = $this->uri->segment(3);
        $city_list = $this->Admin_model->getDataResultArray('city', 'status!=99', 'city_id');
        $hub_list = $this->Admin_model->getDataResultArray('hubs', 'status!=99', 'id');
        $charges_list = [];
        if (isset($_POST['hub'])) {
            $where = ['hub_id' => $_POST['hub'], 'status!=' => 99];
        } else {
            if ($hub_list) {
                $where = ['hub_id' => $hub_list[0]['id'], 'status!=' => 99];
            } else {
                $where = ['status!=' => 99];
            }
        }
        $charges = $this->Admin_model->getDataResultArray('delivery_charges', $where, 'id');
        if ($charges) {
            foreach ($charges as $charge) {
                $hub = $this->Admin_model->getDataResultRow('hubs', ['id' => $charge['hub_id'], 'status!=' => 99], '');
                if ($hub) {
                    $charge['hub_name'] = $hub['name'];
                } else {
                    $charge['hub_name'] = 'N/A';
                }
                $city = $this->Admin_model->getDataResultRow('city', ['city_id' => $charge['city_id'], 'status!=' => 99], '');
                if ($city) {
                    $charge['city_name'] = $city['name'];
                } else {
                    $charge['city_name'] = 'N/A';
                }
                array_push($charges_list, $charge);
            }
        }
        if (isset($id)) {

            $edit = $this->Admin_model->getDataResultRow('delivery_charges', ['id' => $id, 'status!=' => 99], '');
            //echo '<pre>'; print_r($edit);exit;
            if ($edit) {
                $this->form_validation->set_rules('charge', 'Charge', 'required');
                if ($this->form_validation->run() == False) {
                    $data['edit'] = $edit;
                    $data['charges_list'] = $charges_list;
                    $data['city_list'] = $city_list;
                    $data['hub_list'] = $hub_list;
                    $data['view_link'] = 'delivery_charges/index';
                    $this->load->view('layout/template', $data);
                } else {
                    $update = [
                        'hub_id' => $this->input->post('hub_id'),
                        'city_id' => $this->input->post('city_id'),
                        'delivery_charge' => $this->input->post('charge')
                    ];
                    $checkCharge = $this->Admin_model->getDataResultRow('delivery_charges', ['city_id' => $update['city_id'], 'hub_id' => $update['hub_id'], 'id!=' => $id, 'status!=' => 99], '');
                    if ($checkCharge) {
                        $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Delivery charge already added</div>');
                        redirect('admin/delivery-charge');
                    } else {
                        $query = $this->Admin_model->updatedataTable('delivery_charges', ['id' => $id], $update);
                        if ($query) {
                            $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Updated Successfully.</div>');
                            redirect('admin/delivery-charge');
                        } else {
                            $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while updating.</div>');
                            redirect('admin/delivery-charge');
                        }
                    }
                }
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Data not found.</div>');
                redirect('admin/delivery-charge');
            }
        } else {
            $this->form_validation->set_rules('charge', 'Charge', 'required');
            if ($this->form_validation->run() == False) {
                $category_ids = '';
                $data['category_ids'] = $category_ids;
                $data['charges_list'] = $charges_list;
                $data['city_list'] = $city_list;
                $data['hub_list'] = $hub_list;
                $data['view_link'] = 'delivery_charges/index';
                $this->load->view('layout/template', $data);
            } else {
                $insertArr = [
                    'hub_id' => $this->input->post('hub_id'),
                    'city_id' => $this->input->post('city_id'),
                    'delivery_charge' => $this->input->post('charge'),
                    'status' => 1
                ];
                $checkCharge = $this->Admin_model->getDataResultRow('delivery_charges', ['city_id' => $insertArr['city_id'], 'hub_id' => $insertArr['hub_id'], 'status!=' => 99], '');
                if ($checkCharge) {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Delivery charge already added</div>');
                    redirect('admin/delivery-charge');
                } else {
                    $returnData = $this->Admin_model->insertData('delivery_charges', $insertArr);
                    if ($returnData) {
                        $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Added Successfully.</div>');
                        redirect('admin/delivery-charge');
                    } else {
                        $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while adding.</div>');
                        redirect('admin/delivery-charge');
                    }
                }
            }
        }
    }

    public function order_status_management() {
        $id = $this->uri->segment(3);
        if (isset($_POST['type'])) {
            $where = ['type' => $_POST['type'], 'status!=' => 99];
        } else {
            $where = ['type' => 1, 'status!=' => 99];
        }

        $status_list = $this->Admin_model->getDataResultArray('order_status', $where, 'status_id');

        if (isset($id)) {

            $edit = $this->Admin_model->getDataResultRow('order_status', ['status_id' => $id, 'status!=' => 99], '');
            //echo '<pre>'; print_r($edit);exit;
            if ($edit) {
                $this->form_validation->set_rules('order_status', 'Order Status', 'required');
                if ($this->form_validation->run() == False) {
                    $data['edit'] = $edit;
                    $data['status_list'] = $status_list;
                    $data['view_link'] = 'order_settings/order_status';
                    $this->load->view('layout/template', $data);
                } else {
                    $update = [
                        'type' => $this->input->post('type'),
                        'order_status' => $this->input->post('order_status'),
                        'order_status_ar' => $this->input->post('order_status_ar')
                    ];
                    $checkStatus = $this->Admin_model->getDataResultRow('order_status', ['type' => $update['type'], 'order_status' => $update['order_status'], 'status_id!=' => $id, 'status!=' => 99], '');
                    if ($checkStatus) {
                        $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Status already added</div>');
                        redirect('admin/order-status-management');
                    } else {
                        $query = $this->Admin_model->updatedataTable('order_status', ['status_id' => $id], $update);
                        if ($query) {
                            $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Updated Successfully.</div>');
                            redirect('admin/order-status-management');
                        } else {
                            $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while updating.</div>');
                            redirect('admin/order-status-management');
                        }
                    }
                }
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Status not found.</div>');
                redirect('admin/order-status-management');
            }
        } else {
            $this->form_validation->set_rules('order_status', 'Order Status', 'required');
            if ($this->form_validation->run() == False) {
                $data['status_list'] = $status_list;
                $data['view_link'] = 'order_settings/order_status';
                $this->load->view('layout/template', $data);
            } else {
                $insertArr = [
                    'order_status' => $this->input->post('order_status'),
                    'order_status_ar' => $this->input->post('order_status_ar'),
                    'type' => $this->input->post('type'),
                    'status' => 1
                ];
                $checkStatus = $this->Admin_model->getDataResultRow('order_status', ['type' => $insertArr['type'], 'order_status' => $insertArr['order_status'], 'status!=' => 99], '');
                if ($checkStatus) {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Status already added</div>');
                    redirect('admin/order-status-management');
                } else {
                    $returnData = $this->Admin_model->insertData('order_status', $insertArr);
                    if ($returnData) {
                        $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Added Successfully.</div>');
                        redirect('admin/order-status-management');
                    } else {
                        $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while adding.</div>');
                        redirect('admin/order-status-management');
                    }
                }
            }
        }
    }

    // function vendor_order_list() {
    //     $order = $this->Admin_model->getVendorOrder(['status !=' => 0]);
    //     $data['order_list'] = $order;
    //     $data['view_link'] = 'orders/vendor_order_list';
    //     $this->load->view('layout/template', $data);
    // }

    // function admin_order_list() {
    //     $order = $this->Admin_model->getOrder(['vendor_id' => 0, 'item_action!=' => 0]);
    //     $data['order_list'] = $order;
    //     $data['view_link'] = 'orders/admin_order_list';
    //     $this->load->view('layout/template', $data);
    // }

    function vendor_order_detail() {
        $order_id = $this->uri->segment(3);
        $vendor_id = $this->uri->segment(4);
        $order = $this->Admin_model->orderDetail($vendor_id,$order_id);
        $data['driver_list'] = $this->Admin_model->getDataResultArray('driver', 'status=1', 'driver_id');
        if ($order) {
//            echo '<pre>';print_r($order);exit;
            $data['order'] = $order;
            $data['view_link'] = 'orders/vendor_order_detail';
            $this->load->view('layout/template', $data);
        } else {
            echo "<script>alert('Order not found.');window.location.href='" . base_url() . "vendor/order-list';</script>";
        }
    }

    // function admin_order_detail() {
    //     $order_id = $this->uri->segment(3);
    //     $order = $this->Admin_model->orderDetail(['order_id' => $order_id, 'vendor_id' => 0]);
    //     $data['driver_list'] = $this->Admin_model->getDataResultArray('driver', 'status=1', 'driver_id');
    //     if ($order) {
    //         $data['order'] = $order;
    //         $data['view_link'] = 'orders/order_detail';
    //         $this->load->view('layout/template', $data);
    //     } else {
    //         echo "<script>alert('Order not found.');window.location.href='" . base_url() . "vendor/order-list';</script>";
    //     }
    // }

    public function subscription_plan_list() {
        $id = $this->uri->segment(3);
        $category_list = $this->Admin_model->getDataResultArray('service_category', 'status!=99', 'category_id');
        $plan_list = [];
        if (isset($_POST['service_category'])) {
            $where = ['service_category_id' => $_POST['service_category'], 'status!=' => 99];
        } else {
            $where = ['status!=' => 99];
        }
        $plans = $this->Admin_model->getDataResultArray('subscription_plan', $where, 'plan_id');
        if ($plans) {
            foreach ($plans as $plan) {
                $category = $this->Admin_model->getDataResultRow('service_category', ['category_id' => $plan['service_category_id']], '');
                if ($category) {
                    $plan['category_name'] = $category['name'];
                } else {
                    $plan['category_name'] = 'N/A';
                }
                array_push($plan_list, $plan);
            }
        }
        if (isset($id)) {

            $edit = $this->Admin_model->getDataResultRow('subscription_plan', ['plan_id' => $id, 'status!=' => 99], '');
            //echo '<pre>'; print_r($edit);exit;
            if ($edit) {
                $this->form_validation->set_rules('name', 'Name', 'required');
                if ($this->form_validation->run() == False) {
                    $data['edit'] = $edit;
                    $data['plan_list'] = $plan_list;
                    $data['category_list'] = $category_list;
                    $data['view_link'] = 'subscription/index';
                    $this->load->view('layout/template', $data);
                } else {
                    $update = [
                        'name' => $this->input->post('name'),
                        'name_ar' => $this->input->post('name_ar'),
                        'price' => $this->input->post('price'),
                        'discount' => $this->input->post('discount'),
                        'duration' => $this->input->post('duration'),
                        'description' => $this->input->post('description'),
                        'description_ar' => $this->input->post('description_ar')
                    ];

                    $query = $this->Admin_model->updatedataTable('subscription_plan', ['plan_id' => $id], $update);
                    if ($query) {
                        $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Updated Successfully.</div>');
                        redirect('admin/subscription-plan-list');
                    } else {
                        $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while updating.</div>');
                        redirect('admin/subscription-plan-list');
                    }
                }
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Data not found.</div>');
                redirect('admin/subscription-plan-list');
            }
        } else {
            $this->form_validation->set_rules('name', 'Name', 'required');
            if ($this->form_validation->run() == False) {
                $category_ids = '';
                $data['category_ids'] = $category_ids;
                $data['plan_list'] = $plan_list;
                $data['category_list'] = $category_list;
                $data['view_link'] = 'subscription/index';
                $this->load->view('layout/template', $data);
            } else {
                $insertArr = [
                    'service_category_id' => $this->input->post('service_category_id'),
                    'name' => $this->input->post('name'),
                    'name_ar' => $this->input->post('name_ar'),
                    'price' => $this->input->post('price'),
                    'discount' => $this->input->post('discount'),
                    'duration' => $this->input->post('duration'),
                    'description' => $this->input->post('description'),
                    'description_ar' => $this->input->post('description_ar'),
                    'status' => 1
                ];
                $returnData = $this->Admin_model->insertData('subscription_plan', $insertArr);
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Added Successfully.</div>');
                    redirect('admin/subscription-plan-list');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while adding.</div>');
                    redirect('admin/subscription-plan-list');
                }
            }
        }
    }

    public function vendor_service_list() {
        $services = $this->db->select("service.*,c.name as category_name,sb_c.name as sub_category_name")
//                            ->where("service.vendor_id", $vendor_id)
                        ->where("service.status!=", 99)
                        ->join("service_category as c", "c.category_id=service.category_id")
                        ->join("service_sub_category as sb_c", "sb_c.sub_category_id=service.sub_category_id")
                        ->get("service")->result_array();
//echo '<pre>';print_r($services);exit;
        $data['service_list'] = $services;
        $data['view_link'] = 'service/vendor_service_list';
        $this->load->view('layout/template', $data);
    }

    public function service_detail() {
        $service_id = $this->uri->segment(3);
        $services = $this->db->select("service.*,c.name as category_name,sb_c.name as sub_category_name,v.name as vendor_name")
//                            ->where("service.vendor_id", $vendor_id)
                        ->where("service.service_id", $service_id)
                        ->where("service.status!=", 99)
                        ->join("service_category as c", "c.category_id=service.category_id")
                        ->join("service_sub_category as sb_c", "sb_c.sub_category_id=service.sub_category_id")
                        ->join("vendor as v", "service.vendor_id=v.vendor_id")
                        ->get("service")->row_array();
        if ($services) {
            $service_feature = $this->Admin_model->getDataResultArray('service_featuer', ['service_id' => $service_id], 'service_id');
            $data['service'] = $services;
            $data['service_feature'] = $service_feature;
            $data['view_link'] = 'service/service_detail';
            $this->load->view('layout/template', $data);
        } else {
            echo "<script>alert('Service not found. Some Error Occured.');window.location.href='" . base_url() . "admin/vendor-service-list';</script>";
        }
    }

    public function upfront_management() {
        $settings = $this->Admin_model->getDataResultRow('admin', [], '');
        if (!isset($_POST['submit'])) {
            $data['setting'] = $settings;
            $data['view_link'] = 'settings/upfront';
            $this->load->view('layout/template', $data);
        } else {
            $update = [
                'upfront' => $this->input->post('upfront')
            ];

            $query = $this->Admin_model->updatedataTable('admin', ['id' => $settings['id']], $update);
            if ($query) {
                $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Updated Successfully.</div>');
                redirect('admin/upfront-management');
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Error while updating.</div>');
                redirect('admin/upfront-management');
            }
        }
    }

    public function upload_img($img_name, $uploadPath) {
        if (!empty($_FILES[$img_name]['name'])) {

            $file_ext = explode('.', $_FILES[$img_name]['name']);
            $uploadFile = urlencode(time() . $this->my_random_string($this->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];

            if (move_uploaded_file($_FILES[$img_name]['tmp_name'], $uploadPath . $uploadFile)) {

                $result = base_url() . $uploadPath . $uploadFile;
            } else {
                $result = 0;
            }
        } else {
            $result = 0;
        }
        return $result;
    }

    public function update_img($img_name, $uploadPath, $old_image) {
        if (!empty($_FILES[$img_name]['name'])) {

            $file_ext = explode('.', $_FILES[$img_name]['name']);
            $uploadFile = urlencode(time() . $this->my_random_string($this->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];

            if (move_uploaded_file($_FILES[$img_name]['tmp_name'], $uploadPath . $uploadFile)) {

                $result = base_url() . $uploadPath . $uploadFile;
            } else {
                $result = $old_image;
            }
        } else {
            $result = $old_image;
        }
        return $result;
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

    public function ajax_method() {
        //print_r($_POST);exit;
        $this->load->view('ajax_function');
    }

    public function logout() {
        $this->session->unset_userdata('admin_logged_in');
        redirect('admin');
    }

}

?>
    