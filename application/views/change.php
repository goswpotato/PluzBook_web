<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PluzBook</title>

	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href=<?php echo base_url("public_asset/css/screen.css");?>>
	<link rel="shortcut icon" href=<?php echo base_url("public_asset/favicon.ico");?>>

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script>

	$(document).ready(function(){
	  $imgHeight = $(".thumbnail img").height();
		$(".upload input[type='submit']").height($imgHeight-5);

		$(window).resize(function() {
		  $imgHeight = $(".thumbnail img").height();
			$(".upload input[type='submit']").height($imgHeight-5);
		});
	});

	function check_signup(object)
	{
		if(document.getElementById("new_password").value==document.getElementById("re_password").value)
		{
			document.getElementById("sign_form").submit();

			return true;
		}

		alert("密碼與確認密碼不一致，請重新輸入一次噢");
		return false;
	}
		
	</script>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <a class="navbar-brand" href=<?php echo site_url(""); ?> >
    	<img src=<?php echo base_url("public_asset/img/logo_nav.png"); ?> class="logo">
    	PluzBook
    </a>
  </div>
</nav>

<div class="intro">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-sm-offset-4">
			  <form class="user-form" action=<?php echo site_url("users_controller/change_password"); ?> method="post" name="process" id="sign_form">
			  	<h6>Change Password</h6>
			    <input type="password" name="old_password" class="input-block-level input-top" placeholder="舊密碼" size="25">
			    <input type="password" name="new_password" id="password" class="input-block-level" placeholder="新密碼" size="25">
			    <input type="password" name="re_password" id="re_password" class="input-block-level input-btm" placeholder="重新輸入新密碼" size="25">

				<button class="btn pull-right" type="submit" >更改！</button>
			  </form>	
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
