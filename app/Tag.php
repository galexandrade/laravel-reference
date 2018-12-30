<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Reference: https://laravel.com/docs/5.7/eloquent-relationships#many-to-many-polymorphic-relations
class Tag extends Model
{
    public function posts(){
        return $this->morphedByMany('App\Post', 'taggable');
    }

    public function videos(){
        return $this->morphedByMany('App\Video', 'taggable');
    }
}
