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
 
$error_msg = "";

if((isset($_POST['name'])) && (isset($_POST['time'])) && (isset($_POST['duration'])) && (isset($_POST['location'])) && (isset($_POST['logintype'])) && (isset($_POST['description']))) { 
    //VALIDATE STUFF?
    $name = $_POST['name'];
    $time = $_POST['time'];
    $duration = $_POST['duration'];
    $location = $_POST['location'];
    $logintype = $_POST['logintype'];
    $description = $_POST['description'];

    //GET ID
    if ($logintype == "FB") {
        $fbid = $_SESSION['id']; 
        if ($stmt = $mysqli->prepare("SELECT id
            FROM members
           WHERE fbid = ?
            LIMIT 1")) {
            $stmt->bind_param('i', $fbid); 
            $stmt->execute();    // Execute the prepared query.
            $stmt->store_result();
            // get variables from result.
            $stmt->bind_result($creator_id);
            if (!(isset($creator_id))) {
                header("Location: /redirect.php?action=errorSession");
                exit;
            }
        }
    } elseif ($logintype == "Default")  {
        $username = $_SESSION['username'];
        if ($stmt = $mysqli->prepare("SELECT id
            FROM members
           WHERE username = ?
            LIMIT 1")) {
            $stmt->bind_param('s', $username); 
            $stmt->execute();    // Execute the prepared query.
            $stmt->store_result();
            // get variables from result.
            $stmt->bind_result($creator_id);
            $stmt->fetch();
            $stmt->close();
            if (!(isset($creator_id))) {
                header("Location: /redirect.php?action=errorSession");
                exit;
            }
        }
    } else {
        header("Location: /redirect.php?action=errorSession");
        exit;
    }

    //Pic url
    if (!(isset($pic_url))) {
        $pic_url = "none";
    }

     if ($insert_stmt = $mysqli->prepare("INSERT INTO events (creator_id, name, description, start, duration, location, pic_url) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('isssiss', $creator_id, $name, $description, $time, $duration, $location, $pic_url);
            // Execute the prepared query.
            if (!$insert_stmt->execute()) {
                echo "<script> alert('Registration failed! ".$name."Try to sign up again');</script>";
                echo '<script>window.location = "/addevent.php";</script>';
            }
            else {
                echo "<script> alert('Event created!');</script>";
                echo '<script>window.location = "/profile.php";</script>';
            }
        } else {

            echo "<script> alert('Query Error (check database');</script>";
        }

}
?>