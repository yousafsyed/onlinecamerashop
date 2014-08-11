<?php

class Comment extends CI_Model{
    
    function add_comment($data){
        $this->db->insert('comments',$data);
    }
    function get_comment($postID){
        $this->db->select('Comments.*,users.username')->from('comments')->join('users','users.userID=comment.userID','left')->where('postID',$postID)->order_by('comments.date_added','asc');
        $query=$this->db->get();
        return $query->result_array();
    }
    }