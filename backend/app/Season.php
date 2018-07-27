<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $fillable = [
        'series_id', 'number'
    ];

    public function series()
    {
        $this->belongsTo('App\Series');
    }

    public function episodes()
    {
        $this->hasMany('App\Episode');
    }
}
