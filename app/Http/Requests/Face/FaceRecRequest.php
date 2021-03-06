<?php

namespace App\Http\Requests\Face;

use Illuminate\Foundation\Http\FormRequest;

class FaceRecRequest extends FormRequest
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
            'user_id' => 'required|string|min:11|max:11',
            'base64_content' => 'required|string'
        ];
    }
}
