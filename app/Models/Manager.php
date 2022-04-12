<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    /* constants */

    const CREATED_AT = 'createdTime';

    const UPDATED_AT = 'updatedTime';

    /*  attributes */

    protected $table = 'managers';

    protected $dateFormat = 'U';

    protected $fillable = [
        'managerID',
        'name',
        'account',
        'password'
    ];

    /* relationships */

    public function managerLoginTokens()
    {
        return $this->hasMany(ManagerLoginToken::class, 'managerID', 'managerID');
    }
}
