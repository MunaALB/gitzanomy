<?php

// require 'aws/aws-autoloader.php';

// use Aws\S3\S3Client;

defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('Vendor_model'));
        $this->load->helper('custom_helper');
        date_default_timezone_set('Asia/Kolkata');
        if (!$this->session->userdata('vendor_logged_in')) {
            redirect('vendor');
        } else {
            $this->vendor_data = $this->session->userdata('vendor_logged_in');
            $this->db->select('block_reason,status');
            $vendor = $this->Vendor_model->getDataResultRow('vendor', ['vendor_id' => $this->vendor_data['vendor_id'], 'status' => 2]);
            if ($vendor) {
                echo "<script>alert('تم حظر حسابك من فريق زانومي. رسالة من الإدارة: " . $vendor['block_reason'] . "  يرجى الاتصال بخدمات البائع لإعادة تنشيط الحساب');window.location.href='" . base_url() . "vendor/logout';</script>";
            }

            if (!$this->session->userdata('zanomy_vendor_language_session')) {
                $language = "en";
                $this->session->set_userdata('zanomy_vendor_language_session', $language);
                $session = $this->session->userdata('zanomy_vendor_language_session');
                // echo "<script>window.location.href='".base_url('/')."'</script>";
                $this->language_data = $language;
            } else {
                $this->language_data = $this->session->userdata('zanomy_vendor_language_session');
            }
            // echo $this->language_data;exit;
        }
    }

    public function index() {
        $language_data = $this->language_data;
        $vendor_id = $this->vendor_data['vendor_id'];
        $products = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.quantity,pag.price,pag.images,pc.name as category_name,psc.name as sub_category_name")
                        ->where("products.vendor_id", $vendor_id)
                        ->where("pag.group_id", 0)
                        ->where("products.status!=", 99)
                        ->order_by('product_id', 'DESC')
                        ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                        ->join("product_category as pc", "pc.category_id=products.category_id")
                        ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
                        ->get("products")->result_array();
        $data['product_list'] = $products;
        $services = $this->db->select("service.*,c.name as category_name,sb_c.name as sub_category_name")
                        ->where("service.vendor_id", $vendor_id)
                        ->where("service.status!=", 99)
                        ->join("service_category as c", "c.category_id=service.category_id")
                        ->join("service_sub_category as sb_c", "sb_c.sub_category_id=service.sub_category_id")
                        ->get("service")->result_array();

        $data['service_list'] = $services;
        if ($this->vendor_data['business_type'] == 2) {
            $booking = $this->Vendor_model->getBooking(['b.vendor_id' => $vendor_id, 'b.status>' => 0])->result_array();
            if ($booking) {
                $data['orders'] = count($booking);
                $data['booking_list'] = $booking;
            } else {
                $data['orders'] = 0;
                $data['booking_list'] = [];
            }
        } else {
            $ordersArr = array();
            $orders = $this->db->select("vendor_order.*,o.status,o.payment_type,o.user_status")
                            ->where("vendor_order.vendor_id", $vendor_id)
                            ->where("o.status", 1)
                            ->join("orders as o", "o.order_id=vendor_order.order_id")
                            ->order_by("o.created_at", "DESC")
                            ->limit("10", "0")
                            ->get("vendor_order")->result_array();
            if ($orders) {
                foreach ($orders as $list) {
                    $order_items = $this->Vendor_model->getDataResultArray('order_items', 'order_id="' . $list['order_id'] . '" and vendor_id="' . $vendor_id . '"', 'order_item_id');
                    $list['items_count'] = count($order_items);
                    array_push($ordersArr, $list);
                }

                $data['order_list'] = $ordersArr;
                $data['orders'] = count($ordersArr);
            } else {
                $data['order_list'] = [];
                $data['orders'] = 0;
            }
        }
        //    echo '<pre>';print_r($data);exit;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/dashboard';
            $this->load->view('view_ar/include/template', $data);
        } else {
            $data['view_link'] = 'dashboard';
            $this->load->view('include/template', $data);
        }
    }

    public function my_profile() {
        $language_data = $this->language_data;
        $vendor_id = $this->vendor_data['vendor_id'];
        $vendor = $this->Vendor_model->getRowData(['vendor_id' => $vendor_id], 'vendor');
        if ($vendor['hub_id']) {
            $hub = $this->Vendor_model->getRowData(['id' => $vendor['hub_id']], 'hubs');
            if ($hub) {
                $vendor['hub_name'] = $hub['name'];
            } else {
                $vendor['hub_name'] = 'N/A';
            }
        }
        if ($vendor['city_id']) {
            $city = $this->Vendor_model->getRowData(['city_id' => $vendor['city_id']], 'city');
            if ($city) {
                $vendor['city_name'] = $city['name'];
            } else {
                $vendor['city_name'] = 'N/A';
            }
        } else {
            $vendor['city_name'] = 'N/A';
        }
        $data['vendor'] = $vendor;
        if ($language_data == 'ar') {
            $data['view_link'] = 'view_ar/user/my_profile';
            $this->load->view('view_ar/include/template', $data);
        } else {
            $data['view_link'] = 'user/my_profile';
            $this->load->view('include/template', $data);
        }
    }

    public function edit_profile() {
        $language_data = $this->language_data;
        $vendor_id = $this->vendor_data['vendor_id'];
        $vendor = $this->Vendor_model->getRowData(['vendor_id' => $vendor_id], 'vendor');
        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        $this->form_validation->set_rules('name', 'Full Name', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required');
        if ($this->form_validation->run() == False) {
            $data['vendor'] = $vendor;
            if ($language_data == 'ar') {
                $data['view_link'] = 'view_ar/user/edit_profile';
                $this->load->view('view_ar/include/template', $data);
            } else {
                $data['view_link'] = 'user/edit_profile';
                $this->load->view('include/template', $data);
            }
        } else {
            $image = $this->upload_file('image', 'uploads/vendor', 1);
            if ($image) {
                $_POST['image'] = $image;
            }
//            print_r($_POST);exit;
            $query = $this->Vendor_model->updateData(['vendor_id' => $vendor_id], 'vendor', $_POST);
            if ($language_data == 'ar') {
                if ($query) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>تم تحديث الملف الشخصي بنجاح</div>');
                    redirect('vendor/my-profile');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>حدث خطأ ما. حاول مجددا.</div>');
                    redirect('vendor/edit-profile');
                }
            } else {
                if ($query) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Profile Updated Successfully.</div>');
                    redirect('vendor/my-profile');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some Error Found.</div>');
                    redirect('vendor/edit-profile');
                }
            }
        }
    }

    function change_password() {
        $language_data = $this->language_data;
        $vendor_id = $this->vendor_data['vendor_id'];
        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
        $this->form_validation->set_rules('old_password', 'Old Password', 'required');
        if ($this->form_validation->run() == False) {
            if ($language_data == 'ar') {
                $data['view_link'] = 'view_ar/user/change_password';
                $this->load->view('view_ar/include/template', $data);
            } else {
                $data['view_link'] = 'user/change_password';
                $this->load->view('include/template', $data);
            }
        } else {

            $vendor = $this->Vendor_model->getRowData(['vendor_id' => $vendor_id, 'password' => md5($this->input->post('old_password'))], 'vendor');
            if ($vendor) {
                $update['password'] = md5($this->input->post('password'));
                $query = $this->Vendor_model->updateData(['vendor_id' => $vendor_id], 'vendor', $update);
                if ($query) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>تم تحديث كلمة السر بنجاح</div>');
                    redirect('vendor/my-profile');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>حدث خطأ ما. حاول مجددا.</div>');
                    redirect('vendor/change-password');
                }
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>كلمة السر القديمة غير صحيحة.</div>');
                redirect('vendor/change-password');
            }
        }
    }

    public function plan_list() {
        $language_data = $this->language_data;
        if ($this->vendor_data['business_type'] == 2) {
            $vendor_id = $this->vendor_data['vendor_id'];
            $service_plan_list = [];
            $service_category = $this->Vendor_model->getData(['status' => 1], 'service_category', '', 'name', 'ASC');
            foreach ($service_category as $category) {
                $getPlan = $this->Vendor_model->getRowData(['vendor_id' => $vendor_id, 'service_category_id' => $category['category_id']], 'vendor_subscription');
                if ($getPlan && ($getPlan['expire_date'] > date('Y-m-d H:i:s'))) {
                    $category['selected'] = 1;
                    $category['expire_date'] = $getPlan['expire_date'];
                } else if ($getPlan && ($getPlan['expire_date'] < date('Y-m-d H:i:s'))) {
                    $category['selected'] = 2;
                } else {
                    $category['selected'] = 0;
                }
                $plans = [];
                $plan_list = $this->Vendor_model->getData(['status' => 1, 'service_category_id' => $category['category_id']], 'subscription_plan', '', 'price', 'ASC');
                foreach ($plan_list as $list) {
//                echo '<pre>';
//                print_r($getPlan);
//                if ($getPlan && ($getPlan['plan_id'] == $list['plan_id']) && ($getPlan['expire_date'] > date('Y-m-d H:i:s'))) {
                    if ($getPlan && ($getPlan['plan_id'] == $list['plan_id'])) {
                        if (($getPlan['expire_date'] > date('Y-m-d H:i:s'))) {
                            $list['selected'] = 1;
                        } else if (($getPlan['expire_date'] < date('Y-m-d H:i:s'))) {
                            $list['selected'] = 2;
                        } else {
                            $list['selected'] = 0;
                        }
                    } else {
                        $list['selected'] = 0;
                    }
                    if ($list['price']) {
                        $list['free_plan'] = 0;
                    } else {
                        $getFreePlan = $this->Vendor_model->getRowData(['vendor_id' => $vendor_id, 'service_category_id' => $category['category_id'], 'price' => 0], 'vendor_subscription');
                        if ($getFreePlan) {
                            if (($getFreePlan['expire_date'] > date('Y-m-d H:i:s'))) {
                                $list['selected'] = 1;
                            } else if (($getFreePlan['expire_date'] < date('Y-m-d H:i:s'))) {
                                $list['selected'] = 2;
                            } else {
                                $list['selected'] = 0;
                            }
                        } else {
                            $list['selected'] = 0;
                        }
                        $list['free_plan'] = 1;
                    }
                    array_push($plans, $list);
                }
                $category['plan_list'] = $plans;
                array_push($service_plan_list, $category);
            }
//        echo '<pre>';
//        print_r($service_plan_list);
//        exit;
            $data['category_list'] = $service_plan_list;
            if ($language_data == 'ar') {
                $data['view_link'] = 'view_ar/subscription/subscription';
                $this->load->view('view_ar/include/template', $data);
            } else {
                $data['view_link'] = 'subscription/subscription';
                $this->load->view('include/template', $data);
            }
        } else {
            redirect('vendor/dashboard');
        }
    }

    function request_list() {
        $language_data = $this->language_data;
        if ($this->vendor_data['business_type'] == 2) {
            $vendor_id = $this->vendor_data['vendor_id'];
            $booking = $this->Vendor_model->getBooking(['b.vendor_id' => $vendor_id, 'b.status' => 0])->result_array();
//        echo $this->db->last_query();
//        echo '<pre>';print_r($booking);exit;
            $data['booking_list'] = $booking;
            if ($language_data == 'ar') {
                $data['view_link'] = 'view_ar/request/index';
                $this->load->view('view_ar/include/template', $data);
            } else {
                $data['view_link'] = 'request/index';
                $this->load->view('include/template', $data);
            }
        } else {
            redirect('vendor/order-list');
        }
    }

    function request_detail() {
        $language_data = $this->language_data;
        if ($this->vendor_data['business_type'] == 2) {
            $booking_id = $this->uri->segment(3);
            $vendor_id = $this->vendor_data['vendor_id'];
            $booking = $this->Vendor_model->getBooking(['b.vendor_id' => $vendor_id, 'booking_id' => $booking_id])->row_array();
            if ($booking) {
                $data['booking'] = $booking;
                if ($language_data == 'ar') {
                    $data['view_link'] = 'view_ar/request/detail';
                    $this->load->view('view_ar/include/template', $data);
                } else {
                    $data['view_link'] = 'request/detail';
                    $this->load->view('include/template', $data);
                }
            } else {
                echo "<script>alert('Request not found.');window.location.href='" . base_url() . "vendor/booking-list';</script>";
            }
        } else {
            redirect('vendor/order-list');
        }
    }

    function booking_list() {
        $language_data = $this->language_data;
        if ($this->vendor_data['business_type'] == 2) {
            $vendor_id = $this->vendor_data['vendor_id'];
            $booking = $this->Vendor_model->getBooking(['b.vendor_id' => $vendor_id, 'b.status!=' => 0])->result_array();
//        echo $this->db->last_query();
//        echo '<pre>';print_r($booking);exit;
            $data['booking_list'] = $booking;
            if ($language_data == 'ar') {
                $data['view_link'] = 'view_ar/booking/booking_list';
                $this->load->view('view_ar/include/template', $data);
            } else {
                $data['view_link'] = 'booking/booking_list';
                $this->load->view('include/template', $data);
            }
        } else {
            redirect('vendor/order-list');
        }
    }

    function booking_detail() {
        $language_data = $this->language_data;
        if ($this->vendor_data['business_type'] == 2) {
            $booking_id = $this->uri->segment(3);
            $vendor_id = $this->vendor_data['vendor_id'];
            $booking = $this->Vendor_model->getBooking(['b.vendor_id' => $vendor_id, 'booking_id' => $booking_id])->row_array();
            if ($booking) {
                $data['booking'] = $booking;
                if ($language_data == 'ar') {
                    $data['view_link'] = 'view_ar/booking/booking_detail';
                    $this->load->view('view_ar/include/template', $data);
                } else {
                    $data['view_link'] = 'booking/booking_detail';
                    $this->load->view('include/template', $data);
                }
            } else {
                echo "<script>alert('Booking not found.');window.location.href='" . base_url() . "vendor/booking-list';</script>";
            }
        } else {
            redirect('vendor/order-list');
        }
    }

    function order_list() {
        $language_data = $this->language_data;
        if ($this->vendor_data['business_type'] == 1) {
            $vendor_id = $this->vendor_data['vendor_id'];
            $ordersArr = array();
            $orders = $this->db->select("vendor_order.*,o.status,o.payment_type,o.user_status")
                            ->where("vendor_order.vendor_id", $vendor_id)
                            ->where("o.status", 1)
                            ->join("orders as o", "o.order_id=vendor_order.order_id")
                            ->order_by("o.created_at", "DESC")
                            ->limit("10", "0")
                            ->get("vendor_order")->result_array();
            if ($orders) {
                foreach ($orders as $list) {
                    $order_items = $this->Vendor_model->getDataResultArray('order_items', 'order_id="' . $list['order_id'] . '" and vendor_id="' . $vendor_id . '"', 'order_item_id');
                    $list['items_count'] = count($order_items);
                    array_push($ordersArr, $list);
                }
            }

            // $order = $this->Vendor_model->getOrder(['vendor_id' => $vendor_id]);
            $data['order_list'] = $ordersArr;
            if ($language_data == 'ar') {
                $data['view_link'] = 'view_ar/order/order_list';
                $this->load->view('view_ar/include/template', $data);
            } else {
                $data['view_link'] = 'order/order_list';
                $this->load->view('include/template', $data);
            }
        } else {
            redirect('vendor/booking-list');
        }
    }

    function order_detail() {
        $language_data = $this->language_data;
        if ($this->vendor_data['business_type'] == 1) {
            $order_id = $this->uri->segment(3);
            $vendor_id = $this->vendor_data['vendor_id'];
            $order = $this->Vendor_model->orderDetail($vendor_id, $order_id);
            if ($order) {
                $data['order'] = $order;
                if ($language_data == 'ar') {
                    $data['view_link'] = 'view_ar/order/order_detail';
                    $this->load->view('view_ar/include/template', $data);
                } else {
                    $data['view_link'] = 'order/order_detail';
                    $this->load->view('include/template', $data);
                }
            } else {
                echo "<script>alert('Order not found.');window.location.href='" . base_url() . "vendor/order-list';</script>";
            }
        } else {
            redirect('vendor/booking-list');
        }
    }

    function upload_file($img_name, $uploadPath, $type) {

//print_r($image);exit;
        if (!empty($_FILES[$img_name]['name'])) {
            $file_ext = explode('.', $_FILES[$img_name]['name']);

            $uploadFile = urlencode(time() . $this->my_random_string($this->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];
            $uploadPath = 'uploads/vendor/';
            $reponse = uploadToS3($_FILES[$img_name]['tmp_name'], $uploadFile, $uploadPath);
            if ($reponse) {
                if (isset($reponse['imagepath']) && $reponse['imagepath']) {
                   if ($type == 2) {
                        $insertArr = [
                            'file_path' => 'https://zanomy.s3.us-east-2.amazonaws.com/vendor/',
                            'file_name' => $uploadFile,
                            'file_type' => $file_ext[1],
                            'status' => 1,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        $returnId = $this->Admin_model->addFile($insertArr);
                    } else {
                        $returnId = 'https://zanomy.s3.us-east-2.amazonaws.com/vendor/' . $uploadFile;
                    }
                } else {
                     $returnId = 0;
                }
            } else {
                 $returnId = 0;
            }
//            if (move_uploaded_file($_FILES[$img_name]['tmp_name'], $uploadPath . $uploadFile)) {
//                if ($type == 2) {
//                    $insertArr = [
//                        'file_path' => base_url() . $uploadPath,
//                        'file_name' => $uploadFile,
//                        'file_type' => $file_ext[1],
//                        'status' => 1,
//                        'created_at' => date('Y-m-d H:i:s'),
//                        'updated_at' => date('Y-m-d H:i:s')
//                    ];
//                    $returnId = $this->Admin_model->addFile($insertArr);
//                } else {
//                    $returnId = base_url() . $uploadPath . $uploadFile;
//                }
//            } else {
//                $returnId = 0;
//            }
        } else {
            $returnId = 0;
        }
        return $returnId;
    }

    function remove_special_character($string) {
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        return $string;
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

}
