<?php

if ($_POST['method'] == 'checkStatus') {

    $id = $this->input->post('id');
    $status = $this->input->post('action');

    $query = $this->Admin_model->updatedataTable('product_category', ['category_id' => $id], array('status' => $status));
    //echo $this->db->last_query();exit;
    //echo "<pre>";print_r($query);exit;
    if ($query) {
        $error = false;
        $code = 100;
        $msg = 'User Unblock Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'subCategoryStatus') {

    $id = $this->input->post('id');
    $status = $this->input->post('action');

    $query = $this->Admin_model->updatedataTable('product_sub_category', ['sub_category_id' => $id], array('status' => $status));
    //echo "<pre>";print_r($query);exit;
    if ($query) {
        $error = false;
        $code = 100;
        $msg = 'User Unblock Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
if ($_POST['method'] == 'showOnHome') {

    $id = $this->input->post('id');
    $status = $this->input->post('action');

    $query = $this->Admin_model->updatedataTable('product_sub_category', ['sub_category_id' => $id], array('home' => $status));
    //echo "<pre>";print_r($query);exit;
    if ($query) {
        $error = false;
        $code = 100;
        $msg = 'User Unblock Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'ChangeBrandStatus') {

    $id = $this->input->post('id');
    $status = $this->input->post('action');

    $query = $this->Admin_model->updatedataTable('brand', ['brand_id' => $id], array('status' => $status));
    //echo "<pre>";print_r($query);exit;
    if ($query) {
        $error = false;
        $code = 100;
        $msg = 'User Unblock Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'ModelStatus') {

    $id = $this->input->post('id');
    $status = $this->input->post('action');

    if (isset($_POST['type']) and $_POST['type']) {
        if ($_POST['type'] == 2) {
            $query = $this->Admin_model->deleteData('brand_mapping', 'brand_mapping_id', $id);
        }
    } else {
        $query = $this->Admin_model->updatedataTable('model', ['model_id' => $id], array('status' => $status));
    }
    //echo "<pre>";print_r($query);exit;
    if ($query) {
        $error = false;
        $code = 100;
        $msg = 'User Unblock Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'ChangeAttributeStatus') {

    $id = $this->input->post('id');
    $status = $this->input->post('action');
    $type = $this->input->post('type');
    if ($type == 1) {
        $query = $this->Admin_model->updatedataTable('attribute', ['attribute_id' => $id], array('status' => $status));
    } elseif ($type == 2) {
        $query = $this->Admin_model->updatedataTable('attribute_value', ['attribute_value_id' => $id], array('status' => $status));
    } elseif ($type == 3) {
        $query = $this->Admin_model->updatedataTable('featuers', ['featuers_id' => $id], array('status' => $status));
    } elseif ($type == 4) {
        $query = $this->Admin_model->updatedataTable('model', ['model_id' => $id], array('status' => $status));
    } elseif ($type == 5) {
        $query = $this->Admin_model->updatedataTable('coupon', ['coupon_id' => $id], array('status' => $status));
    }elseif ($type == 6) {
        $query = $this->Admin_model->updatedataTable('admin_slider', ['slider_id' => $id], array('status' => $status));
    }
    //echo "<pre>";print_r($query);exit;
    if ($query) {
        $error = false;
        $code = 100;
        $msg = 'User Unblock Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'getSubCategory') {
    if (isset($_POST['mappedType']) and $_POST['mappedType']) {
        if ($_POST['mappedType'] == 1) {
            $query = $this->Admin_model->getDataResultArray('product_sub_category', 'status=1 and category_id="' . $_POST['category_id'] . '" and is_brand=1', 'sub_category_id');
        } else {
            $query = $this->Admin_model->getDataResultArray('product_sub_category', 'status=1 and category_id="' . $_POST['category_id'] . '" and is_model=1', 'sub_category_id');
        }
    } else {
        $query = $this->Admin_model->getDataResultArray('product_sub_category', 'status=1 and category_id="' . $_POST['category_id'] . '"', 'sub_category_id');
    }
    if ($query) {
        $error = false;
        $code = 100;
        $msg = 'Sub-Category List';
        $data = $query;
    } else {
        $error = true;
        $code = 101;
        $msg = 'No data found.';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'BrandMapping') {
    //print_r($_POST);exit;
    $checkBrand = $this->Admin_model->getDataResultRow('brand_mapping', 'category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '" and brand_id="' . $_POST['brand_id'] . '"');
    if ($checkBrand) {
        $error = true;
        $code = 101;
        $msg = 'Already Mapped.';
        $data = array();
    } else {
        $brand_mapping = array('category_id' => $_POST['category_id'], 'sub_category_id' => $_POST['sub_category_id'], 'brand_id' => $_POST['brand_id']);
        $query = $this->Admin_model->addData('brand_mapping', $brand_mapping);
        if ($query) {
            $error = true;
            $code = 100;
            $msg = 'Brand Mapped.';
            $data = array();
        } else {
            $error = true;
            $code = 102;
            $msg = 'Error found.';
            $data = array();
        }
    }

    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'getBrandModel') {

    $query = $this->Admin_model->getDataResultArray('model', 'status=1 and brand_id="' . $_POST['brand_id'] . '"', 'model_id');
    if ($query) {
        $error = false;
        $code = 100;
        $msg = 'Model List';
        $data = $query;
    } else {
        $error = true;
        $code = 101;
        $msg = 'No data found.';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'getMappedBrandModel') {

    $query = $this->Admin_model->getDataResultArray('model_mapping', 'status=1 and brand_mapping_id="' . $_POST['brand_mapping_id'] . '"', 'model_mapping_id');
    if ($query) {
        $result = array();
        foreach ($query as $val) {
            $res = $this->Admin_model->getDataResultRow('model', 'status=1 and model_id="' . $val['model_id'] . '"');
            if ($res) {
                $val['name'] = $res['name'];
                array_push($result, $val);
            }
        }
        $error = false;
        $code = 100;
        $msg = 'Model List';
        $data = $result;
    } else {
        $error = true;
        $code = 101;
        $msg = 'No data found.';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'BrandModelMapping') {
    //print_r($_POST);exit;
    $checkBrand = $this->Admin_model->getDataResultRow('brand_mapping', 'category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '" and brand_id="' . $_POST['brand_id'] . '"');
    // print_r($checkBrand);exit;
    if ($checkBrand) {
        $query = $checkBrand['brand_mapping_id'];
    } else {
        $brand_mapping = array('category_id' => $_POST['category_id'], 'sub_category_id' => $_POST['sub_category_id'], 'brand_id' => $_POST['brand_id']);
        $query = $this->Admin_model->addData('brand_mapping', $brand_mapping);
    }
    if ($query) {
        // $checkModel = $this->Admin_model->getDataResultRow('model_mapping', 'brand_id="' . $_POST['brand_id'] . '" and model_id="' . $_POST['model_id'] . '"');
        $checkModel = $this->Admin_model->getDataResultRow('model_mapping', 'brand_mapping_id="' . $query . '" and model_id="' . $_POST['model_id'] . '"');
        if ($checkModel) {
            $query2 = false;
        } else {
            $model_mapping = array('brand_mapping_id' => $query, 'brand_id' => $_POST['brand_id'], 'model_id' => $_POST['model_id']);
            $query2 = $this->Admin_model->addData('model_mapping', $model_mapping);
        }

        if ($query2) {
            $error = true;
            $code = 100;
            $msg = 'Model Mapped.';
            $data = array();
        } else {
            $error = true;
            $code = 102;
            $msg = 'Already Mapped.';
            $data = array();
        }
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error found.';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'getMappedBrand') {
    $mappedArr = array();
    $attributeArr = array();
    $specificationArr = array();
    $query = $this->Admin_model->getDataResultArray('brand_mapping', 'status=1 and category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '"', 'brand_mapping_id');
    if ($query) {
        foreach ($query as $val) {
            $brand = $this->Admin_model->getDataResultRow('brand', 'status=1 and brand_id="' . $val['brand_id'] . '" ', 'brand_mapping_id');
            if ($brand) {
                $val['name'] = $brand['name'];
                array_push($mappedArr, $val);
            }
        }
    }

    $attribute_mapping = $this->db->select("attribute_mapping.*,a.name,a.name_ar")
                    ->where("attribute_mapping.category_id", $_POST['category_id'])
                    ->where("attribute_mapping.sub_category_id", $_POST['sub_category_id'])
                    ->where("attribute_mapping.type", 1)
                    ->where("a.status", 1)
                    ->join("attribute as a", "a.attribute_id=attribute_mapping.attribute_id")
                    ->get("attribute_mapping")->result_array();
    if ($attribute_mapping) {
        foreach ($attribute_mapping as $attr) {
            $value = $this->Admin_model->getDataResultArray('attribute_value', 'status=1 and attribute_id="' . $attr['attribute_id'] . '"', 'attribute_value_id');
            if ($value) {
                $attr['attribute_value'] = $value;
                array_push($attributeArr, $attr);
            }
        }
    }

    $specification_mapping = $this->db->select("attribute_mapping.*,a.name,a.name_ar")
                    ->where("attribute_mapping.category_id", $_POST['category_id'])
                    ->where("attribute_mapping.sub_category_id", $_POST['sub_category_id'])
                    ->where("attribute_mapping.type", 2)
                    ->where("a.status", 1)
                    ->join("attribute as a", "a.attribute_id=attribute_mapping.attribute_id")
                    ->get("attribute_mapping")->result_array();
    if ($specification_mapping) {
        foreach ($specification_mapping as $attr) {
            $value = $this->Admin_model->getDataResultArray('attribute_value', 'status=1 and attribute_id="' . $attr['attribute_id'] . '"', 'attribute_value_id');
            if ($value) {
                $attr['attribute_value'] = $value;
                array_push($specificationArr, $attr);
            }
        }
    }

    $featuers_mapping = $this->db->select("featuers_mapping.*,f.name,f.name_ar")
                    ->where("featuers_mapping.category_id", $_POST['category_id'])
                    ->where("featuers_mapping.sub_category_id", $_POST['sub_category_id'])
                    ->where("f.status", 1)
                    ->join("featuers as f", "f.featuers_id=featuers_mapping.featuers_id")
                    ->get("featuers_mapping")->result_array();
    $error = false;
    $code = 100;
    $msg = 'Model List';
    $data = array('mappedArr' => $mappedArr, 'attribute_mapping' => $attributeArr, 'specification_mapping' => $specificationArr, 'featuers_mapping' => $featuers_mapping);
    //echo '<pre/>';print_r($data);exit;
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

















if ($_POST['method'] == 'getMappedProduct') {



    $productListArr = array();
    $filter_condition = ['status'=>'1'];
    $filterAttr = [];
    if (isset($_POST['category_id']) && $_POST['category_id']) {
        $filterAttr = $this->Admin_model->setFilterAttributes(['category_id' => $_POST['category_id']]);
        $filter_condition = ['products.category_id' => $_POST['category_id']];
    }
    if (isset($_POST['sub_category_id']) && $_POST['sub_category_id']) {
        $filter_condition = ['products.sub_category_id' => $_POST['sub_category_id']];
    }
    
    if ($filter_condition) {
        $this->db->where($filter_condition);
    }
    $products = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.quantity,pag.price,pag.images,pc.name as category_name,psc.name as sub_category_name")
                    ->where("products.status!=", 99)
                    ->where("pag.group_id", 0)
                    ->where("products.status!=", 99)
                    ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                    ->join("product_category as pc", "pc.category_id=products.category_id")
                    ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
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
  
    $error = false;
    $code = 100;
    $msg = 'Model List';
    $data = $productListArr;
    //echo '<pre/>';print_r($data);exit;
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));


}



if ($_POST['method'] == 'getMappedModel') {

    $query = $this->Admin_model->getDataResultRow('brand_mapping', 'status=1 and category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '" and brand_id="' . $_POST['brand_id'] . '"');
    if ($query) {
        $mappedArr = array();
        $brand = $this->Admin_model->getDataResultArray('model_mapping', 'status=1 and brand_mapping_id="' . $query['brand_mapping_id'] . '" ', 'model_mapping_id');
        if ($brand) {
            foreach ($brand as $val) {
                $model = $this->Admin_model->getDataResultRow('model', 'status=1 and model_id="' . $val['model_id'] . '" ');
                if ($model) {
                    $val['name'] = $model['name'];
                    array_push($mappedArr, $val);
                }
            }
        }

        $error = false;
        $code = 100;
        $msg = 'Model List';
        $data = $mappedArr;
    } else {
        $error = true;
        $code = 101;
        $msg = 'No data found.';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
if ($_POST['method'] == 'getAttributeValue') {

    $query = $this->Admin_model->getDataResultArray('attribute_value', 'status=1 and attribute_id="' . $_POST['attribute_id'] . '"', 'attribute_id');
    if ($query) {
        $error = false;
        $code = 100;
        $msg = 'Attribute Value List';
        $data = $query;
    } else {
        $error = true;
        $code = 101;
        $msg = 'No data found.';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'attributeValueMapping') {
    //print_r($_POST);exit;
    $checkBrand = $this->Admin_model->getDataResultRow('attribute_mapping', 'category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '" and attribute_id="' . $_POST['attribute_id'] . '"');
    if ($checkBrand) {
        $error = true;
        $code = 101;
        $msg = 'Attribute already mapped.';
        $data = array();
    } else {
        if ($_POST['type'] == 1) {
            $getCount = $this->Admin_model->getDataResultArray('attribute_mapping', 'category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '"  and type=1', 'attribute_mapping_id');
            if (count($getCount) > 2) {
                $error = true;
                $code = 102;
                $msg = 'Only 3 attribute mapped with same category & sub category.';
                $data = array();
            } else {
                $ck1 = $this->Admin_model->getDataResultRow('attribute_mapping', 'category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '" and attribute_id="' . $_POST['attribute_id'] . '" and is_primary=1');
                if ($ck1) {
                    $addCount = count($getCount) + 1;
                } else {
                    $addCount = 1;
                }
                $addCount = count($getCount) + 1;
                $brand_mapping = array(
                    'category_id' => $_POST['category_id'],
                    'sub_category_id' => $_POST['sub_category_id'],
                    'attribute_id' => $_POST['attribute_id'],
                    'is_primary' => $addCount,
                    'is_required' => 1,
                    'is_filter' => 1,
                    'type' => 1,
                    'status' => 1
                );
                $query = $this->Admin_model->addData('attribute_mapping', $brand_mapping);
                if ($query) {
                    $error = false;
                    $code = 100;
                    $msg = 'Attribute Mapped.';
                    $data = $query;
                } else {
                    $error = true;
                    $code = 103;
                    $msg = 'Error found.';
                    $data = array();
                }
            }
        } else {
            $brand_mapping = array(
                'category_id' => $_POST['category_id'],
                'sub_category_id' => $_POST['sub_category_id'],
                'attribute_id' => $_POST['attribute_id'],
                'is_required' => $_POST['is_required'],
                'is_filter' => $_POST['is_filter'],
                'type' => $_POST['type'],
                'status' => 1
            );
            $query = $this->Admin_model->addData('attribute_mapping', $brand_mapping);
            if ($query) {
                $error = false;
                $code = 100;
                $msg = 'Attribute Mapped.';
                $data = $query;
            } else {
                $error = true;
                $code = 103;
                $msg = 'Error found.';
                $data = array();
            }
        }
    }

    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'getMappedAttributes') {

    $query = $this->Admin_model->getDataResultArray('attribute_mapping', 'status=1 and category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '"', 'attribute_mapping_id');
    if ($query) {
        $mappedArr = array();
        foreach ($query as $val) {
            $brand = $this->Admin_model->getDataResultRow('attribute', 'status=1 and attribute_id="' . $val['attribute_id'] . '" ');
            if ($brand) {
                $val['name'] = $brand['name'];
                array_push($mappedArr, $val);
            }
        }
        $error = false;
        $code = 100;
        $msg = 'Attribute List';
        $data = $mappedArr;
    } else {
        $error = true;
        $code = 101;
        $msg = 'No data found.';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'getMappedAttributeValue') {


    $mappedArr = array();
    $brand = $this->Admin_model->getDataResultArray('attribute_value', 'status=1 and attribute_id="' . $_POST['attribute_id'] . '" ', 'attribute_value_id');
    if ($brand) {
        $error = false;
        $code = 100;
        $msg = 'Attribute value list.';
        $data = $brand;
    } else {
        $error = false;
        $code = 101;
        $msg = 'No data found.';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'featuersMapping') {
    //print_r($_POST);exit;
    $checkBrand = $this->Admin_model->getDataResultRow('featuers_mapping', 'category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '" and featuers_id="' . $_POST['featuers_id'] . '"');
    if ($checkBrand) {
        $error = true;
        $code = 101;
        $msg = 'Featuers Mapped.';
        $data = array();
    } else {
        $brand_mapping = array('category_id' => $_POST['category_id'], 'sub_category_id' => $_POST['sub_category_id'], 'featuers_id' => $_POST['featuers_id']);
        $query = $this->Admin_model->addData('featuers_mapping', $brand_mapping);
        if ($query) {
            $error = true;
            $code = 100;
            $msg = 'Featuers Mapped.';
            $data = array();
        } else {
            $error = true;
            $code = 102;
            $msg = 'Error found.';
            $data = array();
        }
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'getMappedFeatuers') {

    $query = $this->Admin_model->getDataResultArray('featuers_mapping', 'category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '"', 'featuers_mapping_id');
    if ($query) {
        $mappedArr = array();
        foreach ($query as $val) {
            $brand = $this->Admin_model->getDataResultRow('featuers', 'status=1 and featuers_id="' . $val['featuers_id'] . '" ');
            if ($brand) {
                $val['name'] = $brand['name'];
                array_push($mappedArr, $val);
            }
        }
        $error = false;
        $code = 100;
        $msg = 'Featuers List';
        $data = $mappedArr;
    } else {
        $error = true;
        $code = 101;
        $msg = 'No data found.';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'ChangeStatusSetting') {

    $id = $this->input->post('id');
    $status = $this->input->post('action');
    $type = $this->input->post('type');
    if ($type == 1) {
        if ($status == '2') {
            $reason = $this->input->post('reason');
            $query = $this->Admin_model->updatedataTable('users', ['user_id' => $id], array('status' => $status, 'block_reason' => $reason));
        } else {
            $query = $this->Admin_model->updatedataTable('users', ['user_id' => $id], array('status' => $status));
        }
    } elseif ($type == 2) {
        if ($status == '2') {
            $reason = $this->input->post('reason');
            $query = $this->Admin_model->updatedataTable('vendor', ['vendor_id' => $id], array('status' => $status, 'block_reason' => $reason));
        } else {
            $query = $this->Admin_model->updatedataTable('vendor', ['vendor_id' => $id], array('status' => $status));
        }
    } elseif ($type == 3) {
        if ($status == '2') {
            $reason = $this->input->post('reason');
            $query = $this->Admin_model->updatedataTable('driver', ['driver_id' => $id], array('status' => $status, 'block_reason' => $reason));
        } else {
            $query = $this->Admin_model->updatedataTable('driver', ['driver_id' => $id], array('status' => $status));
        }
    }
    //echo "<pre>";print_r($query);exit;
    if ($query) {
        $error = false;
        $code = 100;
        $msg = 'User Unblock Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'addDriver') {
    $email = $this->Admin_model->getDataResultRow('driver', 'email="' . $_POST['email'] . '"');
    if ($email) {
        $error = true;
        $code = 103;
        $msg = 'Email already exist.';
        $data = array();
    } else {
        $mobile = $this->Admin_model->getDataResultRow('driver', 'country_code="' . $_POST['country_code'] . '" and mobile="' . $_POST['mobile'] . '"');
        if ($mobile) {
            $error = true;
            $code = 102;
            $msg = 'Mobile already exist.';
            $data = array();
        } else {
            $arr = array(
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'image' => base_url('assets/vendor/images/userdummy.png'),
                'country_code' => $_POST['country_code'],
                'mobile' => $_POST['mobile'],
                'password' => md5($_POST['password']),
                'address' => $_POST['address'],
                'latitude' => $_POST['latitude'],
                'longitude' => $_POST['longitude'],
                'status' => 1,
                'created_at' => strtotime(date('Y-m-d H:i:s'))
            );
            $insert = $this->Admin_model->addData('driver', $arr);
            if ($insert) {
                $error = false;
                $code = 100;
                $msg = 'Driver added successfully.';
                $data = array();
            } else {
                $error = true;
                $code = 101;
                $msg = 'Error found.';
                $data = array();
            }
        }
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'editDriver') {
    $arr = array(
        'name' => $_POST['name'],
        'address' => $_POST['address'],
        'latitude' => $_POST['latitude'],
        'longitude' => $_POST['longitude']
    );
    $insert = $this->Admin_model->updatedataTable('driver', ['driver_id' => $_POST['driver_id']], $arr);
    if ($insert) {
        $error = false;
        $code = 100;
        $msg = 'Driver updated successfully.';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error found.';
        $data = array();
    }

    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
if ($_POST['method'] == 'changePassword') {
    $arr = array(
        'password' => md5($_POST['password']),
    );
    if($_POST['type']==1){
        $insert = $this->Admin_model->updatedataTable('vendor', ['vendor_id' => $_POST['driver_id']], $arr);
    }else{
        $insert = $this->Admin_model->updatedataTable('driver', ['driver_id' => $_POST['driver_id']], $arr);
    }
    if ($insert) {
        $error = false;
        $code = 100;
        $msg = 'Password updated successfully.';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error found.';
        $data = array();
    }

    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'changeStatus') {
    $id = $this->input->post('id');
    $update['status'] = $this->input->post('action');
    $type = $_POST['type'];
    if ($type == '1') {
        $table = 'products';
        $coulmnId = 'product_id';
    } elseif ($type == '2') {
        $table = 'services';
        $coulmnId = 'service_id';
    }elseif ($type == '3') {
        $table = 'home_layout';
        $coulmnId = 'home_layout_id';
    }
    $query = $this->Admin_model->updateData($coulmnId . '="' . $id . '"', $table, $update);
    if ($query) {
        $error = false;
        $code = 200;
        $msg = 'Data Updated Successfully.';
        $data = array();
    } else {
        $error = false;
        $code = 201;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
////////////////////////////////DELETE ITEM/////////////////////////////
if ($_POST['method'] == 'deleteItemData') {
    $product_id = $this->input->post('product_id');
    $item_id = $this->input->post('item_id');
    $update['item_status'] = 99;
    $getFirstGroup = $this->Admin_model->getDataResultRow('product_attribute_group', 'item_id="' . $item_id . '" ');
    $query = $this->Admin_model->updateData('item_id="' . $item_id . '"', 'product_attribute_group', $update);
    if ($getFirstGroup['group_id'] == 0 or $getFirstGroup['group_id'] == '0') {
        $getSecondGroup = $this->Admin_model->getDataResultRow('product_attribute_group', 'product_id="' . $product_id . '" and item_status=1');
        if($getSecondGroup){
            $update2['group_id'] = 0;
            $query = $this->Admin_model->updateData('item_id="' . $getSecondGroup['item_id'] . '"', 'product_attribute_group', $update2);
        }
    }

    if ($query) {
        $error = false;
        $code = 200;
        $msg = 'Data Updated Successfully.';
        $data = array();
    } else {
        $error = false;
        $code = 201;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
////////////////////////////////DELETE ITEM/////////////////////////////


if ($_POST['method'] == 'updateCommission') {
    $id = $this->input->post('product_id');
    $commission = $this->input->post('commission');
    $query = $this->Admin_model->updatedataTable('products', ['product_id' => $id], array('commission' => $commission));
    //echo "<pre>";print_r($query);exit;
    if ($query) {
        $error = false;
        $code = 200;
        $msg = 'Commission Updated Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 201;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
if ($_POST['method'] == 'updateCommissionVendor') {
    $id = $this->input->post('vendor_id');
    $commission = $this->input->post('commission');
    $query = $this->Admin_model->updatedataTable('vendor', ['vendor_id' => $id], array('commission' => $commission));
    //echo "<pre>";print_r($query);exit;
    if ($query) {
        $error = false;
        $code = 200;
        $msg = 'Commission Updated Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 201;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'updatePaidCommissionVendor') {
    $id = $this->input->post('vendor_id');
    $commission = $this->input->post('paid_amount');
    $insertArr=[
        'vendor_id'=>$id,
        'order_id'=>$this->input->post('order_id'),
        'amount'=>$this->input->post('paid_amount'),
        'comission_amount'=>$this->input->post('admin'),
        'created_at'=>date('Y-m-d H:i:s')
    ];
    $getVendor = $this->Admin_model->getDataResultRow('vendor', 'vendor_id="' . $id . '" ');
    if ($getVendor) {
        $query = $this->Admin_model->addData('vendor_commission', $insertArr);
        if ($query) {
//            $paid_commission = $getVendor['paid_commission'] + $commission;
//            $query = $this->Admin_model->updatedataTable('vendor', ['vendor_id' => $id], array('paid_commission' => $paid_commission));
            $error = false;
            $code = 200;
            $msg = 'Commission Updated Successfully';
            $data = array();
        } else {
            $error = true;
            $code = 201;
            $msg = 'Error';
            $data = array();
        }
    } else {
        $error = true;
        $code = 201;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'changeAdminPassword') {
    $id = $this->input->post('id');
    $password = $this->input->post('pass');
    $getAdmin = $this->Admin_model->getDataResultRow('admin', 'id="' . $id . '" ');
    if ($getAdmin) {
        $query = $this->Admin_model->updatedataTable('admin', ['id' => $id], array('password' => $password));
        if ($query) {
            $error = false;
            $code = 200;
            $msg = 'Password Updated Successfully';
            $data = array();
        } else {
            $error = true;
            $code = 201;
            $msg = 'Error';
            $data = array();
        }
    } else {
        $error = true;
        $code = 201;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'add_coupon') {

    $query = $this->Admin_model->getDataResultRow('coupon', 'status!=99 and coupon_code="' . $_POST['code'] . '"', '');
    if ($query) {

        $error = true;
        $code = 102;
        $msg = 'Coupon exist.';
        $data = array();
    } else {
        if ($_POST['applied_on'] == 1) {
            $apply_id = $_POST['category_id'];
        } elseif ($_POST['applied_on'] == 2) {
            $apply_id = $_POST['sub_category_id'];
        } elseif ($_POST['applied_on'] == 3) {
            $apply_id = $_POST['brand_id'];
        } elseif ($_POST['applied_on'] == 4) {
            $apply_id = $_POST['model_id'];
        } else {
            $apply_id = 0;
        }

        if ($_POST['discount'] == '') {
            $_POST['discount'] = 0;
        }
        if ($_POST['min_purchase'] == '') {
            $_POST['min_purchase'] = 0;
        }
        $arr = array(
            'coupon_code' => $_POST['code'],
            'coupon_discount' => $_POST['discount'],
            'coupon_type' => $_POST['type'],
            'min_purchase' => $_POST['min_purchase'],
            'total_user' => ($_POST['total_uses']),
            'single_user' => $_POST['single_uses'],
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'applied_on' => $_POST['applied_on'],
            'apply_id' => $apply_id,
            'category_id' => $_POST['category_id'],
            'sub_category_id' => $_POST['sub_category_id'],
            'brand_id' => $_POST['brand_id'],
            'model_id' => $_POST['model_id'],
            'description' => $_POST['description'],
            'description_ar' => $_POST['description_ar'],
            'coupon_privacy' => $_POST['coupon_privacy'],
            'status' => 1,
            'created_at' => (date('Y-m-d H:i:s'))
        );
        // /print_r($arr);exit;
        $insert = $this->Admin_model->addData('coupon', $arr);
        if ($insert) {
            $error = false;
            $code = 100;
            $msg = 'Coupon added successfully.';
            $data = array();
        } else {
            $error = true;
            $code = 101;
            $msg = 'Error found.';
            $data = array();
        }
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}


if ($_POST['method'] == 'deleteMultiple') {
    $id         = $this->input->post('id');
    $status     = $this->input->post('status');
    if($id){
        $id=explode('@',$id);
    }
    $type = $this->input->post('type');
    if($type==1){
        if($id){
            foreach($id as $single){
                $query = $this->Admin_model->updatedataTable('category', ['category_id' => $single], array('status'=>99));
            }
        }
    }
    if($type==2){
        if($id){
            foreach($id as $single){
                $query = $this->Admin_model->updatedataTable('reader', ['reader_id' => $single], array('status'=>99));
            }
        }
    }
    if($type==3){
        if($id){
            foreach($id as $single){
                $query = $this->Admin_model->updatedataTable('recording_list', ['recording_list_id' => $single], array('status'=>99));
            }
        }
    }
    // print_r($id);exit;
    if($type==4){
        if($id){
            foreach($id as $single){
                $query = $this->Admin_model->updatedataTable('products', ['product_id' => $single], array('status'=>$status));
            }
        }
    }
    if ($query) {
        $error = false;
        $code = 100;
        $msg  = 'User Unblock Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg  = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'sendNote') {
    date_default_timezone_set("Asia/Kolkata");
    $id         = $this->input->post('id');
    $type         = $this->input->post('type');
    $admin_logged_in=$this->session->userdata('admin_logged_in');
    // print_r($admin_logged_in);exit;
    if($type==1){
        $arr = array(
            'user_id' => $id,
            'admin_id' => $admin_logged_in['id'],
            'note' => $_POST['note'],
            'created_at' => date('Y-m-d H:i:s')
        );
        $query = $this->Admin_model->addData('user_note', $arr);
    }else{
        $arr = array(
            'vendor_id' => $id,
            'admin_id' => $admin_logged_in['id'],
            'note' => $_POST['note'],
            'created_at' => date('Y-m-d H:i:s')
        );
        $query = $this->Admin_model->addData('vendor_note', $arr);
    }
    
    if ($query) {
        $error = false;
        $code = 100;
        $msg  = 'Notes Added';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg  = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'deleteNote') {
    $id         = $this->input->post('id');
    $type         = $this->input->post('type');
    
    if($type==1){
        $query = $this->db->where('user_note_id',$id)
                ->delete('user_note');
    }else{
        $query = $this->db->where('vendor_note_id',$id)
                ->delete('vendor_note');
    }
    
    if ($query) {
        $error = false;
        $code = 100;
        $msg  = 'Notes Deleted';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg  = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'addLayoutData') {
    $checker=false;
    $id         = $this->input->post('id');
    $deal_id     = $this->input->post('deal_id');
    if($deal_id){
        
            if($id){
                $id=explode('@',$id);
            }
            if($id){
                $query=$this->Admin_model->deleteData('home_layout_item','home_layout_id',$deal_id);
                foreach($id as $single){
                    $arr=array(
                        'home_layout_id'=>$deal_id,
                        'product_id'=>$single,
                    );
                    $insert=$this->Admin_model->addData('home_layout_item',$arr);
                }
                if($insert){
                    $checker=true;
                }
            }
        
    }
    if ($checker) {
        $error = false;
        $code = 100;
        $msg  = 'Items Added Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg  = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
