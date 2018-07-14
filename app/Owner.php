<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    public $fillable = ['name', 'number'];
    
    public function apartments()
    {
        return $this->belongsToMany('App\Apartment');
    }
}
