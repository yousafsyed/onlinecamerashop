<?php
class Products_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_all_categories() {
		$this->db->select('*');
		$query = $this->db->get('onlinecamerashop_categories');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	function get_latest_products($limit = 20) {
		$this->db->select('*');
		$this->db->limit($limit);
		$this->db->order('date_added', 'asc');
		$query = $this->db->get('onlinecamerashop_products');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}
}