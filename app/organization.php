<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class organization extends Model
{
    //
    protected $fillable = ['name', 'country_id'];
    public function funds(){
        return $this->hasMany(fund::class);
    }

    public function country(){
        return $this->belongsTo(country::class);
    }
}
