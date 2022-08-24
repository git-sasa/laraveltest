<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            //
            'phone'=>[
                'required',
                'regex:/^1([38][0-9]|4[579]|5[0-3,5-9]|6[6]|7[0135678]|9[89])\d{8}$/',
            ],
            'password'=>'required|between:8,16'
        ];
    }

    public function messages(){
        return [
            'phone.required'     => '手机号不能为空',
            'password.required' => '密码不能为空',
            'password.between' => '密码请输入8-16位',
            'phone.regex'           => '请输入正确格式的手机号',
        ];
    }
}
