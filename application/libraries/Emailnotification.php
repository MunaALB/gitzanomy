<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once dirname(__FILE__) . '/external/class.smtp.php';

class Emailnotification {

    private $CI;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->database();
        $this->CI->load->library('My_PHPMailer');
        $this->CI->load->library('session');
    }

    public function send_welcome($mailto, $subject, $message) {
//        $query = $this->CI->db->get_where('email_templates', array('id' => 1));
//        $result = $query->result_array();
//        $email_html = $result[0]['template'];
        return $this->send_mail($mailto, $subject, $message);
    }

    public function send_otp($mailto, $subject, $message) {
        return $this->send_mail($mailto, $subject, $message);
    }

    public function send_mail($to, $subject, $message) {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
//        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
//        $mail->SMTPDebug = 2; 
        $mail->Port = SMTP_PORT;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASS;
        $mail->From = ADMIN_EMAIL;
        $mail->FromName = WEB_NAME;
        $mail->AddAddress($to);
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body = $message;
        if (!$mail->Send()) {
            return false;
        }
        return TRUE;
    }
    
     public function send_mail1($to, $subject, $type, $data) {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
//        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
//        $mail->SMTPDebug = 2; 
        $mail->Port = SMTP_PORT;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASS;
        $mail->From = ADMIN_EMAIL;
        $mail->FromName = WEB_NAME;
        $mail->AddAddress($to);
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;

        $CI =& get_instance();

        if ($type == "welcome") {
            $body = $CI->load->view('email/register', $data, TRUE);
        }

        $mail->Body = $body;
        if (!$mail->Send()) {
            return false;
        }
        return TRUE;
    }

}
