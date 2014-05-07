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
	<script src=<?php echo base_url("public_asset/js/series.js"); ?>></script>

	<script>

	$(document).ready(function(){
	  $imgHeight = $(".thumbnail img").height();
		$(".upload input[type='submit']").height($imgHeight-5);

		$(window).resize(function() {
		  $imgHeight = $(".thumbnail img").height();
			$(".upload input[type='submit']").height($imgHeight-5);
		});


		//$("input[name='edit']").click(edit_event);
		$("a[name='edit']").click(
			function(event)
			{
				var thumbnail_object;
				var p_object;
				var textarea_object;
				var text;
				
				thumbnail_object=$(this).parent().parent();
				
				if($(this).attr("status")=="done")
				{
					p_object=thumbnail_object.children("p");
					p_object.replaceWith("<textarea rows='3' placeholder='' ></textarea>");
					
					textarea_object=thumbnail_object.children("textarea");
					text=p_object.text();
					textarea_object.val("");
					textarea_object.focus();
					textarea_object.val(text);
					
					//textarea_object.attr("temp_save", text);????
					
					$(this).attr("status", "editing");
				}
				else if($(this).attr("status")=="editing")
				{
					textarea_object=thumbnail_object.children("textarea");
					textarea_object.replaceWith("<p>" + textarea_object.val() + "</p>");
	
					image_id=thumbnail_object.parent().children("input[name='iid']").val();
					action_url=$("#description_url").val();
					
					// Ajax by jQuery
					
					$.ajax(
						{
							url: action_url,
							data: {iid: image_id, description: textarea_object.val()},
							type: "POST",
							async: true,
							dataType: "text",
							success: function(description)
							{
								textarea_object.val(description);
							},
							error: function(xhr, ajaxOptions, thrownError)
							{
								textarea_object.val(textarea_object.attr("temp_save"));
							},
						
						}
					);
					
					$(this).attr("status", "done");
				}
				
				
			}
		);
		
		$("a[name='remove']").click(remove_check);
		//$("#series_name").click(edit_name);
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
	<input type="hidden" id="sid" value="<?php echo $series["id"]; ?>" >
	<input type="hidden" id="description_url" value="<?php echo site_url("content_controller/change_description"); ?>" >
	

	<div class="container">
		<div class="row thumbnail">

			<div class="col-sm-3">
				<div class="caption">
					<h4 id="series_name"><?php echo $series["name"]; ?></h4>
				</div>
				<form action=<?php echo site_url("content_controller/add_images"); ?> method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<input type="hidden" name="sid" value=<?php echo $series["id"]; ?> />
					<input type="file" name="upload_images[]" size="20" accept="image/*" multiple >
					<br/>
					<input type="submit" value="Upload" style="color: #aaa; background: #fff; border: #ccc 1px solid; border-radius: 3px; width: 80px; height: 40px;">
				</form>
			</div>

			<div class="col-sm-9 series-main">
			  <?php
			  
			  if(isset($images) && isset($series))
			  {
			  	// images don't need <row>
			  	
			  	foreach ($images as $image)
			  	{
			echo '<div class="col-md-3 col-sm-4 col-xs-6">';
			
				echo '<form action=';
				echo site_url("content_controller/image_operation");
				echo ' method="post" >';
				
					echo '<input type="hidden" name="iid" value=';
					echo $image["id"];
					echo '>';
					
					echo '<input type="hidden" name="description_url" value=';
					echo site_url("content_controller/change_description");
					echo '>';
					
			
				  	echo '<div class="thumbnail">';
				  		echo '<div class="cap-icons">';
					  		//echo '<input type="button" name="edit" status="done" ><span class="glyphicon glyphicon-pencil"></span></input>';
					  		//echo '<input type="submit" name="remove" ><span class="glyphicon glyphicon-remove"></span></input>';
				  		
				  			echo '<a name="edit" href="#" status="done" ><span class="glyphicon glyphicon-pencil"></span></a>';
				  			
				  			echo '<a href=';
				  			echo site_url("content_controller/delete_image/{$series["id"]}/{$image["id"]}");// ??????
				  			echo ' name="remove" ><span class="glyphicon glyphicon-remove"></span></a>';
				  			
				  		echo '</div>';
				  		echo '<img src=';
				  		echo base_url($image["path"]);
						echo ' >';
				  		echo '<p>';
				  		echo $image["description"];
						echo '</p>';
				  	echo '</div>';
			  	
			  	
			  	echo '</form>';
			  	
			echo '</div>';
			  	}
			  }
			  
			  ?>

			</div>

		</div>
	</div>
</div>

<nav class="navbar navbar-default footer" role="navigation">
  <div class="container text-center">
  	<p>(c) 2014 PluzLab - <a href="#">Privacy</a> - <a href="#">Term</a></p>
  </div>
</nav>
	
</body>
</html>