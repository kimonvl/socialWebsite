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
		$post = new \Model\Post;
		$limit = 10;
		$data['pager'] = new \Core\Pager($limit);
		$offset = $data['pager']->offset;
		$post->limit = $limit;
		$post->offset = $offset;
		if(!$ses->is_logged_in())
			redirect("Create_account");

		$post->limit = $limit;
		$post->offset = $offset;

		$id = empty($id) ? $ses->get_user('id') : $id;
		$data['userRow'] = $user->first(['id' => $id]);
		$data['posts'] = $post->where(['userid' => $id]);
		$data['posts'] = $post->add_users_to_posts($data['posts']);
		
		$this->view('profile', $data);
	}
}