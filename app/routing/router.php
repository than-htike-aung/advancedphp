<?php

use App\Routing\RouteDispatcher;

$router = new AltoRouter();

//4 params => method, router, target, routename
$router ->setBasePath(getenv("BASE_PATH"));
$router->map("GET", "/", "App\Controllers\IndexController@show", "Home Route");
$router->map('POST', '/cart', 'App\Controllers\IndexController@cart', "Cart Route");
$router->map('GET', '/cart', 'App\Controllers\IndexController@showCart', "Show Cart Route");
$router->map("POST", "/payout", "App\Controllers\IndexController@payout", "Show payout");
$router->map("GET", "/product/[i:id]/detail", "App\Controllers\IndexController@productDetail", "Product Detail Route");
$router->map("POST", "/payment/stripe", "App\Controllers\PaymentController@stripePayment", "Payment method");

$router->map("GET", "/getitems", "App\Controllers\IndexController@getItemsFromSession", "Get items route");


require_once "admin_route.php";
require_once "user_route.php";

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
