<?php


namespace App\controllers;


use App\classes\CSRFToken;
use App\classes\Redirect;
use App\classes\Request;
use App\classes\Session;
use App\classes\ValidateRequest;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends BaseController
{
    public function store(){
        $post = Request::get('post');

        if(CSRFToken::checkToken($post->token)){
            $rules = [
                "name" => ["unique" => "sub_categories", "minLength"=>"5"]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);
            if($validator->getErrors()){
                header('HTTP/1.1 422 Validation Error!', true, 422);
                $errors = $validator->getErrors();
                echo json_encode($errors);
                exit;
            }else{
                $subcat = new SubCategory();
                $subcat->name = $post->name;
                $subcat->cat_id = $post->parent_cat_id;
                
                if($subcat->save()){
                    echo "Sub Category Created Successfully!";
                }else{
                    header('HTTP/1.1 422 Sub Category Create Fail!', true, 422);
                    $data = ["name" => "Sub Category Create Fail!"];
                    echo json_encode($data);
                    exit;
                }

                //echo json_encode($post);
                exit;
            }


        }else{
            header('HTTP/1.1 422 Token MisMatch Error!', true, 422);
            echo "Token MisMatch Error!";
            exit;
        }

    }

    public function update(){
        $post = Request::get('post');

        if(CSRFToken::checkToken($post->token)){
            $rules = [
                "name" => ["unique" => "sub_categories", "minLength"=>"5"]
            ];
            $validator = new ValidateRequest();
            $validator->checkValidate($post, $rules);
            if($validator->getErrors()){
                header('HTTP/1.1 422 Validation Error!', true, 422);
                $errors = $validator->getErrors();
                echo json_encode($errors);
                exit;
            }else{

                SubCategory::where("id", $post->id)->update(["name" => $post->name]);
                echo "Sub Category Edited Successfully!";
                exit;
            }


        }else{
            header('HTTP/1.1 422 Token MisMatch Error!', true, 422);
            echo "Token MisMatch Error!";
            exit;
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
}
