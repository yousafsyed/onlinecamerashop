<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('home_view');
	}

	public function login(){
		$page_title = "Login Page";
		$data = array(
			"page_title"=> $page_title

			);
		$this->load->view('login_view',$data);
	}

	public function register(){
		
	}
}

