<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('email');
    }
	
	function reset_password() {
		// Checking email existence
		$email		=	$this->input->post('email');
        $query 		=	$this->db->get_where('user', array('email' => $email));
			
        if ($query->num_rows() > 0) {
			
			// Saving the new password's hashed value into database
			$new_password = substr(md5(rand(100000000, 20000000000)), 0, 7);
        	$new_hashed_password = sha1($new_password);
			$this->db->update('user', array('password' => $new_hashed_password), array('email'=>$email));
			$this->session->set_flashdata('password_reset', 'success');
			
			// Sending user the notification email with new password
			$email_msg	=	"Таны шинэ нууц үг : ".$new_password;
			$email_sub	=	"Нууц үг шинэчлэх";
			$email_to	=	$email;
			$this->do_email($email_msg , $email_sub , $email_to);
        }
		else {
			$this->session->set_flashdata('password_reset', 'failed');
		}
	}
	
	function do_email($msg=NULL, $sub=NULL, $to=NULL, $from=NULL)
	{
		
		$config = array();
        $config['useragent']	= "CodeIgniter";
        $config['mailpath']		= "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']		= "smtp";
        $config['smtp_host']	= "localhost";
        $config['smtp_port']	= "25";
        $config['mailtype']		= 'html';
        $config['charset']		= 'utf-8';
        // $config['newline']		= "\r\n";
        $config['wordwrap']		= TRUE;

        $this->load->library('email');

        $this->email->initialize($config);
		$this->email->set_newline("\r\n");

		$site_name	=	'Neontoon.mn'; // $this->db->get_where('settings' , array('type' => 'site_name'))->row()->description;
		if($from == NULL){
			$from		=	'altanguerel@yahoo.com'; // $this->db->get_where('settings' , array('type' => 'site_email'))->row()->description;
		}
		/* $headers = 'From: webmaster@example.com' . "\r\n" .
		'Reply-To: webmaster@example.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion(); */
		/* $res = mail($to, $sub, $msg, $headers);
		echo 'res: ' . $res; */
		$this->email->from($from, $site_name);
		$this->email->to($to);
		$this->email->subject($sub);
		
		
		$this->email->message($msg);
		
		$this->email->send();
		
		echo $this->email->print_debugger();
	}
}
