<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoriesProduct;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = ProductVariation::where('show_hide',true)->orderBy('price_sale')->with('product')->paginate(8);
        return response()->json($products);
    }
    // public function index()
    // {
    //     $products = Product::all();
    //     $variations = [];
    
    //     foreach ($products as $product) {
    //         $lowestPrice = PHP_INT_MAX;
    //         $lowestPriceVariation = null;
    
    //         foreach ($product->variations as $variation) {
    //             if ($variation->price_sale < $lowestPrice) {
    //                 $lowestPrice = $variation->price_sale;
    //                 $lowestPriceVariation = $variation;
    //             }
    //         }
    
    //         $variations[$product->id] = $lowestPriceVariation;
    //     }
    
    //     $data = [
    //         'products' => $products,
    //         'variations' => $variations
    //     ];
    
    //     return response()->json($data);
    // }

    public function show(string $slug)
    {
        //
        $product = Product::where('slug',$slug)->with('variations')->first();
        return response()->json($product);
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
        $products = $productQuery->orderBy('position')->with('product')->limit(8)->get();
        return response()->json($products);
    }
    public function laptop()
    {
        //
        $category = CategoriesProduct::where([['show_hide',true],['slug','laptop']])->first();
        $products = $this->getProductsByCategory($category);
        return response()->json($products);
    }
    public function tablet()
    {
        //
        $category = CategoriesProduct::where([['show_hide',true],['slug','tablet']])->first();
        $products = $this->getProductsByCategory($category);
        return response()->json($products);
    }
    public function pc()
    {
        //
        $category = CategoriesProduct::where([['show_hide',true],['slug','pc']])->first();
        $products = $this->getProductsByCategory($category);
        return response()->json($products);
    }
    public function watch()
    {
        //
        $category = CategoriesProduct::where([['show_hide',true],['slug','dong-ho']])->first();
        $products = $this->getProductsByCategory($category);
        return response()->json($products);
    }
    public function audio()
    {
        //
        $category = CategoriesProduct::where([['show_hide',true],['slug','am-thanh']])->first();
        $products = $this->getProductsByCategory($category);
        return response()->json($products);
    }

  
}
