<?php

if ($_POST['method'] == 'setMostViewed') {

    $id = $this->input->post('id');
    $status = $this->input->post('action');
    $check = $this->Admin_model->getDataResultRow('products', ['status' => 1, 'product_id!=' => $id, 'total_views' => $status]);
    if ($check) {
        $query = $this->Admin_model->updatedataTable('products', ['total_views' => $status], array('total_views' => 0));
        $query = $this->Admin_model->updatedataTable('products', ['product_id' => $id], array('total_views' => $status));
        

        // $error = true;
        // $code = 101;
        // $msg = 'Oops! this place is already occupied';
        // $data = array();
            $error = false;
            $code = 100;
            $msg = 'Product set on homescreen successfully';
            $data = array();
    } else {
        $query = $this->Admin_model->updatedataTable('products', ['product_id' => $id], array('total_views' => $status));
        if ($query) {
            $error = false;
            $code = 100;
            if ($status) {
                $msg = 'Product set on homescreen successfully';
            } else {
                $msg = 'Product remove from homescreen';
            }
            $data = array();
        } else {
            $error = true;
            $code = 101;
            $msg = 'Error';
            $data = array();
        }
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'setMostSelling') {

    $id = $this->input->post('id');
    $status = $this->input->post('action');
    $check = $this->Admin_model->getDataResultRow('products', ['status' => 1, 'product_id!=' => $id, 'top_selling' => $status]);
    if ($check) {
        $query = $this->Admin_model->updatedataTable('products', ['top_selling' => $status], array('top_selling' => 0));
        $query = $this->Admin_model->updatedataTable('products', ['product_id' => $id], array('top_selling' => $status));

        // $error = true;
        // $code = 101;
        // $msg = 'Oops! this place is already occupied';
        // $data = array();


        $error = false;
        $code = 100;
        $msg = 'Product set on homescreen successfully';
        $data = array();
    } else {
        $query = $this->Admin_model->updatedataTable('products', ['product_id' => $id], array('top_selling' => $status));
        if ($query) {
            $error = false;
            $code = 100;
            if ($status) {
                $msg = 'Product set on homescreen successfully';
            } else {
                $msg = 'Product remove from homescreen';
            }
            $data = array();
        } else {
            $error = true;
            $code = 101;
            $msg = 'Error';
            $data = array();
        }
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'setMostBooked') {

    $id = $this->input->post('id');
    $status = $this->input->post('action');
    $check = $this->Admin_model->getDataResultRow('service', ['status' => 1, 'service_id!=' => $id, 'total_booking' => $status]);
    if ($check) {

        $query = $this->Admin_model->updatedataTable('service', ['total_booking' => $status], array('total_booking' => 0));
        $query = $this->Admin_model->updatedataTable('service', ['service_id' => $id], array('total_booking' => $status));

        // $error = true;
        // $code = 101;
        // $msg = 'Oops! this place is already occupied';
        // $data = array();


        $error = false;
        $code = 100;
        $msg = 'Product set on homescreen successfully';
        $data = array();
        
    } else {
        $query = $this->Admin_model->updatedataTable('service', ['service_id' => $id], array('total_booking' => $status));
        if ($query) {
            $error = false;
            $code = 100;
            if ($status) {
                $msg = 'Service set on homescreen successfully';
            } else {
                $msg = 'Service remove from homescreen';
            }
            $data = array();
        } else {
            $error = true;
            $code = 101;
            $msg = 'Error';
            $data = array();
        }
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'markAsTrusted') {

    $id = $this->input->post('vendor_id');
    $status = $this->input->post('action');
    $query = $this->Admin_model->updatedataTable('vendor', ['vendor_id' => $id], array('is_trusted' => $status));
    if ($query) {
        $error = false;
        $code = 100;
        if ($status) {
            $msg = 'Marked as trusted';
        } else {
            $msg = 'Removed from trusted';
        }
        $data = array();
    } else {
        $error = true;
        $code = 101;
        $msg = 'Error';
        $data = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}