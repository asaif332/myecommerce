<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index' , ['products' => Product :: orderBy('created_at','desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'name' => 'required',
          'image' => 'required|image',
          'price' => 'required|integer',
          'description' => 'required',
        ]);

        $image = $request->file('image');

        $new_name = time() . $image->getClientOriginalName();
        $image->move('uploads/products' , $new_name);

        $product = Product :: create([
          'name' => $request->name,
          'image' => 'uploads/products/' . $new_name,
          'price' => $request->price,
          'description' => $request->description,
        ]);

        if ($product) {
          return redirect()->route('products.index')->with('success' , 'Product added successfully');
        }
        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('products.edit' , ['product' => Product :: where('id' , $id)->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $request->validate([
        'name' => 'required',
        'price' => 'required|integer',
        'description' => 'required',
        'image' => 'image',
      ]);

        $product = Product :: where('id' , $id)->first();
        $image = $request->file('image');
        if ($image) {
          if ($product->image != 'uploads/products/index.jpg') {
            $del_image = public_path().'\uploads\products\\'.array_last(explode('/' , $product->image));
            unlink($del_image);
          }

          $new_name = time() . $image->getClientOriginalName();
          $image->move('uploads/products' , $new_name);
          $product->image = 'uploads/products/'.$new_name;
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        if ($product->save()) {
          return redirect()->route('products.index')->with('success' , 'Product edited successfully');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $product = Product :: where('id' , $id)->first();

      if ($product->image != 'uploads/products/index.jpg') {
        $del_image = public_path().'\uploads\products\\'.array_last(explode('/' , $product->image));
        unlink($del_image);
      }
      if ($product->delete()) {
        return redirect()->back()->with('success', 'Product deleted successfully');
      }
      return redirect()->back();
    }
}
