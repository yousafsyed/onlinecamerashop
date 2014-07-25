<?php
class Products_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_all_categories() {
		$this->db->select('*');
		$query = $this->db->get('onlinecamerashop_categories');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	function get_latest_products($limit = 20) {
		$this->db->select('*');
		$this->db->order_by('date_added', 'DESC');
		$this->db->limit($limit);
		$query = $this->db->get('onlinecamerashop_products');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	function getProductById($id) {
		$this->db->select('*');
		$this->db->where('p_id', $id);

		$query = $this->db->get('onlinecamerashop_products');

		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}
}