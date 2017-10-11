<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Foundation\Auth\CanResetPassword;
//use Moloquent\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
//use Jenssegers\Mongodb\Auth\PasswordResetServiceProvider as PasswordResetServiceProvider;
use App\Models\Story;

class User extends Authenticatable  
{
    
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


/*
        public function stories()
    {
        return $this->hasMany('App\Models\Story');
    }
*/

    public function getStories(){
        return Story::getFromAuthor( $this->id )->get();
    }

}
