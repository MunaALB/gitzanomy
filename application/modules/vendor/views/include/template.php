<?php
$this->load->view('include/header');
$this->load->view('include/sidebar');
if(isset($data)){
    $this->load->view($view_link,$data);
}
else{
    $this->load->view($view_link);
}
$this->load->view('include/footer');
?>