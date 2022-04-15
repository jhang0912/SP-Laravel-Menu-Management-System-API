<?php

namespace App\Services\Menus;

use App\Repositories\Interfaces\MenuCategoryRepositoryInterface;
use App\Repositories\Interfaces\MenuItemRepositoryInterface;
use App\Services\EncryptService;

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

    public function index()
    {
        return $this->menuCategoryRepository->index();
    }

    public function store(string $name, int $toggle, string $itemName, int $itemPrice, int $itemToggle)
    {
        if ($this->menuCategoryRepository->exists('name', $name)) {
            $categoryID = $this->menuCategoryRepository->show('name', $name)->get(0)->categoryID;
        } else {
            $categoryID = $this->service->md5($name);
            $orderBy = $this->menuCategoryRepository->max('orderBy') + 1;

            $this->menuCategoryRepository->store($categoryID, $name, $orderBy, $toggle);
        }

        $itemID = $this->service->md5($itemName);
        $orderBy = $this->menuItemRepository->max('orderBy') + 1;

        $this->menuItemRepository->store($itemID, $categoryID, $itemName, $itemPrice, $orderBy, $itemToggle);
    }
}
