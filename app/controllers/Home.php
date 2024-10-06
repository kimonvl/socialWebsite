<?php

namespace Controller;

defined('ROOTPATH') OR exit("Access denied!");

class Home
{
	use Controller;

	public function index()
	{
		$user = new \Model\User;
		$post = new \Model\Post;
		$ses = new \Core\Session;
		$limit = 1;
		$data['pager'] = new \Core\Pager($limit);
		$offset = $data['pager']->offset;
		if(!$ses->is_logged_in())
			redirect("Create_Account");
		$data['user_row'] = $user->first(['id' => $ses->get_user('id')]);
		$post->order_column = 'date';
		$post->limit = $limit;
		$post->offset = $offset;
		$data['posts'] = $post->where();
		$data['posts'] = $post->add_users_to_posts($data['posts']);

		$this->view('home', $data);
	}
}
