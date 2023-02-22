<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    function index(Request $request){
        $categories = Categories::has('products')->with('products')->get();
        if($request->has('categories')){
            $products = Products::with('categories','products_images','products_variants')->where([['is_publish', '1'], ['categories_id', $request->categories]])->get();
        }else{
            $products = Products::with('categories','products_images','products_variants')->where('is_publish', '1')->get();
        }
        return view('user.index', compact('categories', 'products'));
    }
}
