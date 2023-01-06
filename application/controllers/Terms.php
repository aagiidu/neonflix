<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms extends CI_Controller {

	// constructor
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('crud_model');
	}
	
	public function index()
	{
        $page_data['page_name']		=	'terms';
		$page_data['page_title']	=	'Үйлчилгээний нөхцөл';
		$this->load->view('frontend/index', $page_data);
	}

}
