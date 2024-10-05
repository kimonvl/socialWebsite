<?php

namespace Controller;

defined('ROOTPATH') OR exit("Access denied!");

class Profile
{
	use Controller;

	public function index($id = '')
	{
		$ses = new \Core\Session;
		$user = new \Model\User;
		if(!$ses->is_logged_in())
			redirect("Create_account");

		$id = empty($id) ? $ses->get_user('id') : $id;
		$data['userRow'] = $user->first(['id' => $id]);
		$this->view('profile', $data);
	}
}