<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function routes() {
        return $this->hasMany('App\Route');
    }
}
