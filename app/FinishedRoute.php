<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinishedRoute extends Model
{
    protected $casts = ['id_route' => 'int'];
    protected $fillable = ['id_route', 'id_user', 'id_sector', 'type_route'];
    public $incrementing = false;
}
