<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'password_old' => 'required',
            'password' => 'required',
        ];
        return $rules;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        $messages = array(
            'password_old.min' => trans('messages.request.input_min', ['attribute' => "Mật khẩu cũ", 'min' => "6" ]),
            'password_old.required' => trans('messages.request.input_required', ['attribute' => "Mật khẩu cũ"]),
            'password.min' => trans('messages.request.input_min', ['attribute' => "Mật khẩu", 'min' => "6" ]),
            'password_confirmation.required_with' => trans('messages.request.input_required_with', ['attribute' => "Nhập lại mật khẩu", 'required_with' => "Mật khẩu" ]),
            'password_confirmation.min' => trans('messages.request.input_min', ['attribute' => "Nhập lại mật khẩu", 'min' => "6" ]),
            'password.same' => trans('messages.request.input_same', ['attributes' => "Mật khẩu", 'same' => "Nhập lại mật khẩu" ]),
            'password.required' => trans('messages.request.input_required', ['attribute' => "Mật khẩu"]),
            'password.regex' =>trans('messages.request.input_regex', ['attribute' => "Mật khẩu"]),
        );
        return $messages;
    }
}
