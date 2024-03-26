<?php

namespace App\Http\Controllers;

use App\Models\ShippingProviders;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShippingProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $shippingProviders = ShippingProviders::paginate(10);
        return view('layouts.admin.ShippingProviders.index',compact('shippingProviders'));

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,ShippingProviders $shippingProvider)
    {
        //
        $request->validate([
            'name' => 'required',
            'address' => [
                'required',
                Rule::unique('shipping_providers', 'address')->ignore($shippingProvider->id, 'id')->where(function ($query) use ($shippingProvider) {
                    $query->where('name', $shippingProvider->name);
                })
            ],    
            'shipping_cost' => 'required|min:0|numeric'
        ],[
            'name.required' => 'Vui lòng không bỏ trống trường này',
            'address.required' => 'Vui lòng không bỏ trống trường này',
            'address.unique' => 'Đã tồn tại khu vực này',
            'shipping_cost.required' => 'Vui lòng không bỏ trống trường này',
            'shipping_cost.min' => 'Vui lòng không nhập số nhỏ hơn 0',
        ]);
        $shippingProvider->name = $request->name;
        $shippingProvider->address = $request->address;
        $shippingProvider->shipping_cost = $request->shipping_cost;
        $shippingProvider->save();
        return redirect()->route('shipping.index')->with('success','Thêm nhà vận chuyển thành công');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $shippingProvider = ShippingProviders::findOrFail($id);
        $shippingProviders = ShippingProviders::paginate(10);
        return view('layouts.admin.ShippingProviders.index',compact('shippingProvider','shippingProviders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'address' =>'required',    
            'shipping_cost' => 'required|min:0|numeric'
        ],[
            'name.required' => 'Vui lòng không bỏ trống trường này',
            'address.required' => 'Vui lòng không bỏ trống trường này',
            // 'address.unique' => 'Đã tồn tại khu vực này',
            'shipping_cost.required' => 'Vui lòng không bỏ trống trường này',
            'shipping_cost.min' => 'Vui lòng không nhập số nhỏ hơn 0',
        ]);
        $shippingProvider = ShippingProviders::findOrFail($id); 
        $shippingProvider->name = $request->name;
        $shippingProvider->address = $request->address;
        $shippingProvider->shipping_cost = $request->shipping_cost;
        $shippingProvider->update();
        return redirect()->route('shipping.index')->with('success','Cập nhật nhà vận chuyển thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $shippingProvider = ShippingProviders::findOrFail($id); 
        $shippingProvider->delete();
        return redirect()->route('shipping.index')->with('success','Xóa nhà vận chuyển thành công');
    }
}
