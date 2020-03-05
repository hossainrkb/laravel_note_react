<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'productName' => $this->product_name,
            'stock' => $this->product_stock ==0 ? 'out of stock': $this->product_stock,
            'unitPrice' => $this->product_price,
            'details' => [
                "link" => route('products.show', $this->product_id)
            ]
        ];
    }
}
