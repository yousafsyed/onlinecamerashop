<?php

class Cart extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('products_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library("session");
	}
	public function index() {
		$email = $this->session->userdata('email');
		$data  = array();
		if (!empty($email)) {
			// get user data
			$userdata = $this->users_model->get_user_by_email($email);

			$data['email']     = $email;
			$data['user_name'] = $userdata['user_name'];
			$data['logged_in'] = true;
		} else {
			//not logged it
			$data['user_name'] = 'Guest';
			$data['email']     = 'Guest';
			$data['logged_in'] = false;

		}
		$this->load->view('cart_view', $data);
	}
	public function add() {
		$email = $this->session->userdata('email');
		if (empty($email)) {// user is not logged in than just save the data in session
			$p_id  = $this->input->post('p_id');
			$qty   = $this->input->post('qty');
			$color = $this->input->post('color');
			if (empty($qty)) {
				$qty = 1;
			}

			$product_info = $this->products_model->getProductById($p_id);
			if (empty($color)) {
				$color = $product_info['color'];
				$color = explode(',', $color);
				$color = $color[0];
			}
			$data = array(
				'id'      => $p_id,
				'qty'     => $qty,
				'price'   => $product_info['p_price'],
				'name'    => $product_info['p_name'],
				'options' => array('Color' => $color)
			);

			$this->cart->insert($data);

		} else {// save the cart in database

		}
	}
}