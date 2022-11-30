<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table="services";
    protected $fillable=['id','name','created_at','updated_at'];
    protected $hidden=['created_at','updated_at','pivot'];
    protected $timestamp =false;

    public function doctors(){
        return $this->belongsToMany('App\Models\doctors','doctor_service','service_id','doctor_id','id','id');
    }
}
