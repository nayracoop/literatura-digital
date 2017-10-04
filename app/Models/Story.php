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
        return $this->embedsMany('\App\Models\TextNode');
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
    public function scopeMoreVoted($query, $count = 4){
        return $query->take(4)->get();
    }



}
