<?php

$root = $_SERVER['DOCUMENT_ROOT']."/..";

if(DEBUG) {
	ini_set("display_errors", "1");
	error_reporting(E_ALL);
}

require_once($root . '/assets/includes/classes/MysqliDb.class.php');
require_once($root . '/assets/includes/classes/session.class.php');

require_once($root . '/assets/includes/db_connect.php');
require_once($root . '/assets/includes/functions.php');

function getEventInfo($mysqli, $eventID) {
    if ($stmt = $mysqli->prepare("SELECT id, name, start, location, description, creator_id, pic_url
        FROM events
        WHERE id = ?
        LIMIT 1")) {
        $stmt->bind_param('i', $eventID); 
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
        // get variables from result.
        $stmt->bind_result($eventID, $eventName, $eventTime, $eventLocation, $eventDescription, $eventCreatorID, $pic_url);
        $stmt->fetch();
        $stmt->close();
        if (!(isset($eventName))) {
            header("Location: /err.php?page=create&err=dbError");
            exit;
        } else {
            if ($stmt = $mysqli->prepare("SELECT username
                FROM members
                WHERE id = ?
                LIMIT 1")) {
                $stmt->bind_param('i', $eventCreatorID); 
                $stmt->execute();    // Execute the prepared query.
                $stmt->store_result();
                // get variables from result.
                $stmt->bind_result($eventCreator);
                $stmt->fetch();
                $stmt->close();
                if (!(isset($eventCreator))) {
                    header("Location: /err.php?page=create&err=dbError");
                    exit;
                } 
            } else {
                header("Location: /err.php?page=create&err=dbError");
                exit;
            }

            $explode = explode(" ", $eventTime);

            return array(
                'id'            => $eventID,
                'name'          => $eventName,
                'description'   => $eventDescription,
                'start'         => $eventTime,
                'location'      => $eventLocation,
                'date'          => $explode[0],
                'time'          => $explode[1],
                'creator'       => $eventCreator,
                'pic_url'       => $pic_url
            );
        }
    } else {
        header("Location: /err.php?page=create&err=dbError");
        exit;
    }
}

function ownerOfEvent($mysqli, $eventID) {
    $logintype = $_SESSION['login_type'];
    if (($logintype == "FB") || ($logintype == "Both")) {
        $fbid = $_SESSION['id']; 
        if ($stmt = $mysqli->prepare("SELECT id
            FROM members
            WHERE fbid = ?
            LIMIT 1")) {
            $stmt->bind_param('i', $fbid); 
            $stmt->execute();    // Execute the prepared query.
            $stmt->store_result();
            // get variables from result.
            $stmt->bind_result($userID);
            $stmt->fetch();
            $stmt->close();
            if (!(isset($userID))) {
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
            $stmt->bind_result($userID);
            $stmt->fetch();
            $stmt->close();
            if (!(isset($userID))) {
                header("Location: /redirect.php?action=errorSession");
                exit;
            }
        }
    } else {
        header('Refresh: 2; URL=attendevent.php');        
        echo 'Seems like you\'re not logged in..';
    } 

    if ($stmt = $mysqli->prepare("SELECT id, creator_id
        FROM events
        WHERE id = ? AND creator_id = ?
        LIMIT 1")) {
        $stmt->bind_param('ii', $eventID, $userID); 
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
        if ($stmt->num_rows==1) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
         }
    }
}
?>