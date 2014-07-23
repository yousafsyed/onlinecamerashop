<?php
if (!defined('BASEPATH')) {exit('No direct script access allowed');
}

class Categories extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('products_model');
		$this->load->helper('url');
	}

	public function all() {
		$categories = $this->products_model->get_all_categories();
		if (is_array($categories)) {
			echo json_encode($categories);
		} else {
			echo json_encode(array('error' => 'No categories were found'));
		}
	}

}