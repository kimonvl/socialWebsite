<?php

namespace Controller;

defined('ROOTPATH') OR exit("Access denied!");

class _404
{
	use Controller;

	public function index()
	{
		$this->view("404");
	}
}
