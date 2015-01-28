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
require_once($root . '/assets/includes/event.inc.php');
require_once($root . '/assets/includes/functions.php');

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

// Create Database object
$db = new MysqliDb(HOST, USER, PASSWORD, DATABASE);

// Create soundcloud client object with app credentials
$SC_client = new Services_Soundcloud('7b37fcac8f86d7d4111380375eee3911', '0e126e7ae1f33f743579e42899ffa764', 'http://eventific.peterdekok.nl/soundcloud.php');
$SC_client->setCurlOptions(array(CURLOPT_FOLLOWLOCATION => 1));

if($logged == 'in') {
	if(isset($_GET['code'])){
		try {
			$SC_access_token = $SC_client->accessToken($_GET['code']);
			$SC_token = $SC_access_token['access_token'];
			$_SESSION['sc_token'] = $SC_token;
		} catch(Services_Soundcloud_invalid_Http_Response_Code_Exception $e) {
			exit($$e->getMessage());
		}
		try {
			$SC_client->setAccessToken($SC_token);
		} catch(Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
			exit($e->getMessage());
		}
		$SC_current_user = json_decode($SC_client->get('me'));
		
		$data = Array (
		    'sctoken' => $SC_token,
				'scuser' => $SC_current_user->id,
				'scusername' => $SC_current_user->username,
				'scpermalink_url' => $SC_current_user->permalink_url,
				'scavatar_url' => $SC_current_user->avatar_url
		);
		$db->where('id', $_SESSION['user_id']);
		if (!$db->update('members', $data))
		    exit('update failed: ' . $db->getLastError());
		
	}	
	if(!isset($SC_current_user)){
		$data = Array (
		    'sctoken' => NULL,
				'scuser' => NULL,
				'scusername' => NULL,
				'scpermalink_url' => NULL,
				'scavatar_url' => NULL
		);
		$db->where('id', $_SESSION['user_id']);
		if (!$db->update('members', $data))
		    exit('update failed: ' . $db->getLastError());
	}
}

?>
Redirecting...
<script>
window.opener.location.href = window.opener.location.href;
window.close();
</script>