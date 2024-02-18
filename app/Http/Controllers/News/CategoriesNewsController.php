<?php

namespace App\Http\Controllers\News;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriesNews;
use App\Http\Controllers\Controller;

class CategoriesNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = CategoriesNews::all();
        $categories_parent = CategoriesNews::where([
            ['id','!=',1],
        ])->get();

        return view('layouts.admin.News.Categories.index',compact('categories','categories_parent'));
    }

    public function store(Request $request, CategoriesNews $categoriesNews)
    {
        //
        $request->validate([
            'name' => 'required|unique:categories_news,name',
            'index' =>'required|numeric|min:1|max:999',
        ],[
            'name.required'=>'Không được để trống trường này!',
            'name.unique'=>'Đã tồn tại danh mục này rồi!',
            'index.required'=>'Không được để trống trường này!',
            'index.numeric'=>'Vui lòng nhập số!',
            'index.min'=>'Vui lòng nhập số lớn hơn hoặc bằng 1 !',
            'index.max'=>'Vui lòng nhập số nhỏ hơn 999 !',
        ]);
        $slug = Str::slug($request->name); 
        $categoriesNews->name = $request->name;
        $categoriesNews->slug = $slug;
        $categoriesNews->index = $request->index;
        $categoriesNews->parent_category_id = $request->parent_id;
        $categoriesNews->show_hide = $request->show_hide;
        $categoriesNews->save();
        return redirect()->route('news.cat.index')->with('success','Thêm mới danh mục thành công');
    }

    public function show(string $id)
    {
        //
        $categoryDelete = CategoriesNews::findOrFail($id);
        $categories = CategoriesNews::all();
        $categories_parent = CategoriesNews::where([
            ['id','!=',1],
            ['id','!=',$id],
            ['parent_category_id',null],
        ])->get();
        return view('layouts.admin.News.Categories.index',compact('categoryDelete','categories','categories_parent'));

    }
    public function edit(string $id)
    {
        //
        $category = CategoriesNews::findOrFail($id);
        $categories = CategoriesNews::all();
        $categories_parent = CategoriesNews::where([
            ['id','!=',1],
            ['id','!=',$id],
            ['parent_category_id',null],
        ])->get();
        return view('layouts.admin.News.Categories.index',compact('category','categories','categories_parent'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $category = CategoriesNews::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:categories_news,name,'.$id,
            'index' => 'required|min:1|max:999',
        ],[
            'name.required'=>'Không được để trống trường này!',
            'name.unique'=>'Đã tồn tại danh mục này rồi!',
            'index.required'=>'Không được để trống trường này!',
            'index.numeric'=>'Vui lòng nhập số!',
            'index.min'=>'Vui lòng nhập số lớn hơn hoặc bằng 1 !',
            'index.max'=>'Vui lòng nhập số nhỏ hơn 999 !',

        ]);
        $slug = Str::slug($request->name); 
        $category->name = $request->name;
        $category->slug = $slug;
        $category->index = $request->index;
        $category->parent_category_id = $request->parent_id;
        $category->show_hide = $request->show_hide;
        $category->update();
        return redirect()->route('news.cat.index')->with('success','Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = CategoriesNews::findOrFail($id);
        $category->delete();
        $alert='Danh mục '.$category->name.' đã được xóa thành công.';
        return redirect()->route('news.cat.index')->with('success',$alert);

    }
}
