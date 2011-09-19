<?php
/*
 * Tikapot Auth Module
 * 
 * This file contains models that are essential for
 * the correct operation of tikapot core modules
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

global $home_dir;
require_once($home_dir . "framework/model.php");
require_once($home_dir . "framework/model_fields/init.php");

class UserSession extends Model
{
	public function __construct() {
		parent::__construct();
		$this->add_field("userid", new PKField());
		$this->add_field("keycode", new CharField($max_length=40));
		$this->add_field("expires", new DateTimeField());
	}
}

class AuthException extends Exception {}

class User extends Model
{
	public function __construct() {
		parent::__construct();
		$this->add_field("username", new CharField($max_length=40));
		$this->add_field("password", new CharField($max_length=40));
		$this->add_field("email", new CharField($max_length=50));
		$this->add_field("created", new DateTimeField($auto_now_add = True));
		$this->add_field("last_login", new DateTimeField($auto_now_add = True, $auto_now = True));
		
		if(!session_id())
			session_start();
	}
	
	private function logout($session) {
		$usersession->delete();
	}
	
	private function construct_session($try = 0) {
		list($usersession, $created) = UserSession::get_or_create(array("userid"=>$this->pk));
		if ($created) {
			$usersession->keycode = sha1($this->pk + (microtime() * rand(0, 198)));
			$expiry = time() + ($GLOBALS['config_session_timeout']); // 1 hour
			$usersession->expires = date(DateTimeField::$FORMAT, $expiry);
			$usersession->save();
		} else {
			if ($usersession->expires > date(DateTimeField::$FORMAT, time())) {
				if ($try == 0) {
					$this->logout($usersession);
					return $this->construct_session(1);
				}
				die("Error: Cannot logout!");
			}
		}
		$_SESSION['user'] = array("userid"=>$this->pk, "keycode"=>$usersession->keycode);
	}
	
	private static function encode($password) { return sha1($password); }
	
	public static function auth($username, $password) {
		$password = User::encode($password);
		$arr = User::find(array("username"=>$username, "password"=>$password));
		if (count($arr) <= 0)
			return false;
		$user = $arr->get(0);
		$user->construct_session();
		return true;
	}
	
	/* Shortcut */
	public static function create_user($username, $password, $email) {
		$password = User::encode($password);
		if(User::find(array("username"=>$username))->count() > 0)
			throw new AuthException("Error: Username exists!");
		return User::create(array("username"=>$username, "password" => $password, "email" => $email));
	}
	
	/* Shortcut */
	public static function delete_user($username) {
		try {
			$user = User::get(array("username"=>$username));
			$user->delete();
		}
		catch (ModelQueryException $e) {
			return false;
		}
		return true;
	}
}


?>

