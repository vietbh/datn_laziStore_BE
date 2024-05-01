<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $discounts = Discount::paginate(8);
        return view('layouts.admin.Discount.index',compact('discounts'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Discount $discount)
    {
        //
        $request->validate([
            'discount_code' =>'required|unique:'.Discount::class,
            'discount_price' =>'required|min:1',
            'discount_total' =>'required|min:1',
            'start_date' =>'required|date|after_or_equal:today',
            'end_date' =>'required|date|after:start_date',
        ],[
            'discount_code.required' => 'Vui lòng không bỏ trống trường này.',
            'discount_price.required' => 'Vui lòng không bỏ trống trường này.',
            'discount_total.required' => 'Vui lòng không bỏ trống trường này.',
            'start_date.required' => 'Vui lòng không bỏ trống trường này.',
            'start_date.date' => 'Phải là dạng năm-tháng-ngày này.',
            'start_date.after_or_equal' => 'Phải lớn hơn ngày hiện tại.',
            'end_date.required' => 'Vui lòng không bỏ trống trường này.',
            'end_date.after' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu.',
        ]);
        $specialChars = array(
            'ư' => 'u',
            'đ' => 'd',
            'á' => 'a',
            'é' => 'e',
            // Thêm các cặp giá trị khác tương ứng với các ký tự đặc biệt cần thay thế
        );
        $discountCode = mb_convert_encoding(trim($request->discount_code), 'ASCII', 'UTF-8');
        $discountCode = strtr($discountCode, $specialChars);
        $code = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $discountCode));
        $discount->discount_code = $code;
        $discount->discount_price = $request->discount_price;
        $discount->discount_total = $request->discount_total;
        $discount->status = $request->discount_status == 'on' ? true : false;
        $discount->start_date = Carbon::parse($request->start_date)->toDateTimeString();
        $discount->end_date = Carbon::parse($request->end_date)->toDateTimeString();
        $discount->save();
        return redirect()->route('discount.index')->with('success','Thêm mã giảm giá thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $discount = Discount::findOrFail($id);
        $discounts = Discount::all();
        return view('layouts.admin.Discount.index',compact('discount','discounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $discount = Discount::findOrFail($id);
        $request->validate([
            'discount_code' =>'required|unique:'.Discount::class.',discount_code,'.$id,
            'discount_price' =>'required|min:1',
            'discount_total' =>'required|min:1',
            'start_date' =>'required|date|after_or_equal:today',
            'end_date' =>'required|date|after:start_date',

        ],[
            'discount_code.required' => 'Vui lòng không bỏ trống trường này.',
            'discount_price.required' => 'Vui lòng không bỏ trống trường này.',
            'discount_total.required' => 'Vui lòng không bỏ trống trường này.',
            'start_date.required' => 'Vui lòng không bỏ trống trường này.',
            'start_date.date' => 'Phải là dạng năm-tháng-ngày này.',
            'start_date.after_or_equal' => 'Phải lớn hơn ngày hiện tại.',
            'end_date.required' => 'Vui lòng không bỏ trống trường này.',
            'end_date.after' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu.',
        ]);
        $specialChars = array(
            'ư' => 'u',
            'đ' => 'd',
            'á' => 'a',
            'é' => 'e',
            // Thêm các cặp giá trị khác tương ứng với các ký tự đặc biệt cần thay thế
        );
        $discountCode = mb_convert_encoding(trim($request->discount_code), 'ASCII', 'UTF-8');
        $discountCode = strtr($discountCode, $specialChars);
        $code = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $discountCode));
        $discount->discount_code = $code;
        $discount->discount_price = $request->discount_price;
        $discount->discount_total = $request->discount_total;
        $discount->status = $request->discount_status == 'on' ? true : false;
        $discount->start_date = Carbon::parse($request->start_date)->toDateTimeString();
        $discount->end_date = Carbon::parse($request->end_date)->toDateTimeString();
        $discount->update();
        return redirect()->route('discount.index')->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $discount = Discount::findOrFail($id);
        $discount->delete();
        return redirect()->route('discount.index')->with('success','Xóa thành công');
    }
}
