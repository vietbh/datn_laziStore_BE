<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\OrderItems;
use App\Models\Orders;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentController extends Controller
{
    //
    
    public function store(Request $request){
        $order = $this->createOrder($request);
        $paymentNumber = $this->generatePaymentNumber();
        $payment = Payment::create([
            'payment_number' => $paymentNumber,
            'payment_method' => 'cod',
            'payment_status' => Controller::PAYMENT_STATUS_PRENDING,
            'order_id' => $order->id,
            'count_items' => $order->count_items,
            'amount' => $order->amount,
            'total' => $order->total,
            'user_id' => $order->user_id,
            'date_create' => date('Y-m-d', time()),
            'time_create' => Carbon::now(new \DateTimeZone("Asia/Ho_Chi_Minh"))->format('H:i:s'),
        ]);
        return response()->json(['payment' => $payment],200);
    }
    protected function generateOrderNumber()
    {
        $orderNumber = 'DH-';
        $order = Orders::orderByDesc('id')->first();

        if(isset($order)){
            $orderNumber .= 'AN'.++$order->id.'-'; // Thêm thông tin id vào mã đơn hàng
        }else{
            $orderNumber .= 'ST-'; // Thêm thông tin id vào mã đơn hàng
        }
        $orderNumber .= Str::random(6); // Tiền tố "DH-" và 6 ký tự ngẫu nhiên

        $formattedTimestamp = Carbon::now(new \DateTimeZone("Asia/Ho_Chi_Minh"))->format('YmdHis'); // Định dạng thời gian: năm, tháng, ngày, giờ, phút, giây

        $orderNumber .= $formattedTimestamp; // Thêm thông tin thời gian vào mã đơn hàng

        return $orderNumber;
    } 
    protected function generatePaymentNumber()
    {
        $paymentNumber = 'PM-';
        $order = Orders::orderByDesc('id')->first();

        if(isset($order)){
            $paymentNumber .= 'AN'.$order->id.'-'; // Thêm thông tin id vào mã đơn hàng
        }
        $paymentNumber .= Str::random(6);

        $formattedTimestamp = Carbon::now(new \DateTimeZone("Asia/Ho_Chi_Minh"))->format('YmdHis');; // Định dạng thời gian: năm, tháng, ngày, giờ, phút, giây

        $paymentNumber .= $formattedTimestamp; // Thêm thông tin thời gian vào mã đơn hàng

        return $paymentNumber;
    } 
    protected function createOrder($request){
        $user = $request->user;
        $data = $request->data;
        $cart = Cart::find($user['cart_id']);
        $orderNumber = $this->generateOrderNumber();
        $order = Orders::create([
            'order_number' => $orderNumber,
            'full_name' => $data['full_name'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'note' => $data['note'],
            'user_id' => $cart['user_id'],
            'date_create' => date('Y-m-d', time()),
            'time_create' => Carbon::now(new \DateTimeZone("Asia/Ho_Chi_Minh"))->format('H:i:s'),
        ]);
        
        if(isset($order->id)){
            foreach ($cart->cartItems()->get() as $cartItem) {
                OrderItems::create([
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' =>  $cartItem->productVariation->price_sale,
                    'amount' => $cartItem->productVariation->price_sale * $cartItem->quantity,
                    'order_id' => $order->id,
                ]);
            }
        }
        $order->amount = $order->amountItems;
        $order->count_items = $order->countItems;
        $order->total = $order->totalItems;
        $order->update();
        // $cart->cartItems()->delete();
        return $order;
    }

    public function handleVnPay(Request $request){
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
        $vnp_TmnCode = strval(env('VN_PAYMENT_TMNCODE')) ;//Mã website tại VNPAY 
        $vnp_HashSecret = strval(env('VN_PAYMENT_HASHSECRET')) ; //Chuỗi bí mật
        
        $vnp_TxnRef = "DH-123456789"; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 

        $vnp_OrderInfo = "Thanh toán đơn hàng";
        $vnp_OrderType = "Cửa hàng Lazi Store";
        $vnp_Amount = 10000 * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = "127.0.0.1";
      
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }


    public function return(Request $request)
    {
        $url = session('url_prev','/');
        if($request->vnp_ResponseCode == "00") {
            $this->create(session('cost_id'));
            return redirect($url)->with('success' ,'Đã thanh toán phí dịch vụ');
        }
        session()->forget('url_prev');
        return redirect($url)->with('errors' ,'Lỗi trong quá trình thanh toán phí dịch vụ');
    }

    

}