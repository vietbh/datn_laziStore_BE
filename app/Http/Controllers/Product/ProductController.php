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
        $productVariations = ProductVariation::where('product_id',null)->get();
        foreach ($productVariations as $productVariation) {
            $path = $productVariation->image_path; // Đường dẫn tới file cần xóa trong thư mục 'public'
            if($path){
                if(!Storage::exists('public/'. $path)){
                    return redirect()->route('product.index')->with('error','Xóa hình ảnh không thành công!');
                };
                $productVariation->delete();
            }
        }
        return view('layouts.admin.Product.index',$data);
    }
    public function create()
    {
        //
        $categories = CategoriesProduct::where('show_hide',true)->get();
        $brands = Brands::where('show_hide',true)->get();
        $productVariations = ProductVariation::where('product_id',null)->get();
        $data = compact('categories','brands','productVariations');
        return view('layouts.admin.Product.store',$data);
    }

    public function store(Request $request, Product $product , ProductVariation $productVariation)
    {
        $request->validate([
            'name' => 'required|unique:'.Product::class,
            'seo_keywords' => 'required|unique:'.Product::class,
            'categories_product_id' => 'required',
            'brand_id' => 'required',
            'color_type' => 'required',
            'price' => 'required',
            'price_sale' => 'required|lt:price',
            'quantity' => 'required|min:1',
        ],[
            'name.required' => 'Không được bỏ trống trường này.',
            'name.unique' => 'Đã tồn tại tên sản phẩm này.',
            'seo_keywords.required' => 'Không được bỏ trống trường này.',
            'seo_keywords.unique' => 'Đã tồn tại từ khóa SEO này.',
            'categories_product_id.required' => 'Không được bỏ trống trường này.',
            'brand_id.required' => 'Không được bỏ trống trường này.',
            'color_type.required' => 'Không được bỏ trống trường này.',
            'price.required' => 'Không được bỏ trống trường này.',
            'price_sale.required' => 'Không được bỏ trống trường này.',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'quantity.required' => 'Không được bỏ trống trường này.',
            'quantity.min' => 'Không tồn tại số lượng 0.',
        ]
    );
  
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->seo_keywords = Str::slug($request->seo_keywords);
        $product->categories_product_id = $request->categories_product_id;
        $product->brand_id = $request->brand_id;
        $product->description = $request->description;
        $product->show_hide = $request->show_hide;
        $product->save();
        // 
        if($product->id){
            $productVariations = ProductVariation::where('product_id',null)->get();
            if($productVariations){
                foreach ($productVariations as $productVariation) {
                    $productVariation->product_id = $product->id;
                    $productVariation->update();
                }
            }
        }

        // $jsonString = $request->colors;
        // // Chuyển đổi chuỗi JSON thành mảng
        // $colors = json_decode($jsonString, true);  
        // if (isset($colors)) {
        //     foreach ($colors as $color) {
        //       $base64Image = $color['image_url'];
        //         $imageData = base64_decode($base64Image);
        //         $file = uniqid() . '.jpg';

        //         $path = public_path('storage/images_product/' . $file);
        //         file_put_contents($path, $imageData);
        //         $url = asset('images_product/' . $file);    
        //         $productVariation = new ProductVariation();
        //         $productVariation->image_path = $path;
        //         $productVariation->image_url = $url;
        //         $productVariation->color_type = $color['color_type'];
        //         $productVariation->product_id = $product->id;
        //         $productVariation->price = $color['price']*1000;
        //         $productVariation->price_sale = $color['price_sale']*1000;
        //         $productVariation->quantity = $color['quantity'];
        //         $productVariation->quantity_available = $color['quantity'];
        //         $productVariation->save();
        //     }
        // }
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
        // $product->variations()->update(['status'=>'delete by '.auth()->user()->name]);
        // $product->status = 'delete by '.auth()->user()->getAuthIdentifierName();
        // $product->update();
        $product->variations()->delete();
        $product->delete();
        return redirect()->route('product.index')->with('success','Xóa sản phẩm thành công!');
    }
}
