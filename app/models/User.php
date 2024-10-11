<?php

namespace Model;

defined('ROOTPATH') OR exit("Access denied!");

class User
{
	use Model;

	protected $table = "users";

	protected $allowedColumns = ['id', 'username', 'email', 'password', 'image', 'date'];

	public function addSenderUserToFriendReq($friendRequests)
	{
		if(empty($friendRequests) || !is_array($friendRequests))
			return;
		foreach ($friendRequests as $request) {
			$request->sender = $this->get_row("select * from users where id = :id limit 1", ['id' => $request->senderid]);
		}
		return $friendRequests;
	}

	public function add_users_to_friendships($friendships, $user_id)
	{
		if(empty($friendships) || !is_array($friendships))
			return;

		foreach ($friendships as $friendship)
		{
			$friendship->friend = $friendship->userid == $user_id ? $this->first(['id' => $friendship->friendid]) : $this->first(['id' => $friendship->userid]);
		}

		return $friendships;
	}

	public function addUserToMembers($conversations)
	{
		if(empty($conversations) || !is_array($conversations))
			return;
		foreach ($conversations as $conversation)
		{
			foreach ($conversation->members as $member)
			{
				$member->user = $this->first(['id' => $member->user_id]);
			}
		}
		return $conversations;
	}

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

		if(is_array($this->where(['email' => $data['email']])))
			$this->errors['email'] = "Email already in use";

		if(empty($data['password']))
			$this->errors['password'] = "A password is required";

		if (empty($this->errors))
			return true;
		else
			return false;
	}
}