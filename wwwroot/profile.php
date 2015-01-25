<?php

$root = $_SERVER['DOCUMENT_ROOT']."/..";

require_once($root . '/assets/includes/psl-config.php'); 

if(DEBUG) {
	ini_set("display_errors", "1");
	error_reporting(E_ALL);
}

require_once($root . '/assets/includes/classes/MysqliDb.class.php');
require_once($root . '/assets/includes/classes/session.class.php');

require_once($root . '/assets/includes/db_connect.php');
require_once($root . '/assets/includes/functions.php');
require_once($root . '/assets/includes/register.inc.php');

// Prepare Session
$custom_session = new session(SESS_HOST, SESS_USER, SESS_PASSWORD, SESS_DATABASE);
// Start Session: true for https, false for http !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$custom_session->start_session('_s', false);

if ((login_check($mysqli) == true) && (!(isset($_SESSION['FB']) && isset($_SESSION['valid'])))) {
    $logged = 'in';
    $_SESSION['login_type'] = "Default";
} elseif ((isset($_SESSION['FB']) && isset($_SESSION['valid']))) { 
	if (($_SESSION['FB'] == true && $_SESSION['valid'] == true)) {
		if (login_check($mysqli)) {
			$logged='in';
			$_SESSION['login_type'] = "Both";
		} else {
			$logged='in';
			$_SESSION['login_type'] = "FB";
		}
	}	
} else {
    $logged = 'out';
    header("Location: /signup.php");
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
	              <li><a href="index.php#about" class="smoothScroll"> About Us</a></li>
	              <li><a href="index.php#services" class="smoothScroll"> E-ticketing</a></li>
	              <li><a href="index.php#team" class="smoothScroll"> Team</a></li>
	              <li><a href="index.php#blog" class="smoothScroll"> Stories</a></li>
	              <li><a href="index.php#contact" class="smoothScroll"> Contact</a></li>
	              <li role="presentation" class="divider"></li>
	              <?php
	              if ($logged=='in') {
	              ?>
	              <li><a href="/profile.php"> My Profile</a></li>
	              <li><a href="/redirect.php?action=logout">Log out</a></li>
	              <?php 
	                }
	              ?>
	              </ul>
	            </div><!--/.nav-collapse -->
	          </div>
	      </div>
	    </div>  							      
				
		<div id="headerwrap" name="profile">
			<p>Welcome to your Eventific account <?php echo $_SESSION['username']; ?></p>
			<p>&nbsp;</p>
			<div class="container"></div>
	  </div><!-- /headerwrap -->
		<div id="greywrap">
		
			<div class="row">
				<div class="col-lg-4 callout">
					<a href="/addevent.php"><span class="icon icon-plus"></span></a>
					<h2 class="text-center">Create an event</h2>
				</div>
				<?php
					if ((!isset($_SESSION['FB']))) { 
				?>
				<div class="col-lg-4 callout">
					<a href="/loginFB.php"><span class="icon icon-facebook"></span></a>
					<h2 class="text-center">Link a Facebook account</h2>
				</div><!-- col-lg-4 -->	
				<?php
					} else {
				?>
				<div class="col-lg-4 callout">
					<h2 class="text-center">Facebook account</h2>
					<p>Name: <?php echo $_SESSION['username']; ?><br />
					ID: <?php echo $_SESSION['id']; ?><br />
					<?php
					$friends = $_SESSION['user_friends'];
					echo "Friends: <br />";
					foreach ($friends as $i => $row) {
                        echo $row['name'];
                    }
					?></p>
				</div><!-- col-lg-4 -->	
				<?php
					}
				?>
				<div class="col-lg-4 callout">
					<a href="attendevent.php"><span class="icon icon-search"></span></a>
					<h2 class="text-center">Search events</h2>
				</div><!-- col-lg-4 -->	
			</div>
			<br>
		</div><!-- /greywrap -->
		
		<div class="container" id="profile" name="services">
			<h1 class="centered">Profile</h1>
			<hr />
			<br />
      <div class="row">
				<div class="col-lg-offset-3 col-lg-3">
					<div id="profilePicture"></div>
					<?php if(isset($_SESSION['pic_url']) && (strlen($_SESSION['pic_url']) > 4) && ($_SESSION['pic_url'] != 'none')) { ?>
						<script>$('#profilePicture').css('background-image', 'url("<?php echo '/getImage.php?path=user&image='.$_SESSION['pic_url'];?>")');</script>
					<?php } else { ?>
						<script>$('#profilePicture').css('background-image', 'url("<?php echo '/getImage.php?path=user&image=user_default.jpg'?>")');</script>
					<?php	}?>
				</div>
				<div class="col-lg-6">
					<table>
						<tr>
							<th>Username</th>
							<td><?php echo $_SESSION['username']; ?></td>
						</tr>
						<tr>
							<th>Email</th>
							<td><?php echo $_SESSION['email']; ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div> <!-- /container	-->
		
		<!-- ==== SECTION DIVIDER2 -->
		<section class="section-divider textdivider divider2">
			<div class="container">
			</div><!-- container -->
		</section><!-- section -->
		
		<div class="container" id="events" name="services">
			<div class="row">
				<br>
				<div class="col-lg-6">
					<h2 class="centered">Attended events</h2>
					<hr />
					<br />
					<?php echo getAttendedEvents($mysqli); ?>
				</div><!-- col -->
				<div class="col-lg-6">
					<h2 class="centered">Hosted events</h2>
					<hr />
					<br />
					<?php echo getHostedEvents($mysqli); ?>
				</div><!-- col -->
			</div><!-- row -->
		</div><!-- container -->
		<div id="footerwrap">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<span class="icon icon-home"></span> TU Eindhoven<br/>
						<span class="icon icon-phone"></span> +31 111 111 111 <br/>
						<span class="icon icon-mobile"></span> +31 101 101 101 <br/>
					</div>
					<div class="col-lg-4">
						<h4>EVENTIFIC - Copyright 2014  ©</h4>
					</div>
					<div class="col-lg-4">
						<span class="icon icon-envelop"></span> <a href="#"> project@name.com</a> <br/>
						<span class="icon icon-twitter"></span> <a href="#"> @projectname </a> <br/>
						<span class="icon icon-facebook"></span> <a href="#"> PROJECTNAME </a> <br/>
					</div>
				</div>
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
