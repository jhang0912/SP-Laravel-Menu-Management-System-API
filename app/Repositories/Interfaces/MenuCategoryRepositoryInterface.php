<?php

namespace App\Repositories\Interfaces;

interface MenuCategoryRepositoryInterface
{

    public function index();

    public function show(string $id);
}
