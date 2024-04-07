<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function store(Request $request){
        $user = $request->user;
        $data = $request->data;
        $cart = Cart::find($user['cart_id']);
        return response()->json($cart);
    }   
}
