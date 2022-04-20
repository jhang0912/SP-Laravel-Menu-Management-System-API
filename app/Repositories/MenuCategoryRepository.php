<?php

namespace App\Repositories;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Repositories\Interfaces\MenuCategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class MenuCategoryRepository implements MenuCategoryRepositoryInterface
{
    public function destory(string $categoryID): void
    {
        MenuCategory::where('categoryID', $categoryID)->delete();
    }

    public function exists(string $columnName, string $data): bool
    {
        return MenuCategory::where($columnName, $data)->exists();
    }

    public function index(): object
    {
        return MenuCategory::with(['menuItems' => function ($query) {
            $query->where('toggle', 1)->orderBy('orderBy');
        }])->where('toggle', 1)->orderBy('orderBy')->get();
    }

    public function max(string $columnName): ?int
    {
        return MenuCategory::max($columnName);
    }

    public function show(string $columnName, string $data): object
    {
        return MenuCategory::where($columnName, $data)->get();
    }

    public function store(string $categoryID, string $name, int $orderBy, int $toggle): void
    {
        MenuCategory::create([
            'categoryID' => $categoryID,
            'name' => $name,
            'orderBy' => $orderBy,
            'toggle' => $toggle
        ]);
    }

    public function update(string $categoryID, string $name, int $toggle): void
    {
        MenuCategory::where('categoryID', $categoryID)->update([
            'name' => $name,
            'toggle' => $toggle
        ]);
    }
}
