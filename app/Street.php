<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{

    protected $fillable = [
        'name',
        'region_id',
    ];

    public function setNameAttribute($value) {
        $this->attributes['name'] = !empty($value) ? ucfirst($value) : $value;
    }

    public function users() {
        return $this->hasMany('App\User');
    }

    public function region() {
        return $this->belongsTo('App\Region');
    }
}
