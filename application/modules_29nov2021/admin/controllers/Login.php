
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('Admin_model'));
        $this->load->library('session');
        $this->load->library('form_validation');
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin/dashboard');
        }
    }

    public function index() {
        $this->form_validation->set_error_delimiters('<p style="color:#ff7702;">', '</p>');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password1', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            //
            $email = $this->input->post('email');
            $password = $this->input->post('password1');
            $result = $this->Admin_model->admin_login($email, $password);
            //print_r($result);exit;
            if ($result) {
                if (isset($result['error_type'])) {
                    $this->session->set_flashdata('response', '<p class="errorPrint" id="englishError">Account is blocked by superadmin.</p>');
                    redirect('admin');
                } else {
                    $sessionArr = ['id' => $result['id'],'username' => $result['username'], 'email' => $result['email'], 'type' => $result['type']];
                    $this->session->set_userdata('admin_logged_in', $sessionArr);
                    redirect('admin/dashboard');
                }
            } else {
                $this->session->set_flashdata('response', '<p class="errorPrint" id="englishError">In-valid username or password</p>');
                redirect('admin');
                //echo '<script>alert("In-valid username or password");</script>';
                //echo '<script>window.location.href="'.base_url('admin').'"</script>';
            }
        }
    }
    
    public function ajax() {
        $this->load->view('ajax_server');
    }

   

}
?>


