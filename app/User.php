<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'name', 'class', 'department', 'date_of_birth', 'password'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // relationship

    //to get book
    public function comments()
    {
        return $this->hasMany('App\GetBooks');
    }
    public function getbooks()
    {
        return $this->hasMany('App\GetBooks', 'student_id');
    }
    public function isAdmin()
    {
        if($this->role === 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
