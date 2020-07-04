<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GetBooks extends Model
{
    //about book
    public function aboutBook(){
        return $this->belongsTo('App\Books', 'book_id');
    }
    public function student(){
        return $this->belongsTo('App\User', 'student_id');
    }
}
