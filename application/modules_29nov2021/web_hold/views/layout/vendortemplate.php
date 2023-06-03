<?php
$this->load->view('layout/vendorheader');
//$this->load->view('layout/sidebar');
if(isset($data)){
    $this->load->view($view_link,$data);
}
else{
    $this->load->view($view_link);
}
$this->load->view('layout/footer');
?>

