<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class RoomController extends Controller
{
    public function viewRoom(int $id) {
        $salle = Room::all()[$id-1];
        return view('site/room', [
            "salle"=>$salle
        ]);
    }
}
