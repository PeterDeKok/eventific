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

function getEventInfo($mysqli, $eventID, $info) {
    switch ($info) {
        case "name":
            if ($stmt = $mysqli->prepare("SELECT name
                FROM events
                WHERE id = ?
                LIMIT 1")) {
                $stmt->bind_param('i', $eventID); 
                $stmt->execute();    // Execute the prepared query.
                $stmt->store_result();
                // get variables from result.
                $stmt->bind_result($eventName);
                $stmt->fetch();
                $stmt->close();
                if (!(isset($eventName))) {
                    header("Location: /err.php?page=create&err=dbError");
                    exit;
                } else {
                    return $eventName;
                }
            } else {
                header("Location: /err.php?page=create&err=dbError");
                exit;
            }
        break;
        case "date":
            if ($stmt = $mysqli->prepare("SELECT start
                FROM events
                WHERE id = ?
                LIMIT 1")) {
                $stmt->bind_param('i', $eventID); 
                $stmt->execute();    // Execute the prepared query.
                $stmt->store_result();
                // get variables from result.
                $stmt->bind_result($startTime);
                $stmt->fetch();
                $stmt->close();
                if (!(isset($startTime))) {
                    header("Location: /err.php?page=create&err=dbError");
                    exit;
                } else {
                    $explode = explode(" ", $startTime);
                    return $explode[0];
                }
            } else {
                header("Location: /err.php?page=create&err=dbError");
                exit;
            }
        break;
        case "time":
            if ($stmt = $mysqli->prepare("SELECT start
                FROM events
                WHERE id = ?
                LIMIT 1")) {
                $stmt->bind_param('i', $eventID); 
                $stmt->execute();    // Execute the prepared query.
                $stmt->store_result();
                // get variables from result.
                $stmt->bind_result($startTime);
                $stmt->fetch();
                $stmt->close();
                if (!(isset($startTime))) {
                    header("Location: /err.php?page=create&err=dbError");
                    exit;
                } else {
                    $explode = explode(" ", $startTime);
                    return $explode[1];
                }
            } else {
                header("Location: /err.php?page=create&err=dbError");
                exit;
            }
        break;
        case "location":
            if ($stmt = $mysqli->prepare("SELECT location
                FROM events
                WHERE id = ?
                LIMIT 1")) {
                $stmt->bind_param('i', $eventID); 
                $stmt->execute();    // Execute the prepared query.
                $stmt->store_result();
                // get variables from result.
                $stmt->bind_result($eventLocation);
                $stmt->fetch();
                $stmt->close();
                if (!(isset($eventLocation))) {
                    header("Location: /err.php?page=create&err=dbError");
                    exit;
                } else {
                    return $eventLocation;
                }
            } else {
                header("Location: /err.php?page=create&err=dbError");
                exit;
            }
        break;
        case "description":
            if ($stmt = $mysqli->prepare("SELECT description
                FROM events
                WHERE id = ?
                LIMIT 1")) {
                $stmt->bind_param('i', $eventID); 
                $stmt->execute();    // Execute the prepared query.
                $stmt->store_result();
                // get variables from result.
                $stmt->bind_result($eventDescription);
                $stmt->fetch();
                $stmt->close();
                if (!(isset($eventDescription))) {
                    header("Location: /err.php?page=create&err=dbError");
                    exit;
                } else {
                    return $eventDescription;
                }
            } else {
                header("Location: /err.php?page=create&err=dbError");
                exit;
            }
        break;
        case "creator":
            if ($stmt = $mysqli->prepare("SELECT creator_id
                FROM events
                WHERE id = ?
                LIMIT 1")) {
                $stmt->bind_param('i', $eventID); 
                $stmt->execute();    // Execute the prepared query.
                $stmt->store_result();
                // get variables from result.
                $stmt->bind_result($eventCreator);
                $stmt->fetch();
                $stmt->close();
                if (!(isset($eventCreator))) {
                    header("Location: /err.php?page=create&err=dbError");
                    exit;
                } else {
                    if ($stmt = $mysqli->prepare("SELECT username
                        FROM members
                        WHERE id = ?
                        LIMIT 1")) {
                        $stmt->bind_param('i', $eventCreator); 
                        $stmt->execute();    // Execute the prepared query.
                        $stmt->store_result();
                        // get variables from result.
                        $stmt->bind_result($username);
                        $stmt->fetch();
                        $stmt->close();
                        if (!(isset($username))) {
                            header("Location: /err.php?page=create&err=dbError");
                            exit;
                        } else {
                            return $username;
                        }
                    } else {
                        header("Location: /err.php?page=create&err=dbError");
                        exit;
                    }
                }
            } else {
                header("Location: /err.php?page=create&err=dbError");
                exit;
            }
        break;
    }
}
?>