<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\User;


class AdminController extends Controller
{
    public function seeHomeAdmin()
    {
        return view('admin/accueil-admin');
    }

    public function seeRoomManagement()
    {
        $salles = Room::all();

        return view('accueil', [
            'salles' => $salles
        ]);
    }

    public function deleteRoom(int $id)
    {
        Room::find($id)->delete();
        return redirect()->back();
    }

    public function seeUserManagement()
    {
        $users = User::all();
        return view('admin/management-user', [
            'users' => $users
        ]);
    }

    public function seeAddingRoom()
    {
        return view('admin/adding-room');
    }

    public function addRoom(Request $request)
    {
        $name = $request->input('nameRoom');
        $numberphoneRoom = $request->input('numberphoneRoom');
        $address = $request->input('addressRoom');

        Room::create(['name_room'=>htmlspecialchars($name),
                      'tel_room'=>htmlspecialchars($numberphoneRoom),
                      'address_room'=>htmlspecialchars($address)]);
        if($request->submit == 'Ajouter')
            return redirect('/admin/gestion-salle')->with('add-success','Successful ! You have added a new room !');
        else
            return redirect()->back()->with('add-success','Successful ! You have added a new room !');
    }

    public function modifyRoom(int $id) {
        $room = Room::find($id);
        return view('admin/update-room', [
            'room'=>$room
        ]);
    }

    public function updateRoom(Request $request, int $id) {
        $name = $request->input('nameRoom');
        $numberphone = $request->input('numberphoneRoom');
        $address = $request->input('addressRoom');

        Room::find($id)->update([
            'name_room'=>htmlspecialchars($name),
            'tel_room'=>htmlspecialchars($numberphone),
            'address_room'=>htmlspecialchars($address)
        ]);

        return redirect('/admin/gestion-salle');
    }
}
