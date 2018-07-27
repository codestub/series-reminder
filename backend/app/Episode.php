<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $fillable = [
        'season_id', 'title', 'number', 'release_date'
    ];

    public function season()
    {
        $this->belongsTo('App\Season');
    }
}
