<?php
class Users_model extends  CI_Model{
    /**
     * Users_model::__construct()
     * 
     * @return
     */
    function __construct(){
        parent::__construct();
    }
    /**
     * Users_model::is_email_exist()
     * 
     * @param mixed $email
     * @return
     */
    function is_email_exist($email){
        $this->db->select("user_id");
        $this->db->where("user_email",$email);
        $query = $this->db->get("onlinecamerashop_users");
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * Users_model::is_mobile_exist()
     * 
     * @param mixed $mobile
     * @return
     */
    function is_mobile_exist($mobile){
        $this->db->select("user_id");
        $this->db->where("mobile_no",$mobile);
        $query = $this->db->get("onlinecamerashop_users");
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * Users_model::insert_user()
     * 
     * @param mixed $email
     * @param mixed $name
     * @param mixed $password
     * @param mixed $address
     * @param mixed $email_confirmation_code
     * @param mixed $mobile
     * @param mixed $mobile_confirmation_code
     * @param mixed $address
     * @return
     */
    function insert_user($email,$name,$password,$address,$email_confirmation_code,$mobile,$mobile_confirmation_code)
    {
        $data = array(
        "user_name"=>$name,
        "user_email"=>$email,
        "user_password"=>$password,
        "mobile_no"=>$mobile,
        "user_address"=>$address,
        "email_confirmation_code"=>$email_confirmation_code,
        "mobile_confirmation_code"=>$mobile_confirmation_code
        );

        $query = $this->db->insert("onlinecamerashop_users",$data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
        
    }

    function compare_email_code($email_confirmation_code){
        $this->db->select("user_id");
        $this->db->where("email_confirmation_code",$email_confirmation_code);
        $query = $this->db->get("onlinecamerashop_users");
        if($query->num_rows() > 0){
            return $query->row_array();
        }else{
            return false;
        }
    }

    function login_confirmation($email,$password_hash){
     // code here
    }

    function confirm_email($user_id){
        $data = array(

            "email_confirmed"=>"yes"
            );
        $this->db->where("user_id",$user_id);
        $this->db->update("onlinecamerashop_users",$data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
}