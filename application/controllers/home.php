<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/smscenterdotpk.php");

class Home extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->library('email');
        $this->load->helper('url');
    }
    
    public function index() {
        $this->load->view('home_view');
    }
    
    public function login() {
        $page_title = "Login Page";
        $data = array("page_title" => $page_title);
        $this->load->view('login_view', $data);
    }
    public function login_request(){
        //email

        //password

        //create password_hash

        //create function in users_model that will receieve 2 params (email,password_hash) return (true,false)

    }
    
    public function register() {
        $this->load->view('register_view');
    }
    public function register_request() {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
        $password2 = $this->input->post('password2', true);
        $email = $this->input->post('email', true);
        $mobile = $this->input->post('mobile', true);
        $address = $this->input->post('address', true);
        if (empty($username) || empty($password) || empty($password2) || empty($email) || empty($mobile) || empty($address)) {
            echo json_encode(array('error' => 'Please fill in required fields'));
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(array('error' => 'Email is not valid'));
        } elseif ($password != $password2) {
            echo json_encode(array('error' => 'password doesnot matched'));
        } elseif (!$this->is_valid_mobile_number($mobile)) {
            echo json_encode(array('error' => 'Mobile number is not valid'));
        } elseif ($this->users_model->is_email_exist($email)) {
            echo json_encode(array('error' => 'Email already exists'));
        } else {
            
            // register the user
            
            $password_hash = md5($password);
            
            // email confirmation code
            $email_confirmation_code = md5($email . time() . uniqid());
            
            // mobile confirmation code
            $mobile_confirmation_code = uniqid(rand());
            $mobile_confirmation_code = preg_replace("/[^0-9,.]/", "", $mobile_confirmation_code);
            $mobile_confirmation_code = substr($mobile_confirmation_code, 0, 4);
            
            $insert_user = $this->users_model->insert_user($email, $username, $password_hash, $address, $email_confirmation_code, $mobile, $mobile_confirmation_code);
            if ($insert_user) {
                
                //send email
                $to = $email;
                $subject = "Welcome to OnlineCameraShop:: Please confirm your email";
                $message = "
Hi $username

Your account has been created successfully
" . base_url('index.php/home/confirmEmail?code=' . $email_confirmation_code) . "

Regards
ShopName

                ";
               // $this->send_email($to, $subject, $message);
            
                //send sms
                    //TESTING SENDSMS
                $sms = new smscenterdotpk('6f970b1226f3150e7805');
                $sms->sendsms($mobile, "Hi $username, Your confirmation code for mobile is $mobile_confirmation_code. Please logon to ".base_url('index.php/home/login')." and goto settings to confirm your mobile no.", 0);
               $url = base_url('index.php/home/confirmEmail?code=' . $email_confirmation_code);
                echo json_encode(array('success' => 'Your account hasbeen created successfully, you will receive an email and sms to confirm your email and mobile no. '.$url));
            } else {
                echo json_encode(array('error' => 'Something went wrong while creating your account please contact administrator (ERROR CODE: 60)'));
            }
        }
    }
    public function checkemail() {
        $email = $this->input->post('email', true);
        if (empty($email)) {
            echo json_encode(array('error' => 'Email is required'));
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(array('error' => 'Email is not valid'));
        } elseif ($this->users_model->is_email_exist($email)) {
            echo json_encode(array('error' => 'Email already exists'));
        } else {
            echo json_encode(array('success' => 'Email is valid'));
        }
    }
    public function checkmobile() {
        $mobile = $this->input->post('mobile', true);
        if (empty($mobile)) {
            echo json_encode(array('error' => 'Mobile No is required'));
        } elseif (!$this->is_valid_mobile_number($mobile)) {
            echo json_encode(array('error' => 'Mobile No is not valid'));
        } elseif ($this->users_model->is_mobile_exist($mobile)) {
            echo json_encode(array('error' => 'Mobile No already exists'));
        } else {
            echo json_encode(array('success' => 'Mobile is valid'));
        }
    }
    


    public function confirmEmail(){
        $email_confirmation_code = $this->input->get('code',true);
        if(empty( $email_confirmation_code)){
            echo "Not Authorized";
        }else{
            $user_id = $this->users_model->compare_email_code($email_confirmation_code);
            if($user_id != false){
                $user_id = $user_id['user_id'];
                $this->users_model->confirm_email($user_id);
                 echo "Your email is confirmed";
            }else{
               
                echo "This email confirmation code doesnot exists";
            }
        }
    }

    private function is_valid_mobile_number($telNumber) {
        if (!is_string($telNumber) && !is_int($telNumber)) return false;
        
        /* All regex patterns written by Sag-e-Attar Junaid Atari */
        $patterns = array('mobileNumber' => '/^((\(((\+|00)92)\)|(\+|00)92)(( |\-)?)' . '(3[0-9]{2})\6|0(3[0-9]{2})( |\-)?)[0-9]' . '{3}( |\-)?[0-9]{4}$/');
        
        foreach ($patterns as $pattern) $response[] = preg_match($pattern, $telNumber) ? true : false;
        
        return ($response[0]);
    }
    
    protected function send_email($to, $subject, $message) {
        $config = Array('protocol' => 'smtp',
         //outgoing server protocol
        'smtp_host' => '',
         //smpt server url
        'smtp_port' => 25,
         //smtp port of server
        'smtp_user' => '', 'smtp_pass' => '', 'mailtype' => 'html', 'charset' => 'utf-8', 'wordwrap' => TRUE);
        
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('');
         // set the sender email
        //change it to yours
        $this->email->to($to);
        
        // change it to yours
        $this->email->subject($subject);
        $this->email->message($message);
        
        // $this->email->message($message);
        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
            
            //return false;
            
        }
    }
}
