<?php

namespace App\Models;

use App\Models\BaseModel;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Like extends BaseModel
{
	//use SoftDeletes;
    /*
	*
    */
    public function user() {
        return $this->belongsTo('\App\User');
    }

}
