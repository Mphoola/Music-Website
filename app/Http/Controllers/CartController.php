<?php

namespace App\Http\Controllers;

use App\Beat;
use App\Song;
use App\Video;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add_to_cart(Request $request){
        //dd($request->all());
        $model = request()->model;

        if($model == 'App\Beat'){
            $item = Beat::where('uuid',$request->id)->firstOrFail();
        }elseif ($model == 'App\Song') {
            $item = Song::where('uuid',$request->id)->firstOrFail();
        }else{
            $item = Video::where('uuid',$request->id)->firstOrFail();
        }

        $cart = \Cart::add(array(
            'id' => $item->uuid,
            'name' => $item->full_details,
            'quantity' => request()->qty,
            'price' => $item->amount,
            
        ))->associate($model);

        return redirect()->route('cart.items');
    }
    public function add_to_cart_rapid($id, $model){
        

        if($model == 'Beat'){
            $item = Beat::where('uuid',$id)->firstOrFail();
        }elseif ($model == 'Song') {
            $item = Song::where('uuid',$id)->firstOrFail();
        }else{
            $item = Video::where('uuid',$id)->firstOrFail();
        }
        $m = "App\\".$model;
 
        $cart = \Cart::add(array(
            'id' => $item->uuid,
            'name' => $item->title,
            'quantity' => 1,
            'price' => $item->amount,
            
        ))->associate($m);


        return redirect()->route('cart.items');
    }
    

    public function cart(){
        
        $cartCount = \Cart::getContent()->count();
        $cartItems = \Cart::getContent();
        return view('shop.cart', compact('cartCount', 'cartItems'));
    }

    public function remove_from_cart($id){
        //dd(\Cart::getContent());
        \Cart::remove($id);

        return redirect()->back();
    }

    public function cart_incr_qty($id){
        \Cart::update($id, array(
            'quantity' => +1, // so if the current product has a quantity of 4, it will subtract 1 and will result to 3
          ));

          return redirect()->back();
    }

    public function cart_decr_qty($id){
        \Cart::update($id, array(
            'quantity' => -1, // so if the current product has a quantity of 4, it will subtract 1 and will result to 3
          ));

          return redirect()->back();  
    }
}
