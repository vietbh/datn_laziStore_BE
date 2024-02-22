<?php

namespace App\Http\Controllers\Product;

use App\Models\Brands;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriesProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all();
        $categories = CategoriesProduct::all();
        $brands = Brands::all();
        $data = compact('products','categories','brands');
        return view('layouts.admin.Product.index',$data);
    }

    public function store(Request $request, Product $product, ProductVariation $productVariation)
    {
        $request->validate([
            'name' => 'required|unique:products,name',
            'seo_keywords' => 'required|unique:products,seo_keywords',
            'categories_product_id' => 'required',
            'brand_id' => 'required',
            'color_type' => 'required',
            'price' => 'required',
            'price_sale' => 'required|lt:price',
            'quantity' => 'required|min:1',
        ],[

        ]
    );
    
        $file = $request->file('image_url'); // Lấy file từ request    
        if ($file) {
            // Tiếp tục xử lý hoặc trả về đường dẫn đã lưu
            $path = $file->store('images_product', 'public'); // Lưu file vào thư mục 'folder_name'
            $url = asset(Storage::url($path));
        }
    
        $product->name = $request->name;
        $product->seo_keywords = Str::slug($request->seo_keywords);
        $product->slug = Str::slug($request->name);
        $product->categories_product_id = $request->categories_product_id;
        $product->brand_id = $request->brand_id;
        $product->image_path = $path;
        $product->image_url = $url;
        $product->description = $request->description;
        $product->show_hide = $request->show_hide;
        $product->save();
        $productVariation->color_type = $request->color_type;
        $productVariation->product_id = $product->id;
        $productVariation->price = $request->price*1000;
        $productVariation->price_sale = $request->price_sale*1000;
        $productVariation->quantity = $request->quantity;
        $productVariation->quantity_available = $request->quantity;
        $productVariation->save();

        $jsonString = $request->colors;
        // Chuyển đổi chuỗi JSON thành mảng
        $colors = json_decode($jsonString, true);  
        if (isset($colors)) {
            foreach ($colors as $color) {
                $productVariation = new ProductVariation();
                $productVariation->color_type = $color['color_type'];
                $productVariation->product_id = $product->id;
                $productVariation->price = $color['price']*1000;
                $productVariation->price_sale = $color['price_sale']*1000;
                $productVariation->quantity = $color['quantity'];
                $productVariation->quantity_available = $color['quantity'];
                $productVariation->save();
            }
        }
        return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công');
    }
    public function upload(Request $request){
        if($request->hasFile('upload')){
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' .  $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url'=> $url]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = Product::findOrFail($id);
        $categories = CategoriesProduct::all();
        $brands = Brands::all();
        $data = compact('product','categories','brands');
        return view('layouts.admin.Product.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::findOrFail($id);
        $path = $product->image_path; // Đường dẫn tới file cần xóa trong thư mục 'public'
        if(!Storage::exists('public/'. $path)){
            return redirect()->route('product.index')->with('error','Xóa hình ảnh không thành công!');
        };
        Storage::delete('public/'. $path); // Xóa file
        $product->variations()->delete();
        $product->delete();
        return redirect()->route('product.index')->with('success','Xóa sản phẩm thành công!');

    }
}
