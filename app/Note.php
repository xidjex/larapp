<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public $fillable = ['note', 'user_id', 'apartment_id'];
    public $timestamps = true;

    public function apartments()
    {
        return $this->belongsTo('App\Apartment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
