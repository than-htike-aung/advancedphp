<?php


namespace App\controllers;

use App\classes\CSRFToken;
use App\classes\Redirect;
use App\classes\Request;
use App\classes\Session;
use App\classes\UploadFile;
use App\classes\ValidateRequest;
use App\Models\Category;

class CategoryController extends BaseController
{
    public function index(){
     //   Redirect::to("/");
     $cats = Category::all();
    // beautify($cats);
        view("admin/category/create", compact('cats'));
    }

    public function store(){
      // beautify(Request::all());
     // beautify(Request::all(true));
  //   beautify(Request::get("post"));

      // var_dump(Request::has("get"));
        //beautify(Request::has("get"));
    $post = Request::get("post");
      if(CSRFToken::checkToken($post->token)){

        $rules = [
          "name" => ["required" =>true, "minLength" => "5", "unique" => "categories"]
        ];
        $validator = new ValidateRequest();
        $validator->checkValidate($post, $rules);
        if($validator->hasError()){
         // beautify($validator->getErrors());
            $cats = Category::all();
            $errors = $validator->getErrors();
           // beautify($errors);
          view("admin/category/create",compact('cats','errors'));

        }else{
          $slug =  slug($post->name);

          $category = new Category();
          $category->name = $post->name;
          $category->slug = $slug;

          if($category->save()){
              echo "Category created successfully";
          }else{
              echo "Category creation fail";
          }

            //  OR



        }
        
        // beautify(Request::all());
        // echo "<hr>";
         // $uploadFile = new UploadFile();
         // var_dump($uploadFile->move(Request::get("file")));
      }else{
          Session::flash("error", "CSRF field error!");
          Redirect::back();
      }


    }
}
