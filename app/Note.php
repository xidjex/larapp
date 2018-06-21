<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public $timestamps = true;

    public function apartments()
    {
        return $this->belongsTo('App\Apartment');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
