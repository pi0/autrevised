<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class field extends Model
{
    protected $fillable = ['title'];
    public function funds(){
        return $this->belongsToMany(fund::class);
    }
}
