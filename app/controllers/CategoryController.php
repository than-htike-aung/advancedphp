<?php


namespace App\controllers;

use App\classes\CSRFToken;
use App\classes\Redirect;
use App\classes\Request;
use App\classes\Session;
use App\classes\UploadFile;

class CategoryController extends BaseController
{
    public function index(){
     //   Redirect::to("/");
       view("admin/category/create");
    }

    public function store(){
      // beautify(Request::all());
     // beautify(Request::all(true));
  //   beautify(Request::get("post"));

      // var_dump(Request::has("get"));
        //beautify(Request::has("get"));
    $post = Request::get("post");
      if(CSRFToken::checkToken($post->token)){
          beautify(Request::get("file"));
          echo "<hr>";
          $uploadFile = new UploadFile();
          var_dump($uploadFile->move(Request::get("file")));
      }else{
          Session::flash("error", "CSRF field error!");
          Redirect::back();
      }


    }
}
