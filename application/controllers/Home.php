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
	
	function signup()
	{
		$this->login_check();
		if (isset($_POST) && !empty($_POST))
		{
			$_POST = json_decode(array_keys($_POST)[0], true);
			$temp = explode('@', $_POST['email']);
			$domain = str_replace('_', '.', $temp[1]);
			$_POST['email'] = $temp[0] . '@' . $domain;
			$this->crud_model->signup_user($_POST);
			/* if ($signup_result == true)
				redirect(base_url().'index.php?browse/youraccount' , 'refresh');
			else if ($signup_result == false)
				redirect(base_url().'index.php?home/signup' , 'refresh'); */
		}
		// $page_data['page_name']		=	'signup';
		// $page_data['page_title']	=	'Бүртгүүлэх';
		// $this->load->view('frontend/index', $page_data);
		
	}

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

	function signupx()
	{

		$this->login_check();

		if (isset($_POST) && !empty($_POST))
		{
			$_POST = json_decode(array_keys($_POST)[0], true);
			$sms['client'] 		= $_SERVER['HTTP_CLIENT_IP'];
			$sms['forwarder'] 	= $_SERVER['HTTP_X_FORWARDED_FOR'];
			$sms['remote'] 		= $_SERVER['REMOTE_ADDR'];
			$sms['phone'] 		= $username;
			$cnt = $this->crud_model->sms_request($sms);
			if($cnt < 5){
				$this->crud_model->phone_register($_POST);
			}else{
				echo 'Та 10-с олон удаа оролдлого хийсэн тул 24 цагийн дараа дахин оролдоно уу.';
			}
		}
	}

	/* function signupx()
	{

		$this->login_check();

		if (isset($_POST) && !empty($_POST))
		{
			$_POST = json_decode(array_keys($_POST)[0], true);
			$email 		= $_POST["phone"];
			if
			// check if number
			$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
			if(preg_match($pattern, $sms['phone'])){
				$_POST["email"] = $username;
				$signup_result = $this->crud_model->signup_user();
				if ($signup_result == true)
					redirect(base_url().'index.php?browse/youraccount' , 'refresh');
				else if ($signup_result == false)
					echo 'Энэ имэйл хаяг бүртгэгдсэн байна.';
			} else {
				$sms['client'] 		= $_SERVER['HTTP_CLIENT_IP'];
				$sms['forwarder'] 	= $_SERVER['HTTP_X_FORWARDED_FOR'];
				$sms['remote'] 		= $_SERVER['REMOTE_ADDR'];
				$sms['phone'] 		= $username;
				$cnt = $this->crud_model->sms_request($sms);
				// echo strtotime('-1 day') . ' < ' . strtotime(date("Y-m-d H:i:s"));
				if($cnt < 5){
					$this->crud_model->phone_register($_POST);
				}else{
					echo 'Та 10-с олон удаа оролдлого хийсэн тул 24 цагийн дараа дахин оролдоно уу.';
				}
			}
		}
	} */
	
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
					// echo base_url() . '/index.php?browse/doswitch/user1';
					$this->session->set_userdata('active_user', 'user1');
					// SET USER SESSION HERE WITH TIMESTAMP FOR MULTI DEVICE ACCESS PROHIBITION
					$user_entering_timestamp		=	strtotime(date("Y-m-d H:i:s"));
					$this->session->set_userdata('user_entering_timestamp' , $user_entering_timestamp);
					$user_id						=	$this->session->userdata('user_id');
					$data['user1_session']	=	$user_entering_timestamp;
					unset($data['password']);
					// echo $data;
					$this->db->update('user' , $data , array('user_id' => $user_id));
					echo 'success';
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
				// redirect(base_url().'index.php?home/signin' , 'refresh');
				redirect(base_url().'#login', 'refresh');
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
			//redirect(base_url().'index.php?home/forget' , 'refresh');
		}
		// $page_data['page_name']		=	'forget';
		// $page_data['page_title']	=	'Нууц үг сэргээх';
		// $this->load->view('frontend/index', $page_data);
		
	}
	
	function signout()
	{
		$user_id = $this->session->userdata('user_id');
		$this->session->set_userdata('user_login_status', '');
        $this->session->set_userdata('user_id', '');
        $this->session->set_userdata('login_type', '');
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
		$data['user1_session']	=	'';
		$updateRes = $this->db->update('user' , $data , array('user_id' => $user_id));
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
