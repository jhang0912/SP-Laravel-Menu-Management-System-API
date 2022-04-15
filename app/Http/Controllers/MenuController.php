<?php

namespace App\Http\Controllers;

use App\Http\Requests\Menus\StoreMenuRequest;
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
        $itemName = $request->input('menuItems.name');
        $itemPrice = $request->input('menuItems.price');
        $itemToggle = $request->input('menuItems.toggle');

        $service->store($name, $toggle, $itemName, $itemPrice, $itemToggle);

        return response(['status' => 1, 'msg' => '菜單建立成功']);
    }
}
