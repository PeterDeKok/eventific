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

function login($email, $password, $mysqli) {
    // Using prepared statements means that SQL injection is not possible. 
    if ($stmt = $mysqli->prepare("SELECT id, username, password, salt 
        FROM members
       WHERE email = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
 
        // get variables from result.
        $stmt->bind_result($user_id, $username, $db_password, $salt);
        $stmt->fetch();
 
        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts 
 
            if (checkbrute($user_id, $mysqli) == true) {
                // Account is locked 
                // Send an email to user saying their account is locked
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS protection as we might print this value
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                                                                $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', 
                              $password . $user_browser);
                    // Login successful.
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            // No user exists.
            return false;
        }
    }
}

function checkbrute($user_id, $mysqli) {
    // Get timestamp of current time 
    $now = time();
 
    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts 
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
 
        // Execute the prepared query. 
        $stmt->execute();
        $stmt->store_result();
 
        // If there have been more than 5 failed logins 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}

function login_check($mysqli) {
    // Check if all session variables are set 
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM members 
                                      WHERE id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string) {
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Not logged in 
            return false;
        }
    } else {
        // Not logged in 
        return false;
    }
}

function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}

function fbDatabaseEntry($name, $id, $email, $mysqli) {
    //Already an normal account
    if (login_check($mysqli) == true) {
        $user_id = $_SESSION['user_id'];

        if ($stmt = $mysqli->prepare("SELECT id, fbid 
                                      FROM members 
                                      WHERE id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->bind_result($member_id, $fbid);
            $stmt->fetch();
            $stmt->close();
            //Account already linked with FB ID
            if (!$fbid == 0) {
                if (!$member_id==$user_id) {
                    header("Location: /redirect.php?action=FBset");
                    exit;
                }  
            //No FB ID on account
            } else {
                //Check is FB ID already registerd
                if ($fbid_stmt = $mysqli->prepare("SELECT id, fbid 
                                      FROM members 
                                      WHERE fbid = ? LIMIT 1")) {
                    $fbid_stmt->bind_param('i', $id);
                    $fbid_stmt->execute();   // Execute the prepared query.
                    $fbid_stmt->store_result();
                    //ID already registred
                    if (!$fbid_stmt->num_rows == 0) {
                        $fbid_stmt->bind_result($member_id, $member_fbid);
                        $fbid_stmt->fetch();
                        $fbid_stmt->close();
                        //Inlogging person isn't the one with the Facebook ID
                        if (!($member_id==$user_id)) {
                            header("Location: /redirect.php?action=duplicateFB");
                            exit;
                        }
                    } else {
                        //Insert FB ID
                        if ($insert_stmt = $mysqli->prepare("UPDATE members 
                                                    SET fbid = ?
                                                  WHERE id = ? LIMIT 1")) {
                            // Bind "$user_id" to parameter. 
                            $insert_stmt->bind_param('si', $id, $user_id);
                            $insert_stmt->execute();   // Execute the prepared query.
                            $insert_stmt->store_result();
                            $insert_stmt->close();
                        }
                    }
                }
            } 
        }
    //New entry
    } else {
        //If FB ID exists
        if ($stmt = $mysqli->prepare("SELECT id, fbid 
                                      FROM members 
                                      WHERE fbid = ? LIMIT 1")) {
                    $stmt->bind_param('i', $id);
                    $stmt->execute();   // Execute the prepared query.
                    $stmt->store_result();
                    //ID already registred
                    if (!$stmt->num_rows == 0) {
                        $stmt->close();
                        header("Location: profile.php");
                        exit;
                    } else {
                        //ID doens't exsits, create user in DB.
                        $password = "none";
                        $random_salt = "none";
                        if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password, salt, fbid) VALUES (?, ?, ?, ?, ?)")) {
                            $insert_stmt->bind_param('sssss', $name, $email, $password, $random_salt, $id);
                            // Execute the prepared query.
                            if (!$insert_stmt->execute()) {
                                header("Location: /redirect.php?action=FBfail");
                                exit;
                            }
                            else {
                                echo "<script> alert('Registration successful! You are logged in');</script>";
                                header("Location: /profile.php");
                            }
                        }
                    }

        }
    }
}

function existingEvents($mysqli, $logintype) {
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
    }

    $prep_stmt = "SELECT id, name FROM events WHERE creator_id = ?";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // check existing email  
    if ($stmt) {
        $stmt->bind_param('i', $creator_id);
        $stmt->execute();
        $stmt->bind_result($id, $name);
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // A user with this email address already exists
            while ($stmt->fetch()) {
                echo "<a class=\"black\" href=\"".$_SERVER['PHP_SELF']."?edit=".$id."\">".$name."</a><br />";
            }
            $stmt->close();
        }
         //   $stmt->close();
    } else {
        header("Location: /redirect.php?action=errorSession");
        exit;
    }
}

function getEditForm($mysqli) {
    if((isset($_GET['edit'])) && is_numeric($_GET['edit'])) {
        $id = $_GET['edit'];
        $prep_stmt = "SELECT name, description, start, duration, location FROM events WHERE id = ? LIMIT 1";
        $stmt = $mysqli->prepare($prep_stmt);
        
        if ($stmt) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($name, $description, $start, $duration, $location);
            $stmt->store_result();
            $stmt->fetch();
            $stmt->close();
						
						$db = new MysqliDb(HOST, USER, PASSWORD, DATABASE);
						
						$db->where('event_id', $id);
						$db->orderBy('addedAt', 'Desc');
						$SC_object = $db->get('soundcloud', 1);

						if($db->count > 0) {
							$soundcloud_id = $SC_object[0]['id'];
						} else {
							$soundcloud_id = '';
						}

            $start = str_replace(" ", "T", $start);

            echo "<h1 class=\"centered\">EDIT AN EVENT</h1>
                  <form action=\"".esc_url($_SERVER['PHP_SELF'])."\" 
                            method=\"post\" 
                            name=\"event_form\"
                            id=\"eventform\"
                            role=\"form\"
                            class=\"eventform\">
                  <table>
                    <tr><td>Event name: <br /><input type='text' name='name' id='name' value=\"".$name."\"/></td></tr>
                    <tr><td>Start time: <br /><input type=\"datetime-local\" value=\"".$start."\" name=\"time\"></td></tr>
                    <tr><td>Duration: <br /><input type=\"text\" name=\"duration\" id=\"duration\" value=\"".$duration."\"/></td></tr>
                    <tr><td>Location: <br /><input type=\"text\" name=\"location\" id=\"location\" value=\"".$location."\"/></td></tr> 
                    <tr><td>Description: <br /><textarea name=\"description\" id=\"description\">".$description."</textarea></td></tr>
										<input type=\"hidden\" name=\"soundcloud_id\" value=\"".$soundcloud_id."\">  
                    <input type=\"hidden\" name=\"editID\" value=\"".$_GET['edit']."\">";
                  if (isset($_SESSION['login_type'])) { 
                    if (($_SESSION['login_type']=="FB") || ($_SESSION['login_type']=="Both")) {
                    echo "<input type=\"hidden\" name=\"logintype\" value=\"FB\">";    
                  } else {
                    echo "<input type=\"hidden\" name=\"logintype\" value=\"Default\">";  
                     } 
                  } else { 
                    echo "<input type=\"hidden\" name=\"logintype\" value=\"non\">
                    <tr><td>No session set</td></tr>";  
                  }
                  echo "<tr><td><input type=\"submit\" value=\"Update\" /> </td></tr>
                  </table>
                  </form>";
        } else {
            echo "<h1>No event to edit</h1>";
        }
    }
}

function getEvents($mysqli) {
    if(isset($_GET['event'])) {
        $eventID = $_GET['event'];
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
        //DOUBLE CHECKING???
        if ($insert_stmt = $mysqli->prepare("INSERT INTO attendees (event_id, creator_id) VALUES (?, ?)")) {
            $insert_stmt->bind_param('ii', $eventID, $userID);
            // Execute the prepared query.
            if (!$insert_stmt->execute()) {
                echo "<script> alert('Query Error (check database)');</script>";
            } else {
                echo "<script> alert('Success! You are now attending this event.');</script>";
                header("Location: /attendevent.php");
            }
        }
    } else {
        $prep_stmt = "SELECT id, name, description FROM events";
        $stmt = $mysqli->prepare($prep_stmt);
     
       // check existing email  
        if ($stmt) {
            $stmt->execute();
            $stmt->bind_result($id, $name, $description);
            $stmt->store_result();
     
            if ($stmt->num_rows > 0) {
                // A user with this email address already exists
                while ($stmt->fetch()) {
                    echo "<p>".$name."<br />";
                    echo $description."<br />
                    <a class=\"black\" href=\"".$_SERVER['PHP_SELF']."?event=".$id."\">ATTEND</a></p>";
                }
                $stmt->close();
            }
             //   $stmt->close();
        } else {
            header("Location: /redirect.php?action=errorSession");
            exit;
        }
    }
}
?>