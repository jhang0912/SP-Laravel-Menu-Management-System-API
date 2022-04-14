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
        return Manager::where([
            'account' => $account,
            'password' => $this->service->sha1($password)
        ])->exists();
    }

    public function IssueToken(string $account, string $password): string
    {
        $manager = Manager::where([
            'account' => $account,
            'password' => $this->service->sha1($password)
        ])->get();

        $managerID = $manager->get(0)->managerID;
        $token = $this->service->md5(Carbon::now() . $account);

        ManagerLoginToken::create([
            'token' => $token,
            'managerID' => $managerID,
        ]);

        return $token;
    }
}
