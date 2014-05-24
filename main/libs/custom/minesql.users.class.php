<?php
//This page handles all users and user functions
//Database functions should be included in the original configuration.

//Development uses
require 'minesql.database.php';
require 'minesql.database.class.php';

//Password hashing algorithm - DO NOT REMOVE
require 'minesql.password.php';


class user {
	//Returns message and error bool - also starts session
	function checkLogin($db, $username, $password) {
		$sql = "SELECT * from `accounts` WHERE username=:username";
		$stmt = $db->prepare($sql);
		$stmt->execute(array(':username' => $username));
		if($account = $stmt->fetch()){
			if($account['banned']==0) {
				if($account['active']==1) {
					if(password_verify($password, $account['hash'])) {
						$_SESSION['user'] = $account;
						unset($_SESSION['user']['hash']);
						$return['message'] = "You are now logged in.";
						$return['error'] = false;
					} else {
						$return['message'] = "Incorrect password for the given account.";
						$reutrn['error'] = true;
					}
				} else {
					$return['message'] = "This account is not activated.".$account['active'];
					$return['error'] = true;
				}
			} else {
				$return['message'] = "This account is banned.";
				$return['error'] = true;
			} //banned
		} else {
			$return['message'] = "Could not find any account under the specified username.";
			$return['error'] = true;
		}
		//returns data(regardless of if it is true or false)
		return $return;
	}

	function register($db, array $info) {
		if($info['username']==""||$info['password']==""||$info['cpassword']==""||$info['email']=="") {
			$return['message'] = "Not all the fields were filled.";
			$return['error'] = true;
		} else {
			if($info['password']!=$info['cpassword']){
				$return['message'] = "Passwords do not match.";
				$return['error'] = true;
			} else {
				$sql = 'SELECT username FROM accounts WHERE username=:username LIMIT 1';
				$stmt = $db->prepare($sql);
				$stmt->execute(array(':username' => $info['username']));
				if($stmt->fetch()) {
					$return['message'] = "Username is already in use";
					$return['error'] = true;
				} else {
					$info['hash'] = password_hash($info['password'], PASSWORD_DEFAULT);
					$query = new database();
					$result = $query->insert_table($db, "accounts", array(
																'username' => $info['username'],
																'email' => $info['email'],
																'hash' => $info['hash'],
																'ip' => $info['ip']
																));
					if($result) {
						$return['error'] = false;
						$return['message'] = "User account created.";
					} else {
						$return['error'] = true;
						$return['message'] = "User account could not be created.";
					}
				}
			}
		}
		return $return;
	}
}

class admin {
	//Only really useful if creating a new table that complies with the login/register code below
	function create_user_table($db) {
		$items = array(
				'username' => array("type" => "VARCHAR",
					 		  		"length" => "(60)"
						           ),
				'email' => array("type" => "VARCHAR",
					 		  	 "length" => "(60)"
						           ),
				'hash' => array("type" => "VARCHAR",
					 		  	"length" => "(255)"
						       ),
				'ip' => array("type" => "VARCHAR",
					 		  "length" => "(45)"
						           ),
				'active' => array("type" => "TINYINT", //Useful for email verification or payment for account
					 		  	  "length" => "(1) default 1" //If user accounts are automatically activated or not
						           ),
				'banned' => array("type" => "TINYINT",
					 		  	  "length" => "(1) default 0"
						           ),
				'admin' => array("type" => "TINYINT",
					 		  	 "length" => "(1) default 0"
						           ),
				'join_date' => array("type" => "TIMESTAMP",
					 		  		"length" => ""
						           ),
				 );
		$query = new database();
		if($query->create_table($db, "accounts", $items)){
			return true;
		} else {
			return false;
		}
	}
}

