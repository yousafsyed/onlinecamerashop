<?php

class Categories_view extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('cart_model');
        $this->load->model('products_model');
        $this->load->model('categories_model');
        $this->load->library('email');
        $this->load->helper('url');
        $this->load->library("session");
        
        
    }
    
    function categories(){
        $this->load->view('categories_view');
    }

}




