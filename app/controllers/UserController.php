<?php


namespace App\controllers;


use App\classes\Auth;
use App\classes\CSRFToken;
use App\classes\Redirect;
use App\classes\Request;
use App\classes\Session;
use App\classes\ValidateRequest;
use App\models\User;

class UserController
{
    public  function showLoginForm(){
        if(Auth::check()){
            Redirect::to("/cart");
        }else{
            return view("user/login");
        }

    }

    public function login(){
        $post = Request::get("post");
       // beautify($post);
        if(CSRFToken::checkToken($post->token)){
            $user = User::where("email", $post->email)->first();
            if($user){
                if(password_verify($post->password, $user->password)){
                   //Session::add("user" , $user);
                    Session::add("user_id", $user->id);
                    //Session::add("user_name", $user->name);
                   Redirect::to("/cart");
                }else{
                    Session::flash("error_message", "Password Error!");
                    Redirect::to("/user/login");
                }
               // beautify($user);
            }else{
                Session::flash("error_message", "No User with that email!");
                Redirect::to("/user/login");
            }
        }else{
            Session::flash("error_message", "Token Mis Match Error!");
            Redirect::to("/user/login");
        }
    }

    public  function showRegisterForm(){
        return view("user/register");
    }

    public function register(){
        $post = Request::get("post");
       // beautify($post);
        if(CSRFToken::checkToken($post->token)){
            if($post->password === $post->confirm_password){
               $rules = [
                   "name" => ["minlength" => "5"],
                   "email" => ["unique" => "users"],
                   "password" => ["minlength" => "5"]
               ] ;
               $validator = new ValidateRequest();
               $validator->checkValidate($post, $rules);
               if($validator->hasError()){
                   beautify($validator->getErrors());
               }else{
                  $user = new User();
                  $user->name = $post->name;
                  $user->email = $post->email;
                  $user->password = password_hash($post->password, PASSWORD_BCRYPT);

                  if($user->save()){
                      Session::flash("success_message", "Register success! Please Login!");
                      Redirect::to("/user/login");
                  }else{
                      Session::flash("error_message", "Database Problem! Please contact Admin!");
                      Redirect::to("/user/register");
                  }
               }
            }else{
              Session::flash("error_message", "Password do not match");
              Redirect::to("/user/register");
            }
        }else{
         Session::flash("error_message", "Token Mis Match Error!");
         Redirect::to("/user/register");
        }
    }

    public function logout(){
        Session::remove("user_id");
        Redirect::to("/");
    }
}
