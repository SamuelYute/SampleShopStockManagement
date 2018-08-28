<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemStock extends Model
{
    //

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function scopeStatus($query,$status)
    {
        return $query->where('status',$status);
    }

}
