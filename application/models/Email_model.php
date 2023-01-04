<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use MailerSend\MailerSend;
use MailerSend\Helpers\Builder\Recipient;
use MailerSend\Helpers\Builder\EmailParams;

class Email_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function reset_password($email) {
		// Checking email existence
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
		$mailersend = new MailerSend(['api_key' => 'key']);

		$recipients = [
			new Recipient($to, 'Your Client'),
		];

		$emailParams = (new EmailParams())
			->setFrom('admin@neontoon.mn')
			->setFromName('Neontoon.mn')
			->setSubject($sub)
			->setHtml($msg)
			// ->setText('This is the text content')
			->setReplyTo('admin@neontoon.mn')
			->setReplyToName('Neontoon.mn');

		$mailersend->email->send($emailParams);
	}
}
