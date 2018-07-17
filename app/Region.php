<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    protected $fillable = [
        'name',
    ];

    protected static $maxSize = 5;

    public static function getMaxSize() {
        return self::$maxSize;
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = !empty($value) ? ucfirst($value) : $value;
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function streets() {
        return $this->hasMany('App\Street');
    }
}
