<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    //OneToOne
    public function post(){
        //By default it looks for a user_id
        return $this->hasOne('App\Post');

        //To specify a field use the second parameter
        //return $this->hasOne('App\Post', 'the_user_id');
    }

    //OneToMany
    public function posts(){
        return $this->hasMany('App\Post');
    }

    //ManyToMany
    public function roles(){
        //Looks for a role_user table
        return $this->belongsToMany('App\Role');

        //Specify the table name and some parameters
        //return $this->belongsToMany('App\Role', 'user_roles', 'user_id', 'role_id');
    }

    //Polymorphic relationship
    public function photos(){
        return $this->morphMany('App\Photo','imageable');
    }
}
