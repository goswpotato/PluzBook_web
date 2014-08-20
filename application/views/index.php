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
	<link rel="stylesheet" href=<?php echo base_url("public_asset/css/screen.css");?>>
	<link rel="shortcut icon" href=<?php echo base_url("public_asset/favicon.ico");?>> 

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">

    <a class="navbar-brand" href=<?php echo site_url(""); ?> >
    	<img src=<?php echo base_url("public_asset/img/logo_nav.png"); ?> class="logo">
    	PluzBook
    </a>

    <ul class="nav navbar-nav navbar-right">
      <?php
      if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"])
      {
      	echo '<li><a href=';
      	echo site_url("users_controller/send_logout");
      	echo '>登出</a></li>';
      
      }
      else 
      {
      	echo '<li><a href=';
      	echo site_url("users_controller/show_login_page");
      	echo '>登入</a></li>';
      }
      ?>
      
    </ul>
  </div>
</nav>

<div class="intro">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4">
				<div class="phone-main">
					<img src=<?php echo base_url("public_asset/img/screen_top.png"); ?> >
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
					<img src=<?php echo base_url("public_asset/img/screen_bottom.png"); ?> >
				</div>
			</div>
			<div class="col-sm-6 col-md-6 col-md-offset-1">
				<div class="row primary-description">
					<div class="col-xs-12">
						<h1>PluzBook，橫空出世！</h1>
						<p>宇宙最便利的貼圖軟體，終於姍姍來遲了！可愛的貓咪、逗趣的插畫、甚至詼諧的八點檔，現在都將成為你貼圖聊天的囊中物。線上註冊帳號還能上傳自訂貼圖，你還在等什麼？</p>
					</div>
				</div>
				<div class="row intro-btns">
					<div class="col-xs-6 app-download">
						<a href="https://play.google.com/store/apps/details?id=com.pluzlab.pluzbookQQ"><img src=<?php echo base_url("public_asset/img/google_play.png"); ?> ></a>
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
  	<p>(c) 2014 PluzLab - <a href="#">Privacy</a> - <a href="<?php echo site_url("users_controller/show_term_page"); ?>" >Term</a></p>
  </div>
</nav>
	
</body>
</html>
