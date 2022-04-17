<?php

namespace App\Services\Menus;

use App\Models\MenuItem;
use App\Repositories\Interfaces\MenuCategoryRepositoryInterface;
use App\Repositories\Interfaces\MenuItemRepositoryInterface;
use App\Services\EncryptService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class MenuService
{
    private $menuCategoryRepository;
    private $menuItemRepository;
    private $service;

    public function __construct(MenuCategoryRepositoryInterface $menuCategoryRepository, MenuItemRepositoryInterface $menuItemRepository, EncryptService $service)
    {
        $this->menuCategoryRepository = $menuCategoryRepository;
        $this->menuItemRepository = $menuItemRepository;
        $this->service = $service;
    }

    public function destory(string $categoryID)
    {
        $this->menuItemRepository->destory($categoryID);
        $this->menuCategoryRepository->destory($categoryID);
    }

    public function index()
    {
        return $this->menuCategoryRepository->index();
    }

    public function store(string $name, int $toggle, array $items)
    {
        if ($this->menuCategoryRepository->exists('name', $name)) {
            $categoryID = $this->menuCategoryRepository->show('name', $name)->get(0)->categoryID;
        } else {
            $categoryID = $this->service->md5WithTime($name);
            $orderBy = $this->menuCategoryRepository->max('orderBy') + 1;
            $this->menuCategoryRepository->store($categoryID, $name, $orderBy, $toggle);
        }

        foreach ($items as $item) {
            $itemID = $this->service->md5WithTime(Arr::get($item, 'name'));
            $orderBy = $this->menuItemRepository->max('orderBy') + 1;
            $this->menuItemRepository->store($itemID, $categoryID, $item, $orderBy);
        }
    }

    public function update(string $categoryID, string $name, int $toggle, array $items)
    {
        $this->menuCategoryRepository->update($categoryID, $name, $toggle);

        $itemIDs = Arr::pluck($items, 'itemID');
        $itemIDs = Arr::whereNotNull($itemIDs);
        $this->menuItemRepository->destoryNotIn($categoryID, 'itemID', $itemIDs);

        foreach ($items as $item) {
            if (Arr::get($item, 'itemID') == null) {
                if (!$this->menuItemRepository->exists('name', Arr::get($item, 'name'))) {
                    $itemID = $this->service->md5WithTime(Arr::get($item, 'name'));
                    $orderBy = $this->menuItemRepository->max('orderBy') + 1;
                    $this->menuItemRepository->store($itemID, $categoryID, $item, $orderBy);
                } else {
                    continue;
                }
            } else {
                $itemID = Arr::get($item, 'itemID');
                $this->menuItemRepository->update($itemID, $item);
            }
        }
    }
}
