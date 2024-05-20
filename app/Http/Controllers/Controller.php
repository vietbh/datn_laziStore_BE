<?php

namespace App\Http\Controllers;

use App\Models\CategoriesProduct;
use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\SlideAds;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected const PAYMENT_STATUS_PRENDING = 'pending';
    protected const PAYMENT_STATUS_PROCESS = 'in_process';
    protected const PAYMENT_STATUS_CANCEL = 'cancel';
    protected const PAYMENT_STATUS_COMPLETED = 'completed';
    private $discount;
    private $slideAds;
    public function __construct(Discount $discount, SlideAds $slideAds) {

        $this->discount = $discount;
        $this->slideAds = $slideAds;
        foreach ($this->discount->get() as $value) {
            if($value->discount_now){
                # code...
                if (Carbon::parse($value->start_date,'Asia/Ho_Chi_Minh')->diff(Carbon::now('Asia/Ho_Chi_Minh'))->invert !== 0 ) {
                    $value->discount_status = false;
                }else{
                    $value->discount_status = true;
                }
                if (Carbon::parse($value->end_date,'Asia/Ho_Chi_Minh')->diff(Carbon::now('Asia/Ho_Chi_Minh'))->invert === 0) {
                    $value->discount_status = false;
                    $value->discount_now = false;
                }
                $value->save();
            }

        }
        foreach ($this->slideAds->get() as $slide) {
            if($slide->slide_now){
                if ( Carbon::parse($slide->start_date,'Asia/Ho_Chi_Minh')->diff(Carbon::now('Asia/Ho_Chi_Minh'))->invert !== 0 ) {
                    $slide->slide_status = false;
                }else{
                    $slide->slide_status = true;

                }
                if (Carbon::parse($slide->end_date,'Asia/Ho_Chi_Minh')->diff(Carbon::now('Asia/Ho_Chi_Minh'))->invert === 0 ) {
                    $slide->slide_status = false;
                    $slide->slide_now = false;
                }
                $slide->save();
            }
        }
    }
    protected function getProductsByCategory($category, string $orderBy = null, int $perPage = 12)
    {
        $categoryIds = $this->getCategoryIds($category);

        // Kiểm tra xem có sản phẩm nào chứa ID danh mục con trong toàn bộ danh mục con
        $productQuery = ProductVariation::query();
        
        $productQuery->orWhereHas('product', function ($query) use ($categoryIds) {
            $query->where('show_hide', true);
            $query->whereIn('categories_product_id', $categoryIds);
        });
        if (!empty($orderBy)) {
            if ($orderBy === 'asc') {
                $productQuery->orderBy('product_variations.price_sale', 'asc');
            } elseif ($orderBy === 'desc') {
                $productQuery->orderBy('product_variations.price_sale', 'desc');
            }
        } else {
            $productQuery->orderByDesc('id');
        }
        $productQuery->orderBy('price_sale');
        $productQuery->with('product')->orderBy('position');
        $products = $productQuery->paginate($perPage);

        return $products;
    }

    // protected function formatPaginatedProducts($products)
    // {
    //     $formattedProducts = $products->getCollection()->transform(function ($item) {
    //         // Lấy 1 variation đầu tiên của sản phẩm
    //         $variation = $item->variations->first();

    //         $item->variation_id = $variation->id;
    //         $item->image_url = $variation->image_url;
    //         $item->color_type = $variation->color_type;
    //         $item->price = $variation->price;
    //         $item->price_sale = $variation->price_sale;
    //         // Thêm các thông tin variation khác ở đây

    //         return $item;
    //     });

    //     return [
    //         'data' => $formattedProducts,
    //         'meta' => [
    //             'current_page' => $products->currentPage(),
    //             'from' => $products->firstItem(),
    //             'to' => $products->lastItem(),
    //             'per_page' => $products->perPage(),
    //             'total' => $products->total(),
    //             'last_page' => $products->lastPage(),
    //             'order_by' => request()->input('orderBy', 'desc'),
    //         ],
    //     ];
    // }
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
