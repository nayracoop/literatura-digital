<?php

namespace App\Models;

use App\Models\BaseModel;

class Typology extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

    public function visualizations()
    {
        return $this->embedsMany('\App\Models\Visualization');
    }
}
