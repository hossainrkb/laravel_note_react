<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Pireview extends Model
{
    protected $primaryKey = "review_id";

    public function getAvgStar($product_id){
        return $this::where("review_product_id", $product_id)->avg('review_star');
    }

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';
}
