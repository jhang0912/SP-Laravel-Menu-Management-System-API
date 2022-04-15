<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    /* constants */

    const CREATED_AT = 'createdTime';

    const UPDATED_AT = 'updatedTime';

    /*  attributes */

    protected $table = 'menuitems';

    protected $dateFormat = 'U';

    protected $hidden = [
        'id',
        'itemID',
        'categoryID',
        'orderBy',
        'toggle',
        'createdTime',
        'updatedTime'
    ];

    protected $fillable = [
        'itemID',
        'categoryID',
        'name',
        'price',
        'orderBy',
        'toggle'
    ];

    /* relationships */

    public function menuCategorie()
    {
        return $this->belongsTo(MenuCategory::class, 'categoryID', 'categoryID');
    }
}
