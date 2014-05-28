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

		
		$("a[name='remove']").click(remove_event);
		
		<?php
		if(isset($is_owner) && $is_owner)
		{
		?>
		
		$("#series_name").click(
			function(event)
			{
				var original_name, new_name, action_url, series_id;
				
				original_name=$(this).innerHTML;
				new_name=prompt("Please enter name of series", original_name);
				action_url="<?php echo site_url("content_controller/change_series_name"); ?>";
				series_id=<?php echo $series["id"]; ?>;

				if(new_name!=original_name)
				{
					$.ajax(
						{
							url: action_url,
							data: {sid: series_id, name: new_name},
							type: "POST",
							async: true,
							dataType: "text",
							success: function()
							{
								$("#series_name").html(new_name);
							},
							error: function(xhr, ajaxOptions, thrownError)
							{
								//textarea_object.val(textarea_object.attr("temp_save"));
							},
						
						}
					);
				}
			}
		);
		
		<?php
		} // end of if(isset($is_owner) && $is_owner)
		?>
		
		
		var auth = "<?php echo $series["public"]; ?>";
		
		if(auth=="public")
		{
			$("#public_select").val(0);
		}
		else if(auth=="private")
		{
			$("#public_select").val(1);
		}
		else if(auth=="editable")
		{
			$("#public_select").val(2);
		}
		else if(auth=="deletable")
		{
			$("#public_select").val(3);
		}
		
		
		$("#public_select").change(
			function()
			{
				action_url="<?php echo site_url("content_controller/change_auth"); ?>";
				series_id=<?php echo $series["id"]; ?>;
				
				$.ajax(
					{
						url: action_url,
						data: {sid: series_id, auth: $(this).find(":selected").text()},
						type: "POST",
						async: true,
						dataType: "text",
						success: function()
						{
							//alert("success");
						},
						error: function(xhr, ajaxOptions, thrownError)
						{
							//var err = eval("(" + xhr.responseText + ")");
							alert(xhr.responseText);
						},
					
					}
				);
			}
		);
		
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
				
				<?php
				
				if(isset($is_owner) && $is_owner)
				{
				echo '<br/>';
				echo '<br/>';
				echo '<div>authorization</div>';
				echo '<select id="public_select">';
					echo '<option value="0">public</option>';
					echo '<option value="1">private</option>';
					echo '<option value="2">editable</option>';
					echo '<option value="3">deletable</option>';
				echo '</select>';
				}
				
				?>
				
				
				
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

						if($series["public"]=="public" || (isset($is_owner) && $is_owner))
						{
							echo '<a name="edit" href="#" status="done" ><span class="glyphicon glyphicon-pencil"></span></a>';
							echo '<a href=';
							echo site_url("content_controller/delete_image/{$series["id"]}/{$image["id"]}");// ??????
							echo ' name="remove" ><span class="glyphicon glyphicon-remove"></span></a>';
						}
						else if($series["public"]=="editable")
						{
							echo '<a name="edit" href="#" status="done" ><span class="glyphicon glyphicon-pencil"></span></a>';
						}
						else if($series["public"]=="deletable")
						{
							echo '<a href=';
							echo site_url("content_controller/delete_image/{$series["id"]}/{$image["id"]}");// ??????
							echo ' name="remove" ><span class="glyphicon glyphicon-remove"></span></a>';
						}
						else if($series["public"]=="private")
						{
						}
						
						
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