<?php

namespace App\Http\Controllers\Product;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoriesProduct;

class CategoriesProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = CategoriesProduct::all();
        
        return view('layouts.admin.Product.Categories.index',compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CategoriesProduct $categoriesProduct)
    {
        //
        $validated = $request->validate([
            'title' => 'required|unique:categories_products|max:255',
        ],[
            'title.required'=>'Không được để trống trường này!',
            'title.unique'=>'Đã tồn tại danh mục này rồi!',
        ]);
        $slug = Str::slug($request->title); 
        $categoriesProduct->title = $request->title;
        $categoriesProduct->slug = $slug;
        $categoriesProduct->index = $request->index;
        $categoriesProduct->show_hide = $request->show_hide;
        $categoriesProduct->save();
        return redirect()->route('product.cat.index')->with('success','Thêm mới danh mục thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $category = CategoriesProduct::findOrFail($id);
        $categories = CategoriesProduct::all();
        // dd($category);
        return view('layouts.admin.Product.Categories.index',compact('category'),compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $category = CategoriesProduct::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|unique:categories_products|max:255',
            'index' => 'required|min:1'
        ],[
            'title.required'=>'Không được để trống trường này!',
            'title.unique'=>'Đã tồn tại danh mục này rồi!',
            'index.required'=>'Không được để trống trường này!',
        ]);
        $slug = Str::slug($request->title); 
        $category->title = $request->title;
        $category->slug = $slug;
        $category->index = $request->index;
        $category->show_hide = $request->show_hide;
        $category->update();
        return redirect()->route('product.cat.index')->with('success','Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = CategoriesProduct::findOrFail($id);
        // dd($category);
        
        $category->delete();
        $alert='Danh mục '.$category->title.' đã được xóa thành công.';
        return redirect()->route('cat.product')->with('success',$alert);

    }
}
