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
        'name',
    ];

    public function comments()
    {
        return $this->embedsMany('\App\Models\Comment');
    }

    public function labels()
    {
        return $this->embedsMany('\App\Models\Label');
    }

}
