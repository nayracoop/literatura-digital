<?php
namespace App\Models;

use App\Models\BaseModel;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class TextNode extends BaseModel
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','slug','text', 'image', 'published_at','nodes','order','wordCount','charCount'
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

    public function likes()
    {
        return $this->embedsMany('\App\Models\Like');
    }

/*
    public function nodes()
    {
     //   return $this->hasMany('\App\Models\TextNode');
    }
*/

}
