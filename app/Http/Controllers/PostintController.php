<?php

namespace App\Http\Controllers;

use App\Model\Piproduct;
use App\Storage_prac_image;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PostintController extends Controller
{
    public function hola(){
        return view('form_validation');
    }
    public function getData(Request $request){
        //dd(request()->query('sortby'));
        // dd(request()->has('product_stock'));
         $all_data = Piproduct::query();
        if (request()->has('sortby')) {
            // $url = url()->previous();
            // $parse_url = parse_url($url);
            // dd($parse_url['query']);
          //  dd(request()->query());
            $all_data = $all_data->orderBy(request()->query('sortby'));
            // return view('form_validation', ['ki' => $all_data]);
        }
            if(request()->has('product_stock')){
          //  dd("fff");
            $all_data = $all_data->Where('product_stock', request()->query('product_stock'));
           // return view('form_validation', ['ki' => $all_data]);
}

        $all_data = $all_data->get();
        return view('form_validation', ['ki' => $all_data]);
      // print_r($all_data);
     // dd($all_data);
        
        //return view('form_validation')->with('ki',$all_data);
    }
    public function f_insert( Request $re){
  //  dd($re->image->path());
  dd($re->header());
      $final = $this->checkValidate();
     // dd($final);
      unset($final['hola_name']);
      unset($final['hola_phone']);
      unset($final['hola_image']);
      $final['name'] = $re->hola_name;
      $final['phoen'] = $re->hola_phone;
     
      if(Storage::disk('public')->exists('uploads/Brofest.jpg')){

Storage::disk('public')->delete('uploads/Brofest.jpg');

        dd("soory_bro");
        return "has";
      }
      $final['st_image'] = $re->image->storeAs('public/uploads/', 'Brofest.jpg');
      //dd($final);
        Storage_prac_image::create($final);
        return redirect()->route("homee")->withInput();
     
    }

    public function checkValidate(){
        $result =  request()->validate([
            'hola_name' => 'required',
            'hola_phone' => 'required',
            'image'=>'required|file|image|max:1000'
        ]);
        // if(request()->has("hola_image")){
        //   request()->validate([
        //     'hola_iamge'=>'file|image|max:1000'
        //   ]);
        // }
        return $result;
    }
}
