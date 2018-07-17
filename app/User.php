<?php

namespace App;

use App\Services\RoleService;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'role',
        'phone_number',
        'house_number',
        'street_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];

    public function setRoleAttribute($value) {
        if (empty($value) && $value != 0) {
            $value = RoleService::CLIENT;
        }
        $this->attributes['role'] = $value;
    }

    public function hasRole($key) {
        return (auth()->user()->role <= $key);
    }

    public function street() {
        return $this->belongsTo('App\Street');
    }

    public function regions() {
        return $this->belongsToMany('App\Region');
    }

    public function car() {
        return $this->hasOne('App\Car')->orderBy('updated_at', 'desc');
    }
}
