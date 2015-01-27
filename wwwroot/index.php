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
	}
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
	<script type="text/javascript">
	$(document).ready(function(){
	    //Handles menu drop down
	    $('.dropdown-menu').find('form').click(function (e) {
	        e.stopPropagation();
	    });
	});
	</script>
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
			<li><a href="index.php#portfolio" class="smoothScroll"> Features</a></li>
			<li><a href="index.php#team" class="smoothScroll"> Team</a></li>
			<li><a href="index.php#contact" class="smoothScroll"> Contact</a></li>
			<li role="presentation" class="divider"></li>
		  <?php
		  if (!($logged=='in')) {
		  ?>
			<li><a href="/signup.php">Sign Up</a></li>
            <li class="divider-vertical"></li>
			<li class="dropdown">
				<a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
				<div class="dropdown-menu" style="padding: 15px;">
					<form method="post" action="/assets/includes/process_login.php" name="login_form" id="login-form" accept-charset="UTF-8">
						<input style="margin-bottom: 15px;" type="text" placeholder="Email" id="email" name="email">
						<input style="margin-bottom: 15px;" type="password" placeholder="Password" id="password" name="password">
						<input type="submit" id="sign-in" class="btn btn-primary btn-block" value="Sign in" onclick="formhash(this.form, this.form.password);">
					</form>
				<label style="text-align:center;">or</label>
				<form action="/loginFB.php">
           			<button class="btn btn-primary btn-block" type="submit" id="sign-in-fb">Sign in with Facebook</button>
           		</form>
				</div>
			</li>
		  <?php
		  	} else {
		  ?>
			<li><a href="/profile.php"> My Profile</a></li>
			<li><a href="/redirect.php?action=logout">Log out</a></li>
		  </ul>
		  <?php
			}
		  ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    </div>

		<!-- ==== HEADERWRAP ==== -->
	    <div id="headerwrap" id="home" name="home">
			<header class="clearfix">
	  		 	<p>Eventific</p><br>
					<p style="font-size:1.1em">User friendly,</p><br>
					<p style="font-size:1.1em">integrated</p><br>
					<p style="font-size:1.1em">event management.</p><br>
	  		</header>
	    </div><!-- /headerwrap -->
		
		<!-- ==== ABOUT ==== -->		
		<div class="container" id="about" name="about">
			<div class="row white">
			<br>
				<h1 class="centered">ABOUT EVENTIFIC</h1>
				<hr>

				<div class="col-lg-6">
					<p>Eventific is a platform specifically designed to grant the user the functions and overview to create, organize, plan and execute an event in perfect sequence. Its intuitive design and integrated features make sure the user need not go anywhere else looking for the ultimate event management tools.</p>
				</div><!-- col-lg-6 -->

				<div class="col-lg-6">
					<p>The platform allows for event managers to create e-tickets, track sales, check attendance, list requirements, plan dates and market their event. <br>
						Users only looking for events will find Eventific to contain all the needed information on any event. They can search for events and buy their e-tickets on the platform. </p>
				</div><!-- col-lg-6 -->
			</div><!-- row -->
			<!-- ==== GREYWRAP ==== -->
		<div id="greywrap">
			<div class="row">	
				<div class="col-lg-4 callout">
					<span class="icon icon-stack"></span>
					<h2>Easy event management</h2>
					<p>Everything you need for full planning and control.</p>
				</div><!-- col-lg-4 -->
				<div class="col-lg-4 callout">
					<span class="icon icon-ticket"></span>
					<h2>E-ticket sale and purchase</h2>
					<p>Creation and trade of e-tickets has never been easier.</p>
				</div><!-- col-lg-4 -->

				<div class="col-lg-4 callout">
					<span class="icon icon-mobile"></span>
					<h2>Scalable</h2>
					<p>Useable on all devices.</p>
				</div><!-- col-lg-4 -->
			</div><!-- row -->
		</div><!-- greywrap -->
		
		</div><!-- container -->

		<!-- ==== PORTFOLIO ==== -->
		<div class="container" id="portfolio" name="portfolio">
		<br>
		
			<div class="row">
				<br>
				<h1 class="centered">FEATURES</h1>
				<hr>
				<br>
				<br>
			</div><!-- /row -->

			<div class="container">
			<div class="row">
				<!-- PORTFOLIO IMAGE 2 -->
				<div class="col-md-4">
			    	<div class="grid mask">
						<figure>
							<img class="img-responsive" src="/assets/img/fb.jpg" alt="">
							<figcaption>
								<h5>Facebook app</h5>
							</figcaption><!-- /figcaption -->
						</figure><!-- /figure -->
			    	</div><!-- /grid-mask -->
				</div><!-- /col -->
				<div class="col-md-4 ">
			    	<div class="grid mask">
						<figure>
							<img class="img-responsive" src="/assets/img/sound.jpg	" alt="">
							<figcaption>
								<h5>Connect with Soundcloud</h5>
							</figcaption><!-- /figcaption -->
						</figure><!-- /figure -->
			    	</div><!-- /grid-mask -->
				</div><!-- /col -->
				<!-- PORTFOLIO IMAGE 3 -->
				<div class="col-md-4">
			    	<div class="grid mask">
						<figure>
							<img class="img-responsive" src="/assets/img/secure.jpg" alt="">
							<figcaption>
								<h5>Secure ticketing system</h5>
							</figcaption><!-- /figcaption -->
						</figure><!-- /figure -->
			    	</div><!-- /grid-mask -->
				</div><!-- /col -->
			</div><!-- /row -->
			<br><br>
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
		
	</div><!-- /container -->

		<!-- ==== TEAM MEMBERS ==== -->
		<div class="container" id="team" name="team">
		<br>
			<div class="row white centered">
				<h1 class="centered">OUR TEAM</h1>
				<hr>
				<br>
				<br>
				<div class="col-lg-3 centered">
					<h4><b>Nick Braat</b></h4>
					<a href="#" class="icon icon-twitter"></a>
					<a href="#" class="icon icon-facebook"></a>
					<p>Nick combines an expert technical knowledge in web technology.</p>
				</div><!-- col-lg-3 -->

				<div class="col-lg-3 centered">
					<h4><b>Sanir Pasalic</b></h4>
					<a href="#" class="icon icon-twitter"></a>
					<a href="#" class="icon icon-facebook"></a>
					<p>Sanir combines an expert technical knowledge in web technology.</p>
				</div><!-- col-lg-3 -->

				<div class="col-lg-3 centered">
					<h4><b>Peter de Kok</b></h4>
					<a href="#" class="icon icon-twitter"></a>
					<a href="#" class="icon icon-facebook"></a>
					<p>Peter combines an expert technical knowledge in web technology.</p>
				</div><!-- col-lg-3 -->

				<div class="col-lg-3 centered">
					<h4><b>Yashar Abbasov</b></h4>
					<a href="#" class="icon icon-twitter"></a>
					<a href="#" class="icon icon-facebook"></a>
					<p>Yashar combines an expert technical knowledge in web technology.</p>
				</div><!-- col-lg-3 -->

			</div><!-- row -->
		</div><!-- container -->
		<br><br>
		<div class="container" id="contact" name="contact">
			<h1 class="centered">CONTACT US</h1>
			<hr>
			<br><br>
		<div class="col-lg-8">
			 <div class="container">
			            <div class="row">
			                <div class="col-lg-8 col-lg-offset-2">
			                    <form name="sentMessage" id="contactForm" validate>
			                        <div class="row control-group">
			                            <div class="form-group col-xs-12 floating-label-form-group controls">
			                                <label>Name</label>
			                                <input type="text" class="form-control contact_val" placeholder="Name" id="name" required data-validation-required-message="Vul een naam in.">
			                                <p class="help-block text-danger"></p>
			                            </div>
			                        </div>
			                        <div class="row control-group">
			                            <div class="form-group col-xs-12 floating-label-form-group controls">
			                                <label>Email Address</label>
			                                <input type="email" class="form-control contact_val" placeholder="Email Address" id="email" required data-validation-required-message="Vul een e-mailadres in.">
			                                <p class="help-block text-danger"></p>
			                            </div>
			                        </div>
			                        <div class="row control-group">
			                            <div class="form-group col-xs-12 floating-label-form-group controls">
			                                <label>Phonenummer</label>
			                                <input type="tel" class="form-control contact_val" placeholder="Phonenumber" id="phone" required data-validation-required-message="Vul een telefoonnummer in.">
			                                <p class="help-block text-danger"></p>
			                            </div>
			                        </div>
			                        <div class="row control-group">
			                            <div class="form-group col-xs-12 floating-label-form-group controls">
			                                <label>Message</label>
											 <textarea rows="5" class="form-control contact_val" placeholder="Message" id="message" required data-validation-required-message="Vul een bericht in."></textarea>
			                                <p class="help-block text-danger"></p>
			                            </div>
			                        </div>
			                        <br>
			                        <div id="success"></div>
			                        <div class="row">
			                            <div class="form-group col-xs-12">
			                                <button type="submit" class="btn btn-success btn-lg">Submit</button>
			                            </div>
			                        </div>
			                    </form>
			                </div>
			            </div>
			        </div>
				</div><!-- col -->
		</div><!-- container -->

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
	<script type="text/javascript" src="assets/js/classie.js"></script>
	<script type="text/javascript" src="assets/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="assets/js/smoothscroll.js"></script>
	<script type="text/javascript" src="assets/js/jquery-func.js"></script>
	<script type="text/javascript" src="assets/js/jqBootstrapValidation.js"></script>
	<script type="text/javascript" src="assets/js/contact_us.js"></script>
  </body>
</html>
