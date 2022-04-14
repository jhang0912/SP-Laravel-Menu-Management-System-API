<?php

namespace App\Services\Managers;

use App\Models\Manager;
use App\Models\ManagerLoginToken;
use App\Services\EncryptService;
use Carbon\Carbon;

class AuthManagerService
{
    private $service;

    public function __construct(EncryptService $service)
    {
        $this->service = $service;
    }

    public function authenticate(string $account, string $password): bool
    {
        return Manager::where(['account' => $account, 'password' => $this->service->sha1($password)])->exists();
    }

    public function authorization(string $token): bool
    {
        return ManagerLoginToken::where(['token' => $token])->exists();
    }

    public function checkMultipleAuthenticate(string $account, string $password): bool
    {
        $managerID = Manager::select('managerID')->where(['account' => $account, 'password' => $this->service->sha1($password)])->get()->get(0)->managerID;

        return !ManagerLoginToken::where('managerID', $managerID)->exists();
    }

    public function issueToken(string $account, string $password): string
    {
        $managerID = Manager::select('managerID')->where(['account' => $account, 'password' => $this->service->sha1($password)])->get()->get(0)->managerID;

        $token = $this->service->md5(Carbon::now() . $account);

        ManagerLoginToken::create(['token' => $token, 'managerID' => $managerID]);

        return $token;
    }

    public function revokeToken(string $token): void
    {
        ManagerLoginToken::where('token', $token)->delete();
    }

    public function show(string $account, string $password): string
    {
        $managerID = Manager::select('managerID')->where(['account' => $account, 'password' => $this->service->sha1($password)])->get()->get(0)->managerID;

        $token = ManagerLoginToken::select('token')->where('managerID', $managerID)->get()->get(0);

        return $token;
    }
}
