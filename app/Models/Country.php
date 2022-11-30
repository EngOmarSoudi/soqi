<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table= "countries";
    protected $fillable=['name','created_at','updated_at'];

    //has many through
    public function doctors()    {
    return $this->HasManyThrough('App\Models\doctors','App\Models\Hospital','countries_id','hospital_id','id','id');
    }
}
