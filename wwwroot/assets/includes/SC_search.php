<?php
	
/**
 * Search SoundCloud for Search string
 *
 * @package   Eventific
 * @author    Peter de Kok <info@peterdekok.nl>
 * @copyright 2014 Peter de Kok <info@peterdekok.nl>
 * @link      https://github.com/PeterDeKok/eventific
 */

$root = $_SERVER['DOCUMENT_ROOT']."/..";

require_once($root . '/assets/includes/psl-config.php');

ini_set("display_errors", "Off");
error_reporting(E_NONE);

require_once($root . '/assets/includes/classes/MysqliDb.class.php');
require_once($root . '/assets/includes/classes/session.class.php');
require_once($root . '/assets/includes/classes/Soundcloud.php');

require_once($root . '/assets/includes/db_connect.php');
require_once($root . '/assets/includes/functions.php');
require_once($root . '/assets/includes/register.inc.php');

$SC_response = array('errors' => array(), 'data' => array());
$SC_errors = array();
$SC_data = array();

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

$SC_client = new Services_Soundcloud('7b37fcac8f86d7d4111380375eee3911', '0e126e7ae1f33f743579e42899ffa764', 'http://eventific.mac/profile_soundcloud_test.php');
$SC_client->setCurlOptions(array(CURLOPT_FOLLOWLOCATION => 1));

//Process Update
if(count($_POST)){
	if(empty($_POST["soundcloudTrack"])) {
		array_push($SC_errors, "Search field can not be empty!");
	} else {
		// get first page of tracks
		$tracks = json_decode($SC_client->get('tracks', array(
		    'q' => $_POST['soundcloudTrack'],
		    'limit' => 200)
		));
		$SC_data = array_merge($SC_data, $tracks);
	}
} else {
	array_push($SC_errors, "Request needs to be of type: POST, with the appropriate arguments!");
}

$SC_response["errors"] = $SC_errors;
$SC_response["data"] = $SC_data;
$SC_response["confirm"] = 'Search complete!';
$SC_response["form"] = NULL;

if(count($SC_errors)) {
	header("HTTP/1.1 500 Internal Server Error");
}

echo json_encode($SC_response);
	
?>