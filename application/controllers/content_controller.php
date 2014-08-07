<?php

class Content_controller extends CI_Controller
{
	function index()
	{
	}
	
	function Content_controller()
	{
		parent::__construct();
		
		$this->load->helper('file');
		$this->load->helper('url');
		$this->load->model('Content_model');
		
		if(session_id() == "" || !isset($_SESSION) || session_status() == PHP_SESSION_NONE)
		{
			// session hasn't started
			session_start();
		}
		
		// check whether logged user, put here then all request will be checked???
		if(!$this->is_login())
		{
			redirect("users_controller/show_login_page", "location");
		}
	}
	
	
	function is_login()
	{
		return isset($_SESSION["logged_in"]) && $_SESSION["logged_in"];
	}
	
	function show_content_page()
	{
		$user_id=$_SESSION["uid"];
		$data["series"]=$this->Content_model->get_series($user_id);
		$data["other_series"]=$this->Content_model->get_other_series($user_id);
		
		$this->load->view("content", $data);
	}
	
	function show_series_page($series_id)
	{
		$data["images"]=$this->Content_model->get_images($series_id);
		$data["series"]=$this->Content_model->get_single_series($series_id);
		
		if($data["series"]["uid"]==$_SESSION["uid"])
		{
			$data["is_owner"]=true;
		}
		else 
		{
			$data["is_owner"]=false;
		}
		
		
		$this->load->view("series", $data);
	}
	
	
	
	function new_series()
	{
		$name=$_POST["new_series_name"];
		if(!$this->Content_model->new_series($_SESSION["uid"], $_SESSION["email"], $name))
		{
		}
		
		redirect("content_controller/show_content_page", "location");
	}
	
	
	function series_operation()
	{
		if(isset($_POST["edit"]))
		{
			$this->show_series_page($_POST["sid"]);
		}
		else if(isset($_POST["remove"]))
		{
			$this->delete_series($_POST["sid"]);
		}
	}
	
	function image_operation()
	{
		if(isset($_POST["edit"]))
		{
			$this->save_descriptions($_POST["iid"], $_POST["descriptions"]);
		}
		else if(isset($_POST["remove"]))
		{
			$iids=array($_POST["iid"]);
			$sid=$_POST["sid"];
			$this->delete_images($sid, $iids);
		}
	}
	
	
	
	function delete_series($series_id)
	{
		if($this->Content_model->delete_series($_SESSION["uid"], $_SESSION["email"], $series_id))
		{
		}
		
		redirect("content_controller/show_content_page", "location");
	}
	
	function add_images()
	{
		// still needed to be edited
		
		$series_id=$_POST["sid"];
		$image_files = $_FILES["upload_images"];
		
		$msg=$this->Content_model->add_images($_SESSION["uid"], $series_id, $image_files);
		if($msg!="")
		{
			echo $msg;
			return false;
		}
		else
		{
			redirect("content_controller/show_series_page/{$series_id}", "location");
		}
		
		return true;
	}
	
	function change_description()
	{
		// still needed to be edited
		
		$image_id=$_POST["iid"];
		$description=$_POST["description"];
		$this->Content_model->change_description($image_id, $description);
		
		echo $description;
		
		//redirect("content_controller/show_series_page/{$series_id}", "location");
	}
	
	function delete_image($series_id, $image_id)
	{
		$iids=array($image_id);
		$sid=$series_id;
		$this->delete_images($sid, $iids);
	}
	
	function delete_images()
	{
		// still needed to be edited
		
		$series_id = $_POST["sid"];
		$image_ids = $_POST["iids"];
		
		$this->Content_model->delete_images($series_id, $image_ids);
		
		redirect("content_controller/show_series_page/{$series_id}", "location");
	}
	
	
	function change_series_name()
	{
		$series_id=$_POST["sid"];
		$new_name=$_POST["name"]; // use post?????
		
		$this->Content_model->change_series_name($series_id, $new_name, $_SESSION["email"]);
	}
	
	function change_series_cover()
	{
		$series_id=$_POST["sid"];
		$image_id=$_POST["iid"];
		
		$this->Content_model->change_series_cover($series_id, $image_id);
	}
	
	function change_auth()
	{
		$series_id=$_POST["sid"];
		$auth=$_POST["auth"];
		
		$this->Content_model->change_auth($series_id, $auth);
	}
	
}

?>