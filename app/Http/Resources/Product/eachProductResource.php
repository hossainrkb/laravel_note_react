<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class eachProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'productName' => $this->product_name,
            'stock' => $this->product_stock == 0 ? 'out of stock' : $this->product_stock,
            'unitPrice' => $this->product_price,
            'discount' => ($this->product_dis).'%',
            'rating' => round($this->getAvgStar($this->product_id),2),
            'totalPrice' => round((1 - ($this->product_dis / 100)) * $this->product_price,2),
            'reviews' => $this->product_review->count()==0 ? 'no review yet': route('reviews.index', $this->product_id)
        ];
    }
}
