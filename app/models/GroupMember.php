<?php

namespace Model;

defined('ROOTPATH') OR defined('SERVERPATH') OR exit("Access denied!");

class GroupMember
{
	use Model;

	protected $table = 'group_member';
	protected $allowedColumns = ['user_id', 'conversation_id', 'joined_date', 'left_date'];

	//$conversations contain the rows of the table group_member with id equal to the user id(i.e. all the conversations that a user is member of).The function adds the remaining members of each conversation apart from the current user
	public function addMembersToConversation($conversations, $userid)
	{
		if(empty($conversations) || !is_array($conversations))
			return;
		foreach ($conversations as $conversation)
		{
			$conversation->members = $this->where(['conversation_id' => $conversation->conversation_id], ['user_id' => $userid]);
		}
		return $conversations;
	}
}