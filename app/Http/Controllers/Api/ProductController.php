<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoriesProduct;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\SlideAds;
use App\Models\SpecificationsProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function show(string $slug)
    {
        $products = ProductVariation::query()
        ->whereHas('product', function ($query) use ($slug) {
            $query->where('slug', $slug)
                  ->where('show_hide', true);
        })
        ->where('show_hide', true)
        ->orderBy('price_sale')
        ->get();

        $product = Product::find($products->first()->product()->first()->id);
        if(isset($product->category->parent->slug)){
            $category = CategoriesProduct::where([['show_hide',true],['slug',$product->category->parent->slug]])->first();
        }else{
            $category = CategoriesProduct::where([['show_hide',true],['slug',$product->category->slug]])->first();
        }
        if(empty($category)){
            return response()->json(array());
        }
        //Danh mục 
        if (!$category) {
            return response()->json(['error' => 'Danh mục không tồn tại'], 404);
        }

        $subcategories = CategoriesProduct::where('parent_category_id',$category->id)->first();
        // Sản phẩm liên quan
        $productRela = $this->getProductsByCategory($category);

        $speci = SpecificationsProduct::where([['product_id',$product->id],['show_hide',true]])->orderBy('position')->get();
        return response()->json([
            'variation' => $products,
            'product' => $product,
            'speci'=>$speci,
            'productRela' => $productRela,
            'category' => $category,
            'subcategories' =>  $subcategories
        ]);
    }

    public function hot()
    {
        //
        $productQuery = ProductVariation::query();
        $productQuery->whereHas('product', function($query){
            $query->where([['product_type_hot',true],['show_hide',true]])
            ->orderBy('position');
        });
        $products = $productQuery->where([['show_hide',true]])->orderBy('position')->with('product')->limit(8)->get();
        return response()->json($products);
    }
    public function new()
    {
        //
        $productQuery = ProductVariation::query();
        $productQuery->whereHas('product', function($query){
            $query->where([['product_type_new',true],['show_hide',true]]);
        });
        $products = $productQuery->where([['show_hide',true]])->orderBy('position')->with('product')->limit(8)->get();
        return response()->json($products);
    }
    public function laptop()
    {
        //
        $category = CategoriesProduct::where([['show_hide',true],['slug','laptop']])->first();
        if(empty($category)){
            return response()->json(array());
        }
        $products = $this->getProductsByCategory($category);
        return response()->json($products);
    }
    public function tablet()
    {
        //
        $category = CategoriesProduct::where([['show_hide',true],['slug','tablet']])->first();
        if(empty($category)){
            return response()->json(array());
        }
        $products = $this->getProductsByCategory($category);
        return response()->json($products);
    }
    public function pc()
    {
        //
        $category = CategoriesProduct::where([['show_hide',true],['slug','pc']])->first();
        if(empty($category)){
            return response()->json(array());
        }
        $products = $this->getProductsByCategory($category);
        return response()->json($products);
    }
    public function watch()
    {
        //
        $category = CategoriesProduct::where([['show_hide',true],['slug','dong-ho']])->first();
        if(empty($category)){
            return response()->json(array());
        }
        $products = $this->getProductsByCategory($category);
        return response()->json($products);
    }
    public function audio()
    {
        //
        $category = CategoriesProduct::where([['show_hide',true],['slug','am-thanh']])->first();
        if(empty($category)){
            return response()->json(array());
        }
        $products = $this->getProductsByCategory($category);
        return response()->json($products);
    }
    public function banner(){
        $banners = SlideAds::where('show_hide',1)->orderBy('position')->get();
        return response()->json(['banners'=>$banners]);
    }
  
}
