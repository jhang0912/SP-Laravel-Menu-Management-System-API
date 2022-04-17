<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorHandleController extends Controller
{
    public function NotFound()
    {
        return response(['status' => 0, 'msg' => 'Not found'], 404);
    }
}
