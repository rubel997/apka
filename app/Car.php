<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{

    protected $fillable = [
        'car_number',
        'from_date',
        'to_date',
        'user_id',
    ];

    public function rent($user) {
        if (empty($this->from_date) && empty($this->to_date)) {
            $save = [
                'from_date' => new Carbon(),
                'user_id' => $user->id
            ];
        } else if (!empty($this->from_date) && empty($this->to_date)) {
            $save = [
                'to_date' => new Carbon(),
                'user_id' => $user->id
            ];
        } else {
            $save = [
                'from_date' => new Carbon(),
                'to_date' => null,
                'user_id' => $user->id
            ];
        }

        $this->update($save);
    }

    public function isRent() {
        if (empty(auth()->user()->car)) {
            if (empty($this->from_date) || (!empty($this->from_date) && !empty($this->to_date))) {
                return true;
            }
        } else {
            if (!empty(auth()->user()->car->to_date)) {
                if (empty($this->from_date) || (!empty($this->from_date) && !empty($this->to_date))) {
                    return true;
                }
            } else if (auth()->user()->car->id == $this->id) {
                return true;
            }

        }

        return false;
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
