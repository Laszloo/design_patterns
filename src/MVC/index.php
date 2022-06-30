<?php

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

require_once "Application.php";
require_once "ViewRenderer.php";
require_once "ListUserController.php";
require_once "UserModelRepository.php";
require_once "UserModel.php";
require_once "View.php";

$application = new App\MVC\Application((new App\MVC\ViewRenderer()));
$application->start();
?>