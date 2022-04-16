<?php

namespace App\Repositories;

use App\Models\MenuItem;
use App\Repositories\Interfaces\MenuItemRepositoryInterface;
use Illuminate\Support\Arr;

class MenuItemRepository implements MenuItemRepositoryInterface
{
    public function destory(string $categoryID)
    {
        MenuItem::where('categoryID', $categoryID)->delete();
    }

    public function destoryByItemID(string $categoryID, array $itemID)
    {
        MenuItem::where('categoryID', $categoryID)->whereNotIn('itemID', $itemID)->delete();
    }

    public function exists(string $columnName, string $data)
    {
        return MenuItem::where($columnName, $data)->exists();
    }

    public function index()
    {
        return MenuItem::get();
    }

    public function max(string $columnName)
    {
        return MenuItem::max($columnName);
    }

    public function show(string $id)
    {
        return MenuItem::find($id);
    }

    public function store(string $itemID, string $categoryID, array $item, int $orderBy)
    {
        MenuItem::create([
            'itemID' => $itemID,
            'categoryID' => $categoryID,
            'name' => Arr::get($item, 'name'),
            'price' => Arr::get($item, 'price'),
            'orderBy' => $orderBy,
            'toggle' => Arr::get($item, 'toggle')
        ]);
    }

    public function update(string $itemID, array $item)
    {
        MenuItem::where('itemID', $itemID)->update([
            'name' => Arr::get($item, 'name'),
            'price' => Arr::get($item, 'price'),
            'toggle' => Arr::get($item, 'toggle')
        ]);
    }
}
