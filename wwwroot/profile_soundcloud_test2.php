<?php

$root = $_SERVER['DOCUMENT_ROOT']."/..";

require_once($root . '/assets/includes/psl-config.php'); 

if(DEBUG) {
	ini_set("display_errors", "1");
	error_reporting(E_ALL);
}

require_once($root . '/assets/includes/classes/MysqliDb.class.php');
require_once($root . '/assets/includes/classes/session.class.php');
require_once($root . '/assets/includes/classes/Soundcloud.php');

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

// Create Database object
$db = new MysqliDb(HOST, USER, PASSWORD, DATABASE);

// Create soundcloud client object with app credentials
$SC_client = new Services_Soundcloud('7b37fcac8f86d7d4111380375eee3911', '0e126e7ae1f33f743579e42899ffa764', 'http://eventific.mac/profile_soundcloud_test.php');
$SC_client->setCurlOptions(array(CURLOPT_FOLLOWLOCATION => 1));

if($logged == 'in') {
	$SC_event_id = 9999999;
	
	$db->where('event_id', $SC_event_id);
	$db->orderBy('addedAt', 'Desc');
	$SC_object = $db->get('soundcloud', 1);
	var_dump($SC_object[0]);
	
	$SC_embed_url = "https%3A//api.soundcloud.com/".$SC_object[0]['type']."/".$SC_object[0]['sc_id'];
		
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
    
		<script>
			var DEBUG = <?php if(DEBUG){echo 1;} else {echo 0;}?>;
		</script>
			
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
		 <!-- MODAL SHOW THE PORTFOLIO IMAGE. In this demo, all links point to this modal. You should create
							      a modal for each of your projects. -->
							      
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">User details</h4>
					</div>
					<div class="modal-body">
						<p><img class="img-responsive" src="http://placehold.it/600x400" alt=""></p>
						<form action="/upload.php" method="post" enctype="multipart/form-data">
							<p><b>Upload new</b></p>
							<input type="file" name="fileToUpload" id="fileToUpload" >
							<input type="submit" value="Upload Image" name="submit">
						</form>
						<ul>
							<li>Username: <strong><?php echo $_SESSION['username']; ?></strong></li>
							<li>E-mail: <strong></strong></li>
							<li>Phone: <strong></strong></li>
							<li>Location: <strong></strong></li>
						</ul>
						<p><b><a href="#">Edit details</a></b></p>
						<p><b><a href="#">Change password</a></b></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
				
		<div id="headerwrap" id="home" name="home">
			<p>Welcome to your Eventific account <?php echo $_SESSION['username']; ?></p>
			<p>Login type: <?php echo $_SESSION['login_type']; ?></p>
			<div class="container">
				<div class="row">
				<div class="col-lg-offset-2 col-lg-8">
			    	<div class="grid mask">
						<figure>
							<img class="img-responsive" src="http://placehold.it/600x400" alt="">
							<figcaption>
								<a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg">Edit profile</a>
							</figcaption><!-- /figcaption -->
						</figure><!-- /figure -->
			    	</div><!-- /grid-mask -->
				</div><!-- /col -->					
				</div><!-- row -->
			</div>
	    </div><!-- /headerwrap -->
			<div id="greywrap">

			<div class="row">
				<div class="col-lg-4 callout">
					<a href="#"><span class="icon icon-plus"></span></a>
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
					ID: <?php echo $_SESSION['id']; ?></p>
					<?php
					$friends = $_SESSION['user_friends'];
					echo "Friends: <br />";
					foreach ($friends as $i => $row) {
                        echo $row['name'] ."</p>";
                    }
					?>
				</div><!-- col-lg-4 -->	
				<?php
					}
				?>
				<div class="col-lg-4 callout">
					<a href="#"><span class="icon icon-star"></span></a>
					<h2 class="text-center">Favorite spots</h2>
				</div><!-- col-lg-4 -->	
			</div>	
			<hr>
		<div class="container" id="services" name="services">
			<div class="row">
				<br>
				<?php if(count($SC_object)) {?>
				<div class="col-lg-offset-1 col-lg-5">
					<div class="row">
						<div class="col-lg-12">
							<h2 class="centered">Soundcloud</h2>
						</div>
					</div>
						
					<div id="soundcloudWrapper">
						<iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php echo $SC_embed_url; ?>&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true">
						</iframe>
							
					</div>
					
				</div><!-- col -->
				<?php }//endif ?>
				<div class="col-lg-5">
					<div class="row">
						<div class="col-lg-offset-3 col-lg-9">
							<h2 class="centered">Spotify</h2>
						</div>
					</div>
					<!--<img class="img-responsive" src="http://placehold.it/845x480" alt="">-->
				</div><!-- col -->
			</div><!-- row -->
		</div><!-- container -->
		<div class="container" id="services" name="services">
			<div class="row">
				<br>
				<div class="col-lg-offset-2 col-lg-8">
					<h2 class="centered">Hosted events</h2>
					<img class="img-responsive" src="http://placehold.it/845x480" alt="">
				</div><!-- col -->
			</div><!-- row -->
		</div><!-- container -->
		<div class="container" id="services" name="services">
			<div class="row">
				<br>
				<div class="col-lg-offset-2 col-lg-8">
					<h2 class="centered">Interesting events</h2>
					<img class="img-responsive" src="http://placehold.it/845x480" alt="">
				</div><!-- col -->
			</div><!-- row -->
		</div><!-- container -->
		<br>
	</div><!-- container -->
			<div id="footerwrap">
			<div class="container">
						<span class="icon icon-home"></span> TU Eindhoven<br/>
						<span class="icon icon-phone"></span> +31 111 111 111 <br/>
						<span class="icon icon-mobile"></span> +31 101 101 101 <br/>
						<h4></a>PROJECTNAME - Copyright 2014  ©</h4>
						<span class="icon icon-envelop"></span> <a href="#"> project@name.com</a> <br/>
						<span class="icon icon-twitter"></span> <a href="#"> @projectname </a> <br/>
						<span class="icon icon-facebook"></span> <a href="#"> PROJECTNAME </a> <br/>
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
	<script type="text/javascript" src="assets/js/soundcloud.js"></script>
  </body>
</html>
