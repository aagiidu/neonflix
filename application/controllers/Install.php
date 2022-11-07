<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Install extends CI_Controller {

	// constructor
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view('backend/install');
	}
	
	


}
