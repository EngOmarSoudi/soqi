<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address','county_id','created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];
    public function doctors(){
        return $this->hasMany('App\Models\doctors','hospital_id','id');
    }
}
