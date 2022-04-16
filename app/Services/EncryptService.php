<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class EncryptService
{
    public function md5(string $data)
    {
        return md5($data . Carbon::now());
    }

    public function sha1(string $data)
    {
        return sha1($data . Carbon::now());
    }
}
