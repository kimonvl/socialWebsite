<?php

namespace Model;

defined('ROOTPATH') OR exit("Access denied!");

class User
{
	use Model;

	protected $table = "users";

	protected $allowedColumns = ['id', 'username', 'email', 'password', 'image', 'date'];

	public function validate($data)
	{
		$this->errors = [];
		if(empty($data['username']))
			$this->errors['username'] = "An username is required";
		elseif(!preg_match('/^[a-zA-Z]+$/', $data['username']))
			$this->errors['username'] = "Username must be only letters without spaces";

		if(empty($data['email']))
			$this->errors['email'] = "An email is required";
		elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
			$this->errors['email'] = "Invalid email";

		if($this->where(['email' => $data['email']]))
			$this->errors['email'] = "Email already in use";

		if(empty($data['password']))
			$this->errors['password'] = "A password is required";

		if (empty($this->errors))
			return true;
		else
			return false;
	}
}