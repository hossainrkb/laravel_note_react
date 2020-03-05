<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use App\Traits\ProductTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;

class ProductController extends Controller
{
    use ProductTrait;

    public function add_product(Request $request){
      
        $data =  json_decode($request->getContent(),true);
       
        $result = $this->productAddInputValidityCheck($data);

      if($result == "true"){
        
        $message =  $this->productAddByAdmin($data);
       
        $data = json_decode($message->getContent(),true);
        
        dump($data); 

      }
      else{

        dump($result);
      
      }

    }

    public function all_product(){
      $product_list = $this->product_list();
      return view("product_cart_blade.product_list",compact("product_list"));
    }

    public function add_cart_product(Request $request){
     // dd($request->all());
      $data = $request->all();
      $result = $this->productAddToCartCashed($data);
    }
    public function bro(){
 $cart =  $this->productGetCartCashed();
  return view("product_cart_blade.cart",compact("cart"));
    }

    // SSL commerce 

    public function pay_now(Request $request){
      $user = 1;
          $params = [

            'store_id' => 'testbox',
            'store_passwd' => 'qwerty',
            'total_amount' => "5000",
            'currency' => "BDT",
            'tran_id' => "SSLCZ_TEST_".uniqid(),
            'success_url' => route('sslc.success'),
            'fail_url' => route('sslc.failed'),
            'cancel_url' => route('sslc.failed'),
            'cus_name' => "Rakib Hosaine",
            'cus_email' => "rakib.151045@gmail.com",
            'cus_phone' => "01923144496"

        ];
//         $post_data = array();
// $post_data['store_id'] = "testbox";
// $post_data['store_passwd'] = "qwerty";
// $post_data['total_amount'] = "103";
// $post_data['currency'] = "BDT";
// $post_data['tran_id'] = "SSLCZ_TEST_".uniqid();
// $post_data['success_url'] = route('sslc.success');
// $post_data['fail_url'] = route('sslc.failed');
// $post_data['cancel_url'] = route('sslc.failed');

// $post_data['cus_name'] = "Test Customer";
// $post_data['cus_email'] = "test@test.com";
// $post_data['cus_add1'] = "Dhaka";
// $post_data['cus_add2'] = "Dhaka";
// $post_data['cus_city'] = "Dhaka";
// $post_data['cus_state'] = "Dhaka";
// $post_data['cus_postcode'] = "1000";
// $post_data['cus_country'] = "Bangladesh";
// $post_data['cus_phone'] = "01711111111";
// $post_data['cus_fax'] = "01711111111";
    $client = new Client();

		$url  = 'https://sandbox.sslcommerz.com/gwprocess/v3/api.php';

        \Log::debug("SSL HITS");

		try{

			$response = $client->request('POST', $url, $params);

            if($response->getStatusCode() == 200)
            {
              Log::debug($response->getBody());
                return $response->getBody();
            
            } else {

                return false;

            }

        } catch(RequestException $e){

			return false;

    }
    
//     # REQUEST SEND TO SSLCOMMERZ
// $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";

// $handle = curl_init();
// curl_setopt($handle, CURLOPT_URL, $direct_api_url );
// curl_setopt($handle, CURLOPT_TIMEOUT, 30);
// curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
// curl_setopt($handle, CURLOPT_POST, 1 );
// curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
// curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


// $content = curl_exec($handle );

// $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

// if($code == 200 && !( curl_errno($handle))) {
// 	curl_close( $handle);
// 	$sslcommerzResponse = $content;
// } else {
// 	curl_close( $handle);
// 	echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
// 	exit;
// }

// # PARSE THE JSON RESPONSE
// $sslcz = json_decode($sslcommerzResponse, true );
// Log::debug($sslcz);
// if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
//         # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
//         # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
// 	echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
// 	# header("Location: ". $sslcz['GatewayPageURL']);
// 	exit;
// } else {
// 	echo "JSON Data parsing error!";
// }
    }

}
