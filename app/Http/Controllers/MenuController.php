<?php

namespace App\Http\Controllers;

use App\Http\Requests\Menus\StoreMenuRequest;
use App\Repositories\Interfaces\MenuCategoryRepositoryInterface;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    private $repository;

    public function __construct(MenuCategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return response(['status' => 1, 'msg' => '成功取得菜單內容', 'data' => [$this->repository->index()]]);
    }

    public function store(StoreMenuRequest $request)
    {
    }
}
