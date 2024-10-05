<?php

namespace Controller;

defined('ROOTPATH') OR exit("Access denied!");

class Create_Account
{
	use Controller;

	public function index()
	{
		$req = new \Core\Request;
		$data = [];
		if($req->posted())
		{
			$type = $req->post_get('type') ?? '';
			$req->post_pop('type');
			if($type == 'signup')
			{
				$data = $this->signup($req->post_get());
			}
			elseif($type == 'login')
			{
				$data = $this->login($req->post_get()); 
			}
		}
		$this->view('create_account', $data);
	}

	private function signup($data)
	{
		$user = new \Model\User;
		if($user->validate($data))
			{
				$password = password_hash($data['password'], PASSWORD_DEFAULT);
				$data['date'] = date("Y-m-d H:i:s");
				$data['password'] = $password;
				$user->insert($data);
			}

			$data['errors_signup'] = $user->errors;
			return $data;
	}

	private function login($data)
	{
		$user = new \Model\User;
		if($row = $user->first(['email' => $data['email']]))
		{
			//check if password is correct
			if(password_verify($data['password'], $row->password))
			{
				//authenticate
				$ses = new \Core\Session;
				$ses->auth($row);
				redirect('home');
			}

		}
		$data['errors_login'] = "Wrong email or password";
		return $data;
	}
}
