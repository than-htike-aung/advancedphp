<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require_once "../bootstrap/init.php";

//echo APP_ROOT;
//echo getenv("APP_NAME");
//echo "<br>" . getenv("APP_DEVELOPER");
//echo "<br>" . getenv("APP_ENV");
//echo URL_ROOT;

$user = Capsule::table("users")->where("id",1)->get();
echo "<pre>" .print_r($user,true). "</pre>";
