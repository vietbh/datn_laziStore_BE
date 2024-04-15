<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductVariationController extends Controller
{

    public function index()
    {
        //
    }
    public function create($id)
    {
        //
        $product = Product::findOrFail($id);
        $productVariations = ProductVariation::where('product_id',$product->id)->get();
        $productVariationCount = ProductVariation::where('product_id',$product->id)->count();
        return view('layouts.admin.components.variaModal',compact('product','productVariations','productVariationCount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ProductVariation $productVariation)
    {
        //
        $request->validate([
            // |mimes:jpg, png, jpeg, jfif
            'image_url' => 'required|image|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'color_type' => ['required',
                Rule::unique('product_variations', 'color_type')->ignore($productVariation->id, 'id')->where(function ($query) use ($productVariation) {
                    $query->where('product_id', $productVariation->product_id);
                })
            ],
            'price' => 'required',
            'price_sale' => 'required|lt:price',
            'quantity' => 'required|min:1',
        ],[
            'image_url.required' => 'Không được bỏ trống trường này.',
            'image_url.image' => 'Chỉ cho phép file hình.',
            'image_url.mimes' => 'Chỉ cho phép file có đuôi là jpg, png, jpeg, jfif.',
            'image_url.max' => 'Chỉ cho phép kích thước tối đa 2048kb.',
            'color_type.required' => 'Không được bỏ trống trường này.',
            'color_type.unique' => 'Đã tồn tại màu này.',
            'price.required' => 'Không được bỏ trống trường này.',
            'price_sale.required' => 'Không được bỏ trống trường này.',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'quantity.required' => 'Không được bỏ trống trường này.',
            'quantity.min' => 'Số lượng nhỏ nhất là 1.',
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
        $productVariation->product_id = $request->product_id;
        $productVariation->quantity_available = $request->quantity;
        
        $productVariation->save();
        return redirect()->route('varia.create',['id'=>$request->product_id]);
            
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
        $product = Product::findOrFail($productVariation->product_id);
        $productVariations = ProductVariation::where('product_id','=',$product->id)->get();
        $productVariationCount = ProductVariation::where('product_id','=',$product->id)->count();
        return view('layouts.admin.components.variaModal',compact('productVariation','productVariations','product','productVariationCount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // [
        //     Rule::unique('product_variations', 'color_type')->ignore($productVariation->id, 'id')->where(function ($query) use ($productVariation) {
        //         $query->where('product_id', $productVariation->product_id);
        //     }),
        // ]
        $productVariation = ProductVariation::findOrFail($id);
        $request->validate([
            'image_url' => 'mimes:jpg, png, jpeg, jfif', 'WEBP',
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
            'image_url.mimes' => 'Chỉ cho phép file có đuôi là jpg, png, jpeg, jfif, WEBP.',
            'color_type.required' => 'Vui lòng nhập trường này.',
            'color_type.unique' => 'Màu sản phẩm đã tồn tại.',
            'price.required' => 'Vui lòng nhập trường này.',
            'price_sale.required' => 'Vui lòng nhập trường này.',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'quantity.min' => 'Số lượng phải lớn hơn 0.',
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
        $productVariation->position = $request->position;
        $productVariation->show_hide = $request->show_hide;
        
        $productVariation->update();
        
        return redirect()->route('varia.create',['id' => $productVariation->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $productVariation = ProductVariation::findOrFail($id);
        $product = Product::findOrFail($productVariation->product_id);
        $path = $productVariation->image_path; // Đường dẫn tới file cần xóa trong thư mục 'public'
        if(!Storage::exists('public/'. $path)){
            return redirect()->route('product.create')->with('error','Xóa hình ảnh không thành công!');
        };
        $productVariation->delete();
        return redirect()->route('varia.create',['id' => $product->id])->with('success','Xóa thành công!');
    }
}