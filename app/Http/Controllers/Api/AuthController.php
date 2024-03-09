<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        if(User::where('email', $request->email)->first()){
            $user = User::where('email', $request->email)->first();
        }else if(User::where('name', $request->email)->first()){
            $user = User::where('name', $request->email)->first();
        }
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'login' => ['Tài khoản không tồn tại.'],
            ]);
        }
        $data = [
           ['id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'image_url' => $user->image_url
            ]
        ];
        return response()->json($data);
     
        // return $user->createToken($request->device_name)->plainTextToken;       
    }
   
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed',Rules\Password::defaults()],
        ],[
            'name.required' =>'Vui lòng không bỏ trống trường này.',
            'name.unique' =>'Đã tồn tại tên này.',
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
            'remember_token' => Str::random(10),
        ]);

        // event(new Registered($user));

        Auth::login($user);
        $data = array(
            ['id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'image_url' => $user->image_url
            ]);
        return response()->json($data);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
