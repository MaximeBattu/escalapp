<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Sector extends Model
{

    protected $primaryKey = 'id_sector';
    protected $fillable = ['id_room','name','climbing_type','updated_at'];

    public function fromRoom(int $id_room) {
    	return Sector::all()->where('id_room', $id_room);
    }

    public function deleteSector(int $id) {
    	Sector::find($id)->delete();
    }

    public function add(string $name, string $type, int $id_room) {
        try {
            Sector::create([
                'name'=> $name,
                'climbing_type'=> $type,
                'id_room'=> $id_room,
                'updated_at'=>null
            ]);
        } catch (QueryException $e) {
            return redirect()->back()->with('add_sector_failure', 'Le secteur existe déjà');
        }
    }
}
