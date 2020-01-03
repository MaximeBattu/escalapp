<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinishedRoute extends Model
{
    protected $fillable = ['id_route', 'id_user', 'id_room','score_contest'];
    public $incrementing = false;
}
