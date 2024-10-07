<?php

namespace Controller;

defined('ROOTPATH') OR exit("Access denied!");

class Logout
{
	use Controller;

	public function index()
	{
		$ses = new \Core\Session;
		if($ses->is_logged_in())
			$ses->logout();

		redirect("Create_Account");
	}
}