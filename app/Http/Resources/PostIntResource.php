<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostIntResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->post_name,
            'quantity' => $this->post_qty,
            'price' => $this->post_price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
    // public function toArray($request)
    // {
    //     return [
    //         'data' => $this->collection,
    //         'extra' => "bro this is extra data here, it would be added soon"
    //     ];
    // }
}
