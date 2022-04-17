<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class EncryptService
{
    public function md5(string $data): string
    {
        return md5($data);
    }

    public function md5WithTime(string $data): string
    {
        return md5($data . Carbon::now());
    }

    public function sha1(string $data): string
    {
        return sha1($data);
    }
}
