<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Browse extends CI_Controller {

	// constructor
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		//$this->login_check();

		$called_function	=	$this->router->fetch_method();
		
		// CHECK IF SAME USER HAS LOGGEDIN FROM DIFFERENT DEVICE/SESSION
		// CHECK IF USER HAS ACTIVE SUBSCRIPTION
		// CHECK IF USER HAS ACTIVE SUBSCRIPTION, THEN IS THERE ANY ACTIVE USER
		if(/* $called_function == 'search' || */ $called_function == 'process_list' || /* $called_function == 'home' || */ 
		  		/* $called_function == 'movie' || */ $called_function == 'mylist' || /* $called_function == 'series' ||  */
		  		$called_function == 'playmovie' || $called_function == 'playseries' || $called_function == 'playanime') {
			$this->login_check();
			$this->subscription_check();
			$this->multi_device_access_check();
			$this->active_user_check();
		}
		
		// CHECK IF SAME USER HAS LOGGEDIN FROM DIFFERENT DEVICE/SESSION
		if($called_function == 'search' || $called_function == 'process_list' || $called_function == 'home' || 
		  		$called_function == 'movie' || $called_function == 'mylist' || $called_function == 'series' || 
		  		$called_function == 'playmovie' || $called_function == 'playseries' || $called_function == 'playanime') {
			
		}
	}
	
	
	
	function search($search_key = '')
	{
		if (isset($_POST) && !empty($_POST))
		{
			$search_key = $this->input->post('search_key');
			redirect(base_url().'index.php?browse/search/'.$search_key , 'refresh');
		}
		$page_data['page_name']		=	'search';
		$page_data['search_key']	=	$search_key;
		$page_data['page_title']	=	'Хайлтын үр дүн';
		$this->load->view('frontend/index', $page_data);
		
	}

	function process_list($type = '', $task = '', $id = '')
	{

		// Getting the active user and user account id
		$user_id 		=	$this->session->userdata('user_id');
		$active_user 	=	$this->session->userdata('active_user');

		// Choosing the list between movie and series
		if ($type == 'movie')
			$list_field	=	$active_user.'_movielist';
		else if ($type == 'series')
			$list_field	=	$active_user.'_serieslist';
		

		// Getting the old list	
		$old_list	=	$this->db->get_where('user', array('user_id'=>$user_id))->row()->$list_field;
		if ($old_list == NULL)
			$old_list = '[]';
		$old_list_array	=	json_decode($old_list);

		// Adding the new element to old list
		if ($task == 'add')
		{
			if (!in_array($id, $old_list_array))
			{
				array_push($old_list_array , $id);
			}
			
			$new_list	=	json_encode($old_list_array);
		}

		//Delete the submitted element from old list
		else if ($task == 'delete')
		{
			if (in_array($id, $old_list_array))
			{
				$key		=	array_search($id, $old_list_array);
				unset($old_list_array[$key]);
			}
			
			$new_list_array	=	array_values($old_list_array);
			$new_list	=	json_encode($new_list_array);
		}

		// Push back the new list to old place and update db table
		$this->db->update('user' , array($list_field => $new_list) , array('user_id' => $user_id));
		print_r($new_list);
	}
	
	function home()
	{
		$this->subscription_check();
		$this->active_user_check();
		$page_data['page_name']		=	'home';
		$page_data['page_title']	=	'Эхлэл';
		$this->load->view('frontend/index', $page_data);
	}
	
	function movie($genre_id = '', $offset = '')
	{
		$page_data['page_name']		=	'movie';
		$page_data['page_title']	=	'Кино үзэх';
		$page_data['genre_id']	=	$genre_id;
		
		// pagination configuration
		$url = base_url() . 'index.php?browse/movie/' . $genre_id;
        $per_page = 24;
		$this->db->where('genre_id' , $genre_id);
        $total_result = $this->db->count_all_results('movie');
        $config = $this->crud_model->paginate($url, $total_result, $per_page, 4);
        $this->pagination->initialize($config);

        $page_data['movies'] = $this->crud_model->get_movies($genre_id , $per_page, $this->uri->segment(4));
		$page_data['total_result']	=	$total_result;
		
		$this->load->view('frontend/index', $page_data);
	}

	function mylist()
	{
		$page_data['page_name']		=	'mylist';
		$page_data['page_title']	=	'Миний хадгалсан';
		$this->load->view('frontend/index', $page_data);
	}
	
	function series($genre_id = '', $offset = '')
	{
		$page_data['page_name']		=	'series';
		$page_data['page_title']	=	'Цувралууд';
		$page_data['genre_id']	=	$genre_id;
		
		// pagination configuration
		$url = base_url() . 'index.php?browse/series/' . $genre_id;
        $per_page = 24;
		$this->db->where('genre_id' , $genre_id);
        $total_result = $this->db->count_all_results('series');
        $config = $this->crud_model->paginate($url, $total_result, $per_page, 4);
        $this->pagination->initialize($config);

        $page_data['series'] = $this->crud_model->get_series($genre_id , $per_page, $this->uri->segment(4));
		$page_data['total_result']	=	$total_result;
		$page_data['type'] = 'series';
		$this->load->view('frontend/index', $page_data);
	}

	function animes($genre_id = '', $offset = '')
	{
		$page_data['page_name']		=	'series';
		$page_data['page_title']	=	'Анимэ';
		$page_data['genre_id']	=	$genre_id;
		// pagination configuration
		$url = base_url() . 'index.php?browse/animes/' . $genre_id;
        $per_page = 24;
		$this->db->where('genre_id' , $genre_id)->where('type', 1);
        $total_result = $this->db->count_all_results('series');
        $config = $this->crud_model->paginate($url, $total_result, $per_page, 4);
        $this->pagination->initialize($config);

        $page_data['series'] = $this->crud_model->get_animes($genre_id , $per_page, $this->uri->segment(4));
		$page_data['total_result']	=	$total_result;
		$page_data['type'] = 'anime';
		$this->load->view('frontend/index', $page_data);
	}
	
	function playmovie($movie_id = '')
	{
		$page_data['page_name']		=	'playmovie';
		$page_data['page_title']	=	'Кино үзэх';
		$page_data['movie_id']		=	$movie_id;
		$this->load->view('frontend/index', $page_data);
	}
	
	function playseries($series_id = '', $season_id = '')
	{
		if ($season_id == '')
		{
        	$seasons	=	$this->db->get_where('season', array('series_id'=>$series_id))->result_array();
			foreach ($seasons as $row)
			{
				$first_season_id	=	$row['season_id'];
				break;
			}
			$page_data['season_id']		=	$first_season_id;
		}
		else 
			$page_data['season_id']		=	$season_id;
		
		$page_data['series_id']		=	$series_id;
		$page_data['page_name']		=	'playseries';
		$page_data['page_title']	=	'Цуврал үзэх';
		$page_data['poster']    	= 	$this->crud_model->get_thumb_url('series' , $series_id);
		// $page_data['series_id']		=	$series_id;
		$episodes = $this->crud_model->get_episodes_of_season($page_data['season_id']);
		for ($i=0; $i < count($episodes) - 1; $i++) { 
			$episodes[$i]['poster'] = $this->crud_model->get_thumb_url('episode' , $episodes['episode_id']);
			$episodes[$i]['qlt'] 	= json_decode($episodes[$i]['qlt']);
		}
		$page_data['epison']		=	json_encode($episodes);
		$page_data['type'] = 'series';
		$this->load->view('frontend/index', $page_data);
	}

	function playanime($series_id = '', $season_id = '')
	{
		if ($season_id == '')
		{
        	$seasons	=	$this->db->get_where('season', array('series_id'=>$series_id))->result_array();
			foreach ($seasons as $row)
			{
				$first_season_id	=	$row['season_id'];
				break;
			}
			$page_data['season_id']		=	$first_season_id;
		}
		else 
			$page_data['season_id']		=	$season_id;
		
		$page_data['series_id']		=	$series_id;
		$page_data['page_name']		=	'playseries';
		$page_data['page_title']	=	'Анимэ үзэх';
		$page_data['poster']    	= 	$this->crud_model->get_thumb_url('series' , $series_id);
		// $page_data['series_id']		=	$series_id;
		$episodes = $this->crud_model->get_episodes_of_season($page_data['season_id']);
		for ($i=0; $i < count($episodes) - 1; $i++) { 
			$episodes[$i]['poster'] = $this->crud_model->get_thumb_url('episode' , $episodes['episode_id']);
		}
		$page_data['epison']		=	json_encode($episodes);
		$page_data['type'] = 'anime';
		$this->load->view('frontend/index', $page_data);
	}
	
	function youraccount()
	{
		$page_data['page_name']		=	'youraccount';
		$page_data['page_title']	=	'Миний бүртгэл';
		$this->load->view('frontend/index', $page_data);
	}
	
	function switchprofile()
	{
		$this->subscription_check();
		$page_data['page_name']			=	'switchprofile';
		$page_data['page_title']		=	'Профайл шилжих';
		$page_data['current_plan_id']	=	$this->crud_model->get_current_plan_id();
		$this->load->view('frontend/index', $page_data);
		
	}
	
	function doswitch($user_number)
	{
		$this->session->set_userdata('active_user', $user_number);
		// SET USER SESSION HERE WITH TIMESTAMP FOR MULTI DEVICE ACCESS PROHIBITION
		$user_entering_timestamp		=	strtotime(date("Y-m-d H:i:s"));
		$this->session->set_userdata('user_entering_timestamp' , $user_entering_timestamp);

		$user_id						=	$this->session->userdata('user_id');
		$data[$user_number.'_session']	=	$user_entering_timestamp;
		$this->db->update('user' , $data , array('user_id' => $user_id));

		redirect(base_url().'/' , 'refresh');
	}
	
	function manageprofile()
	{
		$this->subscription_check();
		$page_data['page_name']			=	'manageprofile';
		$page_data['page_title']		=	'Профайл';
		$page_data['current_plan_id']	=	$this->crud_model->get_current_plan_id();
		$this->load->view('frontend/index', $page_data);
		
	}
	
	function editprofile($user = '')
	{
		if (isset($_POST) && !empty($_POST))
		{
			$user_id 		=	$this->session->userdata('user_id');
			$user_field		=	$user;
			$username		=	$this->input->post('username');
			
			$this->db->update('user', array($user_field => $username), array('user_id' => $user_id));
			redirect(base_url().'index.php?browse/manageprofile' , 'refresh');
		}
		$page_data['page_name']			=	'editprofile';
		$page_data['page_title']		=	'Профайл засах';
		$page_data['user']				=	$user;
		$this->load->view('frontend/index', $page_data);
		
	}
	
	function emailchange()
	{
		if (isset($_POST) && !empty($_POST))
		{
			$user_id							=	$this->session->userdata('user_id');
			$old_password_encrypted				=	$this->crud_model->get_current_user_detail()->password;
			$old_password_submitted_encrypted	=	sha1($this->input->post('old_password'));
			$new_email							=	$this->input->post('new_email');
			
			// DUPLICATE EMAIL DENIES EMAIL CHANGE
			$this->db->where('email' , $new_email);
			$this->db->from('user');
        	$total_number_of_matching_user = $this->db->count_all_results();
			if ($total_number_of_matching_user > 0)
			{
				$this->session->set_flashdata('status', 'email_change_failed');
				redirect(base_url().'index.php?browse/emailchange' , 'refresh');
			}
			
			// CORRECT PASSWORD NEEDED TO CHANGE EMAIL
			if ($old_password_encrypted 		==	$old_password_submitted_encrypted)
			{
				$this->db->update('user', array('email'=>$new_email), array('user_id'=>$user_id));
				$this->session->set_flashdata('status', 'email_changed');
				redirect(base_url().'index.php?browse/youraccount' , 'refresh');
			}
			else
			{
				$this->session->set_flashdata('status', 'email_change_failed');
				redirect(base_url().'index.php?browse/emailchange' , 'refresh');
			}
			
			$this->db->update('user', array($user_field => $username), array('user_id' => $user_id));
			redirect(base_url().'index.php?browse/manageprofile' , 'refresh');
		}
		$page_data['page_name']			=	'emailchange';
		$page_data['page_title']		=	'Имэйл хаяг солих';
		$this->load->view('frontend/index', $page_data);
		
	}

	function phonechange()
	{
		if (isset($_POST) && !empty($_POST))
		{
			$user_id							=	$this->session->userdata('user_id');
			$old_password_encrypted				=	$this->crud_model->get_current_user_detail()->password;
			$old_password_submitted_encrypted	=	sha1($this->input->post('old_password'));
			$new_phone							=	$this->input->post('new_phone');
			
			$this->db->where('phone' , $new_phone);
			$this->db->from('user');
        	$total_number_of_matching_user = $this->db->count_all_results();
			if ($total_number_of_matching_user > 0)
			{
				$this->session->set_flashdata('status', 'phone_change_failed');
				redirect(base_url().'index.php?browse/phonechange' , 'refresh');
			}
			
			// CORRECT PASSWORD NEEDED TO CHANGE EMAIL
			if ($old_password_encrypted 		==	$old_password_submitted_encrypted)
			{
				$this->db->update('user', array('phone'=>$new_phone), array('user_id'=>$user_id));
				$this->session->set_flashdata('status', 'phone_changed');
				redirect(base_url().'index.php?browse/youraccount' , 'refresh');
			}
			else
			{
				$this->session->set_flashdata('status', 'phone_change_pass_failed');
				redirect(base_url().'index.php?browse/phonechange' , 'refresh');
			}
			
			// $this->db->update('user', array($user_field => $username), array('user_id' => $user_id));
			// redirect(base_url().'index.php?browse/manageprofile' , 'refresh');
		}
		$page_data['page_name']			=	'phonechange';
		$page_data['page_title']		=	'Утасны дугаараа солих';
		$this->load->view('frontend/index', $page_data);
		
	}
	
	function passwordchange()
	{
		if (isset($_POST) && !empty($_POST))
		{
			$user_id							=	$this->session->userdata('user_id');
			$old_password_encrypted				=	$this->crud_model->get_current_user_detail()->password;
			$old_password_submitted_encrypted	=	sha1($this->input->post('old_password'));
			$new_password						=	$this->input->post('new_password');
			$new_password_encrypted				=	sha1($this->input->post('new_password'));
			
			// NEW PASSWORD MUST BE 6 CHARACTER LONG
			if (strlen($new_password) <6)
			{
				$this->session->set_flashdata('status', 'password_change_failed');
				redirect(base_url().'index.php?browse/passwordchange' , 'refresh');
			}
			
			// CORRECT OLD PASSWORD NEEDED TO CHANGE PASSWORD
			if ($old_password_encrypted 		==	$old_password_submitted_encrypted)
			{
				$this->db->update('user', array('password'=>$new_password_encrypted), array('user_id'=>$user_id));
				$this->session->set_flashdata('status', 'password_changed');
				redirect(base_url().'index.php?browse/youraccount' , 'refresh');
			}
			else
			{
				$this->session->set_flashdata('status', 'password_change_failed');
				redirect(base_url().'index.php?browse/passwordchange' , 'refresh');
			}
			
			$this->db->update('user', array($user_field => $username), array('user_id' => $user_id));
			redirect(base_url().'index.php?browse/manageprofile' , 'refresh');
		}
		$page_data['page_name']			=	'passwordchange';
		$page_data['page_title']		=	'Нууц үг солих';
		$this->load->view('frontend/index', $page_data);
		
	}
	
	function cancelplan()
	{
		if (isset($_POST) && !empty($_POST))
		{
			$subscription_id	=	$this->crud_model->validate_subscription();
			$this->db->update('subscription', array('status' => 0), array('subscription_id' => $subscription_id));
			$this->session->set_flashdata('status', 'subscription_cancelled');
			redirect(base_url().'index.php?browse/youraccount' , 'refresh');
		}
		$page_data['page_name']			=	'cancelplan';
		$page_data['page_title']		=	'Цуцлах';
		$this->load->view('frontend/index', $page_data);
		
	}
	
	function purchaseplan()
	{
		if (isset($_POST) && !empty($_POST))
		{
			redirect(base_url().'index.php?browse/youraccount' , 'refresh');
		}
		$page_data['page_name']			=	'purchaseplan';
		$page_data['page_title']		=	'Эрх сунгах';
		$this->load->view('frontend/index', $page_data);
		
	}
	
	
	
	function billinghistory()
	{
		$page_data['page_name']		=	'billinghistory';
		$page_data['page_title']	=	'Төлбөрийн түүх';
		$this->load->view('frontend/index', $page_data);
	}
	
	// CHECK IF LOGGED IN USER ACCOUNT HAS SELECTED ANY OF HIS PROFILE(S), MUST BE CHECKED AFTER SUBSCRIPTION CHECK
	function active_user_check()
	{
		// admin can access all frontend pages
		if ($this->session->userdata('login_type') == 1)
			return;
		
		$active_user	=	$this->session->userdata('active_user');
		if ($active_user == '')
			redirect(base_url().'index.php?browse/switchprofile' , 'refresh');
	}
	
	// CHECK IF LOGGED IN USER HAS ACTIVE SUBSCRIPTION, IF NOT THEN REDIRECT TO ACCOUNT MANAGING PAGE
	function subscription_check()
	{
		// admin can access all frontend pages
		if ($this->session->userdata('login_type') == 1)
			return;
		
		$subscription_validation	=	$this->crud_model->validate_subscription();
		if ($subscription_validation == false)
			redirect(base_url().'index.php?browse/youraccount' , 'refresh');
	}
	
	function login_check()
	{
		//echo $this->session->userdata('user_login_status');die;
		if ($this->session->userdata('user_login_status') != 1){
			$path = str_replace('play', '', $_SERVER['REQUEST_URI']);
			redirect(base_url().$path.'#login', 'refresh');
		}
			// redirect(base_url().'index.php?home/signin' , 'refresh');
	}

	function multi_device_access_check()
	{
		// admin can access all frontend pages
		if ($this->session->userdata('login_type') == 1)
			return;
		
		// checking the same profile trying to access multiple devices/sessions
		$logged_in_user_id			=	$this->session->userdata('user_id');
		$active_user_session 		=	$this->session->userdata('active_user').'_session';
		$user_entering_db_timestamp	=	$this->db->get_where('user', array('user_id' => $logged_in_user_id))->row()->$active_user_session;

		$user_entering_timestamp	=	$this->session->userdata('user_entering_timestamp');

		if ($user_entering_timestamp != $user_entering_db_timestamp)
			redirect(base_url().'index.php?browse/switchprofile' , 'refresh');
	}


}
