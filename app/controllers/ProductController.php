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
        $pds = Product::all();
        list($products, $pages) = paginate(4, count($pds), new Product());
        $products = json_decode(json_encode($products));


        view("admin/product/home", compact("products", "pages"));
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
                       // echo $path;

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
                view("admin/product/create",compact('cats', 'sub_cats' ,'errors'));
                   }
                }else{
                $errors = ["Please Check your image!"];
                $cats = Category::all();
                $sub_cats = SubCategory::all();
                view("admin/product/create",compact('cats',  'sub_cats' ,'errors'));
                   // echo "fail";
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

    public function edit($id){
        $cats = Category::all();
        $sub_cats = SubCategory::all();
        $product = Product::where("id", $id)->first();
      //  beautify($product);
      view('admin/product/edit', compact("products", 'cats', 'sub_cats'));
    }

    public function update($id){
        $post = Request::get("post");
        $file = Request::get("file");
       // beautify($post);
       // beautify($file);
        $f_path = "";

        if(CSRFToken::checkToken($post->token)){
            $rules = [
                "name" => ["required"=>true, "unique" => "products", "minLength"=>5],
                "description" => ["required"=>true, "minLength"=>10],
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);

            if($validator->hasError()){
            // beautify($validator->getErrors());
             $errors = $validator->getErrors();
             $product = Product::where("id", $id)->first();
             $cats = Category::all();
             $sub_cats = SubCategory::all();
             view("admin/product/edit", compact("errors", "products","cats","sub_cats"));
            }else{
              if(empty($file->file->name)){
                  $f_path = $post->old_image;

              }else{
                $uploadFile = new UploadFile();
                if($uploadFile->move($file)){
                    $f_path = $uploadFile->getPath();
                }else{
                   
                    $product = Product::where("id", $id)->first();
                  
                    $cats = Category::all();
                    $sub_cats = SubCategory::all();
                    $errors = ["file_move_error" => "Can not move upload file!"];
                    view("admin/product/edit", compact("errors", "products","cats","sub_cats"));
                }
              }
            //  echo $f_path;
            $product = Product::where("id", $id)->first();
   
            $product->name = $post->name;
            $product->price = $post->price;
            $product->cat_id = $post->cat_id;
            $product->sub_cat_id = $post->sub_cat_id;
            $product->description = $post->description;
            $product->image = $f_path;

                if($product->update()){
                    Session::flash("product_insert_success", "Product Successfully Updated!");
                    Redirect::to("/admin/product/home");
                 }else{
                  
                    $product = Product::where("id", $id)->first();
                    $cats = Category::all();
                    $sub_cats = SubCategory::all();
                    $errors = ["file_move_error" => "Product update error!"];
                    view("admin/product/edit", compact("errors", "products","cats","sub_cats")); 
                 }
            }
        }else{
            Session::flash("Product Update Fail", "Product Updated Fail!");

            Redirect::to("/admin/product/".$id."/edit");
    
  
        }
      
    }

    public function delete($id){
        $con = Product::destroy($id);
        if($con){
            Session::flash("product_insert_success", "Product Delete Successfully!");
            Redirect::to("/admin/product/home");
        }else{
            Session::flash("product_insert_success", "Product Delete Fail!");
            Redirect::to("/admin/product/home");
        }
    }
}
