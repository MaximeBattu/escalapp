<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinishedRoute extends Model
{
    protected $fillable = ['id_route', 'id_user','score_contest','id_room'];
    public $incrementing = false;
}
