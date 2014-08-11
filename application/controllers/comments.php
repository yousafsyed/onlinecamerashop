<?php

class Comments extends CI_Controller{
    function add_comment($postID){
        if(!$_POST){
            redirect(base_url().'posts/post/'.$postID);
    }
    $user_type=$this->session->userdata('user_tyoe');
    if(!$user_type){
            redirect(base_url().'users/login');
    }
    $this->load->model('comment');
    $data=array(
        'postID'=>$postID,
        'userID'=>$this->session->userdata('userID'),
        'comment'=>$_POST['comment']
     );
     $this->comment->add_comment($data);
     redirect(base_url().'posts/post/'.$postID);   
}
}
