<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $fillable = [
        'imdbId', 'total_seasons', 'image', 'title'
    ];
    
    public function users()
    {
        $this->belongsToMany('App\User');
    }

    public function seasons()
    {
        $this->hasMany('App\Season');
    }
}
