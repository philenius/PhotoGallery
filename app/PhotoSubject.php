<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoSubject extends Model
{
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
