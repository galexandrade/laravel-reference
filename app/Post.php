<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $date = ['deleted_at'];

    //Optional => define the name of the table if the name is different
    //protected $table = 'posts';

    //Optional => define the name of the primary key if the name is different
    //protected $primaryKey = 'id';

    //It allows to create massive data
    protected $fillable = [
        'title',
        'body'
    ];

    //Returns the user that the OneToOne belongs
    public function user(){
        return $this->belongsTo('App\User');
    }

    //Polymorphic relationship
    public function photos(){
        return $this->morphMany('App\Photo','imageable');
    }
}
