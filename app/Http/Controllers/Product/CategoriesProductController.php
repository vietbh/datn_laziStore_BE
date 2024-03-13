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
        $categories_parent = CategoriesProduct::where([
            ['id','!=',1],
        ])->get();
        return view('layouts.admin.Product.Categories.index',compact('categories','categories_parent'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CategoriesProduct $categoriesProduct)
    {
        // Kiểm tra và xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|unique:categories_products',
            'index' => 'nullable|integer|min:1|max:99999',
            'parent_id' => 'nullable|exists:categories_products,id',
            'show_hide' => 'required|boolean',
        ], [
            'name.required' => 'Không được để trống trường này!',
            'name.unique' => 'Đã tồn tại danh mục này rồi!',
            'index.min' => 'Vui lòng nhập số lớn hơn hoặc bằng 1!',
            'parent_id.exists' => 'Danh mục cha không hợp lệ!',
            'show_hide.required' => 'Trường này là bắt buộc!',
            'show_hide.boolean' => 'Giá trị không hợp lệ cho trường này!',
        ]);
    
        // Tạo slug từ tên danh mục
        $slug = Str::slug($request->name);
    
        // Gán giá trị vào các thuộc tính của đối tượng CategoriesProduct
        $categoriesProduct->name = $request->name;
        $categoriesProduct->slug = $slug;
        $categoriesProduct->position = $request->index;
        $categoriesProduct->parent_category_id = $request->parent_id;
        $categoriesProduct->show_hide = $request->show_hide;
    
        // Lưu đối tượng CategoriesProduct vào cơ sở dữ liệu
        $categoriesProduct->save();
    
        return redirect()->route('product.cat.index')->with('success', 'Thêm mới danh mục thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $category = CategoriesProduct::findOrFail($id);
        $categories = CategoriesProduct::all();
        $categories_parent = CategoriesProduct::where([
            ['id','!=',1],
            ['id','!=',$id],
            ['parent_category_id',null],
        ])->get();
        return view('layouts.admin.Product.Categories.index',compact('category','categories','categories_parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $category = CategoriesProduct::findOrFail($id);
        $request->validate([
            'name' => 'required|max:255|unique:categories_products,name,'.$id,
            'index' => 'required|min:1',
        ],[
            'name.required'=>'Không được để trống trường này!',
            'name.unique'=>'Đã tồn tại danh mục này rồi!',
            'index.required'=>'Không được để trống trường này!',
        ]);
        $slug = Str::slug($request->name); 
        $category->name = $request->name;
        $category->slug = $slug;
        $category->index = $request->index;
        $category->parent_category_id = $request->parent_id;
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
        $category->delete();
        $alert='Danh mục '.$category->name.' đã được xóa thành công.';
        return redirect()->route('product.cat.index')->with('success',$alert);

    }
}
