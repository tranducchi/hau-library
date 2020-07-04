<?php

namespace App;
use App\Books;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    // get all books
    public function books(){
        return $this->hasMany('App\Books', 'cat_id');
    }
}
