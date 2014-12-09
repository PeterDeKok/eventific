<?php
$root = $_SERVER['DOCUMENT_ROOT']."/..";
include_once $root . '/assets/includes/functions.php';
include_once $root . '/assets/includes/register.inc.php';
sec_session_start();
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
    header('location: /index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Event Management System">
    <meta name="author" content="Web Technology Group 5">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title> Event Management System</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/icomoon.css">
    <link href="assets/css/animate-custom.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>
    
    <script src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/modernizr.custom.js"></script>
	<script type="text/javascript" src="assets/js/forms.js"></script>
	<script type="text/javascript" src="assets/js/sha512.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body data-spy="scroll" data-offset="0" data-target="#navbar-main">
  
  
  	<div id="navbar-main">
      <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon icon-shield" style="font-size:30px; color:#3498db;"></span>
          </button>
          <a class="navbar-brand hidden-xs hidden-sm" href="index.php#home"><span class="icon icon-lamp" style="font-size:18px; color:#3498db;"></span></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php#home" class="smoothScroll">Home</a></li>
			<li> <a href="index.php#about" class="smoothScroll"> About Us</a></li>
			<li> <a href="index.php#services" class="smoothScroll"> E-ticketing</a></li>
			<li> <a href="index.php#team" class="smoothScroll"> Team</a></li>
			<li> <a href="index.php#blog" class="smoothScroll"> Stories</a></li>
			<li> <a href="index.php#contact" class="smoothScroll"> Contact</a></li>
		  </ul>
		  <ul class="nav navbar-nav pull-right">
			<li><a href="#"> Welcome <?php echo $_SESSION['username']; ?></a></li>
			<li><a href="/assets/includes/logout.php">Log out</a></li>
		  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    </div>  

    <!-- ==== ABOUT ==== -->
	<div class="container" id="about" name="about">
		<div class="row white">
		<br>
			<h1 class="centered">Welcome <?php echo $_SESSION['username']; ?></h1>
			<hr>
			<div class="col-lg-4">
				<h2 class="text-center">Attended events</h2>
				<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, nulla non accumsan facilisis, magna justo auctor ante, id porta nunc sem at libero. Vivamus sit amet lectus quam. Nunc ut orci ut sapien volutpat blandit. Vivamus auctor ante ante. Morbi faucibus mauris non volutpat suscipit. Vivamus ac hendrerit arcu, eu aliquet nisl. Nunc risus urna, condimentum elementum neque id, tincidunt hendrerit ligula.</p>
			</div><!-- col-lg-4 -->	
			<div class="col-lg-4">
				<h2 class="text-center">Hosted events</h2>
				<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, nulla non accumsan facilisis, magna justo auctor ante, id porta nunc sem at libero. Vivamus sit amet lectus quam. Nunc ut orci ut sapien volutpat blandit. Vivamus auctor ante ante. Morbi faucibus mauris non volutpat suscipit. Vivamus ac hendrerit arcu, eu aliquet nisl. Nunc risus urna, condimentum elementum neque id, tincidunt hendrerit ligula.</p>
			</div><!-- col-lg-4 -->	
			<div class="col-lg-4">
				<h2 class="text-center">Interesting events</h2>
				<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, nulla non accumsan facilisis, magna justo auctor ante, id porta nunc sem at libero. Vivamus sit amet lectus quam. Nunc ut orci ut sapien volutpat blandit. Vivamus auctor ante ante. Morbi faucibus mauris non volutpat suscipit. Vivamus ac hendrerit arcu, eu aliquet nisl. Nunc risus urna, condimentum elementum neque id, tincidunt hendrerit ligula.</p>
			</div><!-- col-lg-4 -->	
		</div><!-- row -->
	</div><!-- container -->

	 
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
		

	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/retina.js"></script>
	<script type="text/javascript" src="assets/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="assets/js/smoothscroll.js"></script>
	<script type="text/javascript" src="assets/js/jquery-func.js"></script>
  </body>
</html>
