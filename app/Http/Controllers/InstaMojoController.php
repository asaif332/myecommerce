<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class InstaMojoController extends Controller
{
    public function checkout()
    {
      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
      curl_setopt($ch, CURLOPT_HTTPHEADER,
                  array("X-Api-Key:test_da8a1f47e204ad3fbfac255e1ad",
                        "X-Auth-Token:test_faf99410344623fe07453460706"));
      $payload = Array(
          'purpose' => 'ecommerce payment',
          'amount' => Cart :: total(),
          'redirect_url' => 'http://myecommerce.test/instamojo/redirect/',
          'send_email' => false,
          'webhook' => 'http://myecommerce.test/instamojo/webhook/',
          'send_sms' => false,
          'allow_repeated_payments' => false
      );
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
      $response = curl_exec($ch);
      curl_close($ch);
      $data = json_decode($response ,true);

      if ($data['success']) {
        return redirect($data['payment_request']['longurl']);
      }
      else{dd($data);
        return redirect()->back()->with('info' , 'something went wrong');
      }
    }

    public function redirect()
    {dd(request()->all());
      return redirect()->route('cart')->with('success' , 'Payment successful');
    }
}
