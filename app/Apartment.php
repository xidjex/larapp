<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    public $fillable = ['number', 'floor', 'entrance', 'kit', 'status', 'user_id'];
    public $timestamps = true;

    public function notes()
    {
        return $this->hasMany('App\Note');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function owners()
    {
        return $this->belongsToMany('App\Owner');
    }
    public function getMountAtAttribute($value)
    {
        return explode(' ', $value)[0];
    }
    public function getCreatedAtAttribute($value)
    {
        return explode(' ', $value)[0];
    }
}
