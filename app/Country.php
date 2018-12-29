<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function posts(){
        /*
         * Parameters:
         * 1 - The Model that is going to be requested
         * 2 - The Model that has the country ID
         * 3 - Optional - The column name for country_id in parameter 2 (User)
         * 4 - Optional - The column name for user_id in parameter 1 (Post)
         */
        return $this->hasManyThrough('App\Post', 'App\User');
    }
}
