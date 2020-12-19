<?php

namespace App\classes;
use Illuminate\Database\Capsule\Manager as Capsule;
class ValidateRequest{
    /**
     * $cloumn // database fields
     * $value // file's data
     * $policy // table
     */

     public function unique($cloumn, $value, $policy){
            if($value != null && !empty($value)){
             return  Capsule::table($policy)->where($cloumn, $value)->exists();
            }
     }

     public function required($cloumn, $value, $policy){
        return $value !=null && !empty($value) ? true : false;
     }

     public function minLength($cloumn, $value, $policy){
         if($value !=null && !empty(trim($value))){
             return strlen(trim($value)) >= $policy;
         }
     }

     public function maxlength($cloumn, $value, $policy){
        if($value !=null && !empty(trim($value))){
            return strlen(trim($value)) <= $policy;
        }
    }
}