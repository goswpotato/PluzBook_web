<?php

class Users_controller extends CI_Controller
{
	function index()
	{
		$this->show_index_page();
	}
	
	function Users_controller()
	{
		parent::__construct();
		$this->load->model("Users_model");
		$this->load->helper("url");
		
		if(session_id() == "" || !isset($_SESSION) || session_status() == PHP_SESSION_NONE)
		{
			// session hasn't started
			session_start();
		}
	}
	
	
	function show_index_page()
	{
		$this->load->view("index");
	}
	
	function show_login_page()
	{
		// check here??
		if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"])
		{
			// has been logged in
			redirect("content_controller/show_content_page", "location");
		}
		else 
		{
			$this->load->view("login");
		}
	}
	
	function show_signup_page()
	{
		// check here??
		if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"])
		{
			// has been logged in
			redirect("content_controller/show_content_page", "location");
		}
		else 
		{
			$this->load->view("signup");
		}
	}
	
	function send_login()
	{
		$email=$_POST["email"];
		$password=$_POST["password"];
		//$email=$this->input->post("email");
		//$password=$this->input->post("password");
		
		$user=$this->Users_model->check_login($email, $password);
		
		if($user["msg"]=="success")
		{
			// login successfully
				
			/*
			 $newdata = array(
			 		'id' => $user['id'],
			 		'account'  => $user['account'],
			 		'logged_in' => true
			 );
				
			$this->session->set_userdata($newdata);
			*/
				
			$_SESSION["uid"] = $user["id"];
			$_SESSION["email"] = $user["email"];
			$_SESSION["logged_in"] = true;
				
			redirect("content_controller/show_content_page", "location");
		}
		else if($user["msg"]=="wrong password") 
		{
			$this->load->view("login");
		}
		else if($user["msg"]=="no user")
		{
			$this->load->view("login");
		}
		else if($user["msg"]=="this account hasn't been validated")
		{
			echo $user["msg"];
		}
		
	}
	
	function send_signup()
	{
		$email=$_POST["email"];
		$password=$_POST["password"];
		//$email=$this->input->post("email");
		//$password=$this->input->post("password");
		// we should check password by javascript?? 
		
		$user_msg=$this->Users_model->check_signup($email, $password);
		
		// still needed to be edited
		if($user_msg=="")
		{
			// no problem
			$this->send_validation_email($email);
			//redirect("users_controller/show_login_page", "location");
		}
		else
		{
			// login successfully
				
			/*
			 $newdata = array(
						'id' => $user['id'],
						'account'  => $user['account'],
						'logged_in' => true
			 );
				
			$this->session->set_userdata($newdata);
			*/
			
			
			echo $user_msg;
		}
	}
	
	function send_logout()
	{
		//$this->session->sess_destroy();
		
		unset($_SESSION["uid"]);
		unset($_SESSION["email"]);
		$_SESSION["logged_in"] = false;
		
		// still needed to be edited
		redirect("users_controller/show_login_page");
	}
	
	
	function show_term_page()
	{
		$this->load->view("term");
	}
	
	function show_change_page()
	{
		$this->load->view("change");
	}
	
	function change_password()
	{
		$user_id=$_SESSION["uid"];
		$old_password=$_POST["old_password"];
		$new_password=$_POST["new_password"];
		
		$msg=$this->Users_model->change_password($user_id, $old_password, $new_password);
		
		if($msg=="success")
		{
			redirect("users_controller/show_login_page", "location");
		}
		else if($msg=="wrong password") 
		{
			echo "your old password is wrong";
		}
	}
	
	function show_forget_page()
	{
		$this->load->view("forget");
	}
	
	function forget_password()
	{
		$user_email = $_POST["email"];
	
		$password_length = 8;
		$alphabets = "abcdefghijklmnopqrstuvwxyz0123456789";
		$length = strlen($alphabets);
		$rand_password = "";
		
		for ($i = 0; $i < $password_length; $i++)
		{
			$n = rand(0, $length-1);
			$rand_password = $rand_password . $alphabets[$n];
		}
    
		$msg=$this->Users_model->reset_password($user_email, $rand_password);
		
		if($msg!="")
		{
			echo $msg;
		}

		$subject = "Forget password in PluzBook";
		$message = "Please use this new password : " . $rand_password . " to login, and remember to change it to your own password.\n";
		$headers = "From: no-reply@pluzlab.com"  . "\r\n" . "X-Mailer: PHP/" . phpversion();

		mail($user_email, $subject, $message, $headers);
	}
	
	
	function show_validate_page($user_email)
	{
		$data["user_email"]=$user_email;
		$this->load->view("validate", $data);
	}
	
	function show_validated_page()
	{
		$this->load->view("validated");
	}
	
	function send_validation_email($user_email)
	{
		$rand_code="";
		$msg=$this->Users_model->get_validation_code($user_email);
		
		if($msg=="this account doesn't exist")
		{
		}
		else if($msg=="")
		{
			redirect("users_controller/show_login_page", "location");
			return;
		}
		else
		{
			$rand_code=$msg;
		}
		
		$validation_link=site_url("users_controller/account_validation/{$rand_code}/{$user_email}");
	
		$subject = "Email validation for PluzBook";
		$message = "Please use this link to activate your account : \n" . $validation_link;
		$headers = "From: no-reply@pluzlab.com"  . "\r\n" . "X-Mailer: PHP/" . phpversion();

		mail($user_email, $subject, $message, $headers);
		
		redirect("users_controller/show_validate_page/{$user_email}", "location");
	}
	
	function account_validation($code, $email)
	{
		$msg=$this->Users_model->account_validation($code, $email);
		
		if($msg=="")
		{
		}
		else
		{
			echo $msg;
		}
	}
	
	
}

?>