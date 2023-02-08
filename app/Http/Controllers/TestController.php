<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
