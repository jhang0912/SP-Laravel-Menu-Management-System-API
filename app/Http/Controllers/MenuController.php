<?php

namespace App\Http\Controllers;

use App\Http\Requests\Menus\DestoryMenuRequest;
use App\Http\Requests\Menus\StoreMenuRequest;
use App\Http\Requests\Menus\UpdateMenuRequest;
use App\Services\Menus\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $service;

    public function __construct(MenuService $service)
    {
        $this->service = $service;
    }

    public function destory(DestoryMenuRequest $request)
    {
        try {
            $categoryID = $request->input('categoryID');
            $this->service->destory($categoryID);
        } catch (\Throwable $exception) {
            report($exception);

            return response(['status' => 0, 'msg' => '發生不可預期的錯誤，請聯絡開發人員']);
        }

        return response(['status' => 1, 'msg' => '菜單刪除成功']);
    }

    public function index()
    {
        try {
            $menus = $this->service->index();
        } catch (\Throwable $exception) {
            report($exception);

            return response(['status' => 0, 'msg' => '發生不可預期的錯誤，請聯絡開發人員']);
        }
        return response(['status' => 1, 'msg' => '成功取得菜單內容', 'data' => $menus]);
    }

    public function store(StoreMenuRequest $request)
    {
        try {
            $name = $request->input('name');
            $toggle = $request->input('toggle');
            $items = $request->input('menuItems');

            $this->service->store($name, $toggle, $items);
        } catch (\Throwable $exception) {
            report($exception);

            return response(['status' => 0, 'msg' => '發生不可預期的錯誤，請聯絡開發人員']);
        }

        return response(['status' => 1, 'msg' => '菜單建立成功']);
    }

    public function update(UpdateMenuRequest $request)
    {
        try {
            $categoryID = $request->input('categoryID');
            $name = $request->input('name');
            $toggle = $request->input('toggle');
            $items = $request->input('menuItems');

            $this->service->update($categoryID, $name, $toggle, $items);
        } catch (\Throwable $exception) {
            report($exception);

            return response(['status' => 0, 'msg' => '發生不可預期的錯誤，請聯絡開發人員']);
        }

        return response(['status' => 1, 'msg' => '菜單編輯成功']);
    }
}
