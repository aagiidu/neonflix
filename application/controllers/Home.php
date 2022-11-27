<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	// constructor
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('crud_model');
		$this->load->model('email_model');
		$this->load->library('session');
		
	}
	
	function movies()
	{
		// $this->subscription_check();
		// $this->active_user_check();
		$page_data['page_name']		=	'home';
		$page_data['page_title']	=	'Кинонууд';
		$this->load->view('frontend/index', $page_data);
	}

	function moviegrid()
	{
		$page_data['page_name']		=	'moviegrid';
		$page_data['page_title']	=	'Кинонууд';
		$this->load->view('frontend/index', $page_data);
	}

	function seriesgrid()
	{
		$page_data['page_name']		=	'seriesgrid';
		$page_data['page_title']	=	'Олон ангит цувралууд';
		$this->load->view('frontend/index', $page_data);
	}

	function animegrid()
	{
		$page_data['page_name']		=	'animegrid';
		$page_data['page_title']	=	'Анимэ';
		$this->load->view('frontend/index', $page_data);
	}


	function landing2()
	{
		$page_data['page_name']		=	'landing2';
		$page_data['page_title']	=	'Кино үзвэр';
		$this->load->view('frontend/index', $page_data);
	}

	// Home browsing page
	public function index()
	{
		//$this->login_check();
		$page_data['page_name']		=	'landing';
		$page_data['page_title']	=	'Эхлэл';
		$this->load->view('frontend/index', $page_data);
	}
	
	/* function signup()
	{
		$this->login_check();
		if (isset($_POST) && !empty($_POST))
		{
			$signup_result = $this->crud_model->signup_user();
			if ($signup_result == true)
				redirect(base_url().'index.php?browse/purchaseplan' , 'refresh');
			else if ($signup_result == false)
				redirect(base_url().'index.php?home/signup' , 'refresh');
		}
		$page_data['page_name']		=	'signup';
		$page_data['page_title']	=	'Бүртгүүлэх';
		$this->load->view('frontend/index', $page_data);
		
	} */

	// axios
	function checkotp()
	{
		$this->login_check();
		if (isset($_POST) && !empty($_POST))
		{
			$_POST = json_decode(array_keys($_POST)[0], true);
			$this->crud_model->verify_otp($_POST);
		}
	}

	function register()
	{
		$this->login_check();
		if (isset($_POST) && !empty($_POST))
		{
			$_POST = json_decode(array_keys($_POST)[0], true);
			$this->crud_model->register_verified($_POST);
		}
	}

	function signup()
	{

		$this->login_check();
		/* if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		} */
		
		echo $_SERVER['HTTP_CLIENT_IP'];
		echo '######';
		echo $_SERVER['HTTP_X_FORWARDED_FOR'];
		echo '######';
		echo $_SERVER['REMOTE_ADDR'];
		echo '######';

		if (isset($_POST) && !empty($_POST))
		{
			$_POST = json_decode(array_keys($_POST)[0], true);
			$this->crud_model->phone_register($_POST);
		}
	}
	
	function signinx()
	{
		if($this->isLoggedIn()){
			echo '/';
			return;
		} 
		if (isset($_POST) && !empty($_POST))
		{
			$data = json_decode(array_keys($_POST)[0], true);
			$phone 			= $data['phone'];
			$password 		= $data['password'];
			$signin_result 	= $this->crud_model->signin($phone, $password);
			if ($signin_result == true)
			{
				if ($this->session->userdata('login_type') == 1){
					echo base_url() . '/index.php?admin/dashboard';
					return;
				} else if ($this->session->userdata('login_type') == 0) {
					echo base_url() . '/index.php?browse/doswitch/user1';
					return;
				}
			} else if ($signin_result == false){
				echo 'error';
			}
		}
	}
	function signin()
	{
		$this->login_check();
		if (isset($_POST) && !empty($_POST))
		{
			$phone 			= $this->input->post('phone');
			$password 		= $this->input->post('password');
			$signin_result 	= $this->crud_model->signin($phone, $password);
			if ($signin_result == true)
			{
				if ($this->session->userdata('login_type') == 1)
					redirect(base_url().'index.php?admin/dashboard' , 'refresh');
				else if ($this->session->userdata('login_type') == 0)
					redirect(base_url().'index.php?browse/doswitch/user1' , 'refresh');
					//redirect(base_url().'index.php?browse/switchprofile' , 'refresh');
			}
			else if ($signin_result == false)
				redirect(base_url().'index.php?home/signin' , 'refresh');
		}
		$page_data['page_name']		=	'signin';
		$page_data['page_title']	=	'Нэвтрэх';
		$this->load->view('frontend/index', $page_data);
	}
	
	function forget()
	{
		$this->login_check();
		if (isset($_POST) && !empty($_POST))
		{
			$signup_result = $this->email_model->reset_password();
			redirect(base_url().'index.php?home/forget' , 'refresh');
		}
		$page_data['page_name']		=	'forget';
		$page_data['page_title']	=	'Нууц үг сэргээх';
		$this->load->view('frontend/index', $page_data);
		
	}
	
	function signout()
	{
		$this->session->set_userdata('user_login_status', '');
        $this->session->set_userdata('user_id', '');
        $this->session->set_userdata('login_type', '');
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url().'index.php?home', 'refresh');
	}
	
	
	
	
	function login_check()
	{
		if ($this->session->userdata('user_login_status') == 1)
			redirect(base_url().'index.php?browse/home' , 'refresh');
	}
	
	function isLoggedIn()
	{
		return $this->session->userdata('user_login_status') == 1;
	}

}
