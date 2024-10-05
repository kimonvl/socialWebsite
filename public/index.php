<?php

session_start();

//valid PHP version
$minPHPVersion = '7.0';
if(phpversion() < $minPHPVersion)
{
	die("Your PHP version must be {$minPHPVersion} or higher to run this program. Your current version is " . phpversion());
}

//path to this file
define("ROOTPATH", __DIR__ . DIRECTORY_SEPARATOR);

require "../app/core/init.php";

$app = new App;
$app->loadController();