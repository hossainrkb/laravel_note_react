<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/product_add', 'ProductController@add_product');
// Route::post('/pay', 'ProductController@pay_now')->name("pay_now");
// Route::post('/cart-add', 'ProductController@add_cart_product')->name("add_to_cart");
// Route::get('/bro', 'ProductController@bro');
// Route::get('/product_list', 'ProductController@all_product')->name("product_list");

// Route::group(['middleware' => ['auth:api']],function(){
//     Route::apiResource("/products", "PiproductController");
// });
// Route::apiResource("/products", "PiproductController");
// Route::group(['prefix'=> 'products'], function(){
//     Route::apiResource("/{product}/reviews", "PireviewController");
// });
Route::get("/userip", function(){
   return request()->ip();

});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource("/notes", "NoteController");
Route::get("/user_notes/{user}", "NoteController@user_note");


