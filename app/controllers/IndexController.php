<?php


namespace App\controllers;

use App\classes\Auth;
use App\classes\CSRFToken;
use App\classes\Request;
use App\classes\Session;
use App\models\Order;
use App\models\OrderDetail;
use App\models\Payment;
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

        if(CSRFToken::checkToken($post->token)){

            $items = $post->cart;
            $carts = [];
            foreach($items as $item){
                $product = Product::where("id", $item)->first();
                $product->qty =1;
                array_push($carts, $product);
            }
            echo json_encode($carts);
            exit;

        }else{
            echo "Token Mis Match Error!";
            exit;
        }


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

//        $ary = [];  FOR TESTING
//        foreach ($post->items as $item){
//            $str = "Item id " . $item->id . " qty " .$item->qty . " price " . $item->price;
//            array_push($ary , $str);
//        }
//
//        echo json_encode($ary);
//        exit;

        if(CSRFToken::checkToken($post->token)){
           Session::replace("cart-items", $post->items);
           echo "success";
           exit;
            }else{
                echo "Token mis match error!";
                exit;
            }

    }

    public function saveItemsToDatabase($status="Pending", $extraData=""){
        $items = Session::get("cart-items");
        $order_number = uniqid();
        $total = 0;

        //beautify($items);
        foreach ($items as $item){
            $total += $item->qty * $item->price;
            
            $od = new OrderDetail();
            $od->user_id = Auth::user()->id;
            $od->product_id = $item->id;
            $od->unit_price = $item->price;
            $od->status = "Pending";
            $od->quantity = $item->qty;
            $od->total = $item->qty * $item->price;
            $od->order_no = $order_number;

            $od->save();
        }

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->order_no = $order_number;
        $order->order_extra = $extraData;

        $order->save();

        $payment = new Payment();
        $payment->user_id = Auth::user()->id;
        $payment->amount = $total;
        $payment->status = $status;
        $payment->order_no = $order_number;

       if($payment->save()){
         return true;
       }else{
           return false;
       }



    }

    public function saveOrder($orders){

        $order = serialize($orders);
       return true;
    }

    public function productDetail($id){
        $product = Product::where("id", $id)->first();
        return view('product', compact('product'));
    }

}
