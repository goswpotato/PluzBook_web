<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PluzBook</title>

	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href=<?php echo base_url("public_asset/css/untitled.css");?>>

	<link rel="shortcut icon" href=<?php echo base_url("public_asset/favicon.ico");?>>

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script src=<?php echo base_url("public_asset/js/content.js"); ?>></script>

	<script>

	$(document).ready(function(){
	  $imgHeight = $(".thumbnail img").height();
		$(".upload input[type='submit']").height($imgHeight-5);

		$(window).resize(function() {
		  $imgHeight = $(".thumbnail img").height();
			$(".upload input[type='submit']").height($imgHeight-5);
		});



		
		$("a[name='remove']").click(remove_event);
		$("input[name='submit']").click(check_series_name);
	});


	</script>

	

</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <a class="navbar-brand" href=<?php echo site_url(""); ?> >PluzBook</a>

    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
	      <a href="#" class="dropdown-toggle" data-toggle="dropdown">User <b class="caret"></b></a>
	      <ul class="dropdown-menu">
	        <li><a href=<?php echo site_url("users_controller/send_logout"); ?> >Log out</a></li>
	      </ul>
	    </li>
    </ul>
  </div>
</nav>

<div class="intro">
	<div class="container">
		<?php
		
		$i=0;
		
		if(isset($series))
		{
			
			foreach ($series as $item)
			{
				if($i%4==0)
				{
		echo '<div class="row">';
				}
				
			echo '<div class="col-sm-3 col-xs-6">';
			
				echo '<form action=';
				echo site_url("content_controller/series_operation");
				echo ' method="post" index=';
				echo $i;
				echo ' >';
				
					echo '<input type="hidden" name="sid" value=';
					echo $item["id"];
					echo '>';
			
					echo '<div class="thumbnail">';
						echo '<div class="cap-icons">';
							echo '<a href=';
							echo site_url("content_controller/show_series_page/{$item["id"]}");
							echo ' ><span class="glyphicon glyphicon-pencil"></span></a>';
							
							echo '<a href=';
							echo site_url("content_controller/delete_series/{$item["id"]}");
							echo ' name="remove" ><span class="glyphicon glyphicon-remove"></span></a>';
						echo '</div>';
						echo '<div class="caption">';
							echo '<h4><a href=';
							echo site_url("content_controller/show_series_page/{$item["id"]}");
							echo ' >';
							echo $item["name"];
							echo '</a></h4>';
						echo '</div>';
	
	
						echo '<a href=';
						echo site_url("content_controller/show_series_page/{$item["id"]}");
						echo ' >';
						
				if($item["cover_path"]!="")
				{
							echo '<img src=';
							echo base_url($item["cover_path"]);
							echo '>';
				}
				else
				{
							echo '<img src=';
							echo base_url("public_asset/img/dummy_img.png");
							echo ' >';
				}
						echo '</a>';
					
					echo '</div>'; //end of echo <div class="thumbnail">
					
					
				echo '</form>';
			echo '</div>'; // end of echo <div class="col-sm-3 col-xs-6">;
			
				if($i%4==3)
				{
		echo '</div>'; // end of <div class="row">
				}
				
				
				
				$i++;
			}
		}
		
		if($i!=16)
		{
			if($i%4==0)
			{
		echo '<div class="row">';
			}
			
			
			if($i==0)
			{
				echo '<div class="col-sm-3 col-xs-6" >';
					echo '<div class="thumbnail">';
						echo '<div class="cap-icons">';
							echo '<a href="#"><span class="glyphicon glyphicon-pencil"></span></a>';
							echo '<a href="#"><span class="glyphicon glyphicon-remove"></span></a>';
						echo '</div>';
						echo '<div class="caption">';
							echo '<h4><a href="series.html">Example</a></h4>';
						echo '</div>';
						echo '<a href="series.html"><img src=';
						echo base_url("public_asset/img/dummy_img.png");
						echo ' ></a>';
					echo '</div>';
				echo '</div>';
			}
			
			
			echo '<div class="col-sm-3 col-xs-6 upload">';
				echo '<div class="thumbnail">';
					echo '<form action=';
					echo site_url("content_controller/new_series");
	        		echo ' method="post" accept-charset="utf-8">';
						echo '<div class="caption">';
							echo '<h4><input type="text" name="new_series_name" placeholder="New series\' name"></h4>';
						echo '</div>';
				
						echo '<input type="submit" name="submit" value="Upload">';
					echo '</form>';
				echo '</div>';
			echo '</div>'; // end of <div class="col-sm-3 col-xs-6 upload">
			
			
		echo '</div>'; // end of <div class="row">
			
		}
		
		
		
		
		
		?>
		
	</div>
	
	<!-- others' series -->
	<div class="container">
	<?php	
		$i=0;
		
		if(isset($other_series))
		{
			foreach ($other_series as $item)
			{
				if($i%4==0)
				{
			echo '<div class="row">';
				}
				
				echo '<div class="col-sm-3 col-xs-6">';
				
					echo '<input type="hidden" name="sid" value=';
					echo $item["id"];
					echo '>';
					
					echo '<div class="thumbnail">';
						echo '<div class="cap-icons">';
							echo '<a href=';
							echo site_url("content_controller/show_series_page/{$item["id"]}");
							echo ' ><span class="glyphicon glyphicon-pencil"></span></a>';
						echo '</div>';
						echo '<div class="caption">';
							echo '<h4><a href=';
							echo site_url("content_controller/show_series_page/{$item["id"]}");
							echo ' >';
							echo $item["name"];
							echo '</a></h4>';
						echo '</div>';
				
				
						echo '<a href=';
						echo site_url("content_controller/show_series_page/{$item["id"]}");
						echo ' >';
				
				if($item["cover_path"]!="")
				{
							echo '<img src=';
							echo base_url($item["cover_path"]);
							echo '>';
				}
				else
				{
							echo '<img src=';
							echo base_url("public_asset/img/dummy_img.png");
							echo ' >';
				}
						echo '</a>';
					
					echo '</div>'; //end of echo <div class="thumbnail">
				echo '</div>'; // end of echo <div class="col-sm-3 col-xs-6">;
					
				if($i%4==3)
				{
					echo '</div>'; // end of <div class="row">
				}
				
				
				
				$i++;
			}
		}
		
		
		?>
		
	</div>
	
	
	
</div>

<nav class="navbar navbar-default footer" role="navigation">
  <div class="container text-center">
  	<p>(c) 2014 PluzLab - <a href="#">Privacy</a> - <a href="#">Term</a></p>
  </div>
</nav>
	
</body>
</html>