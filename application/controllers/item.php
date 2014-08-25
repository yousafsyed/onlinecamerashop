<?php
class Item extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('products_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library("session");
	}

	public function index($id) {
		define("DS", DIRECTORY_SEPARATOR);
		if (is_numeric($id)) {
			$email        = $this->session->userdata('email');
			$data         = array();
			$product_info = $this->products_model->getProductById($id);
			//var_dump($product_info);
			if ($product_info == null) {// product found

				header("HTTP/1.1 404 Not Found");
			}

			$dir = FCPATH.'public'.DS.'images'.DS.'products'.DS.$product_info['p_id'];
			if (file_exists($dir)) {
				$files = scandir($dir);
				$files = array_filter($files, function ($file) {
					return preg_match('/\.(gif|jpg|png)$/i', $file);
				});
				$files = array_values($files);

			}

			if (!empty($email)) {
				// get user data
				$userdata = $this->users_model->get_user_by_email($email);

				$data['email']        = $email;
				$data['user_name']    = $userdata['user_name'];
				$data['logged_in']    = true;
				$data['product_info'] = $product_info;
				$data['images']       = $files;
			} else {
				//not logged it
				$data['user_name']    = 'Guest';
				$data['email']        = 'Guest';
				$data['logged_in']    = false;
				$data['product_info'] = $product_info;
				$data['images']       = $files;

			}

			$this->load->view('item_view', $data);
		} else {
			echo "Invalid Product Id";
		}

	}

}
