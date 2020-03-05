<?php 

namespace App\Traits;

trait demoTrait {

    public static function unsetData(){
       $array = [
        0 => [
            "product" => '1',
            "qty" => '5'
        ],
        5 => [
            "product" => '5',
            "qty" => '10'
        ],
        7 => [
            "product" => '3',
            "qty" => '2'
        ],
    ];
    $product = 55;
   // unset($array["1"]);
   $new_arr =  array_values($array);
    \dump($new_arr);
    $cart = [
        "product" => "999" ,
        "qty" => "1"
    ];
    for($i=0 ; $i<\count($new_arr);$i++){
        if($new_arr[$i]["product"] == $product){
           // dd($i);
            
            $cart = [
                "product" => $new_arr[$i]["product"],
                "qty" => $new_arr[$i]["qty"] + 5
            ];
            unset($new_arr[$i]);
        }
    }
   $new_arr =  array_values($new_arr);
   array_push($new_arr,$cart);
    dump($new_arr);
    //return $array;

    }


}