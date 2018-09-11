<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/' , 'FrontEndController@index')->name('index');
Route::get('/product/single/{id}' , 'FrontEndController@single')->name('product.single');
Route::post('/cart/add/{id}' , 'ShoppingController@add_to_cart')->name('cart.add');
Route::get('/cart' , 'ShoppingController@cart')->name('cart');
Route::get('/cart/delete/{rowId}' , 'ShoppingController@delete_cart')->name('cart.delete');
Route::get('/cart/incr/{rowId}/{qty}' , 'ShoppingController@incr')->name('cart.incr');
Route::get('/cart/decr/{rowId}/{qty}' , 'ShoppingController@decr')->name('cart.decr');
Route::get('/cart/add/quick/{id}' , 'ShoppingController@add_quick')->name('cart.add.quick');
Route::get('/checkout/instamojo' , 'InstaMojoController@checkout')->name('checkout.instamojo');
Route::get('/instamojo/redirect' , 'InstaMojoController@redirect')->name('instamojo.redirect');

Route::get('/cart/checkout' , 'CheckoutController@index')->name('cart.checkout');

Route::post('/cart/checkout' , 'CheckoutController@pay')->name('cart.checkout');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route :: group(['middleware' => 'auth'] , function () {
  Route :: resource('products' , 'ProductsController');
});
