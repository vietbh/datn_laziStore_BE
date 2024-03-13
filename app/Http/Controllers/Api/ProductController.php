<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $variations = [];
        foreach ($products as $product) {
            foreach ($product->variations()->get() as $variation) {
                array_push($variations, $variation);
            }
        }
        
        $data = [
            'products' => $products,
            'variations' => $variations
        ];
        
        return response()->json($data);
    }

    public function show(string $id)
    {
        //
        $products = Product::with('variations')->paginate(10);
    
        return response()->json($products);
    }

    // public function loadMore(Request $request)
    // {
    //     $offset = $request->input('offset');
    //     $products = Product::skip($offset)->take(10)->get();

    //     return response()->json($products);
    // }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    }
}
