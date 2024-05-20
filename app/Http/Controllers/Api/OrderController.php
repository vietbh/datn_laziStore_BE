<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index(Request $request){
        // $user = auth()->user()->getAuthIdentifier();

        $data = $request->only(['user']);
        $orders = Orders::where('user_id',$data['user'])->get();
        $result = [];

        foreach ($orders as $order) {
            # code...
            $result[] = [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'full_name' => $order->full_name,
                'address' => $order->address,
                'phone_number' => $order->phone_number,
                'count_items' => $order->count_items,
                'order_total' => $order->total,
                'payment_status'=>$order->payment->status,
                'time_create' => $order->time_create,
                'date_create' => $order->date_create,
            ];
        }
        if(empty($result)){
            return response()->json(array('message'=>'Không có đơn hàng nào'));
        }
        return response()->json(array('message'=>'Thành công','data'=>$result));
    }
    public function show(Request $request){
        // $user = auth()->user()->getAuthIdentifier();

        $data = $request->only(['order_id']);
        $order = Orders::find($data['order_id']);
        $result = [];

        foreach ($order->orderItems as $orderItem) {
            # code...
            $result[] = [
                'order_number' => $order->order_number,
                'full_name' => $order->full_name,
                'address' => $order->address,
                'phone_number' => $order->phone_number,
                'payment_status'=>$order->payment->status,
                'time_create' => $order->time_create,
                'date_create' => $order->date_create,
                'order_items' => [
                    'product_name'=> $orderItem->productVariation->product->name,
                    'color_type' => $orderItem->productVariation->color_type,
                    'image_url' => $orderItem->productVariation->image_url,
                    'quantity' => $orderItem->quantity,
                    'price' => $orderItem->price,
                    'amount' => $orderItem->amount
                ]
            ];
        }
        if(empty($result)){
            return response()->json(array('message'=>'Không có item nào'));
        }
        return response()->json(array('message'=>'Thành công','data'=>$result));
    }

    // public function update(Request $request){
    //     $data = $request->only('order_id');

    // }

}
