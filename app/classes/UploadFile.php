<?php


namespace App\classes;


class UploadFile

{
    
    protected $maxSize = 5402000;
    protected $path;


    public function getName($file, $name = ""){
        if($name === ""){
            $name = pathinfo($file->file->tmp_name, PATHINFO_FILENAME);
        }
        $name = strtolower(str_replace(["_",""], "-", $name));
        $hash = md5(microtime());
        $ext = pathinfo($file->file->name, PATHINFO_EXTENSION);
       return "{$name}-{$hash}.{$ext}";

    }

    

    public function checkSize($file){
        return $file->file->size > $this->maxSize ? true : false;
    }

    public function isImage($file){
        $ext = pathinfo($file->file->name, PATHINFO_EXTENSION);
        $validExt = ["jpg", "jpeg", "png", "bmp", "gif"];

        return in_array($ext, $validExt);
    }

    public function getPath(){
        return $this->path;
    }


    public function move($file, $filename= ""){
       $name =  $this->getName($file);
        if($this->isImage($file)){
            if(!$this->checkSize($file)){
                $path = APP_ROOT . "/public/assets/uploads/";
                if(!is_dir($path)){
                     mkdir($path);
                } 
                $this->path = URL_ROOT . "public/assets/uploads/" . $name;
                $file_path = $path . $name;
                return move_uploaded_file($file->file->tmp_name, $file_path);
            }else{
                //return "File size exceeded";
                return false;
            }
        }else{
           // return  "Only image file are accepted";
           return false;
        }

    
       
    }
}
