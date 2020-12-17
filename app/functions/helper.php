<?php

use Philo\Blade\Blade;

function view($path, $data=[]){
    $view = APP_ROOT . "/resources/views/";
    $cache = APP_ROOT . "/bootstrap/cache/";

    $blade = new Blade($view, $cache);

    echo $blade->view()->make($path)->render();
}

function make($filename, $data){
    extract($data);

    ob_start();
        require_once APP_ROOT . "/resources/views/mails/" .$filename. ".php";
        $content = ob_get_contents();

    ob_end_clean();

    return $content;
}



