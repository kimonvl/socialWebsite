<?php

namespace Model;

defined('ROOTPATH') OR exit("Access denied!");

class Friendship
{
	use Model;

	protected $table = 'friendships';
	protected $allowedColumns = ['id', 'userid', 'friendid', 'date'];
}