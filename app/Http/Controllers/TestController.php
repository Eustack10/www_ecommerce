<?php

namespace App\Http\Controllers;

use App\Mail\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    function storage(Request $request){
        if($request->has('img')){
            // $url = Storage::put('test_images', $request->file('img'));
            // $url = Storage::putFileAs('test_images', $request->file('img'), 'abc.jpg');
            // echo $url;
            Storage::delete('test_images/abc.jpg');
        }
    }
    function mail(){
        $data = [
            'name' => 'Min Hein Kyaw',
        ];
        Mail::to('minheinkyaw404@gmail.com')->send(new VerifyUser($data));
    }

    function session(){
        $cart = Session::get('cart');
        // $key = (string) array_search(111, array_column($cart, 'products_variants_id'));
        // Session::flush();

        // if($key == ''){
        //     echo "Push";
        // }else{
        //     echo "Add Quantity";
        // }
        dd($cart);

        // '0' 'false'
    }
}
