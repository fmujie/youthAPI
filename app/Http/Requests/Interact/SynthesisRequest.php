<?php

namespace App\Http\Requests\Interact;

use Illuminate\Foundation\Http\FormRequest;

class SynthesisRequest extends FormRequest
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
            'txtInfo' => 'required|string|min:1',
        ];
    }

    /**
    * 获取已定义的验证规则的错误消息。
    *
    * @return array
    */
    public function messages()
    {
        return [
            'txtInfo.required' => 'txtInfo is required, Do not less than one character',
        ];
    }

}
