<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            // 'device_name' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Tài khoản không tồn tại.'],
            ]);
        }
        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ];
        return response()->json($data);
     
        // return $user->createToken($request->device_name)->plainTextToken;       
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed',Rules\Password::defaults()],
        ],[
            'name.required' =>'Vui lòng không bỏ trống trường này.',
            'email.required' =>'Vui lòng không bỏ trống trường này.',
            'email.lowercase' =>'Vui lòng không viết hoa trường này.',
            'email.email' =>'Vui lòng nhập đúng định dạng email.',
            'email.unique' =>'Đã tồn tại email này.',
            'password.required' =>'Vui lòng không bỏ trống trường này.',
            'password.confirmed' =>'Mật khẩu xác nhận chưa chính xác.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // event(new Registered($user));

        // Auth::login($user);
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

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
