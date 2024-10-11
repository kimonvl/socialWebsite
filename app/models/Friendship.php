<?php

namespace Model;

defined('ROOTPATH') OR exit("Access denied!");

class Friendship
{
	use Model;

	protected $table = 'friendship';
	protected $allowedColumns = ['id', 'userid', 'friendid', 'date'];

	public function friends_of($user_id)
	{
		$query = "select * from $this->table where userid = :id || friendid = :id";
		return $this->query($query, ['id' => $user_id]);
	}
}