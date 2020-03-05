<?php

namespace App\Http\Controllers;

use App\Http\Resources\Review\eachProductReview;
use App\Model\Piproduct;
use App\Model\Pireview;
use Illuminate\Http\Request;

class PireviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Piproduct $product)
    {
        echo($product->product_id);
        if(count($product->product_review)==0){
            return [
                'data' => 'No review found'
            ];
        }
        else{
            return eachProductReview::collection($product->product_review);
        }
        
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Pireview  $pireview
     * @return \Illuminate\Http\Response
     */
    public function show(Pireview $pireview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Pireview  $pireview
     * @return \Illuminate\Http\Response
     */
    public function edit(Pireview $pireview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Pireview  $pireview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pireview $pireview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Pireview  $pireview
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pireview $pireview)
    {
        //
    }
}
