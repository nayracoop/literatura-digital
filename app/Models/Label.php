<?php

namespace App\Models;

use App\Models\BaseModel;

class Label extends BaseModel 
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

}
