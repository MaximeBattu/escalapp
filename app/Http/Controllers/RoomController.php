<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FinishedRoute;
use App\Room;
use App\User;


class RoomController extends Controller
{
    public function viewRoom(int $id)
    {
        $voiesContest = FinishedRoute::all()->where('id_room', $id);
        $salle = Room::find($id);

        if ($voiesContest->isNotEmpty()) {
            foreach ($voiesContest as $voieContest) {
                $idsUser[] = $voieContest->id_user;
            }
            $uniqueIdUser = array_unique($idsUser);

            $users = User::findMany($uniqueIdUser);

            return view('site/room', [
                'salle' => $salle,
                'voiesContest' => $voiesContest,
                'users'=>$users
            ]);
        } else {
            return view('site/room', [
                "salle" => $salle,
                'voiesContest' => $voiesContest,
                'users'=>null
            ]);
        }

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * See page to manage room (add room, modify room, delete room)
     * Admin Management
     */
    public function seeRoomManagement()
    {
        $salles = Room::all();

        return view('accueil', [
            'salles' => $salles
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * Delete the room clicked before
     * Admin Management
     */
    public function deleteRoom(int $id)
    {
        Room::find($id)->delete();
        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Return view on admin/adding-room
     * Admin Management
     */
    public function seeAddingRoom()
    {
        return view('admin/adding-room');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Enable to Add room to database with form (on blade.php) with XSS security
     * Admin Management
     */
    public function addRoom(Request $request)
    {
        $name = $request->input('nameRoom');
        $numberphoneRoom = $request->input('numberphoneRoom');
        $address = $request->input('addressRoom');

        Room::create([
            'name_room' => htmlspecialchars($name),
            'tel_room' => htmlspecialchars($numberphoneRoom),
            'address_room' => htmlspecialchars($address),
            'updated_at' => null
        ]);

        if ($request->submit == 'Ajouter')
            return redirect('/admin/gestion-salle')->with('add-success', 'Successful ! You have added a new room !');
        else
            return redirect()->back()->with('add-success', 'Successful ! You have added a new room !');
    }

    /***
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Load HTML page for the room clicked before (automatically generate)
     * Admin Management
     */
    public function modifyRoom(int $id)
    {
        $room = Room::find($id);
        return view('admin/update-room', [
            'room' => $room
        ]);
    }

    /**
     *  Change value of room (select by id) in the database -> replace old values by new values get on a form with post method
     * Admin Management
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateRoom(Request $request, int $id)
    {
        $name = $request->input('nameRoom');
        $numberphone = $request->input('numberphoneRoom');
        $address = $request->input('addressRoom');

        Room::find($id)->update([
            'name_room' => htmlspecialchars($name),
            'tel_room' => htmlspecialchars($numberphone),
            'address_room' => htmlspecialchars($address),
            'updated_at' => now()
        ]);

        return redirect('/admin/gestion-salle');
    }

}
