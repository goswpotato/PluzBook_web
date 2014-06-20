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
		if(document.getElementById("password").value==document.getElementById("re_password").value)
		{
			document.getElementById("sign_form").submit();

			return true;
		}

		alert("the password doesn't match");
		return false;
	}
		
	</script>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <a class="navbar-brand" href=<?php echo site_url(""); ?> >PluzBook</a>
  </div>
</nav>

<div class="intro">
	<div class="container">
		<div class="row">
			<div class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4">
			  <form class="user-form" action=<?php echo site_url("users_controller/send_signup"); ?> method="post" name="process" id="sign_form">
			    <input type="text" name="email" id="email" class="input-block-level input-top" placeholder="Email" size="25" autofocus="">
			    <input type="password" name="password" id="password" class="input-block-level input-btm" placeholder="Password" size="25">
			    <input type="password" name="re_password" id="re_password" class="input-block-level input-btm" placeholder="Password Again" size="25">

				<button class="btn pull-right" type="button" onclick="check_signup()" >Sign up</button>
			  </form>	
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