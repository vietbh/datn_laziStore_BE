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
        $products = Product::orderByDesc('id')->paginate(10);
        $categories = CategoriesProduct::all();
        $brands = Brands::all();
        $data = compact('products','categories','brands');
        return view('layouts.admin.Product.index',$data);
    }
    public function create()
    {
        $categories = CategoriesProduct::where('show_hide',true)->get();
        $brands = Brands::where('show_hide',true)->get();
        $data = compact('categories','brands');
        return view('layouts.admin.Product.edit',$data);
    }

    public function store(Request $request, Product $product , ProductVariation $productVariation)
    {
        $request->validate([
            'name' => 'required|unique:'.Product::class,
            'seo_keywords' => 'required|unique:'.Product::class,
            'categories_product_id' => 'required',
            'brand_id' => 'required',
        ],[
            'name.required' => 'Không được bỏ trống trường này.',
            'name.unique' => 'Đã tồn tại tên sản phẩm này.',
            'seo_keywords.required' => 'Không được bỏ trống trường này.',
            'seo_keywords.unique' => 'Đã tồn tại từ khóa SEO này.',
            'categories_product_id.required' => 'Không được bỏ trống trường này.',
            'brand_id.required' => 'Không được bỏ trống trường này.',
        ]);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->seo_keywords = $request->seo_keywords;
        $product->categories_product_id = $request->categories_product_id;
        $product->brand_id = $request->brand_id;
        $product->description = $request->description;
        $product->product_type_hot = $request->type_hot == 'on' ? true : false ;
        $product->product_type_new = $request->type_new == 'on' ? true : false;
        $product->show_hide = $request->show_hide;
        $product->save();
        return redirect()->route('varia.create',['id' => $product->id]);
    }
    public function uploadCk(Request $request){
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
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:'.Product::class.',name,'.$id,
            'seo_keywords' => 'required|unique:'.Product::class.',name,'.$id,
            'categories_product_id' => 'required',
            'brand_id' => 'required',
        ],[
            'name.required' => 'Không được bỏ trống trường này.',
            'name.unique' => 'Đã tồn tại tên sản phẩm này.',
            'seo_keywords.required' => 'Không được bỏ trống trường này.',
            'seo_keywords.unique' => 'Đã tồn tại từ khóa SEO này.',
            'categories_product_id.required' => 'Không được bỏ trống trường này.',
            'brand_id.required' => 'Không được bỏ trống trường này.',
        ]);
  
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->seo_keywords = $request->seo_keywords;
        $product->categories_product_id = $request->categories_product_id;
        $product->brand_id = $request->brand_id;
        $product->description = $request->description;
        $product->product_type_hot = $request->type_hot == 'on' ? true : false ;
        $product->product_type_new = $request->type_new == 'on' ? true : false ;
        $product->show_hide = $request->show_hide;
        $product->update();
        // 
        return redirect()->route('product.index')
        ->with('success','Cập nhật sản phẩm thành công')
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::findOrFail($id);
        foreach ($product->variations() as $variation) {
            $path = $variation->image_path; // Đường dẫn tới file cần xóa trong thư mục 'public'
            if(!Storage::exists('public/'. $path)){
                return redirect()->route('product.index')->with('error','Xóa hình ảnh không thành công!');
            };
        }
        if($product->variations()){
            $product->variations()->delete();
        }
        if($product->specifications()){
            $product->specifications()->delete();
        }
        $product->delete();
        return redirect()->route('product.index')->with('success','Xóa sản phẩm thành công!');
    }
}
