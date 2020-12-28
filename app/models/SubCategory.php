<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model{

    public function genPaginate($limit){

        $table = $this->getTable();

        $categories = [];

        $cats = Capsule::select("SELECT * FROM $table ORDER BY id DESC" . $limit);
        foreach($cats as $cat){
            $date = new Carbon($cat->created_at);
            array_push($categories, [
                "id" => $cat->id,
                "name" => $cat->name,
                "cat_id" => $cat->cat_id,
                "created" => $date->toFormattedDateString()
            ]);
        }
        return $categories;
    }
}
