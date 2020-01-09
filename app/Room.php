<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $primaryKey = 'id_room';
    protected $fillable = ['name_room','email','address_room','updated_at'];

    public function routes() {
        return $this->hasMany('App\Route');
    }
}
