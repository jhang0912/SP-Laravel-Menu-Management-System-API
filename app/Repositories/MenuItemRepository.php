<?php

namespace App\Repositories;

use App\Models\MenuItem;
use App\Repositories\Interfaces\MenuItemRepositoryInterface;
use Illuminate\Support\Arr;

class MenuItemRepository implements MenuItemRepositoryInterface
{
    public function destory(string $categoryID): void
    {
        MenuItem::where('categoryID', $categoryID)->delete();
    }

    public function destoryNotIn(string $categoryID, string $columnName, array $data): void
    {
        MenuItem::where('categoryID', $categoryID)->whereNotIn($columnName, $data)->delete();
    }

    public function exists(string $columnName, string $data): bool
    {
        return MenuItem::where($columnName, $data)->exists();
    }

    public function index(): object
    {
        return MenuItem::get();
    }

    public function max(string $columnName): ?int
    {
        return MenuItem::max($columnName);
    }

    public function show(string $id): object
    {
        return MenuItem::find($id);
    }

    public function store(string $itemID, string $categoryID, array $item, int $orderBy): void
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

    public function update(string $itemID, array $item): void
    {
        MenuItem::where('itemID', $itemID)->update([
            'name' => Arr::get($item, 'name'),
            'price' => Arr::get($item, 'price'),
            'toggle' => Arr::get($item, 'toggle')
        ]);
    }
}
