<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Categories::orderBy('id','DESC')->paginate(10);
        return view('admin.categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
        ],[
            'name.requried' => 'Name is required'
        ]);
        if($v->fails()){
            return back()->withErrors($v->errors());
        }
        try{
            $name = filter_var($request->name, FILTER_SANITIZE_STRING);
            Categories::create(['name' => $name]);
            return redirect()->route('admin.categories.index')->with('msg', ['type' => 'success','content' => 'Category Created Successfully']);
        }catch(Exception $e){
            return back()->with('error','Cannot create category');
        }
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
        $data = Categories::findOrFail($id);
        return view('admin.categories.edit', compact('data'));
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
        ],[
            'name.requried' => 'Name is required'
        ]);
        if($v->fails()){
            return back()->withErrors($v->errors());
        }
        try{
            $name = filter_var($request->name, FILTER_SANITIZE_STRING);
            Categories::where('id', $id)->update(['name' => $name]);
            return redirect()->route('admin.categories.index')->with('msg', ['type' => 'success','content' => 'Category Updated Successfully']);
        }catch(Exception $e){
            return back()->with('error','Cannot update category');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $cat = Categories::findOrFail($id);
            $name = $cat->name;
            $cat->delete();
            return back()->with('msg', ['type' => 'success','content' => "Category '$name' Deleted Successfully"]);
        }catch(Exception $e){
            return back()->with('msg', ['type' => 'error','content' => 'Cannot Delete Category']);
        }
    }
}
// get => admin/categories [index]
// post => admin/categories [store]
// get => admin/categories/{id}/edit [edit]
// put/patch => admin/categories/{id} [update]
// delete => admin/categories/1 [destory]

// admin/categories/{}
// php => browser => html,css,js