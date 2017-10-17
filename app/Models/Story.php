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
        'title', 'slug','description', 'typology', 'genre', 'cover', 'type', 'attachment','published_at',
    ];

    protected $dates = [
        'published_at',
    ];

    public function author() {
        return $this->belongsTo('\App\User');
    }
/*
    public function genre() {
        return $this->belongsTo('\App\Models\Genre');
    }
*/
    public function textNodes()
    {
        return $this->embedsMany('\App\Models\TextNode');
    }

    public function comments()
    {
        return $this->embedsMany('\App\Models\Comment');
    }

    public function labels()
    {
        return $this->embedsMany('\App\Models\Label');
    }
    
    public function likes()
    {
        return $this->embedsMany('\App\Models\Like');
    }

    /**
    * scopeMoreVoted
    *
    * Nos da los relatos . 
    * 
    * @todo ordenados por valor de votacion
    * @author Jose Casanova <jose.casanova@nayra.coop>
    * 
    * @param $count  cantidad de items a traer. Default 4
    *
    * @return Collection Story  
    **/
    public function scopeMoreVoted($query, $count = 40){
        return $query->take($count)->get();
    }


/**
    * scopeMoreVoted
    *
    * Nos da los relatos pertenecientes al usuario solicitado . 
    * @author Jose Casanova <jose.casanova@nayra.coop>
    * 
    * @param $id 
    *
    * @return Collection Story  
    **/

    public function scopeGetFromAuthor( $query, $id ){
        return $query->where('author_id', $id)->first();
     }


     /**
     * getAuthorName helper para nombre completo del autor
     * @return String
     */

     public function getAuthorName(){
       // $author
        return $this->author->getName();
     }

}
