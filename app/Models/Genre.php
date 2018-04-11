<?php

namespace App\Models;

use App\Models\BaseModel;

class Genre extends BaseModel
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];
}
