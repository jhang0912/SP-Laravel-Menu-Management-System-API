<?php

namespace App\Repositories\Interfaces;

interface MenuCategoryRepositoryInterface
{

    public function exists(string $columnName, string $data);

    public function index();

    public function max(string $columnName);

    public function show(string $columnName, string $data);

    public function store(string $categoryID, string $name, int $orderBy, int $toggle);
}
