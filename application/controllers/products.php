<?php
if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Products extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('products_model');
	}
	public function latest($limit = null) {

		if ($limit != null) {

			$latest_products = $this->products_model->get_latest_products($limit);
		} else {
			$latest_products = $this->products_model->get_latest_products();
		}

		if (is_array($latest_products)) {
			echo json_encode($latest_products);
		} else {
			echo json_encode(array('error' => 'No products were found'));
		}
	}
}
