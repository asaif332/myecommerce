<?php

namespace App\Http\Controllers;
use Stripe\Stripe;
use Stripe\Charge;
use Cart;
use Mail;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
      if (Cart :: count() < 1) {
        return redirect('/')->with('info' , 'Your cart is empyt you must do some purchase');
      }
      return view('checkout');
    }

    public function pay()
    {
      Stripe::setApiKey("sk_test_Jg6pDJSqh4IwB9EP6IzfYIXh");

      // Token is created using Checkout or Elements!
      // Get the payment token ID submitted by the form:

      $charge = Charge::create([
        'amount' => Cart :: total() * 100,
        'currency' => 'usd',
        'description' => 'Example charge',
        'source' => request()->stripeToken,
      ]);

      Mail :: to(request()->stripeEmail)->send(new \App\Mail\TransactionMail);

      return redirect('/')->with('success' , 'Transaction successuful. Please check your email');
    }
}
