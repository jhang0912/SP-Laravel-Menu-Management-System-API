<?php

namespace App\Http\Requests\Menus;

use App\Http\Requests\APIRequest;

class DestoryMenuRequest extends APIRequest
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
            'categoryID' => ['required', 'string', 'exists:App\Models\MenuCategory,categoryID']
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute 為必填欄位，請重新輸入',
            'string' => ':attribute 格式錯誤(string)，請重新輸入',
            'exists' => ':attribute 輸入錯誤，請重新輸入',
        ];
    }
}
