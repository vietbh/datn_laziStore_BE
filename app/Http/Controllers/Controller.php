<?php

namespace App\Http\Controllers;

use App\Models\CategoriesProduct;
use App\Models\ProductVariation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected function getProductsByCategory($category)
    {
        $categoryIds = $this->getCategoryIds($category);

        // Kiểm tra xem có sản phẩm nào chứa ID danh mục con trong toàn bộ danh mục con
        $productQuery = ProductVariation::query();
        
        $productQuery->orWhereHas('product', function ($query) use ($categoryIds) {
            $query->where('show_hide', true);
            $query->whereIn('categories_product_id', $categoryIds);
        });
        $productQuery->orderBy('price_sale');
        $productQuery->with('product')->orderBy('position');
        $products = $productQuery->paginate(12);

        return $products;
    }

    protected function getCategoryIds($category)
    {
        $categoryIds = [$category->id];

        // Lấy danh sách ID danh mục con đệ quy
        $subcategoryIds = $this->getSubcategoryIds($category->id);

        $categoryIds = array_merge($categoryIds, $subcategoryIds);

        return $categoryIds;
    }

    protected function getSubcategoryIds($categoryId)
    {
        $subcategoryIds = [];

        $subcategories = CategoriesProduct::where('parent_category_id', $categoryId)->get();

        foreach ($subcategories as $subcategory) {
            $subcategoryIds[] = $subcategory->id;

            $subcategoryIds = array_merge($subcategoryIds, $this->getSubcategoryIds($subcategory->id));
        }

        return $subcategoryIds;
    }
}
