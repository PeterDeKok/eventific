<?php
$root = $_SERVER['DOCUMENT_ROOT']."/..";
include_once $root. '/assets/includes/db_connect.php';
include_once $root. '/assets/includes/functions.php';
 
sec_session_start(); // Our custom secure way of starting a PHP session.
$root = $_SERVER['DOCUMENT_ROOT'];
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // The hashed password.
 
    if (login($email, $password, $mysqli) == true) {
        // Login success 
        header('Location: /profile.php');
    } else {
        // Login failed 
        header('Location: /error.php?err=1');
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}