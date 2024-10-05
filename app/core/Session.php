<?php

namespace Core;

defined('ROOTPATH') OR exit("Access denied!");

class Session
{
	private $appKey = "APP";
	private $userKey = "USER";
	//activate session if not yet started
	private function start_session():int
	{
		if(session_status() == PHP_SESSION_NONE)
			session_start();

		return 1;
	}

	//put data into the session
	public function set($keyOrArray, $value = ''):int
	{
		$this->start_session();

		if(is_array($keyOrArray))
		{
			foreach ($keyOrArray as $key => $value) {
				$_SESSION[$this->appKey][$key];
			}
			return 1;
		}

		$_SESSION[$this->appKey][$keyOrArray] = $value;

		return 1;
	}

	//get data from the session . Default is returned if data not found
	public function get(string $key, $default = '')
	{
		$this->start_session();

		if(isset($_SESSION[$this->appKey][$key]))
			return $_SESSION[$this->appKey][$key];

		return $default;
	}

	//saves the user row data into session after login
	public function auth($user_row)
	{
		$this->start_session();

		$_SESSION[$this->userKey] = $user_row;

		return 0;
	}

	//removes user data from the session
	public function logout():int
	{
		$this->start_session();

		if(!empty($_SESSION[$this->userKey]))
			unset($_SESSION[$this->userKey]);

		return 0;
	}

	//check if user is logged in
	public function is_logged_in():bool
	{
		$this->start_session();

		if(!empty($_SESSION[$this->userKey]))
			return true;

		return false;
	}

	//returns data from a column of the user row logged in the session
	public function get_user(string $key = '', $default = '')
	{
		$this->start_session();

		if(empty($key) && !empty($_SESSION[$this->userKey]))
		{
			return $_SESSION[$this->userKey];
		}else if(!empty($_SESSION[$this->userKey]->$key))
		{
			return $_SESSION[$this->userKey]->$key;
		}

		return $default;
	}

	//return data from key and deletes it
	public function pop(string $key, $default = '')
	{
		$this->start_session();

		if(!empty($_SESSION[$this->appKey][$key]))
		{
			$value = $_SESSION[$this->appKey][$key];
			unset($_SESSION[$this->appKey][$key]);
			return $value;
		}

		return $default;
	}

	//returns all data from the APP array of Session
	public function all()
	{
		$this->start_session();

		if(isset($_SESSION[$this->appKey]))
			return $_SESSION[$this->appKey];

		return [];
	}
}