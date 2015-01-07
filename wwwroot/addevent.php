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
require_once($root . '/assets/includes/event.inc.php');

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
	
	<div class="container" id="about" name="about">
			<div class="row white"> 
          <div class="row">
            <div class="col-lg-12 text-center eventcreate">
              <!-- EDIT AN EVENT -->
              <?php if(isset($_GET['edit'])) {

              //Create an event  
              } else { ?>
              <h1 class="centered">CREATE AN EVENT</h1>
              <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                        method="post" 
                        name="event_form"
                        id="eventform">
              <table>
              <tr><td>Event name: <br /><input type='text' name='name' id='name' placeholder="name"/></td></tr>
              <tr><td>Start time: <br /><input type="datetime-local" value="2015-01-14T20:00" name="time"></td></tr>
              <tr><td>Duration: <br /><input type="text" name="duration" id="duration" placeholder="duration (minutes)"/></td></tr>
              <tr><td>Location: <br /><input type="text" name="location" id="location" placeholder="location"/></td></tr> 
              <tr><td>Description: <br /><textarea name="description" id="description">Description</textarea></td></tr>
              <?php if (isset($_SESSION['login_type'])) { 
                if (($_SESSION['login_type']=="FB") || ($_SESSION['login_type']=="Both")) {  ?>
                <input type="hidden" name="logintype" value="FB">    
              <?php  } else { ?>
                <input type="hidden" name="logintype" value="Default">  
              <?php } 
              } else { ?>
                <input type="hidden" name="logintype" value="non">
                <tr><td>No session set</td></tr>  
              <?php } ?>
              <tr><td><input type="submit" value="Register" /> </td></tr>

              </table>
              </form>
              <?php } ?>
            </div>
          </div>
      </div>
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
