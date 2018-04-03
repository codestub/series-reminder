<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'confirmation_token'
    ];

    protected $guarded = [
        'email_confirmed'
    ];

    protected $hidden = [
        'password', 'created_at', 'updated_at', 'confirmation_code'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('isConfirmed', function(Builder $builder) {
            $builder->where('email_confirmed', 1);
        });
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function series()
    {
        $this->belongsToMany('App\Series');
    }
}
