<?php

namespace App\Models;

use App\Models\BaseModel;

class Like extends BaseModel
{
    
    public function user() {
        return $this->belongsTo('User');
    }

}
