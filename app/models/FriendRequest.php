<?php

namespace Model;

defined('ROOTPATH') OR exit("Access denied!");

class FriendRequest
{
	use Model;

	protected $table = 'friendrequest';
	protected $allowedColumns = ['id', 'senderid', 'recieverid', 'accepted', 'date'];
}