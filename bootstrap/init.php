<?php

use App\classes\Database;

if(!isset($_SESSION)) session_start();

define("APP_ROOT",realpath(__DIR__."/../"));
define("URL_ROOT", "http://advancedphp.cc");

require_once APP_ROOT . "/vendor/autoload.php";

new \App\classes\ErrorHandler();

require_once APP_ROOT . "/app/config/_env.php";

//require_once APP_ROOT . "/app/controllers/BaseController.php";
//require_once APP_ROOT . "/app/routing/RouteDispatcher.php";

new Database();

require_once APP_ROOT . "/app/routing/router.php";
