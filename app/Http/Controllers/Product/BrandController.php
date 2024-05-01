<?php

namespace App\Http\Controllers\Product;

use App\Models\Brands;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $brands = Brands::orderBy('position','asc')->get();
        $data = compact('brands');
        return view('layouts.admin.Brands.index',$data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Brands $brands)
    {
        $request->validate([
            'name' => 'required|unique:'.Brands::class,
            'country' => 'required',
            'position' => 'required|min:1|max:99999|numeric',
        ],[
            'name.required'=>'Vui lòng không để trống trường này',
            'name.unique'=>'Đã tồn tại danh mục này rồi!',
            'country.required'=>'Vui lòng không để trống trường này',
            'position.required'=>'Vui lòng không để trống trường này',
            'position.min'=>'Vui lòng nhập số lớn hơn hoặc bằng 1',
            'position.max'=>'Vui lòng nhập số tối đa là 99999',
            'position.numeric'=>'Vui lòng nhập số',
        ]);
        $slug = Str::slug($request->name); 
        $brands->name = $request->name;
        $brands->slug = $slug;
        $brands->position = $request->position;
        $brands->country = $request->country;
        $brands->show_hide = $request->show_hide;
        $brands->save();
        return redirect()->back()->with('success','Thêm mới thành công');

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $brand = Brands::findOrFail($id);
        $brands = Brands::orderBy('position','asc')->orderByDesc('created_at')->paginate(8);
        $data = compact('brands','brand');
        return view('layouts.admin.Brands.index',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $brand = Brands::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:'.Brands::class.',name,'.$id,
            'country' => 'required',
            'position' => 'required|min:1|max:99999|numeric',
        ],[
            'name.required'=>'Vui lòng không để trống trường này',
            'name.unique'=>'Đã tồn tại danh mục này rồi!',
            'country.required'=>'Vui lòng không để trống trường này',
            'position.required'=>'Vui lòng không để trống trường này',
            'position.min'=>'Vui lòng nhập số lớn hơn hoặc bằng 1',
            'position.max'=>'Vui lòng nhập số tối đa là 99999',
            'position.numeric'=>'Vui lòng nhập số',
        ]);
        $slug = Str::slug($request->name); 
        $brand->name = $request->name;
        $brand->slug = $slug;
        $brand->country = $request->country;
        $brand->position = $request->position;
        $brand->show_hide = $request->show_hide;
        $brand->update();
        return redirect()->route('brand.index')->with('success','Cập nhật thành công');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $brand = Brands::findOrFail($id);
        $brand->delete();
        $alert='Thương hiệu '.$brand->name.' đã được xóa thành công.';
        return redirect()->route('brand.index')->with('success',$alert);

    }
}
