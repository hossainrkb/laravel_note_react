<?php 
namespace App\s_container;
use App\Model\Piproduct;
class ServiceContainer{
    protected $product;
    public function __construct(Piproduct $product){
        //echo($product);
       // echo $product;
       //echo($product->bro());
        $this->product = $product;
    }

    public function show(){
        return $this->product->bro();
      //  return Piproduct::all();
    }
}


?>