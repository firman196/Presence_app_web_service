<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Auth;

class CurrentPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(Auth::guard('admin')->check()){
            return Hash::check($value, Auth::guard('admin')->user()->password);
        }elseif(Auth::guard('dosen')->check()){
            return Hash::check($value, Auth::guard('dosen')->user()->password);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if(Auth::guard('admin')->check()){
            return 'Password anda tidak valid';
        }elseif(Auth::guard('dosen')->check()){
            return 'Pssword lama tidak cocok';
        }
    }
}
