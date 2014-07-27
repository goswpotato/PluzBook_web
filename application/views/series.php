<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PluzBook - 貼圖系列</title>

	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href=<?php echo base_url("public_asset/css/screen.css");?>>
	<link rel="shortcut icon" href=<?php echo base_url("public_asset/favicon.ico");?>>

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script src=<?php echo base_url("public_asset/js/series.js"); ?>></script>

	<script>

	function imgClip() {
		$wrapperWidth = $(".wrapper").width();
		$(".wrapper").height($wrapperWidth);

		$(".wrapper img").each(function() {

			$img = $(this);

	  	if ($img.width() >= $img.height()) {  		
	  		$img.height($wrapperWidth);
	  		$img.css('left', ($img.width()-$wrapperWidth)/2*(-1));
	  	}
	  	else {
	  		$img.width($wrapperWidth);
	  		$img.css('top', ($img.height()-$wrapperWidth)/2*(-1));
	  	}
		});
	}

	$(document).ready(imgClip);
	$(window).resize(imgClip);

	$(document).ready(function(){

		imgClip;

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
					$(this).css('color', '#6DD0CD');
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
					$(this).css('color', '#ccc');
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
		
		if(auth=="任何人")
		{
			$("#public_select").val(0);
		}
		else if(auth=="只有我")
		{
			$("#public_select").val(1);
		}
		else if(auth=="允許其他人投稿")
		{
			$("#public_select").val(2);
		}
		/*
		else if(auth=="deletable")
		{
			$("#public_select").val(3);
		}
		*/
		
		
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
		
		
		$("#upload_button").click(
			function(event)
			{
				event.preventDefault();
				
				var imageFiles = document.getElementById("file_chooser");
				filesLength = imageFiles.files.length;
				
				if(filesLength==0)
				{
					alert("please choose files.");
					return false;
				}
				else if(<?php echo count($images); ?> + filesLength > 16)
				{
					alert("the number of images in one series can't be more than 16!!");
					return false;
				}
				
				$("#upload_form").submit();
				
				return true;
			}
		);
		
		$('#file_chooser').change(function(){
			$fileList = $(this)[0].files;
			$('#file_chosen p').empty();

			for ($i = 0; $i < $fileList.length; $i++ ) {
				$('#file_chosen p').append($fileList[$i].name + '<br/>');
			}
		});
		
	}); // end of $(document).ready(function(){
	
	</script>

</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">

  	<a class="navbar-brand" href=<?php echo site_url(""); ?> >
    	<img src=<?php echo base_url("public_asset/img/logo_nav.png"); ?> class="logo">
    	PluzBook
    </a>
    
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
	      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION["email"]; ?><b class="caret"></b></a>
	      <ul class="dropdown-menu">
			<li><a href=<?php echo site_url("users_controller/show_change_page"); ?> >更改密碼</a></li>
	        <li><a href=<?php echo site_url("users_controller/send_logout"); ?> >登出</a></li>
	      </ul>
	    </li>
    </ul>

  </div>
</nav>

<div class="intro">
	<input type="hidden" id="sid" value="<?php echo $series["id"]; ?>" >
	<input type="hidden" id="description_url" value="<?php echo site_url("content_controller/change_description"); ?>" >
	
	<div class="container content-container">
		<div class="row">

			<div class="col-sm-3">
				<div class="caption">
					<h4 id="series_name"><?php echo $series["name"]; ?></h4>
				</div>

				<br/>
				<form action=<?php echo site_url("content_controller/add_images"); ?> method="post" accept-charset="utf-8" enctype="multipart/form-data" id="upload_form" >
					<input type="hidden" name="sid" value=<?php echo $series["id"]; ?> />
					<div id="file_chosen">
						<label class="file-btn">選擇檔案<input type="file" name="upload_images[]" size="20" accept="image/*" multiple id="file_chooser" /></label>
						<p></p>
					
						<input type="submit" value="上傳" style="color: #FFF; background: #6DD0CD; border: none; width: 100%; height: 40px;" id="upload_button"
					
						<?php
						if(count($images)>=16 || (!$is_owner && $series["public"]!="private"))
						{
							echo 'class="disabled" disabled';
						}
						?>
					
						/>
					</div>
					
				</form>
				
				<?php
				
				if(isset($is_owner) && $is_owner)
				{
					echo '<br/>';
					echo '<div><p>誰能修改這個系列？</p></div>';
					echo '<select id="public_select">';
						echo '<option value="0">任何人</option>';
						echo '<option value="1">只有我</option>';
						echo '<option value="2">允許其他人投稿</option>';
						//echo '<option value="3">deletable</option>';
					echo '</select>';
				}
				
				?>
			</div>

			<div class="col-sm-9 series-main">
			  <?php
			  
			  if(isset($images) && isset($series))
			  {
			  	echo '<div class="row">';
			  	foreach ($images as $key=>$image)
			  	{
						echo '<div class="col-md-3 col-xs-6">';
						
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
							echo '<a name="edit" href="#" status="done" ><span class="glyphicon glyphicon-pencil"></span></a> ';
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
			  		echo '<div class="wrapper"><img src=';
			  		echo base_url($image["path"]);
						echo ' ></div>';
			  		echo '<p>';
			  		echo $image["description"];
						echo '</p>';
				  	echo '</div>';
			  	
			  		echo '</form>';			  	
						echo '</div>';

						if ($key%4 == 3) {
			  			echo '</div><div class="row">';
			  		}
			  	}
			  	echo '</div>'; //end of row
			  }
			  
			  ?>

			</div>

		</div>
	</div>
</div>

<nav class="navbar navbar-default footer" role="navigation">
  <div class="container text-center">
  	<p>(c) 2014 PluzLab - <a href="#">Privacy</a> - <a href="<?php echo site_url("users_controller/show_term_page"); ?>" >Term</a></p>
  </div>
</nav>
	
</body>
</html>
