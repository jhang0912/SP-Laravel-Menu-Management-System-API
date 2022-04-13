<?php

namespace App\Http\Controllers;

use App\Services\Managers\ManagerService;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    private $service;

    public function __construct(ManagerService $service)
    {
        $this->service = $service;
    }

    public function store()
    {
        try {
            $this->service->store();
        } catch (\Throwable $exception) {
            report($exception);

            return response(['status' => 0, 'msg' => '發生不可預期的錯誤，請聯絡開發人員']);
        }

        return response(['status' => 1, 'msg' => '註冊成功']);
    }
}
