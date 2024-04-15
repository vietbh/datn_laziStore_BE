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