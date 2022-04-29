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

            return response(['status' => 0, 'msg' => '發生不可預期的錯誤，請聯絡開發人員'], 500);
        }

        return response(['status' => 1, 'msg' => '註冊成功'], 201);
    }

    public function signIn(SignInManagerRequest $request, AuthManagerService $service)
    {
        try {
            $account = $request->input('account');
            $password = $request->input('password');

            if ($service->authenticate($account, $password) === false) {
                return response(['status' => 0, 'msg' => 'account 或 password 輸入錯誤，請重新輸入'], 400);
            }

            if ($service->checkMultipleAuthenticate($account, $password) === false) {
                return response(['status' => 1, 'msg' => '登入成功', 'data' => ['token' => $service->show($account, $password)]], 200);
            }

            $token = $service->issueToken($account, $password);
        } catch (\Throwable $exception) {
            report($exception);

            return response(['status' => 0, 'msg' => '發生不可預期的錯誤，請聯絡開發人員'], 500);
        }

        return response(['status' => 1, 'msg' => '登入成功', 'data' => ['token' => $token]], 200);
    }

    public function signOut(Request $request, AuthManagerService $service)
    {
        try {
            $token = $request->bearerToken();
            $service->revokeToken($token);
        } catch (\Throwable $exception) {
            report($exception);

            return response(['status' => 0, 'msg' => '發生不可預期的錯誤，請聯絡開發人員'], 500);
        }
        return response(['status' => 1, 'msg' => '登出成功'], 200);
    }
}
