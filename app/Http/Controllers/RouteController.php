<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\FinishedRoute;
use Illuminate\Http\Request;
use App\Route;
use App\Room;
use App\Sector;
use App\User;

class RouteController extends Controller
{
    public static function returnViewByType(string $name, string $type) {

        $room = Room::where('name_room', $name)->first();
        $routes = Route::byRoomAndType($room->id_room, $type);


        $users = User::select('users.*')
                        ->join('finished_routes', 'finished_routes.id_user', '=', 'users.id')
                        ->join('sectors', 'sectors.id_room', '=', $room->id_room)
                        ->where('sectors.climbing_type', $type)->distinct()->get();

        $doneByUser = null;
        if(isset(Auth::user()->id)) {
            $doneByUser = Route::select('routes.*')
                ->join('finished_routes', 'finished_routes.id_route', '=', 'routes.id_route')
                ->join('sectors', 'sectors.id_sector', '=', 'sectors.id_sector')
                ->where(['finished_routes.id_user'=>Auth::user()->id, 'sectors.climbing_type'=>$type])->get();
        }

        foreach($routes as $route) {
            $route->finished = false;
        }

        foreach ($doneByUser as $done) {
            foreach ($routes as $route) {
                if ($route->id_route == $done->id_route) {
                    $route->finished = true;
                    break;
                }
            }
        }

        return [
                'routes' => $routes,
                'room' => $room,
                'users' => $users
            ];
    }

    public function viewRoutes(string $name)
    {
        $data = RouteController::returnViewByType($name, 'V');

        return view('site/route', [
            'routes' => $data['routes'],
            'room' => $data['room'],
            'users' => $data['users']
        ]);
    }

    public function viewBlocs(string $name)
    {
        $data = RouteController::returnViewByType($name, 'B');

        return view('site/bloc', [
            'routesBloc' => $data['routes'],
            'room' => $data['room'],
            'users' => $data['users']
        ]);
    }

    public
    function seeRoutesAdmin(string $name_room, string $name_sector)
    {
        $sector = Sector::where('name', $name_sector)->first();
        $room = Room::where('name_room', $name_room)->first();
        $routes = Route::byRoomAndSector($room->id_room, $sector->id_sector);

        return view('admin/routes-admin', [
            'routes' => $routes,
            'sector' => $sector,
            'room' => $room
        ]);
    }

    public
    function seeAddRoutes(string $name_room, string $name_sector)
    {
        $sector = Sector::where('name', $name_sector)->first();

        return view('admin/adding-routes', [
            'sector' => $sector,
            'name_room' => $name_room
        ]);
    }

    public
    function addRoute(Request $request, string $name_room, string $name_sector)
    {
        $color = $request->input('colorRouteSelect');
        $difficulty = $request->input('difficultySelect');
        $url = $request->input('urlPhotoRoute');

        $sector = Sector::where('name', $name_sector)->first();

        Route::create([
            'id_sector' => $sector->id_sector,
            'color_route' => $color,
            'difficulty_route' => $difficulty,
            'url_photo' => $url,
            'updated_at' => null
        ]);

        if ($request->submit == "Ajouter et recommencer") {
            return redirect()->back()->with('succes-route', 'You have added a new route to the sector number : ' . $sector->id_sector);
        } else {
            return redirect()->route('see_routes_admin', [
                'name_room' => $name_room,
                'name_sector' => $sector->name
            ]);
        }
    }

    public
    function deleteRoute(string $name_room, string $name_sector, int $idroute)
    {
        Route::find($idroute)->delete();
        return redirect()->back();
    }

    public
    function seeUpdateRoute(string $name_room, string $name_sector, int $idroute)
    {
        $route = Route::find($idroute);
        $sector = Sector::where('name', $name_sector)->first();
        return view('admin/update-route', [
            'route' => $route,
            'sector' => $sector,
            'name_room' => $name_room
        ]);
    }

    public
    function updateRoute(Request $request, string $name_room, string $name_sector, int $idroute)
    {
        $color = $request->input('colorRouteSelect');
        $difficulty = $request->input('difficultySelect');
        $url = $request->input('urlPhotoRoute');

        $sector = Sector::where('name', $name_sector)->first();
        $room = Room::where('name_room', $name_room)->first();

        Route::find($idroute)->update([
            'color_route' => $color,
            'difficulty_route' => $difficulty,
            'url_photo' => $url,
            'updated_at' => now()
        ]);

        return redirect()->route('see_routes_admin', [
            'name_room' => $room->name_room,
            'name_sector' => $sector->name
        ]);
    }
}

/*
$idsSector = [];
        foreach ($routes as $route) {
            $idsSector[] = $route->id_sector;
        }
        $uniqueIdsSector = array_unique($idsSector);

        $roomsByIdsSector = Sector::FindMany($uniqueIdsSector);
        $idsRoom = [];
        foreach ($roomsByIdsSector as $sect) {
            $idsRoom[] = $sect->id_room;
        }
        $uniqueIdsRoom = array_unique($idsRoom);
        $idroom = implode('', $uniqueIdsRoom);


        $voiesContest = FinishedRoute::where(['id_room' => $idroom, 'type_route' => 'V'])->get();
        $idsUser = [];
        foreach ($voiesContest as $fr) {
            $idsUser[] = $fr->id_user;
        }

        $uniqueIdsUser = array_unique($idsUser);
        $users = User::FindMany($uniqueIdsUser);

        if (isset(Auth::user()->id)) {

            $finishedRoute = FinishedRoute::where(['id_room' => $idroom, 'id_user' => Auth::user()->id])->get();

            foreach ($routes as $route) {
                $route->finished = false;
            }

            foreach ($finishedRoute as $fr) {
                foreach ($routes as $route) {
                    if ($route->id_route === $fr->id_route) {
                        $route->finished = true;
                        break;
                    }
                }
            }

            if ($voiesContest->isEmpty()) {
                $voiesContest = null;
            }
            return view('site/route', [
                'routes' => $routes,
                'room' => $room,
                'users' => $users,
                'voiesContest' => $voiesContest
            ]);
        } else {

        }
*/

