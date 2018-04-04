<?php
namespace App\Models;

use App\Models\BaseModel;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Lang;

class TextNode extends BaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'title', 'slug', 'text', 'image', 'published_at', 'nodes', 'order', 'wordCount', 'charCount'
    ];

    protected $dates = [
        'published_at',
    ];

    public static $rulesPublish = [
        'title' => 'required|max:128',
    ];

    public static $rules = [
        'title' => 'max:128',
    ];

    public static function getMessages()
    {
        return $messages = [
          'title.max' => Lang::get('messages.title.max', ['cant' => 128]),
          'title.required' => Lang::get('messages.title.required'),
        ];
    }


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
}
