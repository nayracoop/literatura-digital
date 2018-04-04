<?php

namespace App\Models;

use App\Models\BaseModel;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Lang;
use Auth;
use App\Models\Enums\StoryStatus;

class Story extends BaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'description', 'typology', 'visualization', 'genre', 'cover', 'type', 'attachment', 'published_at'
    ];

    protected $dates = [
        'published_at',
        'deleted_at'
    ];

    public static $rulesPublish = [
        'title' => 'required|max:128',
        'description' => 'required|max:512',
        'typology' => 'required',
        'genre' => 'required'
    ];

    public static $rules = [
        'title' => 'max:128',
        'description' => 'max:512',
        'typology' => 'required',
        'genre' => 'required'
    ];

    public static function getMessages()
    {
        return $messages = [
          'title.max' => Lang::get('messages.title.max', ['cant' => 128]),
          'description.max' => Lang::get('messages.description.max', ['cant' => 512]),
          'typology' => 'Este campo es obligatorio',
          'genre' => 'Este campo es obligatorio'
        ];
    }

    public function author()
    {
        return $this->belongsTo('\App\User');
    }

    public function textNodes()
    {
        return $this->embedsMany('\App\Models\TextNode');
    }

    public function comments()
    {
        return $this->embedsMany('\App\Models\Comment');
    }

    public function tags()
    {
        return $this->embedsMany('\App\Models\Tag');
    }

    public function likes()
    {
        return $this->embedsMany('\App\Models\Like');
    }

    /**
    * scopeFeatured
    *
    * Nos da los relatos.
    *
    * @todo ordenados por valor de votacion
    * @author Jose Casanova <jose.casanova@nayra.coop>
    *
    * @param $count  cantidad de items a traer. Default 4
    *
    * @return Collection Story
    **/
    public function scopeFeatured($query, $count = 40)
    {
        if (Auth::check() && Auth::user()->isAdminOrMod()) {
            $stories = $query->get();
        } else {
            $stories = $query->where('status', StoryStatus::PUBLISHED)->take($count)->get();
        }
        return $stories;
    }

    /**
    * scopeGetFromAuthor
    *
    * Nos da los relatos pertenecientes al usuario solicitado.
    * @author Jose Casanova <jose.casanova@nayra.coop>
    *
    * @param $id
    *
    * @return Collection Story
    **/
    public function scopeGetFromAuthor($query, $id)
    {
        return $query->where('author_id', $id);
    }


    /**
    * scopeChoralVoices
    *
    * Si es relato coral devuelve las voces existentes.
    * @author Jose Casanova <jose.casanova@nayra.coop>
    *
    * @param $id
    *
    * @return Array
    **/
    public function choralVoices()
    {
        return $this->textNodes->unique('voice');
    }

    /**
    * scopeGetFromAuthor
    *
    * Nos da los relatos pertenecientes al tag solicitado.
    * @author Jose Casanova <jose.casanova@nayra.coop>
    *
    * @param $id
    *
    * @return Collection Story
    **/
    public function scopeGetFromTag($query, $tag)
    {
        return $query->where('tags.name', $tag);
    }

     /**
     * getAuthorName helper para nombre completo del autor
     * @return String
     */
    public function getAuthorName()
    {
        return $this->author->getName();
    }

    /**
    * countChars contamos el total de caracteres del relato
    * @return String
    */
    public function countChars()
    {
        $count = 0;
        foreach ($this->textNodes as $node) {
            $count += $node->charCount;
        }
        return $count;
    }

    /**
     *  Reader
     *
     * Envia el proceso de la histortia de acuerdo al tipo de relato
     */
    public function reader()
    {
        switch ($this->typology) {
            case 'lineal':
                # code...
            break;
            case 'temporal':
                # code...
            break;
            case 'cyowa':
                # code...
            break;
            case 'coral':
                # code...
            break;
            case 'episode':
            # code...
            break;
            default:
            # code...
            break;
        }
    }
}
