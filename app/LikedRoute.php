<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikedRoute extends Model
{
    protected $fillable = ['id_user','id_route'];
}
