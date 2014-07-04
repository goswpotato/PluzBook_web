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
			redirect("content_controller/show_content_page", "refresh");
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
			redirect("content_controller/show_content_page", "refresh");
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
				
			redirect("content_controller/show_content_page", "refresh");
		}
		else if($user["msg"]=="wrong password") 
		{
			$this->load->view("login");
		}
		else if($user["msg"]=="no user")
		{
			$this->load->view("login");
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
			redirect("users_controller/show_login_page", "refresh");
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
	
}

?>