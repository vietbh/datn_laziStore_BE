<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ForgotPassRequest;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserUpdatePasswordRequest;
use App\Jobs\SendEmailForgotPass;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        if (User::where('email', $request->email)->first()) {
            $user = User::where('email', $request->email)->first();
        } else if (User::where('name', $request->email)->first()) {
            $user = User::where('name', $request->email)->first();
        }
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'login' => ['Tài khoản không tồn tại.'],
            ]);
        }
        $data = [
            [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
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

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(10),
        ]);

        // event(new Registered($user));

        // Auth::login($user);
        return response()->json($user);
    }

    /**
     *Forgot password
     *
     * @param ForgotPassRequest $request
     * @return  [type]  [return description]
     */
    public function forgotPassword(ForgotPassRequest $request)
    {
        try {
            $email = $request->only(['email']);
            $code = sprintf('%06d', rand(1, 999999));
            if (!empty($email) && !empty($code)) {
                $user = User::where(['email' => $email])->first();
                dispatch(new SendEmailForgotPass($user->email, $code, $user->name))->onQueue(config('queue.queueType.email'));
                $user->reset_code = $code;
                $user->save();
            }
            return response()->json([], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('[AuthController][forgotPassword] error ' . $e->getMessage());
            throw new Exception('[AuthController][forgotPassword] error because ' . $e->getMessage());
        }
    }
    /**
     *Forgot password
     *
     * @param ForgotPassRequest $request
     * @return  [type]  [return description]
     */
    public function changePasswordForgot(ForgotPassRequest $request)
    {
        try {
            $data = $request->only(['email', 'code', 'password']);
            $user = User::where(['email' => $data['email'], 'reset_code' => $data['code']])->first();
            if (empty($user)) {
                return response()->json([
                    'message' => 'Mã code không chính xác'
                ], Response::HTTP_BAD_REQUEST);
            }
            $user->password = Hash::make($data['password']);
            $user->save();
            return response()->json([
                'message' => 'Đổi mật khẩu thành công'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
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
            if (empty($user)) return response()->json([], Response::HTTP_BAD_REQUEST);
            if (!Hash::check($request->input('password_old'), $user->password)) {
                return response()->json([], Response::HTTP_BAD_REQUEST);
            }
            $user->password = Hash::make($request->input('password'));
            $user->save();
            return $user;
        } catch (Exception $e) {
            Log::error("[AuthController][changePassword] error because" . $e->getMessage());
            throw new Exception('[AuthController][changePassword] error because ' . $e->getMessage());
        }
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
