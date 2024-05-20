<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index($id){
        // take pro
        $cart = Cart::findOrNew($id);
        // if($cart)
        if(empty($cart)){
            return response()->json(204);
        }
        $cartItems = $cart->cartItems;
        $products = array();
        foreach ($cartItems as $cartItem) {
            # code...
            $product = ProductVariation::with('product')->where([['show_hide',true],['id',$cartItem->product_id]])->get();
            foreach ($product as $value) {
                # code...
                $product = array_merge_recursive(['product_varia'=>$value,'quantity_item'=>$cartItem->quantity]); 
            }
            array_push($products,$product); 
        }
        return response()->json(['products'=>$products]);
    }
    public function store(Request $request)
    {
        
        // Hiển thị dữ liệu trong request POST    
        // Lưu dữ liệu vào CartsItems
        $cartItemsCheck = CartItems::where([['cart_id',$request->cart],['product_id',$request->product]])->count();
        if($cartItemsCheck > 0){
            $cartItems = CartItems::where([['cart_id',$request->cart],['product_id',$request->product]])->first();
            $cartItems->quantity = ++$cartItems->quantity;
            $cartItems->update(); 
        }else{
            $cartItems = new CartItems();
            $cartItems->cart_id = $request->cart;
            $cartItems->product_id = $request->product;
            $cartItems->save();
        }

        $countItem = CartItems::where('cart_id',$request->cart)->count();
        Cart::where('id',$request->cart)->update(['amount'=>$countItem]);
        // Lấy thông tin sản phẩm và biến thể sản phẩm    
        return response()->json('success',200);
    }
    public function update(Request $request){
        $cart = Cart::find($request->cart);
        $cartItems = $cart->cartItems;
        $cartItem = $cartItems->where('product_id',$request->product)->first();
        switch ($request->type) {
            case 'plus':
                # code...
                $cartItem->quantity = $cartItem->quantity+1;
                $cartItem->update();
                break;
            case 'minus':
                # code...
                $cartItem->quantity = $cartItem->quantity-1;
                $cartItem->update();
                break;
            default:
                $cartItem->quantity = $request->type;
                $cartItem->update();
                break;
        }
        if($cartItem->quantity == 0){
            $cartItem->delete();
        }
        $countItem = CartItems::where('cart_id',$cart->id)->count();
        Cart::where('id',$cart->id)->update(['amount'=>$countItem]);
        return response()->json('success',200);
    }
    public function destroy (Request $request){
        $cart = Cart::find($request->cart);
        $cartItems = $cart->cartItems;
        
        foreach ($cartItems as $cartItem) {
            if($cartItem->product_id == $request->product){
                $cartItem->delete();
            }
        }
        $countItem = CartItems::where('cart_id',$cart->id)->count();
        Cart::where('id',$cart->id)->update(['amount'=>$countItem]);
        return response()->json(200);
    }
}
