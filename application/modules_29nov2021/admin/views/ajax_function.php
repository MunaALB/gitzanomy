<?php

if ($_POST['method'] == 'checkStatus') {

    $id = $this->input->post('id');
    $status = $this->input->post('action');

    $query = $this->Admin_model->updatedataTable('service_category', ['category_id' => $id], array('status' => $status));
    //echo $this->db->last_query();exit;
    //echo "<pre>";print_r($query);exit;
    if ($query) {
        $error = false;
        $code = 100;
        $msg = 'Category Unblock Successfully';
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

    $query = $this->Admin_model->updatedataTable('service_sub_category', ['sub_category_id' => $id], array('status' => $status));
    //echo "<pre>";print_r($query);exit;
    if ($query) {
        $error = false;
        $code = 100;
        $msg = 'Subcategory Unblock Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}


if ($_POST['method'] == 'updateStatus') {
    $id = $this->input->post('id');
    $status = $this->input->post('action');
    $type = $this->input->post('type');
    if ($type == 1) {
        $column = 'id';
        $table = 'hubs';
    } else if ($type == 2) {
        $column = 'city_id';
        $table = 'city';
    } else if ($type == 3) {
        $column = 'id';
        $table = 'delivery_charges';
    } else if ($type == 4) {
        $column = 'status_id';
        $table = 'order_status';
    } else if ($type == 5) {
        $column = 'plan_id';
        $table = 'subscription_plan';
    }else if($type == 6){
        $column = 'service_id';
        $table = 'service';
    }else if($type == 7){
        $column = 'id';
        $table = 'admin';
    }else if($type == 8){
        $column = 'reason_id';
        $table = 'support_reason';
    }else if($type == 9){
        $column = 'slider_id';
        $table = 'admin_slider';
    }
    $query = $this->Admin_model->updatedataTable($table, [$column => $id], array('status' => $status));
    //echo $this->db->last_query();exit;
    //echo "<pre>";print_r($query);exit;
    if ($query) {
        $error = false;
        $code = 100;
        $msg = 'Status Updated Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'assignDriver') {

    $id = $this->input->post('id');
    $driver_id = $this->input->post('driver');
    $group=rand(1000,9999);
    $query = $this->Admin_model->updatedataTable('order_items', ['order_item_id' => $id], array('driver_id' => $driver_id,'item_action'=>2,'group'=>$group));
    //echo "<pre>";print_r($query);exit;
    if ($query) {
        $error = false;
        $code = 100;
        $msg = 'Subcategory Unblock Successfully';
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}





