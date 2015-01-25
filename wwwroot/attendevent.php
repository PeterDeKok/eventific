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
  } else {
    $logged = 'out';
    header("Location: /index.php");
    exit;
  }
} else {
    $logged = 'out';
    header("Location: /index.php");
    exit;
}

if($logged == 'in') {
	$events = getEvents($mysqli);
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
			  			<li> <a href="index.php#about" class="smoothScroll"> About Us</a></li>
			  			<li> <a href="index.php#services" class="smoothScroll"> E-ticketing</a></li>
			  			<li> <a href="index.php#team" class="smoothScroll"> Team</a></li>
			  			<li> <a href="index.php#blog" class="smoothScroll"> Stories</a></li>
			  			<li> <a href="index.php#contact" class="smoothScroll"> Contact</a></li>
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
			<div class="container attendingItems">
				<h1 class="centered">ATTENDING EVENTS</h1>
				<hr />
				<br />
        <div class="row">
					<?php
					if($events['attendEvent'] && $events['attendEvent'] > 0){
						echo '<div class="col-lg-12">Your attending event '.$events['attendEvent'].' now.</div>';
					} else if($events['attendEvent'] < 0) {
						echo '<div class="col-lg-12">Your are already attending event '.$events['attendEvent']*(-1).'.</div>';
					} else if(is_array($events['attending']) && count($events['attending'])){
						foreach($events['attending'] as $key => $value) {
							echo '<div class="col-lg-3 attendingItem" id="attendingItem'.$value['id'].'"><div><div class="attendingImage"></div>';
							echo '<span><a href="/event.php?event='.$value['id'].'">'.$value['name'].'</a></span>';
							echo '</div></div>';
							
							if(isset($value['pic_url']) && (strlen($value['pic_url']) > 4) && ($value['pic_url'] != 'none')) {?>
								<script>$('#attendingItem<?php echo $value['id']; ?> .attendingImage').css('background-image', 'url("<?php echo '/getImage.php?path=event&image='.$value['pic_url'];?>")');</script>
							<?php } else { ?>
								<script>$('#attendingItem<?php echo $value['id']; ?> .attendingImage').css('background-image', 'url("<?php echo '/getImage.php?path=event&image=event_default.jpg'?>")');</script>
							<?php }
						}
					} else {
						echo '<div class="col-lg-12"><h2>You are not attending events yet.</h></div>';
					}
					?>
        </div>
		  </div>
			<br>
		</div><!-- /greywrap -->
		
		<div class="container discoverItems">
			<h1 class="centered">DISCOVER EVENTS</h1>
			<hr />
			<br />
      <div class="row">
				<?php
				if(is_array($events['notAttending']) && count($events['notAttending'])){
					foreach($events['notAttending'] as $key => $value) {
						echo '<div class="col-md-4 discoverItem" id="discoverItem'.$value['id'].'"><div class="grid mask"><figure class="embed-responsive embed-responsive-16by9">';
						echo '<a href="/event.php?event='.$value['id'].'"><div class="discoverImage embed-responsive-item"></div></a>';
						echo '<figcaption><h5>'.$value['name'].'</h5><a href="#myModal" class="btn btn-primary btn-lg">Buy ticket</a></figcaption>';
						echo '</figure></div><!-- /grid-mask --></div><!-- /col -->';
						
						if(isset($value['pic_url']) && (strlen($value['pic_url']) > 4) && ($value['pic_url'] != 'none')) {?>
							<script>$('#discoverItem<?php echo $value['id']; ?> .discoverImage').css('background-image', 'url("<?php echo '/getImage.php?path=event&image='.$value['pic_url'];?>")');</script>
						<?php } else { ?>
							<script>$('#discoverItem<?php echo $value['id']; ?> .discoverImage').css('background-image', 'url("<?php echo '/getImage.php?path=event&image=event_default.jpg'?>")');</script>
						<?php }
					}
				} else {
					echo '<div class="col-lg-12"><h2>There are no events you can attend right now.</h></div>';
				}
				?>
      </div>
			<br>
		</div>

	  <div id="footerwrap">
	    <div class="container">
	      <span class="icon icon-home"></span> TU Eindhoven<br/>
	      <h4></a>Eventific - Copyright 2014  ©</h4>
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
