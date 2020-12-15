<?php


namespace App\controllers;


class IndexController extends BaseController
{

    public function show(){
       view("welcome");
    }

}
