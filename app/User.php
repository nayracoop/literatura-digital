<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Foundation\Auth\CanResetPassword;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use App\Models\Story;
use App\Models\UserType;

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
        'username', 'first_name', 'last_name', 'email', 'password', 'role', 'avatar', 'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'username' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:6',
    ];

    /**
     * getStories nos da los relatos pertenecientes al usuario instanciado
     * @return collection
     */
    public function getStories()
    {
        return Story::getFromAuthor($this->getIdAttribute())->get();
    }

    /**
     * getAuthorName helper para nombre completo del autor
     * @return String
     */
    public function getName()
    {
       // $author
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * Comentarios sobre el autor
     *
     */
    public function comments()
    {
        return $this->embedsMany('\App\Models\Comment');
    }

    /**
     * isAdminOrMod devuelve si es administrador o moderador
     * @return String
     */
    public function isAdminOrMod()
    {
        return $this->role == UserType::ADMIN || $this->role == UserType::MOD;
    }
}
