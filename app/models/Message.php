<?php

namespace Model;

defined('ROOTPATH') OR defined('SERVERPATH') OR exit("Access denied!");

class Message
{
	use Model;

	protected $table = 'message';
	protected $allowedColumns = ['id', 'message_text', 'date', 'conversation_id', 'sender_id'];
}