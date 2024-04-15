<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Role;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Client\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
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
           'user'=>[
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'image_url' => $user->image_url,
            'remember_token' => $user->remember_token,
            'cart_id' => $user->cart->id,
           ]
        ];
        return response()->json($data);     
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
        $role = Role::where('role_name','guest')->first();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role->id,
            'remember_token' => Str::random(10),
        ]);

        // event(new Registered($user));
        
        // Auth::login($user);
        
        Cart::create([
            'user_id' => $user->id,
            'amount' => 0,
        ]);

        $data = [
            'user'=>[
             'id' => $user->id,
             'name' => $user->name,
             'email' => $user->email,
             'image_url' => $user->image_url,
             'remember_token' => $user->remember_token,
             'cart_id' => $user->cart->id,
            ]
         ];
        return response()->json($data);   
    }

    public function forgotPasswordCreate()
    {
        return response()->json([
            'status' => session('status'),
        ]);
    }
    public function forgotPasswordStore(Request $request): Response
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return response()->back()->with('status', __($status));
        }

        return response()->json([
            'errors' => [
                'email' => [trans($status)],
            ],
        ], 422);
    }
    public function resetPasswordCreate(Request $request)
    {
        return response()->json([
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }
     /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function resetPasswordStore(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status == Password::PASSWORD_RESET) {
            // $user = auth()->user();
            // $data = [
            //     ['id' => $user->id,
            //      'name' => $user->name,
            //      'email' => $user->email,
            //      'image_url' => $user->image_url
            //      ]
            //  ];
            return response()->json(200)->with('status', __($status));
        }

        return response()->json(throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]));
    }

    
}