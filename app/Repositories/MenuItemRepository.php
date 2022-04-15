<?php

namespace App\Repositories;

use App\Models\MenuItem;
use App\Repositories\Interfaces\MenuItemRepositoryInterface;

class MenuItemRepository implements MenuItemRepositoryInterface
{
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

    public function store(string $itemID, string $categoryID, string $name, int $price, int $orderBy, int $toggle)
    {
        MenuItem::create([
            'itemID' => $itemID,
            'categoryID' => $categoryID,
            'name' => $name,
            'price' => $price,
            'orderBy' => $orderBy,
            'toggle' => $toggle
        ]);
    }
}
