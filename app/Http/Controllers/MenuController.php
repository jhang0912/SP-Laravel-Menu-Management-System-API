<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\MenuCategoryRepositoryInterface;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    private $repository;

    public function __construct(MenuCategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }
}
