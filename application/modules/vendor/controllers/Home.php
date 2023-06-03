<?php
// require 'aws/aws-autoloader.php';

// use Aws\S3\S3Client;

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
        }
    }

    public function add_new_product() {
        //echo '<pre/>';print_r($_POST);exit;
        $language_data = $this->language_data;
        if ($this->vendor_data['business_type'] == 1) {
            $vendor_id = $this->vendor_data['vendor_id'];
            if (isset($_POST['add_product'])) {
                $getHubId = 0;
                $productStatus = 2;
                $getVendor = $this->Vendor_model->getDataResultRow('vendor', 'vendor_id="' . $vendor_id . '"');
                if ($getVendor) {
                    $getHubId = $getVendor['hub_id'];
                    if($getVendor['is_trusted']){
                        $productStatus=1;
                    }
                }
                $model_id = 0;
                $model_mapped = strtotime(date('Y-m-d H:i:s'));
                $brand_id = 0;
                if (isset($_POST['brand_id']) and $_POST['brand_id']) {
                    $brand_mapping = $this->Vendor_model->getDataResultRow('brand_mapping', 'brand_mapping_id="' . $_POST['brand_id'] . '"');
                    if ($brand_mapping) {
                        $brand_id = $brand_mapping['brand_id'];
                    } else {
                        $brand_id = 0;
                    }
                }
                if (isset($_POST['model_id']) and $_POST['model_id']) {
                    $model_id = $_POST['model_id'];
                    $productsChecker = $this->Vendor_model->getDataResultRow('products', 'model_id="' . $model_id . '" and status="1"');
                    if ($productsChecker) {
                        $model_mapped = $productsChecker['model_mapped'];
                    }
                }
                $product = array(
                    'hub_id' => $getHubId,
                    'vendor_id' => $vendor_id,
                    'category_id' => $_POST['category_id'],
                    'sub_category_id' => $_POST['sub_category_id'],
                    'brand_id' => $brand_id,
                    'model_id' => $model_id,
                    'model_mapped' => $model_mapped,
                    'primary_attribute' => 1,
                    'name' => $_POST['name'],
                    'name_ar' => $_POST['name_ar'],
                    'description_short' => $_POST['description'],
                    'description_short_ar' => $_POST['description'],
                    'description' => $_POST['description'],
                    'description_ar' => $_POST['description_ar'],
                    'terms' => $_POST['terms'],
                    'terms_ar' => $_POST['terms_ar'],
                    'is_returnable' => $_POST['is_returnable'],
                    'duration' => $_POST['duration'],
                    'return_policy' => $_POST['return_policy'],
                    'return_policy_ar' => $_POST['return_policy_ar'],
                    'expected_delivery' => $_POST['expected_delivery'],
                    'created_at' => strtotime(date('Y-m-d H:i:s')),
                    'updated_at' => strtotime(date('Y-m-d H:i:s')),
                    'status' => $productStatus
                );
                $product = $this->Vendor_model->addData('products', $product);
                if ($product) {

                    $group_id = 0;
                    if (isset($_POST['attribute'])) {
                        $group_id = rand(1000, 9999);
                        $attribute = $_POST['attribute'];
                        foreach ($attribute as $key => $val) {
                            if ($_POST['attribute_value']) {
                                $checkDtaAttr = $this->Vendor_model->getDataResultRow('attribute_mapping', 'category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '" and attribute_id="' . $val . '"');
                                $isPrimary = $checkDtaAttr['is_primary'];
                                if ($isPrimary == 1) {
                                    //echo $key.'<pre/>';print_r($_POST['attribute']);exit;
                                    $getGroupData1 = $this->Vendor_model->getDataResultRow('product_attribute', 'product_id="' . $product . '" and attribute_value_id="' . $_POST['attribute_value'][$key] . '" and is_primary=1');
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
                                    $getGroupData1 = $this->Vendor_model->getDataResultRow('product_attribute', 'product_id="' . $product . '" and group_id="' . $group_id . '" and is_primary=1');
                                    //echo $this->db->last_query();exit;
                                    //echo $key.'<pre/>';print_r($getGroupData1);exit;
                                    if ($getGroupData1['is_new'] == 1) {
                                        $parentId = $getGroupData1['product_attribute_id'];
                                        $isNew = 1;
                                        $subParentId = 0;
                                    } else {
                                        $getGroupData2 = $this->Vendor_model->getDataResultRow('product_attribute', 'product_id="' . $product . '" and attribute_value_id="' . $getGroupData1['attribute_value_id'] . '" and is_primary=1 and is_new=1');
                                        $parentId = $getGroupData2['product_attribute_id'];
                                        $subParentId = 0;
                                        $isNew = 0;
                                    }
                                } elseif ($isPrimary == 3) {
                                    $getGroupData1 = $this->Vendor_model->getDataResultRow('product_attribute', 'product_id="' . $product . '" and group_id="' . $group_id . '" and is_primary=2');
                                    if ($getGroupData1['is_new'] == 1) {
                                        $subParentId = $getGroupData1['product_attribute_id'];
                                        $parentId = $getGroupData1['parent_id'];
                                        $isNew = 1;
                                    } else {
                                        $getGroupData2 = $this->Vendor_model->getDataResultRow('product_attribute', 'product_id="' . $product . '" and attribute_value_id="' . $getGroupData1['attribute_value_id'] . '" and is_primary=1');
                                        $getGroupData3 = $this->Vendor_model->getDataResultRow('product_attribute', 'product_id="' . $product . '" and group_id="' . $getGroupData2['group_id'] . '" and is_primary=2');
                                        $subParentId = $getGroupData3['product_attribute_id'];
                                        $parentId = $getGroupData3['parent_id'];
                                        $isNew = 0;
                                    }
                                }

                                if(isset($parentId) and $parentId){

                                }else{
                                    $parentId=0;
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
                                $attr = $this->Vendor_model->addData('product_attribute', $attrData);
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
                                $attr = $this->Vendor_model->addData('product_specification', $specfyData);
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
                                $attr = $this->Vendor_model->addData('product_featuers', $featuersData);
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
                                $uploadFile = urlencode(time() . $this->Vendor_model->my_random_string($this->Vendor_model->remove_special_character($file_ext[0]))) . '.' . $file_ext[$countExt];

//                                if (move_uploaded_file($_FILES['image']['tmp_name'][$key], 'uploads/products/' . $uploadFile)) {
//                                    $insertArr = [
//                                        'file_path' => base_url() . 'uploads/products/',
//                                        'file_name' => $uploadFile,
//                                        'file_type' => $file_ext[$countExt],
//                                    ];
//                                    $return = $this->Vendor_model->addData('product_images', $insertArr);
//                                    $returnId = $this->db->insert_id();
//                                    if ($returnId) {
//                                        array_push($imagesAr, $returnId);
//                                    }
//                                }
                                $uploadPath = 'uploads/products/';
                                $reponse = uploadToS3($_FILES['image']['tmp_name'][$key], $uploadFile, $uploadPath);
                                if ($reponse) {
                                    if (isset($reponse['imagepath']) && $reponse['imagepath']) {
                                        $insertArr = [
                                            'file_path' => 'https://zanomy.s3.us-east-2.amazonaws.com/products/',
                                            'file_name' => $uploadFile,
                                            'file_type' => $file_ext[$countExt],
                                        ];
                                        $return = $this->Vendor_model->addData('product_images', $insertArr);
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
                    $addItems = $this->Vendor_model->addData('product_attribute_group', $attrData);
                    ///////////////////////////////////////////////////////////////////////////
                    if (isset($_POST['attribute_value']) and $_POST['attribute_value']) {
                        if (isset($_POST['attribute_value'][0]) and $_POST['attribute_value'][0]) {
                            $first = $_POST['attribute_value'][0];
                        } else {
                            $first = 0;
                        }
                        if (isset($_POST['attribute_value'][1]) and $_POST['attribute_value'][1]) {
                            $second = $_POST['attribute_value'][1];
                        } else {
                            $second = 0;
                        }if (isset($_POST['attribute_value'][2]) and $_POST['attribute_value'][2]) {
                            $third = $_POST['attribute_value'][2];
                        } else {
                            $third = 0;
                        }
                        $attrmapping = array(
                            'item_id' => $addItems,
                            'group_id' => $group_id,
                            'first' => $first,
                            'second' => $second,
                            'third' => $third
                        );
                        $attr = $this->Vendor_model->addData('product_attribute_mapping', $attrmapping);
                    }
                    ///////////////////////////////////////////////////////////////////////////
                    if ($language_data == 'ar') {
                        $htmlData = '<div class="modal fade modal-design show" id="productupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" style="display:block;    top: -131px;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="messege-box">
                                            <img src="' . base_url('assets/uploadproduct.png') . '" alt="success messege">
                                            <h3>تم تحميل المنتج بنجاح</h3>
                                        </div>';
                        if (isset($_POST['attribute'])) {
                            $htmlData .= '<div class="action-button">
                                                <p>هل تريد تحميل مواصفات اخرى</p>
                                                <a href="' . base_url('vendor/add-more-attribute/' . $product) . '" class="btn btn-primary mybtns" onclick="setFormSubmitting();">نعم</a>
                                                <a href="' . base_url('vendor/add-new-product') . '" class="btn btn-primary mybtns" data-dismiss="modal" onclick="setFormSubmitting();">تخطى</a>
                                            </div>';
                        } else {
                            $htmlData .= '<div class="action-button">
                                                <a href="' . base_url('vendor/add-new-product') . '" class="btn btn-primary mybtns" data-dismiss="modal">استمر</a>
                                            </div>';
                        }
                        $htmlData .= '</div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    } else {
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
                                                <a href="' . base_url('vendor/add-more-attribute/' . $product) . '" class="btn btn-primary mybtns">Yes</a>
                                                <a href="' . base_url('vendor/add-new-product') . '" class="btn btn-primary mybtns" data-dismiss="modal">Skip</a>
                                            </div>';
                        } else {
                            $htmlData .= '<div class="action-button">
                                                <a href="' . base_url('vendor/add-new-product') . '" class="btn btn-primary mybtns" data-dismiss="modal">Continue</a>
                                            </div>';
                        }
                        $htmlData .= '</div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }

                    $this->session->set_flashdata('response', $htmlData);
                    redirect('vendor/add-new-product');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> تم العثور على بعض الأخطاء</div>');
                    redirect('vendor/add-new-product');
                }
            } else {
                $data['category_list'] = $this->Vendor_model->getDataResultArray('product_category', 'status=1', 'category_id');
                if ($language_data == 'ar') {
                    $data['view_link'] = 'view_ar/product/add_new_product';
                    $this->load->view('view_ar/include/template', $data);
                } else {
                    $data['view_link'] = 'product/add_new_product';
                    $this->load->view('include/template', $data);
                }
            }
        } else {
            redirect('vendor/add-new-service');
        }
    }

    function add_more_attribute() {
        $language_data = $this->language_data;
        $attributeArr = array();
        if ($this->uri->segment(3)) {
            $product_id = $this->uri->segment(3);
            $products = $this->Vendor_model->getDataResultRow('products', 'product_id="' . $product_id . '"');
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

                                $checkDtaAttr = $this->Vendor_model->getDataResultRow('attribute_mapping', 'category_id="' . $products['category_id'] . '" and sub_category_id="' . $products['sub_category_id'] . '" and attribute_id="' . $val . '"');
                                //echo $key.'<pre/>';print_r($checkDtaAttr);exit;
                                $isPrimary = $checkDtaAttr['is_primary'];
                                if ($isPrimary == 1) {
                                    //echo $key.'<pre/>';print_r($_POST['attribute']);exit;
                                    $getGroupData1 = $this->Vendor_model->getDataResultRow('product_attribute', 'product_id="' . $products['product_id'] . '" and attribute_value_id="' . $_POST['attribute_value'][$key] . '" and is_primary=1');
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
                                    $getGroupData1 = $this->Vendor_model->getDataResultRow('product_attribute', 'product_id="' . $products['product_id'] . '" and group_id="' . $group_id . '" and is_primary=1');
                                    //echo $this->db->last_query();exit;
                                    //echo $key.'<pre/>';print_r($getGroupData1);exit;
                                    if ($getGroupData1['is_new'] == 1) {
                                        $parentId = $getGroupData1['product_attribute_id'];
                                        $isNew = 1;
                                        $subParentId = 0;
                                    } else {
                                        $checkerOn = false;
                                        $valueProduct = $this->Vendor_model->getDataResultArray('product_attribute', 'product_id="' . $products['product_id'] . '" and attribute_value_id="' . $getGroupData1['attribute_value_id'] . '"', 'product_attribute_id');
                                        //echo $this->db->last_query();exit;
                                        if ($valueProduct) {
                                            foreach ($valueProduct as $v1) {
                                                $checkIsNew = $this->Vendor_model->getDataResultRow('product_attribute', 'product_id="' . $products['product_id'] . '" and group_id="' . $v1['group_id'] . '" and attribute_value_id="' . $_POST['attribute_value'][$key] . '" and is_primary=2');
                                                if ($checkIsNew) {
                                                    $checkerOn = true;
                                                    break;
                                                }
                                            }
                                        }
                                        $getGroupData2 = $this->Vendor_model->getDataResultRow('product_attribute', 'product_id="' . $products['product_id'] . '" and attribute_value_id="' . $getGroupData1['attribute_value_id'] . '" and is_primary=1 and is_new=1');
                                        $parentId = $getGroupData2['product_attribute_id'];
                                        $subParentId = 0;
                                        if ($checkerOn) {
                                            $isNew = 0;
                                        } else {
                                            $isNew = 1;
                                        }
                                    }
                                } elseif ($isPrimary == 3) {
                                    $getGroupData1 = $this->Vendor_model->getDataResultRow('product_attribute', 'product_id="' . $products['product_id'] . '" and group_id="' . $group_id . '" and is_primary=2');
                                    if ($getGroupData1['is_new'] == 1) {
                                        $subParentId = $getGroupData1['product_attribute_id'];
                                        $parentId = $getGroupData1['parent_id'];
                                        $isNew = 1;
                                    } else {
                                        $subParentId = 0;
                                        $parentId = 0;
                                        // $getGroupData2    = $this->Vendor_model->getDataResultRow('product_attribute','product_id="'.$products['product_id'].'" and attribute_value_id="'.$getGroupData1['attribute_value_id'].'" and is_primary=1'); 
                                        // $getGroupData2    = $this->Vendor_model->getDataResultRow('product_attribute','product_id="'.$products['product_id'].'" and product_attribute_id="'.$getGroupData1['parent_id'].'"'); 
                                        $getGroupData2 = $this->Vendor_model->getDataResultArray('product_attribute', 'product_id="' . $products['product_id'] . '" and attribute_value_id="' . $getGroupData1['attribute_value_id'] . '" and is_new=1', 'product_attribute_id');

                                        if ($getGroupData2) {
                                            foreach ($getGroupData2 as $vals1) {
                                                $checkIsNew = $this->Vendor_model->getDataResultRow('product_attribute', 'product_id="' . $products['product_id'] . '" and group_id="' . $vals1['group_id'] . '" and attribute_value_id="' . $firstKeyVal . '" and is_primary=1');
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
                                        $getGroupData3 = $this->Vendor_model->getDataResultRow('product_attribute', 'product_id="' . $products['product_id'] . '" and group_id="' . $getGroupData2['group_id'] . '" and is_primary=2');
                                        //echo $this->db->last_query();exit;
                                        // $subParentId=$checkerOn;
                                        // $parentId=$getGroupData3['parent_id'];
                                        $isNew = 0;
                                    }
                                }

                                if(isset($parentId) and $parentId){

                                }else{
                                    $parentId=0;
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
                                $attr = $this->Vendor_model->addData('product_attribute', $attrData);
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
                                    $uploadFile = urlencode(time() . $this->Vendor_model->my_random_string($this->Vendor_model->remove_special_character($file_ext[0]))) . '.' . $file_ext[$countExt];

//                                    if (move_uploaded_file($_FILES['image']['tmp_name'][$key], 'uploads/products/' . $uploadFile)) {
//                                        $insertArr = [
//                                            'file_path' => base_url() . 'uploads/products/',
//                                            'file_name' => $uploadFile,
//                                            'file_type' => $file_ext[$countExt],
//                                        ];
//                                        $return = $this->Vendor_model->addData('product_images', $insertArr);
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
                                            $return = $this->Vendor_model->addData('product_images', $insertArr);
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
                        $item_data = $this->Vendor_model->getDataResultRow('product_attribute_group', 'product_id="' . $product_id . '" and group_id=0');
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
                        $addItems = $this->Vendor_model->addData('product_attribute_group', $attrData);

                        if (isset($_POST['attribute_value']) and $_POST['attribute_value']) {
                            if (isset($_POST['attribute_value'][0]) and $_POST['attribute_value'][0]) {
                                $first = $_POST['attribute_value'][0];
                            } else {
                                $first = 0;
                            }
                            if (isset($_POST['attribute_value'][1]) and $_POST['attribute_value'][1]) {
                                $second = $_POST['attribute_value'][1];
                            } else {
                                $second = 0;
                            }if (isset($_POST['attribute_value'][2]) and $_POST['attribute_value'][2]) {
                                $third = $_POST['attribute_value'][2];
                            } else {
                                $third = 0;
                            }
                            $attrmapping = array(
                                'item_id' => $addItems,
                                'group_id' => $group_id,
                                'first' => $first,
                                'second' => $second,
                                'third' => $third
                            );
                            $attr = $this->Vendor_model->addData('product_attribute_mapping', $attrmapping);
                        }

                        $this->session->set_flashdata('response', '<div class="modal fade modal-design show" id="productupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" style="display:block;    top: -131px;">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="messege-box">
                                                    <img src="http://gropse.com/gropse.com/design/zanomyvendor.com/common/images/uploadproduct.png" alt="success messege">
                                                    <h3>تم تحميل المنتج بنجاح</h3>
                                                    <p>هل تريد تحميل مواصفات اخرى</p>
                                                </div>
                                                <div class="action-button">
                                                    <a href="' . base_url('vendor/add-more-attribute/' . $products['product_id']) . '" class="btn btn-primary mybtns">نعم</a>
                                                    <a href="' . base_url('vendor/add-new-product') . '" class="btn btn-primary mybtns" data-dismiss="modal">تخطى</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>');
                        redirect('vendor/add-new-product');
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
                            $value = $this->Vendor_model->getDataResultArray('attribute_value', 'status=1 and attribute_id="' . $attr['attribute_id'] . '"', 'attribute_value_id');
                            //echo '<pre/>';print_r($value);exit;
                            if ($value) {
                                $attr['attribute_value'] = $value;
                                array_push($attributeArr, $attr);
                            }
                        }
                    }
                    $category_id = $this->Vendor_model->getDataResultRow('product_category', 'category_id="' . $products['category_id'] . '"');
                    if ($category_id) {
                        $products['category_name'] = $category_id['name'];
                        $products['category_name_ar'] = $category_id['name_ar'];
                    } else {
                        $products['category_name'] = "N/A";
                        $products['category_name_ar'] = "N/A";
                    }
                    $sub_category_id = $this->Vendor_model->getDataResultRow('product_sub_category', 'sub_category_id="' . $products['sub_category_id'] . '"');
                    if ($sub_category_id) {
                        $products['sub_category_name'] = $sub_category_id['name'];
                        $products['sub_category_name_ar'] = $sub_category_id['name_ar'];
                    } else {
                        $products['sub_category_name'] = "N/A";
                        $products['sub_category_name_ar'] = "N/A";
                    }

                    $brand_id = $this->Vendor_model->getDataResultRow('brand', 'brand_id="' . $products['brand_id'] . '"');
                    if ($brand_id) {
                        $products['brand_name'] = $brand_id['name'];
                        $products['brand_name_ar'] = $brand_id['name_ar'];
                    } else {
                        $products['brand_name'] = "N/A";
                        $products['brand_name_ar'] = "N/A";
                    }
                    $model_id = $this->Vendor_model->getDataResultRow('model', 'brand_id="' . $products['model_id'] . '"');
                    if ($model_id) {
                        $products['model_name'] = $model_id['name'];
                        $products['model_name_ar'] = $model_id['name_ar'];
                    } else {
                        $products['model_name'] = "N/A";
                        $products['model_name_ar'] = "N/A";
                    }

                    $data['products'] = $products;
                    $data['attribute'] = $attributeArr;
                    //echo '<pre/>';print_r($attributeArr);exit;
                    if ($language_data == 'ar') {
                        $data['view_link'] = 'view_ar/product/add_more_attribute';
                        $this->load->view('view_ar/include/template', $data);
                    } else {
                        $data['view_link'] = 'product/add_more_attribute';
                        $this->load->view('include/template', $data);
                    }
                }
            }
        }
    }

    public function product_list_old() {
        if ($this->vendor_data['business_type'] == 1) {
            $vendor_id = $this->vendor_data['vendor_id'];
            $products = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.quantity,pag.price,pag.images,pc.name as category_name,psc.name as sub_category_name")
                            ->where("products.vendor_id", $vendor_id)
                            ->where("pag.group_id", 0)
                            ->where("products.status!=", 99)
                            ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                            ->join("product_category as pc", "pc.category_id=products.category_id")
                            ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
                            ->get("products")->result_array();
            $data['product_list'] = $products;
            $data['view_link'] = 'product/product_list';
            $this->load->view('include/template', $data);
        } else {
            redirect('vendor/service-list');
        }
    }

    public function product_list() {
        $language_data = $this->language_data;
        if ($this->vendor_data['business_type'] == 1) {
            $productsList = [];
            $filterAttr = [];
            $vendor_id = $this->vendor_data['vendor_id'];
            $filter_condition = [];
            if (isset($_POST['category_id']) && $_POST['category_id']) {
                $filterAttr = $this->Vendor_model->setFilterAttributes(['category_id' => $_POST['category_id']]);
                $filter_condition['products.category_id'] = $_POST['category_id'];
            }
            if (isset($_POST['sub_category_id']) && $_POST['sub_category_id']) {
                $filter_condition['products.sub_category_id'] = $_POST['sub_category_id'];
            }
            if (isset($_POST['brand_id']) && $_POST['brand_id']) {
                $filter_condition ['products.brand_id'] = $_POST['brand_id'];
            }
            if (isset($_POST['model_id']) && $_POST['model_id']) {
                $filter_condition['products.model_id'] = $_POST['model_id'];
            }
            $products = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.quantity,pag.discount,pag.price,pag.images,pc.name as category_name,pc.name_ar as category_name_ar,psc.name as sub_category_name,psc.name_ar as sub_category_name_ar")
                            ->where("products.vendor_id", $vendor_id)
                            ->where("pag.group_id", 0)
                            ->where("pag.item_status!=", 99)
                            ->where("products.status!=", 99)
                            ->where($filter_condition)
                            ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                            ->join("product_category as pc", "pc.category_id=products.category_id")
                            ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
                            ->order_by('products.product_id', 'DESC')
                            ->group_by('pag.product_id')
                            ->get("products")->result_array();

            if ($products) {
                foreach ($products as $product) {
                    if ($product['images']) {
                        $images = explode(',', $product['images']);
                        foreach ($images as $key => $imgId) {
                            if ($key == 0) {
                                $image = $this->db->select('CONCAT(file_path,file_name) as image')
                                                ->where('product_images_id', $imgId)
                                                ->get('product_images')->row_array();
                                $product['cover_image'] = $image['image'];
                            }
                        }
                    } else {
                        $product['cover_image'] = '';
                    }
                    array_push($productsList, $product);
                }
            }
            $data['product_list'] = $productsList;
            $data['vendor_id'] = $vendor_id;
            $data['category_list'] = $this->Vendor_model->getDataResultArray('product_category', 'status=1', 'category_id');
            $data['filter_attr'] = $filterAttr;
            if ($language_data == 'ar') {
                $data['view_link'] = 'view_ar/product/product_list';
                $this->load->view('view_ar/include/template', $data);
            } else {
                $data['view_link'] = 'product/product_list';
                $this->load->view('include/template', $data);
            }
        } else {
            redirect('vendor/service-list');
        }
    }

    public function product_detail() {
        $language_data = $this->language_data;
        if ($this->vendor_data['business_type'] == 1) {
            $productId = $this->uri->segment(3);
            $vendor_id = $this->vendor_data['vendor_id'];
            $products = $this->db->select("products.*,pc.name as category_name,pc.name as category_name,pc.name_ar as category_name_ar,psc.name as sub_category_name,psc.name_ar as sub_category_name_ar")
                            ->where("products.product_id", $productId)
                            ->where("products.vendor_id", $vendor_id)
                            ->where("products.status!=", 99)
                            ->where("pag.item_status!=", 99)
                            ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                            ->join("product_category as pc", "pc.category_id=products.category_id")
                            ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
                            ->get("products")->row_array();
            if ($products) {
                $itemArr = array();
                $product_attribute_group = $this->Vendor_model->getDataResultArray('product_attribute_group', 'product_id="' . $productId . '"', 'item_id');
                if ($product_attribute_group) {
                    foreach ($product_attribute_group as $pag) {
                        $attributeArr = array();
                        $product_attribute = $this->Vendor_model->getDataResultArray('product_attribute', 'product_id="' . $productId . '" and group_id="' . $pag['attribute_group_id'] . '"', 'product_attribute_id');
                        if ($product_attribute) {
                            //echo '<pre/>';print_r($product_attribute);exit;
                            foreach ($product_attribute as $pa) {
                                $attribute = $this->Vendor_model->getDataResultRow('attribute', 'attribute_id="' . $pa['attribute_id'] . '"');
                                $attribute_value = $this->Vendor_model->getDataResultRow('attribute_value', 'attribute_value_id="' . $pa['attribute_value_id'] . '"');
                                //echo $pa['attribute_value_id'];exit;
                                //print_r($attribute_value);exit;
                                $attributeObj = array('product_attribute_id' => $pa['product_attribute_id'], 'attribute_id' => $pa['attribute_id'], 'attribute_name' => $attribute['name'], 'attribute_name_ar' => $attribute['name_ar'], 'attribute_value_id' => $pa['attribute_value_id'], 'attribute_value' => $attribute_value['value'], 'attribute_value_ar' => $attribute_value['value_ar']);
                                array_push($attributeArr, $attributeObj);
                            }
                        }

                        $imagesArr = array();
                        $pag['images'] = trim($pag['images'], ',');
                        if ($pag['images']) {
                            $expImgs = explode(',', $pag['images']);
                            if ($expImgs) {
                                foreach ($expImgs as $img) {
                                    $product_img = $this->Vendor_model->getDataResultRow('product_images', 'product_images_id="' . $img . '"');
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
                $product_specification = $this->Vendor_model->getDataResultArray('product_specification', 'product_id="' . $productId . '"', 'product_specification_id');
                //echo '<pre/>';print_r($product_specification);exit;
                if ($product_specification) {
                    foreach ($product_specification as $pa) {
                        $attribute = $this->Vendor_model->getDataResultRow('attribute', 'attribute_id="' . $pa['attribute_id'] . '"');
                        $attribute_value = $this->Vendor_model->getDataResultRow('attribute_value', 'attribute_value_id="' . $pa['attribute_value_id'] . '"');
                        $attributeObj = array('product_attribute_id' => $pa['product_specification_id'], 'attribute_id' => $pa['attribute_id'], 'attribute_name' => $attribute['name'], 'attribute_name_ar' => $attribute['name_ar'], 'attribute_value_id' => $pa['attribute_value_id'], 'attribute_value' => $attribute_value['value'], 'attribute_value_ar' => $attribute_value['value_ar']);
                        array_push($specificationArr, $attributeObj);
                    }
                }
                $products['product_specification'] = $specificationArr;

                $featuersArr = array();
                $product_featuers = $this->Vendor_model->getDataResultArray('product_featuers', 'product_id="' . $productId . '"', 'product_featuers_id');
                if ($product_featuers) {
                    foreach ($product_featuers as $pa) {
                        $attribute_value = $this->Vendor_model->getDataResultRow('featuers', 'featuers_id="' . $pa['featuers_id'] . '"');
                        $pa['name'] = $attribute_value['name'];
                        array_push($featuersArr, $pa);
                    }
                }
                $products['product_featuers'] = $featuersArr;

                $brand_id = $this->Vendor_model->getDataResultRow('brand', 'brand_id="' . $products['brand_id'] . '"');
                if ($brand_id) {
                    $products['brand_name'] = $brand_id['name'];
                    $products['brand_name_ar'] = $brand_id['name_ar'];
                } else {
                    $products['brand_name'] = "N/A";
                    $products['brand_name_ar'] = "N/A";
                }
                $model_id = $this->Vendor_model->getDataResultRow('model', 'brand_id="' . $products['model_id'] . '"');
                if ($model_id) {
                    $products['model_name'] = $model_id['name'];
                    $products['model_name_ar'] = $model_id['name_ar'];
                } else {
                    $products['model_name'] = "N/A";
                    $products['model_name_ar'] = "N/A";
                }

                $attribute_mapping = $this->Vendor_model->getDataResultArray('attribute_mapping', 'category_id="' . $products['category_id'] . '" and sub_category_id="' . $products['sub_category_id'] . '"', 'attribute_mapping_id');
                if ($attribute_mapping) {
                    $products['add_more_attribute'] = 1;
                } else {
                    $products['add_more_attribute'] = 0;
                }
            } else {
                echo "<script>alert('Product not found.');window.location.href='" . base_url() . "vendor/product-list';</script>";
            }
            //echo '<pre/>';print_r($products);exit;
            $data['product_list'] = $products;
            if ($language_data == 'ar') {
                $data['view_link'] = 'view_ar/product/product_detail';
                $this->load->view('view_ar/include/template', $data);
            } else {
                $data['view_link'] = 'product/product_detail';
                $this->load->view('include/template', $data);
            }
        } else {
            redirect('vendor/service-list');
        }
    }

    public function edit_product_detail() {
        $language_data = $this->language_data;
        if ($this->vendor_data['business_type'] == 1) {
            $productId = $this->uri->segment(3);
            $vendor_id = $this->vendor_data['vendor_id'];
            if (isset($_POST['edit_product'])) {
                // echo '<pre/>';print_r($_POST);
                // echo '<pre/>';print_r($_FILES);exit;
                $itemIds = $_POST['item_ids'];
                if (isset($itemIds) and $itemIds) {
                    foreach ($itemIds as $index => $itm_id) {
                        //$expImgs=[];
                        $attribute = $this->Vendor_model->getDataResultRow('product_attribute_group', 'item_id="' . $itm_id . '" AND product_id="' . $productId . '"');
                        if ($attribute) {
                            $imagesArr = array();
                            $attribute['images'] = trim($attribute['images'], ',');
                            if ($attribute['images']) {
                                $expImgs = explode(',', $attribute['images']);
                                if ($expImgs) {
                                    foreach ($expImgs as $img) {
                                        $product_img = $this->Vendor_model->getDataResultRow('product_images', 'product_images_id="' . $img . '"');
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
//                                if (move_uploaded_file($_FILES['image' . $itm_id]['tmp_name'][$key], $uploadPath . $uploadFile)) {
//                                    $insertTmgArr = [
//                                        'file_path' => base_url() . $uploadPath,
//                                        'file_name' => $uploadFile,
//                                        'file_type' => end($file_ext)
//                                    ];
//                                    $returnId = $this->Vendor_model->addData('product_images', $insertTmgArr);
//                                    if ($returnId) {
//                                        $returnId = $this->db->insert_id();
//                                        if (isset($expImgs[$key])) {
//                                            $expImgs[$key] = $returnId;
//                                        } else {
//                                            array_push($expImgs, $returnId);
//                                        }
//                                    }
//                                }
                                
                                $reponse = uploadToS3($_FILES['image' . $itm_id]['tmp_name'][$key], $uploadFile, $uploadPath);
                                if ($reponse) {
                                    if (isset($reponse['imagepath']) && $reponse['imagepath']) {
                                        $insertTmgArr = [
                                            'file_path' => 'https://zanomy.s3.us-east-2.amazonaws.com/products/',
                                            'file_name' => $uploadFile,
                                            'file_type' => end($file_ext),
                                        ];
                                        $returnId = $this->Vendor_model->addData('product_images', $insertTmgArr);
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
                            'price' => $_POST['price'][$index], 'discount' => $_POST['discount'][$index], 'quantity' => $_POST['quantity'][$index]
                        ];
                        // echo '<pre/>';print_r($_POST);exit;
                        if ($expImgs) {
                            $product['images'] = trim(implode(',', $expImgs), ',');
                        }
                        $product = $this->Vendor_model->updateData(['item_id' => $itm_id, 'product_id' => $productId], 'product_attribute_group', $product);

                        $product = array(
                            'status' => 2,
                            'updated_at' => strtotime(date('Y-m-d H:i:s'))
                        );
                        $product = $this->Vendor_model->updateData(['product_id' => $productId], 'products', $product);
                    }
                }
                $productStatus = 2;
                $getVendor = $this->Vendor_model->getDataResultRow('vendor', 'vendor_id="' . $vendor_id . '"');
                if ($getVendor) {
                    if($getVendor['is_trusted']){
                        $productStatus=1;
                    }
                }
                //exit;
                $product = array(
                    'name' => $_POST['name'],
                    'name_ar' => $_POST['name_ar'],
                    'description_short' => $_POST['description'],
                    'description_short_ar' => $_POST['description'],
                    'description' => $_POST['description'],
                    'description_ar' => $_POST['description_ar'],
                    'terms' => $_POST['terms'],
                    'terms_ar' => $_POST['terms_ar'],
                    'is_returnable' => $_POST['is_returnable'],
                    'duration' => $_POST['duration'],
                    'return_policy' => $_POST['return_policy'],
                    'return_policy_ar' => $_POST['return_policy_ar'],
                    'expected_delivery' => $_POST['expected_delivery'],
                    'status' => $productStatus,
                    'updated_at' => strtotime(date('Y-m-d H:i:s'))
                );
                //echo '<pre/>';print_r($product);exit;
                $product = $this->Vendor_model->updateData(['product_id' => $productId], 'products', $product);
                if ($product) {
                    redirect('vendor/product-detail/' . $productId);
                } else {
                    redirect('vendor/edit-product-detail/' . $productId);
                }
            } else {
                $products = $this->db->select("products.*,pc.name as category_name,pc.name_ar as category_name_ar,psc.name as sub_category_name,psc.name_ar as sub_category_name_ar")
                                ->where("products.product_id", $productId)
                                ->where("products.vendor_id", $vendor_id)
                                ->join("product_category as pc", "pc.category_id=products.category_id")
                                ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
                                ->get("products")->row_array();
                if ($products) {
                    $brand_id = $this->Vendor_model->getDataResultRow('brand', 'brand_id="' . $products['brand_id'] . '"');
                    if ($brand_id) {
                        $products['brand_name'] = $brand_id['name'];
                        $products['brand_name_ar'] = $brand_id['name_ar'];
                    } else {
                        $products['brand_name'] = "N/A";
                        $products['brand_name_ar'] = "N/A";
                    }
                    $model_id = $this->Vendor_model->getDataResultRow('model', 'brand_id="' . $products['model_id'] . '"');
                    if ($model_id) {
                        $products['model_name'] = $model_id['name'];
                        $products['model_name_ar'] = $model_id['name_ar'];
                    } else {
                        $products['model_name'] = "N/A";
                        $products['model_name_ar'] = "N/A";
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
                            $vendor_id = $this->vendor_data['vendor_id'];
                            $imagesArr = array();
                            $attribute['images'] = trim($attribute['images'], ',');
                            if ($attribute['images']) {
                                $expImgs = explode(',', $attribute['images']);
                                if ($expImgs) {
                                    foreach ($expImgs as $img) {
                                        $product_img = $this->Vendor_model->getDataResultRow('product_images', 'product_images_id="' . $img . '"');
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
                    // echo '<pre/>';print_r($data['product']['attribute']);exit;
                    if ($language_data == 'ar') {
                        $data['view_link'] = 'view_ar/product/edit_product_detail';
                        $this->load->view('view_ar/include/template', $data);
                    } else {
                        $data['view_link'] = 'product/edit_product_detail';
                        $this->load->view('include/template', $data);
                    }
                } else {
                    echo "<script>alert('Product not found.');window.location.href='" . base_url() . "vendor/product-list';</script>";
                }
            }
        } else {
            redirect('vendor/service-list');
        }
    }

    public function edit_product_detail_15_07() {
        if ($this->vendor_data['business_type'] == 1) {
            $productId = $this->uri->segment(3);
            $vendor_id = $this->vendor_data['vendor_id'];
            if (isset($_POST['edit_product'])) {
                $product = array(
                    'discount' => $_POST['discount'],
                    'name' => $_POST['name'],
                    'name_ar' => $_POST['name_ar'],
                    'description_short' => $_POST['description'],
                    'description_short_ar' => $_POST['description'],
                    'description' => $_POST['description'],
                    'description_ar' => $_POST['description_ar'],
                    'status' => 2,
                    'updated_at' => strtotime(date('Y-m-d H:i:s'))
                );
                $product = $this->Vendor_model->updateData(['product_id' => $productId], 'products', $product);
                if ($product) {
                    redirect('vendor/product-detail/' . $productId);
                } else {
                    redirect('vendor/edit-product-detail/' . $productId);
                }
            } else {
                $products = $this->db->select("products.*,pc.name as category_name,psc.name as sub_category_name")
                                ->where("products.product_id", $productId)
                                ->where("products.vendor_id", $vendor_id)
                                ->join("product_category as pc", "pc.category_id=products.category_id")
                                ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
                                ->get("products")->row_array();
                if ($products) {
                    $brand_id = $this->Vendor_model->getDataResultRow('brand', 'brand_id="' . $products['brand_id'] . '"');
                    if ($brand_id) {
                        $products['brand_name'] = $brand_id['name'];
                    } else {
                        $products['brand_name'] = "N/A";
                    }
                    $model_id = $this->Vendor_model->getDataResultRow('model', 'brand_id="' . $products['model_id'] . '"');
                    if ($model_id) {
                        $products['model_name'] = $model_id['name'];
                    } else {
                        $products['model_name'] = "N/A";
                    }
                    $data['product'] = $products;
                    $data['view_link'] = 'product/edit_product_detail';
                    $this->load->view('include/template', $data);
                } else {
                    echo "<script>alert('Product not found.');window.location.href='" . base_url() . "vendor/product-list';</script>";
                }
            }
        } else {
            redirect('vendor/service-list');
        }
    }

    public function edit_product_attribute() {
        $productId = $this->uri->segment(3);
        $itemId = $this->uri->segment(4);
        $vendor_id = $this->vendor_data['vendor_id'];
        $attribute = $this->Vendor_model->getDataResultRow('product_attribute_group', 'item_id="' . $itemId . '" AND product_id="' . $productId . '"');
        if ($attribute) {
            $imagesArr = array();
            $attribute['images'] = trim($attribute['images'], ',');
            if ($attribute['images']) {
                $expImgs = explode(',', $attribute['images']);
                if ($expImgs) {
                    foreach ($expImgs as $img) {
                        $product_img = $this->Vendor_model->getDataResultRow('product_images', 'product_images_id="' . $img . '"');
                        $imgObj = array('product_images_id' => $product_img['product_images_id'], 'image' => $product_img['file_path'] . $product_img['file_name']);
                        array_push($imagesArr, $imgObj);
                    }
                }
            } else {
                $expImgs = [];
            }
            $attribute['imagesArr'] = $imagesArr;
            if (isset($_POST['edit_product'])) {

                foreach ($_FILES['image']['name'] as $key => $file) {
                    if ($file) {
                        $file_ext = explode('.', $file);
                        $uploadPath = 'uploads/products/';
                        $uploadFile = urlencode(time() . $this->my_random_string($this->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];
//                        if (move_uploaded_file($_FILES['image']['tmp_name'][$key], $uploadPath . $uploadFile)) {
//                            $insertTmgArr = [
//                                'file_path' => base_url() . $uploadPath,
//                                'file_name' => $uploadFile,
//                                'file_type' => end($file_ext)
//                            ];
//                            $returnId = $this->Vendor_model->addData('product_images', $insertTmgArr);
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
                                    $returnId = $this->Vendor_model->addData('product_images', $insertTmgArr);
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
                    'item_no' => $_POST['item_no'], 'price' => $_POST['price'], 'discount' => $_POST['discount'], 'quantity' => $_POST['quantity']
                ];
                $product['images'] = trim(implode(',', $expImgs), ',');
                $product = $this->Vendor_model->updateData(['item_id' => $_POST['item_id'], 'product_id' => $productId], 'product_attribute_group', $product);

                $product = array(
                    'status' => 2,
                    'updated_at' => strtotime(date('Y-m-d H:i:s'))
                );
                $product = $this->Vendor_model->updateData(['product_id' => $productId], 'products', $product);


                if ($product) {
                    redirect('vendor/product-detail/' . $productId);
                } else {
                    echo "<script>alert('Some Error Occured.');window.location.href='" . base_url() . "vendor/product-detail/" . $productId . "';</script>";
                }
            } else {
                $data['list'] = $attribute;
                $data['view_link'] = 'product/edit_product_attribute';
                $this->load->view('include/template', $data);
            }
        } else {
            echo "<script>alert('Item not found. Some Error Occured.');window.location.href='" . base_url() . "vendor/product-detail/" . $productId . "';</script>";
        }
    }

    public function service_list() {
        $language_data = $this->language_data;
        if ($this->vendor_data['business_type'] == 2) {
            $vendor_id = $this->vendor_data['vendor_id'];
            $services = $this->db->select("service.*,c.name as category_name,c.name_ar as category_name_ar,sb_c.name as sub_category_name,sb_c.name_ar as sub_category_name_ar")
                            ->where("service.vendor_id", $vendor_id)
                            ->where("service.status!=", 99)
                            ->join("service_category as c", "c.category_id=service.category_id")
                            ->join("service_sub_category as sb_c", "sb_c.sub_category_id=service.sub_category_id")
                            ->order_by('service.service_id', 'DESC')
                            ->get("service")->result_array();

            $data['service_list'] = $services;
            if ($language_data == 'ar') {
                $data['view_link'] = 'view_ar/service/service_list';
                $this->load->view('view_ar/include/template', $data);
            } else {
                $data['view_link'] = 'service/service_list';
                $this->load->view('include/template', $data);
            }
        } else {
            redirect('vendor/product-list');
        }
    }

    public function service_detail() {
        $language_data = $this->language_data;
        if ($this->vendor_data['business_type'] == 2) {
            $service_id = $this->uri->segment(3);
            $vendor_id = $this->vendor_data['vendor_id'];
            $services = $this->db->select("service.*,c.name as category_name,c.name_ar as category_name_ar,sb_c.name as sub_category_name,sb_c.name_ar as sub_category_name_ar")
                            ->where("service.vendor_id", $vendor_id)
                            ->where("service.service_id", $service_id)
                            ->where("service.status!=", 99)
                            ->join("service_category as c", "c.category_id=service.category_id")
                            ->join("service_sub_category as sb_c", "sb_c.sub_category_id=service.sub_category_id")
                            ->get("service")->row_array();
            if ($services) {
                $service_feature = $this->Vendor_model->getData(['service_id' => $service_id], 'service_featuer', '', 'service_id', 'DESC');
                $data['service'] = $services;
                $data['service_feature'] = $service_feature;
                if ($language_data == 'ar') {
                    $data['view_link'] = 'view_ar/service/service_detail';
                    $this->load->view('view_ar/include/template', $data);
                } else {
                    $data['view_link'] = 'service/service_detail';
                    $this->load->view('include/template', $data);
                }
            } else {
                echo "<script>alert('Service not found. Some Error Occured.');window.location.href='" . base_url() . "vendor/service-list';</script>";
            }
        } else {
            redirect('vendor/product-list');
        }
    }

    public function add_new_service() {
        $language_data = $this->language_data;
        if ($this->vendor_data['business_type'] == 2) {
            $vendor_id = $this->vendor_data['vendor_id'];
            $service_category_list = [];
//        $service_category = $this->Vendor_model->getData(['status' => 1], 'service_category', '', 'name', 'ASC');
            $service_category = $this->db->select('DISTINCT(s.service_category_id),c.*')
                            ->where('vendor_id', $vendor_id)
                            ->from('vendor_subscription s')
                            ->join('service_category c', 'c.category_id=s.service_category_id')
                            ->get()->result_array();

            foreach ($service_category as $category) {
                $service_sub_category = $this->Vendor_model->getData(['status' => 1, 'category_id' => $category['category_id']], 'service_sub_category', '', 'name', 'ASC');
                $category['sub_category'] = $service_sub_category;
                array_push($service_category_list, $category);
            }
//echo '<pre>';print_r($service_category_list);exit;
            $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
            $this->form_validation->set_rules('name', 'Service Name', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            if ($this->form_validation->run() == False) {
                $data['category'] = $service_category_list;
                if ($language_data == 'ar') {
                    $data['view_link'] = 'view_ar/service/add_new_service';
                    $this->load->view('view_ar/include/template', $data);
                } else {
                    $data['view_link'] = 'service/add_new_service';
                    $this->load->view('include/template', $data);
                }
            } else {
                $image = $this->upload_file('image', 'uploads/services', 1);
                if ($image) {
                    $_POST['image'] = $image;
                } else {
                    $_POST['image'] = base_url() . 'assets/vendor/images/productdummy.png';
                }
                $insertArr = [
                    'vendor_id' => $vendor_id,
                    'category_id' => $this->input->post('category_id'),
                    'sub_category_id' => $this->input->post('sub_category_id'),
                    'name' => $this->input->post('name'),
                    'name_ar' => $this->input->post('name_ar'),
                    'price' => $this->input->post('price'),
                    'image' => $this->input->post('image'),
                    'discount' => $this->input->post('discount'),
                    'description' => $this->input->post('description'),
                    'description_ar' => $this->input->post('description_ar'),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $query = $this->Vendor_model->addData('service', $insertArr);
                if ($query) {
                    $features = $this->input->post('features[]');
                    foreach ($features as $feature) {
                        if ($feature) {
                            $addFeature = [
                                'service_id' => $query, 'featues' => $feature, 'status' => 1
                            ];
                            $insertFeatures = $this->Vendor_model->addData('service_featuer', $addFeature);
                        }
                    }
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Service added successfully</div>');
                    redirect('vendor/service-list');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some error occured. Try again.</div>');
                    redirect('vendor/add-new-service');
                }
            }
        } else {
            redirect('vendor/add-new-product');
        }
    }

    public function edit_service() {
        $language_data = $this->language_data;
        if ($this->vendor_data['business_type'] == 2) {
            $service_id = $this->uri->segment(3);
            $vendor_id = $this->vendor_data['vendor_id'];
            $services = $this->db->select("service.*,c.name as category_name,sb_c.name as sub_category_name")
                            ->where("service.vendor_id", $vendor_id)
                            ->where("service.service_id", $service_id)
                            ->where("service.status!=", 99)
                            ->join("service_category as c", "c.category_id=service.category_id")
                            ->join("service_sub_category as sb_c", "sb_c.sub_category_id=service.sub_category_id")
                            ->get("service")->row_array();
            if ($services) {
                $service_feature = $this->Vendor_model->getData(['service_id' => $service_id], 'service_featuer', '', 'service_id', 'DESC');
                $service_category_list = [];
                $service_category = $this->Vendor_model->getData(['status!=' => 99], 'service_category', '', 'name', 'ASC');
                foreach ($service_category as $category) {
                    $service_sub_category = $this->Vendor_model->getData(['status!=' => 99, 'category_id' => $category['category_id']], 'service_sub_category', '', 'name', 'ASC');
                    $category['sub_category'] = $service_sub_category;
                    array_push($service_category_list, $category);
                }
                $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
                $this->form_validation->set_rules('name', 'Service Name', 'required');
                $this->form_validation->set_rules('description', 'Description', 'required');
                if ($this->form_validation->run() == False) {
                    $data['service'] = $services;
                    $data['service_feature'] = $service_feature;
                    $data['category'] = $service_category_list;
                    if ($language_data == 'ar') {
                        $data['view_link'] = 'view_ar/service/edit_service_detail';
                        $this->load->view('view_ar/include/template', $data);
                    } else {
                        $data['view_link'] = 'service/edit_service_detail';
                        $this->load->view('include/template', $data);
                    }
                } else {

                    $insertArr = [
                        'name' => $this->input->post('name'),
                        'name_ar' => $this->input->post('name_ar'),
                        'price' => $this->input->post('price'),
                        'discount' => $this->input->post('discount'),
                        'description' => $this->input->post('description'),
                        'description_ar' => $this->input->post('description_ar')
                    ];
                    $image = $this->upload_file('image', 'uploads/services', 1);
                    if ($image) {
                        $insertArr['image'] = $image;
                    }
                    $query = $this->Vendor_model->updateData(['service_id' => $service_id], 'service', $insertArr);
                    if ($query) {
                        $features = $this->input->post('features[]');
                        foreach ($features as $key => $feature) {
                            if ($feature) {
                                if (isset($service_feature[$key])) {
                                    $service_feature[$key]['featues'] = $feature;
                                    $insertFeatures = $this->Vendor_model->updateData(['service_featuer_id' => $service_feature[$key]['service_featuer_id']], 'service_featuer', ['featues' => $feature]);
                                } else {
//                            if ($feature) {
                                    $addFeature = [
                                        'service_id' => $service_id, 'featues' => $feature, 'status' => 1
                                    ];
                                    $insertFeatures = $this->Vendor_model->addData('service_featuer', $addFeature);
//                            }
                                }
                            } else {
                                if (isset($service_feature[$key])) {
                                    $insertFeatures = $this->Vendor_model->deleteData('service_featuer', 'service_featuer_id', $service_feature[$key]['service_featuer_id']);
                                }
                            }
                        }
                        $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Service updated successfully</div>');
                        redirect('vendor/service-detail/' . $service_id);
                    } else {
                        $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some error occured. Try again.</div>');
                        redirect('vendor/edit-service-detail/' . $service_id);
                    }
                }
            } else {
                echo "<script>alert('Service not found. Some Error Occured.');window.location.href='" . base_url() . "vendor/service-list';</script>";
            }
        } else {
            redirect('vendor/product-list');
        }
    }

    function upload_file($img_name, $uploadPath, $type) {

//print_r($image);exit;
        if (!empty($_FILES[$img_name]['name'])) {
            $file_ext = explode('.', $_FILES[$img_name]['name']);

            $uploadFile = urlencode(time() . $this->my_random_string($this->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];
            $reponse = uploadToS3($_FILES[$img_name]['tmp_name'], $uploadFile,$uploadPath);
            if ($reponse) {
                if (isset($reponse['imagepath']) && $reponse['imagepath']) {
                    if ($type == 2) {
                        $insertArr = [
                            'file_path' => 'https://zanomy.s3.us-east-2.amazonaws.com/services/',
                            'file_name' => $uploadFile,
                            'file_type' => $file_ext[1],
                            'status' => 1,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        $returnId = $this->Vendor_model->addFile($insertArr);
                    } else {
                        $returnId = 'https://zanomy.s3.us-east-2.amazonaws.com/services/' . $uploadFile;
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
//                    $returnId = $this->Vendor_model->addFile($insertArr);
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

    public function ajax() {
        $this->load->view('ajaxserver');
    }

}
