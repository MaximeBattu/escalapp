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


        Room::create(['name_room'=>$name,
                      'tel_room'=>$numberphoneRoom,
                      'address_room'=>$address]);
        if($request->submit == 'Ajouter')
            return redirect('/admin/gestion-salle')->with('add-success','Successful ! You have adding a new room !');
        else
            return redirect()->back()->with('add-success','Successful ! You have adding a new room !');
    }
}
