<?php

namespace Core;

defined('ROOTPATH') OR exit("Access denied!");

class Request
{
	//check which post method was used
	public function method():string
	{
		return $_SERVER['REQUEST_METHOD'];
	}

	//check if something was posted
	public function posted():bool
	{
		if($_SERVER['REQUEST_METHOD'] == "POST" && count($_POST) > 0)
			return true;

		return false;
	}

	//get a value from the POST variable
	public function post_get(string $key = '', $default = '')
	{
		if(empty($key))
		{
			return $_POST;
		}else if(isset($_POST[$key]))
		{
			return $_POST[$key];
		}

		return $default;
	}

	//unset a value from post variable
	public function post_pop(string $key = '', $default = '')
	{
		if(isset($_POST[$key]))
			unset($_POST[$key]);
	}

	//get a value from the FILES variable
	public function files(string $key = '', $default = '')
	{
		if(empty($key))
		{
			return $_FILES;
		}else if(isset($_FILES[$key]))
		{
			return $_FILES[$key];
		}

		return $default;
	}

	//get a value from the GET variable
	public function get(string $key = '', $default = '')
	{
		if(empty($key))
		{
			return $_GET;
		}elseif (isset($_GET[$key]))
		{
			return $_GET[$key];
		}

		return $default;
	}

	//get a value from the REQUEST variable
	public function input(string $key, $default = '')
	{
		if(isset($_REQUEST[$key]))
			return $_REQUEST[$key];

		return $default;
	}

	//get all values from the request variable
	public function all()
	{
		return $_REQUEST;
	}
}