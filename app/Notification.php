<?php

namespace App;

use App\Services\StatusService;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $fillable = [
        'date',
        'status',
        'description',
        'client_id',
        'worker_id',
    ];

    public function changeStatus() {
        if ($this->status < StatusService::COMPLETED) {
            $this->update(['status' => $this->status + 1]);
        }
    }

    public function client() {
        return $this->belongsTo('App\User', 'client_id');
    }

    public function worker() {
        return $this->belongsTo('App\User', 'worker_id');
    }

    public function invoice() {
        return $this->hasOne('App\Invoice');
    }
}
