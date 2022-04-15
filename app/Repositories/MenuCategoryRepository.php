<?php

namespace App\Repositories;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Repositories\Interfaces\MenuCategoryRepositoryInterface;

class MenuCategoryRepository implements MenuCategoryRepositoryInterface
{
    public function index()
    {
        return MenuCategory::with('menuItems')->orderBy('orderBy')->get();
    }

    public function max(string $columnName)
    {
        return MenuCategory::max($columnName);
    }

    public function exists(string $columnName, string $data)
    {
        return MenuCategory::where($columnName, $data)->exists();
    }

    public function show(string $columnName, string $data)
    {
        return MenuCategory::where($columnName, $data)->get();
    }

    public function store(string $categoryID, string $name, int $orderBy, int $toggle)
    {
        MenuCategory::create([
            'categoryID' => $categoryID,
            'name' => $name,
            'orderBy' => $orderBy,
            'toggle' => $toggle
        ]);
    }
}
