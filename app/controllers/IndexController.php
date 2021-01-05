<?php


namespace App\controllers;

use App\classes\Request;
use App\classes\Session;
use App\Models\Product;

class IndexController extends BaseController
{

    public function show(){
       $count = Product::all()->count();
       list($pros, $pages) = paginate(8, $count, new Product());
       $products = json_decode(json_encode($pros));
       $featured = Product::where("featured",2)->get();
       view("home", compact("products", "pages", "featured"));
    }

    public function cart(){

        $post = Request::get("post");
         echo json_encode($post);
         $items = $post->cart;
         $carts = [];
         foreach($items as $item){
             $product = Product::where("id", $item)->first();
             $product->qty =1;
             array_push($carts, $product);
         }
          echo json_encode($carts);
          exit;
    }

    public function showCart(){
        view("cart");
        // $items = Session::get("cart-items");
        // $carts = [];
        // foreach($items as $item){
        //     $product = Product::where("id", $item)->first();
        //     array_push($carts, $product);
        // }
        // $products = json_decode(json_encode($carts));
        // view("cart", compact('products'));

    }

    public function payout(){
        $post = Request::get("post");
        if($this->saveOrder($post->items)){
            echo "success";
            exit;
        }else{
            echo "Product save fail!";
            exit;
        }
    }

    public function saveOrder($orders){
        $order = serialize($orders);
        return true;
    }



}
