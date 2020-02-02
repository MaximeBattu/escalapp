<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sector;
use App\Room;
use Illuminate\Support\Str;

class SectorController extends Controller
{
    public function seeAllSectors(string $routeSlug, int $id) {
        $room = Room::find($id);
        $computedSlug = Str::slug($room->name_room);

        if ($computedSlug !== $routeSlug) {
            return redirect(null, 301)->route('see_sectors_admin', [
                'name_room_slug' => $computedSlug,
                'id' =>$id
            ]);
        }

    	$sectors = Sector::fromRoom($room->id_room);

    	return view('admin/management-sector', [
    		'sectors' => $sectors,
    		'room' => $room
    	]);
    }

    public function deleteSector() {
        $id_sector = $_GET['id'];

    	Sector::deleteSector($id_sector);

		return redirect()->back()->with('sector-deletion', 'Le secteur a été supprimé');
    }

    public function seeAddSector(string $routeSlug, int $id) {
        $room = Room::find($id);
        $computedSlug = Str::slug($room->name_room);

        if ($computedSlug !== $routeSlug) {
            return redirect(null, 301)->route('see_add_sector', [
                'name_room_slug' => $computedSlug,
                'id' =>$id
            ]);
        }
    	return view('admin/add-sector', [
    		'room' => $room
    	]);
    }

    public function addSector(Request $request, string $name) {
        $room = Room::where('name_room', $name)->first();
        Sector::add($request->name, $request->climbing_type, $room->id_room);

    	return redirect()->route('see_sectors_admin', ['name_room'=>$room->name_room]);
    }

    public function ajaxUpdateSector(Request $request, int $id) {
        $name = json_decode($request->getContent())->name_sector;

        $sector = Sector::find($id);
        $sector->name = $name;
        $sector->save();

        return \response('OK',200);
    }
}
