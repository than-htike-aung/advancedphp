<?php

use Philo\Blade\Blade;

function view($path, $data=[]){
    $view = APP_ROOT . "/resources/views/";
    $cache = APP_ROOT . "/bootstrap/cache/";

    $blade = new Blade($view, $cache);

    echo $blade->view()->make($path)->render();
}

