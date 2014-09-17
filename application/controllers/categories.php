<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Categories extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('cart_model');
        $this->load->model('products_model');
        $this->load->library('email');
        $this->load->helper('url');
        $this->load->library("session");
        // $data['mytable'] = ;
    }
   
    public function all()
    {
        $categories = $this->products_model->get_all_categories();
        if (is_array($categories)) {
            echo json_encode($categories);
        } else {
            echo json_encode(array('error' => 'No categories were found'));
        }
    }

    function categ($id)
    {
        //echo $id; exit;
        $this->load->model('categories_model');
        $data['products'] = $this->categories_model->get_all($id);
        $this->load->view('categories_view', $data);

    }


    function loadCategories()
    {
        	$c_id         = $this->input->get('id');
        //echo $x;exit();
        $categories = $this->products_model->getAllCategories($c_id);
        if (is_array($categories)) {
            echo json_encode($categories);
        } else {
            echo json_encode(array('error' => 'No categories were found'));
        }
    }
}
