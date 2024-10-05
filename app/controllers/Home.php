<?php

namespace Controller;

defined('ROOTPATH') OR exit("Access denied!");

class Home
{
	use Controller;

	public function index()
	{
		$user = new \Model\User;
		$ses = new \Core\Session;
		$data['user_row'] = $user->first(['id' => $ses->get_user('id')]);
		$this->view('home', $data);
	}
}
