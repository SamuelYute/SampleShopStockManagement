<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function stock()
    {
        return $this->hasMany('App\ItemStock');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
