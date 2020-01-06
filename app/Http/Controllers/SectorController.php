<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sector;
use App\Room;

class SectorController extends Controller
{
    public function seeAllSectors() {
        $id_room = $_GET['id'];

    	$sectors = Sector::fromRoom($id_room);
    	$room = Room::find($id_room);

    	return view('admin/sectors', [
    		'sectors' => $sectors,
    		'room' => $room
    	]);
    }

    public function deleteSector() {
        $id_sector = $_GET['id'];

    	Sector::deleteSector($id_sector);

		return redirect()->back();    	
    }

    public function seeAddSector() {
        $id_room = $_GET['id_room'];

    	return view('admin/add-sector', [
    		'room_id' => $id_room
    	]);
    }

    public function addSector(Request $request) {
        Sector::add($request->name, $request->climbing_type, $request->id_room);

    	return redirect()->route('see_sectors_admin', ['id'=>$request->id_room]);
    }
}
