<?php

ob_start();
$root = $_SERVER['DOCUMENT_ROOT']."/..";

require_once($root . '/assets/includes/classes/MysqliDb.class.php');
require_once($root . '/assets/includes/classes/session.class.php');

require_once($root . '/assets/includes/db_connect.php');
require_once($root . '/assets/includes/functions.php');
require_once($root . '/assets/includes/register.inc.php');

// Prepare Session
$custom_session = new session(SESS_HOST, SESS_USER, SESS_PASSWORD, SESS_DATABASE);
// Start Session: true for https, false for http !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$custom_session->start_session('_s', false);

//Facebook
require_once 'autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphSessionInfo;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HTTPCLients\FacebookCurl;
use Facebook\HttpClients\FacebookHttpable;
use Facebook\GraphUser;

    //Set Facebook session
    FacebookSession::setDefaultApplication( '608927005878535','3322412829577633697ed1fdbc6f8c34' );
    //Login helper
    $helper = new FacebookRedirectLoginHelper('http://eventific.dev/loginFB.php' );

    // see if a existing session exists
    if (isset($_SESSION) && isset($_SESSION['fb_token'])) {
        // create new session from saved access_token
        $session = new FacebookSession($_SESSION['fb_token']);
        // validate the access_token to make sure it's still valid
        try {
            if (!$session->validate()) {
                $session = null;
            }
        } catch (Exception $e) {
            // catch any exceptions
            $session = null;
        }
    } else {
        // no session exists
        try {
            $session = $helper->getSessionFromRedirect();
        } catch (FacebookRequestException $ex) {
            // When Facebook returns an error
        } catch (Exception $ex) {
            // When validation fails or other local issues
            echo $ex->message;
        }
    }

    // see if we have a session
    if (isset($session)) {
        // save the session
        $_SESSION['fb_token'] = $session->getToken();
        // create a session using saved token or the new one we generated at login
        $session = new FacebookSession($session->getToken());
        // graph api request for user data
        $request = new FacebookRequest($session, 'GET', '/me');
        $response = $request->execute();
        $graphObject = $response->getGraphObject()->asArray();
                        $user_profile = (new FacebookRequest(
                          $session, 'GET', '/me'
                        ))->execute()->getGraphObject(GraphUser::className());
        
        $user_friends = (new FacebookRequest(
                          $session, 'GET', '/me/friends'
                        ))->execute()->getGraphObject()->asArray();

        $result = array();
        foreach ($user_friends['data'] as $key => $value) {
            $result[$key]['name'] = $value->name;
            $result[$key]['id'] = $value->id;
        }
        $_SESSION['user_friends'] = $result;

        /* 
        foreach ($friends as $i => $row) {
                        echo $row['name'] ."<br />";
                        echo "ID: " . $row['id'] ."<br />";
                    }
        */

        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();

        $_SESSION['FB'] = true;

        $_SESSION['username'] = $graphObject['name'];
        $_SESSION['id'] = $graphObject['id'];
        $_SESSION['first_name'] = $graphObject['first_name'];
        $_SESSION['last_name'] = $graphObject['last_name'];
        $_SESSION['gender'] = $graphObject['gender'];
        $_SESSION['email'] = $graphObject['email'];

        //Check if user exsits in DB, else put it in or add the Facebook id.
        fbDatabaseEntry($graphObject['name'], $graphObject['id'], $graphObject['email'], $mysqli);

        header('Location: profile.php');
    } else {
        header('Location: ' . $helper->getLoginUrl(array( 'email', 'user_friends' )));
    }

?>