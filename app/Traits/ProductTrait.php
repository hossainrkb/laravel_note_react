<?php 

namespace App\Traits;
use App\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

trait ProductTrait {

    public function productAddByAdmin($request){

        $product = new Product();
        $product ->p_unique_id = "Pro".Str::random(3);
        $product ->p_name = $request["name"];
        $product ->p_qty = $request["p_qty"];
        $product ->p_buy_price = $request["p_buy_price"];
        $product ->p_sell_price = $request["p_sell_price"];
        $product->save();
        return response()->json(["message"=>"New Product has been saved"]);

    }

    public function product_list(){
        $product_list = Cache::get('product_list', function () {
            Cache::put('product_list',Product::all());
            return Product::all();
        });
        return json_decode($product_list,true);
    }

    //Product add to cart trait 
    public function productAddToCartCashed($cart_product){
       // $this->getInArray($cart_product);
        $ip_address = 1;
       // $array1 = [];
        // foreach($cart_product as $pro){
            //  for($i=1;$i<=5;$i++){
            //      array_push($array,$i);
            //  }

            // }
            
$key = Cache::get('ip_address');
            if(count($key)<=0){
$key[] = $cart_product;
                Cache::put('ip_address',$key);
dump( Cache::get("ip_address"));
            }
            else{
$key = Cache::get('ip_address');
 $new_arr =  array_values($key);

    for($i=0 ; $i<count($new_arr);$i++){
        if($new_arr[$i]["product"] == $cart_product["product"]){
           // dd($i);
           // dd($new_arr[$i]);
            $cart_product = [
                "product" => $new_arr[$i]["product"],
                "qty" => $new_arr[$i]["qty"] + $cart_product["qty"]
            ];
            unset($new_arr[$i]);
        }
    }
   $new_arr =  array_values($new_arr);
  // array_push($new_arr,$cart);


$new_arr[] = $cart_product;
Cache::put('ip_address', $new_arr);
dump( Cache::get("ip_address"));
            }
        

 //  Cache::get($ip_address);
             // Cache::put($ip_address,$cart_product);
              
        // $array = array_merge($cart_product);
    // Cache::put($ip_address,$cart_product);
    //   if (Cache::has($ip_address)) {
    //       $result = Cache::get($ip_address);
    //      // dd($cart_product["product_id"]);
    //       if($cart_product["product_id"] != $result["product_id"]){
    //           Cache::get($ip_address);
    //           Cache::put($ip_address,$cart_product);
    //           dump(Cache::get($ip_address));
    //       }
             
    //         // Cache::put($ip_address,$cart_product);
    //      }
         //       array_push($array1,Cache::get('key'));
        //dump($array1);
        //  Cache::putMany($array);
        // // //dd($cart_product);
        //  if (Cache::has($ip_address)) {
        //      dump(Cache::get($ip_address));
        //  }
//         Cache::put('key',['foo', 'bar']);
// $key = Cache::get('key');
// $key[] = 'sad';
// Cache::put('key', $key);
// dump(Cache::get('key'));
        
        
    }
    public function getInArray($item){
        $array = [];
       if(count($array)<=0){
            array_push($array,$item);
       }
        // return $array;
        print_r($array);
    }


    public function productGetCartCashed(){
        $ip_address = 1;
     if (Cache::has("ip_address")) {
            // dump(Cache::get("ip_address"));
            $datas = Cache::get("ip_address");
            return $datas;
            $total = 0;
           // dump($datas);
           $push = [];
            // for ($i = 0 ;$i<count($datas);$i++){
            //    // print_r($datas[$i]);
            //     $total = $total+$datas[$i]['qty'];
            // // array_push($push,$datas[$i]);
            // }
            // print_r($total);
            // Cache::put("hola",$push);
            // $hola = Cache::get("hola");
            // foreach($hola as $data){
            //     dump($data);
            // }

         }
        
        
    }


    //end








    public function productAddInputValidityCheck($data){
        $fault = [];
        if(isset($data["name"]) && isset($data["p_qty"]) && isset($data["p_buy_price"]) && isset($data["p_sell_price"]) ) {
            if($data["name"] != "" || $data["name"] != NULL){
            }
            else{
                array_push($fault,"product name is empty");
            }            
            if($data["p_qty"] != "" || $data["p_qty"] != NULL){
            }
            else{
                array_push($fault,"product quantity field is empty");
            }            
    }
    if(count($fault)>0){    
        return $fault;
    }
    else{
        return true;
    }
}
}