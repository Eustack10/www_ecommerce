<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
    function productDetail($id){
        $product = Products::findOrFail($id);
        $relatedProducts = Products::with('products_images', 'products_variants')->where([['categories_id', $product->categories_id], ['id','!=',$product->id]])->limit(5)->get();
        return view('user.product-detail', compact('product', 'relatedProducts'));
    }
    function addToCart(Request $request){
        $v = Validator::make($request->all(), [
            'products_variants_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);
        if($v->fails()){
            return;
        }
        $cart = Session::get('cart');
        $pv_id = (int) $request->products_variants_id;
        $q = (int) $request->quantity;
        $new_data = [
            'products_variants_id' => $pv_id,
            'quantity' => $q,
        ];
        if(empty($cart)){
            $data = Session::push('cart', $new_data);
        }else{
            $key = (string) array_search($request->products_variants_id, array_column($cart, 'products_variants_id'));
            if($key == ''){
                $data = Session::push('cart', $new_data);
            }else{
                $cart[$key]['quantity'] += $request->quantity;
                Session::put('cart', $cart);
            }
        }
        //     $pv_id;
        //     foreach($cart as $c){
        //         if($c['products_variants_id'] == $request->products_variants_id){
        //             $pv_id = $c['products_variants_id'];
        //         }
        //     }
            
        //     // $cart
        // }
        
        // return $data;
    }
}