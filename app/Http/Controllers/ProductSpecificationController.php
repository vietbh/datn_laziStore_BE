<?php

namespace App\Http\Controllers;

use App\Models\CategoriesProduct;
use App\Models\Product;
use App\Models\Specification;
use App\Models\SpecificationsProduct;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductSpecificationController extends Controller
{

    public function create($idProduct)
    {
        //
        $param = request()->query('danh_muc',null);
        
        if($param) $category = CategoriesProduct::where('slug',$param)->first();

        $product = Product::findOrFail($idProduct);
        // $products = Product::where('show_hide',true)->get();
        $categories = CategoriesProduct::where([['show_hide',true],['parent_category_id',null]])->get();

        $specis = Specification::where('categories_product_id', $category->id ?? $categories->first()->id)->get();
        
        $productSpecifications = $product->specifications()->whereIn('speci_id',$specis->pluck('id'))->get();
        
        $productSpecificationCount = SpecificationsProduct::where('product_id',$product->id)->count();
        return view('layouts.admin.components.speciModal',compact(
            'product',
            'productSpecifications',
            // 'products',
            'productSpecificationCount',
            'specis',
            'categories',
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, SpecificationsProduct $productSpecification)
    {
        //
        $request->validate([
            'speci_id' => 'required',
            'value' => 'required',
            'position' => 'required|min:1|max:99999',
        ],[
            // 'name.required' => 'Không được bỏ trống trường này.',
            // 'name.unique' => 'Đã tồn tại thông số này.',
            'speci_id.required' => 'Không được bỏ trống trường này.',
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
        return redirect()->back()->with('success','Thêm thông số sản phẩm thành công');
            
    }

    public function edit(string $id)
    {
        //
        $productSpecification = SpecificationsProduct::findOrFail($id);
        $product = Product::findOrFail($productSpecification->product_id);
        $param = request()->query('danh_muc',null);
        
        if($param) $category = CategoriesProduct::where('slug',$param)->first();
        
        $categories = CategoriesProduct::where([['show_hide',true],['parent_category_id',null]])->get();
        
        $products = Product::where('show_hide',true)->get();
        
        $specis = Specification::where('categories_product_id',$category->id??$categories->first()->id)->get();
        $productSpecifications = $product->specifications()->orderBy('position')->get();
        if($param){
            $productSpecifications = $product->specifications()->whereIn('speci_id',$specis->pluck('id'))->orderBy('position')->get();
        }
        $productSpecificationCount = SpecificationsProduct::where('product_id',$product->id)->count();
        return view('layouts.admin.components.speciModal',compact(
            'product',
            'products',
            'specis',
            'categories',
            'productSpecification',
            'productSpecifications',
            'productSpecificationCount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $productSpecification = SpecificationsProduct::findOrFail($request->product_speci_id);
      
        $request->validate([
            'speci_id' => 'required|unique:specifications_products,speci_id,'.$request->product_speci_id,
            'value' => 'required',
            'position' => 'required|min:1|max:99999',
        ],[
            'speci_id.required' => 'Không được bỏ trống trường này.',
            'speci_id.unique' => 'Đã tồn tại thông số này.',
            'position.required' => 'Không được bỏ trống trường này.',
            'quantity.min' => 'Vị trí nhỏ nhất là 1.',
            'quantity.max' => 'Vị trí lớn nhất là 99999.',
        ]);
        $productSpecification->speci_id = $request->speci_id;
        $productSpecification->value = $request->value;
        $productSpecification->type_speci = $request->type_speci == 'on' ? true : false;
        $productSpecification->position = $request->position;
        $productSpecification->show_hide = $request->show_hide;
        $productSpecification->update();
        return redirect()->back()->with('success','Cập nhật thông số thành công');
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
        return redirect()->back()->with('success','Xóa thông số thành công');
    }
}
