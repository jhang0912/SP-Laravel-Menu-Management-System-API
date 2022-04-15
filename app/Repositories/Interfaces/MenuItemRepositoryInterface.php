<?php

namespace App\Repositories\Interfaces;

interface MenuItemRepositoryInterface
{

    public function index();

    public function max(string $columnName);

    public function show(string $columnName);

    public function store(string $itemID, string $categoryID, string $name, int $price, int $orderBy, int $toggle);
}
