<?php

namespace App\Services\Managers;

use App\Http\Requests\Managers\StoreManagerRequest;
use App\Models\Manager;
use App\Services\EncryptService;

class ManagerService
{
    private $service;

    public function __construct(EncryptService $service)
    {
        $this->service = $service;
    }

    public function store(string $name, string $account, string $password): void
    {
        $password = $this->service->sha1($password);
        $managerId = $this->service->md5($account);

        Manager::create([
            'managerID' => $managerId,
            'name' => $name,
            'account' => $account,
            'password' => $password
        ]);
    }
}
