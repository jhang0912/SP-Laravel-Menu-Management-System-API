<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;

class EncryptService
{
    private $encryptKey = '$2y$10$ChcJ8nFzM7XOpW66gNF7zOzT7EbQe7tyR6BUOuCHDmFKJo8iLkQmG';

    public function md5(string $data)
    {
        return md5(Hash::make($this->encryptKey . $data));
    }

    public function sha1(string $data)
    {
        return sha1(Hash::make($this->encryptKey . $data));
    }
}
