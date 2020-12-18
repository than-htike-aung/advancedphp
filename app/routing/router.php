<?php

use App\Routing\RouteDispatcher;

$router = new AltoRouter();

//4 params => method, router, target, routename
$router ->setBasePath(getenv("BASE_PATH"));
$router->map("GET", "/", "App\Controllers\IndexController@show", "Home Route");

//Admin Route
$router->map('GET', '/admin', 'App\Controllers\AdminController@index','Admin Home');
$router->map('GET', '/admin/category/create', 'App\Controllers\CategoryController@index', 'Category Create');
$router->map('POST', '/admin/category/create', 'App\Controllers\CategoryController@store', 'Category Store');

new RouteDispatcher($router);




/*
 *1. Route
 *    2.  Controller , methods
 *        3.  Model => View
 */

 //$router->setBasePath('/AltoRouter');
//$router->map( 'GET|POST', '/about', '', 'home' );
// $match = $router->match();
// if($match){
//     echo "match";
// }else{
//     echo "not match";
// }
