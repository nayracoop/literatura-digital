<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Moloquent;
use Carbon\Carbon;

class BaseModel extends Moloquent
{

 //   use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function createdTime(){

        setlocale(LC_TIME, 'es_ES.UTF-8');
        Carbon::setLocale('es');
        $mydate = Carbon::parse($this->created_at)->formatLocalized('%e de %B de %Y');
        return $mydate;
    }
}