<?php
namespace App\Models;

use App\Models\BaseModel;

class TextNode extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','slug','text', 'image', 'published_at',
    ];

    protected $dates = [
        'published_at',
    ];

    public function comments()
    {
        return $this->embedsMany('\App\Models\Comment');
    }

    public function labels()
    {
        return $this->embedsMany('\App\Models\Label');
    }

    public function story()
    {
        return $this->belongsTo('\App\Models\Story');
    }


}
