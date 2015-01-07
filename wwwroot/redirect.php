<?php

$root = $_SERVER['DOCUMENT_ROOT']."/..";

require_once($root . '/assets/includes/psl-config.php'); 

if(DEBUG) {
    ini_set("display_errors", "1");
    error_reporting(E_ALL);
}

require_once($root . '/assets/includes/classes/MysqliDb.class.php');
require_once($root . '/assets/includes/classes/session.class.php');

require_once($root. '/assets/includes/functions.php');

$msg = '';
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'succeed') {
        $msg = 'Logged successfully...';
        echo '<p class="lead">' . $msg . '</p>';
        header('Refresh: 2; URL=index.php');
    } else if ($_GET['action'] == 'timeover') {
        // Prepare Session
        $custom_session = new session(SESS_HOST, SESS_USER, SESS_PASSWORD, SESS_DATABASE);
        // Start Session: true for https, false for http !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $custom_session->start_session('_s', false);
        // Unset all session values 
        $_SESSION = array();
        // get session parameters 
        $params = session_get_cookie_params();
        // Delete the actual cookie. 
        setcookie(session_name(),
                '', time() - 42000, 
                $params["path"], 
                $params["domain"], 
                $params["secure"], 
                $params["httponly"]);
        // Destroy session 
        session_destroy();
        $msg = 'Inactivity so long, now need to sign-in again.';
        header('Refresh: 2; URL=index.php');        
        echo '<p class="lead">' . $msg . '';
    } else if ($_GET['action'] == 'logout') {
        // Prepare Session
        $custom_session = new session(SESS_HOST, SESS_USER, SESS_PASSWORD, SESS_DATABASE);
        // Start Session: true for https, false for http !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $custom_session->start_session('_s', false);
        // Unset all session values 
        $_SESSION = array();
        // get session parameters 
        $params = session_get_cookie_params();
        // Delete the actual cookie. 
        setcookie(session_name(),
                '', time() - 42000, 
                $params["path"], 
                $params["domain"], 
                $params["secure"], 
                $params["httponly"]);
        // Destroy session 
        session_destroy();
        $msg = 'Logged out. Now come back to homepage';
        header('Refresh: 1; URL=index.php');        
        echo '<p class="lead">' . $msg . '';
    } else if ($_GET['action'] == 'FBset') {
        // Prepare Session
        $custom_session = new session(SESS_HOST, SESS_USER, SESS_PASSWORD, SESS_DATABASE);
        // Start Session: true for https, false for http !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $custom_session->start_session('_s', false);
        // Unset all session values 
        $_SESSION = array();
        // get session parameters 
        $params = session_get_cookie_params();
        // Delete the actual cookie. 
        setcookie(session_name(),
                '', time() - 42000, 
                $params["path"], 
                $params["domain"], 
                $params["secure"], 
                $params["httponly"]);
        // Destroy session 
        session_destroy();
        $msg = 'This account is already linked with a Facebook profile. Logging out..';
        header('Refresh: 2; URL=index.php');        
        echo '<p class="lead">' . $msg . '';
    } else if ($_GET['action'] == 'duplicateFB') {
        // Prepare Session
        $custom_session = new session(SESS_HOST, SESS_USER, SESS_PASSWORD, SESS_DATABASE);
        // Start Session: true for https, false for http !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $custom_session->start_session('_s', false);
        // Unset all session values 
        $_SESSION = array();
        // get session parameters 
        $params = session_get_cookie_params();
        // Delete the actual cookie. 
        setcookie(session_name(),
                '', time() - 42000, 
                $params["path"], 
                $params["domain"], 
                $params["secure"], 
                $params["httponly"]);
        // Destroy session 
        session_destroy();
        $msg = 'This Facebook account is already linked with an other account. Logging out...';
        header('Refresh: 3; URL=index.php');        
        echo '<p class="lead">' . $msg . '';
    } else if ($_GET['action'] == 'FBfail') {
        // Prepare Session
        $custom_session = new session(SESS_HOST, SESS_USER, SESS_PASSWORD, SESS_DATABASE);
        // Start Session: true for https, false for http !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $custom_session->start_session('_s', false);
        // Unset all session values 
        $_SESSION = array();
        // get session parameters 
        $params = session_get_cookie_params();
        // Delete the actual cookie. 
        setcookie(session_name(),
                '', time() - 42000, 
                $params["path"], 
                $params["domain"], 
                $params["secure"], 
                $params["httponly"]);
        // Destroy session 
        session_destroy();
        $msg = 'Something went wrong, please try again...';
        header('Refresh: 2; URL=index.php');        
        echo '<p class="lead">' . $msg . '';
    } else if ($_GET['action'] == 'invalid_permission') {
        // Prepare Session
        $custom_session = new session(SESS_HOST, SESS_USER, SESS_PASSWORD, SESS_DATABASE);
        // Start Session: true for https, false for http !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $custom_session->start_session('_s', false);
        // Unset all session values 
        $_SESSION = array();
        // get session parameters 
        $params = session_get_cookie_params();
        // Delete the actual cookie. 
        setcookie(session_name(),
                '', time() - 42000, 
                $params["path"], 
                $params["domain"], 
                $params["secure"], 
                $params["httponly"]);
        // Destroy session 
        session_destroy();
        $msg = 'Invalid permission. Come back to homepage...';
        header('Refresh: 2; URL=index.php');        
        echo '<p class="lead">' . $msg . '';
    } else if ($_GET['action'] == 'errorSession') {
        // Prepare Session
        $custom_session = new session(SESS_HOST, SESS_USER, SESS_PASSWORD, SESS_DATABASE);
        // Start Session: true for https, false for http !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $custom_session->start_session('_s', false);
        // Unset all session values 
        $_SESSION = array();
        // get session parameters 
        $params = session_get_cookie_params();
        // Delete the actual cookie. 
        setcookie(session_name(),
                '', time() - 42000, 
                $params["path"], 
                $params["domain"], 
                $params["secure"], 
                $params["httponly"]);
        // Destroy session 
        session_destroy();
        $msg = 'Error.. Returning home';
        header('Refresh: 2; URL=index.php');        
        echo '<p class="lead">' . $msg . '';
    }
} else {
    header('Location: index.php');
}