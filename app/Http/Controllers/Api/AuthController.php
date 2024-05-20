<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ForgotPassRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Api\UserUpdatePasswordRequest;
use App\Jobs\SendEmailForgotPass;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request){
        
        $request->validate([
            'name' => 'nullable|string|',
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $request->only('name', 'email', 'password');
        if (User::where('email', $request->email)->first()) {
            $user = User::where('email', $request->email)->first();
        }
        if (User::where('name', $request->name)->first()) {
            $user = User::where('name', $request->name)->first();
        }
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['login' => 'Tài khoản không tồn tại.'],401);
        }
        $token_user = $user->createToken($user->email)->plainTextToken;       
        $data = [
           'user'=>[
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'image_url' => $user->image_url,
            'remember_token' => $user->remember_token,
            'cart_id' => $user->cart->id,
            'data' => [
                'uid' =>  '-'.$user->id,
                'name' => 'image.png',
                'status' => 'done',
                'percent' => 100,
                'url' => $user->image_url ?? 'https://zos.alipayobjects.com/rmsportal/jkjgkEfvpUPVyRjUImniVslZfWPnJuuZ.png',
            ]
           ],
            // 'access_token' => $token_user
        ];
        return response()->json($data);
     
    }


    public function register(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required' => 'Vui lòng không bỏ trống trường này.',
            'name.unique' => 'Đã tồn tại tên này.',
            'email.required' => 'Vui lòng không bỏ trống trường này.',
            'email.lowercase' => 'Vui lòng không viết hoa trường này.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
            'email.unique' => 'Đã tồn tại email này.',
            'password.required' => 'Vui lòng không bỏ trống trường này.',
            'password.confirmed' => 'Mật khẩu xác nhận chưa chính xác.',
        ]);
        $role = Role::where('role_name','guest')->first();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role->id,
            'remember_token' => Str::random(60),
        ]);

        event(new Registered($user));
        
        $user->detailUser()->create([
            'full_name' => $user->name,
        ]);

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
             'data' => [
                'uid' =>  '-'.$user->id,
                'name' => 'image.png',
                'status' => 'done',
                'percent' => 100,
                'url' => $user->image_url ?? 'https://zos.alipayobjects.com/rmsportal/jkjgkEfvpUPVyRjUImniVslZfWPnJuuZ.png',
            ]
            ]
         ];
        return response()->json($data);   
    }
    /**
     *Forgot password
     *
     * @param ForgotPassRequest $request
     * @return  [type]  [return description]
     */
    public function forgotPassword(Request $request): JsonResponse 
    {
        try {
            if ($request->code !== null) {
                $data = $request->only('email', 'code', 'password');
                $user = User::where('email', $data['email'])->first();
    
                if (Session::get('code') !== $data['code']) {
                    return response()->json([
                        'message' => 'Mã code không chính xác',Session::get('code')
                    ], 400);
                }
    
                $user->update([
                    'password' => Hash::make($data['password']),
                ]);
    
                return response()->json([
                    'message' => 'Đổi mật khẩu thành công'
                ], 200);
            }
    
            $email = $request->input('email');
            $code = sprintf('%06d', rand(1, 999999));
            Session::put('code', $code);
    
            if (!empty($email) && !empty($code)) {
                $user = User::where('email',$email)->first();
                if (User::where('email', $email)->exists()) {
                    dispatch(new SendEmailForgotPass($email, $code, $user->name))
                        ->onQueue(config('queue.queueType.email'));
                }
            }
    
            return response()->json(['success' => 'Vui lòng kiểm tra email'], 200);
        } catch (Exception $e) {
            Log::error('[AuthController][forgotPassword] error ' . $e->getMessage());
            throw new Exception('[AuthController][forgotPassword] error because ' . $e->getMessage());
        }
    }
    public function changePasswordForgot(ForgotPassRequest $request)
    {
        try {
        
        } catch (Exception $e) {
            Log::error('[AuthController][forgotPassword] error ' . $e->getMessage());
            throw new Exception('[AuthController][forgotPassword] error because ' . $e->getMessage());
        }
    }
    /**
     *Forgot password
     *
     * @param UserUpdatePasswordRequest $request
     * @return  [type]  [return description]
     */
    public function changePassword(UserUpdatePasswordRequest $request)
    {
        try {
            $userId = $request->only(['user_id']);
            $user = User::where(['id' => $userId])->first();
            if (empty($user)) return response()->json([], 400);
            if (!Hash::check($request->input('password_old'), $user->password)) {
                return response()->json([],400);
            }
            $user->password = Hash::make($request->input('password'));
            $user->save();
            return $user;
        } catch (Exception $e) {
            Log::error("[AuthController][changePassword] error because" . $e->getMessage());
            throw new Exception('[AuthController][changePassword] error because ' . $e->getMessage());
        }
    }

}
