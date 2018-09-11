<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class FrontEndController extends Controller
{
    public function index()
    {
      return view('index' , ['products' => Product :: orderBy('created_at' , 'desc')->paginate(3)]);
    }


    public function single($id)
    {
      return view('single' , ['product' => Product :: where('id' , $id)->first()]);
    }


}
