<?php

namespace App\Http\Controllers;

use App\Http\Requests\Managers\SignInManagerRequest;
use App\Http\Requests\Managers\StoreManagerRequest;
use App\Services\Managers\ManagerService;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function store(StoreManagerRequest $request, ManagerService $service)
    {
        try {
            $name = $request->input('name');
            $account = $request->input('account');
            $password = $request->input('password');

            $service->store($name, $account, $password);
        } catch (\Throwable $exception) {
            report($exception);

            return response(['status' => 0, 'msg' => '發生不可預期的錯誤，請聯絡開發人員']);
        }

        return response(['status' => 1, 'msg' => '註冊成功']);
    }

    public function signIn(SignInManagerRequest $request)
    {
        return 'login';
    }

    public function signOut()
    {

    }
}
