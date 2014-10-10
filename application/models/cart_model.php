<?php
class Cart_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function addtocart($user_id, $p_id, $qty, $c_id, $color) {
		$data = array(
			'user_id' => $user_id,
			'p_id'    => $p_id,
			'c_id'    => $c_id,
			'color'   => $color,
			'qty'     => $qty
		);
		$this->db->insert('onlinecamerashop_cart', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}

	}

	public function getUserCartItems($user_id) {
		$this->db->select('*');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('onlinecamerashop_cart');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	public function get_qty($id)
	{
		$this->db->select('qty')->from('onlinecamerashop_products')->where('p_id',$id);
		$q = $this->db->get();
		return  $q->result_array();
	}

}