<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy extends CI_Controller {

	// constructor
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('crud_model');
	}
	
	public function index()
	{
        $page_data['page_name']		=	'privacypolicy';
		$page_data['page_title']	=	'Нууцлалын бодлого';
		$this->load->view('frontend/index', $page_data);
	}

}
