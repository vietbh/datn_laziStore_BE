<?php

namespace App\Http\Controllers;


use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'image_url' => 'required',
            'color_type' => 'required',
            'price' => 'required',
            'price_sale' => 'required|lt:price',
            'quantity' => 'required|min:1',
        ],[
            'image_url.required' => 'Không được bỏ trống trường này.',
            'color_type.required' => 'Không được bỏ trống trường này.',
            'price.required' => 'Không được bỏ trống trường này.',
            'price_sale.required' => 'Không được bỏ trống trường này.',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'quantity.required' => 'Không được bỏ trống trường này.',
            'quantity.min' => 'Không tồn tại số lượng 0.',
        ]);

        $file = $request->file('image_url'); // Lấy file từ request    
        if ($file) {
            // Tiếp tục xử lý hoặc trả về đường dẫn đã lưu
            $path = $file->store('images_product', 'public'); // Lưu file vào thư mục 'folder_name'
            $url = asset(Storage::url($path));
        }
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $productVariation = ProductVariation::findOrFail($id);
        $request->validate([
            'color_type' => 'required',
            'price' => 'required',
            'price_sale' => 'required|lt:price',
            'quantity' => 'required|min:1',
        ],[
            'color_type.required' => 'Không được bỏ trống trường này.',
            'price.required' => 'Không được bỏ trống trường này.',
            'price_sale.required' => 'Không được bỏ trống trường này.',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'quantity.required' => 'Không được bỏ trống trường này.',
            'quantity.min' => 'Không tồn tại số lượng 0.',
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
        $productVariation->save();
        
        return redirect()->route('product.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
