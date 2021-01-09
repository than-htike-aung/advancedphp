<?php


$router->map("GET", "/user/login", "App\Controllers\UserController@showLoginForm", "Show user login");
$router->map("POST", "/user/login", "App\Controllers\UserController@login", "User Login");

$router->map("GET", "/user/register", "App\Controllers\UserController@showRegisterForm", "Show user register");
$router->map("POST", "/user/register", "App\Controllers\UserController@register", "User Register");

$router->map("GET", "/user/logout", "App\Controllers\UserController@logout", "User Logout");
