<?php

namespace App\Model;

use App\Model\Pireview;
use Illuminate\Database\Eloquent\Model;

class Piproduct extends Model
{
    protected $fillable = ['product_name', 'product_stock', 'product_price', 'product_dis'];
    
    protected $primaryKey = "product_id";

    public function product_review(){
        return $this->hasMany(Pireview::class, 'review_product_id', 'product_id');
    }

    public function getAvgStar($product_id)
    {
        return Pireview::where("review_product_id", $product_id)->avg('review_star');
    }

    public function bro(){
        return $this::all();
    }
}
