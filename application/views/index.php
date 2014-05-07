<!doctype html>
<html lang="en">
<head>
	<?php
	
	if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"])
	{
		// set cookie???
	}
	
	?>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PluzBook</title>

	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href=<?php echo base_url("public_asset/css/untitled.css");?>>
	<!--
	<link rel="stylesheet" href="./css/untitled.css">
	-->
	
	<link rel="shortcut icon" href=<?php echo base_url("public_asset/favicon.ico");?>> 

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <a class="navbar-brand" href=<?php echo site_url(""); ?> >PluzBook</a>

    <ul class="nav navbar-nav navbar-right">
      <?php
      if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"])
      {
      	echo '<li><a href=';
      	echo site_url("users_controller/send_logout");
      	echo '>Log out</a></li>';
      
      }
      else 
      {
      	echo '<li><a href=';
      	echo site_url("users_controller/show_login_page");
      	echo '>Log in</a></li>';
      }
      ?>
      
    </ul>
  </div>
</nav>

<div class="intro">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="phone-main">
					<div class="phone-screen">
						<div id="carousel-example-generic" class="carousel slide phone-slide" data-ride="carousel">

						  <ol class="carousel-indicators">
						    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
						    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
						    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
						    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
						    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
						  </ol>

						  <div class="carousel-inner">
						    <div class="item active">
						      <img src=<?php echo base_url("public_asset/img/screen_00.png"); ?> >
						    </div>
						    <div class="item">
						      <img src=<?php echo base_url("public_asset/img/screen_01.png"); ?> >
						    </div>
						    <div class="item">
						      <img src=<?php echo base_url("public_asset/img/screen_02.png"); ?> >
						    </div>
						    <div class="item">
						      <img src=<?php echo base_url("public_asset/img/screen_03.png"); ?> >
						    </div>
						    <div class="item">
						      <img src=<?php echo base_url("public_asset/img/screen_04.png"); ?> >
						    </div>
						  </div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-5 col-md-offset-1">
				<div class="row primary-description">
					
				</div>
				<div class="row intro-btns">
					<div class="col-xs-6 app-download">
						<a href="#"><img src=<?php echo base_url("public_asset/img/google_play.png"); ?> ></a>
					</div>
					<div class="col-xs-6">
						<a href=<?php echo site_url("content_controller/show_content_page"); ?>><img src=<?php echo base_url("public_asset/img/upload_series.png"); ?> ></a>
					</div>
				</div>
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