<?php

namespace App\Models;

use App\Models\BaseModel;

class Story extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'text', 'image', 'published_at',
    ];

    protected $dates = [
        'published_at',
    ];

    public function comments()
    {
        return $this->embedsMany('Comments');
    }

    public function labels()
    {
        return $this->embedsMany('Label');
    }

}
