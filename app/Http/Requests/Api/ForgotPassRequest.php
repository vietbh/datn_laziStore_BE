<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPassRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email','exists:users'],
        ];
    }
       /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        $messages = array(
            'email.email' => 'Email không đúng định dạng',
            'email.exists' => 'Email không tồn tại',
            'email.required' => 'Email là bắt buộc',
        );
        return $messages;
    }
}
