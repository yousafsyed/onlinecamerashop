<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('home_view');
    }

    public function login()
    {
        $page_title = "Login Page";
        $data = array("page_title" => $page_title);
        $this->load->view('login_view', $data);
    }

    public function register()
    {
        $this->load->view('register_view');
    }
    public function register_request()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
        $password2 = $this->input->post('password2', true);
        $email = $this->input->post('email', true);
        $mobile = $this->input->post('mobile', true);
        $address = $this->input->post('address', true);
        if (empty($username) || empty($password) || empty($password2) || empty($email) ||
            empty($mobile) || empty($address)) {
            echo json_encode(array('error' => 'Please fill in required fields'));
        } elseif (!filter_var($email, VALIDATE_EMAIL)) {
            echo json_encode(array('error' => 'Email is not valid'));
        } elseif ($password != $password2) {
            echo json_encode(array('error' => 'password doesnot matched'));
        } elseif(!is_valid_mobile_number($mobile)){
            echo json_encode(array('error' => 'Mobile number is not valid'));
        }else{// register the user
            
        }
    }


    private function is_valid_mobile_number($telNumber)
    {
        if (!is_string($telNumber) && !is_int($telNumber))
            return false;

        /* All regex patterns written by Sag-e-Attar Junaid Atari */
        $patterns = array( // 'premiumNumber'  => '/^0(8|9)00 ?[0-9]{3} ?[0-9]{2}$/',

            'mobileNumber' => '/^((\(((\+|00)92)\)|(\+|00)92)(( |\-)?)' . '(3[0-9]{2})\6|0(3[0-9]{2})( |\-)?)[0-9]' .
                '{3}( |\-)?[0-9]{4}$/'
                // 'landlineNumber' => '/^(\((\+|00)92\)( )?|(\+|00)92( )?|0)' .
                //                            '[1-24-9]([0-9]{1}( )?[0-9]{3}( )?[0-9]' .
            //                            '{3}( )?[0-9]{1,2}|[0-9]{2}( )?[0-9]{3}' .
            //                            '( )?[0-9]{3})$/'
            );

        foreach ($patterns as $pattern)
            $response[] = preg_match($pattern, $telNumber) ? true : false;

        return ($response[0]);
    }

}
