<?php 
namespace App\Traits;
use App\Postint;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Database\Eloquent\Collection;

trait Post_int {
    public static function getData(){
 
// $data = DB::table('postints')
//     ->select('post_name', DB::raw('count(*) as category'))
//     ->groupBy('post_status')
//     ->pluck('category', 'post_name')
//     ->get();
// $data =DB::table('postints')
//     ->select('post_status', DB::raw('count(*) as category'))
//     ->groupBy('post_status')
//     ->where('post_price', '>', 2000)
//     ->get();

// $result  = Postint::all();
// $data = $result->groupBy("post_status");
//$data = DB::select('SELECT post_name,post_status  FROM postints group BY post_status');

//$data = mysqli_query("SELECT post_name,post_status, COUNT(*) as category FROM postints group BY post_status");
//SELECT post_name,post_status, COUNT(*) as category FROM postints group BY post_status
        //$data = Postint::all();
        // foreach ($data as $value) {
        //     dump($value->post_name);
        // }
        
        //dump($data);
        // DB::table('postints')->where('post_price', 2000)->exists();
// $data = DB::table("postints")
//           ->selectRaw('sum(post_price) as category')
// //->select('post_status',DB::raw('sum(post_price) as Total'))
//            // ->groupBy("post_status")
//             ->first();
// $data = DB::table('postints')
//     ->select('post_status', DB::raw('SUM(post_price) as total_sales'))
//     ->groupBy('post_status')
//     ->havingRaw('SUM(post_price) > ?', [563254])
//     ->get();
// $data = DB::table("postints")
//         ->whereColumn([
//             ["created_at" , "!=" ,"updated_at"],
//             ["post_qty" , "=" ,"post_status"]
//         ])
//         ->get();
$data = DB::table("postints")
        ->whereJsonContains("options->post_status",2)
        ->get();
// $data = DB::table("postints")
//         ->whereDay("updated_at",26)
//         ->get();
// $data = DB::table('postints')
//         ->select("post_name","post_qty",'post_status',"post_price")
//         ->where([
//             ['post_status',1],
//             ['post_price','>',4966]
//         ])
//         ->orWhere("post_status",2)
//         ->get();
   
return $data;
    }

    public static function chunk_post(){
        //DB::table('postints')->chunk(100);
        $data = DB::select("SELECT *FROM postints");
        $result = collect($data)->chunk(100);
        dump($result);


    }
    public static function create_data(){
        $flight = Postint::firstOrCreate(
    ['post_name' => 'Flight 102'],
    ['post_qty' => 101, 'post_price' => 5000]
);

        return $flight;

    }

    public static function unwp(){

        // return DB::table("postints")
        //             ->select("post_status", DB::raw("avg(post_price) as Average"))
        //             ->groupBy("post_status")
        //             ->get();
    return Collection::wrap('John Doe');

    }

    public static function atsf(){
        $data = "rakib hossain is nothing but confident";
        dump(explode(" ",$data));
    }
    public static function intersec(){
        $data1 = [1,2,3,4,5];
        $datax = [1,2,3,4,5,[2,"rakib"],[["hello"]]];
        $data2 = [10,2,1,3,25];
        dump(array_flatten($datax));
       // array_unique($data2);
    }
    
}

?>