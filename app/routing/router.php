<?php

use App\Routing\RouteDispatcher;

$router = new AltoRouter();

//4 params => method, router, target, routename
//$router ->setBasePath("/advancedphp/public");
$router->map("GET","/","App\Controllers\IndexController@show","Home Route");

new RouteDispatcher($router);

