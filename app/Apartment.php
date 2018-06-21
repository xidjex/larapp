<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    public $timestamps = true;

    public function notes()
    {
        return $this->hasMany('App\Note');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function owners()
    {
        return $this->belongsToMany('App\Owner');
    }
}
