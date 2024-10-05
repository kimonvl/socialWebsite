<?php

namespace Controller;

defined('ROOTPATH') OR exit("Access denied!");

class _404
{
	use Controller;

	public function index()
	{
		echo "404 page not found controller";
	}
}
