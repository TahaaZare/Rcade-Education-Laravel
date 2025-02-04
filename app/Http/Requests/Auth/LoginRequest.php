<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
            return [
                'id' => 'required|min:11|max:64|regex:/^[a-zA-Z0-9_.@\+]*$/',
            ];
    }


    public function attributes()
    {
        return [
            'id' => 'شماره موبایل',
            'otp' => 'رمز یک بار مصرف'
        ];
    }
}
