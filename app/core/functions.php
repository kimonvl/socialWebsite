<?php

defined('ROOTPATH') OR exit("Access denied!");

check_extensions();

function check_extensions()
{
	$required_extensions = ['gd', 'mysqli', 'pdo_mysql', 'curl', 'fileinfo', 'intl', 'exif', 'mbstring'];

	$not_load = [];

	foreach ($required_extensions as $ext) {
		if(!extension_loaded($ext))
		{
			$not_load[] = $ext;
		}
	}

	if(!empty($not_load))
	{
		die("Please load the following extensions in your php.ini file: <br>" . implode("<br>", $not_load));
		
	}
}

function current_user($key = '')
{
	$ses = new \Core\Session;
	return $ses->get_user($key);
}

function show($data)
{
	echo "<pre>";
	print_r($data);
	echo "<pre>";
}

function esc($str)
{
	return htmlspecialchars($str);
}

function redirect($path)
{
	header("Location: " . ROOT . "/" . $path);
	die;
}

//load image if not exists else load placeholder
function get_image($file = '', string $type = 'post'):string
{
	$file = $file ?? '';
	if(file_exists($file))
	{
		return ROOT . "/" . $file;
	}

	if($type == 'user')
	{
		return ROOT . "/assets/images/no_user.png";
	}else
	{
		return ROOT . "/assets/images/no_image.png";
	}
}

//returns pagination links
function get_pagination_vars():array
{
	$vars = [];
	$vars['page'] = $_GET['page'] ?? 1;
	$vars['page'] = (int)$vars['page'];
	$vars['prev_page'] = $vars['page'] - 1 > 0 ? $vars['page'] - 1 : 1;
	$vars['next_page'] = $vars['page'] + 1;

	return $vars;
}

//saves or displays a saved message to the user
function message(string $msg = null, bool $clear = false)
{
	$ses = new Core\Session();

	if(!empty($msg))
	{
		$ses->set('message', $msg);
	}else if(!empty($ses->get('message')))
	{
		$msg = $ses->get('message');
		if($clear)
			$ses->pop('message');

		return $msg;
	}
	return false;
}

//retains the old check value
function old_checked(string $key, string $value, string $default = ""):string
{
	if($value == '')
		return "";
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST[$key]))
	{
		if($_POST[$key] == $value)
			return " checked ";
	}else if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET[$key]))
	{
		if($_GET[$key] == $value)
			return " checked ";
	}else if($_SERVER['REQUEST_METHOD'] != 'POST' && empty($_GET) && $value == $default)
	{
		return " checked ";
	}
	return "";
}

//retains old value of an input
function old_value(string $key, $default = "", string $mode = 'post')
{
	$POST = ($mode == 'post') ? $_POST : $_GET;
	if(isset($POST[$key]))
		return $POST[$key];

	return $default;
}

//retains old select value of an input
function old_select(string $key, $value, $default = "", string $mode = 'post')
{
	$POST = ($mode == 'post') ? $_POST : $_GET;
	if(isset($POST[$key]))
	{
		if($POST[$key] == $value)
			return " selected ";
	}else if($default == $value)
	{
		return " selected ";
	}
	return "";
}

function get_date($date)
{
	return date("jS M, Y", strtotime($date));
}

//returns url variables
function URL($key)
{
	$URL = $_GET['url'] ?? "home";
	$URL = explode("/", trim($URL, "/"));

	switch ($key) {
		case 'page':
		case 0:
			return $URL[0] ?? null;
			break;
		case 'section':
		case 1:
			return $URL[1] ?? null;
			break;
		case 'action':
		case 2:
			return $URL[2] ?? null;
			break;
		case 'id':
		case 3:
			return $URL[3] ?? null;
			break;
		
		default:
			return null;
			break;
	}
}