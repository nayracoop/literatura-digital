<?php

namespace App\Models;

use App\Models\BaseModel;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Story extends BaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'description', 'typology', 'genre', 'cover', 'type', 'attachment', 'published_at'
    ];

    protected $dates = [
        'published_at',
    ];

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
        return $query->where('status', 'publish')->take($count)->get();
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
     * getAuthorName helper para nombre completo del autor
     * @return String
     */
    public function getAuthorName()
    {
        return $this->author->getName();
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
