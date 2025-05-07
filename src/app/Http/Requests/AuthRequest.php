<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        return [
            "name" => "required|string|max:255",
            "email" => "required|email|max:255|unique:users,email",
            "password" => "required|string|min:8",
            //
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "お名前を入力してください",
            "email.required" => "メールアドレスを入力してください",
            "email.email" => "メールアドレスは「ユーザー名@ドメイン」の形式で入力してください",
            "email.unique" => "このメールアドレスはすでに使用されています",
            "password.required" => "パスワードを入力してください",
            
        ];
    }
}
