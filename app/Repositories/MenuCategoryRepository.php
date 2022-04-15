<?php

namespace App\Repositories;

use App\Models\MenuCategory;
use App\Repositories\Interfaces\MenuCategoryRepositoryInterface;

class MenuCategoryRepository implements MenuCategoryRepositoryInterface
{
    public function index()
    {
        return MenuCategory::with('menuItems')->get();
    }

    public function show(string $id)
    {
        return MenuCategory::find($id);
    }
}
