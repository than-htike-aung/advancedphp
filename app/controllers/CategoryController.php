<?php


namespace App\controllers;

use App\classes\Request;

class CategoryController extends BaseController
{
    public function index(){
        view("admin/category/create");
    }

    public function store(){
      // beautify(Request::all());
     // beautify(Request::all(true));
  //   beautify(Request::get("post"));

      // var_dump(Request::has("get"));
        //beautify(Request::has("get"));

        beautify(Request::old("post", "name"));


    }
}
