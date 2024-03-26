<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoriesProduct;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class CategoryProController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = CategoriesProduct::where([['id','!=',1],['show_hide',true]])->orderBy('position')->get();
        return response()->json($categories, 200);
    }

    // public function show(string $slug)
    // {
    //     // Tìm kiếm danh mục theo slug và eager loading danh mục cha
    //     $category = CategoriesProduct::with('parent')->where([
    //         ['id', '!=', 1],
    //         ['show_hide', true],
    //         ['slug', $slug]
    //     ])->first();
    
    //     if (!$category) {
    //         return response()->json(['error' => 'Danh mục không tồn tại'], 404);
    //     }
    
    //     // Lấy danh sách danh mục con
    //     $subcategories = CategoriesProduct::where('parent_category_id', $category->id)->get();
    //     $productIds = $subcategories->pluck('id')->toArray();
    //     $productIds[] = $category->id;
        
    //     $productQuery = ProductVariation::query();
    
    //     foreach ($productIds as $categoryId) {
    //         $productQuery->orWhereHas('product', function ($query) use ($categoryId) {
    //             $query->where([
    //                 ['show_hide', true],
    //                 ['categories_product_id', $categoryId]
    //             ]);
    //         });
    //     }
    //     $products = $productQuery->with('product')->orderBy('position')->paginate(8);
    //     return response()->json(['category' => $category, 'subcategories' => $subcategories, 'products' => $products], 200);
    // }
    
    public function show(string $slug)
    {
        // Tìm kiếm danh mục bằng slug
        $category = CategoriesProduct::where('slug', $slug)->first();

        if (!$category) {
            return response()->json(['error' => 'Danh mục không tồn tại'], 404);
        }

        $subcategories = CategoriesProduct::where('parent_category_id',$category->id)->get();
        // Kiểm tra xem có sản phẩm nào chứa ID danh mục con trong toàn bộ danh mục con
        $products = $this->getProductsByCategory($category);

        return response()->json(['category' => $category, 'subcategories' => $subcategories, 'products' => $products], 200);
    }


}
