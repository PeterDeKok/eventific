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
			<li><a href="index.php#services" class="smoothScroll"> E-ticketing</a></li>
			<li><a href="index.php#team" class="smoothScroll"> Team</a></li>
			<li><a href="index.php#blog" class="smoothScroll"> Stories</a></li>
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
				</div>
			</li>
		  <?php 
		  	} else {  
		  ?>
			<li><a href="/profile.php"> Welcome <?php echo $_SESSION['username']; ?></a></li>
			<li><a href="/assets/includes/logout.php">Log out</a></li>
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
	  		 	<p>Your friendly Event Management system.</p>
	  		</header>	    
	    </div><!-- /headerwrap -->

		<!-- ==== GREYWRAP ==== -->
		<div id="greywrap">
			<div class="row">
				<div class="col-lg-4 callout">
					<span class="icon icon-stack"></span>
					<h2>Easy event management</h2>
					<p>Don't miss anything!</p>
				</div><!-- col-lg-4 -->
					
				<div class="col-lg-4 callout">
					<span class="icon icon-mobile"></span>
					<h2>Scalable</h2>
					<p>You can use this application on all of your devices. </p>
				</div><!-- col-lg-4 -->	
				
				<div class="col-lg-4 callout">
					<span class="icon icon-clock"></span>
					<h2>Buy your tickets</h2>
					<p>Get them now!</p>
				</div><!-- col-lg-4 -->	
			</div><!-- row -->
		</div><!-- greywrap -->
		
		<!-- ==== ABOUT ==== -->
		<div class="container" id="about" name="about">
			<div class="row white">
			<br>
				<h1 class="centered">ABOUT THE PROJECT</h1>
				<hr>
				
				<div class="col-lg-6">
					<p>HERE COMES THE MOTIVATION TEXT HERE COMES THE MOTIVATION TEXT HERE COMES THE MOTIVATION TEXT HERE COMES THE MOTIVATION TEXT </p>
				</div><!-- col-lg-6 -->
				
				<div class="col-lg-6">
					<p>HERE COMES THE MOTIVATION TEXT HERE COMES THE MOTIVATION TEXT HERE COMES THE MOTIVATION TEXT HERE COMES THE MOTIVATION TEXT </p>
				</div><!-- col-lg-6 -->
			</div><!-- row -->
		</div><!-- container -->
		
		<!-- ==== SECTION DIVIDER1 -->
		<section class="section-divider textdivider divider1">
			<div class="container">
			</div><!-- container -->
		</section><!-- section -->
		
		
		<!-- ==== SERVICES ==== -->
		<div class="container" id="services" name="services">
			<br>
			
			<div class="row">
				<h2 class="centered">USER-FIRST ORIENTED THINKING</h2>
				<hr>
				<br>
				<div class="col-lg-offset-2 col-lg-8">
					<img class="img-responsive" src="http://placehold.it/845x480" alt="">
				</div><!-- col -->
			</div><!-- row -->
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
			
			
						 <!-- MODAL SHOW THE PORTFOLIO IMAGE. In this demo, all links point to this modal. You should create
						      a modal for each of your projects. -->
						      
						  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						    <div class="modal-dialog">
						      <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						          <h4 class="modal-title">Project Title</h4>
						        </div>
						        <div class="modal-body">
						          <p><img class="img-responsive" src="http://placehold.it/600x400" alt=""></p>
						          <p>This project was crafted for Some Name corp. Detail here a little about your job requirements and the tools used. Tell about the challenges faced and what you and your team did to solve it.</p>
						          <p><b><a href="#">Visit Site</a></b></p>
						        </div>
						        <div class="modal-footer">
						          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        </div>
						      </div><!-- /.modal-content -->
						    </div><!-- /.modal-dialog -->
						  </div><!-- /.modal -->
				
							<!-- PORTFOLIO IMAGE 1 -->
				<div class="col-md-4 ">
			    	<div class="grid mask">
						<figure>
							<img class="img-responsive" src="http://placehold.it/600x400" alt="">
							<figcaption>
								<h5>DASHBOARD</h5>
								<a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg">Take a Look</a>
							</figcaption><!-- /figcaption -->
						</figure><!-- /figure -->
			    	</div><!-- /grid-mask -->
				</div><!-- /col -->
				
		
				<!-- PORTFOLIO IMAGE 2 -->
				<div class="col-md-4">
			    	<div class="grid mask">
						<figure>
							<img class="img-responsive" src="http://placehold.it/600x400" alt="">
							<figcaption>
								<h5>UI DESIGN</h5>
								<a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg">Take a Look</a>
							</figcaption><!-- /figcaption -->
						</figure><!-- /figure -->
			    	</div><!-- /grid-mask -->
				</div><!-- /col -->
				
				<!-- PORTFOLIO IMAGE 3 -->
				<div class="col-md-4">
			    	<div class="grid mask">
						<figure>
							<img class="img-responsive" src="http://placehold.it/600x400" alt="">
							<figcaption>
								<h5>ANDROID PAGE</h5>
								<a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg">Take a Look</a>
							</figcaption><!-- /figcaption -->
						</figure><!-- /figure -->
			    	</div><!-- /grid-mask -->
				</div><!-- /col -->
			</div><!-- /row -->

				<!-- PORTFOLIO IMAGE 4 -->
			<div class="row">	
				<div class="col-md-4 ">
			    	<div class="grid mask">
						<figure>
							<img class="img-responsive" src="http://placehold.it/600x400" alt="">
							<figcaption>
								<h5>PROFILE</h5>
								<a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg">Take a Look</a>
							</figcaption><!-- /figcaption -->
						</figure><!-- /figure -->
			    	</div><!-- /grid-mask -->
				</div><!-- /col -->
				
				<!-- PORTFOLIO IMAGE 5 -->
				<div class="col-md-4">
			    	<div class="grid mask">
						<figure>
							<img class="img-responsive" src="http://placehold.it/600x400" alt="">
							<figcaption>
								<h5>FACEBOOK APP</h5>
								<a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg">Take a Look</a>
							</figcaption><!-- /figcaption -->
						</figure><!-- /figure -->
			    	</div><!-- /grid-mask -->
				</div><!-- /col -->
				
				<!-- PORTFOLIO IMAGE 6 -->
				<div class="col-md-4">
			    	<div class="grid mask">
						<figure>
							<img class="img-responsive" src="http://placehold.it/600x400" alt="">
							<figcaption>
								<h5>PHONE MOCKUP</h5>
								<a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg">Take a Look</a>
							</figcaption><!-- /figcaption -->
						</figure><!-- /figure -->
			    	</div><!-- /grid-mask -->
				</div><!-- /col -->
			</div><!-- /row -->
			<br>
			<br>
		</div><!-- /row -->
	</div><!-- /container -->


		<!-- ==== SECTION DIVIDER2 -->
		<section class="section-divider textdivider divider2">
			<div class="container">
			</div><!-- container -->
		</section><!-- section -->

		<!-- ==== TEAM MEMBERS ==== -->
		<div class="container" id="team" name="team">
		<br>
			<div class="row white centered">
				<h1 class="centered">OUR AWESOME TEAM</h1>
				<hr>
				<br>
				<br>
				<div class="col-lg-3 centered">
					<img class="img img-circle" src="http://placehold.it/150x150" height="120px" width="120px" alt="">
					<br>
					<h4><b>Nick Braat</b></h4>
					<a href="#" class="icon icon-twitter"></a>
					<a href="#" class="icon icon-facebook"></a>
					<p>Nick combines an expert technical knowledge in web technology.</p>
				</div><!-- col-lg-3 -->
				
				<div class="col-lg-3 centered">
					<img class="img img-circle" src="http://placehold.it/150x150" height="120px" width="120px" alt="">
					<br>
					<h4><b>Sanir Pasalic</b></h4>
					<a href="#" class="icon icon-twitter"></a>
					<a href="#" class="icon icon-facebook"></a>
					<p>Sanir combines an expert technical knowledge in web technology.</p>
				</div><!-- col-lg-3 -->
				
				<div class="col-lg-3 centered">
					<img class="img img-circle" src="http://placehold.it/150x150" height="120px" width="120px" alt="">
					<br>
					<h4><b>Peter de Kok</b></h4>
					<a href="#" class="icon icon-twitter"></a>
					<a href="#" class="icon icon-facebook"></a>
					<p>Peter combines an expert technical knowledge in web technology.</p>
				</div><!-- col-lg-3 -->
				
				<div class="col-lg-3 centered">
					<img class="img img-circle" src="http://placehold.it/150x150" height="120px" width="120px" alt="">
					<br>
					<h4><b>Yashar Abbasov</b></h4>
					<a href="#" class="icon icon-twitter"></a>
					<a href="#" class="icon icon-facebook"></a>
					<p>Yashar combines an expert technical knowledge in web technology.</p>
				</div><!-- col-lg-3 -->
				
			</div><!-- row -->
		</div><!-- container -->

		<!-- ==== GREYWRAP ==== -->
		<div id="greywrap">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 centered">
						<img class="img-responsive" src="http://placehold.it/625x375"  align="">
					</div>
					<div class="col-lg-4">
						<h2>Sponsor Us!</h2>
						<p>Do you want to be part of it?</p>
						<p><a href="#contact" class="btn btn-success">Contact Us</a></p>
					</div>					
				</div><!-- row -->
			</div>
			<br>
			<br>
		</div><!-- greywrap -->
		
		<!-- ==== SECTION DIVIDER3 -->
		<section class="section-divider textdivider divider3">
			<div class="container">
			</div><!-- container -->
		</section><!-- section -->
		
		<!-- ==== BLOG ==== -->
		<div class="container" id="blog" name="blog">
		<br>
			<div class="row">
				<br>
				<h1 class="centered">SUCCESS STORIES</h1>
				<hr>
				<br>
				<br>
			</div><!-- /row -->
			
			<div class="row">
				<div class="col-lg-6 blog-bg">
					<div class="col-lg-4 centered">
					<br>
						<p><img class="img img-circle" src="http://placehold.it/150x150" width="60px" height="60px"></p>
						<h4>John </h4>
						<h5>Published date/date/date</h5>
					</div>
					<div class="col-lg-8 blog-content">
						<h2>Story 1</h2>
						<p>A Beautiful Story</p>
						<p><a href="#" class="icon icon-link"> Read More</a></p>
						<br>
					</div>
				</div><!-- /col -->
				
				<div class="col-lg-6 blog-bg">
					<div class="col-lg-4 centered">
					<br>
						<p><img class="img img-circle" src="http://placehold.it/150x150" width="60px" height="60px"></p>
						<h4>Jim</h4>
						<h5>Published date/date/date</h5>
					</div>
					<div class="col-lg-8 blog-content">
						<h2>Story 2</h2>
						<p>A Beautiful Story</p>
						<p><a href="#" class="icon icon-link"> Read More</a></p>
						<br>
					</div>
				</div><!-- /col -->
			</div><!-- /row -->
			<br>
			<br>
		</div><!-- /container -->

		
		<!-- ==== SECTION DIVIDER6 ==== -->
		<section class="section-divider textdivider divider6">
			<div class="container">
			</div><!-- container -->
		</section><!-- section -->
		
		<div class="container" id="contact" name="contact">
		<div class="col-lg-8">
			 <div class="container">
			            <div class="row">
			                <div class="col-lg-12 text-center">
			                    <h2>Contact</h2>
			                    <hr class="star-primary">
			                </div>
			            </div>
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
	<script type="text/javascript" src="assets/js/classie.js"></script>
	<script type="text/javascript" src="assets/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="assets/js/smoothscroll.js"></script>
	<script type="text/javascript" src="assets/js/jquery-func.js"></script>
	<script type="text/javascript" src="assets/js/jqBootstrapValidation.js"></script>
	<script type="text/javascript" src="assets/js/contact_us.js"></script>
  </body>
</html>
