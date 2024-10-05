<?php

defined('ROOTPATH') OR exit("Access denied!");

class App
{
	private $controller = 'Home';
	private $method = 'index';

	private function splitURL()
	{
		$URL = $_GET['url'] ?? "home";
		$URL = explode("/", trim($URL, "/"));
		return $URL;	
	}

	public function loadController()
	{
		$URL = $this->splitURL();
		
		//select controller
		$filename = "../app/controllers/" . ucfirst($URL[0]) . ".php";
		if(file_exists($filename))
		{
			require $filename;
			$this->controller = ucfirst($URL[0]);
			unset($URL[0]);
			$this->method = $URL[1] ?? $this->method;
			unset($URL[1]);
		}else
		{
			$filename = "../app/controllers/_404.php";
			require $filename;
			$this->controller = '_404';
		}

		//select method
		$c = '\Controller\\' . $this->controller;
		$myController = new $c;
		if(method_exists($myController, $this->method))
		{
			call_user_func_array([$myController, $this->method], $URL);
		}else
		{
			call_user_func_array([$myController, 'index'], $URL);
		}
	}
}