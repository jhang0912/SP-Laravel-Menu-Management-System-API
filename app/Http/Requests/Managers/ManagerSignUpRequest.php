<?php

namespace App\Http\Requests\Managers;

use App\Http\Requests\APIRequest;
use Illuminate\Validation\Rules\Password;

class ManagerSignUpRequest extends APIRequest
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
            'account' => ['required', 'email:rfc,dns', 'unique:App\Models\Manager,account', 'max:35'],
            'password' => ['required', 'max:16', Password::min(8)
                ->mixedCase()
                ->numbers()],
            'name' => ['required', 'max:25']
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute 為必填欄位，請重新填寫。',
            'email' => ':attribute 格式錯誤(email)，請重新填寫。',
            'unique' => 'account 已被使用，請重新填寫。',
            'account.max' => ':attribute 長度大於最大限制(35)，請重新填寫。',
            'name.max' => ':attribute 長度大於最大限制(25)，請重新填寫。',
            'password.max' => ':attribute 長度大於最大限制(16)，請重新填寫。',
            'min' => ':attribute 長度低於最小限制(8)，請重新填寫。',
            'mixedCase' => ':attribute 最少需包含一大寫字母與一小寫字母，請重新填寫。'
        ];
    }
}
