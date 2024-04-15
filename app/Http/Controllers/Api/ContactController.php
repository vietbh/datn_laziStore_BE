<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function create(Request $request){
        $token = $request->user()->createToken($request->token_name);
     
        return ['token' => $token->plainTextToken];
    }
    public function store(Request $request){
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|numeric|max:10',
            'title' => 'required|string',
        ],[
            'full_name.required' => 'Vui lòng nhập họ và tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'phone_number.required' => 'Vui lòng nhập số điện thoại',
            'phone_number.numeric' => 'Vui lòng nhập dạng số',
            'phone_number.max' => 'Vui lòng nhập tối đa 10 số',
            'title.required' => 'Vui lòng nhập tiêu đề',
        ]);

        return response()->json($request);
    }
}