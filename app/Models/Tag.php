<?php

namespace App\Models;

use App\Models\BaseModel;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Tag extends BaseModel
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name' ];

    // en realidad devuelve Stories
    // pero contienen
    // _id: nombre de la etiqueta
    // y count número de veces que fue utilizada
    public function scopeMostUsed($query, $count = 5)
    {
        return $tags = Story::raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$unwind' => '$tags'
                ],
                [
                    '$group'    => [
                        '_id'   => '$tags.name',
                        'count' => [
                            '$sum'  => 1
                        ]
                    ]
                ]
            ]);
        })->take($count);
    }
}
