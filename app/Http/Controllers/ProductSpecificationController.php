<?php

namespace App\Http\Controllers;

use App\Models\CategoriesProduct;
use App\Models\Product;
use App\Models\Specification;
use App\Models\SpecificationsProduct;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class productSpecificationController extends Controller
{

    public function create($id)
    {
        //
        $param = request()->query('speci',null);
       
        $product = Product::findOrFail($id);
        $products = Product::where('show_hide',true)->get();
        $categories = CategoriesProduct::where([['show_hide',true],['parent_category_id',null]])->get();
        $category = $product->category;
        $specis = $category->specis()->get(); 
        $specisKey = Specification::where('categories_product_id',$param)->get();
        $productSpecifications = $product->specifications()->get();
        $productSpecificationCount = SpecificationsProduct::where('product_id',$product->id)->count();
        return view('layouts.admin.components.speciModal',compact(
            'product','productSpecifications','products',
            'productSpecificationCount','specis',
            'categories','specisKey'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, SpecificationsProduct $productSpecification)
    {
        //
        $request->validate([
            // 'name' => ['required',
            // Rule::unique('specifications_products', 'name')->ignore($productVariation->id, 'id')->where(function ($query) use ($productVariation) {
            //     $query->where('product_id', $productVariation->product_id);
            // })
            // ],
            // 'name' => 'required|unique:'.SpecificationsProduct::class,
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
        // Luu id key speci 
        $productSpecification->speci_id = $request->speci_id;

        $productSpecification->value = $request->value;
        $productSpecification->position = $request->position;
        $productSpecification->product_id = $product->id;
        // Copy lai thong so san pham bang cach luu id cu san pham do
        $productSpecification->rep_speci_product_id = $request->rep_speci_product_id;
        // Kiem tra xem do co phai la thong so dac biet ko
        $productSpecification->type_speci = $request->type_speci == 'on' || $request->rep_speci_product_id ? true : false;

        $productSpecification->show_hide = $request->show_hide;
        $productSpecification->save();
        return redirect()->route('specifi.create',['id' => $product->id]);
            
    }

    public function edit(string $id)
    {
        //
        $productSpecification = SpecificationsProduct::findOrFail($id);
        $product = Product::findOrFail($productSpecification->product_id);
        $category = $product->category;
        $specis = $category->specis()->get();        $productSpecifications = SpecificationsProduct::where('product_id',$product->id)->get();
        $productSpecificationCount = SpecificationsProduct::where('product_id',$product->id)->count();
        return view('layouts.admin.components.speciModal',compact('productSpecification','productSpecifications','product','specis','productSpecificationCount'));
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
        return redirect()->route('specifi.create',['id' => $product->id])->with('success','Xóa thành công!');
    }
}
