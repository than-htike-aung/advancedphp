<?php


namespace App\controllers;

use App\classes\CSRFToken;
use App\classes\Redirect;
use App\classes\Request;
use App\classes\Session;
use App\classes\UploadFile;
use App\classes\ValidateRequest;
use App\Models\Category;
use App\Models\SubCategory;

class CategoryController extends BaseController
{
    public function index(){
     //   Redirect::to("/");
     $categories = Category::all()->count();
     list($cats, $pages) = paginate(3,$categories, new Category());

     $subcategories = SubCategory::all()->count();
     list($sub_cats, $sub_pages) = paginate(3,$subcategories, new SubCategory());

     $cats = json_decode(json_encode($cats)); // changing ary to object
        $sub_cats = json_decode(json_encode($sub_cats));
    // beautify($cats);
        view("admin/category/create", compact('cats', 'pages', 'sub_cats', 'sub_pages'));
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

            $errors = $validator->getErrors();

            $categories = Category::all()->count();
            list($cats, $pages) = paginate(3,$categories, new Category());
            $cats = json_decode(json_encode($cats)); // changing ary to object
            // beautify($cats);
            view("admin/category/create", compact('cats','errors', 'pages'));
        }else{
          $slug =  slug($post->name);

//          $category = new Category();
//          $category->name = $post->name;
//          $category->slug = $slug;
//
//          if($category->save()){
//              echo "Category created successfully";
//          }else{
//              echo "Category creation fail";
//          }

            //  OR

            $con = Category::create([
               "name" => $post->name,
               "slug" => $slug
            ]);
            if($con){
                $success = "Category Created Successfully!";
                $categories = Category::all()->count();
                list($cats, $pages) = paginate(3,$categories, new Category());
                $cats = json_decode(json_encode($cats)); // changing ary to object
                // beautify($cats);
                view("admin/category/create", compact('cats','success', 'pages'));
            }else{
                $errors = "Category Created Fail!";
                $categories = Category::all()->count();
                list($cats, $pages) = paginate(3,$categories, new Category());
                $cats = json_decode(json_encode($cats)); // changing ary to object
                // beautify($cats);
                view("admin/category/create", compact('cats','errors', 'pages'));
            }


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

    public function delete ($id){
        $con = Category::destroy($id);
        if($con){
            Session::flash("delete_success", "Category Delete Successfully!");
            Redirect::to("/admin/category/create");
        }else{
            Session::flash("delete_fail", "Category delete fail");
            Redirect::to("/admin/category/create");
        }
    }

    public function update(){
        $post = Request::get('post');

//         $data = [
//             "name" => $post->name,
//             "token" => $post->token,
//             "id" => $post->id,
//             "con" => ''
//         ];

        if(CSRFToken::checkToken($post->token)){

            $rules = [
                "name" => ["required" =>true, "minLength" =>"5", "unique" => "categories"]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);

            if($validator->hasError()){
              header('HTTP/1.1 422 Validation Error!', true, 422);
                echo json_encode($validator->getErrors());
             //  $data['con'] = "Validation Error";
              // echo json_encode($data);
                exit;
            }else{
                Category::where("id", $post->id)->update(["name" => $post->name]);
              //  $data['con'] = "We are good to go";
                echo json_encode("Category updated successfully");
                exit;
            }
        }else{
            header('HTTP/1.1 422 Token Mis-Match Error!', true, 422);
          //data['con'] = "Token miss match exception";
            echo json_encode(["error"=>"Token Mis-Match Error!"]);
            exit;
        }

      
    }
}
