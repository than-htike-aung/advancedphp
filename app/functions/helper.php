<?php

use Carbon\Carbon;
use Philo\Blade\Blade;

use App\Models\Category;

use voku\helper\Paginator;

function view($path, $data=[]){
    $view = APP_ROOT . "/resources/views/";
    $cache = APP_ROOT . "/bootstrap/cache/";

    $blade = new Blade($view, $cache);

    echo $blade->view()->make($path , $data)->render();
}

function make($filename, $data){
    extract($data);

    ob_start();
        require_once APP_ROOT . "/resources/views/mails/" .$filename. ".php";
        $content = ob_get_contents();

    ob_end_clean();

    return $content;
}

function beautify($data){
    echo "<pre>" .print_r($data,true). "</pre>";
}

function asset($link){
    echo URL_ROOT .'/assets/'. $link;
}

function slug($value){
    $value = preg_replace('/[^'.preg_quote('_').'\pL\pN\s]+/u',"", mb_strtolower($value));
    $value = preg_replace('/[ _]+/u','-', $value);
    return $value;
}

function paginate($num_of_records, $total_record, $object){
  

    $pages = new Paginator($num_of_records, 'p');
  $categories = $object->genPaginate($pages->get_limit());
    $pages->set_total($total_record);
    
  
 //  beautify($categories);
 return [$categories, $pages->page_links()];
}



