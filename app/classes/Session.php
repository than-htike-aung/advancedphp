<?php

namespace App\classes;

class Session{

    public static function add($key, $value){
        if(!self::has($key)){
            $_SESSION[$key] = $value;
        }else{
            echo "Session with that key" . $key . "have already defined";
        }
    }

    public static function has($key){
        return isset($_SESSION[$key]) ? true : false;
    }

    public static function remove($key){
        if(self::has($key)){
            unset($_SESSION[$key]);
        }
    }

    public static function get($key){
        if(self::has($key)){
            return $_SESSION[$key];
        }else{
            return null;
        }
    }

    public static function replace($key, $value){
        if(self::has($key)){
            self::remove($key);
        }
        self::add($key, $value);
    }

    public static function flash($key, $value=""){
        if(!empty($value)){
            self::replace($key, $value);
        }else{
            // echo "<p class='alert alert-success'>".self::get($key)."</p>";
            // self::remove($key);

            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>'.self::get($key).'</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
</div>';
self::remove($key);
        }
    }


}
