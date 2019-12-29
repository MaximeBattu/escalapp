<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{

    protected $primaryKey = 'id_route';
    protected $fillable = ['color_route', 'difficulty_route', 'type_route', 'url_photo', 'score_route','updated_at','id_room'];

    public function room () {
        return $this->belongsTo('App\Room');
    }
}
