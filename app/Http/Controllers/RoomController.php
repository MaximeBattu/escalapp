<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Route;

class RoomController extends Controller
{
    public function viewRoom(int $id) {
        $salle = Room::all()[$id-1];
        return view('site/room', [
            "salle"=>$salle
        ]);
    }
    public function viewRoutes(int $id) {
        $routes = Route::all()->where('id_room',$id);
        return view('site/route',[
            "routes"=>$routes
        ]);
    }
}
