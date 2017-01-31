<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    protected $fillable = ['name'];

    public function organizations(){
        return $this->hasMany(organization::class);
    }

    public function funds(){
        return $this->hasManyThrough(fund::class, organization::class);
    }
}
