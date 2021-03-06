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

if((isset($_POST['name'])) && (isset($_POST['time'])) && (isset($_POST['duration'])) && (isset($_POST['location'])) && (isset($_POST['logintype'])) && (isset($_POST['description'])) && (isset($_POST['address'])) && (isset($_POST['zipcode'])) && (isset($_POST['price'])) && (isset($_POST['amount'])) && (isset($_POST['city']))) { 
    //VALIDATE STUFF?
    $name = $_POST['name'];
    $time = $_POST['time'];
    $duration = $_POST['duration'];
    $location = $_POST['location'];
    $logintype = $_POST['logintype'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $address = $_POST['address'];
    $maxAmount = $_POST['amount'];
    $zipcode = $_POST['zipcode'];
    $city = $_POST['city'];
		$soundcloud_id = $_POST['soundcloud_id'];
		$picture = false;
		if(isset($_FILES['fileEvent'])) {
			$picture = $_FILES['fileEvent'];
		}

    if ((strlen($name) < 2) || (strlen($time) < 2) || (strlen($duration) <= 1) || (strlen($location) < 2) || (strlen($logintype) < 2) || (strlen($description) < 2)) {
        header('Refresh: 2; URL=addevent.php'); 
        echo "Form not valid";  
        exit;
    }
		
		$db = new MysqliDb(HOST, USER, PASSWORD, DATABASE);
		
    //CREATE NEW
    if (!(isset($_POST['editID'])) || (strlen($_POST['editID'])<1)) {

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
                $stmt->fetch();
                $stmt->close();
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
				
				if($picture) {
					$uploadedImage = uploadImage('fileEvent', $root.'/assets/userUploadFiles/events/');
					if($uploadedImage) $pic_url = $uploadedImage;
				}
				
        //Pic url
        if (!(isset($pic_url))) {
            $pic_url = "none";
        }

         if ($insert_stmt = $mysqli->prepare("INSERT INTO events (creator_id, name, description, start, duration, location, address, zipcode, city, price, max_people, pic_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
                $insert_stmt->bind_param('isssisssssss', $creator_id, $name, $description, $time, $duration, $location, $address, $zipcode, $city, $price, $maxAmount, $pic_url);
                // Execute the prepared query.
                if (!$insert_stmt->execute()) {
                    echo "<script> alert('Registration failed! ".$name."Try to sign up again');</script>";
                    echo '<script>window.location = "/addevent.php";</script>';
                }
                else {
									$eventID = $mysqli->insert_id;
                    //$stmt->close();
										if($soundcloud_id) {
											$db_data = Array (
										    'event_id' => $eventID
											);
											$db->where('id', $soundcloud_id);
											if($db->update('soundcloud', $db_data)) {
												echo "success";
											} else {
												echo "failed somehow";
											}
										}
										
                    echo "<script> alert('Event created!');</script>";
                    echo '<script>window.location = "/event.php?event='.$eventID.'";</script>';
                }
        } else {
            echo "<script> alert('Query Error (check database');</script>";
            $stmt->close();
        }
    //EDIT
    } else {
        $editID = $_POST['editID'];
        
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
                $stmt->fetch();
                $stmt->close();
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

        $prep_stmt = "SELECT id, creator_id FROM events WHERE id = ? AND creator_id = ? LIMIT 1";
        $stmt = $mysqli->prepare($prep_stmt);
        $stmt->bind_param('ii', $editID, $creator_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $creator_id);
        $stmt->fetch();
        if ($stmt->num_rows == 1) {
            $stmt->close();
						if($picture) {
							$uploadedImage = uploadImage('fileEvent', $root.'/assets/userUploadFiles/events/');
							if($uploadedImage) $pic_url = $uploadedImage;
						}
				
		        //Pic url
		        if (!(isset($pic_url))) {
		            $pic_url = "none";
		        }
            $prep_stmt = "UPDATE events SET name=?, description=?, start=?, duration=?, location=?, address=?, zipcode=?, city=?, price=?, max_people=?, pic_url=? WHERE id=?";
            $stmt = $mysqli->prepare($prep_stmt);

            if ($stmt) {
                $stmt->bind_param('sssisssssssi', $name, $description, $time, $duration, $location, $address, $zipcode, $city, $price, $maxAmount, $pic_url, $editID);
                if ($stmt->execute()) {
                    $stmt->close();
										if($soundcloud_id) {
											$db_data = Array (
										    'event_id' => $editID
											);
											$db->where('id', $soundcloud_id);
											if($db->update('soundcloud', $db_data)) {
												echo "success";
											} else {
												echo "failed somehow";
											}
										}
                    header("Location: /event.php?event=".$editID);
                    exit;
                } else {
                    echo "<script> alert('Query Error (check database)');</script>";
                    $stmt->close();
                }
            } else {
                echo "<script> alert('Query Error (check database)');</script>";
                $stmt->close();
            }
        } else {
            header('Refresh: 2; URL=addevent.php');        
            echo 'Not authorized.';
        }
    }
}
?>