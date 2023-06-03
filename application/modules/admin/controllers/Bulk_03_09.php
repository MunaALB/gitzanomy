<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bulk extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        //$this->load->model(array('Login', 'Admin'));
        $this->load->model(array('Admin_model'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('excel');
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

        
    public function bulk_category_list() {
        if (isset($_POST['bulk_upload'])) {
            if (isset($_FILES["products"]["name"])) {
                $path = $_FILES["products"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                if($object->getWorksheetIterator()){
                    foreach ($object->getWorksheetIterator() as $worksheet) {
                        $highestRow = $worksheet->getHighestRow();
                        $highestColumn = $worksheet->getHighestColumn();
                        //echo '<pre/>';print_r($worksheet);exit;
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            if($name){
                                $name_ar = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                                $image = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                                if(isset($image) and $image){
                                    $image=$image;
                                }else{
                                    $image=base_url().'assets/admin/images/logo_zanomy_white.png';
                                }
                                $data = array(
                                    'name' => $name,
                                    'name_ar' => $name_ar,
                                    'image' => $image,
                                    'status' => '1',
                                    'created_at' => strtotime(date('Y-m-d H:i:s'))
                                );
                                //echo '<pre/>';print_r($data);exit;
                                $returnData=$this->db->insert('product_category' , $data);
                            }
                        }
                    }
                }
                //echo '<pre>';print_r($data);exit;
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Category added successfully</div>');
                    redirect('admin/category-list');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some error found</div>');
                    redirect('admin/category-list');
                }
            }
            
        }else{
            redirect('admin/category-list');
        }
        
    }
    public function bulk_subcategory_list() {
        if (isset($_POST['bulk_upload'])) {
            $categoryId=$_POST['bulk_category'];
            if (isset($_FILES["products"]["name"])) {
                $path = $_FILES["products"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                if($object->getWorksheetIterator()){
                    foreach ($object->getWorksheetIterator() as $worksheet) {
                        $highestRow = $worksheet->getHighestRow();
                        $highestColumn = $worksheet->getHighestColumn();
                        //echo '<pre/>';print_r($worksheet);exit;
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            if($name){
                                $name_ar = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                                $image = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                                if(isset($image) and $image){
                                    $image=$image;
                                }else{
                                    $image=base_url().'assets/admin/images/logo_zanomy_white.png';
                                }
                                $banner=base_url().'assets/admin/images/logo_zanomy_white.png';
                                $data = array(
                                    'category_id' => $categoryId,
                                    'name' => $name,
                                    'name_ar' => $name_ar,
                                    'image' => $image,
                                    'banner' => '',
                                    'is_brand' => '0',
                                    'is_model' => '0',
                                    'status' => '1',
                                    'created_at' => strtotime(date('Y-m-d H:i:s'))
                                );
                                //echo '<pre/>';print_r($data);exit;
                                $returnData=$this->db->insert('product_sub_category' , $data);
                            }
                        }
                    }
                }
                //echo '<pre>';print_r($data);exit;
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Category added successfully</div>');
                    redirect('admin/subcategory-list');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some error found</div>');
                    redirect('admin/subcategory-list');
                }
            }
            
        }else{
            redirect('admin/subcategory-list');
        }
        
    }

    public function bulk_service_category_list() {
        if (isset($_POST['bulk_upload'])) {
            if (isset($_FILES["products"]["name"])) {
                $path = $_FILES["products"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                if($object->getWorksheetIterator()){
                    foreach ($object->getWorksheetIterator() as $worksheet) {
                        $highestRow = $worksheet->getHighestRow();
                        $highestColumn = $worksheet->getHighestColumn();
                        //echo '<pre/>';print_r($worksheet);exit;
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            if($name){
                                $name_ar = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                                $data = array(
                                    'name' => $name,
                                    'name_ar' => $name_ar,
                                    'image' => base_url().'assets/admin/images/logo_zanomy_white.png',
                                    'status' => '1',
                                    'created_at' => strtotime(date('Y-m-d H:i:s'))
                                );
                                //echo '<pre/>';print_r($data);exit;
                                $returnData=$this->db->insert('service_category' , $data);
                            }
                        }
                    }
                }
                //echo '<pre>';print_r($data);exit;
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Category added successfully</div>');
                    redirect('admin/service-category-list');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some error found</div>');
                    redirect('admin/service-category-list');
                }
            }
            
        }else{
            redirect('admin/service-category-list');
        }
        
    }

    public function bulk_service_subcategory_list() {
        if (isset($_POST['bulk_upload'])) {
            $categoryId=$_POST['bulk_category'];
            if (isset($_FILES["products"]["name"])) {
                $path = $_FILES["products"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                if($object->getWorksheetIterator()){
                    foreach ($object->getWorksheetIterator() as $worksheet) {
                        $highestRow = $worksheet->getHighestRow();
                        $highestColumn = $worksheet->getHighestColumn();
                        //echo '<pre/>';print_r($worksheet);exit;
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            if($name){
                                $name_ar = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                                $data = array(
                                    'category_id' => $categoryId,
                                    'name' => $name,
                                    'name_ar' => $name_ar,
                                    'image' => base_url().'assets/admin/images/logo_zanomy_white.png',
                                    'banner' => '',
                                    'status' => '1',
                                    'created_at' => strtotime(date('Y-m-d H:i:s'))
                                );
                                //echo '<pre/>';print_r($data);exit;
                                $returnData=$this->db->insert('service_sub_category' , $data);
                            }
                        }
                    }
                }
                //echo '<pre>';print_r($data);exit;
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Category added successfully</div>');
                    redirect('admin/service-subcategory-list');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some error found</div>');
                    redirect('admin/service-subcategory-list');
                }
            }
            
        }else{
            redirect('admin/service-subcategory-list');
        }
        
    }

    public function bulk_brand_list() {
        if (isset($_POST['bulk_upload'])) {
            if (isset($_FILES["products"]["name"])) {
                $path = $_FILES["products"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                if($object->getWorksheetIterator()){
                    foreach ($object->getWorksheetIterator() as $worksheet) {
                        $highestRow = $worksheet->getHighestRow();
                        $highestColumn = $worksheet->getHighestColumn();
                        //echo '<pre/>';print_r($worksheet);exit;
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            if($name){
                                $name_ar = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                                $data = array(
                                    'name' => $name,
                                    'name_ar' => $name_ar,
                                    'image' => base_url().'assets/admin/images/logo_zanomy_white.png',
                                    'status' => '1',
                                    'created_at' => strtotime(date('Y-m-d H:i:s'))
                                );
                                //echo '<pre/>';print_r($data);exit;
                                $returnData=$this->db->insert('service_category' , $data);
                            }
                        }
                    }
                }
                //echo '<pre>';print_r($data);exit;
                if ($returnData) {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Category added successfully</div>');
                    redirect('admin/service-category-list');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some error found</div>');
                    redirect('admin/service-category-list');
                }
            }
            
        }else{
            redirect('admin/service-category-list');
        }
        
    }
       
    public function generate_excel() {
        if (isset($_POST['method'])) {
            if ($_POST['method'] == 'generateExcel') {
                $objPHPExcel = new PHPExcel();

                $modelArr=array();
                $mappedArr=array();
                $attributeArr=array();
                $specificationArr=array();
                $query   = $this->Admin_model->getDataResultArray('brand_mapping','status=1 and category_id="'.$_POST['category_id'].'" and sub_category_id="'.$_POST['sub_category_id'].'"','brand_mapping_id');
                if ($query) {
                    foreach($query as $val){
                        $brand   = $this->Admin_model->getDataResultRow('brand','status=1 and brand_id="'.$val['brand_id'].'" ','brand_mapping_id');
                        if($brand){
                            $val['name']=$brand['name'];
                            array_push($mappedArr,$val);
                        }
 
                        $model_mapping_query   = $this->Admin_model->getDataResultArray('model_mapping','status=1 and brand_mapping_id="'.$val['brand_mapping_id'].'"','model_mapping_id');
                        if ($model_mapping_query) {
                            foreach($model_mapping_query as $queryVal){
                                $res   = $this->Admin_model->getDataResultRow('model','status=1 and model_id="'.$queryVal['model_id'].'"');
                                if($res){
                                    $queryVal['name']=$res['name'];
                                    array_push($modelArr,$queryVal);
                                }
                            }
                        }
                    }
                }
                 
                $attribute_mapping = $this->db->select("attribute_mapping.*,a.name,a.name_ar")
                                     ->where("attribute_mapping.category_id",$_POST['category_id'])
                                     ->where("attribute_mapping.sub_category_id",$_POST['sub_category_id'])
                                     ->where("attribute_mapping.type",1)
                                     ->where("a.status",1)
                                     ->join("attribute as a", "a.attribute_id=attribute_mapping.attribute_id")
                                     ->get("attribute_mapping")->result_array();
                if($attribute_mapping){
                    foreach($attribute_mapping as $attr){
                        $value   = $this->Admin_model->getDataResultArray('attribute_value','status=1 and attribute_id="'.$attr['attribute_id'].'"','attribute_value_id');
                        if($value){
                            $attr['attribute_value']=$value;
                            array_push($attributeArr,$attr);
                        }
                    }
                }
 
                $specification_mapping = $this->db->select("attribute_mapping.*,a.name,a.name_ar")
                                     ->where("attribute_mapping.category_id",$_POST['category_id'])
                                     ->where("attribute_mapping.sub_category_id",$_POST['sub_category_id'])
                                     ->where("attribute_mapping.type",2)
                                     ->where("a.status",1)
                                     ->join("attribute as a", "a.attribute_id=attribute_mapping.attribute_id")
                                     ->get("attribute_mapping")->result_array();
                if($specification_mapping){
                    foreach($specification_mapping as $attr){
                        $value   = $this->Admin_model->getDataResultArray('attribute_value','status=1 and attribute_id="'.$attr['attribute_id'].'"','attribute_value_id');
                        if($value){
                            $attr['attribute_value']=$value;
                            array_push($specificationArr,$attr);
                        }
                    }
                }
                 
                 // $data = array('mappedArr'=>$mappedArr,'modelArr'=>$modelArr,'attribute_mapping'=>$attributeArr,'specification_mapping'=>$specificationArr);
                 // echo '<pre/>';print_r($specificationArr);exit;
 
                 ///////////////////////////////////////////////////////////////////////
                $brands='';
                $models='';
                $inventory_id='';
                
 
                $objPHPExcel = new PHPExcel();
                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('A1', "SELECT Inventory") ;
                
                $inventory = array (
                    array('id'=>1,'name'=>'Inventory'),
                    array('id'=>2,'name'=>'International'),
                );
                // print_r($inventory);exit;
                if($inventory){
                    foreach($inventory as $key=>$list){
                        $listVals=(preg_replace('/[^a-zA-Z0-9_.]/', '-', $list['name']));
                        if($key==0){
                            // $brands=$list['name'].$list['category_id'];
                            $inventory_id=$listVals.'-'.$list['id'];
                        }else{
                            // $brands=$brands.','.$list['name'].$list['category_id'];
                            $inventory_id=$inventory_id.','.$listVals.'-'.$list['id'];
                        }
                    }
                }
 
                // $configs = "DUS800, DUG900+3xRRUS, DUW2100, 2xMU, SIU, DUS800+3xRRUS, DUG900+3xRRUS, DUW2100";
                // echo $configs;exit;
                for($i=2;$i<=501;$i++){
                    $objValidation = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getDataValidation();
                    $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                    $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                    $objValidation->setAllowBlank(false);
                    $objValidation->setShowInputMessage(true);
                    $objValidation->setShowErrorMessage(true);
                    $objValidation->setShowDropDown(true);
                    $objValidation->setErrorTitle('Input error');
                    $objValidation->setError('Value is not in list.');
                    $objValidation->setPromptTitle('Pick from list');
                    $objValidation->setPrompt('Please pick a value from the drop-down list.');
                    $objValidation->setFormula1('"'.$inventory_id.'"');
                    $objPHPExcel->setActiveSheetIndex(0);
                }

                $propsType = array (
                    array('id'=>0,'name'=>'Main Product'),
                    array('id'=>1,'name'=>'Product Abbreviation'),
                );
                $propsTypeId="";
                if($propsType){
                    foreach($propsType as $key=>$list){
                        $listVals=(preg_replace('/[^a-zA-Z0-9_.]/', '-', $list['name']));
                        if($key==0){
                            // $propsTypeId=$list;
                            $propsTypeId=$listVals.'-'.$list['id'];
                        }else{
                            // $propsTypeId=$propsTypeId.','.$list;
                            $propsTypeId=$propsTypeId.','.$listVals.'-'.$list['id'];
                        }
                    }
                }
                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('B1', "SELECT Type") ;
                for($i=2;$i<=501;$i++){
                    $objValidation = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getDataValidation();
                    $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                    $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                    $objValidation->setAllowBlank(false);
                    $objValidation->setShowInputMessage(true);
                    $objValidation->setShowErrorMessage(true);
                    $objValidation->setShowDropDown(true);
                    $objValidation->setErrorTitle('Input error');
                    $objValidation->setError('Value is not in list.');
                    $objValidation->setPromptTitle('Pick from list');
                    $objValidation->setPrompt('Please pick a value from the drop-down list.');
                    $objValidation->setFormula1('"'.$propsTypeId.'"');
                    $objPHPExcel->setActiveSheetIndex(0);
                }
                $hubName="";
                $hub   = $this->Admin_model->getDataResultArray('hubs','status=1','id');
                if($hub){
                    foreach($hub as $key=>$list){
                        $listVals=(preg_replace('/[^a-zA-Z0-9_.]/', '-', $list['name']));
                        if($key==0){
                            // $brands=$list['name'].$list['category_id'];
                            // $brands=$listVals.'-'.$list['brand_id'];
                            $hubName=$list['id'];
                        }else{
                            // $brands=$brands.','.$list['name'].$list['category_id'];
                            $hubName=$hubName.','.$list['id'];
                        }
                    }
                }
                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('C1', "SELECT Hub") ;
                for($i=2;$i<=501;$i++){
                    $objValidation = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getDataValidation();
                    $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                    $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                    $objValidation->setAllowBlank(false);
                    $objValidation->setShowInputMessage(true);
                    $objValidation->setShowErrorMessage(true);
                    $objValidation->setShowDropDown(true);
                    $objValidation->setErrorTitle('Input error');
                    $objValidation->setError('Value is not in list.');
                    $objValidation->setPromptTitle('Pick from list');
                    $objValidation->setPrompt('Please pick a value from the drop-down list.');
                    $objValidation->setFormula1('"'.$hubName.'"');
                    $objPHPExcel->setActiveSheetIndex(0);
                }

                if($mappedArr){
                    foreach($mappedArr as $key=>$list){
                        $listVals=(preg_replace('/[^a-zA-Z0-9_.]/', '-', $list['name']));
                        if($key==0){
                            // $brands=$list['name'].$list['category_id'];
                            // $brands=$listVals.'-'.$list['brand_id'];
                            $brands=$list['brand_id'];
                        }else{
                            // $brands=$brands.','.$list['name'].$list['category_id'];
                            $brands=$brands.','.$list['brand_id'];
                        }
                    }
                }

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('D1', "SELECT Brand") ;
                for($i=2;$i<=501;$i++){
                    $objValidation = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getDataValidation();
                    $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                    $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                    $objValidation->setAllowBlank(false);
                    $objValidation->setShowInputMessage(true);
                    $objValidation->setShowErrorMessage(true);
                    $objValidation->setShowDropDown(true);
                    $objValidation->setErrorTitle('Input error');
                    $objValidation->setError('Value is not in list.');
                    $objValidation->setPromptTitle('Pick from list');
                    $objValidation->setPrompt('Please pick a value from the drop-down list.');
                    $objValidation->setFormula1('"'.$brands.'"');
                    $objPHPExcel->setActiveSheetIndex(0);
                }

                if($modelArr){
                    foreach($modelArr as $key=>$list){
                        $listVals=(preg_replace('/[^a-zA-Z0-9_.]/', '-', $list['name']));
                        if($key==0){
                            // $models=$listVals.'-'.$list['model_id'];
                            $models=$list['model_id'];
                        }else{
                            // $models=$models.','.$listVals.'-'.$list['model_id'];
                            $models=$models.','.$list['model_id'];
                        }
                    }
                }
                
                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('E1', "SELECT MODEL") ;
                for($i=2;$i<=501;$i++){
                    $objValidation = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getDataValidation();
                    $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                    $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                    $objValidation->setAllowBlank(false);
                    $objValidation->setShowInputMessage(true);
                    $objValidation->setShowErrorMessage(true);
                    $objValidation->setShowDropDown(true);
                    $objValidation->setErrorTitle('Input error');
                    $objValidation->setError('Value is not in list.');
                    $objValidation->setPromptTitle('Pick from list');
                    $objValidation->setPrompt('Please pick a value from the drop-down list.');
                    $objValidation->setFormula1('"'.$models.'"');
                    $objPHPExcel->setActiveSheetIndex(0);
                }


                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('F1', "No Of Stock") ;

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('G1', "SKU") ;

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('H1', "Product Name(En)") ;

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('I1', "Product Name(Ar)") ;

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('J1', "Product Price") ;

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('K1', "Product Discount (%)") ;

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('L1', "Product Description(En)") ;

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('M1', "Product Description(Ar)") ;

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('N1', "Image-1") ;

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('O1', "Image-2") ;

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('P1', "Image-3") ;

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('Q1', "Image-4") ;

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('R1', "Terms&Condition") ;

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('S1', "Terms&Condition(Ar)") ;

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('T1', "Return Duration(In Day)") ;
                
                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('U1', "Return Policy") ;

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('V1', "Return Policy(Ar)") ;

                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()
                ->setCellValue('W1', "Expected Delivery(In Days)") ;

                $initialArray=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W');
                $protectCoulmn='W';
                $specificationCoulmnList=array('X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV');
                $specificationCoulmnListArr=array();
                $attrCount=0;
                if($attributeArr){
                    foreach($attributeArr as $key=>$attr){
                        unset($specificationCoulmnList[$key]);
                        $attrCount++;
                        //echo '<pre/>';print_r($attr['attribute_value']);exit;
                        if($key==0){
                            array_push($initialArray,'X');
                            $protectCoulmn='X';
                            $namse="";
                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('X1', "SELECT ".$attr['name'].'-'.'100'.'-'.$attr['attribute_id']) ;

                            if(isset($attr['attribute_value']) and $attr['attribute_value']){
                                foreach($attr['attribute_value'] as $index=>$list){
                                    $listVals=(preg_replace('/[^a-zA-Z0-9_.]/', '-', $list['value']));
                                    if($index==0){
                                        // $namse=$listVals.'-'.$list['attribute_value_id'];
                                        $namse=$list['attribute_value_id'];
                                    }else{
                                        // $namse=$namse.','.$listVals.'-'.$list['attribute_value_id'];
                                        $namse=$namse.','.$list['attribute_value_id'];
                                    }
                                }
                            }
                            //echo $namse;exit;

                            for($i=2;$i<=501;$i++){
                                $objValidation = $objPHPExcel->getActiveSheet()->getCell('X'.$i)->getDataValidation();
                                $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                                $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                                $objValidation->setAllowBlank(false);
                                $objValidation->setShowInputMessage(true);
                                $objValidation->setShowErrorMessage(true);
                                $objValidation->setShowDropDown(true);
                                $objValidation->setErrorTitle('Input error');
                                $objValidation->setError('Value is not in list.');
                                $objValidation->setPromptTitle('Pick from list');
                                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                                $objValidation->setFormula1('"'.$namse.'"');
                                $objPHPExcel->setActiveSheetIndex(0);
                            }

                        }if($key==1){
                            array_push($initialArray,'Y');
                            $protectCoulmn='Y';
                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('Y1', "SELECT ".$attr['name'].'-'.'100'.'-'.$attr['attribute_id']) ;

                            if(isset($attr['attribute_value']) and $attr['attribute_value']){
                                foreach($attr['attribute_value'] as $index=>$list){
                                    $listVals=(preg_replace('/[^a-zA-Z0-9_.]/', '-', $list['value']));
                                    if($index==0){
                                        // $namse=$listVals.'-'.$list['attribute_value_id'];
                                        $namse=$list['attribute_value_id'];
                                    }else{
                                        // $namse=$namse.','.$listVals.'-'.$list['attribute_value_id'];
                                        $namse=$namse.','.$list['attribute_value_id'];
                                    }
                                }
                            }
                            //echo $namse;exit;

                            for($i=2;$i<=501;$i++){
                                $objValidation = $objPHPExcel->getActiveSheet()->getCell('Y'.$i)->getDataValidation();
                                $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                                $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                                $objValidation->setAllowBlank(false);
                                $objValidation->setShowInputMessage(true);
                                $objValidation->setShowErrorMessage(true);
                                $objValidation->setShowDropDown(true);
                                $objValidation->setErrorTitle('Input error');
                                $objValidation->setError('Value is not in list.');
                                $objValidation->setPromptTitle('Pick from list');
                                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                                $objValidation->setFormula1('"'.$namse.'"');
                                $objPHPExcel->setActiveSheetIndex(0);
                            }

                        }if($key==2){
                            array_push($initialArray,'Z');
                            $protectCoulmn='Z';
                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('Z1', "SELECT ".$attr['name'].'-'.'100'.'-'.$attr['attribute_id']) ;

                            if(isset($attr['attribute_value']) and $attr['attribute_value']){
                                foreach($attr['attribute_value'] as $index=>$list){
                                    $listVals=(preg_replace('/[^a-zA-Z0-9_.]/', '-', $list['value']));
                                    if($index==0){
                                        // $namse=$listVals.'-'.$list['attribute_value_id'];
                                        $namse=$list['attribute_value_id'];
                                    }else{
                                        // $namse=$namse.','.$listVals.'-'.$list['attribute_value_id'];
                                        $namse=$namse.','.$list['attribute_value_id'];
                                    }
                                }
                            }
                            //echo $namse;exit;

                            for($i=2;$i<=501;$i++){
                                $objValidation = $objPHPExcel->getActiveSheet()->getCell('Z'.$i)->getDataValidation();
                                $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                                $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                                $objValidation->setAllowBlank(false);
                                $objValidation->setShowInputMessage(true);
                                $objValidation->setShowErrorMessage(true);
                                $objValidation->setShowDropDown(true);
                                $objValidation->setErrorTitle('Input error');
                                $objValidation->setError('Value is not in list.');
                                $objValidation->setPromptTitle('Pick from list');
                                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                                $objValidation->setFormula1('"'.$namse.'"');
                                $objPHPExcel->setActiveSheetIndex(0);
                            }

                        }
                    }
                }
                if($specificationCoulmnList){
                    foreach($specificationCoulmnList as $list){
                        array_push($specificationCoulmnListArr,$list);
                        array_push($initialArray,$list);
                    }
                }
                //echo '<pre/>';print_r($initialArray);exit;
                // echo $specificationCoulmnList[0];exit;
                if($specificationArr){
                    foreach($specificationArr as $key=>$attr){
                        $clmn=$specificationCoulmnListArr[$key];
                        $protectCoulmn=$clmn;
                        $objPHPExcel->setActiveSheetIndex(0);
                        $objPHPExcel->getActiveSheet()
                        ->setCellValue($clmn.'1', "SELECT ".$attr['name'].'-'.'101'.'-'.$attr['attribute_id']) ;

                        if(isset($attr['attribute_value']) and $attr['attribute_value']){
                            foreach($attr['attribute_value'] as $index=>$list){
                                $listVals=(preg_replace('/[^a-zA-Z0-9_.]/', '-', $list['value']));
                                if($index==0){
                                    // $namse=$listVals.'-'.$list['attribute_value_id'];
                                    $namse=$list['attribute_value_id'];
                                }else{
                                    // $namse=$namse.','.$listVals.'-'.$list['attribute_value_id'];
                                    $namse=$namse.','.$list['attribute_value_id'];
                                }
                            }
                        }

                        for($i=2;$i<=501;$i++){
                            $objValidation = $objPHPExcel->getActiveSheet()->getCell($clmn.$i)->getDataValidation();
                            $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
                            $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                            $objValidation->setAllowBlank(false);
                            $objValidation->setShowInputMessage(true);
                            $objValidation->setShowErrorMessage(true);
                            $objValidation->setShowDropDown(true);
                            $objValidation->setErrorTitle('Input error');
                            $objValidation->setError('Value is not in list.');
                            $objValidation->setPromptTitle('Pick from list');
                            $objValidation->setPrompt('Please pick a value from the drop-down list.');
                            $objValidation->setFormula1('"'.$namse.'"');
                            $objPHPExcel->setActiveSheetIndex(0);
                        }
                    }
                }

                
                ///////////////////PROTECTION////////////////////////////////////////////
                // $sheet = $objPHPExcel->getActiveSheet();
                // $sheet->getProtection()->setSheet(true);
                // $sheet->getStyle('A0')->getProtection()
                // ->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

                $sheet = $objPHPExcel->getActiveSheet();
                $sheet->getProtection()->setSheet(true);
                $sheet->getStyle('A2:'.$protectCoulmn.'501')->getProtection()
                // $sheet->getStyle('A2:Z501')->getProtection()
                ->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

                if($initialArray){
                    foreach($initialArray as $listed){
                        $objPHPExcel->getActiveSheet()->getColumnDimension($listed)->setWidth(25);
                    }
                }
                for($i=1;$i<=501;$i++){
                    $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(50);
                }
                
                $product_category   = $this->Admin_model->getDataResultRow('product_category','category_id="'.$_POST['category_id'].'" ','');
                $product_sub_category   = $this->Admin_model->getDataResultRow('product_sub_category','sub_category_id="'.$_POST['sub_category_id'].'" ','');
                $files_name=$product_category['name'].'_'.$product_sub_category['name'];
                
                ///////////////////PROTECTION////////////////////////////////////////////
                // echo '<pre/>';print_r($specificationCoulmnList);exit;


                $sheet = $objPHPExcel->getActiveSheet();
                $objWorkSheet = $objPHPExcel->createSheet(1);
                // echo '<pre/>';print_r($hub);exit;
                $objWorkSheet->setCellValue('A1', 'Hubs');
                if($hub){
                    foreach($hub as $key=>$list){
                        $keyData=$key+2;
                        $objWorkSheet->setCellValue('A'.$keyData, $list['id']);
                        $objWorkSheet->setCellValue('B'.$keyData, $list['name']);
                    }
                }

                $objWorkSheet->setCellValue('D1', 'Brands');
                if($mappedArr){
                    foreach($mappedArr as $key=>$list){
                        $keyData=$key+2;
                        $objWorkSheet->setCellValue('D'.$keyData, $list['brand_id']);
                        $objWorkSheet->setCellValue('E'.$keyData, $list['name']);
                    }
                }

                $objWorkSheet->setCellValue('G1', 'Models');
                if($modelArr){
                    foreach($modelArr as $key=>$list){
                        $keyData=$key+2;
                        $objWorkSheet->setCellValue('G'.$keyData, $list['model_id']);
                        $objWorkSheet->setCellValue('H'.$keyData, $list['name']);
                    }
                }
 
 
                $attrCount=3;
                $objWorkSheet->setCellValue('J1', 'Attribute');
                if($attributeArr){
                    foreach($attributeArr as $key=>$attr){
                        if($key==0){
                            $objWorkSheet->setCellValue('J'.$attrCount, $attr['name']);
                        }else{
                            $attrCount=$attrCount+2;
                            $objWorkSheet->setCellValue('J'.$attrCount, $attr['name']);
                        }
                        
                        // $objWorkSheet->setCellValue('I'.$keyData, $list['value']);
                        // echo '<pre/>';print_r($attr['attribute_value']);exit;
                        if(isset($attr['attribute_value']) and $attr['attribute_value']){
                            foreach($attr['attribute_value'] as $index=>$list){
                                $attrCount++;
                                $objWorkSheet->setCellValue('K'.$attrCount, $list['attribute_value_id']);
                                $objWorkSheet->setCellValue('L'.$attrCount, $list['value']);
                            }
                        }

                        
                    }
                }
                // $objWorkSheet->setCellValue('F1', 'Attributes');
                // if($attributeArr){
                //     foreach($attributeArr as $key=>$attr){
                //         $keyData=$key+2;
                //         $objWorkSheet->setCellValue('F'.$keyData, $list['attribute_value_id']);
                //         $objWorkSheet->setCellValue('G'.$keyData, $list['value']);
                //     }
                // }

                

                $specifyCount=3;
                $objWorkSheet->setCellValue('N1', 'Specification');
                if($specificationArr){
                    foreach($specificationArr as $key=>$attr){
                        if($key==0){
                            $objWorkSheet->setCellValue('N'.$specifyCount, $attr['name']);
                        }else{
                            $specifyCount=$specifyCount+2;
                            $objWorkSheet->setCellValue('N'.$specifyCount, $attr['name']);
                        }
                        
                        // $objWorkSheet->setCellValue('I'.$keyData, $list['value']);
                        // echo '<pre/>';print_r($attr['attribute_value']);exit;
                        if(isset($attr['attribute_value']) and $attr['attribute_value']){
                            foreach($attr['attribute_value'] as $index=>$list){
                                $specifyCount++;
                                $objWorkSheet->setCellValue('O'.$specifyCount, $list['attribute_value_id']);
                                $objWorkSheet->setCellValue('P'.$specifyCount, $list['value']);
                            }
                        }

                        
                    }
                }

                $objWorkSheet->setTitle("Summery");
            
                //////////////////////////////////////////////
                $callStartTime = microtime(true);

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('assets/bulk/creater/'.$files_name.'.xls');

                $data = array('mappedArr'=>$mappedArr,'modelArr'=>$modelArr,'attribute_mapping'=>$attributeArr,'specification_mapping'=>$specificationArr);
                //echo '<pre/>';print_r($data);exit;
                echo $files_name;exit;
            }
        }
    }

    public function export_multiple() {
        if (isset($_POST['method'])) {
            if($_POST['method']=='exportMultiple'){
                $category=$_POST['category'];
                $sub_category=$_POST['sub_category'];
                $products = $this->db->select("products.*,pag.item_id,pag.attribute_group_id,pag.item_no,pag.quantity,pag.discount,pag.price,pag.images,pc.name as category_name,psc.name as sub_category_name")
                            ->where("products.status!=", 99)
                            ->where("products.category_id", $category)
                            ->where("products.sub_category_id", $sub_category)
                            ->where("products.vendor_id", 0)
                            ->where("products.status!=", 99)
                            ->join("product_attribute_group as pag", "pag.product_id=products.product_id")
                            ->join("product_category as pc", "pc.category_id=products.category_id")
                            ->join("product_sub_category as psc", "psc.sub_category_id=products.sub_category_id")
                            ->order_by("products.product_id")
                            ->get("products")->result_array();
                //echo $this->db->last_query();exit;
                // echo '<pre/>';print_r($products);exit;
                if($products){
                    $objPHPExcel = new PHPExcel();
                    
                    $protuctionCount=1;
                    $brands='';
                    $models='';
                    $inventory_id='';
                    $inventory = array (
                        array('id'=>1,'name'=>'Inventory'),
                        array('id'=>2,'name'=>'International'),
                    );
                    

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('A1', "Product-Id") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('B1', "Item-Id") ;


                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('C1', "SELECT Types") ;
                    if($inventory){
                        foreach($inventory as $key=>$list){
                            $listVals=(preg_replace('/[^a-zA-Z0-9_.]/', '-', $list['name']));
                            if($key==0){
                                $inventory_id=$listVals.'-'.$list['id'];
                            }else{
                                $inventory_id=$inventory_id.','.$listVals.'-'.$list['id'];
                            }
                        }
                    }
                    
                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('D1', "Brand") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('E1', "Model") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('F1', "No Of Stock") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('G1', "SKU") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('H1', "Product Name(En)") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('I1', "Product Name(Ar)") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('J1', "Product Price") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('K1', "Product Discount (%)") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('L1', "Product Description(En)") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('M1', "Product Description(Ar)") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('N1', "Image-1") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('O1', "Image-2") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('P1', "Image-3") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('Q1', "Image-4") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('R1', "Terms&Condition") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('S1', "Terms&Condition(Ar)") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('T1', "Return Duration(In Day)") ;
                    
                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('U1', "Return Policy") ;

                    $objPHPExcel->setActiveSheetIndex(0);
                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('V1', "Return Policy(Ar)") ;

                    if($products){
                        foreach($products as $indx=>$list){
                            $indx=$indx+2;
                            $protuctionCount++;

                            $imagesArr = array();
                            $list['images'] = trim($list['images'], ',');
                            if ($list['images']) {
                                $expImgs = explode(',', $list['images']);
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
                            $list['imagesArr'] = $imagesArr;
                            // echo '<pre/>';print_r($imagesArr);exit;
                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('A'.$indx, $list['product_id']) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('B'.$indx, $list['item_id']) ;

                            ///////////////////////////////////////////////////
                            if(['product_from']==1){
                                $product_from="Inventory";
                            }else{
                                $product_from="International";
                            }
                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('C'.$indx, $product_from) ;
                            
                            ///////////////////////////////////////////////////
                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('D'.$indx, $list['brand_id']) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('E'.$indx, $list['model_id']) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('F'.$indx, $list['quantity']) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('G'.$indx, $list['item_no']) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('H'.$indx, $list['name']) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('I'.$indx, $list['name_ar']) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('J'.$indx, $list['price']) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('K'.$indx, $list['discount']) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('L'.$indx, $list['description']) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('M'.$indx, $list['description_ar']) ;
                            //print_r($imagesArr[0]['image']);exit;
                            if(isset($imagesArr[0]['image']) and $imagesArr[0]['image']){
                                $imgs1=$imagesArr[0]['image'];
                            }else{
                                $imgs1='';
                            } 
                            if(isset($imagesArr[1]['image']) and $imagesArr[1]['image']){
                                $imgs2=$imagesArr[1]['image'];
                            }else{
                                $imgs2='';
                            } 
                            if(isset($imagesArr[2]['image']) and $imagesArr[2]['image']){
                                $imgs3=$imagesArr[2]['image'];
                            }else{
                                $imgs3='';
                            } 
                            if(isset($imagesArr[3]['image']) and $imagesArr[3]['image']){
                                $imgs4=$imagesArr[3]['image'];
                            }else{
                                $imgs4='';
                            } 
                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('N'.$indx, $imgs1) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('O'.$indx, $imgs2) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('P'.$indx, $imgs3) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('Q'.$indx, $imgs4) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('R'.$indx, $list['terms']) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('S'.$indx, $list['terms_ar']) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('T'.$indx, $list['duration']) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('U'.$indx, $list['return_policy']) ;

                            $objPHPExcel->setActiveSheetIndex(0);
                            $objPHPExcel->getActiveSheet()
                            ->setCellValue('V'.$indx, $list['return_policy_ar']) ;
                        }
                    }
                    ///////////////////////////////////////////////////////////////////////
                    

                    ///////////////////PROTECTION////////////////////////////////////////////
                    // $sheet = $objPHPExcel->getActiveSheet();
                    // $sheet->getProtection()->setSheet(true);
                    // $sheet->getStyle('A0')->getProtection()
                    // ->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

                    $sheet = $objPHPExcel->getActiveSheet();
                    $sheet->getProtection()->setSheet(true);
                    // $sheet->getStyle('A0:'.$protectCoulmn.'0')->getProtection()
                    // $sheet->getStyle('A2:'.$protectCoulmn.$protuctionCount)->getProtection()
                    $sheet->getStyle('A2:'.'U'.$protuctionCount)->getProtection()
                    ->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
                    $initialArray=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
                    if($initialArray){
                        foreach($initialArray as $listed){
                            $objPHPExcel->getActiveSheet()->getColumnDimension($listed)->setWidth(30);
                        }
                    }
                    for($i=1;$i<=501;$i++){
                        $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(50);
                    }
                    
                    // $product_category   = $this->Admin_model->getDataResultRow('product_category','category_id="'.$_POST['category_id'].'" ','');
                    // $product_sub_category   = $this->Admin_model->getDataResultRow('product_sub_category','sub_category_id="'.$_POST['sub_category_id'].'" ','');
                    $files_name="admin_update_excel";
                    $files_name=strtotime(date('Y-m-d H:i:s')).rand(1000,9999);
                    
                    ///////////////////PROTECTION////////////////////////////////////////////
                    // echo '<pre/>';print_r($specificationCoulmnList);exit;


                    $sheet = $objPHPExcel->getActiveSheet();
                    $objWorkSheet = $objPHPExcel->createSheet(1);

                    
                    $objWorkSheet->setTitle("Summery");



                    //////////////////////////////////////////////
                    $callStartTime = microtime(true);

                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                    $objWriter->save('assets/bulk/creater/update/'.$files_name.'.xls');

                    // $data = array('mappedArr'=>$mappedArr,'modelArr'=>$modelArr,'attribute_mapping'=>$attributeArr,'specification_mapping'=>$specificationArr);
                    //echo '<pre/>';print_r($data);exit;
                    echo $files_name;exit;
                }else{
                    echo "error";exit;
                }
            }
            if($_POST['method']=='unlink'){
                $data=$_POST['data'];
                unlink('assets/bulk/creater/update/'.$data.'.xls');
            }
        }
    }


    public function bulk_upload_product() {
       
        if (isset($_POST['bulk_upload'])) {
            if (isset($_FILES["products"]["name"])) {
                $path = $_FILES["products"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // echo '<pre/>';print_r($object->getWorksheetIterator());exit;
                if($object->getWorksheetIterator()){
                    foreach ($object->getWorksheetIterator() as $worksheet) {
                        $highestRow = $worksheet->getHighestRow();
                        $highestColumn = $worksheet->getHighestColumn();
                        // echo '<pre/>';print_r($worksheet->getCellByColumnAndRow(0,0));exit;
                        //echo $highestRow;exit;
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $get_brand_id=0;
                            $get_model_id=0;
                            $model_mapped=strtotime(date('Y-m-d H:i:s'));
                            
                            $product_from=0;
                            $product_fromDta = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            if($product_fromDta){
                                $product_fromDtaExp=explode('-',$product_fromDta);
                                if($product_fromDtaExp){
                                    $product_fromDtaExpCount=count($product_fromDtaExp);
                                    $product_from=$product_fromDtaExp[$product_fromDtaExpCount-1];
                                }
                            }

                            $brand_id=0;
                            $brandDta = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                            if($brandDta){
                                $brandExp=explode('-',$brandDta);
                                if($brandExp){
                                    $brand_idCount=count($brandExp);
                                    $brand_id=$brandExp[$brand_idCount-1];
                                }
                            }
                            
                            $model_id = 0;
                            $modelDta = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                            if($modelDta){
                                $modelExp=explode('-',$modelDta);
                                if($modelExp){
                                    $modelExpCount=count($modelExp);
                                    $model_id=$modelExp[$modelExpCount-1];
                                }
                            }
                            
                            $stock = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                            if(!$stock){
                                $stock=0;
                            }
                            $skuId = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                            if(!$skuId){
                                $skuId="";
                            }
                            $name = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                            $name_ar = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                            $price = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                            $discount = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                            if(!$discount){
                                $discount=0;
                            }
                            $desc = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                            if(!$desc){
                                $desc="";
                            }
                            $desc_ar = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                            if(!$desc_ar){
                                $desc_ar="";
                            }
                            $image1 = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                            if(!$image1){
                                $image1="";
                            }
                            $image2 = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                            if(!$image2){
                                $image2="";
                            }
                            $image3 = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                            if(!$image3){
                                $image3="";
                            }
                            $image4 = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                            if(!$image4){
                                $image4="";
                            }
                            $terms = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                            if(!$terms){
                                $terms="";
                            }
                            $terms_ar = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                            if(!$terms_ar){
                                $terms_ar="";
                            }
                            $duration = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                            if(!$duration){
                                $duration="0";
                            }
                            $return_policy = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                            if(!$return_policy){
                                $return_policy="";
                            }
                            $return_policy_ar = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                            if(!$return_policy_ar){
                                $return_policy_ar="";
                            }
                            
                            if(isset($model_id) and $model_id){
                                $productsChecker   = $this->Admin_model->getDataResultRow('products','model_id="'.$model_id.'" and status="1"');
                                if($productsChecker){
                                    $model_mapped=$productsChecker['model_mapped'];
                                }
                            }
                            // echo $model_id;exit;
                            // if(isset($brand_id) and $brand_id){
                            //     $brand   = $this->Admin_model->getDataResultRow('brand','name="'.$brand_id.'"');
                            //     if($brand){
                            //         $get_brand_id=$brand['brand_id'];
                            //     }
                            // }
                            // if(isset($model_id) and $model_id){
                            //     $model   = $this->Admin_model->getDataResultRow('model','name="'.$model_id.'"');
                            //     if($model){
                            //         $get_model_id=$model['model_id'];
                            //     }
                            // }
                            if($name and $name_ar and $price and $stock ){
                                if($duration){
                                    $is_returnable=1;
                                }else{
                                    $is_returnable=0;
                                }
                                $product=array(
                                    'category_id'           => $_POST['category_id'],
                                    'sub_category_id'       => $_POST['sub_category_id'],
                                    'product_from'          => $product_from,
                                    'brand_id'              => $brand_id,
                                    'model_id'              => $model_id,
                                    'model_mapped'          => $model_mapped,
                                    'primary_attribute'     => 1,
                                    'discount'              => $discount,
                                    'name'                  => (str_replace("'", "", $name)),
                                    'name_ar'               => (str_replace("'", "", $name_ar)),
                                    'description_short'     => (str_replace("'", "", $desc)),
                                    'description_short_ar'  => (str_replace("'", "", $desc_ar)),
                                    'description'           => (str_replace("'", "", $desc)),
                                    'description_ar'        => (str_replace("'", "", $desc_ar)),
                                    'terms'                 => (str_replace("'", "", $terms)),
                                    'terms_ar'              => (str_replace("'", "", $terms_ar)),
                                    'is_returnable'         => $is_returnable,
                                    'duration'              => $duration,
                                    'return_policy'         => (str_replace("'", "", $return_policy)),
                                    'return_policy_ar'      => (str_replace("'", "", $return_policy_ar)),
                                    'created_at'            => strtotime(date('Y-m-d H:i:s')),
                                    'updated_at'            => strtotime(date('Y-m-d H:i:s')),
                                    'status'                => 1
                                );
                                echo '<pre/>';print_r($product);exit;
                                $product=$this->Admin_model->addData('products',$product);
                                // $product=true;
                                if($product){
                                    $group_id=rand(1000,9999);
                                    $insertSr=0;
                                    for($i=20;$i<=45;$i++){
                                        $insertSr++;
                                        $attribute1 = $worksheet->getCellByColumnAndRow($i, 1)->getValue();
                                        

                                        $attr_attribute_id = 0;
                                        $attrVals = $worksheet->getCellByColumnAndRow($i, $row)->getValue();
                                        if($attrVals){
                                            $attrValsExp=explode('-',$attrVals);
                                            if($attrValsExp){
                                                $attrValsExpCount=count($attrValsExp);
                                                $attr_attribute_id=$attrValsExp[$attrValsExpCount-1];
                                            }
                                        }


                                        $attributeValue1 = $worksheet->getCellByColumnAndRow($i, $row)->getValue();
                                        //echo $attribute1;exit;
                                        if($attribute1){
                                            $attribute1=explode('-',$attribute1);
                                            $attribute1Count=count($attribute1);
                                            $attributeId=$attribute1[$attribute1Count-1];
                                            $attributeType=$attribute1[$attribute1Count-2];

                                            // $attribute_value_data   = $this->Admin_model->getDataResultRow('attribute_value','attribute_id="'.$attributeId.'" and value="'.$attributeValue1.'" and status="1"');
                                            // echo $this->db->last_query().' / ';
                                            // print_r($attribute_value_data);exit;
                                                
                                            //echo $attributeType;
                                            if($attributeType==100){
                                                $checkDtaAttr   = $this->Admin_model->getDataResultRow('attribute_mapping','category_id="'.$_POST['category_id'].'" and sub_category_id="'.$_POST['sub_category_id'].'" and attribute_id="'.$attributeId.'"');
                                                //echo $this->db->last_query();exit;
                                                $isPrimary=$checkDtaAttr['is_primary'];
            
                                                if($isPrimary==1){
                                                    $getGroupData1    = $this->Admin_model->getDataResultRow('product_attribute','product_id="'.$product.'" and attribute_value_id="'.$attr_attribute_id.'" and is_primary=1');
                                                    if($getGroupData1){
                                                        $parentId=0;
                                                        $isNew=0;
                                                        $subParentId=0;
                                                    }else{
                                                        $parentId=0;
                                                        $isNew=1;
                                                        $subParentId=0;
                                                    }
                                                }elseif($isPrimary==2){
                                                    $getGroupData1    = $this->Admin_model->getDataResultRow('product_attribute','product_id="'.$product.'" and group_id="'.$group_id.'" and is_primary=1');
                                                    if($getGroupData1['is_new']==1){
                                                        $parentId=$getGroupData1['product_attribute_id'];
                                                        $isNew=1;
                                                        $subParentId=0;
                                                    }else{
                                                        $getGroupData2    = $this->Admin_model->getDataResultRow('product_attribute','product_id="'.$product.'" and attribute_value_id="'.$getGroupData1['attribute_value_id'].'" and is_primary=1 and is_new=1'); 
                                                        $parentId=$getGroupData2['product_attribute_id'];
                                                        $subParentId=0;
                                                        $isNew=0;
                                                    }
                                                }elseif($isPrimary==3){
                                                    $getGroupData1    = $this->Admin_model->getDataResultRow('product_attribute','product_id="'.$product.'" and group_id="'.$group_id.'" and is_primary=2');
                                                    //print_r($getGroupData1);exit;
                                                    if($getGroupData1['is_new']==1){
                                                        $subParentId=$getGroupData1['product_attribute_id'];
                                                        $parentId=$getGroupData1['parent_id'];
                                                        $isNew=1;
                                                    }else{
                                                        $getGroupData2    = $this->Admin_model->getDataResultRow('product_attribute','product_id="'.$product.'" and attribute_value_id="'.$getGroupData1['attribute_value_id'].'" and is_primary=1'); 
                                                        $getGroupData3    = $this->Admin_model->getDataResultRow('product_attribute','product_id="'.$product.'" and group_id="'.$getGroupData2['group_id'].'" and is_primary=2'); 
                                                        $subParentId=$getGroupData3['product_attribute_id'];
                                                        $parentId=$getGroupData3['parent_id'];
                                                        $isNew=0;
                                                    }
                                                }
            
                                                $attrData=array(
                                                    'parent_id'  => $parentId,
                                                    'sub_parent_id'  => $subParentId,
                                                    'is_new'  => $isNew,
                                                    'group_id'  => $group_id,
                                                    'product_id'=> $product,
                                                    'category_id'  => $_POST['category_id'],
                                                    'sub_category_id'  => $_POST['sub_category_id'],
                                                    'is_primary'  => $insertSr,
                                                    'attribute_id'  => $attributeId,
                                                    'attribute_value_id'  => $attr_attribute_id,
                                                );
                                                $attr=$this->Admin_model->addData('product_attribute',$attrData);
                                            }else{
                                                // print_r($attribute_value_data);
                                                $specfyData=array(
                                                    'product_id'=> $product,
                                                    'category_id'  => $_POST['category_id'],
                                                    'sub_category_id'  => $_POST['sub_category_id'],
                                                    'attribute_id'  => $attributeId,
                                                    'attribute_value_id'  => $attr_attribute_id,
                                                );
                                                $attr=$this->Admin_model->addData('product_specification',$specfyData);
                                            }
                                        }
                                    }
                                    $imagesAr=array();
                                    if($image1){
                                        $insertArr = [
                                            'file_path' => $image1
                                        ];
                                        $return = $this->Admin_model->addData('product_images', $insertArr);
                                        $returnId = $this->db->insert_id();
                                        if ($returnId) {
                                            array_push($imagesAr, $returnId);
                                        }
                                    }if($image2){
                                        $insertArr = [
                                            'file_path' => $image2
                                        ];
                                        $return = $this->Admin_model->addData('product_images', $insertArr);
                                        $returnId = $this->db->insert_id();
                                        if ($returnId) {
                                            array_push($imagesAr, $returnId);
                                        }
                                    }if($image3){
                                        $insertArr = [
                                            'file_path' => $image3
                                        ];
                                        $return = $this->Admin_model->addData('product_images', $insertArr);
                                        $returnId = $this->db->insert_id();
                                        if ($returnId) {
                                            array_push($imagesAr, $returnId);
                                        }
                                    }if($image4){
                                        $insertArr = [
                                            'file_path' => $image4
                                        ];
                                        $return = $this->Admin_model->addData('product_images', $insertArr);
                                        $returnId = $this->db->insert_id();
                                        if ($returnId) {
                                            array_push($imagesAr, $returnId);
                                        }
                                    }
                                    $uploadImages = trim(implode(',', $imagesAr), ',');
                                    $attrData=array(
                                        'group_id'  => 0,
                                        'attribute_group_id'  => $group_id,
                                        'product_id'=> $product,
                                        'category_id'  => $_POST['category_id'],
                                        'sub_category_id'  => $_POST['sub_category_id'],
                                        'item_no'  => $skuId,
                                        'price'  => $price,
                                        'quantity'  => $stock,
                                        'images'  => $uploadImages,
                                    );
                                    $addItems=$this->Admin_model->addData('product_attribute_group',$attrData);
                                    
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

                                }
                            }
                        }
                    }
                }
                //echo '<pre>';print_r($data);exit;
                if ($product) {
                    $htmlData='<div class="modal fade modal-design show" id="productupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" style="display:block;    top: -131px;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="messege-box">
                                                    <img src="http://gropse.com/gropse.com/design/zanomyvendor.com/common/images/uploadproduct.png" alt="success messege">
                                                    <h3>Your Product has been uploaded Successfully</h3>
                                                </div>';
                                                if(isset($_POST['attribute'])){
                                                    $htmlData.='<div class="action-button">
                                                        <p>Do you want to upload more specification</p>
                                                        <a href="'.base_url('admin/add-more-attribute/'.$product).'" class="btn btn-primary mybtns">Yes</a>
                                                        <a href="'.base_url('admin/add-new-product').'" class="btn btn-primary mybtns" data-dismiss="modal">Skip</a>
                                                    </div>';
                                                }else{
                                                    $htmlData.='<div class="action-button">
                                                        <a href="'.base_url('admin/add-new-product').'" class="btn btn-primary mybtns" data-dismiss="modal">Continue</a>
                                                    </div>';
                                                }
                                                $htmlData.='</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                $this->session->set_flashdata('response',$htmlData);
                                redirect('admin/add-new-product');
                } else {
                    redirect('admin/add-new-product');
                }
            }
        }elseif (isset($_POST['bulk_verify'])) {
            
            if (isset($_FILES["products"]["name"])) {
                $productArr=array();
                $productError=0;
                //echo '<pre/>';print_r($_FILES);exit;
                $path = $_FILES["products"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // echo '<pre/>';print_r($object->getWorksheetIterator());exit;
                $checkRowFromExcelError=true;
                if($object->getWorksheetIterator()){
                    foreach ($object->getWorksheetIterator() as $k1=>$worksheet) {
                        if($k1==0){
                            $FilterId=0;
                            $filterType=0;
                            $prevIndex=0;
                            $prevIdRand=0;
                            $parentType=0;
                            $highestRow = $worksheet->getHighestRow();
                            $highestColumn = $worksheet->getHighestColumn();
                            // echo '<pre/>';print_r($worksheet->getCellByColumnAndRow(0,0));exit;
                            //echo $highestRow;exit;
                            for ($row = 2; $row <= $highestRow; $row++) {
                                
                                $get_brand_id=0;
                                $get_model_id=0;
                                $model_mapped=strtotime(date('Y-m-d H:i:s')).rand(1000,9999);
                                
                                $product_from=0;
                                $product_fromDta = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                                if($product_fromDta){
                                    $product_fromDtaExp=explode('-',$product_fromDta);
                                    if($product_fromDtaExp){
                                        $product_fromDtaExpCount=count($product_fromDtaExp);
                                        $product_from=$product_fromDtaExp[$product_fromDtaExpCount-1];
                                    }
                                }
                                if($product_from){
                                    $getTYpeData = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

                                    $hub_error=false;
                                    $hub_id = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                                    if(!$hub_id){
                                        $hub_id=0;
                                        $productError++;
                                        $hub_error=true;
                                        $find_product_row_error=1;
                                    }

                                    $brand_id=0;
                                    $brandDta = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                                    if($brandDta){
                                        $brandExp=explode('-',$brandDta);
                                        if($brandExp){
                                            $brand_idCount=count($brandExp);
                                            $brand_id=$brandExp[$brand_idCount-1];
                                        }
                                    }
                                  
                                    $model_id = 0;
                                    $modelDta = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                                    if($modelDta){
                                        $modelExp=explode('-',$modelDta);
                                        if($modelExp){
                                            $modelExpCount=count($modelExp);
                                            $model_id=$modelExp[$modelExpCount-1];
                                        }
                                    }
                                    $find_product_row_error=0;
                                    $stock_error=false;
                                    $stock = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                                    if(!$stock){
                                        $stock=0;
                                        $productError++;
                                        $stock_error=true;
                                        $find_product_row_error=1;
                                    }else{
                                        if(!is_numeric($stock)){
                                            $productError++;
                                            $stock_error=true;
                                            $find_product_row_error=1;
                                        }
                                    }
    
    
                                    $skuId = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                                    if(!$skuId){
                                        $skuId="";
                                    }
                                    $name_error=false;
                                    $name = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                                    if(!$name){
                                        $name="";
                                        $productError++;
                                        $name_error=true;
                                        $find_product_row_error=1;
                                    }
                                    $name_ar_error=false;
                                    $name_ar = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                                    if(!$name_ar){
                                        $name_ar="";
                                        $productError++;
                                        $name_ar_error=true;
                                        $find_product_row_error=1;
                                    }
                                    $price_error=false;
                                    $price = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                                    if(!$price){
                                        $price="";
                                        $productError++;
                                        $price_error=true;
                                        $find_product_row_error=1;
                                    }else{
                                        if(!is_numeric($price)){
                                            $productError++;
                                            $price_error=true;
                                            $find_product_row_error=1;
                                        }
                                    }
                                    $discount_error=false;
                                    $discount = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                                    if(!$discount){
                                        $discount=0;
                                    }else{
                                        if(!is_numeric($discount)){
                                            $productError++;
                                            $discount_error=true;
                                            $find_product_row_error=1;
                                        }
                                    }
                                    $desc_error=false;
                                    $desc = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                                    if(!$desc){
                                        $desc="";
                                        $productError++;
                                        $desc_error=true;
                                        $find_product_row_error=1;
                                    }
                                    $desc_ar_error=false;
                                    $desc_ar = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                                    if(!$desc_ar){
                                        $desc_ar="";
                                        $productError++;
                                        $desc_ar_error=true;
                                        $find_product_row_error=1;
                                    }
    
                                    $image1_error=false;
                                    $image1 = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                                    if(!$image1){
                                        $image1="";
                                        $productError++;
                                        $image1_error=true;
                                        $find_product_row_error=1;
                                    }
                                    $image2 = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                                    if(!$image2){
                                        $image2="";
                                    }
                                    $image3 = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                                    if(!$image3){
                                        $image3="";
                                    }
                                    $image4 = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                                    if(!$image4){
                                        $image4="";
                                    }
                                    $terms = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                                    if(!$terms){
                                        $terms="";
                                    }
                                    $terms_ar = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                                    if(!$terms_ar){
                                        $terms_ar="";
                                    }
                                    $duration = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                                    if(!$duration){
                                        $duration="0";
                                    }
                                    $return_policy = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                                    if(!$return_policy){
                                        $return_policy="";
                                    }
                                    $return_policy_ar = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                                    if(!$return_policy_ar){
                                        $return_policy_ar="";
                                    }

                                    $expected_delivery_error=false;
                                    $expected_delivery = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                                    if(!$expected_delivery){
                                        $expected_delivery="0";
                                        $productError++;
                                        $expected_delivery_error=true;
                                        $find_product_row_error=1;
                                    }
                                    
                                    if(isset($model_id) and $model_id){
                                        $productsChecker   = $this->Admin_model->getDataResultRow('products','model_id="'.$model_id.'" and status="1"');
                                        if($productsChecker){
                                            $model_mapped=$productsChecker['model_mapped'];
                                        }
                                    }
                                
                                    if($duration){
                                        $is_returnable=1;
                                    }else{
                                        $is_returnable=0;
                                    }
                                    $imagesAr=array();
                                    if($image1){
                                        array_push($imagesAr, $image1);
                                    }if($image2){
                                        array_push($imagesAr, $image2);
                                    }if($image3){
                                        array_push($imagesAr, $image3);
                                    }if($image4){
                                        array_push($imagesAr, $image4);
                                    }
                                    $product_category = $this->Admin_model->getDataResultRow('product_category', 'category_id="' . $_POST['category_id']. '"');
                                    if($product_category){
                                        $category_name=$product_category['name'];
                                    }else{
                                        $category_name='';
                                    }
                                    $product_sub_category = $this->Admin_model->getDataResultRow('product_sub_category', 'sub_category_id="' . $_POST['sub_category_id']. '"');
                                    if($product_sub_category){
                                        $sub_category_name=$product_sub_category['name'];
                                    }else{
                                        $sub_category_name='';
                                    }
                                    $brand_name='';
                                    if($brand_id){
                                        $product_brand = $this->Admin_model->getDataResultRow('brand', 'brand_id="' . $brand_id. '"');
                                        if($product_brand){
                                            $brand_name=$product_brand['name'];
                                        }
                                    }
    
                                    $model_name='';
                                    if($brand_id){
                                        $product_model = $this->Admin_model->getDataResultRow('model', 'model_id="' . $model_id. '"');
                                        if($product_model){
                                            $model_name=$product_model['name'];
                                        }
                                    }

                                    $hub_name='';
                                    if($hub_id){
                                        $product_hub = $this->Admin_model->getDataResultRow('hubs', 'id="' . $hub_id. '"');
                                        if($product_hub){
                                            $hub_name=$product_hub['name'];
                                        }
                                    }
                                    
                                    $product=array(
                                        'hub_id'                => $hub_id,
                                        'hub_name'              => $hub_name,
                                        'hub_error'             => $hub_error,
                                        'category_id'           => $_POST['category_id'],
                                        'category_name'         => $category_name,
                                        'sub_category_id'       => $_POST['sub_category_id'],
                                        'sub_category_name'     => $sub_category_name,
                                        'product_from'          => $product_from,
                                        'brand_id'              => $brand_id,
                                        'brand_name'            => $brand_name,
                                        'model_id'              => $model_id,
                                        'model_name'            => $model_name,
                                        'model_mapped'          => $model_mapped,
                                        'primary_attribute'     => 1,
                                        'discount'              => $discount,
                                        'discount_error'        => $discount_error,
                                        'name'                  => (str_replace("'", "", $name)),
                                        'name_error'            => $name_error,
                                        'name_ar'               => (str_replace("'", "", $name_ar)),
                                        'name_ar_error'         => $name_ar_error,
                                        'description_short'     => (str_replace("'", "", $desc)),
                                        'description_short_ar'  => (str_replace("'", "", $desc_ar)),
                                        'desc_error'            => $desc_error,
                                        'description'           => (str_replace("'", "", $desc)),
                                        'desc_ar_error'         => $desc_ar_error,
                                        'description_ar'        => (str_replace("'", "", $desc_ar)),
                                        'terms'                 => (str_replace("'", "", $terms)),
                                        'terms_ar'              => (str_replace("'", "", $terms_ar)),
                                        'is_returnable'         => $is_returnable,
                                        'duration'              => $duration,
                                        'return_policy'         => (str_replace("'", "", $return_policy)),
                                        'return_policy_ar'      => (str_replace("'", "", $return_policy_ar)),
                                        'expected_delivery'     => $expected_delivery,
                                        'expected_delivery_error'=> $expected_delivery_error,
                                        'item_no'               => $skuId,
                                        'price'                 => $price,
                                        'price_error'           => $price_error,
                                        'quantity'              => $stock,
                                        'quantity_error'        => $stock_error,
                                        'images'                => $imagesAr,
                                        'image1_error'          => $image1_error,
                                        'error'                 => $find_product_row_error
                                    );
                                    //echo '<pre/>';print_r($product);exit;
                                    // $product=$this->Admin_model->addData('products',$product);
                                    // $product=true;
                                    //$product['error']=0;
                                    $attributeListArr=array();
                                    $specificationListArr=array();
                                    for($i=23;$i<=48;$i++){
                                        $attribute1 = $worksheet->getCellByColumnAndRow($i, 1)->getValue();
                                        if(isset($attribute1) and $attribute1){
                                            $attribute1=explode('-',$attribute1);
                                            if(isset($attribute1) and $attribute1){
                                                $attrVals = $worksheet->getCellByColumnAndRow($i, $row)->getValue();
                                                $attribute1Count=count($attribute1);
                                                $attributeId=$attribute1[$attribute1Count-1];
                                                if(isset($attribute1[1]) and $attribute1[1]){
                                                    $attributeType=$attribute1[1];
    
                                                    $attribute = $this->Admin_model->getDataResultRow('attribute', 'attribute_id="' . $attributeId. '"');
                                                    $attribute_value = $this->Admin_model->getDataResultRow('attribute_value', 'attribute_value_id="' . $attrVals . '"');
                                                    if($attribute_value){
                                                        $getAtrVal=$attribute_value['value'];
                                                        $getAtrValId=$attribute_value['attribute_value_id'];
                                                    }else{
                                                        $getAtrVal="";
                                                        $getAtrValId="";
                                                        $productError++;
                                                        $product['error']=1;
                                                    }
                                                    $attributeObj = array('attribute_id' => $attribute['attribute_id'],'attribute_name' => $attribute['name'], 'attribute_value_id' =>$getAtrValId, 'attribute_value' =>$getAtrVal );
                                                    
                                                    if($attributeType==100){
                                                        array_push($attributeListArr,$attributeObj);
                                                        // $attr=$this->Admin_model->addData('product_attribute',$attrData);
                                                    }else{
                                                        
                                                        array_push($specificationListArr,$attributeObj);
                                                        // $attr=$this->Admin_model->addData('product_specification',$specfyData);
                                                    }
                                                }else{
                                                    $productError++;
                                                    $product['error']=1;
                                                }
                                            }else{
                                                $productError++;
                                                $product['error']=1;
                                            }
                                        }
                                    }
                                    $product['attributeListArr']=$attributeListArr;
                                    $product['specificationListArr']=$specificationListArr;
                                    ////////////////////Product With multiple attribute/////////////////////////////
                                    $parentIdRand=rand(1000,9999);
                                    $getTYpeData = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                                    $getIndexCount=count($productArr);
                                    
                                    if(!$getTYpeData){
                                        $filterType =$parentIdRand;
                                        $FilterId=0;
                                        $setIndex=0;
                                        $prevIndex=$getIndexCount;
                                        $prevIdRand=$parentIdRand;
                                    }else{
                                        if(isset($attributeListArr[0]) and $attributeListArr[0]){
                                            $getTYpeDataExp=explode('-',$getTYpeData);
                                            if($getTYpeDataExp){
                                                $getTYpeDataExpCount=count($getTYpeDataExp);
                                                $getTYpeData=$getTYpeDataExp[$getTYpeDataExpCount-1];
    
                                                if($getTYpeData){
                                                    if($getTYpeData==1){
                                                        $parentIdRand= $filterType;
                                                        $FilterId=$filterType;
                                                        // $setIndex=$getIndexCount-1;
                                                        if($prevIdRand==$parentIdRand){
                                                            $setIndex++;
                                                        }
                                                        //$setIndex=$getIndexCount;
                                                        // $prevIndex=$getIndexCount-1;
                                                        $productArr[$prevIndex]['setIndex']=$setIndex;
                                                    }else{
                                                        $filterType =$parentIdRand;
                                                        $FilterId=0;
                                                        $setIndex=0;
                                                        $prevIndex=$getIndexCount;
                                                        $prevIdRand=$parentIdRand;
                                                    }
                                                }else{
                                                    $filterType =$parentIdRand;
                                                    $FilterId=0;
                                                    $setIndex=0;
                                                    $prevIndex=$getIndexCount;
                                                    $prevIdRand=$parentIdRand;
                                                }
    
                                            }else{
                                                $filterType =$parentIdRand;
                                                $FilterId=0;
                                                $setIndex=0;
                                                $prevIndex=$getIndexCount;
                                                $prevIdRand=$parentIdRand;
                                            }
                                        }else{
                                            $filterType =$parentIdRand;
                                            $FilterId=0;
                                            $setIndex=0;
                                            $prevIndex=$getIndexCount;
                                            $prevIdRand=$parentIdRand;
                                        }
                                    }

                                    $product['setIndex']= $setIndex;
                                    $product['parentId']=$parentIdRand;
                                    $product['filterTypeData']=$FilterId;
                                    ////////////////////Product With multiple attribute/////////////////////////////
                                    $checkRowFromExcelError=false;
                                    array_push($productArr,$product);
                                }
                            }
                        }
                        // echo '<pre/>';print_r($productArr);exit;
                    }
                }
                //echo '<pre>';print_r($data);exit;
                // echo '<pre/>';print_r($productArr);exit;
                if($checkRowFromExcelError){
                    echo '<script>alert("No data found from  Excel.");</script>';
                    echo '<script>window.location.href="'.base_url('admin/bulk-upload-product').'"</script>';
                }else{
                    // echo '<pre/>';print_r($productArr);exit;
                    $this->session->unset_userdata('zanomy_upload_session');
                    if(!$this->session->userdata('zanomy_upload_session')){
                        $this->session->set_userdata('zanomy_upload_session', $productArr);
                        $session = $this->session->userdata('zanomy_upload_session');
                    }
                    $data['category_list']=$this->Admin_model->getDataResultArray('product_category','status=1','category_id');
                    $data['product_list']=$productArr;
                    $data['file_data']=$_FILES;
                    $data['productError']=$productError;
                    $data['view_link'] = 'bulk/add_new_product';
                    $this->load->view('layout/template', $data);
                }
                
            }
        }else{
            $data['category_list']=$this->Admin_model->getDataResultArray('product_category','status=1','category_id');
            $data['product_list']=array();
            $data['view_link'] = 'bulk/add_new_product';
            $this->load->view('layout/template', $data);
        }
        
    }

    public function uploading_data() {
        if (isset($_POST['method'])) {
            if ($_POST['method'] == 'uploading_data') {
                $product_list = $this->session->userdata('zanomy_upload_session');
                // $product_list=json_decode($_POST['product_list'],TRUE);
                // echo '<pre/>';print_r($product_list);exit;
                if($product_list){
                    $productListId=0;
                    foreach($product_list as $list){
                        $filterTypeData=0;
                        if (isset($list['attributeListArr'][0]) and $list['attributeListArr'][0]){
                            if($list['filterTypeData']==0){
                                $filterTypeData=0;
                            }else{
                                $filterTypeData=1;
                            }
                        }else{
                            $filterTypeData=0;
                        }
                        if($filterTypeData==0){
                            
                            $productArr=array(
                                'hub_id'                => $list['hub_id'],
                                'upload_type'           => 1,
                                'category_id'           => $list['category_id'],
                                'sub_category_id'       => $list['sub_category_id'],
                                'product_from'          => $list['product_from'],
                                'brand_id'              => $list['brand_id'],
                                'model_id'              => $list['model_id'],
                                'model_mapped'          => $list['model_mapped'],
                                'primary_attribute'     => 1,
                                'name'                  => (str_replace("'", "", $list['name'])),
                                'name_ar'               => (str_replace("'", "", $list['name_ar'])),
                                'description_short'     => (str_replace("'", "", $list['description_short'])),
                                'description_short_ar'  => (str_replace("'", "", $list['description_short_ar'])),
                                'description'           => (str_replace("'", "", $list['description_short'])),
                                'description_ar'        => (str_replace("'", "", $list['description_short_ar'])),
                                'terms'                 => (str_replace("'", "", $list['terms'])),
                                'terms_ar'              => (str_replace("'", "", $list['terms_ar'])),
                                'is_returnable'         => $list['is_returnable'],
                                'duration'              => $list['duration'],
                                'return_policy'         => (str_replace("'", "", $list['return_policy'])),
                                'return_policy_ar'      => (str_replace("'", "", $list['return_policy_ar'])),
                                'expected_delivery'     => $list['expected_delivery'],
                                'created_at'            => strtotime(date('Y-m-d H:i:s')),
                                'updated_at'            => strtotime(date('Y-m-d H:i:s')),
                                'status'                => 1
                            );
                            // echo '<pre/>';print_r($productArr);exit;
                            $product=$this->Admin_model->addData('products',$productArr);
                            // echo $this->db->last_query();exit;
                            if($product){
                                $productListId=$product;
                                $group_id = 0;
                                if (isset($list['attributeListArr'])) {
                                    $group_id = rand(1000, 9999);
                                    $attribute = $list['attributeListArr'];
                                    foreach ($attribute as $key => $val) {
                                        if ($val['attribute_value_id']) {
                                            $checkDtaAttr = $this->Admin_model->getDataResultRow('attribute_mapping', 'category_id="' . $list['category_id'] . '" and sub_category_id="' . $list['sub_category_id'] . '" and attribute_id="' . $val['attribute_id'] . '"');
                                            $isPrimary = $checkDtaAttr['is_primary'];
                                            if ($isPrimary == 1) {
                                                //echo $key.'<pre/>';print_r($_POST['attribute']);exit;
                                                $getGroupData1 = $this->Admin_model->getDataResultRow('product_attribute', 'product_id="' . $product . '" and attribute_value_id="' . $val['attribute_value_id'] . '" and is_primary=1');
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

                                            $attrData = array(
                                                'parent_id' => $parentId,
                                                'sub_parent_id' => $subParentId,
                                                'is_new' => $isNew,
                                                'group_id' => $group_id,
                                                'product_id' => $product,
                                                'category_id' => $list['category_id'],
                                                'sub_category_id' => $list['sub_category_id'],
                                                'is_primary' => $key + 1,
                                                'attribute_id' => $val['attribute_id'],
                                                'attribute_value_id' => $val['attribute_value_id'],
                                            );
                                            $attr = $this->Admin_model->addData('product_attribute', $attrData);
                                        }
                                    }
                                }
                                if (isset($list['specificationListArr'])) {
                                    $specification = $list['specificationListArr'];
                                    foreach ($specification as $key => $val) {
                                        
                                            $specfyData = array(
                                                'product_id' => $product,
                                                'category_id' => $list['category_id'],
                                                'sub_category_id' => $list['sub_category_id'],
                                                'attribute_id' => $val['attribute_id'],
                                                'attribute_value_id' => $val['attribute_value_id'],
                                            );
                                            $attr = $this->Admin_model->addData('product_specification', $specfyData);
                                        
                                    }
                                }
                                $imagesAr=array();
                                if(isset($list['images']) and $list['images']){
                                    foreach($list['images'] as $img){
                                        $insertArr = [
                                            'file_path' => $img
                                        ];
                                        $return = $this->Admin_model->addData('product_images', $insertArr);
                                        $returnId = $this->db->insert_id();
                                        if ($returnId) {
                                            array_push($imagesAr, $returnId);
                                        }
                                    }
                                }
                                
                                
                                $uploadImages = trim(implode(',', $imagesAr), ',');
                                $attrData=array(
                                    'group_id'  => 0,
                                    'attribute_group_id'  => $group_id,
                                    'product_id'=> $product,
                                    'category_id'  => $list['category_id'],
                                    'sub_category_id'  => $list['sub_category_id'],
                                    'item_no'  => $list['item_no'],
                                    'price'  => $list['price'],
                                    'quantity'  => $list['quantity'],
                                    'discount'              => $list['discount'],
                                    'images'  => $uploadImages,
                                );
                                $addItems=$this->Admin_model->addData('product_attribute_group',$attrData);
                                
                                $value_id_1 = 0;
                                $value_id_2 = 0;
                                $value_id_3 = 0;
                                $attribute_mapping = $this->Admin_model->getDataResultArray('product_attribute', 'product_id="' . $product . '" and group_id="' . $group_id . '"', '');
                                if ($attribute_mapping) {
                                    foreach ($attribute_mapping as $key => $fileterlist) {
                                        if ($key == 0) {
                                            $value_id_1 = $fileterlist['attribute_value_id'];
                                        }if ($key == 1) {
                                            $value_id_2 = $fileterlist['attribute_value_id'];
                                        }if ($key == 2) {
                                            $value_id_3 = $fileterlist['attribute_value_id'];
                                        }
                                    }
                                    $attrmapping = array(
                                        'product_id' => $product,
                                        'item_id' => $addItems,
                                        'category_id' => $list['category_id'],
                                        'sub_category_id' => $list['sub_category_id'],
                                        'value_id_1' => $value_id_1,
                                        'value_id_2' => $value_id_2,
                                        'value_id_3' => $value_id_3,
                                    );
                                    $attr = $this->Admin_model->addData('product_filter', $attrmapping);
                                }
                                //echo "success";exit;
                            }

                        }else{
                            $product_id = $productListId;
                            $products = $this->Admin_model->getDataResultRow('products', 'product_id="' . $product_id . '"');
                            //$product=$productData['product_id'];
                            if($products){














                                $group_id = rand(1000, 9999);
                                $attribute = $list['attributeListArr'];
                                //echo '<pre/>';print_r($_POST['attribute_value']);exit;
                                $firstKeyVal = 0;
                                foreach ($attribute as $key => $val) {
                                    if ($key == 0) {
                                        $firstKeyVal = $val['attribute_value_id'];
                                    }
                                    if ($val['attribute_value_id']) {

                                        $checkDtaAttr = $this->Admin_model->getDataResultRow('attribute_mapping', 'category_id="' . $products['category_id'] . '" and sub_category_id="' . $products['sub_category_id'] . '" and attribute_id="' . $val['attribute_id'] . '"');
                                        //echo $key.'<pre/>';print_r($checkDtaAttr);exit;
                                        $isPrimary = $checkDtaAttr['is_primary'];
                                        if ($isPrimary == 1) {
                                            //echo $key.'<pre/>';print_r($_POST['attribute']);exit;
                                            $getGroupData1 = $this->Admin_model->getDataResultRow('product_attribute', 'product_id="' . $products['product_id'] . '" and attribute_value_id="' . $val['attribute_value_id'] . '" and is_primary=1');
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
                                                        $checkIsNew = $this->Admin_model->getDataResultRow('product_attribute', 'product_id="' . $products['product_id'] . '" and group_id="' . $v1['group_id'] . '" and attribute_value_id="' . $val['attribute_value_id'] . '" and is_primary=2');
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
                                                // echo $this->db->last_query();exit;
                                                // echo '<pre/>';print_r($getGroupData2);exit;
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
                                                $getGroupData3 = $this->Admin_model->getDataResultRow('product_attribute', 'product_id="' . $products['product_id'] . '" and group_id="' . $getGroupData2[0]['group_id'] . '" and is_primary=2');
                                                //echo $this->db->last_query();exit;
                                                // $subParentId=$checkerOn;
                                                // $parentId=$getGroupData3['parent_id'];
                                                $isNew = 0;
                                            }
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
                                            'attribute_id' => $val['attribute_id'],
                                            'attribute_value_id' => $val['attribute_value_id'],
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
                                









                                
                                if (isset($list['specificationListArr'])) {
                                    $specification = $list['specificationListArr'];
                                    foreach ($specification as $key => $val) {
                                        
                                            $specfyData = array(
                                                'product_id' => $products['product_id'],
                                                'category_id' => $list['category_id'],
                                                'sub_category_id' => $list['sub_category_id'],
                                                'attribute_id' => $val['attribute_id'],
                                                'attribute_value_id' => $val['attribute_value_id'],
                                            );
                                            $attr = $this->Admin_model->addData('product_specification', $specfyData);
                                        
                                    }
                                }
                                $imagesAr=array();
                                if(isset($list['images']) and $list['images']){
                                    foreach($list['images'] as $img){
                                        $insertArr = [
                                            'file_path' => $img
                                        ];
                                        $return = $this->Admin_model->addData('product_images', $insertArr);
                                        $returnId = $this->db->insert_id();
                                        if ($returnId) {
                                            array_push($imagesAr, $returnId);
                                        }
                                    }
                                }
                                
                                
                                $uploadImages = trim(implode(',', $imagesAr), ',');
                                $attrData=array(
                                    'group_id'  => 0,
                                    'attribute_group_id'  => $group_id,
                                    'product_id'=> $products['product_id'],
                                    'category_id'  => $list['category_id'],
                                    'sub_category_id'  => $list['sub_category_id'],
                                    'item_no'  => $list['item_no'],
                                    'price'  => $list['price'],
                                    'quantity'  => $list['quantity'],
                                    'discount'              => $list['discount'],
                                    'images'  => $uploadImages,
                                );
                                $addItems=$this->Admin_model->addData('product_attribute_group',$attrData);
                                
                                $value_id_1 = 0;
                                $value_id_2 = 0;
                                $value_id_3 = 0;
                                $attribute_mapping = $this->Admin_model->getDataResultArray('product_attribute', 'product_id="' . $product . '" and group_id="' . $group_id . '"', '');
                                if ($attribute_mapping) {
                                    foreach ($attribute_mapping as $key => $fileterlist) {
                                        if ($key == 0) {
                                            $value_id_1 = $fileterlist['attribute_value_id'];
                                        }if ($key == 1) {
                                            $value_id_2 = $fileterlist['attribute_value_id'];
                                        }if ($key == 2) {
                                            $value_id_3 = $fileterlist['attribute_value_id'];
                                        }
                                    }
                                    $attrmapping = array(
                                        'product_id' => $products['product_id'],
                                        'item_id' => $addItems,
                                        'category_id' => $list['category_id'],
                                        'sub_category_id' => $list['sub_category_id'],
                                        'value_id_1' => $value_id_1,
                                        'value_id_2' => $value_id_2,
                                        'value_id_3' => $value_id_3,
                                    );
                                    $attr = $this->Admin_model->addData('product_filter', $attrmapping);
                                }
                            }
                        }
                        $product=true;
                    }
                    $this->session->unset_userdata('zanomy_upload_session');
                    if($product){
                        echo "success";
                    }else{
                        echo "fail";
                    }
                    exit;
                }
                

            }
        }exit;
        if (isset($_POST['bulk_upload'])) {
            if (isset($_FILES["products"]["name"])) {
                $path = $_FILES["products"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                // echo '<pre/>';print_r($object->getWorksheetIterator());exit;
                if($object->getWorksheetIterator()){
                    foreach ($object->getWorksheetIterator() as $worksheet) {
                        $highestRow = $worksheet->getHighestRow();
                        $highestColumn = $worksheet->getHighestColumn();
                        // echo '<pre/>';print_r($worksheet->getCellByColumnAndRow(0,0));exit;
                        //echo $highestRow;exit;
                        for ($row = 2; $row <= $highestRow; $row++) {
                            $get_brand_id=0;
                            $get_model_id=0;
                            $model_mapped=strtotime(date('Y-m-d H:i:s'));
                            
                            $product_from=0;
                            $product_fromDta = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            if($product_fromDta){
                                $product_fromDtaExp=explode('-',$product_fromDta);
                                if($product_fromDtaExp){
                                    $product_fromDtaExpCount=count($product_fromDtaExp);
                                    $product_from=$product_fromDtaExp[$product_fromDtaExpCount-1];
                                }
                            }

                            $brand_id=0;
                            $brandDta = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                            if($brandDta){
                                $brandExp=explode('-',$brandDta);
                                if($brandExp){
                                    $brand_idCount=count($brandExp);
                                    $brand_id=$brandExp[$brand_idCount-1];
                                }
                            }
                            
                            $model_id = 0;
                            $modelDta = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                            if($modelDta){
                                $modelExp=explode('-',$modelDta);
                                if($modelExp){
                                    $modelExpCount=count($modelExp);
                                    $model_id=$modelExp[$modelExpCount-1];
                                }
                            }
                            
                            $stock = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                            if(!$stock){
                                $stock=0;
                            }
                            $skuId = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                            if(!$skuId){
                                $skuId="";
                            }
                            $name = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                            $name_ar = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                            $price = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                            $discount = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                            if(!$discount){
                                $discount=0;
                            }
                            $desc = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                            if(!$desc){
                                $desc="";
                            }
                            $desc_ar = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                            if(!$desc_ar){
                                $desc_ar="";
                            }
                            $image1 = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                            if(!$image1){
                                $image1="";
                            }
                            $image2 = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                            if(!$image2){
                                $image2="";
                            }
                            $image3 = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                            if(!$image3){
                                $image3="";
                            }
                            $image4 = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                            if(!$image4){
                                $image4="";
                            }
                            $terms = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                            if(!$terms){
                                $terms="";
                            }
                            $terms_ar = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                            if(!$terms_ar){
                                $terms_ar="";
                            }
                            $duration = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                            if(!$duration){
                                $duration="0";
                            }
                            $return_policy = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                            if(!$return_policy){
                                $return_policy="";
                            }
                            $return_policy_ar = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                            if(!$return_policy_ar){
                                $return_policy_ar="";
                            }
                            
                            if(isset($model_id) and $model_id){
                                $productsChecker   = $this->Admin_model->getDataResultRow('products','model_id="'.$model_id.'" and status="1"');
                                if($productsChecker){
                                    $model_mapped=$productsChecker['model_mapped'];
                                }
                            }
                            // echo $model_id;exit;
                            // if(isset($brand_id) and $brand_id){
                            //     $brand   = $this->Admin_model->getDataResultRow('brand','name="'.$brand_id.'"');
                            //     if($brand){
                            //         $get_brand_id=$brand['brand_id'];
                            //     }
                            // }
                            // if(isset($model_id) and $model_id){
                            //     $model   = $this->Admin_model->getDataResultRow('model','name="'.$model_id.'"');
                            //     if($model){
                            //         $get_model_id=$model['model_id'];
                            //     }
                            // }
                            if($name and $name_ar and $price and $stock ){
                                if($duration){
                                    $is_returnable=1;
                                }else{
                                    $is_returnable=0;
                                }
                                $product=array(
                                    'category_id'           => $_POST['category_id'],
                                    'sub_category_id'       => $_POST['sub_category_id'],
                                    'product_from'          => $product_from,
                                    'brand_id'              => $brand_id,
                                    'model_id'              => $model_id,
                                    'model_mapped'          => $model_mapped,
                                    'primary_attribute'     => 1,
                                    'discount'              => $discount,
                                    'name'                  => (str_replace("'", "", $name)),
                                    'name_ar'               => (str_replace("'", "", $name_ar)),
                                    'description_short'     => (str_replace("'", "", $desc)),
                                    'description_short_ar'  => (str_replace("'", "", $desc_ar)),
                                    'description'           => (str_replace("'", "", $desc)),
                                    'description_ar'        => (str_replace("'", "", $desc_ar)),
                                    'terms'                 => (str_replace("'", "", $terms)),
                                    'terms_ar'              => (str_replace("'", "", $terms_ar)),
                                    'is_returnable'         => $is_returnable,
                                    'duration'              => $duration,
                                    'return_policy'         => (str_replace("'", "", $return_policy)),
                                    'return_policy_ar'      => (str_replace("'", "", $return_policy_ar)),
                                    'created_at'            => strtotime(date('Y-m-d H:i:s')),
                                    'updated_at'            => strtotime(date('Y-m-d H:i:s')),
                                    'status'                => 1
                                );
                                echo '<pre/>';print_r($product);exit;
                                $product=$this->Admin_model->addData('products',$product);
                                // $product=true;
                                if($product){
                                    $group_id=rand(1000,9999);
                                    $insertSr=0;
                                    for($i=20;$i<=45;$i++){
                                        $insertSr++;
                                        $attribute1 = $worksheet->getCellByColumnAndRow($i, 1)->getValue();
                                        

                                        $attr_attribute_id = 0;
                                        $attrVals = $worksheet->getCellByColumnAndRow($i, $row)->getValue();
                                        if($attrVals){
                                            $attrValsExp=explode('-',$attrVals);
                                            if($attrValsExp){
                                                $attrValsExpCount=count($attrValsExp);
                                                $attr_attribute_id=$attrValsExp[$attrValsExpCount-1];
                                            }
                                        }


                                        $attributeValue1 = $worksheet->getCellByColumnAndRow($i, $row)->getValue();
                                        //echo $attribute1;exit;
                                        if($attribute1){
                                            $attribute1=explode('-',$attribute1);
                                            $attribute1Count=count($attribute1);
                                            $attributeId=$attribute1[$attribute1Count-1];
                                            $attributeType=$attribute1[$attribute1Count-2];

                                            // $attribute_value_data   = $this->Admin_model->getDataResultRow('attribute_value','attribute_id="'.$attributeId.'" and value="'.$attributeValue1.'" and status="1"');
                                            // echo $this->db->last_query().' / ';
                                            // print_r($attribute_value_data);exit;
                                                
                                            //echo $attributeType;
                                            if($attributeType==100){
                                                $checkDtaAttr   = $this->Admin_model->getDataResultRow('attribute_mapping','category_id="'.$_POST['category_id'].'" and sub_category_id="'.$_POST['sub_category_id'].'" and attribute_id="'.$attributeId.'"');
                                                //echo $this->db->last_query();exit;
                                                $isPrimary=$checkDtaAttr['is_primary'];
            
                                                if($isPrimary==1){
                                                    $getGroupData1    = $this->Admin_model->getDataResultRow('product_attribute','product_id="'.$product.'" and attribute_value_id="'.$attr_attribute_id.'" and is_primary=1');
                                                    if($getGroupData1){
                                                        $parentId=0;
                                                        $isNew=0;
                                                        $subParentId=0;
                                                    }else{
                                                        $parentId=0;
                                                        $isNew=1;
                                                        $subParentId=0;
                                                    }
                                                }elseif($isPrimary==2){
                                                    $getGroupData1    = $this->Admin_model->getDataResultRow('product_attribute','product_id="'.$product.'" and group_id="'.$group_id.'" and is_primary=1');
                                                    if($getGroupData1['is_new']==1){
                                                        $parentId=$getGroupData1['product_attribute_id'];
                                                        $isNew=1;
                                                        $subParentId=0;
                                                    }else{
                                                        $getGroupData2    = $this->Admin_model->getDataResultRow('product_attribute','product_id="'.$product.'" and attribute_value_id="'.$getGroupData1['attribute_value_id'].'" and is_primary=1 and is_new=1'); 
                                                        $parentId=$getGroupData2['product_attribute_id'];
                                                        $subParentId=0;
                                                        $isNew=0;
                                                    }
                                                }elseif($isPrimary==3){
                                                    $getGroupData1    = $this->Admin_model->getDataResultRow('product_attribute','product_id="'.$product.'" and group_id="'.$group_id.'" and is_primary=2');
                                                    //print_r($getGroupData1);exit;
                                                    if($getGroupData1['is_new']==1){
                                                        $subParentId=$getGroupData1['product_attribute_id'];
                                                        $parentId=$getGroupData1['parent_id'];
                                                        $isNew=1;
                                                    }else{
                                                        $getGroupData2    = $this->Admin_model->getDataResultRow('product_attribute','product_id="'.$product.'" and attribute_value_id="'.$getGroupData1['attribute_value_id'].'" and is_primary=1'); 
                                                        $getGroupData3    = $this->Admin_model->getDataResultRow('product_attribute','product_id="'.$product.'" and group_id="'.$getGroupData2['group_id'].'" and is_primary=2'); 
                                                        $subParentId=$getGroupData3['product_attribute_id'];
                                                        $parentId=$getGroupData3['parent_id'];
                                                        $isNew=0;
                                                    }
                                                }
            
                                                $attrData=array(
                                                    'parent_id'  => $parentId,
                                                    'sub_parent_id'  => $subParentId,
                                                    'is_new'  => $isNew,
                                                    'group_id'  => $group_id,
                                                    'product_id'=> $product,
                                                    'category_id'  => $_POST['category_id'],
                                                    'sub_category_id'  => $_POST['sub_category_id'],
                                                    'is_primary'  => $insertSr,
                                                    'attribute_id'  => $attributeId,
                                                    'attribute_value_id'  => $attr_attribute_id,
                                                );
                                                $attr=$this->Admin_model->addData('product_attribute',$attrData);
                                            }else{
                                                // print_r($attribute_value_data);
                                                $specfyData=array(
                                                    'product_id'=> $product,
                                                    'category_id'  => $_POST['category_id'],
                                                    'sub_category_id'  => $_POST['sub_category_id'],
                                                    'attribute_id'  => $attributeId,
                                                    'attribute_value_id'  => $attr_attribute_id,
                                                );
                                                $attr=$this->Admin_model->addData('product_specification',$specfyData);
                                            }
                                        }
                                    }
                                    $imagesAr=array();
                                    if($image1){
                                        $insertArr = [
                                            'file_path' => $image1
                                        ];
                                        $return = $this->Admin_model->addData('product_images', $insertArr);
                                        $returnId = $this->db->insert_id();
                                        if ($returnId) {
                                            array_push($imagesAr, $returnId);
                                        }
                                    }if($image2){
                                        $insertArr = [
                                            'file_path' => $image2
                                        ];
                                        $return = $this->Admin_model->addData('product_images', $insertArr);
                                        $returnId = $this->db->insert_id();
                                        if ($returnId) {
                                            array_push($imagesAr, $returnId);
                                        }
                                    }if($image3){
                                        $insertArr = [
                                            'file_path' => $image3
                                        ];
                                        $return = $this->Admin_model->addData('product_images', $insertArr);
                                        $returnId = $this->db->insert_id();
                                        if ($returnId) {
                                            array_push($imagesAr, $returnId);
                                        }
                                    }if($image4){
                                        $insertArr = [
                                            'file_path' => $image4
                                        ];
                                        $return = $this->Admin_model->addData('product_images', $insertArr);
                                        $returnId = $this->db->insert_id();
                                        if ($returnId) {
                                            array_push($imagesAr, $returnId);
                                        }
                                    }
                                    $uploadImages = trim(implode(',', $imagesAr), ',');
                                    $attrData=array(
                                        'group_id'  => 0,
                                        'attribute_group_id'  => $group_id,
                                        'product_id'=> $product,
                                        'category_id'  => $_POST['category_id'],
                                        'sub_category_id'  => $_POST['sub_category_id'],
                                        'item_no'  => $skuId,
                                        'price'  => $price,
                                        'quantity'  => $stock,
                                        'images'  => $uploadImages,
                                    );
                                    $addItems=$this->Admin_model->addData('product_attribute_group',$attrData);
                                    
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

                                }
                            }
                        }
                    }
                }
                //echo '<pre>';print_r($data);exit;
                if ($product) {
                    $htmlData='<div class="modal fade modal-design show" id="productupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" style="display:block;    top: -131px;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="messege-box">
                                                    <img src="http://gropse.com/gropse.com/design/zanomyvendor.com/common/images/uploadproduct.png" alt="success messege">
                                                    <h3>Your Product has been uploaded Successfully</h3>
                                                </div>';
                                                if(isset($_POST['attribute'])){
                                                    $htmlData.='<div class="action-button">
                                                        <p>Do you want to upload more specification</p>
                                                        <a href="'.base_url('admin/add-more-attribute/'.$product).'" class="btn btn-primary mybtns">Yes</a>
                                                        <a href="'.base_url('admin/add-new-product').'" class="btn btn-primary mybtns" data-dismiss="modal">Skip</a>
                                                    </div>';
                                                }else{
                                                    $htmlData.='<div class="action-button">
                                                        <a href="'.base_url('admin/add-new-product').'" class="btn btn-primary mybtns" data-dismiss="modal">Continue</a>
                                                    </div>';
                                                }
                                                $htmlData.='</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                $this->session->set_flashdata('response',$htmlData);
                                redirect('admin/add-new-product');
                } else {
                    redirect('admin/add-new-product');
                }
            }
        }
        
    }





    public function edit_bulk_upload_product() {
        if (isset($_POST['bulk_verify'])) {
            if (isset($_FILES["products"]["name"])) {
                 $productArr=array();
                 $productError=0;
                 $productErrorString="";
                 //echo '<pre/>';print_r($_FILES);exit;
                 $path = $_FILES["products"]["tmp_name"];
                 $object = PHPExcel_IOFactory::load($path);
                 // echo '<pre/>';print_r($object->getWorksheetIterator());exit;
                 
                 if($object->getWorksheetIterator()){
                     foreach ($object->getWorksheetIterator() as $k1=>$worksheet) {
                        if($k1==0){
                            
                            $highestRow = $worksheet->getHighestRow();
                            $highestColumn = $worksheet->getHighestColumn();
                            // echo '<pre/>';print_r($worksheet->getCellByColumnAndRow(0,0));exit;
                            //echo $highestRow;exit;
                            for ($row = 2; $row <= $highestRow; $row++) {
                                $product_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                                if(!$product_id){
                                    $product_id=0;
                                }
                                $item_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                                if(!$item_id){
                                    $item_id=0;
                                }
                                //echo "sss";exit;
                                $product_from_error=false;
                                if($product_id && $item_id){
                                    $find_product_row_error=0;
                                    $product_from = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                                    if(!$product_from){
                                        $product_from='';
                                        $productError++;
                                        $productErrorString=$productErrorString.'/product_from';
                                        $product_from_error=true;
                                        $find_product_row_error=1;
                                    }

                                    $brand_error=false;
                                    $brand_id = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                                    if(!$brand_id){
                                        $brand_id=0;
                                        // $productError++;
                                        // $productErrorString=$productErrorString.'/brand';
                                        // $brand_error=true;
                                        // $find_product_row_error=1;
                                    }
                                    $model_error=false;
                                    $model_id = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                                    if(!$model_id){
                                        $model_id=0;
                                    }
                                    $stock_error=false;
                                    $stock = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                                    if(!$stock){
                                        $stock=0;
                                        $productError++;
                                        $productErrorString=$productErrorString.'/stock';
                                        $stock_error=true;
                                        $find_product_row_error=1;
                                    }else{
                                        if(!is_numeric($stock)){
                                            $productError++;
                                            $productErrorString=$productErrorString.'/stock';
                                            $stock_error=true;
                                            $find_product_row_error=1;
                                        }
                                    }

                                    $skuId = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                                    if(!$skuId){
                                        $skuId="";
                                    }
                                    $name_error=false;
                                    $name = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                                    if(!$name){
                                        $name="";
                                        $productError++;
                                        $productErrorString=$productErrorString.'/name';
                                        $name_error=true;
                                        $find_product_row_error=1;
                                    }
                                    $name_ar_error=false;
                                    $name_ar = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                                    if(!$name_ar){
                                        $name_ar="";
                                        $productError++;
                                        $productErrorString=$productErrorString.'/name_ar';
                                        $name_ar_error=true;
                                        $find_product_row_error=1;
                                    }
                                    $price_error=false;
                                    $price = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                                    if(!$price){
                                        $price="";
                                        $productError++;
                                        $productErrorString=$productErrorString.'/price';
                                        $price_error=true;
                                        $find_product_row_error=1;
                                    }else{
                                        if(!is_numeric($price)){
                                            $productError++;
                                            $price_error=true;
                                            $productErrorString=$productErrorString.'/price';
                                            $find_product_row_error=1;
                                        }
                                    }
                                    $discount_error=false;
                                    $discount = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                                    if(!$discount){
                                        $discount=0;
                                    }else{
                                        if(!is_numeric($discount)){
                                            $productError++;
                                            $discount_error=true;
                                            $productErrorString=$productErrorString.'/discount';
                                            $find_product_row_error=1;
                                        }
                                    }
                                    $desc_error=false;
                                    $desc = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                                    if(!$desc){
                                        $desc="";
                                        $productError++;
                                        $desc_error=true;
                                        $productErrorString=$productErrorString.'/desc';
                                        $find_product_row_error=1;
                                    }
                                    $desc_ar_error=false;
                                    $desc_ar = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                                    if(!$desc_ar){
                                        $desc_ar="";
                                        $productError++;
                                        $productErrorString=$productErrorString.'/desc_ar';
                                        $desc_ar_error=true;
                                        $find_product_row_error=1;
                                    }
                                    $image1_error=false;
                                    $image1 = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                                    if(!$image1){
                                        $image1="";
                                        $productError++;
                                        $image1_error=true;
                                        $productErrorString=$productErrorString.'/image';
                                        $find_product_row_error=1;
                                    }
                                    $image2 = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                                    if(!$image2){
                                        $image2="";
                                    }
                                    $image3 = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                                    if(!$image3){
                                        $image3="";
                                    }
                                    $image4 = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                                    if(!$image4){
                                        $image4="";
                                    }
                                    $terms = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                                    if(!$terms){
                                        $terms="";
                                    }
                                    $terms_ar = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                                    if(!$terms_ar){
                                        $terms_ar="";
                                    }
                                    $duration = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                                    if(!$duration){
                                        $duration="0";
                                    }
                                    $return_policy = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                                    if(!$return_policy){
                                        $return_policy="";
                                    }
                                    $return_policy_ar = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                                    if(!$return_policy_ar){
                                        $return_policy_ar="";
                                    }
                                    
                                    
                                        if($duration){
                                            $is_returnable=1;
                                        }else{
                                            $is_returnable=0;
                                        }
                                        $imagesAr=array();
                                        if($image1){
                                            array_push($imagesAr, $image1);
                                        }if($image2){
                                            array_push($imagesAr, $image2);
                                        }if($image3){
                                            array_push($imagesAr, $image3);
                                        }if($image4){
                                            array_push($imagesAr, $image4);
                                        }

                                        $category_id=0;
                                        $category_name='';
                                        $sub_category_id=0;
                                        $product_table = $this->Admin_model->getDataResultRow('products', 'product_id="' . $product_id. '"');
                                        if($product_table){
                                            $category_id=$product_table['category_id'];
                                            $sub_category_id=$product_table['sub_category_id'];
                                        }
                                        if($category_id){
                                            $product_category = $this->Admin_model->getDataResultRow('product_category', 'category_id="' . $category_id. '"');
                                            if($product_category){
                                                $category_name=$product_category['name'];
                                            }
                                        }
                                        
                                        if($sub_category_id){
                                            $product_sub_category = $this->Admin_model->getDataResultRow('product_sub_category', 'sub_category_id="' . $sub_category_id. '"');
                                            if($product_sub_category){
                                                $sub_category_name=$product_sub_category['name'];
                                            }
                                        }
                                        
                                        $brand_name='';
                                        if($brand_id){
                                            $product_brand = $this->Admin_model->getDataResultRow('brand', 'brand_id="' . $brand_id. '"');
                                            if($product_brand){
                                                $brand_name=$product_brand['name'];
                                            }
                                        }
        
                                        $model_name='';
                                        if($model_id){
                                            $product_model = $this->Admin_model->getDataResultRow('model', 'model_id="' . $model_id. '"');
                                            if($product_model){
                                                $model_name=$product_model['name'];
                                            }
                                        }
                                        
                                        $product=array(
                                            'product_id'            => $product_id,
                                            'item_id'               => $item_id,
                                            'category_id'           => $category_id,
                                            'category_name'         => (str_replace("'", "", $category_name)),
                                            'sub_category_id'       => $sub_category_id,
                                            'sub_category_name'     => (str_replace("'", "", $sub_category_name)),
                                            'product_from'          => $product_from,
                                            'brand_id'              => $brand_id,
                                            'brand_name'            => (str_replace("'", "", $brand_name)),
                                            'model_id'              => $model_id,
                                            'model_name'            => (str_replace("'", "", $model_name)),
                                            'primary_attribute'     => 1,
                                            'discount'              => $discount,
                                            'discount_error'        => $discount_error,
                                            'name'                  => (str_replace("'", "", $name)),
                                            'name_error'            => $name_error,
                                            'name_ar'               => (str_replace("'", "", $name_ar)),
                                            'name_ar_error'         => $name_ar_error,
                                            'description_short'     => (str_replace("'", "", $desc)),
                                            'description_short_ar'  => (str_replace("'", "", $desc_ar)),
                                            'description'           => (str_replace("'", "", $desc)),
                                            'desc_error'            => $desc_error,
                                            'description_ar'        => (str_replace("'", "", $desc_ar)),
                                            'desc_ar_error'         => $desc_ar_error,
                                            'terms'                 => (str_replace("'", "", $terms)),
                                            'terms_ar'              => (str_replace("'", "", $terms_ar)),
                                            'is_returnable'         => $is_returnable,
                                            'duration'              => $duration,
                                            'return_policy'         => (str_replace("'", "", $return_policy)),
                                            'return_policy_ar'      => (str_replace("'", "", $return_policy_ar)),
                                            'item_no'               => $skuId,
                                            'price'                 => $price,
                                            'price_error'           => $price_error,
                                            'quantity'              => $stock,
                                            'quantity_error'        => $stock_error,
                                            'images'                => $imagesAr,
                                            'image1_error'          => $image1_error,
                                            'error'                 => $find_product_row_error
                                        );

                                        //  echo '<pre/>';print_r($product);exit;
                                        // $product=$this->Admin_model->addData('products',$product);
                                        // $product=true;
                                        // $product['error']=0;
                                        $attributeListArr=array();
                                        $specificationListArr=array();
                                        //  for($i=20;$i<=45;$i++){
                                        //      $attribute1 = $worksheet->getCellByColumnAndRow($i, 1)->getValue();
                                        //      if(isset($attribute1) and $attribute1){
                                        //          $attribute1=explode('-',$attribute1);
                                        //          if(isset($attribute1) and $attribute1){
                                        //              $attrVals = $worksheet->getCellByColumnAndRow($i, $row)->getValue();
                                        //              $attribute1Count=count($attribute1);
                                        //              $attributeId=$attribute1[$attribute1Count-1];
                                        //              if(isset($attribute1[1]) and $attribute1[1]){
                                        //                  $attributeType=$attribute1[1];
        
                                        //                  $attribute = $this->Admin_model->getDataResultRow('attribute', 'attribute_id="' . $attributeId. '"');
                                        //                  $attribute_value = $this->Admin_model->getDataResultRow('attribute_value', 'attribute_value_id="' . $attrVals . '"');
                                        //                  if($attribute_value){
                                        //                      $getAtrVal=$attribute_value['value'];
                                        //                      $getAtrValId=$attribute_value['attribute_value_id'];
                                        //                  }else{
                                        //                      $getAtrVal="";
                                        //                      $getAtrValId="";
                                        //                      $productError++;
                                        //                      $product['error']=1;
                                        //                  }
                                        //                  $attributeObj = array('attribute_id' => $attribute['attribute_id'],'attribute_name' => $attribute['name'], 'attribute_value_id' =>$getAtrValId, 'attribute_value' =>$getAtrVal );
                                                        
                                        //                  if($attributeType==100){
                                        //                      array_push($attributeListArr,$attributeObj);
                                        //                      // $attr=$this->Admin_model->addData('product_attribute',$attrData);
                                        //                  }else{
                                                            
                                        //                      array_push($specificationListArr,$attributeObj);
                                        //                      // $attr=$this->Admin_model->addData('product_specification',$specfyData);
                                        //                  }
                                        //              }else{
                                        //                  $productError++;
                                        //                  $product['error']=1;
                                        //              }
                                        //          }else{
                                        //              $productError++;
                                        //              $product['error']=1;
                                        //          }
                                        //      }else{
                                        //          $productError++;
                                        //          $product['error']=1;
                                        //      }
                                        //  }
                                        $product['attributeListArr']=$attributeListArr;
                                        $product['specificationListArr']=$specificationListArr;
                                        array_push($productArr,$product);
                                        // echo '<pre/>';print_r($productArr);exit;
                                    
                                }
                            }
                            // echo '<pre/>';print_r($productArr);exit;
                        }
                     }
                 }
                 //echo '<pre>';print_r($data);exit;
                //  echo '<pre/>';print_r($productArr);exit;
                // echo $productErrorString;exit;
                ///name/stock/desc_ar/stock/desc_ar/desc_ar/
                $this->session->unset_userdata('zanomy_upload_edit_session');
                if(!$this->session->userdata('zanomy_upload_edit_session')){
                    $this->session->set_userdata('zanomy_upload_edit_session', $productArr);
                    $session = $this->session->userdata('zanomy_upload_edit_session');
                }

                 $data['category_list']=$this->Admin_model->getDataResultArray('product_category','status=1','category_id');
                 $data['product_list']=$productArr;
                 $data['file_data']=$_FILES;
                 $data['productError']=$productError;
                 $data['view_link'] = 'bulk/edit_bulk_upload_product';
                 $this->load->view('layout/template', $data);
             }
        }else{
            $data['product_list']=array();
            $data['view_link'] = 'bulk/edit_bulk_upload_product';
            $this->load->view('layout/template', $data);
        }
         
    }

     public function updating_data() {
        if (isset($_POST['method'])) {
            if ($_POST['method'] == 'updating_data') {
                $product_list = $this->session->userdata('zanomy_upload_edit_session');
                // $product_list=json_decode($_POST['product_list'],TRUE);
                // echo '<pre/>';print_r($product_list);exit;
                if($product_list){
                    foreach($product_list as $list){
                        $productArr=array(
                            'upload_type'           => 1,
                            // 'category_id'           => $list['category_id'],
                            // 'sub_category_id'       => $list['sub_category_id'],
                            // 'product_from'          => $list['product_from'],
                            // 'brand_id'              => $list['brand_id'],
                            // 'model_id'              => $list['model_id'],
                            // 'model_mapped'          => $list['model_mapped'],
                            // 'primary_attribute'     => 1,
                            'name'                  => (str_replace("'", "", $list['name'])),
                            'name_ar'               => (str_replace("'", "", $list['name_ar'])),
                            'description_short'     => (str_replace("'", "", $list['description_short'])),
                            'description_short_ar'  => (str_replace("'", "", $list['description_short_ar'])),
                            'description'           => (str_replace("'", "", $list['description_short'])),
                            'description_ar'        => (str_replace("'", "", $list['description_short_ar'])),
                            'terms'                 => (str_replace("'", "", $list['terms'])),
                            'terms_ar'              => (str_replace("'", "", $list['terms_ar'])),
                            'is_returnable'         => $list['is_returnable'],
                            'duration'              => $list['duration'],
                            'return_policy'         => (str_replace("'", "", $list['return_policy'])),
                            'return_policy_ar'      => (str_replace("'", "", $list['return_policy_ar'])),
                            'updated_at'            => strtotime(date('Y-m-d H:i:s')),
                        );
                        $product = $this->Admin_model->updateData(['product_id' => $list['product_id']], 'products', $productArr);
                        // echo $this->db->last_query();exit;
                        if($product){
                           $imagesAr=array();
                            if(isset($list['images']) and $list['images']){
                                foreach($list['images'] as $img){
                                    $insertArr = [
                                        'file_path' => $img
                                    ];
                                    $return = $this->Admin_model->addData('product_images', $insertArr);
                                    $returnId = $this->db->insert_id();
                                    if ($returnId) {
                                        array_push($imagesAr, $returnId);
                                    }
                                }
                            }
                            
                            
                            $uploadImages = trim(implode(',', $imagesAr), ',');
                            $attrData=array(
                                'item_no'  => $list['item_no'],
                                'price'  => $list['price'],
                                'quantity'  => $list['quantity'],
                                'discount'              => $list['discount'],
                                'images'  => $uploadImages,
                            );
                            $product = $this->Admin_model->updateData(['item_id' => $list['item_id'], 'product_id' => $list['product_id']], 'product_attribute_group', $attrData);
                            
                        }
                    }
                    if($product){
                        echo "success";
                    }else{
                        echo "fail";
                    }
                    exit;
                }
                

            }
        }exit;

    }
        
        
  
    
    //======================================AJAX===========================
	public function ajax(){
        $this->load->view('server');
    }

}