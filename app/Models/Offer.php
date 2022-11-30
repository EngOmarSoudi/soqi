<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $table='offers';
    protected $fillable=['name_ar','name_en','price','details_ar','details_en','photo'];


    #############################local scope#############################
    public function scopeInvalid($query){
        return $query->where('name_ar','1يبس');
    }
    public function scopeInactive($query){
        return $query->where('name_ar','1يبس')->whereNull('photo');
    }
    #############################local scope#############################

    ############### Start Accessors & Mutators ######################
    public function setNameEnAttribute($val){
        $this->attributes['name_en'] = strtoupper($val);
    }
}
