<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name'=>['required','string'],
            'username'=>['required','string','min:6','unique:users'],
            'password'=>['required','confirmed','min:6'],
            'user_type'=>['required','in:admin,staff'],

        ];
    }

    public function messages(): array
    {
        return [
            'username.min'=>"إسم المستخدم يجب ان يحتوي على 6 أحرف أو أرقام",
            'password.min'=>"كلمة المرور يجب ان تحتوي على 6 أحرف أو أرقام",

        ];
    }
}
