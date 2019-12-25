<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Room;
use App\Route;


class AdminController extends Controller
{
    public function seeHomeAdmin() {
        return view('admin/accueil-admin');
    }

    public function seeRoomManagement() {
        $salles = Room::all();

        return view('accueil', [
            'salles' => $salles
        ]);
    }

    public function deleteRoom(int $id) {
        Room::find($id)->delete();
        return redirect()->back();
    }
}
