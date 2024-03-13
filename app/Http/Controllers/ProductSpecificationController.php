<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SpecificationsProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class productSpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create($id)
    {
        //
        $product = Product::findOrFail($id);
        $productSpecifications = SpecificationsProduct::where('product_id','=',$product->id)->get();
        $productSpecificationCount = SpecificationsProduct::where('product_id','=',$product->id)->count();
        return view('layouts.admin.components.speciModal',compact('product','productSpecifications','productSpecificationCount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, SpecificationsProduct $productSpecification)
    {
        //
        $request->validate([
            'name' => 'required|unique:'.SpecificationsProduct::class,
            'value' => 'required',
            'position' => 'required|min:1|max:99999',
        ],[
            'name.required' => 'Không được bỏ trống trường này.',
            'name.unique' => 'Đã tồn tại thông số này.',
            'value.required' => 'Không được bỏ trống trường này.',
            'position.required' => 'Không được bỏ trống trường này.',
            'quantity.min' => 'Vị trí nhỏ nhất là 1.',
            'quantity.max' => 'Vị trí lớn nhất là 99999.',
        ]);

        $product = Product::findOrFail($request->product_id);
        $productSpecification->name = $request->name;
        $productSpecification->value = $request->value;
        $productSpecification->position = $request->position;
        $productSpecification->product_id = $product->id;
        $productSpecification->show_hide = $request->show_hide;
        $productSpecification->save();
        return redirect()->route('specifi.create',['id' => $product->id]);
            
    }

    public function edit(string $id)
    {
        //
        $productSpecification = SpecificationsProduct::findOrFail($id);
        $product = Product::findOrFail($productSpecification->product_id);
        $productSpecifications = SpecificationsProduct::where('product_id','=',$product->id)->get();
        $productSpecificationCount = SpecificationsProduct::where('product_id','=',$product->id)->count();
        return view('layouts.admin.components.speciModal',compact('productSpecification','productSpecifications','product','productSpecificationCount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $productSpecification = SpecificationsProduct::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:'.SpecificationsProduct::class.',name,'.$id,
            'value' => 'required',
            'position' => 'required|min:1|max:99999',
        ],[
            'name.required' => 'Không được bỏ trống trường này.',
            'name.unique' => 'Đã tồn tại thông số này.',
            'position.required' => 'Không được bỏ trống trường này.',
            'quantity.min' => 'Vị trí nhỏ nhất là 1.',
            'quantity.max' => 'Vị trí lớn nhất là 99999.',
        ]);

        $product = Product::findOrFail($productSpecification->product_id);
        $productSpecification->name = $request->name;
        $productSpecification->value = $request->value;
        $productSpecification->position = $request->position;
        $productSpecification->product_id = $product->id;
        $productSpecification->show_hide = $request->show_hide;
        $productSpecification->update();
        return redirect()->route('specifi.create',['id' => $product->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $productSpecification = SpecificationsProduct::findOrFail($id);
        $product = Product::findOrFail($productSpecification->product_id);
        $productSpecification->delete();
        return redirect()->route('varia.create',['id' => $product->id])->with('success','Xóa thành công!');
    }
}
