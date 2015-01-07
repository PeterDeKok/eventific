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
    array_push($SC_errors, "Not logged in!");
}

if($logged == 'in') {
	// Create Database object
	$db = new MysqliDb(HOST, USER, PASSWORD, DATABASE);

	if(isset($_POST['SC_event_id'])) {
		$data = Array(
		    'event_id' => $_POST['SC_event_id'],
		    'member_id' => $_POST['SC_member_id'],
		    'sc_id' => $_POST['SC_id'],
		    'type' => $_POST['SC_type'],
		    'addedAt' => $db->now(),
				'permalink_url' => $_POST['SC_permalink_url'],
				'artwork_url' => $_POST['SC_artwork'],
				'title' => $_POST['SC_title']
		);

		$id = $db->insert('soundcloud', $data);
		if ($id)
		    array_push($SC_data, array('id' => $id, 'event_id' => $_POST['SC_event_id']));
		else
		    array_push($SC_errors, "Data could not be committed to server! ".$db->getLastError());
	} else {
		array_push($SC_errors, "Not all necesary POST objects are set.");
		
	
	}
}

$SC_response["errors"] = $SC_errors;
$SC_response["data"] = $SC_data;

if(count($SC_errors)) {
	header("HTTP/1.1 500 Internal Server Error");
}

echo json_encode($SC_response);
	
?>