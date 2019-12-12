<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{

    protected $primaryKey = 'id_route';

    public function room () {
        return $this->belongsTo('App\Room');
    }
}
