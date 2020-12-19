<?php


namespace App\classes;


class UploadFile

{
    
    protected $maxSize = 5402;

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
        $ext = pathinfo($file->file->name, PATHINFO_FILENAME);
        $validExt = ["jpg", "jpeg", "png", "bmp", "gif"];

        return in_array($ext, $validExt);
    }



    public function move($file, $filename= ""){
       $name =  $this->getName($file);
        if($this->isImage($file)){
            if(!$this->checkSize($file)){
                $path = APP_ROOT . "/public/assets/uploads";
                if(!is_dir($path)){
                     mkdir($path);
                } 
                $file_path = $path . $name;
                return move_uploaded_file($file->file->tmp_name, $file_path);
            }else{
                return "File size exceeded";
            }
        }else{
            return  "Online image file are accpted";
        }

    
       
    }
}
