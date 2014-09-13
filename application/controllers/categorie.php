<?php
class Categories extends CI_Controller{
    
    function display($offset = 0){
        
        $limit = 10;
        
        $this->load->model('categorie_model');
        $result = $this->categorie_model->search();
        $data['categorie'] = $result['rows'];
        
        $data['num_result'] = $result['num_rows'];
        
        $this->load->view('categorie', $data);
        
    }
    
}

