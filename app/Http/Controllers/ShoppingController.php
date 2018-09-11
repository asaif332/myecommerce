<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Cart;

class ShoppingController extends Controller
{
    public function add_to_cart($id)
    {
      $product = Product :: find($id);
      $request = request();

      $cart = Cart :: add([
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price,
        'qty' => $request->qty,
      ]);

      Cart :: associate($cart->rowId , 'App\Product');

      if ($cart) {
        return redirect()->route('cart');
      }
      return redirect()->back();
    }

    public function cart()
    {
      return view('cart');
    }

    public function delete_cart($rowId)
    {
      Cart :: remove($rowId);
      return redirect()->back();
    }

    public function incr($rowId , $qty)
    {
      Cart :: update($rowId , $qty+1);
      return redirect()->back();
    }

    public function decr($rowId , $qty)
    {
      Cart :: update($rowId , $qty-1);
      return redirect()->back();
    }

    public function add_quick($id)
    {
      $product = Product :: find($id);

      $cart = Cart :: add([
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price,
        'qty' => 1,
      ]);

      Cart :: associate($cart->rowId , 'App\Product');

      if ($cart) {
        return redirect()->route('cart');
      }
      return redirect()->back();
    }
}
