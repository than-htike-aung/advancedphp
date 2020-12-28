<?php


namespace App\controllers;


use App\classes\CSRFToken;
use App\classes\Redirect;
use App\classes\Request;
use App\classes\Session;
use App\classes\UploadFile;
use App\classes\ValidateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class ProductController
{
    public function home(){
        $products = Product::all();
        view("admin/product/home", compact("products"));
    }

    public function create(){
        $cats = Category::all();
        $sub_cats = SubCategory::all();

        view("admin/product/create", compact('cats', 'sub_cats'));
    }

    public function store(){
        $post = Request::get('post');
        $file = Request::get('file');
       // beautify($post);
       // beautify($file);

        if(CSRFToken::checkToken($post->token)){
            $rules = [
                "name" => ["required"=>true, "unique" => "products", "minLength"=>"5"],
                "description" => ["required"=>true, "minLength"=>"10"],
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);
            if($validator->hasError()){
                $errors = $validator->getErrors();
                $cats = Category::all();
                $sub_cats = SubCategory::all();

                view("admin/product/create",compact('cats', 'errors', 'sub_cats'));
               

            }else{
                beautify($file);
                
                if(!empty($file->file->name)){
                   $uploadFile = new UploadFile();
                   if($uploadFile->move($file)){
                        $path = $uploadFile->getPath();
                        echo $path;

                       $product = new Product();
                       $product->name = $post->name;
                       $product->price = $post->price;
                       $product->cat_id = $post->cat_id;
                       $product->sub_cat_id = $post->sub_cat_id;
                       $product->description = $post->description;
                       $product->image = $path;

                       if($product->save()){
                            $products = Product::all();
                            Session::flash("product_insert_success", "Product successfully Created!");
                            Redirect::to("/admin/product/home", compact("products"));
                       }else{
                     $errors = ["Problem Insert Product to database!"];
                       $cats = Category::all();
                      $sub_cats = SubCategory::all();
                      view("admin/product/create",compact('cats',  'sub_cats' ,'errors'));
                       }

             
                  
                }else{
                    //   echo " Something is not right!";
                $errors = ["Please Check Pictures size and type!"]; ;
                $cats = Category::all();
                $sub_cats = SubCategory::all();
                view("admin/product/create",compact('cats',  'sub_cats' ,'errors'));
                   }
                }else{
                $errors = ["Please Check Pictures size and type!"];
                $cats = Category::all();
                $sub_cats = SubCategory::all();
                view("admin/product/create",compact('cats',  'sub_cats' ,'success'));
                    echo "fail";
                }

            //    $success = "Good to go";
            //     $cats = Category::all();
            //     $sub_cats = SubCategory::all();

            //     view("admin/product/create",compact('cats',  'sub_cats' ,'success'));
           

            }

        }else{
            $errors = ["Token Mis match error!"];
            $cats = Category::all();
            $sub_cats = SubCategory::all();

            view("admin/product/create",compact('cats', 'errors', 'sub_cats'));

        }
    }
}
