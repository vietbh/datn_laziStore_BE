<?php

namespace App\Http\Controllers;

use App\Models\CategoriesProduct;
use App\Models\Product;
use App\Models\Specification;
use Illuminate\Http\Request;

class SpecificationController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Specification $specification)
    {
        //
        $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Không được bỏ trống trường này.',
        ]);

        $specification->name = $request->name;
        $specification->categories_product_id = $request->categories_product_id;
        $specification->save();
        return redirect()->route('specifi.create',['id' => $request->product_id,'tab'=>'speci']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $productId, string $id)
    {
        //
        $param = request()->query('speci',null);

        $speciDetail = Specification::findOrFail($id);
        $product = Product::findOrFail($productId);
        $productSpecificationCount = $product->specifications()->count();
        $productSpecifications = $product->specifications()->get();
        $categoryProduct = $product->category;
        $categories = CategoriesProduct::where([['show_hide',true],['parent_category_id',null]])->get();
        $specis = $categoryProduct->specis()->get();
        $specisKey = Specification::where('categories_product_id',$param)->get();

        return view('layouts.admin.components.speciModal',compact(
            'speciDetail','specis','specisKey',
            'productSpecifications','product',
            'productSpecificationCount','categories',
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Không được bỏ trống trường này.',
        ]);
        $specification = Specification::findOrFail($id);
        $specification->name = $request->name;
        $specification->categories_product_id = $request->categories_product_id;
        $specification->update();
        return redirect()->route('specifi.create',['id' => $request->product_id,'tab'=>'speci']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $paramProductId = request()->query('productId',null);
        $specification = Specification::findOrFail($id);
        $specification->delete();
        return redirect()->route('specifi.create',['id' => $paramProductId,'tab'=>'speci']);
    }
}
