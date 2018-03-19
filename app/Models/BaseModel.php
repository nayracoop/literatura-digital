<?php

namespace App\Models;

use Moloquent;
use Carbon\Carbon;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class BaseModel extends Moloquent
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
