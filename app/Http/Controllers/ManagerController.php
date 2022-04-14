<?php

namespace App\Http\Controllers;

use App\Http\Requests\Managers\SignInManagerRequest;
use App\Http\Requests\Managers\StoreManagerRequest;
use App\Services\Managers\AuthManagerService;
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

    public function signIn(SignInManagerRequest $request, AuthManagerService $service)
    {
        $account = $request->input('account');
        $password = $request->input('password');

        if ($service->authenticate($account, $password) === false) {
            return response(['status' => 0, 'msg' => 'account 或 password 輸入錯誤，請重新輸入']);
        }

        if ($service->checkMultipleAuthenticate($account, $password) === false) {
            return response(['status' => 1, 'msg' => '登入成功', 'data' => $service->show($account, $password)]);
        }

        $token = $service->issueToken($account, $password);

        return response(['status' => 1, 'msg' => '登入成功', 'data' => ['token' => $token]]);
    }

    public function signOut(Request $request, AuthManagerService $service)
    {
        $token = $request->bearerToken();

        if ($service->authorization($token) === false) {
            return response(['status' => 0, 'msg' => 'Unauthorized'], 401);
        }

        $service->revokeToken($token);

        return response(['status' => 1, 'msg' => '登出成功']);
    }
}
