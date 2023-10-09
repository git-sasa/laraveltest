<?php

namespace App\Http\Requests;

use http\Client\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBlogPost extends FormRequest
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
            'title' => 'required|max:3',
            'body' => 'required',
        ];
    }

    public function messages(){
        return [
            'title.required'=>'title is required',
            'title.max' =>'标题的长度不能超过3个字',
            'body.required' =>' message is required',
        ];
    }

    /**
     * 重新定义返回格式
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(Response()->fail(40001,'',$errors));
    }

    /**
     * 定义错误格式
     * @param $code
     * @param $errors
     * @return JsonResponse
     */
    protected function failJoin($code,$errors) : JsonResponse
    {
        return response()->json([
            'code'=>$code,
            'message'=>'验证失败',
            'data'=>$errors,
            'timestamp'=>getMillisecond(),
        ]);
    }
}
