<?php

// require 'aws/aws-autoloader.php';

// use Aws\S3\S3Client;

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->database();
        $this->load->helper('string');
        $this->load->helper('custom_helper');
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
            if ($urlExceptions != 'ajax') {
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

    public function add_new_product() {
        //echo '<pre/>';print_r($_POST);exit;
        if (isset($_POST['add_product'])) {
            $model_id = 0;
            $model_mapped = strtotime(date('Y-m-d H:i:s'));
            $brand_id = 0;
            if (isset($_POST['brand_id']) and $_POST['brand_id']) {
                $brand_mapping = $this->Admin_model->getDataResultRow('brand_mapping', 'brand_mapping_id="' . $_POST['brand_id'] . '"');
                if ($brand_mapping) {
                    $brand_id = $brand_mapping['brand_id'];
                } else {
                    $brand_id = 0;
                }
            }
            if (isset($_POST['model_id']) and $_POST['model_id']) {
                $model_id = $_POST['model_id'];
                $productsChecker = $this->Admin_model->getDataResultRow('products', 'model_id="' . $model_id . '" and status="1"');
                if ($productsChecker) {
                    $model_mapped = $productsChecker['model_mapped'];
                }
            }
            $product = array(
                'hub_id' => $_POST['hub_id'],
                'product_from' => $_POST['product_from'],
                'category_id' => $_POST['category_id'],
                'sub_category_id' => $_POST['sub_category_id'],
                'brand_id' => $brand_id,
                'model_id' => $model_id,
                'model_mapped' => $model_mapped,
                'primary_attribute' => 1,
                'discount' => $_POST['discount'],
                'name' => $_POST['name'],
                'name_ar' => $_POST['name_ar'],
                'description_short' => $_POST['description'],
                'description_short_ar' => $_POST['description_ar'],
                'description' => $_POST['description'],
                'description_ar' => $_POST['description_ar'],
                'weight' => $_POST['weight'],
                'height' => $_POST['height'],
                'terms' => $_POST['terms'],
                'terms_ar' => $_POST['terms_ar'],
                'is_returnable' => $_POST['is_returnable'],
                'duration' => $_POST['duration'],
                'return_policy' => $_POST['return_policy'],
                'return_policy_ar' => $_POST['return_policy_ar'],
                'expected_delivery' => $_POST['expected_delivery'],
                'created_at' => strtotime(date('Y-m-d H:i:s')),
                'updated_at' => strtotime(date('Y-m-d H:i:s')),
                'status' => 1
            );
            // echo '<pre/>';print_r($product);exit;
            $product = $this->Admin_model->addData('products', $product);
            if ($product) {

                $group_id = 0;
                $parentId = 0;
                if (isset($_POST['attribute'])) {
                    $group_id = rand(1000, 9999);
                    $attribute = $_POST['attribute'];
                    foreach ($attribute as $key => $val) {
                        if ($_POST['attribute_value']) {
                            $checkDtaAttr = $this->Admin_model->getDataResultRow('attribute_mapping', 'category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '" and attribute_id="' . $val . '"');
                            $isPrimary = $checkDtaAttr['is_primary'];
                            if ($isPrimary == 1) {
                                //echo $key.'<pre/>';print_r($_POST['attribute']);exit;
                                $getGroupData1 = $this->Admin_model->getDataResultRow('product_attribute', 'product_id="' . $product . '" and attribute_value_id="' . $_POST['attribute_value'][$key] . '" and is_primary=1');
                                //echo $this->db->last_query();exit;
                                //echo $key.'<pre/>';print_r($getGroupData1);exit;
                                if ($getGroupData1) {
                                    $parentId = 0;
                                    $isNew = 0;
                                    $subParentId = 0;
                                } else {
                                    $parentId = 0;
                                    $isNew = 1;
                                    $subParentId = 0;
                                }
                            } elseif ($isPrimary == 2) {
                                $getGroupData1 = $this->Admin_model->getDataResultRow('product_attribute', 'product_id="' . $product . '" and group_id="' . $group_id . '" and is_primary=1');
                                //echo $this->db->last_query();exit;
                                //echo $key.'<pre/>';print_r($getGroupData1);exit;
                                if ($getGroupData1['is_new'] == 1) {
                                    $parentId = $getGroupData1['product_attribute_id'];
                                    $isNew = 1;
                                    $subParentId = 0;
                                } else {
                                    $getGroupData2 = $this->Admin_model->getDataResultRow('product_attribute', 'product_id="' . $product . '" and attribute_value_id="' . $getGroupData1['attribute_value_id'] . '" and is_primary=1 and is_new=1');
                                    $parentId = $getGroupData2['product_attribute_id'];
                                    $subParentId = 0;
                                    $isNew = 0;
                                }
                            } elseif ($isPrimary == 3) {
                                $getGroupData1 = $this->Admin_model->getDataResultRow('product_attribute', 'product_id="' . $product . '" and group_id="' . $group_id . '" and is_primary=2');
                                if ($getGroupData1['is_new'] == 1) {
                                    $subParentId = $getGroupData1['product_attribute_id'];
                                    $parentId = $getGroupData1['parent_id'];
                                    $isNew = 1;
                                } else {
                                    $getGroupData2 = $this->Admin_model->getDataResultRow('product_attribute', 'product_id="' . $product . '" and attribute_value_id="' . $getGroupData1['attribute_value_id'] . '" and is_primary=1');
                                    $getGroupData3 = $this->Admin_model->getDataResultRow('product_attribute', 'product_id="' . $product . '" and group_id="' . $getGroupData2['group_id'] . '" and is_primary=2');
                                    $subParentId = $getGroupData3['product_attribute_id'];
                                    $parentId = $getGroupData3['parent_id'];
                                    $isNew = 0;
                                }
                            }
                            if (isset($parentId) and $parentId) {
                                
                            } else {
                                $parentId = 0;
                            }
                            $attrData = array(
                                'parent_id' => $parentId,
                                'sub_parent_id' => $subParentId,
                                'is_new' => $isNew,
                                'group_id' => $group_id,
                                'product_id' => $product,
                                'category_id' => $_POST['category_id'],
                                'sub_category_id' => $_POST['sub_category_id'],
                                'is_primary' => $key + 1,
                                'attribute_id' => $val,
                                'attribute_value_id' => $_POST['attribute_value'][$key],
                            );
                            $attr = $this->Admin_model->addData('product_attribute', $attrData);
                        }
                    }
                }
                if (isset($_POST['specification'])) {
                    $specification = $_POST['specification'];
                    foreach ($specification as $key => $val) {
                        if ($_POST['specification_value']) {
                            $specfyData = array(
                                'product_id' => $product,
                                'category_id' => $_POST['category_id'],
                                'sub_category_id' => $_POST['sub_category_id'],
                                'attribute_id' => $val,
                                'attribute_value_id' => $_POST['specification_value'][$key],
                            );
                            $attr = $this->Admin_model->addData('product_specification', $specfyData);
                        }
                    }
                }
                if (isset($_POST['featuers'])) {
                    $featuers = $_POST['featuers'];
                    foreach ($featuers as $key => $val) {
                        if ($_POST['featuers_value']) {
                            $featuersData = array(
                                'product_id' => $product,
                                'featuers_id' => $val,
                                'value' => $_POST['featuers_value'][$key],
                            );
                            $attr = $this->Admin_model->addData('product_featuers', $featuersData);
                        }
                    }
                }


                $imagesAr = array();
                $uploadImages = "";
                if (!empty($_FILES['image']['name'])) {
                    foreach ($_FILES['image']['name'] as $key => $name) {
                        if ($name != '') {
                            $file_ext = explode('.', $_FILES['image']['name'][$key]);
                            $countExt = count($file_ext) - 1;
                            $uploadFile = urlencode(time() . $this->Admin_model->my_random_string($this->Admin_model->remove_special_character($file_ext[0]))) . '.' . $file_ext[$countExt];

//                            if (move_uploaded_file($_FILES['image']['tmp_name'][$key], 'uploads/products/' . $uploadFile)) {
//                                $insertArr = [
//                                    'file_path' => base_url() . 'uploads/products/',
//                                    'file_name' => $uploadFile,
//                                    'file_type' => $file_ext[$countExt],
//                                ];
//                                $return = $this->Admin_model->addData('product_images', $insertArr);
//                                $returnId = $this->db->insert_id();
//                                if ($returnId) {
//                                    array_push($imagesAr, $returnId);
//                                }
//                            }
                            $uploadPath = 'uploads/products/';
                            $reponse = uploadToS3($_FILES['image']['tmp_name'][$key], $uploadFile, $uploadPath);
                            if ($reponse) {
                                if (isset($reponse['imagepath']) && $reponse['imagepath']) {
                                    $insertArr = [
                                        'file_path' => 'https://zanomy.s3.us-east-2.amazonaws.com/products/',
                                        'file_name' => $uploadFile,
                                        'file_type' => $file_ext[$countExt],
                                    ];
                                    $return = $this->Admin_model->addData('product_images', $insertArr);
                                    $returnId = $this->db->insert_id();
                                    if ($returnId) {
                                        array_push($imagesAr, $returnId);
                                    }
                                }
                            }
                        }
                    }
                }
                $uploadImages = trim(implode(',', $imagesAr), ',');

                $attrData = array(
                    'group_id' => 0,
                    'attribute_group_id' => $group_id,
                    'product_id' => $product,
                    'category_id' => $_POST['category_id'],
                    'sub_category_id' => $_POST['sub_category_id'],
                    'item_no' => $_POST['sku'],
                    'price' => $_POST['price'],
                    'quantity' => $_POST['stock'],
                    'discount' => $_POST['discount'],
                    'images' => $uploadImages,
                );
                $addItems = $this->Admin_model->addData('product_attribute_group', $attrData);
                ///////////////////////////////////////////////////////////////////////////
                // if(isset($_POST['attribute_value']) and $_POST['attribute_value']){
                //     if(isset($_POST['attribute_value'][0]) and $_POST['attribute_value'][0]){
                //         $first=$_POST['attribute_value'][0];
                //     }else{
                //         $first=0;
                //     }
                //     if(isset($_POST['attribute_value'][1]) and $_POST['attribute_value'][1]){
                //         $second=$_POST['attribute_value'][1];
                //     }else{
                //         $second=0;
                //     }if(isset($_POST['attribute_value'][2]) and $_POST['attribute_value'][2]){
                //         $third=$_POST['attribute_value'][2];
                //     }else{
                //         $third=0;
                //     }
                //     $attrmapping=array(
                //         'item_id'  => $addItems,
                //         'group_id'  => $group_id,
                //         'first'=> $first,
                //         'second'  => $second,
                //         'third'  => $third
                //     );
                //     $attr=$this->Admin_model->addData('product_attribute_mapping',$attrmapping);
                // }
                $value_id_1 = 0;
                $value_id_2 = 0;
                $value_id_3 = 0;
                $attribute_mapping = $this->Admin_model->getDataResultArray('product_attribute', 'product_id="' . $product . '" and group_id="' . $group_id . '"', '');
                if ($attribute_mapping) {
                    foreach ($attribute_mapping as $key => $list) {
                        if ($key == 0) {
                            $value_id_1 = $list['attribute_value_id'];
                        }if ($key == 1) {
                            $value_id_2 = $list['attribute_value_id'];
                        }if ($key == 2) {
                            $value_id_3 = $list['attribute_value_id'];
                        }
                    }
                    $attrmapping = array(
                        'product_id' => $product,
                        'item_id' => $addItems,
                        'category_id' => $_POST['category_id'],
                        'sub_category_id' => $_POST['sub_category_id'],
                        'value_id_1' => $value_id_1,
                        'value_id_2' => $value_id_2,
                        'value_id_3' => $value_id_3,
                    );
                    $attr = $this->Admin_model->addData('product_filter', $attrmapping);
                }
                ///////////////////////////////////////////////////////////////////////////

                $htmlData = '<div class="modal fade modal-design show" id="productupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" style="display:block;    top: -131px;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="messege-box">
                                <img src="' . base_url('assets/uploadproduct.png') . '" alt="success messege">
                                <h3>Your Product has been uploaded Successfully</h3>
                            </div>';
                if (isset($_POST['attribute'])) {
                    $htmlData .= '<div class="action-button">
                                    <p>Do you want to upload more specification</p>
                                    <a href="' . base_url('admin/add-more-attribute/' . $product) . '" class="btn btn-primary mybtns">Yes</a>
                                    <a href="' . base_url('admin/add-new-product') . '" class="btn btn-primary mybtns" data-dismiss="modal">Skip</a>
                                </div>';
                } else {
                    $htmlData .= '<div class="action-button">
                                    <a href="' . base_url('admin/add-new-product') . '" class="btn btn-primary mybtns" data-dismiss="modal">Continue</a>
                                </div>';
                }
                $htmlData .= '</div>
                        </div>
                    </div>
                </div>
            </div>';
                $this->session->set_flashdata('response', $htmlData);
                redirect('admin/add-new-product');
            } else {
                $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Some Error Found.</div>');
                redirect('admin/add-new-product');
            }
        } else {
            $data['category_list'] = $this->Admin_model->getDataResultArray('product_category', 'status=1', 'category_id');
            $data['hub_list'] = $this->Admin_model->getDataResultArray('hubs', 'status=1', 'id');
            $data['view_link'] = 'product/add_new_product';
            $this->load->view('layout/template', $data);
        }
    }

    public function add_product_price() {
        if (isset($_POST['add_product'])) {
            //echo '<pre/>';print_r($_POST);exit;
            $productsArr = array();
            if (isset($_POST['category_id']) and $_POST['category_id']) {
                $this->db->where('products.category_id', $_POST['category_id']);
            }
            if (isset($_POST['product']) and $_POST['product']) {
                if ($_POST['product'] == 1) {
                    $this->db->where("products.vendor_id", 0);
                }
            }
            $products = $this->db->select("products.category_id,products.vendor_id,pag.product_id,pag.item_id,pag.attribute_group_id,pag.item_no,pag.quantity,pag.discount,pag.price,pag.images,pc.name as category_name,psc.name as sub_category_name")
                            ->where("products.status!=", 99)
                            ->where("pag.group_id", 0)
                            ->where("pag.item_status!=", 99)
                            ->where("products.status!=", 99)
                            ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                            ->join("product_category as pc", "pc.category_id=products.category_id")
                            ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
                            // ->group_by('pag.product_id')
                            ->get("products")->result_array();
            // echo '<pre/>';print_r($products);exit;
            // echo $this->db->last_query();exit;
            if ($products) {
                foreach ($products as $pro) {
                    $price = $pro['price'];
                    $discount = $price * $_POST['value'] / 100;
                    if ($_POST['type'] == 1) {
                        $price = $price + $discount;
                    } else {
                        $price = $price - $discount;
                    }
                    $price = intval($price);
                    $pro['i_price'] = $price;
                    $pro['i_discount'] = $discount;
                    $pro['old_price'] = $pro['price'];

                    $updateArr = array(
                        'price' => $price
                    );
                    $product = $this->Admin_model->updateData(['item_id' => $pro['item_id']], 'product_attribute_group', $updateArr);
                    array_push($productsArr, $pro);
                }
                // echo '<pre/>';print_r($productsArr);exit;
                if ($product) {
                    echo "<script>alert('Product updated.');window.location.href='" . base_url() . "admin/add-product-price';</script>";
                } else {
                    echo "<script>alert('Product not updated.');window.location.href='" . base_url() . "admin/add-product-price';</script>";
                }
                // echo '<pre/>';print_r($productsArr);exit;
            } else {
                echo "No any porduct updated";
            }
        } else {
            $data['category_list'] = $this->Admin_model->getDataResultArray('product_category', 'status=1', 'category_id');
            $data['view_link'] = 'product/add_product_price';
            $this->load->view('layout/template', $data);
        }
    }

    function add_more_attribute() {
        $attributeArr = array();
        if ($this->uri->segment(3)) {
            $product_id = $this->uri->segment(3);
            $products = $this->Admin_model->getDataResultRow('products', 'product_id="' . $product_id . '"');
            if ($products) {
                if (isset($_POST['add_product'])) {
                    if (isset($_POST['attribute'])) {

                        $group_id = rand(1000, 9999);
                        $attribute = $_POST['attribute'];
                        //echo '<pre/>';print_r($_POST['attribute_value']);exit;
                        $firstKeyVal = 0;
                        foreach ($attribute as $key => $val) {
                            if ($key == 0) {
                                $firstKeyVal = $_POST['attribute_value'][0];
                            }
                            if ($_POST['attribute_value']) {

                                $checkDtaAttr = $this->Admin_model->getDataResultRow('attribute_mapping', 'category_id="' . $products['category_id'] . '" and sub_category_id="' . $products['sub_category_id'] . '" and attribute_id="' . $val . '"');
                                //echo $key.'<pre/>';print_r($checkDtaAttr);exit;
                                $isPrimary = $checkDtaAttr['is_primary'];
                                if ($isPrimary == 1) {
                                    //echo $key.'<pre/>';print_r($_POST['attribute']);exit;
                                    $getGroupData1 = $this->Admin_model->getDataResultRow('product_attribute', 'product_id="' . $products['product_id'] . '" and attribute_value_id="' . $_POST['attribute_value'][$key] . '" and is_primary=1');
                                    //echo $this->db->last_query();exit;
                                    //echo $key.'<pre/>';print_r($getGroupData1);exit;
                                    if ($getGroupData1) {
                                        $parentId = 0;
                                        $isNew = 0;
                                        $subParentId = 0;
                                    } else {
                                        $parentId = 0;
                                        $isNew = 1;
                                        $subParentId = 0;
                                    }
                                } elseif ($isPrimary == 2) {
                                    $getGroupData1 = $this->Admin_model->getDataResultRow('product_attribute', 'product_id="' . $products['product_id'] . '" and group_id="' . $group_id . '" and is_primary=1');
                                    //echo $this->db->last_query();exit;
                                    //echo $key.'<pre/>';print_r($getGroupData1);exit;
                                    if ($getGroupData1['is_new'] == 1) {
                                        $parentId = $getGroupData1['product_attribute_id'];
                                        $isNew = 1;
                                        $subParentId = 0;
                                    } else {
                                        $checkerOn = false;
                                        $valueProduct = $this->Admin_model->getDataResultArray('product_attribute', 'product_id="' . $products['product_id'] . '" and attribute_value_id="' . $getGroupData1['attribute_value_id'] . '"', 'product_attribute_id');
                                        //echo $this->db->last_query();exit;
                                        if ($valueProduct) {
                                            foreach ($valueProduct as $v1) {
                                                $checkIsNew = $this->Admin_model->getDataResultRow('product_attribute', 'product_id="' . $products['product_id'] . '" and group_id="' . $v1['group_id'] . '" and attribute_value_id="' . $_POST['attribute_value'][$key] . '" and is_primary=2');
                                                if ($checkIsNew) {
                                                    $checkerOn = true;
                                                    break;
                                                }
                                            }
                                        }
                                        $getGroupData2 = $this->Admin_model->getDataResultRow('product_attribute', 'product_id="' . $products['product_id'] . '" and attribute_value_id="' . $getGroupData1['attribute_value_id'] . '" and is_primary=1 and is_new=1');
                                        $parentId = $getGroupData2['product_attribute_id'];
                                        $subParentId = 0;
                                        if ($checkerOn) {
                                            $isNew = 0;
                                        } else {
                                            $isNew = 1;
                                        }
                                    }
                                } elseif ($isPrimary == 3) {
                                    $getGroupData1 = $this->Admin_model->getDataResultRow('product_attribute', 'product_id="' . $products['product_id'] . '" and group_id="' . $group_id . '" and is_primary=2');
                                    if ($getGroupData1['is_new'] == 1) {
                                        $subParentId = $getGroupData1['product_attribute_id'];
                                        $parentId = $getGroupData1['parent_id'];
                                        $isNew = 1;
                                    } else {
                                        $subParentId = 0;
                                        $parentId = 0;
                                        // $getGroupData2    = $this->Admin_model->getDataResultRow('product_attribute','product_id="'.$products['product_id'].'" and attribute_value_id="'.$getGroupData1['attribute_value_id'].'" and is_primary=1'); 
                                        // $getGroupData2    = $this->Admin_model->getDataResultRow('product_attribute','product_id="'.$products['product_id'].'" and product_attribute_id="'.$getGroupData1['parent_id'].'"'); 
                                        $getGroupData2 = $this->Admin_model->getDataResultArray('product_attribute', 'product_id="' . $products['product_id'] . '" and attribute_value_id="' . $getGroupData1['attribute_value_id'] . '" and is_new=1', 'product_attribute_id');

                                        if ($getGroupData2) {
                                            foreach ($getGroupData2 as $vals1) {
                                                $checkIsNew = $this->Admin_model->getDataResultRow('product_attribute', 'product_id="' . $products['product_id'] . '" and group_id="' . $vals1['group_id'] . '" and attribute_value_id="' . $firstKeyVal . '" and is_primary=1');
                                                // echo $this->db->last_query();exit;
                                                // echo '<pre>';print_r($checkIsNew);exit;
                                                if ($checkIsNew) {
                                                    $subParentId = $vals1['product_attribute_id'];
                                                    $parentId = $vals1['parent_id'];
                                                    break;
                                                }
                                            }
                                        }
                                        // echo $this->db->last_query();exit;
                                        // echo '<pre/>';print_r($getGroupData2);exit;
                                        $getGroupData3 = $this->Admin_model->getDataResultRow('product_attribute', 'product_id="' . $products['product_id'] . '" and group_id="' . $getGroupData2['group_id'] . '" and is_primary=2');
                                        //echo $this->db->last_query();exit;
                                        // $subParentId=$checkerOn;
                                        // $parentId=$getGroupData3['parent_id'];
                                        $isNew = 0;
                                    }
                                }
                                if (isset($parentId) and $parentId) {
                                    
                                } else {
                                    $parentId = 0;
                                }
                                $attrData = array(
                                    'parent_id' => $parentId,
                                    'sub_parent_id' => $subParentId,
                                    'is_new' => $isNew,
                                    'group_id' => $group_id,
                                    'product_id' => $products['product_id'],
                                    'category_id' => $products['category_id'],
                                    'sub_category_id' => $products['sub_category_id'],
                                    'is_primary' => $key + 1,
                                    'attribute_id' => $val,
                                    'attribute_value_id' => $_POST['attribute_value'][$key],
                                );

                                // $attrData=array(
                                //     'group_id'  => $group_id,
                                //     'product_id'=> $product_id,
                                //     'category_id'  => $products['category_id'],
                                //     'sub_category_id'  => $products['sub_category_id'],
                                //     'attribute_id'  => $val,
                                //     'attribute_value_id'  => $_POST['attribute_value'][$key],
                                // );
                                $attr = $this->Admin_model->addData('product_attribute', $attrData);
                            }
                        }
                        //echo '<pre/>';print_r($_FILES['image']['name'][0]);exit;
                        $imagesAr = array();
                        $uploadImages = "";
                        if (!empty($_FILES['image']['name'])) {
                            foreach ($_FILES['image']['name'] as $key => $name) {
                                if ($name != '') {
                                    $file_ext = explode('.', $_FILES['image']['name'][$key]);
                                    $countExt = count($file_ext) - 1;
                                    $uploadFile = urlencode(time() . $this->Admin_model->my_random_string($this->Admin_model->remove_special_character($file_ext[0]))) . '.' . $file_ext[$countExt];

//                                    if (move_uploaded_file($_FILES['image']['tmp_name'][$key], 'uploads/products/' . $uploadFile)) {
//                                        $insertArr = [
//                                            'file_path' => base_url() . 'uploads/products/',
//                                            'file_name' => $uploadFile,
//                                            'file_type' => $file_ext[$countExt],
//                                        ];
//                                        $return = $this->Admin_model->addData('product_images', $insertArr);
//                                        $returnId = $this->db->insert_id();
//                                        if ($returnId) {
//                                            array_push($imagesAr, $returnId);
//                                        }
//                                    }
                                    $uploadPath = 'uploads/products/'; 
                                    $reponse = uploadToS3($_FILES['image']['tmp_name'][$key], $uploadFile, $uploadPath);
                                    if ($reponse) {
                                        if (isset($reponse['imagepath']) && $reponse['imagepath']) {
//                                    $result = $reponse['imagepath'];
                                            $insertArr = [
                                                'file_path' => 'https://zanomy.s3.us-east-2.amazonaws.com/products/',
                                                'file_name' => $uploadFile,
                                                'file_type' => $file_ext[$countExt],
                                            ];
                                            $return = $this->Admin_model->addData('product_images', $insertArr);
                                            $returnId = $this->db->insert_id();
                                            if ($returnId) {
                                                array_push($imagesAr, $returnId);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        $uploadImages = trim(implode(',', $imagesAr), ',');
                        //echo $uploadImages;exit;
                        $item_data = $this->Admin_model->getDataResultRow('product_attribute_group', 'product_id="' . $product_id . '" and group_id=0');
                        $attrData = array(
                            'group_id' => $item_data['item_id'],
                            'attribute_group_id' => $group_id,
                            'product_id' => $product_id,
                            'category_id' => $products['category_id'],
                            'sub_category_id' => $products['sub_category_id'],
                            'item_no' => $_POST['sku'],
                            'price' => $_POST['price'],
                            'quantity' => $_POST['stock'],
                            'discount' => $_POST['discount'],
                            'images' => $uploadImages,
                        );
                        $addItems = $this->Admin_model->addData('product_attribute_group', $attrData);

                        // if(isset($_POST['attribute_value']) and $_POST['attribute_value']){
                        //     if(isset($_POST['attribute_value'][0]) and $_POST['attribute_value'][0]){
                        //         $first=$_POST['attribute_value'][0];
                        //     }else{
                        //         $first=0;
                        //     }
                        //     if(isset($_POST['attribute_value'][1]) and $_POST['attribute_value'][1]){
                        //         $second=$_POST['attribute_value'][1];
                        //     }else{
                        //         $second=0;
                        //     }if(isset($_POST['attribute_value'][2]) and $_POST['attribute_value'][2]){
                        //         $third=$_POST['attribute_value'][2];
                        //     }else{
                        //         $third=0;
                        //     }
                        //     $attrmapping=array(
                        //         'item_id'  => $addItems,
                        //         'group_id'  => $group_id,
                        //         'first'=> $first,
                        //         'second'  => $second,
                        //         'third'  => $third
                        //     );
                        //     $attr=$this->Admin_model->addData('product_attribute_mapping',$attrmapping);
                        // }

                        $value_id_1 = 0;
                        $value_id_2 = 0;
                        $value_id_3 = 0;
                        $attribute_mapping = $this->Admin_model->getDataResultArray('product_attribute', 'product_id="' . $product_id . '" and group_id="' . $group_id . '"', '');
                        if ($attribute_mapping) {
                            foreach ($attribute_mapping as $key => $list) {
                                if ($key == 0) {
                                    $value_id_1 = $list['attribute_value_id'];
                                }if ($key == 1) {
                                    $value_id_2 = $list['attribute_value_id'];
                                }if ($key == 2) {
                                    $value_id_3 = $list['attribute_value_id'];
                                }
                            }
                            $attrmapping = array(
                                'product_id' => $product_id,
                                'item_id' => $addItems,
                                'category_id' => $products['category_id'],
                                'sub_category_id' => $products['sub_category_id'],
                                'value_id_1' => $value_id_1,
                                'value_id_2' => $value_id_2,
                                'value_id_3' => $value_id_3,
                            );
                            $attr = $this->Admin_model->addData('product_filter', $attrmapping);
                        }


                        $this->session->set_flashdata('response', '<div class="modal fade modal-design show" id="productupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" style="display:block;    top: -131px;">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="messege-box">
                                                    <img src="http://gropse.com/gropse.com/design/zanomyvendor.com/common/images/uploadproduct.png" alt="success messege">
                                                    <h3>Your Product has been uploaded Successfully</h3>
                                                    <p>Do you want to upload more specification</p>
                                                </div>
                                                <div class="action-button">
                                                    <a href="' . base_url('admin/add-more-attribute/' . $products['product_id']) . '" class="btn btn-primary mybtns">Yes</a>
                                                    <a href="' . base_url('admin/add-new-product') . '" class="btn btn-primary mybtns" data-dismiss="modal">Skip</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>');
                        redirect('admin/add-new-product');
                    }
                } else {

                    $attribute_mapping = $this->db->select("attribute_mapping.*,a.name,a.name_ar,a.attribute_id")
                                    ->where("attribute_mapping.category_id", $products['category_id'])
                                    ->where("attribute_mapping.sub_category_id", $products['sub_category_id'])
                                    ->where("attribute_mapping.type", 1)
                                    ->where("a.status", 1)
                                    ->join("attribute as a", "a.attribute_id=attribute_mapping.attribute_id")
                                    ->get("attribute_mapping")->result_array();
                    if ($attribute_mapping) {
                        foreach ($attribute_mapping as $attr) {
                            $value = $this->Admin_model->getDataResultArray('attribute_value', 'status=1 and attribute_id="' . $attr['attribute_id'] . '"', 'attribute_value_id');
                            //echo '<pre/>';print_r($value);exit;
                            if ($value) {
                                $attr['attribute_value'] = $value;
                                array_push($attributeArr, $attr);
                            }
                        }
                    }
                    $category_id = $this->Admin_model->getDataResultRow('product_category', 'category_id="' . $products['category_id'] . '"');
                    if ($category_id) {
                        $products['category_name'] = $category_id['name'];
                    } else {
                        $products['category_name'] = "N/A";
                    }
                    $sub_category_id = $this->Admin_model->getDataResultRow('product_sub_category', 'sub_category_id="' . $products['sub_category_id'] . '"');
                    if ($sub_category_id) {
                        $products['sub_category_name'] = $sub_category_id['name'];
                    } else {
                        $products['sub_category_name'] = "N/A";
                    }

                    $brand_id = $this->Admin_model->getDataResultRow('brand', 'brand_id="' . $products['brand_id'] . '"');
                    if ($brand_id) {
                        $products['brand_name'] = $brand_id['name'];
                    } else {
                        $products['brand_name'] = "N/A";
                    }
                    $model_id = $this->Admin_model->getDataResultRow('model', 'brand_id="' . $products['model_id'] . '"');
                    if ($model_id) {
                        $products['model_name'] = $model_id['name'];
                    } else {
                        $products['model_name'] = "N/A";
                    }

                    $data['products'] = $products;
                    $data['attribute'] = $attributeArr;
                    //echo '<pre/>';print_r($attributeArr);exit;
                    $data['view_link'] = 'product/add_more_attribute';
                    $this->load->view('layout/template', $data);
                }
            }
        }
    }

    public function admin_product_list() {
        $productListArr = array();
        $filter_condition = [];
        $filterAttr = [];
        if (isset($_POST['category_id']) && $_POST['category_id']) {
            $filterAttr = $this->Admin_model->setFilterAttributes(['category_id' => $_POST['category_id']]);
            $filter_condition['products.category_id'] = $_POST['category_id'];
        }
        if (isset($_POST['sub_category_id']) && $_POST['sub_category_id']) {
            $filter_condition['products.sub_category_id'] = $_POST['sub_category_id'];
        }
        if (isset($_POST['brand_id']) && $_POST['brand_id']) {
            $filter_condition['products.brand_id'] = $_POST['brand_id'];
        }
        if (isset($_POST['model_id']) && $_POST['model_id']) {
            $filter_condition['products.model_id'] = $_POST['model_id'];
        }
        if ($filter_condition) {
            $this->db->where($filter_condition);
        }
        // $products = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.quantity,pag.discount,pag.price,pag.images,pc.name as category_name,psc.name as sub_category_name")
        $products = $this->db->select("products.product_id,products.product_from,products.name,products.status,pag.item_id,pag.attribute_group_id,pag.item_no,pag.quantity,pag.discount,pag.price,pag.images,pc.name as category_name,psc.name as sub_category_name")
                        ->where("products.status!=", 99)
                        ->where("products.vendor_id", 0)
                        ->where("pag.group_id", 0)
                        ->where("pag.item_status!=", 99)
                        ->where("products.status!=", 99)
                        ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                        ->join("product_category as pc", "pc.category_id=products.category_id")
                        ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
                        ->group_by('pag.product_id')
                        ->get("products")->result_array();

        if ($products) {
            foreach ($products as $item) {
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
//        echo '<pre/>';print_r($productListArr);exit;                    
        $data['product_list'] = $productListArr;
        $data['category_list'] = $this->Admin_model->getDataResultArray('product_category', 'status=1', 'category_id');
        $data['filter_attr'] = $filterAttr;
        $data['view_link'] = 'product/admin_product_list';
        $this->load->view('layout/template', $data);
    }

    public function vendor_product_list() {
        $productListArr = array();
        $filter_condition = [];
        $filterAttr = [];
        if (isset($_POST['vendor_id']) && $_POST['vendor_id']) {
            $filter_condition['products.vendor_id'] = $_POST['vendor_id'];
        }
        if (isset($_POST['category_id']) && $_POST['category_id']) {
            $filterAttr = $this->Admin_model->setFilterAttributes(['category_id' => $_POST['category_id']]);
            $filter_condition ['products.category_id'] = $_POST['category_id'];
        }
        if (isset($_POST['sub_category_id']) && $_POST['sub_category_id']) {
            $filter_condition ['products.sub_category_id'] = $_POST['sub_category_id'];
        }
        if (isset($_POST['brand_id']) && $_POST['brand_id']) {
            $filter_condition['products.brand_id'] = $_POST['brand_id'];
        }
        if (isset($_POST['model_id']) && $_POST['model_id']) {
            $filter_condition['products.model_id'] = $_POST['model_id'];
        }
        if ($filter_condition) {
            $this->db->where($filter_condition);
        }
        $products = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.quantity,pag.discount,pag.price,pag.images,pc.name as category_name,psc.name as sub_category_name,v.name as vendor_name")
                        ->where("products.status!=", 99)
                        ->where("products.vendor_id!=", 0)
                        ->where("pag.group_id", 0)
                        ->where("pag.item_status!=", 99)
                        ->where("(products.status=1 or products.status=0)")
                        ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                        ->join("product_category as pc", "pc.category_id=products.category_id")
                        ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
                        ->join("vendor as v", "v.vendor_id=products.vendor_id")
                        ->group_by('pag.product_id')
                        ->get("products")->result_array();

        if ($products) {
            foreach ($products as $item) {
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
                $item['image'] = $imagesArr[0]['image'];
                array_push($productListArr, $item);
            }
        }
        //echo '<pre/>';print_r($productListArr);exit;                    
        $data['product_list'] = $productListArr;
        $data['category_list'] = $this->Admin_model->getDataResultArray('product_category', 'status=1', 'category_id');
        $vendor_list = $this->Admin_model->getDataResultArray('vendor', 'business_type=1 and status!=99', 'vendor_id');
        $data['vendor_list'] = $vendor_list;
        $data['filter_attr'] = $filterAttr;
        $data['view_link'] = 'product/vendor_product_list';
        $this->load->view('layout/template', $data);
    }

    public function vendor_unverified_product_list() {
        $productListArr = array();
        $filter_condition = [];
        $filterAttr = [];
        if (isset($_POST['vendor_id']) && $_POST['vendor_id']) {
            $filter_condition['products.vendor_id'] = $_POST['vendor_id'];
        }
        if (isset($_POST['category_id']) && $_POST['category_id']) {
            $filterAttr = $this->Admin_model->setFilterAttributes(['category_id' => $_POST['category_id']]);
            $filter_condition['products.category_id'] = $_POST['category_id'];
        }
        if (isset($_POST['sub_category_id']) && $_POST['sub_category_id']) {
            $filter_condition['products.sub_category_id'] = $_POST['sub_category_id'];
        }
        if (isset($_POST['brand_id']) && $_POST['brand_id']) {
            $filter_condition['products.brand_id'] = $_POST['brand_id'];
        }
        if (isset($_POST['model_id']) && $_POST['model_id']) {
            $filter_condition['products.model_id'] = $_POST['model_id'];
        }
        if ($filter_condition) {
            $this->db->where($filter_condition);
        }
        $products = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.quantity,pag.discount,pag.price,pag.images,pc.name as category_name,psc.name as sub_category_name,v.name as vendor_name")
                        ->where("products.status!=", 99)
                        ->where("products.vendor_id!=", 0)
                        ->where("pag.group_id", 0)
                        ->where("pag.item_status!=", 99)
                        ->where("products.status", 2)
                        ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                        ->join("product_category as pc", "pc.category_id=products.category_id")
                        ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
                        ->join("vendor as v", "v.vendor_id=products.vendor_id")
                        ->group_by('pag.product_id')
                        ->get("products")->result_array();
        if ($products) {
            foreach ($products as $item) {
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
                $item['image'] = $imagesArr[0]['image'];
                array_push($productListArr, $item);
            }
        }
        //echo '<pre/>';print_r($productListArr);exit;
        $data['product_list'] = $productListArr;
        $data['category_list'] = $this->Admin_model->getDataResultArray('product_category', 'status=1', 'category_id');
        $vendor_list = $this->Admin_model->getDataResultArray('vendor', 'business_type=1 and status!=99', 'vendor_id');
        $data['vendor_list'] = $vendor_list;
        $data['filter_attr'] = $filterAttr;
        $data['view_link'] = 'product/vendor_product_list';
        $this->load->view('layout/template', $data);
    }

    public function vendor_rejected_product_list() {
        $productListArr = array();
        $filter_condition = [];
        $filterAttr = [];
        if (isset($_POST['vendor_id']) && $_POST['vendor_id']) {
            $filter_condition['products.vendor_id'] = $_POST['vendor_id'];
        }
        if (isset($_POST['category_id']) && $_POST['category_id']) {
            $filterAttr = $this->Admin_model->setFilterAttributes(['category_id' => $_POST['category_id']]);
            $filter_condition['products.category_id'] = $_POST['category_id'];
        }
        if (isset($_POST['sub_category_id']) && $_POST['sub_category_id']) {
            $filter_condition['products.sub_category_id'] = $_POST['sub_category_id'];
        }
        if (isset($_POST['brand_id']) && $_POST['brand_id']) {
            $filter_condition['products.brand_id'] = $_POST['brand_id'];
        }
        if (isset($_POST['model_id']) && $_POST['model_id']) {
            $filter_condition['products.model_id'] = $_POST['model_id'];
        }
        if ($filter_condition) {
            $this->db->where($filter_condition);
        }
        $products = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.quantity,pag.discount,pag.price,pag.images,pc.name as category_name,psc.name as sub_category_name,v.name as vendor_name")
                        ->where("products.status!=", 99)
                        ->where("products.vendor_id!=", 0)
                        ->where("pag.group_id", 0)
                        ->where("pag.item_status!=", 99)
                        ->where("products.status", 3)
                        ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                        ->join("product_category as pc", "pc.category_id=products.category_id")
                        ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
                        ->join("vendor as v", "v.vendor_id=products.vendor_id")
                        ->group_by('pag.product_id')
                        ->get("products")->result_array();
        if ($products) {
            foreach ($products as $item) {
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
                $item['image'] = $imagesArr[0]['image'];
                array_push($productListArr, $item);
            }
        }
        //echo '<pre/>';print_r($productListArr);exit;
        $data['product_list'] = $productListArr;
        $data['category_list'] = $this->Admin_model->getDataResultArray('product_category', 'status=1', 'category_id');
        $vendor_list = $this->Admin_model->getDataResultArray('vendor', 'business_type=1 and status!=99', 'vendor_id');
        $data['vendor_list'] = $vendor_list;
        $data['filter_attr'] = $filterAttr;
        $data['view_link'] = 'product/vendor_product_list';
        $this->load->view('layout/template', $data);
    }

    public function product_detail() {
        $productId = $this->uri->segment(3);
        $products = $this->db->select("products.*,pc.name as category_name,psc.name as sub_category_name")
                        ->where("products.product_id", $productId)
                        ->where("products.status!=", 99)
                        ->where("pag.item_status!=", 99)
                        ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                        ->join("product_category as pc", "pc.category_id=products.category_id")
                        ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
                        ->get("products")->row_array();
        if ($products) {
            $itemArr = array();
            $product_attribute_group = $this->Admin_model->getDataResultArray('product_attribute_group', 'product_id="' . $productId . '"', 'item_id');
            if ($product_attribute_group) {
                foreach ($product_attribute_group as $pag) {
                    $attributeArr = array();
                    $product_attribute = $this->Admin_model->getDataResultArray('product_attribute', 'product_id="' . $productId . '" and group_id="' . $pag['attribute_group_id'] . '"', 'product_attribute_id');
                    if ($product_attribute) {
                        //echo '<pre/>';print_r($product_attribute);exit;
                        foreach ($product_attribute as $pa) {
                            $attribute = $this->Admin_model->getDataResultRow('attribute', 'attribute_id="' . $pa['attribute_id'] . '"');
                            $attribute_value = $this->Admin_model->getDataResultRow('attribute_value', 'attribute_value_id="' . $pa['attribute_value_id'] . '"');
                            //echo $pa['attribute_value_id'];exit;
                            //print_r($attribute_value);exit;
                            $attributeObj = array('product_attribute_id' => $pa['product_attribute_id'], 'attribute_id' => $pa['attribute_id'], 'attribute_name' => $attribute['name'], 'attribute_value_id' => $pa['attribute_value_id'], 'attribute_value' => $attribute_value['value']);
                            array_push($attributeArr, $attributeObj);
                        }
                    }

                    $imagesArr = array();
                    $pag['images'] = trim($pag['images'], ',');
                    if ($pag['images']) {
                        $expImgs = explode(',', $pag['images']);
                        if ($expImgs) {
                            foreach ($expImgs as $img) {
                                $product_img = $this->Admin_model->getDataResultRow('product_images', 'product_images_id="' . $img . '"');
                                $imgObj = array('product_images_id' => $product_img['product_images_id'], 'image' => $product_img['file_path'] . $product_img['file_name']);
                                array_push($imagesArr, $imgObj);
                            }
                        }
                    }
                    $pag['attribute_data'] = $attributeArr;
                    $pag['imagesArr'] = $imagesArr;
                    array_push($itemArr, $pag);
                }
            }
            $products['product_attribute_group'] = $itemArr;
            $specificationArr = array();
            $product_specification = $this->Admin_model->getDataResultArray('product_specification', 'product_id="' . $productId . '"', 'product_specification_id');
            //echo '<pre/>';print_r($product_specification);exit;
            if ($product_specification) {
                foreach ($product_specification as $pa) {
                    $attribute = $this->Admin_model->getDataResultRow('attribute', 'attribute_id="' . $pa['attribute_id'] . '"');
                    $attribute_value = $this->Admin_model->getDataResultRow('attribute_value', 'attribute_value_id="' . $pa['attribute_value_id'] . '"');
                    $attributeObj = array('product_attribute_id' => $pa['product_specification_id'], 'attribute_id' => $pa['attribute_id'], 'attribute_name' => $attribute['name'], 'attribute_value_id' => $pa['attribute_value_id'], 'attribute_value' => $attribute_value['value']);
                    array_push($specificationArr, $attributeObj);
                }
            }
            $products['product_specification'] = $specificationArr;

            $featuersArr = array();
            $product_featuers = $this->Admin_model->getDataResultArray('product_featuers', 'product_id="' . $productId . '"', 'product_featuers_id');
            if ($product_featuers) {
                foreach ($product_featuers as $pa) {
                    $attribute_value = $this->Admin_model->getDataResultRow('featuers', 'featuers_id="' . $pa['featuers_id'] . '"');
                    $pa['name'] = $attribute_value['name'];
                    array_push($featuersArr, $pa);
                }
            }
            $products['product_featuers'] = $featuersArr;

            $brand_id = $this->Admin_model->getDataResultRow('brand', 'brand_id="' . $products['brand_id'] . '"');
            if ($brand_id) {
                $products['brand_name'] = $brand_id['name'];
            } else {
                $products['brand_name'] = "N/A";
            }
            $model_id = $this->Admin_model->getDataResultRow('model', 'brand_id="' . $products['model_id'] . '"');
            if ($model_id) {
                $products['model_name'] = $model_id['name'];
            } else {
                $products['model_name'] = "N/A";
            }

            $attribute_mapping = $this->Admin_model->getDataResultArray('attribute_mapping', 'category_id="' . $products['category_id'] . '" and sub_category_id="' . $products['sub_category_id'] . '"', 'attribute_mapping_id');
            if ($attribute_mapping) {
                $products['add_more_attribute'] = 1;
            } else {
                $products['add_more_attribute'] = 0;
            }
            // echo '<pre/>';print_r($products);exit;
            $data['product_list'] = $products;
            $data['view_link'] = 'product/product_detail';
            $this->load->view('layout/template', $data);
        } else {
            echo "<script>alert('Product not found.');window.location.href='" . base_url() . "admin/admin-product-list';</script>";
        }
        //echo '<pre/>';print_r($products);exit;
    }

    public function edit_product_detail() {
        $productId = $this->uri->segment(3);
        if (isset($_POST['edit_product'])) {


            $itemIds = $_POST['item_ids'];
            if (isset($itemIds) and $itemIds) {
                foreach ($itemIds as $index => $itm_id) {
                    //$expImgs=[];
                    $attribute = $this->Admin_model->getDataResultRow('product_attribute_group', 'item_id="' . $itm_id . '" AND product_id="' . $productId . '"');
                    if ($attribute) {
                        $imagesArr = array();
                        $attribute['images'] = trim($attribute['images'], ',');
                        if ($attribute['images']) {
                            $expImgs = explode(',', $attribute['images']);
                            if ($expImgs) {
                                foreach ($expImgs as $img) {
                                    $product_img = $this->Admin_model->getDataResultRow('product_images', 'product_images_id="' . $img . '"');
                                    $imgObj = array('product_images_id' => $product_img['product_images_id'], 'image' => $product_img['file_path'] . $product_img['file_name']);
                                    array_push($imagesArr, $imgObj);
                                }
                            }
                        } else {
                            $expImgs = [];
                        }
                        $attribute['imagesArr'] = $imagesArr;
                    }
                    foreach ($_FILES['image' . $itm_id]['name'] as $key => $file) {
                        // echo '<pre/>';print_r($file);exit;
                        if ($file) {
                            $file_ext = explode('.', $file);
                            $uploadPath = 'uploads/products/';
                            $uploadFile = urlencode(time() . $this->my_random_string($this->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];
//                            if (move_uploaded_file($_FILES['image' . $itm_id]['tmp_name'][$key], $uploadPath . $uploadFile)) {
//                                $insertTmgArr = [
//                                    'file_path' => base_url() . $uploadPath,
//                                    'file_name' => $uploadFile,
//                                    'file_type' => end($file_ext)
//                                ];
//                                $returnId = $this->Admin_model->addData('product_images', $insertTmgArr);
//                                if ($returnId) {
//                                    $returnId = $this->db->insert_id();
//                                    if (isset($expImgs[$key])) {
//                                        $expImgs[$key] = $returnId;
//                                    } else {
//                                        array_push($expImgs, $returnId);
//                                    }
//                                }
//                            }
                            $reponse = uploadToS3($_FILES['image' . $itm_id]['tmp_name'][$key], $uploadFile, $uploadPath);
                            if ($reponse) {
                                if (isset($reponse['imagepath']) && $reponse['imagepath']) {
                                    $insertTmgArr = [
                                        'file_path' => 'https://zanomy.s3.us-east-2.amazonaws.com/products/',
                                        'file_name' => $uploadFile,
                                        'file_type' => end($file_ext),
                                    ];
                                    $returnId = $this->Admin_model->addData('product_images', $insertTmgArr);
                                    if ($returnId) {
                                        $returnId = $this->db->insert_id();
                                        if (isset($expImgs[$key])) {
                                            $expImgs[$key] = $returnId;
                                        } else {
                                            array_push($expImgs, $returnId);
                                        }
                                    }
                                }
                            }
                        }
                    }


                    $product = [
                        'price' => $_POST['price'][$index], 'quantity' => $_POST['quantity'][$index], 'discount' => $_POST['discount'][$index]
                    ];
                    // echo '<pre/>';print_r($_POST);exit;
                    if ($expImgs) {
                        $product['images'] = trim(implode(',', $expImgs), ',');
                    }
                    $product = $this->Admin_model->updateData(['item_id' => $itm_id, 'product_id' => $productId], 'product_attribute_group', $product);

                    $product = array(
                        // 'status' => 2,
                        'updated_at' => strtotime(date('Y-m-d H:i:s'))
                    );
                    $product = $this->Admin_model->updateData(['product_id' => $productId], 'products', $product);
                }
            }



            $product = array(
                'product_from' => $_POST['product_from'],
                // 'discount' => $_POST['discount'],
                'name' => $_POST['name'],
                'name_ar' => $_POST['name_ar'],
                'description_short' => $_POST['description'],
                'description_short_ar' => $_POST['description'],
                'description' => $_POST['description'],
                'description_ar' => $_POST['description_ar'],
                'height' => $_POST['height'],
                'weight' => $_POST['weight'],
                'terms' => $_POST['terms'],
                'terms_ar' => $_POST['terms_ar'],
                'is_returnable' => $_POST['is_returnable'],
                'duration' => $_POST['duration'],
                'return_policy' => $_POST['return_policy'],
                'return_policy_ar' => $_POST['return_policy_ar'],
                'expected_delivery' => $_POST['expected_delivery'],
                'updated_at' => strtotime(date('Y-m-d H:i:s'))
            );
            // echo '<pre/>';print_r($product);exit;
            $product = $this->Admin_model->updateData(['product_id' => $productId], 'products', $product);
            if ($product) {
                redirect('admin/product-detail/' . $productId);
            } else {
                redirect('admin/edit-product-detail/' . $productId);
            }
        } else {
            $products = $this->db->select("products.*,pc.name as category_name,psc.name as sub_category_name")
                            ->where("products.product_id", $productId)
                            ->join("product_category as pc", "pc.category_id=products.category_id")
                            ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
                            ->get("products")->row_array();
            if ($products) {
                $brand_id = $this->Admin_model->getDataResultRow('brand', 'brand_id="' . $products['brand_id'] . '"');
                if ($brand_id) {
                    $products['brand_name'] = $brand_id['name'];
                } else {
                    $products['brand_name'] = "N/A";
                }
                $model_id = $this->Admin_model->getDataResultRow('model', 'brand_id="' . $products['model_id'] . '"');
                if ($model_id) {
                    $products['model_name'] = $model_id['name'];
                } else {
                    $products['model_name'] = "N/A";
                }

                $attributeListArr = array();
                //////////////////////////ATTRIBUTE//////////////////////////////////
                $product_attribute_group = $this->db->select("product_attribute_group.*")
                                ->where("product_id", $productId)
                                ->get("product_attribute_group")->result_array();
                if ($product_attribute_group) {
                    foreach ($product_attribute_group as $attribute) {
                        $productId = $attribute['product_id'];
                        $itemId = $attribute['item_id'];
                        $imagesArr = array();
                        $attribute['images'] = trim($attribute['images'], ',');
                        if ($attribute['images']) {
                            $expImgs = explode(',', $attribute['images']);
                            if ($expImgs) {
                                foreach ($expImgs as $img) {
                                    $product_img = $this->Admin_model->getDataResultRow('product_images', 'product_images_id="' . $img . '"');
                                    $imgObj = array('product_images_id' => $product_img['product_images_id'], 'image' => $product_img['file_path'] . $product_img['file_name']);
                                    array_push($imagesArr, $imgObj);
                                }
                            }
                        } else {
                            $expImgs = [];
                        }
                        $attribute['imagesArr'] = $imagesArr;
                        array_push($attributeListArr, $attribute);
                    }
                }
                $products['attribute'] = $attributeListArr;
                //////////////////////////ATTRIBUTE//////////////////////////////////

                $data['product'] = $products;
                $data['view_link'] = 'product/edit_product_detail';
                $this->load->view('layout/template', $data);
            } else {
                echo "<script>alert('Product not found.');window.location.href='" . base_url() . "admin/admin-product-list';</script>";
            }
        }
    }

    public function edit_product_detail_22_07_2020() {
        $productId = $this->uri->segment(3);
        if (isset($_POST['edit_product'])) {
            $product = array(
                'product_from' => $_POST['product_from'],
                'discount' => $_POST['discount'],
                'name' => $_POST['name'],
                'name_ar' => $_POST['name_ar'],
                'description_short' => $_POST['description'],
                'description_short_ar' => $_POST['description'],
                'description' => $_POST['description'],
                'description_ar' => $_POST['description_ar'],
                'terms' => $_POST['terms'],
                'terms_ar' => $_POST['terms_ar'],
                'updated_at' => strtotime(date('Y-m-d H:i:s'))
            );
            // echo '<pre/>';print_r($product);exit;
            $product = $this->Admin_model->updateData(['product_id' => $productId], 'products', $product);
            if ($product) {
                redirect('admin/product-detail/' . $productId);
            } else {
                redirect('admin/edit-product-detail/' . $productId);
            }
        } else {
            $products = $this->db->select("products.*,pc.name as category_name,psc.name as sub_category_name")
                            ->where("products.product_id", $productId)
                            ->join("product_category as pc", "pc.category_id=products.category_id")
                            ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
                            ->get("products")->row_array();
            if ($products) {
                $brand_id = $this->Admin_model->getDataResultRow('brand', 'brand_id="' . $products['brand_id'] . '"');
                if ($brand_id) {
                    $products['brand_name'] = $brand_id['name'];
                } else {
                    $products['brand_name'] = "N/A";
                }
                $model_id = $this->Admin_model->getDataResultRow('model', 'brand_id="' . $products['model_id'] . '"');
                if ($model_id) {
                    $products['model_name'] = $model_id['name'];
                } else {
                    $products['model_name'] = "N/A";
                }
                $data['product'] = $products;
                $data['view_link'] = 'product/edit_product_detail';
                $this->load->view('layout/template', $data);
            } else {
                echo "<script>alert('Product not found.');window.location.href='" . base_url() . "admin/admin-product-list';</script>";
            }
        }
    }

    public function edit_product_attribute() {
        $productId = $this->uri->segment(3);
        $itemId = $this->uri->segment(4);
        //$vendor_id = $this->vendor_data['vendor_id'];
        $attribute = $this->Admin_model->getDataResultRow('product_attribute_group', 'item_id="' . $itemId . '" AND product_id="' . $productId . '"');
        if ($attribute) {
            $imagesArr = array();
            $attribute['images'] = trim($attribute['images'], ',');
            if ($attribute['images']) {
                $expImgs = explode(',', $attribute['images']);
                if ($expImgs) {
                    foreach ($expImgs as $img) {
                        $product_img = $this->Admin_model->getDataResultRow('product_images', 'product_images_id="' . $img . '"');
                        $imgObj = array('product_images_id' => $product_img['product_images_id'], 'image' => $product_img['file_path'] . $product_img['file_name']);
                        array_push($imagesArr, $imgObj);
                    }
                }
            } else {
                $expImgs = [];
            }
            $attribute['imagesArr'] = $imagesArr;
            if (isset($_POST['edit_product'])) {

                //echo '<pre/>';print_r($_FILES['image']['name'][2]);exit;
                foreach ($_FILES['image']['name'] as $key => $file) {
                    // if(isset($_FILES['image']['name'][$key])){
                    // }
                    if ($file) {
                        $file_ext = explode('.', $file);
                        $uploadPath = 'uploads/products/';
                        $uploadFile = urlencode(time() . $this->Admin_model->my_random_string($this->Admin_model->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];
//                        if (move_uploaded_file($_FILES['image']['tmp_name'][$key], $uploadPath . $uploadFile)) {
//                            $insertTmgArr = [
//                                'file_path' => base_url() . $uploadPath,
//                                'file_name' => $uploadFile,
//                                'file_type' => end($file_ext)
//                            ];
//                            $returnId = $this->Admin_model->addData('product_images', $insertTmgArr);
//                            if ($returnId) {
//                                $returnId = $this->db->insert_id();
//                                if (isset($expImgs[$key])) {
//                                    $expImgs[$key] = $returnId;
//                                } else {
//                                    array_push($expImgs, $returnId);
//                                }
//                            }
//                        }
                        
                        $reponse = uploadToS3($_FILES['image']['tmp_name'][$key], $uploadFile, $uploadPath);
                            if ($reponse) {
                                if (isset($reponse['imagepath']) && $reponse['imagepath']) {
                                    $insertTmgArr = [
                                        'file_path' => 'https://zanomy.s3.us-east-2.amazonaws.com/products/',
                                        'file_name' => $uploadFile,
                                        'file_type' => end($file_ext),
                                    ];
                                    $returnId = $this->Admin_model->addData('product_images', $insertTmgArr);
                                    if ($returnId) {
                                        $returnId = $this->db->insert_id();
                                        if (isset($expImgs[$key])) {
                                            $expImgs[$key] = $returnId;
                                        } else {
                                            array_push($expImgs, $returnId);
                                        }
                                    }
                                }
                            }
                    }
                }
                //echo '<pre/>';print_r($expImgs);exit;
                $product = [
                    'item_no' => $_POST['item_no'], 'price' => $_POST['price'], 'quantity' => $_POST['quantity']
                ];
                $product['images'] = trim(implode(',', $expImgs), ',');
                $product = $this->Admin_model->updateData(['item_id' => $_POST['item_id'], 'product_id' => $productId], 'product_attribute_group', $product);

                $store_image = $_POST['store_image'];
                if ($store_image) {
                    $imgaArr = array();
                    $product_attribute_group = $this->Admin_model->getDataResultRow('product_attribute_group', 'item_id="' . $_POST['item_id'] . '"');
                    $proImages = $product_attribute_group['images'];
                    $proImages = explode(',', $proImages);

                    $store_image = trim($store_image, ',');
                    $store_image = explode(',', $store_image);
                    foreach ($store_image as $v) {
                        unset($proImages[$v]);
                    }
                    $proImages = implode(',', $proImages);
                    //echo '<pre/>';print_r($proImages);exit;
                    $imgsUpdateArr = [
                        'images' => $proImages
                    ];
                    //echo '<pre/>';print_r($imgsUpdateArr);exit;
                    $res = $this->Admin_model->updateData(['item_id' => $_POST['item_id']], 'product_attribute_group', $imgsUpdateArr);
                    //echo '<pre/>';print_r($res);exit;
                }

                if ($product) {
                    redirect('admin/product-detail/' . $productId);
                } else {
                    echo "<script>alert('Some Error Occured.');window.location.href='" . base_url() . "vendor/product-detail/" . $productId . "';</script>";
                }
            } else {
                $data['list'] = $attribute;
                $data['view_link'] = 'product/edit_product_attribute';
                $this->load->view('layout/template', $data);
            }
        } else {
            echo "<script>alert('Item not found. Some Error Occured.');window.location.href='" . base_url() . "admin/product-detail/" . $productId . "';</script>";
        }
    }

    //////////////////////////////////////Coupons Management////////////////////////////////////////////
    public function add_coupons() {
        $data['category_list'] = $this->Admin_model->getDataResultArray('product_category', 'status=1', 'category_id');
        $data['view_link'] = 'coupons/add_coupons';
        $this->load->view('layout/template', $data);
    }

    public function coupons_list() {
        $data['coupon_list'] = $this->Admin_model->getDataResultArray('coupon', 'status!=99', 'coupon_id');
        $data['view_link'] = 'coupons/coupons_list';
        $this->load->view('layout/template', $data);
    }

    //////////////////////////////////////////////////////////////////////////////////////
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
        $this->load->view('ajaxserver');
    }

    public function logout() {
        $query = $this->session->unset_userdata('menzil_info_agent_logged_in');
        redirect(base_url() . 'agent');
    }

}
