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
        $brands = Brands::all();
        $data = compact('brands');
        return view('layouts.admin.Brands.index',$data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Brands $brands)
    {
        $request->validate([
            'name' => 'required|unique:brands,name|max:255',
            'country' => 'required',
            
        ],[
            'name.required'=>'Không được để trống trường này!',
            'name.unique'=>'Đã tồn tại danh mục này rồi!',
            'country.required'=>'Không được để trống trường này!',
        ]);
        $slug = Str::slug($request->name); 
        $brands->name = $request->name;
        $brands->slug = $slug;
        $brands->country = $request->country;
        $brands->show_hide = $request->show_hide;
        $brands->save();
        return redirect()->route('brand.index')->with('success','Thêm mới thành công');

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $brands = Brands::all();
        $brand = Brands::findOrFail($id);
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
            'name' => "required|max:255|unique:brands,name,".$id,
            'country' => 'required|min:1'
        ],[
            'name.required'=>'Không được để trống trường này!',
            'country.required'=>'Không được để trống trường này!',
        ]);
        $slug = Str::slug($request->name); 
        $brand->name = $request->name;
        $brand->slug = $slug;
        $brand->country = $request->country;
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
        // dd($brand);
        
        $brand->delete();
        $alert='Thương hiệu '.$brand->name.' đã được xóa thành công.';
        return redirect()->route('brand.index')->with('success',$alert);

    }
}
