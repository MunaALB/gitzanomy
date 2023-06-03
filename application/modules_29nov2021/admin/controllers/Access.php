
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('Admin_model'));
        
    }

           
    public function unauthorized_access() {
        $this->load->view('unauthorized');
    }
    
    public function getPrivilege() {
        $routes = [];
        if ($this->session->userdata('admin_logged_in')) {
            $admin_login = $this->session->userdata('admin_logged_in');
            $subadmin = $this->db->where(['id' => $admin_login['id'], 'status' => 1])->get('admin')->row_array();
            if ($subadmin) {
                if ($subadmin['privilege']) {
                    $privilege = explode(',', trim($subadmin['privilege'], ','));
                } else {
                    $privilege = [];
                }
                if ($privilege) {
                    foreach ($privilege as $row) {
                        $route = $this->Admin_model->getDataResultArray('privilege_submenu', ['type' => $row], 'id');
                        $routes = array_merge($routes, $route);
                    }
                }
            }
        }
        echo json_encode(array('data' => $routes));
    }
}
?>


