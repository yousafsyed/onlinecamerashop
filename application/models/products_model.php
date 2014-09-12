<?php
class Products_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all_categories()
    {
        $this->db->select('*');
        $query = $this->db->get('onlinecamerashop_categories');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function get_latest_products($limit = 20)
    {
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
    function getProductById($id)
    {
        $this->db->select('*');
        $this->db->where('p_id', $id);
        $this->db->join('onlinecamerashop_brand',
            'onlinecamerashop_brand.b_id = onlinecamerashop_products.b_id', 'left');
        $this->db->join('onlinecamerashop_categories',
            'onlinecamerashop_categories.c_id = onlinecamerashop_products.c_id', 'left');
        $query = $this->db->get('onlinecamerashop_products');

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return null;
        }
    }

    function getAllCategories($id)
    {
        $this->db->select('*');
        $this->db->where('c_id', $id);
        $query = $this->db->get('onlinecamerashop_products');
        print_r($query);exit;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }
}
