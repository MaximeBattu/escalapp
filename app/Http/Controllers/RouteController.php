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
    public static function returnViewByType(string $name, string $type)
    {
        $room = Room::where('name_room', $name)->first();
        $routes = Route::byRoomAndType($room->id_room, $type);

        $users = User::select('users.*')
            ->join('finished_routes', 'users.id', 'finished_routes.id_user')
            ->join('sectors', 'finished_routes.id_sector', 'sectors.id_sector')
            ->where(['sectors.climbing_type' => $type, 'sectors.id_room' => $room->id_room])->distinct()->get();

        if ($users->isNotEmpty()) {
            $scores = User::getUsersScore($users->pluck('id')->toArray());
            foreach ($users as $user) {
                $user->score = $scores[$user->id];
            }

            $users = $users->sortByDesc('score');
        }

        if (isset(Auth::user()->id)) {
            $doneByUser = Route::select('routes.*')
                ->join('finished_routes', 'finished_routes.id_route', 'routes.id_route')
                ->join('sectors', 'sectors.id_sector', 'routes.id_sector')
                ->where(['finished_routes.id_user' => Auth::user()->id, 'sectors.climbing_type' => $type])->get();

            foreach ($routes as $route) {
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

    public function seeRoutesAdmin(string $name_room, string $name_sector)
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

    public function seeAddRoutes(string $name_room, string $name_sector)
    {
        $sector = Sector::where('name', $name_sector)->first();

        return view('admin/adding-routes', [
            'sector' => $sector,
            'name_room' => $name_room
        ]);
    }

    public function addRoute(Request $request, string $name_room, string $name_sector)
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

    public function deleteRoute(string $name_room, string $name_sector, int $idroute)
    {
        Route::find($idroute)->delete();
        return redirect()->back();
    }

    public function seeUpdateRoute(string $name_room, string $name_sector, int $idroute)
    {
        $route = Route::find($idroute);
        $sector = Sector::where('name', $name_sector)->first();
        return view('admin/update-route', [
            'route' => $route,
            'sector' => $sector,
            'name_room' => $name_room
        ]);
    }

    public function updateRoute(Request $request, string $name_room, string $name_sector, int $idroute)
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

    /**
     * Function for ajax treatment on route management
     * Enable to Admin right
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function ajaxUpdateRoute(Request $request, int $id)
    {
        $color = json_decode($request->getContent())->color;
        $difficulty = json_decode($request->getContent())->difficulty;
        $score = json_decode($request->getContent())->score;

        $route = Route::find($id);
        $route->color_route = $color;
        $route->difficulty_route = $difficulty;
        $route->score_route = $score;
        $route->save();

        return \response('OK', 200);
    }
}

