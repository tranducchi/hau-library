<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    // category

    public function category()
    {
        return $this->belongsTo('App\Categories', 'cat_id');
    }
    public function getBooks(){
        return $this->hasMany('App\GetBooks');
    }
}
