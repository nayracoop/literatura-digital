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
        'title', 'description', 'cover', 'type', 'attachment', 'published_at',
    ];

    protected $dates = [
        'published_at',
    ];

    public function gender() {
        return $this->belongsTo('Gender');
    }

    public function textNodes()
    {
        return $this->embedsMany('TextNode');
    }

    public function comments()
    {
        return $this->embedsMany('Comment');
    }

    public function labels()
    {
        return $this->embedsMany('Label');
    }
    
    public function likes()
    {
        return $this->embedsMany('Like');
    }

}
