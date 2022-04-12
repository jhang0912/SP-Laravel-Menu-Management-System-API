<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerLoginToken extends Model
{
    use HasFactory;

    /* constants */

    const CREATED_AT = 'createdTime';

    const UPDATED_AT = 'updatedTime';

    /*  attributes */

    protected $table = 'managerlogintokens';

    protected $dateFormat = 'U';

    protected $fillable = [
        'token',
        'managerID'
    ];

    /* relationships */

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }
}
