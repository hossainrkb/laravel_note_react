<?php

use App\Billing_Payments\PaymentInterface;
use App\Http\Resources\PostIntResource;
use App\Postint;
use Illuminate\Database\Eloquent\Collection;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These | routes
are loaded by the RouteServiceProvider within a group which | contains the "web"
middleware group. Now create something great!
|
 */
//dd(app()); dd(app()->make("Hello"));
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get("/data",function (Request $request) {return "data"; // return
//    $request->user();})->middleware('client'); Route::get('OauthPassport',
//    'OauthPassportController@check')->middleware('client');
Route::get('/success', function () {
    return "Success SSL";
})->name("sslc.success");
Route::get('/failed', function () {
    return "Failed SSL";
})->name("sslc.failed");

//Revive BRO

Route::get('/postint', function () {
    return PostIntResource::Collection(Postint::Where([
        ["post_status", "=", 1],
        ["post_price", ">", 4980],
    ])->get());
    // return new PostIntResource(Postint::first()); return new
    // PostIntResource(Postint::all());
});

Route::get("/s_container", function (PaymentInterface $payment) {
    //$result =  new ServiceContainer(new App\Model\Piproduct()); $hola->show();
    dd($payment);
    //dd($payment->result());

});

Route::get("getData", "PostintController@getData")->name("homee");
Route::get("hola", "PostintController@hola");
Route::post("hola", "PostintController@f_insert")->name("form_insert");

//Advance grouping Route

// Route::namespace ('Admin')->middleware("hola:admin")->prefix("admin")->name("admin.")->group(function () {


// });

