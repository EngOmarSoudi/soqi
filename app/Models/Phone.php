<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    protected $table="phones";
    protected $fillable=['user_id','code','phonecol'];
    protected $hidden=['user_id'];
    protected $timestamp=false;


    ############### Begin Relations ##############
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
    ############### End Relations ################
}
