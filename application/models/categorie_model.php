<?php

class Categorie_model extends model {

    function search($limit,$offset){
        
        //result
        $q = $this->db->select("c_id,c_name,C_description")
            ->from('onlinecamerashop_categories')
            ->limit($limit,$offset);
        
        $ret['rows'] = $q->get()->result();
        
        //count 
        $q = $this->db->select('COUNT(*) as count', FALSE)
            ->from('onlinecamerashop_categories');
        
        $tmp = $q->get()->result();
        
        $ret['num_rows'] = $tmp[0]->count;
        
        return $ret;
        
    }
    
}