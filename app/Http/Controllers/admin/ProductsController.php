<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use App\Models\ProductsImages;
use App\Models\ProductsVariants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catCount = Categories::count();
        $data = Products::with('categories', 'products_variants', 'products_images')->orderBy('id', 'DESC')->paginate(15);
        return view('admin.products.index', compact('data', 'catCount'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::select('id','name')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string',
            'categories_id' => 'required|integer',
            'brand' => 'required|string',
            'description'=> 'required|string',
            'images.*' => 'file|mimes:jpg,png,jpeg,gif,webp,svg|max:2048',
        ]);
        if($v->fails()){
            return back()->withErrors($v->errors())->withInput($request->all());
        }
        $product = Products::create([
            'categories_id' => $request->categories_id,
            'name' => filter_var($request->name, FILTER_SANITIZE_STRING),
            'brand'=> filter_var($request->brand, FILTER_SANITIZE_STRING),
            'description'=> $request->description,
            'is_publish' => $request->has('is_publish') ? '1' : '0',
        ]);

        if($request->hasFile('images')){
            foreach($request->file('images') as $file){
                $url = Storage::put('product_images', $file);
                ProductsImages::create([
                    'products_id' => $product->id,
                    'url' => $url,
                ]);
            }
        }
        if(count($request->variant_name) > 0){
            foreach($request->variant_name as $index=>$name){
                ProductsVariants::create([
                    'products_id' => $product->id,
                    'name' => $name,
                    'price' => $request->variant_price[$index]
                ]);
            }
        }
        return redirect()->route('admin.products.index')->with('msg', ['type' => 'success','content' => 'Product Created Successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Products::findOrFail($id);
        $categories = Categories::select('id', 'name')->get();
        return view('admin.products.edit', compact('categories', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $v = Validator::make($request->all(), [
            'name' => 'required|string',
            'categories_id' => 'required|integer',
            'brand' => 'required|string',
            'description'=> 'required|string',
            'images.*' => 'file|mimes:jpg,png,jpeg,gif,webp,svg|max:2048',
        ]);
        if($v->fails()){
            return back()->withErrors($v->errors())->withInput($request->all());
        }
        Products::where('id', $id)->update([
            'categories_id' => $request->categories_id,
            'name' => filter_var($request->name, FILTER_SANITIZE_STRING),
            'brand'=> filter_var($request->brand, FILTER_SANITIZE_STRING),
            'description'=> $request->description,
            'is_publish' => $request->has('is_publish') ? 1 : 0,
        ]);

        if(count($request->old_images) > 0){
            $pimg = ProductsImages::whereNotIn('id', $request->old_images)->where('products_id', $id);
            foreach($pimg->get() as $img){
                Storage::delete($img->getRawOriginal('url'));
            }
            $pimg->delete();

        }else{
            $pimg = ProductsImages::where('products_id', $id);
            foreach($pimg->get() as $img){
                Storage::delete($img->getRawOriginal('url'));
            }
            $pimg->delete();
        }

        if($request->hasFile('images')){
            foreach($request->file('images') as $file){
                $url = Storage::put('product_images', $file);
                ProductsImages::create([
                    'products_id' => $id,
                    'url' => $url,
                ]);
            }
        }

        if(count($request->variant_name) > 0){
            ProductsVariants::where('products_id', $id)->delete();
            foreach($request->variant_name as $index=>$name){
                ProductsVariants::create([
                    'products_id' => $id,
                    'name' => $name,
                    'price' => $request->variant_price[$index]
                ]);
            }
        }
        return redirect()->route('admin.products.index')->with('msg', ['type' => 'success','content' => 'Product Edited Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = Products::findOrFail($id);
        foreach($p->products_images as $img){
            Storage::delete($img->getRawOriginal('url')); // delete storage data
            // $img->delete(); // delete db data
        }
        // $p->products_variants()->delete();
        $p->delete();
        return redirect()->route('admin.products.index')->with('msg', ['type' => 'success','content' => 'Product Deleted Successfully']);

    }
    function getProductsImages($id){
        $data = Products::findOrFail($id);
        $images = [];
        foreach($data->products_images as $img){
            $images[] = [
                'id' => $img->id,
                'src' => $img->url
            ];
        }
        return response()->json($images);
    }
}
