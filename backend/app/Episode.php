<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $fillable = [
        'seasonId', 'title', 'number', 'date'
    ];

    public function season()
    {
        $this->belongsTo('App\Season');
    }
}
