<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MX_Controller {

    function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Kolkata");
        $this->load->model('Admin_model');
    }

    public function set_most_viewed_products() {
        $productListArr = array();
        $filter_condition = [];
        $filterAttr = [];
        if (isset($_POST['vendor_id']) && $_POST['vendor_id'] != "") {
            $filter_condition['products.vendor_id'] = $_POST['vendor_id'];
        }
        if (isset($_POST['category_id']) && $_POST['category_id']) {
            $filterAttr = $this->Admin_model->setFilterAttributes(['category_id' => $_POST['category_id']]);
            $filter_condition['products.category_id'] = $_POST['category_id'];
        }
        if (isset($_POST['sub_category_id']) && $_POST['sub_category_id']) {
            $filter_condition['products.sub_category_id'] = $_POST['sub_category_id'];
        }
        if ($filter_condition) {
            $this->db->where($filter_condition);
        }
        $products = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.quantity,pag.price,pag.images,pc.name as category_name,psc.name as sub_category_name")
                        ->where("products.status!=", 99)
                        ->where("pag.group_id", 0)
                        ->where("(products.status=1 or products.status=0)")
                        ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                        ->join("product_category as pc", "pc.category_id=products.category_id")
                        ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
//                        ->join("vendor as v", "v.vendor_id=products.vendor_id")
                        ->group_by('products.product_id')
                        ->order_by('products.total_views','DESC')
                        ->get("products")->result_array();

        if ($products) {
            foreach ($products as $item) {
                $vendor = $this->Admin_model->getDataResultRow('vendor', 'vendor_id="' . $item['vendor_id'] . '"');
                if ($vendor) {
                    $item['vendor_name'] = $vendor['name'];
                } else {
                    $item['vendor_name'] = "Admin";
                }
                $imagesArr = array();
                $item['images'] = trim($item['images'], ',');
                if ($item['images']) {
                    $expImgs = explode(',', $item['images']);
                    if ($expImgs) {
                        foreach ($expImgs as $img) {
                            $product_img = $this->Admin_model->getDataResultRow('product_images', 'product_images_id="' . $img . '"');
                            $imgObj = array('product_images_id' => $product_img['product_images_id'], 'image' => $product_img['file_path'] . $product_img['file_name']);
                            array_push($imagesArr, $imgObj);
                        }
                    }
                }
                //$item['imagesArr']=$imagesArr;
                if (isset($imagesArr[0]['image']) and $imagesArr[0]['image']) {
                    $item['image'] = $imagesArr[0]['image'];
                } else {
                    $item['image'] = "";
                }
                array_push($productListArr, $item);
            }
        }
//        echo '<pre/>';
//        print_r($productListArr);
//        exit;
        $data['type'] = 1;
        $data['product_list'] = $productListArr;
        $data['category_list'] = $this->Admin_model->getDataResultArray('product_category', 'status=1', 'category_id');
        $vendor_list = $this->Admin_model->getDataResultArray('vendor', 'business_type=1 and status!=99', 'vendor_id');
        $data['vendor_list'] = $vendor_list;
        $data['filter_attr'] = $filterAttr;
        $data['view_link'] = 'homepage/product_list';
        $this->load->view('layout/template', $data);
    }

    public function set_most_selling_products() {
        $productListArr = array();
        $filter_condition = [];
        $filterAttr = [];
        if (isset($_POST['vendor_id']) && $_POST['vendor_id'] != "") {
            $filter_condition['products.vendor_id'] = $_POST['vendor_id'];
        }
        if (isset($_POST['category_id']) && $_POST['category_id']) {
            $filterAttr = $this->Admin_model->setFilterAttributes(['category_id' => $_POST['category_id']]);
            $filter_condition['products.category_id'] = $_POST['category_id'];
        }
        if (isset($_POST['sub_category_id']) && $_POST['sub_category_id']) {
            $filter_condition['products.sub_category_id'] = $_POST['sub_category_id'];
        }
        if ($filter_condition) {
            $this->db->where($filter_condition);
        }
        $products = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.quantity,pag.price,pag.images,pc.name as category_name,psc.name as sub_category_name")
                        ->where("products.status!=", 99)
                        ->where("pag.group_id", 0)
                        ->where("(products.status=1 or products.status=0)")
                        ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                        ->join("product_category as pc", "pc.category_id=products.category_id")
                        ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
//                        ->join("vendor as v", "v.vendor_id=products.vendor_id")
                        ->group_by('products.product_id')
                        ->order_by('products.top_selling','DESC')
                        ->get("products")->result_array();

        if ($products) {
            foreach ($products as $item) {
                $vendor = $this->Admin_model->getDataResultRow('vendor', 'vendor_id="' . $item['vendor_id'] . '"');
                if ($vendor) {
                    $item['vendor_name'] = $vendor['name'];
                } else {
                    $item['vendor_name'] = "Admin";
                }
                $imagesArr = array();
                $item['images'] = trim($item['images'], ',');
                if ($item['images']) {
                    $expImgs = explode(',', $item['images']);
                    if ($expImgs) {
                        foreach ($expImgs as $img) {
                            $product_img = $this->Admin_model->getDataResultRow('product_images', 'product_images_id="' . $img . '"');
                            $imgObj = array('product_images_id' => $product_img['product_images_id'], 'image' => $product_img['file_path'] . $product_img['file_name']);
                            array_push($imagesArr, $imgObj);
                        }
                    }
                }
                //$item['imagesArr']=$imagesArr;
                if (isset($imagesArr[0]['image']) and $imagesArr[0]['image']) {
                    $item['image'] = $imagesArr[0]['image'];
                } else {
                    $item['image'] = "";
                }
                array_push($productListArr, $item);
            }
        }
        //echo '<pre/>';print_r($productListArr);exit; 
        $data['type'] = 2;
        $data['product_list'] = $productListArr;
        $data['category_list'] = $this->Admin_model->getDataResultArray('product_category', 'status=1', 'category_id');
        $vendor_list = $this->Admin_model->getDataResultArray('vendor', 'business_type=1 and status!=99', 'vendor_id');
        $data['vendor_list'] = $vendor_list;
        $data['filter_attr'] = $filterAttr;
        $data['view_link'] = 'homepage/product_list';
        $this->load->view('layout/template', $data);
    }

    public function set_popular_service() {
        $filter_condition = [];
        $filterAttr = [];
        if (isset($_POST['vendor_id']) && $_POST['vendor_id'] != "") {
            $filter_condition['service.vendor_id'] = $_POST['vendor_id'];
        }
        if (isset($_POST['category_id']) && $_POST['category_id']) {
            $filter_condition['service.category_id'] = $_POST['category_id'];
        }
        if ($filter_condition) {
            $this->db->where($filter_condition);
        }
        $services = $this->db->select("service.*,c.name as category_name,sb_c.name as sub_category_name,v.name as vendor_name")
                        ->where("service.status!=", 99)
                        ->join("service_category as c", "c.category_id=service.category_id")
                        ->join("service_sub_category as sb_c", "sb_c.sub_category_id=service.sub_category_id")
                        ->join("vendor as v", "v.vendor_id=service.vendor_id")
                        ->order_by('service.total_booking','DESC')
                        ->get("service")->result_array();
        $data['service_list'] = $services;
        $data['category_list'] = $this->Admin_model->getDataResultArray('service_category', 'status=1', 'category_id');
        $vendor_list = $this->Admin_model->getDataResultArray('vendor', 'business_type=2 and status!=99', 'vendor_id');
        $data['vendor_list'] = $vendor_list;
        $data['view_link'] = 'homepage/service_list';
        $this->load->view('layout/template', $data);
    }

    public function about_us() {
        $content = $this->Admin_model->getDataResultRow('content', ['id' => 1]);
        $data['content'] = $content;
        $data['page_name'] = "About Us";
        $data['view_link'] = 'content_management/view';
        $this->load->view('layout/template', $data);
    }

    public function term_conditions() {
        $content = $this->Admin_model->getDataResultRow('content', ['id' => 2]);
        $data['content'] = $content;
        $data['page_name'] = "Terms & Condition";
        $data['view_link'] = 'content_management/view';
        $this->load->view('layout/template', $data);
    }

    public function privacy_policy() {
        $content = $this->Admin_model->getDataResultRow('content', ['id' => 3]);
        $data['content'] = $content;
        $data['page_name'] = "Privacy Policy";
        $data['view_link'] = 'content_management/view';
        $this->load->view('layout/template', $data);
    }

    public function edit_about_us() {
        if (isset($_POST['submit'])) {
            $updateArr = [
                'text' => $this->input->post('text'),
                'text_ar' => $this->input->post('text_ar'),
                'updated_at' => time()
            ];
            $update = $this->Admin_model->updatedataTable('content', ['id' => 1], $updateArr);
            if ($update) {
                $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Updated Successfully</div>');
                redirect('admin/about-us');
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some Error Occured.</div>');
                redirect('admin/edit-about-us');
            }
        }
        $content = $this->Admin_model->getDataResultRow('content', ['id' => 1]);
        $data['content'] = $content;
        $data['page_name'] = "About Us";
        $data['view_link'] = 'content_management/edit';
        $this->load->view('layout/template', $data);
    }

    public function edit_term_conditions() {
        if (isset($_POST['submit'])) {
            $updateArr = [
                'text' => $this->input->post('text'),
                'text_ar' => $this->input->post('text_ar'),
                'updated_at' => time()
            ];
            $update = $this->Admin_model->updatedataTable('content', ['id' => 2], $updateArr);
            if ($update) {
                $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Updated Successfully</div>');
                redirect('admin/term-conditions');
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some Error Occured.</div>');
                redirect('admin/edit-term-conditions');
            }
        }
        $content = $this->Admin_model->getDataResultRow('content', ['id' => 2]);
        $data['content'] = $content;
        $data['page_name'] = "Terms & Condition";
        $data['view_link'] = 'content_management/edit';
        $this->load->view('layout/template', $data);
    }

    public function edit_privacy_policy() {
        if (isset($_POST['submit'])) {
            $updateArr = [
                'text' => $this->input->post('text'),
                'text_ar' => $this->input->post('text_ar'),
                'updated_at' => time()
            ];
            $update = $this->Admin_model->updatedataTable('content', ['id' => 3], $updateArr);
            if ($update) {
                $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Updated Successfully</div>');
                redirect('admin/privacy-policy');
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some Error Occured.</div>');
                redirect('admin/edit-privacy-policy');
            }
        }
        $content = $this->Admin_model->getDataResultRow('content', ['id' => 3]);
        $data['content'] = $content;
        $data['page_name'] = "Privacy Policy";
        $data['view_link'] = 'content_management/edit';
        $this->load->view('layout/template', $data);
    }

    public function user_note() {
        $data['user_list'] = $this->Admin_model->getDataResultArray('users', 'status=1', 'user_id');
        //echo '<pre/>';print_r($data['user_list']);exit;
        $data['view_link'] = 'user/add_note';
        $this->load->view('layout/template', $data);
    }
    public function user_note_list() {
        $data['user_list'] = $this->Admin_model->getDataResultArray('user_note', '', 'user_note_id');
        //echo '<pre/>';print_r($data['user_list']);exit;
        $data['view_link'] = 'user/note_list';
        $this->load->view('layout/template', $data);
    }

    public function send_user_notification() {
        $data['user_list'] = $this->Admin_model->getDataResultArray('users', 'status=1', 'user_id');
        //echo '<pre/>';print_r($data['user_list']);exit;
        $data['view_link'] = 'user/send_user_notification';
        $this->load->view('layout/template', $data);
    }
    
    public function send_notification() {
        $data['view_link'] = 'user/send_notification';
        $this->load->view('layout/template', $data);
    }
    
    public function vendor_note() {
        $data['user_list'] = $this->Admin_model->getDataResultArray('vendor', 'status=1', 'vendor_id');
        //echo '<pre/>';print_r($data['user_list']);exit;
        $data['view_link'] = 'vendor/add_note';
        $this->load->view('layout/template', $data);
    }
    public function vendor_note_list() {
        $data['user_list'] = $this->Admin_model->getDataResultArray('vendor_note', '', 'vendor_note_id');
        //echo '<pre/>';print_r($data['user_list']);exit;
        $data['view_link'] = 'vendor/note_list';
        $this->load->view('layout/template', $data);
    }

    public function ajax() {
        $this->load->view('homepage/setting_ajax');
    }

}
