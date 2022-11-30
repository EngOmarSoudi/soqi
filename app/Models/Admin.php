<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Contracts\Auth\Authenticatable;


class Admin extends Authenticatable
{

    use HasFactory;
    protected $table = 'admins';
    protected $fillable = [
        'name',
        'email',
        'password',

    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

//    protected $hidden = [
//        'password',
//    ];
//    protected $guard ="admin";
}
