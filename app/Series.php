<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    public function users()
    {
        $this->belongsToMany('App\User');
    }
}
