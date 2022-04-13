<?php

namespace App\Services\Managers;

use App\Http\Requests\Managers\StoreManagerRequest;
use App\Models\Manager;
use App\Services\EncryptService;

class ManagerService
{
    private $request;
    private $service;

    public function __construct(StoreManagerRequest $request, EncryptService $service)
    {
        $this->request = $request;
        $this->service = $service;
    }

    public function store(): void
    {
        $name = $this->request->input('name');
        $account = $this->request->input('account');
        $password = $this->service->sha1($this->request->input('password'));
        $managerId = $this->service->md5($account);

        Manager::create([
            'managerID' => $managerId,
            'name' => $name,
            'account' => $account,
            'password' => $password
        ]);
    }
}
