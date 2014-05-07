<?php

require APPPATH.'/libraries/REST_Controller.php';

class Restapi_controller extends REST_Controller
{
	function Restapi_controller()
	{
		parent::__construct();
		$this->load->model("Content_model");
		
		$this->load->helper('url');
	}
	
	function collections_get()
	{
		$response=[];
		
		$series=$this->Content_model->get_all_series();
		
		$offset=0;
		$limit=10;
		
		if(isset($_GET["offset"]))
		{
			$offset=$_GET["offset"];
		}
		if(isset($_GET["limit"]))
		{
			$limit=$_GET["limit"];
		}
		
		
		$count=0;
		foreach ($series as $item)
		{	
			if($count < $offset)
			{
				$count++;
				continue;
			}
			
			if($count >= $limit)
			{
				break;
			}
			
			$author=$this->Content_model->get_author($item["id"]);
			
			$response[$item["id"]]=array(
				"name" => $item["name"],
				"author" => $author["email"],
				"thumbnail" => base_url($item["cover_path"]),
				"rating" => 0
			);
			
			$count++;
		}
		
		
		//$encoded = json_encode($response);
		
		$this->response($response, 200);
	}
	
	function collection_get()
	{
		$this->load->model('Images_model');
		
		$series_id = $_GET["id"];
		$series = $this->Content_model->get_single_series($series_id);
		$images = $this->Content_model->get_images($series_id);
		$author = $this->Content_model->get_owner($series_id);
		
		$stickers = [];
		foreach ($images as $image)
		{
			$stickers[$image["description"]] = base_url($image["path"]);
		}
		
		$response=array(
			"name" => $series["name"],
			"author" => $author["email"],
			"thumbnail" => base_url($series["cover_path"]),
			"rating" => 0,
			"stickers" => $stickers
		);
		
		//$encoded = json_encode($response);
		
		$this->response($response, 200);
	}
}


?>