<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Room;
use App\Route;


class RoomController extends Controller
{
    /**
     *
     * @param string $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewRoom(string $name)
    {
        $room = Room::where('name_room', $name)->first();

        $count = Route::join('sectors', 'routes.id_sector', 'sectors.id_sector')
                        ->where(['id_room'=>$room->id_room,'climbing_type'=>'V'])->count();
        $hasRoutes = $count > 0 ? true : false;


        $count = Route::join('sectors', 'routes.id_sector', 'sectors.id_sector')
                        ->where(['id_room'=>$room->id_room,'climbing_type'=>'B'])->count();
        $hasBlocs = $count > 0 ? true: false;

        return view('site/room', [
            "room" => $room,
            "hasRoutes" => $hasRoutes,
            "hasBlocs" => $hasBlocs
        ]);
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
     * Delete the room clicked before
     * Admin Management
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteRoom(int $id)
    {
        Room::find($id)->delete();
        return redirect()->back();
    }

    /**
     * Return view on admin/adding-room
     * Admin Management
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function seeAddingRoom()
    {
        return view('admin/adding-room');
    }

    /**
     * Enable to Add room to database with form (on blade.php) with XSS security
     * Admin Management
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addRoom(Request $request)
    {
        $name = $request->input('nameRoom');
        $email = $request->input('emailRoom');
        $address = $request->input('addressRoom');

        try {
            Room::create([
                'name_room' => htmlspecialchars($name),
                'email' => htmlspecialchars($email),
                'address_room' => htmlspecialchars($address),
                'updated_at' => null
            ]);
        } catch (QueryException $ex) {
            return redirect()->back()->with('add_failure', 'La salle existe déjà');
        }

        if ($request->submit == 'Ajouter')
            return redirect()->route('see_room_management')->with('add-success', 'Successful ! You have added a new room !');
        else
            return redirect()->back()->with('add-success', 'Successful ! You have added a new room !');
    }

    /***
     * Load HTML page for the room clicked before (automatically generate)
     * Admin Management
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
        $email = $request->input('emailRoom');
        $address = $request->input('addressRoom');

        Room::find($id)->update([
            'name_room' => htmlspecialchars($name),
            'email' => htmlspecialchars($email),
            'address_room' => htmlspecialchars($address),
            'updated_at' => now()
        ]);

        return redirect()->route('see_room_management');
    }

    public function ajaxUpdate(Request $request) {
        $body = $request->getContent();
        $idRoom = json_decode($body)->id;
        $name = json_decode($body)->name;

        $room = Room::find($idRoom);
        $room->name_room = $name;
        $room->save();

        return \response('OK',200);
    }

}
