<?php

defined('ROOTPATH') OR exit("Access denied!");

spl_autoload_register(function ($class_name){

	$class_name = explode("\\", $class_name);
	$class_name = end($class_name);
	require "../app/models/" . ucfirst($class_name) . ".php";

});

require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';
require 'Session.php';
require 'Request.php';