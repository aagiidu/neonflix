<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}

	public function sms($msg)
	{
		$log['client'] 		= $_SERVER['HTTP_CLIENT_IP'];
		$log['forwarder'] 	= $_SERVER['HTTP_X_FORWARDED_FOR'];
		$log['remote'] 		= $_SERVER['REMOTE_ADDR'];
		$log['params'] 		= 'test';
		$log['text'] 		= $msg;
		$this->db->insert('paylog' , $log);
		echo 'success';
	}

	public function token($uid)
	{
		
		$token = hash('sha256', $uid . time());
		$data['hash'] = $token;
		$this->db->update('user', $data, array('user_id' => $uid));
		echo $token;
	}

	function subscribe($amount, $token)
	{
		$user = $this->db->get_where('user', array('hash' => $token))->row();
		if($user == NULL){
			$log['client'] 		= $_SERVER['HTTP_CLIENT_IP'];
			$log['forwarder'] 	= $_SERVER['HTTP_X_FORWARDED_FOR'];
			$log['remote'] 		= $_SERVER['REMOTE_ADDR'];
			$log['params'] 		= $amount . '/' . $token;
			$log['text'] 		= 'Хэрэглэгч олдсонгүй';
			$this->db->insert('paylog' , $log);
			echo 'error';
			return;
		}

		$user_id = $user->user_id;
		$plan		=	$this->db->get_where('plan', array('price'		=> $amount))->row();

		if($plan == NULL){
			$log['client'] 		= $_SERVER['HTTP_CLIENT_IP'];
			$log['forwarder'] 	= $_SERVER['HTTP_X_FORWARDED_FOR'];
			$log['remote'] 		= $_SERVER['REMOTE_ADDR'];
			$log['params'] 		= $amount . '/' . $token;
			$log['text'] 		= 'Багц олдсонгүй';
			$this->db->insert('paylog' , $log);
			echo 'error';
			return;
		}

		$data['plan_id']			=	$plan->plan_id;
		$data['user_id']			=	$user_id;
		$data['paid_amount']		=	$amount;
		$data['payment_timestamp']	=	strtotime(date("Y-m-d H:i:s"));
		$data['timestamp_from']		=	strtotime(date("Y-m-d H:i:s"));
		
		$days = $plan->months * 31 - 1;

		$data['timestamp_to']		=	strtotime("+$days days", $data['timestamp_from']);
		$data['payment_method']		=	'bank';
		$data['payment_details']	=	'--';
		$data['status']				=	1;

		$this->db->insert('subscription' , $data);
		$this->db->update('user', Array('hash' => ''),  array('user_id' => $user_id));
		echo 'success';
	}

}
