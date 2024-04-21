<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\CurrentPasswordUserCheck;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Thay đổi mật khẩu thành công');
    }
    public function updateUser(Request $request): RedirectResponse
    {
        $user = User::findOrFail($request->user_id);
        $validated = $request->validateWithBag('updatePasswordUser', [
            'current_password' => ['required', new CurrentPasswordUserCheck($user)],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ],[
            'current_password.required'=>'Vui lòng không để trống trường này',
            'password.required'=>'Vui lòng không để trống trường này',
            'password.confirmed'=>'Mật khẩu xác nhận không trùng khớp',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Thay đổi mật khẩu thành công');
    }
}
