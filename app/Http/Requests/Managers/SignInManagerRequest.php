<?php

namespace App\Http\Requests\Managers;

use App\Http\Requests\APIRequest;
use Illuminate\Validation\Rules\Password;

class SignInManagerRequest extends APIRequest
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
            'account' => ['required', 'email:rfc,dns', 'exists:App\Models\Manager,account'],
            'password' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute 為必填欄位，請重新輸入',
            'email' => 'account 或 password 輸入錯誤，請重新輸入',
            'exists' => 'account 或 password 輸入錯誤，請重新輸入'
        ];
    }
}
