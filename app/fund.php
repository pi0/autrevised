<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fund extends Model
{
    //
    public function organization(){
        return $this->belongsTo(organization::class);
    }

    public function fields(){
        return $this->belongsToMany(field::class);
    }

    public function tags(){
        return $this->belongsToMany(tag::class);
    }

    public function relatedFunds(){
        return $this->belongsToMany(fund::class, 'related_funds', 'fund_id', 'related_id');
    }
}
