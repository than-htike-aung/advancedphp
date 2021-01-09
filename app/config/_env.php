<?php


use Dotenv\Dotenv;

$dotenv = new Dotenv(APP_ROOT);
$dotenv->load();

require_once __DIR__ . "/_stripe.php";
