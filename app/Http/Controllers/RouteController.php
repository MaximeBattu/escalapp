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
    public function viewRoutes(string $name)
    {
        $room = Room::where('name_room', $name)->first();
        $routes = Route::byRoomAndType($room->id_room, 'V');

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
            return view('site/route', [
                'routes' => $routes,
                'room' => $room,
                'users' => $users,
                'voiesContest' => $voiesContest
            ]);
        }
    }

    /**
     * Check if id_room is the same in the URL and in the database
     * Return 404 error if not
     * @param int $idroom
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function viewSpecificRoute(int $idroom, int $id)
    {
        $route = Route::find($id);
        $finishedRoute = FinishedRoute::where([
            'id_route' => $id,
            'id_user' => Auth::user()->id
        ])->get();

        if ($idroom == $route->id_room) {
            return view('site/specificRoute', [
                "route" => $route,
                'finishedRoute' => $finishedRoute,
                'idRoom' => $idroom
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function viewBlocRoutes(string $name)
    {
        $room = Room::where('name_room', $name)->first(); // now we can get the id of the room
        $routes = Route::byRoomAndType($room->id_room, 'B');

        $idsSector = [];
        foreach ($routes as $route) {
            $idsSector[] = $route->id_sector;
        }
        $uniqueIdsSector = array_unique($idsSector); // array of ids sector without duplicate

        $roomsByIdsSector = Sector::FindMany($uniqueIdsSector); // we search all the sector by the precedent array
        $idsRoom = [];
        foreach ($roomsByIdsSector as $sect) {
            $idsRoom[] = $sect->id_room;
        }
        $uniqueIdsRoom = array_unique($idsRoom);
        $idroom = implode('', $uniqueIdsRoom); //

        $voiesContest = FinishedRoute::where(['id_room' => $idroom, 'type_route' => 'B'])->get();
        $idsUser = [];
        foreach ($voiesContest as $fr) {
            $idsUser[] = $fr->id_user;
        }

        $uniqueIdsUser = array_unique($idsUser);
        $users = User::FindMany($uniqueIdsUser);

        if (isset(Auth::user()->id)) {

            $finishedRoute = FinishedRoute::where(['id_room' => $room->id_room, 'id_user' => Auth::user()->id])->get();

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
            return view('site/bloc', [
                'routesBloc' => $routes,
                'room' => $room,
                'users' => $users,
                'voiesContest' => $voiesContest
            ]);
        } else {
            return view('site/bloc', [
                'routesBloc' => $routes,
                'room' => $room,
                'users' => $users,
                'voiesContest' => $voiesContest
            ]);
        }
    }

    public
    function viewSpecificRouteBloc(int $idroom, int $id)
    {
        $routeBloc = Route::find($id);
        return view('site/specificRouteBloc', [
            "routeBloc" => $routeBloc
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
