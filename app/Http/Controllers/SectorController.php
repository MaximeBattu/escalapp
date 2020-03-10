<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sector;
use App\Room;
use Illuminate\Support\Str;

class SectorController extends Controller
{
    /**
     * @var Sector
     */
    private $sector;

    public function __construct(Sector $sector)
    {
        $this->sector = $sector;
    }

    /**
     * Admin Management
     * @param string $routeSlug : slug of the name route
     * @param int $id : id of the room
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function seeAllSectors(string $routeSlug, int $id)
    {
        $room = Room::find($id);
        $computedSlug = Str::slug($room->name_room);

        if ($computedSlug !== $routeSlug) {
            return redirect(null, 301)->route('see_sectors_admin', [
                'name_room_slug' => $computedSlug,
                'id' => $id
            ]);
        }

        $sectors = $this->sector->fromRoom($room->id_room);

        return view('admin/management-sector', [
            'sectors' => $sectors,
            'room' => $room
        ]);
    }

    /**
     * Admin Management
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSector(int $idSector)
    {
        $this->sector->find($idSector)->delete();
        return redirect()->back()->with('sector-deletion', 'Le secteur a été supprimé');
    }

    /**
     * Admin Management
     * @param string $routeSlug : slug of the name route
     * @param int $id : id of the room
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function seeAddSector(string $routeSlug, int $id)
    {
        $room = Room::find($id);
        $computedSlug = Str::slug($room->name_room);

        if ($computedSlug !== $routeSlug) {
            return redirect(null, 301)->route('see_add_sector', [
                'name_room_slug' => $computedSlug,
                'id' => $id
            ]);
        }
        return view('admin/add-sector', [
            'room' => $room
        ]);
    }

    /**
     * Admin Management
     * @param Request $request
     * @param int $id : id of the room
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addSector(Request $request, int $id)
    {
        $room = Room::find($id);
        $computedRoomSlug = Str::slug($room->name_room);
        $this->sector->add($request->name, $request->climbing_type, $id);
        if ($request->submit == 'Ajouter') {
            return redirect()->route('see_sectors_admin', ['name_room_slug' => $computedRoomSlug, 'id' => $id]);
        }
    }

    public function ajaxUpdateSector(Request $request, int $id)
    {
        $name = json_decode($request->getContent())->name_sector;

        $sector = Sector::find($id);
        $sector->name = trim($name);
        $sector->save();

        return \response('OK', 200);
    }
}
