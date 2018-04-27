<?php

namespace App\Models;

use App\Models\BaseModel;

class Comment extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'published_at',
    ];

    protected $dates = [
        'published_at',
    ];

    protected static $rules = [
        'content' => 'required|min:1|max:160'
    ];

    public static function getRules()
    {
        return self::$rules;
    }

    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}
