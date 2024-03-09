<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\CategoriesProduct;
use App\Models\Product;
use App\Models\ProductVariation;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductVariationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ProductVariation $productVariation)
    {
        //
        $request->validate([
            'image_url' => 'required|mimes:jpg, png, jpeg, jfif',
            'color_type' => [
                'required',
                Rule::unique('product_variations', 'color_type')->ignore($productVariation->id, 'id')->where(function ($query) use ($productVariation) {
                    $query->where('product_id', $productVariation->product_id);
                }),
            ],
            'price' => 'required',
            'price_sale' => 'required|lt:price',
            'quantity' => 'required|min:1',
        ],[
            'image_url.required' => 'Không được bỏ trống trường này.',
            'image_url.mimes' => 'Chỉ cho phép file có đuôi là jpg, png, jpeg, jfif.',
            'color_type.required' => 'Không được bỏ trống trường này.',
            'color_type.unique' => 'Đã tồn tại màu này.',
            'price.required' => 'Không được bỏ trống trường này.',
            'price_sale.required' => 'Không được bỏ trống trường này.',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'quantity.required' => 'Không được bỏ trống trường này.',
            'quantity.min' => 'Không tồn tại số lượng 0.',
        ]);

        $file = $request->file('image_url'); // Lấy file từ request    
        if (!$file) {
            // Tiếp tục xử lý hoặc trả về đường dẫn đã lưu
            return redirect()->route('product.create');
        }
        $path = $file->store('images_product', 'public'); // Lưu file vào thư mục 'folder_name'
        $url = asset(Storage::url($path));
        $productVariation->image_path = $path;
        $productVariation->image_url = $url;
        $productVariation->color_type = $request->color_type;
        $productVariation->price = $request->price*1000;
        $productVariation->price_sale = $request->price_sale*1000;
        $productVariation->quantity = $request->quantity;
        $productVariation->quantity_available = $request->quantity;
        $productVariation->save();
        return redirect()->route('product.create');
            
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $productVariation = ProductVariation::findOrFail($id);
        $categories = CategoriesProduct::where('show_hide',true)->get();
        $brands = Brands::where('show_hide',true)->get();
        $productVariationsCreate = ProductVariation::where('product_id',null)->get();
        $data = compact('categories','brands','productVariationsCreate','productVariation');
        return view('layouts.admin.Product.store',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $productVariation = ProductVariation::findOrFail($id);
        $request->validate([
            'image_url' => 'mimes:jpg, png, jpeg, jfif',
            'color_type' => [
                Rule::unique('product_variations', 'color_type')->ignore($productVariation->id, 'id')->where(function ($query) use ($productVariation) {
                    $query->where('product_id', $productVariation->product_id);
                }),
            ],
            'price_sale' => 'lt:price',
            'quantity' => 'min:1|numberic',
        ],[
            'image_url.mimes' => 'Chỉ cho phép file có đuôi là jpg, png, jpeg, , jfif.',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'quantity.min' => 'Không tồn tại số lượng 0.',
            'quantity.numberic' => 'Chỉ được điền số.',
        ]);

        $file = $request->file('image_url'); // Lấy file từ request    
        if ($file) {
            // Tiếp tục xử lý hoặc trả về đường dẫn đã lưu
            $path = $file->store('images_product', 'public'); // Lưu file vào thư mục 'folder_name'
            $url = asset(Storage::url($path));
            $productVariation->image_path = $path;
            $productVariation->image_url = $url;
        }
        $productVariation->color_type = $request->color_type;
        $productVariation->price = $request->price*1000;
        $productVariation->price_sale = $request->price_sale*1000;
        $productVariation->quantity = $request->quantity;
        $productVariation->quantity_available = $request->quantity;
        $productVariation->update();
        
        return redirect()->route('product.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $productVariation = ProductVariation::findOrFail($id);
        $path = $productVariation->image_path; // Đường dẫn tới file cần xóa trong thư mục 'public'
        if(!Storage::exists('public/'. $path)){
            return redirect()->route('product.create')->with('error','Xóa hình ảnh không thành công!');
        };
        $productVariation->delete();
        return redirect()->route('product.create')->with('success','Xóa thành công!');
    }
}
