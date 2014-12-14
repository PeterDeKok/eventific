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
        </div><!--/.nav-collapse -->
      </div>
    </div>
    </div>  

    <!-- ==== ABOUT ==== -->
	<div class="container" id="about" name="about">
		<div class="row white">
		<br>
			<h1 class="centered">REGISTER WITH US</h1>
			<hr>
			<div class="col-lg-12">
		        <?php
		        if (!empty($error_msg)) {
		            echo $error_msg;
		        }

		        if (!($logged=='in')) {
		        ?>
		        <ul>
		            <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
		            <li>Emails must have a valid email format</li>
		            <li>Passwords must be at least 6 characters long</li>
		            <li>Passwords must contain
		                <ul>
		                    <li>At least one upper case letter (A..Z)</li>
		                    <li>At least one lower case letter (a..z)</li>
		                    <li>At least one number (0..9)</li>
		                </ul>
		            </li>
		            <li>Your password and confirmation must match exactly</li>
		        </ul>
		        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
		                method="post" 
		                name="registration_form">
		        		<table>
		                <tr><td>Username:</td> <td><input type='text' 
		                name='username' 
		                id='username' /><br></td></tr>
		                <tr><td>Email: </td> <td><input type="text" name="email" id="email" /><br></td></tr>
		                <tr><td>Password: </td><td><input type="password"
		                             name="password" 
		                             id="password"/><br></td></tr>
		                <tr><td>Confirm password: </td><td><input type="password" 
		                                     name="confirmpwd" 
		                                     id="confirmpwd" /><br></td></tr>
		                 <tr><td></td>
		                 <td><input type="button" 
		                   value="Register" 
		                   onclick="return regformhash(this.form,
		                                   this.form.username,
		                                   this.form.email,
		                                   this.form.password,
		                                   this.form.confirmpwd);" /></td></tr></table>
		        </form>
		        <p>Return to the <a href="index.php">Home page</a>.</p>
			        <?php 
			    	} else {
			    		header('location:index.php');
			    	}
			    	?>
			</div><!-- col-lg-12 -->	
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
