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
		var_dump($logged);
    $_SESSION['login_type'] = "Default";
} elseif ((isset($_SESSION['FB']) && isset($_SESSION['valid']))) { 
  if (($_SESSION['FB'] == true && $_SESSION['valid'] == true)) {
    if (login_check($mysqli)) {
      $logged='in';
			var_dump($logged);
      $_SESSION['login_type'] = "Both";
    } else {
      $logged='in';
			var_dump($logged);
      $_SESSION['login_type'] = "FB";
    }
  } else {
    $logged = 'out';
		var_dump($logged);
    //header("Location: /index.php");
    //exit;
  }
} else {
    $logged = 'out';
		var_dump($logged);
    //header("Location: /index.php");
    //exit;
}

if (!($logged=='in')) {
?>
<html>
<head>
	<script type="text/javascript" src="assets/js/forms.js"></script>
	<script type="text/javascript" src="assets/js/sha512.js"></script>
</head>
<body>
	<form method="post" action="/assets/includes/process_login.php" name="login_form" id="login-form" accept-charset="UTF-8">
		<input style="margin-bottom: 15px;" type="text" placeholder="Email" id="email" name="email">
		<input style="margin-bottom: 15px;" type="password" placeholder="Password" id="password" name="password">
		<input type="submit" id="sign-in" class="btn btn-primary btn-block" value="Sign in" onclick="formhash(this.form, this.form.password);">
	</form>
	<label style="text-align:center;">or</label>
	<form action="/loginFB.php">
		<button class="btn btn-primary btn-block" type="submit" id="sign-in-fb">Sign in with Facebook</button>
	</form>
<?php
} else {
?>
Logged In!
<?php
}
?>
<?php
phpinfo();
?>
</body>
</html>