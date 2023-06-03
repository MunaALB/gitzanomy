<?php

if ($_POST['method'] == 'checkStatus') {
    $id = $this->input->post('id');
    $status = $this->input->post('action');
    $query = $this->Vendor_model->updatedataTable('product_category', ['category_id' => $id], array('status' => $status));
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

    $query = $this->Vendor_model->updatedataTable('product_sub_category', ['sub_category_id' => $id], array('status' => $status));
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

    $query = $this->Vendor_model->updatedataTable('model', ['model_id' => $id], array('status' => $status));
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
        $query = $this->Vendor_model->updatedataTable('attribute', ['attribute_id' => $id], array('status' => $status));
    } elseif ($type == 2) {
        $query = $this->Vendor_model->updatedataTable('attribute_value', ['attribute_value_id' => $id], array('status' => $status));
    } elseif ($type == 3) {
        $query = $this->Vendor_model->updatedataTable('featuers', ['featuers_id' => $id], array('status' => $status));
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
        $query = $this->Vendor_model->getDataResultArray('product_sub_category', 'status=1 and category_id="' . $_POST['category_id'] . '" and is_brand=1', 'sub_category_id');
    } else {
        $query = $this->Vendor_model->getDataResultArray('product_sub_category', 'status=1 and category_id="' . $_POST['category_id'] . '"', 'sub_category_id');
    }
    if ($query) {
        $error = false;
        $code = 100;
        $msg = 'Sub-Category List';
        $data = $query;
    } else {
        $error = true;
        $code = 101;
        $msg = 'No Sub-Category Available.';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
if ($_POST['method'] == 'getBrandModel') {

    $query = $this->Vendor_model->getDataResultArray('model', 'status=1 and brand_id="' . $_POST['brand_id'] . '"', 'model_id');
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

    $query = $this->Vendor_model->getDataResultArray('model_mapping', 'status=1 and brand_mapping_id="' . $_POST['brand_mapping_id'] . '"', 'model_mapping_id');
    if ($query) {
        $result = array();
        foreach ($query as $val) {
            $res = $this->Vendor_model->getDataResultRow('model', 'status=1 and model_id="' . $val['model_id'] . '"');
            if ($res) {
                $val['name'] = $res['name'];
                $val['name_ar'] = $res['name_ar'];
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
    $checkBrand = $this->Vendor_model->getDataResultRow('brand_mapping', 'category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '" and brand_id="' . $_POST['brand_id'] . '"');
    if ($checkBrand) {
        $query = $checkBrand['brand_mapping_id'];
    } else {
        $brand_mapping = array('category_id' => $_POST['category_id'], 'sub_category_id' => $_POST['sub_category_id'], 'brand_id' => $_POST['brand_id']);
        $query = $this->Vendor_model->addData('brand_mapping', $brand_mapping);
    }
    if ($query) {
        if (isset($_POST['model_id']) and $_POST['model_id']) {
            $checkModel = $this->Vendor_model->getDataResultRow('model_mapping', 'brand_id="' . $_POST['brand_id'] . '" and model_id="' . $_POST['model_id'] . '"');
            if ($checkModel) {
                $query2 = true;
            } else {
                $model_mapping = array('brand_mapping_id' => $query, 'brand_id' => $_POST['brand_id'], 'model_id' => $_POST['model_id']);
                $query2 = $this->Vendor_model->addData('model_mapping', $model_mapping);
            }
        } else {
            $query2 = true;
        }
        if ($query2) {
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
    $query = $this->Vendor_model->getDataResultArray('brand_mapping', 'status=1 and category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '"', 'brand_mapping_id');
    if ($query) {
        foreach ($query as $val) {
            $brand = $this->Vendor_model->getDataResultRow('brand', 'status=1 and brand_id="' . $val['brand_id'] . '" ', 'brand_mapping_id');
            if ($brand) {
                $val['name'] = $brand['name'];
                $val['name_ar'] = $brand['name_ar'];
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
            $value = $this->Vendor_model->getDataResultArray('attribute_value', 'status=1 and attribute_id="' . $attr['attribute_id'] . '"', 'attribute_value_id');
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
            $value = $this->Vendor_model->getDataResultArray('attribute_value', 'status=1 and attribute_id="' . $attr['attribute_id'] . '"', 'attribute_value_id');
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

if ($_POST['method'] == 'getMappedModel') {

    $query = $this->Vendor_model->getDataResultRow('brand_mapping', 'status=1 and category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '" and brand_id="' . $_POST['brand_id'] . '"');
    if ($query) {
        $mappedArr = array();
        $brand = $this->Vendor_model->getDataResultArray('model_mapping', 'status=1 and brand_mapping_id="' . $query['brand_mapping_id'] . '" ', 'model_mapping_id');
        if ($brand) {
            foreach ($brand as $val) {
                $model = $this->Vendor_model->getDataResultRow('model', 'status=1 and model_id="' . $val['model_id'] . '" ');
                $val['name'] = $model['name'];
                array_push($mappedArr, $val);
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

    $query = $this->Vendor_model->getDataResultArray('attribute_value', 'status=1 and attribute_id="' . $_POST['attribute_id'] . '"', 'attribute_id');
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
    $checkBrand = $this->Vendor_model->getDataResultRow('attribute_mapping', 'category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '" and attribute_id="' . $_POST['attribute_id'] . '"');
    if ($checkBrand) {
        $error = true;
        $code = 101;
        $msg = 'Attribute already mapped.';
        $data = array();
    } else {
        if ($_POST['type'] == 1) {
            $getCount = $this->Vendor_model->getDataResultArray('attribute_mapping', 'category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '"', 'attribute_mapping_id');
            if (count($getCount) > 2) {
                $error = true;
                $code = 102;
                $msg = 'Only 3 attribute mapped with same category & sub category.';
                $data = array();
            } else {
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
                $query = $this->Vendor_model->addData('attribute_mapping', $brand_mapping);
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
            $query = $this->Vendor_model->addData('attribute_mapping', $brand_mapping);
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

    $query = $this->Vendor_model->getDataResultArray('attribute_mapping', 'status=1 and category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '"', 'attribute_mapping_id');
    if ($query) {
        $mappedArr = array();
        foreach ($query as $val) {
            $brand = $this->Vendor_model->getDataResultRow('attribute', 'status=1 and attribute_id="' . $val['attribute_id'] . '" ');
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
    $brand = $this->Vendor_model->getDataResultArray('attribute_value', 'status=1 and attribute_id="' . $_POST['attribute_id'] . '" ', 'attribute_value_id');
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
    $checkBrand = $this->Vendor_model->getDataResultRow('featuers_mapping', 'category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '" and featuers_id="' . $_POST['featuers_id'] . '"');
    if ($checkBrand) {
        $error = true;
        $code = 101;
        $msg = 'Featuers Mapped.';
        $data = array();
    } else {
        $brand_mapping = array('category_id' => $_POST['category_id'], 'sub_category_id' => $_POST['sub_category_id'], 'featuers_id' => $_POST['featuers_id']);
        $query = $this->Vendor_model->addData('featuers_mapping', $brand_mapping);
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

    $query = $this->Vendor_model->getDataResultArray('featuers_mapping', 'category_id="' . $_POST['category_id'] . '" and sub_category_id="' . $_POST['sub_category_id'] . '"', 'featuers_mapping_id');
    if ($query) {
        $mappedArr = array();
        foreach ($query as $val) {
            $brand = $this->Vendor_model->getDataResultRow('featuers', 'status=1 and featuers_id="' . $val['featuers_id'] . '" ');
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
if ($_POST['method'] == 'changeStatus') {
    $id = $this->input->post('id');
    $update['status'] = $this->input->post('action');
    $type = $_POST['type'];
    if ($type == '1') {
        $table = 'products';
        $coulmnId = 'product_id';
    } elseif ($type == '2') {
        $table = 'service';
        $coulmnId = 'service_id';
    } elseif ($type == '3') {
        $table = 'service_booking';
        $coulmnId = 'booking_id';
    }
    $query = $this->Vendor_model->updateData($coulmnId . '="' . $id . '"', $table, $update);
    if ($query) {
        if ($type == '3') {
            //////////////NOTIFICATION//////////////////////////
            $uploadImage	=   $this->Vendor_model->getRowData('booking_id="'.$id.'" ','service_booking');

            $userData=$this->Vendor_model->getRowData('user_id="'.$uploadImage['user_id'].'"','users');
            $user_auth=$this->Vendor_model->getRowData('user_id="'.$uploadImage['user_id'].'"','user_auth');
            // print_r($pushData);exit;
            

            if($_POST['action']==1){
                $this->Vendor_model->emailPushBooking($userData['email'], 'Zanomy', "Zanomy New Booking", ['heading' => 'New Booking', 'body' =>"Booking has been Accepted successfully." ]);

                $pushData['title'] = "Booking Confirmed";
                $pushData['body'] = "Your booking id #".$id.". Has been accepted by vendor.";
                $pushData['type'] = "accept_request";
                $pushData['order_id'] = $id;
                $pushData['status'] = 2;
            
                $message = json_encode($pushData);
                if (isset($user_auth['device_type']) and $user_auth['device_type']) {
                    if (isset($user_auth['device_type']) and $user_auth['device_type'] == 2) {
                        $notify = $this->Vendor_model->sendIosPush($user_auth['device_token'], $pushData);
                    } else {
                        $notify = $this->Vendor_model->sendAndroidPush($user_auth['device_token'], $message);
                    }
                }

                $insertArr=array(
                    'order_id'  => $id,
                    'user_id'   => $uploadImage['user_id'],
                    'type'      => $pushData['type'],
                    'title'     => $pushData['title'],
                    'message'   => $pushData['body'],
                    'status'    => 2,
                );
                $inset=$this->Vendor_model->addData('user_notifications',$insertArr);
            }elseif($_POST['action']==2){
                $this->Vendor_model->emailPushBooking($userData['email'], 'Zanomy', "Zanomy New Booking", ['heading' => 'New Booking', 'body' =>"Booking is In-Process." ]);

                $pushData['title'] = "On The Way";
                $pushData['body'] = "Your booking id #".$id.". Is In-process.";
                $pushData['type'] = "on_the_way_request";
                $pushData['order_id'] = $id;
                $pushData['status'] = 2;
            
                $message = json_encode($pushData);
                if (isset($user_auth['device_type']) and $user_auth['device_type']) {
                    if (isset($user_auth['device_type']) and $user_auth['device_type'] == 2) {
                        $notify = $this->Vendor_model->sendIosPush($user_auth['device_token'], $pushData);
                    } else {
                        $notify = $this->Vendor_model->sendAndroidPush($user_auth['device_token'], $message);
                    }
                }

                $insertArr=array(
                    'order_id'  => $id,
                    'user_id'   => $uploadImage['user_id'],
                    'type'      => $pushData['type'],
                    'title'     => $pushData['title'],
                    'message'   => $pushData['body'],
                    'status'    => 2,
                );
                $inset=$this->Vendor_model->addData('user_notifications',$insertArr);
            }elseif($_POST['action']==3){
                $this->Vendor_model->emailPushBooking($userData['email'], 'Zanomy', "Zanomy New Booking", ['heading' => 'New Booking', 'body' =>"Booking is In-Process." ]);

                $pushData['title'] = "In-Process";
                $pushData['body'] = "Your booking id #".$id.". Is In-process.";
                $pushData['type'] = "in_process_request";
                $pushData['order_id'] = $id;
                $pushData['status'] = 2;
            
                $message = json_encode($pushData);
                if (isset($user_auth['device_type']) and $user_auth['device_type']) {
                    if (isset($user_auth['device_type']) and $user_auth['device_type'] == 2) {
                        $notify = $this->Vendor_model->sendIosPush($user_auth['device_token'], $pushData);
                    } else {
                        $notify = $this->Vendor_model->sendAndroidPush($user_auth['device_token'], $message);
                    }
                }

                $insertArr=array(
                    'order_id'  => $id,
                    'user_id'   => $uploadImage['user_id'],
                    'type'      => $pushData['type'],
                    'title'     => $pushData['title'],
                    'message'   => $pushData['body'],
                    'status'    => 2,
                );
                $inset=$this->Vendor_model->addData('user_notifications',$insertArr);
            }elseif($_POST['action']==4){
                $this->Vendor_model->emailPushBooking($userData['email'], 'Zanomy', "Zanomy New Booking", ['heading' => 'New Booking', 'body' =>"Booking is Completed." ]);

                $pushData['title'] = "In-Process";
                $pushData['body'] = "Your booking id #".$id.". Is Completed.";
                $pushData['type'] = "completed_request";
                $pushData['order_id'] = $id;
                $pushData['status'] = 2;
            
                $message = json_encode($pushData);
                if (isset($user_auth['device_type']) and $user_auth['device_type']) {
                    if (isset($user_auth['device_type']) and $user_auth['device_type'] == 2) {
                        $notify = $this->Vendor_model->sendIosPush($user_auth['device_token'], $pushData);
                    } else {
                        $notify = $this->Vendor_model->sendAndroidPush($user_auth['device_token'], $message);
                    }
                }

                $insertArr=array(
                    'order_id'  => $id,
                    'user_id'   => $uploadImage['user_id'],
                    'type'      => $pushData['type'],
                    'title'     => $pushData['title'],
                    'message'   => $pushData['body'],
                    'status'    => 2,
                );
                $inset=$this->Vendor_model->addData('user_notifications',$insertArr);
            }elseif($_POST['action']==5){
                $this->Vendor_model->emailPushBooking($userData['email'], 'Zanomy', "Zanomy New Booking", ['heading' => 'New Booking', 'body' =>"Booking has been Rejected." ]);

                $pushData['title'] = "Booking Confirmed";
                $pushData['body'] = "Your booking id #".$id.". Has been rejected by vendor.";
                $pushData['type'] = "reject_request";
                $pushData['order_id'] = $id;
                $pushData['status'] = 2;
            
                $message = json_encode($pushData);
                if (isset($user_auth['device_type']) and $user_auth['device_type']) {
                    if (isset($user_auth['device_type']) and $user_auth['device_type'] == 2) {
                        $notify = $this->Vendor_model->sendIosPush($user_auth['device_token'], $pushData);
                    } else {
                        $notify = $this->Vendor_model->sendAndroidPush($user_auth['device_token'], $message);
                    }
                }

                $insertArr=array(
                    'order_id'  => $id,
                    'user_id'   => $uploadImage['user_id'],
                    'type'      => $pushData['type'],
                    'title'     => $pushData['title'],
                    'message'   => $pushData['body'],
                    'status'    => 2,
                );
                $inset=$this->Vendor_model->addData('user_notifications',$insertArr);
            }
            
            
            //////////////NOTIFICATION//////////////////////////
        }
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

if ($_POST['method'] == 'changeLanguage') {
    // $model = new User_model();
    $language   = $_POST['i'];
    $this->session->set_userdata('zanomy_vendor_language_session', $language);
    $session = $this->session->userdata('zanomy_vendor_language_session');
    $error      = false;
    $code       = 200;
    $msg        = 'Attribute list.';
    $data       = array();
    
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}


////////////////////////////////DELETE ITEM/////////////////////////////
if ($_POST['method'] == 'deleteItemData') {
    $product_id = $this->input->post('product_id');
    $item_id = $this->input->post('item_id');
    $update['item_status'] = 99;
    $getFirstGroup = $this->Vendor_model->getDataResultRow('product_attribute_group', 'item_id="' . $item_id . '" ');
    $query = $this->Vendor_model->updateData('item_id="' . $item_id . '"', 'product_attribute_group', $update);
    if ($getFirstGroup['group_id'] == 0 or $getFirstGroup['group_id'] == '0') {
        $getSecondGroup = $this->Vendor_model->getDataResultRow('product_attribute_group', 'product_id="' . $product_id . '" and item_status=1');
        if($getSecondGroup){
            $update2['group_id'] = 0;
            $query = $this->Vendor_model->updateData('item_id="' . $getSecondGroup['item_id'] . '"', 'product_attribute_group', $update2);
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


?>