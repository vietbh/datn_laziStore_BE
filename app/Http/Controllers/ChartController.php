<?php

namespace App\Http\Controllers;

use App\Models\CategoriesProduct;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        $orders = Orders::orderByDesc('id')->get();
        $data = compact('orders');
        return view('layouts.admin.Chart.index',$data);
    }
    // 
    public function dataChart():JsonResponse
    {   
        $data = $this->getCategoryCounts();
       
        return response()->json($data,200);
    }
    function getCategoryCounts($parentId = null) {
        $categories = CategoriesProduct::select('id', 'name')
            ->where('parent_category_id', $parentId)
            ->get();
            
        $result = [];
        
        foreach ($categories as $category) {
            $subcategories = collect($this->getCategoryCounts($category->id)) ;
            
            $subcategoryCounts = $subcategories->sum('_value');
            
            $categoryCount = Product::where('categories_product_id', $category->id)->count();
            
            $totalCount = $subcategoryCounts + $categoryCount;
            
            $result[] = [
                '_id' => $category->name,
                '_value' => $totalCount
            ];
        }
        
        return $result;
    }
}
