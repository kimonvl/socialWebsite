<?php

namespace Model;

defined('ROOTPATH') OR exit("Access denied!");

class Post
{
	use Model;

	protected $table = 'posts';
	protected $allowedColumns = ['image', 'userid', 'content', 'date'];

	public function validate($data)
	{
		$this->errors = [];
		if(empty($data))
			$this->errors['post'] = "Please write something to post";

		if (empty($this->errors))
			return true;
		else
			return false;
	}

	public function add_users_to_posts($posts)
	{
		if(empty($posts) || !is_array($posts))
			return;
		foreach ($posts as $post) {
			$post->owner = $this->get_row("select * from users where id = :id limit 1", ['id' => $post->userid]);
		}
		return $posts;
	}
}
