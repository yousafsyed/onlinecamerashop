
<?php
class categories_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

function getProductByCId($id)
    {
        
        $this->db->select('*');
        $this->db->where('c_id', $id);
        
        
        
    }
    function get_all($catId)
    {
    	$this->db->select('*')->from('onlinecamerashop_products')->where('c_id',$catId);
    	$q = $this->db->get();
    	return $q->result_array();
    }
}