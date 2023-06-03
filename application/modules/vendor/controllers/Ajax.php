<?php

// require 'aws/aws-autoloader.php';

// use Aws\S3\S3Client;

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Vendor_model');
        $this->load->helper('custom_helper');
    }

    function send_mail($to, $title, $subject, $data) {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'techgropse.com';
        $config['smtp_port'] = 587;
        $config['smtp_user'] = "dev@techgropse.com";
        $config['smtp_pass'] = "dev@123";
        $config['mailtype'] = 'html';
        $config['charset'] = "iso-8859-1";

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
// Sender email address
        $this->email->from("dev@techgropse.com", "Zanomy");
// Receiver email address
        $this->email->to($to);
// Subject of email
        $this->email->subject($subject);
        $body = $this->load->view('email.php', $data, TRUE);
// Message in email
        $this->email->message($body);
        $result = $this->email->send();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function verify_otp() {
        $email = $this->input->post('email');
        $otp = $this->input->post('otp');
        $emailExist = $this->Vendor_model->getRowData(['email' => $this->input->post('email')], 'vendor');
        if ($emailExist) {
            if ($emailExist['otp'] == $otp) {
                if ($this->input->post('type') == 3) {
                    $sessionArr = [
                        'vendor_id' => $emailExist['vendor_id'],
                        'name' => $emailExist['name'],
                        'email' => $emailExist['email'],
                        'image' => $emailExist['image'],
                        'country_code' => $emailExist['country_code'],
                        'mobile' => $emailExist['mobile'],
                        'business_type' => $emailExist['business_type']
                    ];
                    $this->session->set_userdata('vendor_login', $sessionArr);
                    $query = $this->Vendor_model->updateData(['email' => $this->input->post('email')], 'vendor', ['status' => 1]);
                } else {
                    $query = $this->Vendor_model->updateData(['email' => $this->input->post('email')], 'vendor', ['status' => 3]);
                }
                $res = ['status' => '1', 'error_code' => 100, 'message' => 'email verified!', 'data' => []];
                echo json_encode($res);
                die;
            } else {
                $res = ['status' => '0', 'error_code' => 101, 'message' => 'invalid otp', 'data' => []];
                echo json_encode($res);
                die;
            }
        } else {
            $res = ['status' => '0', 'error_code' => 102, 'message' => 'email not registered', 'data' => []];
            echo json_encode($res);
            die;
        }
    }

    public function login() {
    	// echo "ssss";exit;
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $emailExist = $this->Vendor_model->getRowData(['email' => $email], 'vendor');
        if ($emailExist) {
            if ($emailExist['password'] == $password) {
                if ($emailExist['status'] == 1) {

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
                    $res = ['status' => '1', 'error_code' => 100, 'message' => 'login successfull!', 'data' => []];
                    echo json_encode($res);
                    die;
                } else if ($emailExist['status'] == 2) {
                    $res = ['status' => '0', 'error_code' => 104, 'message' => 'Your account is blocked by Zanomy Management. Message from management: ' . $emailExist['block_reason'].'  Please contact the seller services to re-activate account.', 'data' => []];
                    echo json_encode($res);
                    die;
                } else if ($emailExist['status'] == 3) {
                    $res = ['status' => '0', 'error_code' => 105, 'message' => 'waiting for admin approval.', 'data' => []];
                    echo json_encode($res);
                    die;
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
                        $res = ['status' => '0', 'error_code' => 103, 'message' => 'verify your email.', 'data' => ['otp' => 0]];
                        echo json_encode($res);
                        die;
                    }else{
                        $res = ['status' => '0', 'error_code' => 103, 'message' => 'verify your email.', 'data' => ['otp' => 0]];
                        echo json_encode($res);
                        die;
                    }exit;
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
                    $res = ['status' => '0', 'error_code' => 106, 'message' => 'Account permanently deactivated', 'data' => []];
                    echo json_encode($res);
                    die;
                }
            } else {
                $res = ['status' => '0', 'error_code' => 101, 'message' => 'invalid password!', 'data' => []];
                echo json_encode($res);
                die;
            }
        } else {
            $res = ['status' => '0', 'error_code' => 102, 'message' => 'email not registered', 'data' => []];
            echo json_encode($res);
            die;
        }
    }

    public function resendOtp() {
        $emailExist = $this->Vendor_model->getRowData(['email' => $this->input->post('email')], 'vendor');
        if ($emailExist) {
            if ($emailExist['status'] == 1 || $emailExist['status'] == 0) {
                $otp = rand(1000, 9999);
                $query = $this->Vendor_model->updateData(['email' => $this->input->post('email')], 'vendor', ['otp' => $otp]);
                // $this->send_mail($this->input->post('email'), 'Zanomy', 'Please Verify Your Account.', ['otp' => $otp]);

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
                    $res = ['status' => '0', 'error_code' => 100, 'message' => 'verify your email.', 'data' => ['otp' => 0]];
                    echo json_encode($res);
                    die;
                }else{
                    $res = ['status' => '0', 'error_code' => 100, 'message' => 'verify your email.', 'data' => ['otp' => 0]];
                    echo json_encode($res);
                    die;
                }exit;
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

                
            } else if ($emailExist['status'] == 2) {
                $res = ['status' => '0', 'error_code' => 104, 'message' => 'account is blocked by admin. ' . $emailExist['block_reason'], 'data' => []];
                echo json_encode($res);
                die;
            } else if ($emailExist['status'] == 3) {
                $res = ['status' => '0', 'error_code' => 105, 'message' => 'waiting for admin approval.', 'data' => []];
                echo json_encode($res);
                die;
            } else {
                $res = ['status' => '0', 'error_code' => 106, 'message' => 'Account permanently deactivated', 'data' => []];
                echo json_encode($res);
                die;
            }
        } else {
            $res = ['status' => '0', 'error_code' => 102, 'message' => 'email not registered', 'data' => []];
            echo json_encode($res);
            die;
        }
    }

    public function register() {
        $emailExist = $this->Vendor_model->getRowData(['email' => $this->input->post('email')], 'vendor');
        if ($emailExist) {
            $res = ['status' => '0', 'error_code' => 101, 'message' => 'email is already registered', 'data' => []];
            echo json_encode($res);
            die;
        } else {
            $strPost['name'] = ucwords($this->input->post('name'));
            $strPost['business_type'] = ucwords($this->input->post('business_type'));
            $strPost['country_code'] = trim($this->input->post('country_code'), '+');
            $strPost['mobile'] = $this->input->post('mobile');
            $strPost['password'] = md5($this->input->post('password'));
            $strPost['image'] = base_url().'assets/vendor/images/userdummy.png';
            $strPost['email'] = $this->input->post('email');
            $strPost['status'] = 0;
            $strPost['created_at'] = time();
            $otp = rand(1000, 9999);
            $strPost['otp'] = $otp;
            if ($strPost['business_type'] == 2) {
                $strPost['city_id'] = $this->input->post('city_id');
                $strPost['address'] = $this->input->post('address');
                $strPost['start_time'] = $this->input->post('start_time');
                $strPost['end_time'] = $this->input->post('end_time');
                $strPost['lat'] = $this->input->post('lat');
                $strPost['lng'] = $this->input->post('lng');
                if ($_FILES) {
                    if ($_FILES['file'] && $_FILES['file']['name']) {
                        $file_ext = explode('.', $_FILES['file']['name']);
                        $uploadFile = urlencode(time() . $this->my_random_string($this->remove_special_character($file_ext[0]))) . '.' . $file_ext[1];
//                        if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/document/' . $uploadFile)) {
//
//                            $strPost['id_proof'] = base_url() . 'uploads/document/' . $uploadFile;
//                        } else {
//                            $strPost['id_proof'] = "";
//                        }
                        
                        $uploadPath = 'uploads/document/';
                        $reponse = uploadToS3($_FILES['file']['tmp_name'], $uploadFile, $uploadPath);
                        if ($reponse) {
                            if (isset($reponse['imagepath']) && $reponse['imagepath']) {
                                $strPost['id_proof'] = $reponse['imagepath'];
                            }else{
                                $strPost['id_proof'] = "";
                            }
                        }else{
                            $strPost['id_proof'] = "";
                        }
                    } else {
                        $strPost['id_proof'] = "";
                    }
                }
            } else {
                $strPost['hub_id'] = $this->input->post('hub_id');
            }

            $returnData = $this->Vendor_model->addData('vendor', $strPost);
            if ($returnData) {
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
                    $res = ['status' => '1', 'error_code' => 100, 'message' => 'Registration successfull. Verify your email to login', 'data' => ['otp' => 0]];
                    echo json_encode($res);
                    die;
                }else{
                    $res = ['status' => '1', 'error_code' => 100, 'message' => 'Registration successfull. Verify your email to login', 'data' => ['otp' => 0]];
                    echo json_encode($res);
                    die;
                }exit;
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
                //$this->send_mail($this->input->post('email'), 'Zanomy', 'Please Verify Your Account for the Registration.', ['otp' => $otp]);
               
            } else {
                $res = ['status' => '0', 'error_code' => 201, 'message' => 'Some error occured', 'data' => []];
                echo json_encode($res);
                die;
            }
        }
    }

    function purchasePlan() {
        $vendor = $this->session->userdata('vendor_logged_in');
        $vendor_id = $vendor['vendor_id'];
        $plans = $_POST['plan_list'];
        foreach ($plans as $plan) {
            $getPlan = $this->Vendor_model->getRowData(['plan_id' => $plan['plan_id']], 'subscription_plan');
            if ($getPlan) {
                $expire_date = date('Y-m-d H:i:s', strtotime('+' . $getPlan['duration'] . ' days'));
                $insertArr = [
                    'plan_id' => $plan['plan_id'],
                    'service_category_id' => $plan['category_id'],
                    'price' => $getPlan['price'],
                    'subscribe_date' => date('Y-m-d H:i:s'),
                    'expire_date' => $expire_date
                ];
                $checkCatPlan = $this->Vendor_model->getRowData(['vendor_id' => $vendor_id, 'service_category_id' => $plan['category_id']], 'vendor_subscription');
                if ($checkCatPlan && $checkCatPlan['price']) {
                    $addPlan = $this->Vendor_model->updateData(['vendor_subscription' => $checkCatPlan['vendor_subscription']], 'vendor_subscription', $insertArr);
                } else {
                    $insertArr['vendor_id'] = $vendor_id;
                    $addPlan = $this->Vendor_model->addData('vendor_subscription', $insertArr);
                }
            }
        }
        if ($addPlan) {
            $res = ['status' => '1', 'error_code' => 200, 'message' => 'Plan subscribed successfully.', 'data' => []];
            echo json_encode($res);
            die;
        } else {
            $res = ['status' => '0', 'error_code' => 201, 'message' => 'Some error occured', 'data' => []];
            echo json_encode($res);
            die;
        }
    }

    function remove_special_character($string) {
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        return $string;
    }

    function my_random_string($char) {
        $characters = $char;
        $length = 20;
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
?>

