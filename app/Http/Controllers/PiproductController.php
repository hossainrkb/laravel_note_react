<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\eachProductResource;
use App\Http\Resources\Product\ProductCollection;
use App\Model\Piproduct;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PiproductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductCollection::Collection(Piproduct::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // $product = new Piproduct();
        // $product->product_name = $request->productName;
        // $product->product_stock = $request->stock;
        // $product->product_price = $request->unitPrice;
        // $product->product_dis = $request->discount;
        // $product->save();

        $product = Piproduct::Create(
            ['product_name' => $request->productName,
            'product_stock' => $request->stock,
             'product_price' => $request->unitPrice, 
             'product_dis' => $request->discount]
        );
 
        return response([
            'message' => 'new Product added bro',
            'data' => new eachProductResource($product),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Piproduct  $piproduct
     * @return \Illuminate\Http\Response
     */
    public function show(Piproduct $product)
    {
        //echo($product);
       // dd(url()->current());
      //  return $piproducts;
      //  return new eachProductResource(Piproduct::find($product));
        return new eachProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Piproduct  $piproduct
     * @return \Illuminate\Http\Response
     */
    public function edit(Piproduct $piproduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Piproduct  $piproduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Piproduct $product)
    {
        //echo($product);
        $request["product_name"]= $request->productName;
        $request["product_stock"]= $request->stock;
        $request["product_price"]= $request->unitPrice;
        $request["product_dis"]= $request->discount;
        unset($request["productName"]);
        unset($request["stock"]);
        unset($request["unitPrice"]);
        unset($request["discount"]);
        $product->update($request->all());
        return response([
            "message" => "New product has updated",
            "data" => new eachProductResource($product)
        ]);
    }

    public function hola(Piproduct $pro){
        echo $pro;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Piproduct  $piproduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Piproduct $piproduct)
    {
        //
    }
}
