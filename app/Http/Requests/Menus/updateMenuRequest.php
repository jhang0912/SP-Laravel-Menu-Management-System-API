<?php

namespace App\Http\Requests\Menus;

use App\Http\Requests\APIRequest;

class updateMenuRequest extends APIRequest
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
            'categoryID' => ['required', 'digits:32'],
            'name' => ['required', 'max:25'],
            'toggle' => ['required', 'boolean'],
            'menuItems' => ['required', 'array'],
            'menuItems.*.name' => ['required', 'unique:App\Models\MenuItem,name'],
            'menuItems.*.price' => ['required', 'numeric', 'min:0', 'max:999999', 'not_in:0'],
            'menuItems.*.toggle' => ['required', 'boolean']
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute 為必填欄位，請重新輸入',
            '' => ':attribute 長度錯誤(32)，請重新輸入',
            'unique' => ':attribute 已經存在，請重新輸入',
            'name.max' => ':attribute 長度大於最大限制(25)，請重新輸入',
            'price.max' => ':attribute 長度大於最大限制(999999)，請重新輸入',
            'boolean' => ':attribute 格式錯誤(0或1)，請重新輸入',
            'array' => ':attribute 格式錯誤(array)，請重新輸入',
            'numeric' => ':attribute 格式錯誤(正整數)，請重新輸入',
            'min' => ':attribute 格式錯誤(正整數)，請重新輸入',
            'not_in' => ':attribute 格式錯誤(正整數)，請重新輸入',
        ];
    }
}
