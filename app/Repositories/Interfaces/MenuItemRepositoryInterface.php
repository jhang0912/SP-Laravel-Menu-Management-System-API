<?php

namespace App\Repositories\Interfaces;

interface MenuItemRepositoryInterface
{

    public function index();

    public function max(string $columnName);

    public function show(string $columnName);

    public function store(string $itemID, string $categoryID, array $item, int $orderBy);

    public function update(string $itemID, array $item);
}
