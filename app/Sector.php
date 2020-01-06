<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{

    protected $primaryKey = 'id_sector';
    protected $fillable = ['id_room','name','climbing_type'];

    public static function fromRoom(int $id_room) {
    	return Sector::all()->where('id_room', $id_room);
    }

    public static function deleteSector(int $id) {
    	Sector::find($id)->delete();
    }

    public static function add(string $name, string $type, int $id_room) {
    	Sector::create([
    		'name'=> $name,
    		'climbing_type'=> $type,
    		'id_room'=> $id_room
    	]);
    }

}
