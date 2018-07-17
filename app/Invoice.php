<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $fillable = [
        'invoice_number',
        'date',
        'sum',
        'notification_id',
        'data',
    ];

    public function setDataAttribute($value) {
        if (!empty($value)) {
            $value = json_encode($value);
        }

        $this->attributes['data'] = $value;
    }

    public function getDataAttribute($value) {
        return !empty($value) ? json_decode($value, true) : $value;
    }

    public function notification() {
        return $this->belongsTo('App\Notification');
    }
}
