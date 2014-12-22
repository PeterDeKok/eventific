<?php

/**
 * Session Class
 * 
 * Session Handler.
 * Handles session data through Database, instead of files.
 * Implemented for safety.
 * 
 * @category  Session Handling
 * @package   Session
 * @author    Peter de Kok <info@peterdekok.nl>
 * @copyright 2014 peterdekok.nl
 * @version   0.9
 * @uses			../psl-config.php (for database authorization)
 * @uses 			MysqliDb.class.php
 */

class session {
	
	var $sess_class_db_host;
	var $sess_class_db_user;
	var $sess_class_db_pass;
	var $sess_class_db_name;
	var $sess_class_db_port;
	
	function __construct($host, $username, $password, $db, $port = NULL) {
	
		/**
		 * Holder variables
		 */
		$this->sess_class_db_host = $host;
		$this->sess_class_db_user = $username;
		$this->sess_class_db_pass = $password;
		$this->sess_class_db_name = $db;
		$this->sess_class_db_port = $port;
		
		
		// Register custom session function
		session_set_save_handler(array($this, 'open'), array($this, 'close'), array($this, 'read'), array($this, 'write'), array($this, 'destroy'), array($this, 'gc'));
		
		//Safeguard for objects as save handlers
		register_shutdown_function('session_write_close');
	}
	
	function start_session($session_name, $secure) {
		
		// Deny access through clientside scripts
		$httponly = true;
		
		// Hash algorithm
		$session_hash = 'sha512';
		
		// Check algorithm
		if (in_array($session_hash, hash_algos())) {
			// Set hah function
			ini_set('session.hash_function', $session_hash);
		}
		
		// Bits per char of hash
		ini_set('session.hash_bits_per_character', 5);
		
		// Force session to only use cookies, not URL variables
		ini_set('session_use_only_cookies', 1);
		
		// Get session cookie parameters
		$cookieParams = session_get_cookie_params();
		
		// Set session cookie parameters
		session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
		
		// Change the session name
		session_name($session_name);
		
		// Start session
		session_start();
		
		// Regenerate session, delete old session, generate new encrytion key in db
		session_regenerate_id(true);
	}
	
	function open() {
		$LD_sessDB = new MysqliDb($this->sess_class_db_host, $this->sess_class_db_user, $this->sess_class_db_pass, $this->sess_class_db_name, $this->sess_class_db_port);
		$this->db = $LD_sessDB;
		return true;
	}
	
	function close() {
		unset($this->db);
		return true;
	}
	
	function read($id) {
		$this->db->where("id", $id);
		$data = $this->db->getOne("sessions", "data");
		if(isset($data["data"])) {
			$data = $data["data"];
		} else {
			header('Location: '.$_SERVER['REQUEST_URI']);
		}
		
		$key = $this->getkey($id);
		$data = $this->decrypt($data, $key);
		
		return $data;
	}
	
	function write($id, $data) {
		// Get Unique ID
		$key = $this->getkey($id);
		// Encypt data
		$data = $this->encrypt($data, $key);
		
		$time = time();
		
		$params = array($id, $time, $data, $key);
		$this->db->rawQuery("REPLACE INTO sessions (id, set_time, data, session_key) VALUES (?, ?, ?, ?)", $params);
		
    return true;
	}
	
	function destroy($id) {
		$this->db->where('id', $id);
		$this->db->delete('sessions');
		
		return true;
	}
	
	function gc($max) {
		$old = time() - $max;
		$this->db->where('set_time', array('<' => $old));
		$this->db->delete('sessions');
		
		return true;
	}
	
	private function getkey($id) {
		$this->db->where("id", $id);
		$key = $this->db->getOne("sessions", "session_key");
		if(count($key)==1) {
			$key = $key["session_key"];
			return $key;
		} else {
			$random_key = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
			
			return $random_key;
		}
	}
	
	private function encrypt($data, $key) {
		$salt = 'zH!ye!retReGu7ksbEDRup7fafDUh9THeD2CHeGE*ewr47e9=E@rAsp7c-gh@pH';
		
		$key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB, $iv));
		
		return $encrypted;
	}
	
	private function decrypt($data, $key) {
		$salt = 'zH!ye!retReGu7ksbEDRup7fafDUh9THeD2CHeGE*ewr47e9=E@rAsp7c-gh@pH';
		
		$key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($data), MCRYPT_MODE_ECB, $iv);
		
		return $decrypted;
	}
}
?>


