<?php

namespace Model;

defined('ROOTPATH') OR exit("Access denied!");

class FriendRequest
{
	use Model;

	protected $table = 'friendrequests';
	protected $allowedColumns = ['id', 'senderid', 'recieverid', 'accepted', 'date'];
}