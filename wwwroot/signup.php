<?php

$root = $_SERVER['DOCUMENT_ROOT']."/..";
require_once($root . '/assets/includes/psl-config.php'); 

if(DEBUG) {
	ini_set("display_errors", "1");
	error_reporting(E_ALL);
}

require_once($root . '/assets/includes/classes/MysqliDb.class.php');
require_once($root . '/assets/includes/classes/session.class.php');

require_once($root . '/assets/includes/functions.php');
require_once($root . '/assets/includes/register.inc.php');

// Prepare Session
$session = new session(SESS_HOST, SESS_USER, SESS_PASSWORD, SESS_DATABASE);
// Start Session: true for https, false for http !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$session->start_session('_s', false);

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
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

    <title> Eventific</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/icomoon.css">
    <link href="assets/css/animate-custom.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>
    <script>var DEBUG = true;</script>
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
        </div><!--/.nav-collapse -->
      </div>
    </div>
    </div>  
	
	<div class="container">
		<div class="row white">
			<br /><br />
			<h1 class="centered">SIGN UP FOR AN ACCOUNT</h1>
			<hr />
		</div>
	</div>
	
	<div class="container" name="signup">	
	  <div class="row">
	    <div class="col-lg-offset-2 col-lg-8 text-center">
				<?php
		      if (!empty($error_msg)) {
		          echo $error_msg;
		      }
				?>
			</div>
			<div class="col-lg-offset-2 col-lg-8 text-center">
				<?php if (!($logged=='in')) { ?>
				
	      <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form" id="signup" role="form" class="eventform" enctype="multipart/form-data" validate>
					<div class="row control-group">
						<div class="form-group col-xs-12">
							<label>Username</label>
							<input type="text" name="username" id="username" class="form-control" placeholder="Username" required data-validation-required-message="A username is required" />
							<p class="help-block">Usernames may only contain upper and lower case letters, digits and underscores.</p>
							<p class="help-block text-danger"></p>
						</div>
					</div>
					<div class="row control-group">
						<div class="form-group col-xs-12">
							<label>Email</label>
							<input type="text" name="email" id="email" class="form-control" placeholder="Email" required data-validation-required-message="An email address is required" />
							<p class="help-block">Email addresses must have a valid email format.</p>
							<p class="help-block text-danger"></p>
						</div>
					</div>
					<div class="row control-group">
						<div class="form-group col-xs-12">
							<label>Password</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="Password" required data-validation-required-message="A password is required" />
							<p class="help-block">Passwords must be at least 6 characters long and contain at least an uppercase letter, a lowercase letter and a digit.</p>
							<p class="help-block text-danger"></p>
						</div>
					</div>
					<div class="row control-group">
						<div class="form-group col-xs-12">
							<label>Confirm password</label>
							<input type="password" name="confirmpwd" id="confirmpwd" class="form-control" placeholder="Conform password" required data-validation-required-message="A password is required" />
							<p class="help-block text-danger"></p>
						</div>
					</div>
					<div class="row control-group">
						<div class="form-group col-xs-12">
							<label>Profile picture</label>
							<input type="file" name="fileUser" id="fileUser" class="form-control" placeholder="Picture" />
							<p class="help-block">A profile picture needs to be smaller then 2Mb. We recommend a square image.</p>
							<p class="help-block text-danger"></p>
						</div>
					</div>
	        <br>
	        <div id="success"></div>
	        <div class="row">
	          <div class="form-group col-xs-12 submit">
	            <button type="submit" class="btn btn-success btn-lg">Sign Up</button>
	          </div>
	        </div>
	    	</form>
				<br />
        <p>Return to the <a href="/index.php">Home page</a>.</p>
	    </div>
	  </div>

	</div><!-- /Container -->
										
										
										
										
	<?php 
		} else {
			header('location:index.php');
		}
	?>
	<div id="footerwrap">
		<div class="container">
					<span class="icon icon-home"></span> TU Eindhoven<br/>
					<span class="icon icon-phone"></span> +31 111 111 111 <br/>
					<span class="icon icon-mobile"></span> +31 101 101 101 <br/>
					<h4></a>Eventific - Copyright 2014  ©</h4>
					<span class="icon icon-envelop"></span> <a href="#"> info@eventific.com</a> <br/>
					<span class="icon icon-twitter"></span> <a href="#"> @eventific </a> <br/>
					<span class="icon icon-facebook"></span> <a href="#"> Eventific </a> <br/>
		</div>
	</div>
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
