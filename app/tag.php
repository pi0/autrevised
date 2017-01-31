<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    public function funds(){
        return $this->belongsToMany(fund::class);
    }

    public function relatedTags(){
        return $this->belongsToMany(tag::class, related_tag::class, 'tag_id', 'related_id');
    }
}
