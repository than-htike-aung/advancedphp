<?php

namespace App\classes;

use Illuminate\Database\Seeder;

class CSRFToken {

    public static function __token(){
        if(!Session::has("token")){
          echo  Session::add("token", base64_encode(openssl_random_pseudo_bytes(32)));
        }else{
            echo Session::get("token");
        }
    }

    public static function checkToken($token){
        return Session::get("token") === $token;
    }

}
