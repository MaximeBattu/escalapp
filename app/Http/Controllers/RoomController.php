<?php

namespace App\Http\Controllers;

use App\Room;

class RoomController extends Controller
{
    public function viewRoom(int $id)
    {
        $salle = Room::find($id);
        return view('site/room', [
            "salle" => $salle
        ]);
    }

}
