
<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('Vendor_model'));
        date_default_timezone_set('Asia/Kolkata');
        $this->load->library('session');

        if(!$this->session->userdata('zanomy_vendor_language_session')){
            $language   = "en";
            $this->session->set_userdata('zanomy_vendor_language_session', $language);
            $session = $this->session->userdata('zanomy_vendor_language_session');
            // echo "<script>window.location.href='".base_url('/')."'</script>";
            $this->language_data=$language;
        }else{
            $this->language_data = $this->session->userdata('zanomy_vendor_language_session');
        }

    }

    public function index() {
        $language_data = $this->language_data;
        if (!$this->session->userdata('vendor_logged_in')) {
        	if(isset($_POST['email']) and $_POST['email'] and isset($_POST['password']) and $_POST['password']){
        	
        	
        	
        	
        	
        	
        	
        	
        	
        	
        	$email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $emailExist = $this->Vendor_model->getRowData(['email' => $email], 'vendor');
        
        if ($emailExist) {
            if ($emailExist['password'] == $password) {
            
                if ($emailExist['status'] == 1) {
//print_r($emailExist);exit;
                    $sessionArr = [
                        'vendor_id' => $emailExist['vendor_id'],
                        'name' => $emailExist['name'],
                        'email' => $emailExist['email'],
                        'image' => $emailExist['image'],
                        'country_code' => $emailExist['country_code'],
                        'mobile' => $emailExist['mobile'],
                        'business_type' => $emailExist['business_type']
                    ];
                    $this->session->set_userdata('vendor_logged_in', $sessionArr);
                     $this->session->set_flashdata('response', '<p class="text-danger flashErrorPrint" id="englishError">Login successfull.</p>');
                        redirect('vendor/dashboard');
                } else if ($emailExist['status'] == 2) {
                $this->session->set_flashdata('response', '<p class="text-danger flashErrorPrint" id="englishError">Your account is blocked by Zanomy Management. Message from management: ' . $emailExist['block_reason'].'  Please contact the seller services to re-activate account.</p>');
                        $this->load->view('index');
                    
                } else if ($emailExist['status'] == 3) {
                $this->session->set_flashdata('response', '<p class="text-danger flashErrorPrint" id="englishError">waiting for admin approval.</p>');
                        $this->load->view('index');
                    
                } else if ($emailExist['status'] == 0) {
                    $otp = rand(1000, 9999);
                    // $this->send_mail($email, 'Zanomy', 'Please Verify Your Account.', ['otp' => $otp]);
                    $query = $this->Vendor_model->updateData(['email' => $email], 'vendor', ['otp' => $otp]);
                    

                    ///////////////////////SENDGRID///////////////////
                    require 'vendor/autoload.php';
        
                    $email = new \SendGrid\Mail\Mail();
                    $email->setFrom("dev.zanomy@gmail.com", "Zanomy Verification");
                    $email->setSubject("Account Verification");
                    $email->addTo($this->input->post('email'), ucwords($this->input->post('name')));
                    $email->addContent("text/plain", "Your OTP IS : ".$otp);
                    // $email->addContent(
                    //     "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
                    // );
                    $sendgrid = new \SendGrid('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');
                    if($sendgrid->send($email)){
                    $this->session->set_flashdata('response', '<p class="text-danger flashErrorPrint" id="englishError">verify your email</p>');
                        $this->load->view('index');
                        
                    }else{
                    $this->session->set_flashdata('response', '<p class="text-danger flashErrorPrint" id="englishError">verify your email</p>');
                        $this->load->view('index');
                    
                    }
                    
//                    exit;
                    // exit;
                    // try {
                    //     echo '<pre/>';
                    //     $response = $sendgrid->send($email);
                    //     print $response->statusCode() . "\n";
                    //     print_r($response->headers());
                    //     print $response->body() . "\n";
                    // } catch (Exception $e) {
                    //     echo 'Caught exception: '. $e->getMessage() ."\n";
                    // }
                    ///////////////////////SENDGRID///////////////////

                    
                } else {
                $this->session->set_flashdata('response', '<p class="text-danger flashErrorPrint" id="englishError">Account permanently deactivated</p>');
                        $this->load->view('index');
                    
                }
            } else {
            $this->session->set_flashdata('response', '<p class="text-danger flashErrorPrint" id="englishError">invalid password!</p>');
                        $this->load->view('index');
            }
        } else {
        $this->session->set_flashdata('response', '<p class="text-danger flashErrorPrint" id="englishError">email not registered.</p>');
                        $this->load->view('index');
        }
        
        
        
        
        
        
        
        
        	}else{
        	if($language_data=='ar'){
                $this->load->view('view_ar/index');
            }else{
                $this->load->view('index');
            }
        	}
            
        } else {
            redirect('vendor/dashboard');
        }
    }

    public function register() {
        $language_data = $this->language_data;
        $hub_list = $this->Vendor_model->getData(['status' => 1], 'hubs', '', 'name', 'ASC');
        $data['hub_list'] = $hub_list;
        $city_list = $this->Vendor_model->getData(['status' => 1], 'city', '', 'name', 'ASC');
        $data['city_list'] = $city_list;
        if (!$this->session->userdata('vendor_logged_in')) {
            if($language_data=='ar'){
                $this->load->view('view_ar/registration',$data);
            }else{
                $this->load->view('registration', $data);
            }
        } else {
            redirect('vendor/dashboard');
        }
    }

    public function admin_verification() {
        $this->load->view('admin_verification');
    }

    public function forgot_password() {
        $language_data = $this->language_data;
        if (!$this->session->userdata('vendor_logged_in')) {
            if($language_data=='ar'){
                $this->load->view('view_ar/forgot_password');
            }else{
                $this->load->view('forgot_password');
            }
        } else {
            redirect('vendor/dashboard');
        }
    }

    public function reset_password() {
        if ($this->session->userdata('vendor_login')) {
            if (isset($_POST['password']) && $_POST['password']) {
                $vendor = $this->session->userdata('vendor_login');
                $password = md5($this->input->post('password'));
                $query = $this->Vendor_model->updateData(['vendor_id' => $vendor['vendor_id']], 'vendor', ['password' => $password]);
                if ($query) {
                    // $this->session->set_userdata('vendor_logged_in', $vendor);
                    // $this->session->unset_userdata('vendor_login');
                    // $this->session->set_flashdata('response', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password reset successfully</div>');
                    // redirect('vendor/dashboard');


                    $htmlData = '<div class="modal  modal-design" id="exampleModal" data-keyboard="false" data-backdrop="static"data-keyboard="false" data-backdrop="static"data-keyboard="false" data-backdrop="static"data-keyboard="false" data-backdrop="static"data-keyboard="false" data-backdrop="static"data-keyboard="false" data-backdrop="static"data-keyboard="false" data-backdrop="static"data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: block;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Success</h5>
                                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button> -->
                            </div>
                            <div class="modal-body">
                                <form id="otp_form" method="post">
                                    <div class="form-group">
                                        <label>Password successfully recover.</label>
                                    </div>
                                    <a href="'.base_url('vendor').'" class="composemail  pull-right mt-4 mb-4">Back To Login</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
                    $this->session->set_flashdata('response', $htmlData);
                     
                    redirect('vendor/reset-password');
                } else {
                    $this->session->set_flashdata('response', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Some error occured. Try again.</div>');
                    redirect('vendor/reset-password');
                }
            } else {
                $this->load->view('reset_password');
            }
        } else {
            redirect('vendor');
        }
    }

    public function logout() {
        $this->session->unset_userdata('vendor_logged_in');
        redirect('vendor');
    }

    function terms_and_condition(){
        $this->load->view('terms_and_condition');
    }

    public function ajax() {
        $this->load->view('ajaxserver');
    }

}
?>


