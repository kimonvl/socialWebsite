<?php

namespace Model;

defined('ROOTPATH') OR exit("Access denied!");

class Conversation
{
	use Model;

	protected $table = 'conversation';
	protected $allowedColumns = ['id', 'name'];
}