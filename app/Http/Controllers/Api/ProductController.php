<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoriesProduct;
use App\Models\CommentProduct;
use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\SlideAds;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function show(string $slug)
    {

        $product = Product::where([['show_hide',true],['slug',$slug]])->first();

        if(empty($product)){
            return response()->json(array('message'=>'Không tìm tồn tại sản phẩm này'));
        }

        $categoryRela = CategoriesProduct::where('show_hide',true)->find($product->category->parent->parent->id ?? $product->category->parent->id);

        $productRelative = Product::where('show_hide',true)
        ->whereIn('categories_product_id',$this->getCategoryIds($categoryRela))
        ->get();
        
        $result = [];
        
        $result['product'] = array(
            'name' => $product->name,
            'slug' => $product->slug,
            'description' => $product->description,
            'category' =>$product->category->name,
            'sub_category' => [
                [
                    'name' => $product->category->parent->parent->name ?? null,
                    'slug' => $product->category->parent->parent->slug ?? null,
                ],
                [
                    'name' => $product->category->parent->name ?? null,
                    'slug' => $product->category->parent->slug ?? null,
                ],
            ],
            
        );

        foreach ($productRelative as $productRela) {
            # code...
            $productRelatives[] = [
                'id' => $productRela->id,
                'name' => $productRela->name,
                'slug' => $productRela->slug,
                'product_hot' => $productRela->product_type_hot ? true : false,
                'product_new' => $productRela->product_type_new ? true : false,
                'image_url' => $productRela->variations()->first()->image_url,
                'color_type' => $productRela->variations()->first()->color_type,
                'price' => $productRela->variations()->first()->price,
                'price_sale' => $productRela->variations()->first()->price_sale,
            ];
            $result['productRelative'] = $productRelatives;
        }

        foreach ($product->variations as $variation) {
            # code...
            $variations[] = [
                'id' => $variation->id,
                'color_type' => $variation->color_type,
                'image_url' => $variation->image_url,
                'price' => $variation->price_sale == 0 ? $variation->price : $variation->price_sale,
                'quantity' => $variation->quantity
            ];
            $result['product']['variations'] = $variations;
        }
        if(!empty($product->specifications)){
            foreach ($product->specifications as $specification) {
                # code...
                if($specification->show_hide){
                    $specifications[] = [
                        'key' => $specification->speci->name,
                        'value' => $specification->value,
                    ];

                }
                $result['product']['specifications'] = $specifications;
            }
        }

        return response()->json(array(
            'message' => 'Thành công',
            'data' => $result
        ));
        
    }

    // public function hot()
    // {
    //     //
    //     $productsHot = ProductVariation::query()->whereHas('product', function($query){
    //         $query->select('id','name','slug')->where([['product_type_hot',true],['show_hide',true]])
    //         ->orderBy('position');
    //     })->where([['show_hide',true]])->orderBy('position')->with('product')->limit(8)->get();
        

    //     $productsNew = ProductVariation::query()->whereHas('product', function($query){
    //         $query->where([['product_type_new',true],['show_hide',true]]);
    //     })->where([['show_hide',true]])->orderBy('position')->with('product')->limit(8)->get();

    //     $categoryLaptop = CategoriesProduct::where([['show_hide',true],['slug','laptop']])->first();
    //     if(!empty($categoryLaptop)){
    //         $productsLaptop = $this->getProductsByCategory($categoryLaptop);
    //     }else{
    //         $productsLaptop = [];
    //     }

    //     $categoryTablet = CategoriesProduct::where([['show_hide',true],['slug','tablet']])->first();
    //     if(!empty($categoryTablet)){
    //         $productsTablet = $this->getProductsByCategory($categoryTablet);
    //     }else{
    //         $productsTablet = [];
    //     }

    //     $categoryPC = CategoriesProduct::where([['show_hide',true],['slug','pc']])->first();
    //     if(!empty($categoryPC)){
    //         $productsPC = $this->getProductsByCategory($categoryPC);
    //     }else{
    //         $productsPC = [];
    //     }

    //     $categoryWatch = CategoriesProduct::where([['show_hide',true],['slug','dong-ho']])->first();
    //     if(!empty($categoryWatch)){
    //         $productsWatch = $this->getProductsByCategory($categoryWatch);
    //     }else{
    //         $productsWatch = [];
    //     }

    //     $categoryAudio = CategoriesProduct::where([['show_hide',true],['slug','am-thanh']])->first();
    //     if(!empty($categoryAudio)){
    //         $productsAudio = $this->getProductsByCategory($categoryAudio);
    //     }else{
    //         $productsAudio = [];
    //     }

    //     $data['data'] = [
    //         'productHot' => $productsHot ?? [],
    //         'productNew' => $productsNew ?? [],
    //         'productLaptop' => $productsLaptop ?? [],
    //         'productTablet' => $productsTablet ?? [],
    //         'productPC' => $productsPC ?? [],
    //         'productWatch' => $productsWatch ?? [],
    //         'productAudio' => $productsAudio ?? [],
    //     ];

    //     return response()->json($data);
    // }
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

    public function handleSearch(Request $request)
    {
        $keySearch = Str::replace(" ",'',Str::lower($request->query('search')));
   
        $keySlug = Str::slug(Str::lower($request->query('search')));
        $query = Product::query()
            ->join('product_variations', 'products.id', '=', 'product_variations.product_id')
            ->leftJoin('categories_products as categories_products', 'categories_products.id', '=', 'products.categories_product_id')
            // ->joinSub('categories_products','parent', 'parent.id', '=', 'categories_products.parent_category_id')
            // ->joinSub('parent', 'top', 'top.id', '=', 'parent.parent_category_id')
            ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
            ->orWhereAny(['products.slug','brands.slug','categories_products.slug'], 'LIKE', '%' . $keySlug . '%')
            ->orWhereAny(['products.name','brands.name','categories_products.name'], 'LIKE', '%' . $keySearch . '%')
            ->select(
                'products.id', 
                'products.name', 
                'products.slug', 
                'products.brand_id', 
                'brands.name as brand_name',
                'categories_products.name as category_name')
            ->groupBy('products.id')    
            ->get();
        // dump($query);
        $result = [];

        foreach ($query as $product) {
            $result[] = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'brand' => $product->brand_name,
                'category' => $product->category_name,
                'product_hot' => $product->product_type_hot ? true : false,
                'product_new' => $product->product_type_new ? true : false,
                'image_url' => $product->variations()->first()->image_url,
                'color_type' => $product->variations()->first()->color_type,
                'price' => $product->variations()->first()->price,
                'price_sale' => $product->variations()->first()->price_sale,                
            ];
        }

        if (empty($result)) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm nào']);
        }

        return response()->json(['data' => $result]);
    }
    public function comment(Request $request){
        // $user = $request->only('user');
        $data = $request->only('productId');
        $comments = CommentProduct::where('product_id',$data)->get();
        return response()->json(['data'=>$comments]);
    } 
    public function handleComment(Request $request){
        $data = $request->only('comment','userId','productId');
        CommentProduct::create([
            'comment' => $data['comment'],
            'user_id' => $data['userId'],
            'product_id' => $data['productId']
        ]);
        $comments = CommentProduct::where([
            ['product_id',$data['productId']],
            ['user_id',$data['userId']]
        ])->get();
        return response()->json(['data'=>$comments]);
    } 
    public function discount(){
        // $data = $request->only('')
        $discounts = Discount::select(
            'id',
            'discount_code',
            'discount_status',
            'discount_price',
            'discount_total',
            'start_date',
            'end_date',
            )->where([
            ['discount_now',true],
            ['show_hide',true]
        ])->get();
        return response()->json(['data'=> $discounts]);
    }
}
