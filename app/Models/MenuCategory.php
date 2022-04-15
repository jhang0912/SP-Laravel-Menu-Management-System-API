<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

    /* constants */

    const CREATED_AT = 'createdTime';

    const UPDATED_AT = 'updatedTime';

    /*  attributes */

    protected $table = 'menucategories';

    protected $dateFormat = 'U';

    protected $hidden =[
        'id',
        'orderBy',
        'toggle',
        'createdTime',
        'updatedTime'
    ];

    protected $fillable = [
        'categoryID',
        'name',
        'orderBy',
        'toggle'
    ];

    /* relationships */

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'categoryID', 'categoryID');
    }
}
