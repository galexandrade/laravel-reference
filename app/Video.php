<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //Polymorphic relationship
    public function tags(){
        return $this->morphToMany('App\Tag','taggable');
    }
}
