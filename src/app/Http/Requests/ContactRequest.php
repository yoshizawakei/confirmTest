<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            "name_first" => "required|string|max:225",
            "name_last" => "required|string|max:225",
            "gender" => "required",
            "email" => "required|email|max:255",
            "phone1" => "required|digits_between:1,5",
            "phone2" => "required|digits_between:1,5",
            "phone3" => "required|digits_between:1,5",
            "address" => "required|string|max:255",
            "building" => "string|max:255|nullable",
            "category_id" => "required|string",
            "detail" => "required|string|max:120",
            "tel" => "string|max:20|nullable",
        ];
    }

    public function messages()
    {
        return [
            "name_first.required" => "姓を入力してください",
            "name_last.required" => "名を入力してください",
            "gender.required" => "性別を選択してください",
            "email.required" => "メールアドレスを入力してください",
            "email.email" => "メールアドレスの形式で入力してください",
            "phone1.required" => "電話番号を入力してください",
            "phone1.digits_between" => "電話番号は5桁までの数字で入力してください",
            "phone2.required" => "電話番号を入力してください",
            "phone2.digits_between" => "電話番号は5桁までの数字で入力してください",
            "phone3.required" => "電話番号を入力してください",
            "phone3.digits_between" => "電話番号は5桁までの数字で入力してください",
            "address.required" => "住所を入力してください",
            "detail.required" => "お問い合わせ内容を入力してください",
            "detail.max" => "お問い合わせ内容は120文字以内で入力してください",
            "category_id.required" => "お問い合せの種類を選択してください",
            "tell.string" => "電話番号は文字列で入力してください",
            "tell.max" => "電話番号は20文字以内で入力してください",
        ];
        
    }
}
