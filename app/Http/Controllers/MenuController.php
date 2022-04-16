<?php

namespace App\Http\Controllers;

use App\Http\Requests\Menus\StoreMenuRequest;
use App\Http\Requests\Menus\UpdateMenuRequest;
use App\Services\Menus\MenuService;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    public function index(MenuService $service)
    {
        return response(['status' => 1, 'msg' => '成功取得菜單內容', 'data' => $service->index()]);
    }

    public function store(StoreMenuRequest $request, MenuService $service)
    {
        $name = $request->input('name');
        $toggle = $request->input('toggle');
        $items = $request->input('menuItems');

        $service->store($name, $toggle, $items);

        return response(['status' => 1, 'msg' => '菜單建立成功']);
    }

    public function update(UpdateMenuRequest $request, MenuService $service)
    {
        $categoryID = $request->input('categoryID');
        $name = $request->input('name');
        $toggle = $request->input('toggle');
        $items = $request->input('menuItems');

        $service->update($categoryID, $name, $toggle, $items);

        return response(['status' => 1, 'msg' => '菜單編輯成功']);
    }
}
