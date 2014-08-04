<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PluzBook <?php echo iconv("big5", "UTF-8", "Án©ú­¶­±"); ?></title>

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
  </div>
</nav>

<div class="intro">
	<div class="container content-container">
		<div class="row">
			<div class="col-sm-12">

				<img src=<?php echo base_url("public_asset/img/dummy_img.png"); ?> width="300">
				<!-- pic/illustration for term page -->

				<h3>Lorem ipsum dolor sit amet.</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima est rem dolore? Velit consequatur iusto quos, doloribus vitae et tempora nam, sequi, pariatur sed voluptas placeat reprehenderit ab corporis veniam mollitia reiciendis ipsum ea architecto dicta eaque. Quam cumque beatae magni nostrum, accusantium placeat dolor, repudiandae eveniet est ducimus rerum!</p>

				<ul>
					<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
					<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
					<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
				</ul>

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