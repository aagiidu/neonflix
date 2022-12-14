<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
	
	/* 
	* PLANS QUERIES 
	*/
	
	function get_active_plans() 
	{
		$this->db->where('status', 1);
		$query 		=	 $this->db->get('plan');
        return $query->result_array();
	}
	
	
	/*
	* USER QUERIES
	*/
	/* function signup_user() 
	{
		$data['email'] 		= $this->input->post('email');
		$data['password'] 	= sha1($this->input->post('password'));
		$data['type'] 		= 0; // user type = customer
		
		$this->db->where('email' , $data['email']);
		$this->db->from('user');
        $total_number_of_matching_user = $this->db->count_all_results();
		// validate if duplicate email exists
        if ($total_number_of_matching_user == 0) {
			$this->db->insert('user' , $data);
            $this->signin($this->input->post('email') , $this->input->post('password'));
			$this->session->set_flashdata('signup_result', 'success');
			return true;
        }
		else {
			$this->session->set_flashdata('signup_result', 'failed');
			return false;
		}
		
	} */

	function sms_request($data){
		$this->db->where('client', $data['client']);
		$this->db->where('forwarder', $data['forwarder']);
		$this->db->where('remote', $data['remote']);
		$this->db->where('date BETWEEN DATE_SUB(NOW(), INTERVAL 1 DAY) AND NOW()');
		$attempts = $this->db->get('sms');
		$cnt = count($attempts->result_array());
		if($cnt < 5){
			$this->db->insert('sms' , $data);
		}
		return $cnt;
	}

	function phone_register($data) 
	{
		// Verify hiigeegui bgaag shalgah
		$this->db->where('phone' , $data['phone']);
		$this->db->where('type' , 0);
		$this->db->where('verified' , 0);
		$unverified = $this->db->get('user');
		$otp = rand(1001, 9999);
		if($unverified->result_array() != null){
			$this->db->update('user', array('otp' => $otp), array('user_id' => $unverified->result_array()[0]["user_id"]));
		}else{
			$data['password'] 	= sha1($otp);
			$data['type'] 		= 0; 
			$data['otp'] 		= $otp; 
			$this->db->insert('user' , $data);
		}
		$msg = 'NEONTOON%20Код:%20' . $otp;
		try {
			$smsresult = $this->sendSms($data['phone'], $msg);
		} catch (\Throwable $th) {
			echo " --- Trowing --- ";
			echo $th;
			return;
		}
		
		if($smsresult == 1) {
			echo 'success';
		} else {
			echo 'Баталгаажуулах код илгээхэд алдаа гарлаа. Та дараа дахиад оролдоод үзнэ үү.';
		}
		/*$this->db->where('phone' , $data['phone']);
		$this->db->from('user');

        $total_number_of_matching_user = $this->db->count_all_results();
        if ($total_number_of_matching_user == 0) { 
			$this->sendSms($data['phone'], '4587');
			$data['password'] 	= sha1($this->input->post('password'));
			$this->db->insert('user' , $data);
			return true;
        } else { // Login
			$res["result"] = false;
			$res["error"] = "Утасны дугаар бүртгэлтэй байна"
			return ;
		} */
	}

	function verify_otp($data){
		$this->db->where('phone' , $data['phone']);
		//$this->db->where('type' , 0);
		//$this->db->where('verified' , 0);
		$unverified = $this->db->get('user');
		$user = $unverified->result_array()[0];
		//var_dump($user);
		if($user != null){
			if($user["otp"] == $data["otp"]){
				$t = time();
				$this->db->update('user', array('verified' => 1, 'verified_timestamp' => $t), array('phone' => $data['phone']));
				echo 'success';
			}else{
				echo 'Баталгаажуулах код таарахгүй байна.';
			}
		}else{
			echo 'Утасны дугаар олдсонгүй';
		}
	}

	function register_verified($data){
		$this->db->where('phone' , $data['phone']);
		$this->db->where('type' , 0);
		$temp = $this->db->get('user');
		$user = $temp->result_array()[0];
		if($user != null){
			//if ($user["verified"] == 1) {
				$data["password"] = sha1($data["password"]);
				$data["verified"] = 2;
				$data["name"] = $data["name"] != null && $data["name"] != "" ? $data["name"] : "User";
				$this->db->update('user', $data, array('phone' => $data['phone']));
				echo 'success';
			/* } elseif ($user["verified"] == 2){
				echo 'Таны бүртгэл өмнө нь баталгаажсан байна. Та утасны дугаар болон нууц үгээ ашиглан нэвтэрч орж болно.';
			} else {
				echo 'Алдаа гарлаа. Та дахиад бүртгүүлнэ үү.';
			} */
		}else{
			echo 'Бүртгэл олдсонгүй. Та дахиад бүртгүүлнэ үү.';
		}
	}

	function sendSms($phone, $msg)
	{
		$ch = curl_init();
		$headers = array(
		'Accept: application/json',
		'Content-Type: application/json',
		);
		// echo "http://web2sms.skytel.mn/apiSend?token=70fb2b4e964d80445473f637af13bc21e9db2b8c&sendto=" . $phone . "&message=" . $msg;
		curl_setopt($ch, CURLOPT_URL, "http://web2sms.skytel.mn/apiSend?token=70fb2b4e964d80445473f637af13bc21e9db2b8c&sendto=" . $phone . "&message=" . $msg);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		$res = curl_exec($ch);
		curl_close($ch);
		$r = json_decode($res);
		return $r->status;
	}

	// eniig ashiglahgui
	/* function signup_user() 
	{
		$data['phone'] 		= $this->input->post('phone');
		$data['password'] 	= sha1($this->input->post('password'));
		$data['type'] 		= 0; // user type = customer
		
		$this->db->where('phone' , $data['phone']);
		$this->db->from('user');
        $total_number_of_matching_user = $this->db->count_all_results();
		// validate if duplicate email exists
        if ($total_number_of_matching_user == 0) {
			$this->db->insert('user' , $data);
            // $this->signin($this->input->post('phone') , $this->input->post('password'));
			$this->session->set_flashdata('signup_result', 'success');
			return true;
        }
		else {
			$this->session->set_flashdata('signup_result', 'failed');
			return false;
		}
		
	} */
	
	function signin($phone, $password) 
	{
		//$credential = array('email' => $email, 'password' => sha1($password));
		$credential = array('phone' => $phone, 'password' => sha1($password));
		$query = $this->db->get_where('user', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('user_login_status', '1');
            $this->session->set_userdata('user_id', $row->user_id);
            $this->session->set_userdata('login_type', $row->type); // 1=admin, 0=customer
            return true;
        }
		else {
			$this->session->set_flashdata('signin_result', 'failed');
			return false;
		}
	}
	
	// returns currently active subscription_id, or false if no active found
	function validate_subscription() 
	{
		$user_id			=	$this->session->userdata('user_id');
		$timestamp_current	=	strtotime(date("Y-m-d H:i:s"));
		$this->db->where('user_id', $user_id);
		$this->db->where('timestamp_to >' ,  $timestamp_current);
		$this->db->where('timestamp_from <' ,  $timestamp_current);
		$this->db->where('status' ,  1);
		$query				=	$this->db->get('subscription');
		if ($query->num_rows() > 0) {
            $row = $query->row();
			$subscription_id	=	$row->subscription_id;
			return $subscription_id;
		}
        else if ($query->num_rows() == 0) {
			return false;
		}
	}
	
	function get_subscription_detail($subscription_id)
	{
		$this->db->where('subscription_id', $subscription_id);
		$query 		=	 $this->db->get('subscription');
        return $query->result_array();
	}
	
	function get_current_plan_id()
	{
		// CURRENT SUBSCRIPTION ID
		$subscription_id			=	$this->crud_model->validate_subscription();
		// CURRENT SUBSCCRIPTION DETAIL
		$subscription_detail		=	$this->crud_model->get_subscription_detail($subscription_id);
		foreach ($subscription_detail as $row)
			$current_plan_id		=	$row['plan_id'];
		return $current_plan_id;
	}
	
	function get_subscription_of_user($user_id = '')
	{
		$this->db->where('user_id', $user_id);
        $query = $this->db->get('subscription');
        return $query->result_array();
	}
	
	function get_active_plan_of_user($user_id = '') 
	{
		$timestamp_current	=	strtotime(date("Y-m-d H:i:s"));
		$this->db->where('user_id', $user_id);
		$this->db->where('timestamp_to >' ,  $timestamp_current);
		$this->db->where('timestamp_from <' ,  $timestamp_current);
		$this->db->where('status' ,  1);
		$query				=	$this->db->get('subscription');
		if ($query->num_rows() > 0) {
            $row = $query->row();
			$subscription_id	=	$row->subscription_id;
			return $subscription_id;
		}
        else if ($query->num_rows() == 0) {
			return false;
		}
	}
	
	function get_subscription_report($month, $year)
	{
		$first_day_this_month 			= 	date('01-m-Y' , strtotime($month." ".$year)); 
		$last_day_this_month  			= 	date('t-m-Y' , strtotime($month." ".$year));
		$timestamp_first_day_this_month	=	strtotime($first_day_this_month);
		$timestamp_last_day_this_month	=	strtotime($last_day_this_month);

		$this->db->where('payment_timestamp >' , $timestamp_first_day_this_month);
		$this->db->where('payment_timestamp <' , $timestamp_last_day_this_month);
		$subscriptions = $this->db->get('subscription')->result_array();
		
		return $subscriptions;
	}
	
	function get_current_user_detail()
	{
		$user_id	=	$this->session->userdata('user_id');
		$user_detail=	$this->db->get_where('user', array('user_id'=>$user_id))->row();
		return $user_detail;
	}
	
	function get_username_of_user($user_number)
	{
		$user_id	=	$this->session->userdata('user_id');
		$username	=	$this->db->get_where('user', array('user_id'=>$user_id))->row()->$user_number;
		return $username;
	}
	
	function get_genres() 
	{
		$query 		=	 $this->db->get('genre');
        return $query->result_array();
	}
	
	function paginate($base_url, $total_rows, $per_page, $uri_segment) 
	{
        $config = array('base_url' => $base_url,
            'total_rows' => $total_rows,
            'per_page' => $per_page,
            'uri_segment' => $uri_segment);

        $config['first_link'] = '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        return $config;
    }
	
	function get_movies($genre_id, $limit = NULL, $offset = 0) 
	{
        $this->db->order_by('movie_id', 'desc');
        $this->db->where('genre_id', $genre_id);
        $query = $this->db->get('movie', $limit, $offset);
        return $query->result_array();
    }
	
	function create_movie()
	{
		$data['title']				=	$this->input->post('title');
		$data['description_short']	=	'';
		$data['description_long']	=	$this->input->post('description_long');
		$data['year']				=	$this->input->post('year');
		$data['rating']				=	5; // $this->input->post('rating');
		$data['genre_id']			=	$this->input->post('genre_id');
		$data['featured']			=	$this->input->post('featured');
		$data['url']				=	$this->input->post('url');
		
		/* $actors						=	$this->input->post('actors');
		$actor_entries				=	array();
		$number_of_entries			=	sizeof($actors);
		for ($i = 0; $i < $number_of_entries ; $i++)
		{
			array_push($actor_entries, $actors[$i]);
		}
		$data['actors']				=	json_encode($actor_entries); */
		$data['actors']	= '[]';
		$this->db->insert('movie', $data);
		$movie_id = $this->db->insert_id();
		move_uploaded_file($_FILES['thumb']['tmp_name'], 'assets/global/movie_thumb/' . $movie_id . '.jpg');
		move_uploaded_file($_FILES['poster']['tmp_name'], 'assets/global/movie_poster/' . $movie_id . '.jpg');
	}
	
	function update_movie($movie_id = '')
	{
		$data['title']				=	$this->input->post('title');
		$data['description_short']	=	'';
		$data['description_long']	=	$this->input->post('description_long');
		$data['year']				=	$this->input->post('year');
		$data['rating']				=	$this->input->post('rating');
		$data['genre_id']			=	$this->input->post('genre_id');
		$data['featured']			=	$this->input->post('featured');
		$data['url']				=	$this->input->post('url');
		
		/* $actors						=	$this->input->post('actors');
		$actor_entries				=	array();
		$number_of_entries			=	sizeof($actors);
		for ($i = 0; $i < $number_of_entries ; $i++)
		{
			array_push($actor_entries, $actors[$i]);
		}
		$data['actors']				=	json_encode($actor_entries); */
		$data['actors']	= '[]';
		$this->db->update('movie', $data, array('movie_id'=>$movie_id));
		// move_uploaded_file($_FILES['thumb']['tmp_name'], 'assets/global/movie_thumb/' . $movie_id . '.jpg');
		// move_uploaded_file($_FILES['poster']['tmp_name'], 'assets/global/movie_poster/' . $movie_id . '.jpg');
		try {
			if(isset($_FILES['thumb']) && strlen($_FILES['thumb']['tmp_name']) > 0){
				$res1 = move_uploaded_file($_FILES['thumb']['tmp_name'], 'assets/global/movie_thumb/' . $movie_id . '.jpg');
			}
			if(isset($_FILES['poster']) && strlen($_FILES['poster']['tmp_name']) > 0){
				$res2 = move_uploaded_file($_FILES['poster']['tmp_name'], 'assets/global/movie_poster/' . $movie_id . '.jpg');	
			}
		} catch (\Throwable $th) {
			// do nothing
		}
	}
	
	function create_series()
	{
		$data['title']				=	$this->input->post('title');
		$data['description_short']	=	'';
		$data['description_long']	=	$this->input->post('description_long');
		$data['year']				=	$this->input->post('year');
		$data['rating']				=	$this->input->post('rating');
		$data['genre_id']			=	$this->input->post('genre_id');
		
		/* $actors						=	$this->input->post('actors');
		$actor_entries				=	array();
		$number_of_entries			=	sizeof($actors);
		for ($i = 0; $i < $number_of_entries ; $i++)
		{
			array_push($actor_entries, $actors[$i]);
		}
		$data['actors']				=	json_encode($actor_entries); */
		$data["type"]				=	$this->input->post('type');
		// var_dump($data);
		//die;
		$res = $this->db->insert('series', $data);
		$series_id = $this->db->insert_id();
		// echo $series_id;
		// echo '<hr />';
		// var_dump($_FILES);
		try {
			$res1 = move_uploaded_file($_FILES['thumb']['tmp_name'], 'assets/global/series_thumb/' . $series_id . '.jpg');
			$res2 = move_uploaded_file($_FILES['poster']['tmp_name'], 'assets/global/series_poster/' . $series_id . '.jpg');
		} catch (\Throwable $th) {
			// do nothing
		}
	}
	
	function update_series($series_id = '')
	{
		$data['title']				=	$this->input->post('title');
		$data['description_short']	=	'';
		$data['description_long']	=	$this->input->post('description_long');
		$data['year']				=	$this->input->post('year');
		$data['rating']				=	$this->input->post('rating');
		$data['genre_id']			=	$this->input->post('genre_id');
		
		// $actors						=	$this->input->post('actors');
		// $actor_entries				=	array();
		// $number_of_entries			=	sizeof($actors);
		// for ($i = 0; $i < $number_of_entries ; $i++)
		// {
		// 	array_push($actor_entries, $actors[$i]);
		// }
		// $data['actors']				=	json_encode($actor_entries);
		
		$this->db->update('series', $data, array('series_id'=>$series_id));
		// echo __DIR__;
		// echo '<hr />';
		// var_dump($_FILES);
		// echo '<hr />';
		try {
			if(isset($_FILES['thumb']) && strlen($_FILES['thumb']['tmp_name']) > 0){
				$res1 = move_uploaded_file($_FILES['thumb']['tmp_name'], 'assets/global/series_thumb/' . $series_id . '.jpg');
			}
			if(isset($_FILES['poster']) && strlen($_FILES['poster']['tmp_name']) > 0){
				$res2 = move_uploaded_file($_FILES['poster']['tmp_name'], 'assets/global/series_poster/' . $series_id . '.jpg');	
			}
		} catch (\Throwable $th) {
			// do nothing
		}
	}

	function get_animes($genre_id, $limit = NULL, $offset = 0) 
	{
        
        $this->db->order_by('series_id', 'desc');
        $this->db->where('genre_id', $genre_id);
		$this->db->where('type', 1);
        $query = $this->db->get('series', $limit, $offset);
        return $query->result_array();
    }
	
	function get_series($genre_id, $limit = NULL, $offset = 0) 
	{
        
        $this->db->order_by('series_id', 'desc');
        $this->db->where('genre_id', $genre_id);
		$this->db->where('type', 2);
        $query = $this->db->get('series', $limit, $offset);
        return $query->result_array();
    }
	
	function get_seasons_of_series($series_id = '') 
	{
		$this->db->order_by('season_id', 'desc');
        $this->db->where('series_id', $series_id);
        $query = $this->db->get('season');
        return $query->result_array();
	}
	
	function get_episodes_of_season($season_id = '') 
	{
		$this->db->order_by('episode_id', 'asc');
        $this->db->where('season_id', $season_id);
        $query = $this->db->get('episode');
        return $query->result_array();
	}
	
	function create_actor()
	{
		$data['name']				=	$this->input->post('name');		
		$this->db->insert('actor', $data);
		$actor_id = $this->db->insert_id();
		move_uploaded_file($_FILES['thumb']['tmp_name'], 'assets/global/actor/' . $actor_id . '.jpg');
	}
	
	function update_actor($actor_id = '')
	{
		$data['name']				=	$this->input->post('name');	
		$this->db->update('actor', $data, array('actor_id'=>$actor_id));
		move_uploaded_file($_FILES['thumb']['tmp_name'], 'assets/global/actor/' . $actor_id . '.jpg');
	}

    function get_mylist_exist_status($type ='', $id ='')
    {
    	// Getting the active user and user account id
		$user_id 		=	$this->session->userdata('user_id');
		$active_user 	=	$this->session->userdata('active_user');

		// Choosing the list between movie and series
		if ($type == 'movie')
			$list_field	=	$active_user.'_movielist';
		else if ($type == 'series')
			$list_field	=	$active_user.'_serieslist';

		// Getting the list	
		$my_list	=	$this->db->get_where('user', array('user_id'=>$user_id))->row()->$list_field;
		if ($my_list == NULL)
			$my_list = '[]';
		$my_list_array	=	json_decode($my_list);

		// Checking if the movie/series id exists in the active user mylist
		if (in_array($id, $my_list_array))
			return 'true';
		else
			return 'false';
    }
	
	function get_mylist($type = '')
	{
		// Getting the active user and user account id
		$user_id 		=	$this->session->userdata('user_id');
		$active_user 	=	$this->session->userdata('active_user');

		// Choosing the list between movie and series
		if ($type == 'movie')
			$list_field	=	$active_user.'_movielist';
		else if ($type == 'series')
			$list_field	=	$active_user.'_serieslist';

		// Getting the list	
		$my_list	=	$this->db->get_where('user', array('user_id'=>$user_id))->row()->$list_field;
		if ($my_list == NULL)
			$my_list = '[]';
		$my_list_array	=	json_decode($my_list);
		
		return $my_list_array;
	}
	
	function get_search_result($type = '', $search_key = '')
	{
		$this->db->like('title', $search_key);
		$query	=	$this->db->get($type);
		return $query->result_array();
	}
	
	function get_thumb_url($type = '' , $id = '') 
	{
        if (file_exists('assets/global/'.$type.'_thumb/' . $id . '.jpg'))
            $image_url = base_url() . 'assets/global/'.$type.'_thumb/' . $id . '.jpg';
        else
            $image_url = base_url() . 'assets/global/placeholder.jpg';

        return $image_url;
    }
	
	function get_poster_url($type = '' , $id = '') 
	{
        if (file_exists('assets/global/'.$type.'_poster/' . $id . '.jpg'))
            $image_url = base_url() . 'assets/global/'.$type.'_poster/' . $id . '.jpg';
        else
            $image_url = base_url() . 'assets/global/placeholder.jpg';

        return $image_url;
    }
	
	function get_actor_image_url($id = '') 
	{
        if (file_exists('assets/global/actor/' . $id . '.jpg'))
            $image_url = base_url() . 'assets/global/actor/' . $id . '.jpg';
        else
            $image_url = base_url() . 'assets/global/placeholder.jpg';

        return $image_url;
    }
	
	
	
	
	
	
}