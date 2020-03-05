<?php

namespace App\Http\Resources\Review;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class eachProductReview extends JsonResource
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
            'review' => $this->review_descrip,
            'date' => Carbon::parse($this->created_at)->toDateString()
            //'star' => $this->getAvgStar($this->review_product_id),
            
       ];
    }
}
