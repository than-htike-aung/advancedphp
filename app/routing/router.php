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
$router->map('GET', '/admin/category/[i:id]/delete', 'App\Controllers\CategoryController@delete', 'Category Delete');
$router->map('POST', '/admin/category/[i:id]/update', 'App\Controllers\CategoryController@update', 'Category Update');
$router->map('POST', '/admin/subcategory/create', 'App\Controllers\SubCategoryController@store','SubCategory Create');
$router->map('POST', '/admin/subcategory/update', 'App\Controllers\SubCategoryController@update','SubCategory Update');
$router->map('GET', '/admin/subcategory/[i:id]/delete', 'App\Controllers\SubCategoryController@delete','SubCategory Delete');

//For product
$router->map('GET', '/admin/product/home', 'App\Controllers\ProductController@home','Home');
$router->map('GET', '/admin/product/create', 'App\Controllers\ProductController@create','Product Create');
$router->map('POST', '/admin/product/create', 'App\Controllers\ProductController@store','Product Store');

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
