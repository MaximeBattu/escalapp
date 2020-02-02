<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Room;
use App\Route;
use Illuminate\Support\Str;


class RoomController extends Controller
{
    /**
     *
     * @param string $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewRoom(string $roomSlug, int $id)
    {
        $room = Room::find($id);

        $computedNameRoomSlug = Str::slug($room->name_room);

        if ($computedNameRoomSlug !== $roomSlug) {
            return redirect(null, 301)->route('see_room', [
                'name_room_slug' => $computedNameRoomSlug,
                'id' => $id
            ]);
        }

        $count = Route::join('sectors', 'routes.id_sector', 'sectors.id_sector')
            ->where(['id_room' => $room->id_room, 'climbing_type' => 'V'])->count();
        $hasRoutes = $count > 0 ? true : false;

        $count = Route::join('sectors', 'routes.id_sector', 'sectors.id_sector')
            ->where(['id_room' => $room->id_room, 'climbing_type' => 'B'])->count();
        $hasBlocs = $count > 0 ? true : false;

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
        return view('admin/management-room', [
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
        return redirect()->back()->with('delete-route-succes','Vous avez supprimé la salle');
    }

    /**
     * Return view on admin/adding-room
     * Admin Management
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function seeAddRoom()
    {
        return view('admin/add-room');
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
            return redirect()->route('see_room_management')->with('add-success', 'Vous avez ajouté une nouvelle salle !');
        else
            return redirect()->back()->with('add-success',  'Vous avez ajouté une nouvelle salle !');
    }

    /**
     * @param Request $request
     * @param int $idRoom
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function ajaxUpdateRoom(Request $request, int $idRoom)
    {
        $name = json_decode($request->getContent())->name;
        $email = json_decode($request->getContent())->email;
        $address = json_decode($request->getContent())->address;

        $room = Room::find($idRoom);
        $room->name_room = $name;
        $room->email = $email;
        $room->address_room = $address;
        $room->save();

        return \response('OK', 200);
    }

}
