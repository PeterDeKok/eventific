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

?>