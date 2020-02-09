<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorRoute extends Model
{
    protected $table = 'colors_routes';
    protected $primaryKey = 'id_color';
    protected $fillable = ['name_color','code_color'];
}
