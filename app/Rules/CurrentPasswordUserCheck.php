<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;

class CurrentPasswordUserCheck implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        if(!Hash::check($value, $this->user->password)){
            $fail("Mật khẩu cũ không chính xác");
        };
    }

}
