<?php

namespace App\Models;

use App\Models\BaseModel;

class Gender extends BaseModel
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
        return $this->embedsMany('Comment');
    }

    public function labels()
    {
        return $this->embedsMany('Label');
    }

}
