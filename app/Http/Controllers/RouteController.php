<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\FinishedRoute;
use Illuminate\Http\Request;
use App\Route;
use App\Room;
use App\Sector;
use App\User;
use Illuminate\Support\Str;

class RouteController extends Controller
{

    /**
     * @var Route
     */
    private $route;

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    public function returnViewByType(int $idRoom, string $type, array $routeExtraParameters = [])
    {
        $room = Room::find($idRoom);

        $routes = $this->route->byRoomAndType($idRoom, $type, $routeExtraParameters);

        $routesIntiales = $this->route->byRoomAndType($idRoom, $type, []);

        $idsSector = [];
        $difficultiesRoute = [];
        $colorsRoute = [];
        foreach ($routesIntiales as $route => $sector) {
            $idsSector[] = $sector->id_sector;
            $difficultiesRoute[] = $sector->difficulty_route;
            $colorsRoute[] = $sector->color_route;

        }
        $sectors = Sector::findMany($idsSector);

        $users = User::select('users.*')
            ->join('finished_routes', 'users.id', 'finished_routes.id_user')
            ->join('sectors', 'finished_routes.id_sector', 'sectors.id_sector')
            ->where(['sectors.climbing_type' => $type, 'sectors.id_room' => $idRoom])->distinct()->get();

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
            'users' => $users,
            'sectors'=>$sectors,
            'difficulties' => array_unique($difficultiesRoute),
            'colors' => array_unique($colorsRoute)
        ];
    }

    public function viewRoutes(Request $request, string $roomSlugVoie, int $id)
    {
       $room = Room::find($id);

        if($room === null){
            return abort('404','Invalid value of Room id');
        }

        $computedNameRoomSlug = Str::slug($room->name_room);
        if ($computedNameRoomSlug !== $roomSlugVoie) {
            return redirect(null, 301)->route('see_routes', [
                'name_room_slug' => $computedNameRoomSlug,
                'id' => $id
            ]);
        }

        $nameSector = $request->input('sectorNameFilter');
        $colorRoute = $request->input('colorFilter');
        $difficulty = $request->input('difficultyFilter');


        $data = $this->returnViewByType($id, 'V', [
            'name'=>$nameSector,
            'color_route' => $colorRoute,
            'difficulty_route'=>$difficulty
        ]);

        return view('site/route', [
            'routes' => $data['routes'],
            'room' => $data['room'],
            'users' => $data['users'],
            'sectors'=>$data['sectors'],
            'difficulties' => $data['difficulties'],
            'colors'=>$data['colors'],
            'selectedName'=>$nameSector,
            'selectedColor' => $colorRoute,
            'selectedDifficulty'=>$difficulty
        ]);
    }

    public function viewBlocs(string $roomSlugBloc, int $id)
    {
        $room = Room::find($id);

        if($room === null){
            return abort('404','Invalid value of Room id');
        }

        $computedNameRoomSlug = Str::slug($room->name_room);
        if ($computedNameRoomSlug !== $roomSlugBloc) {
            return redirect(null, 301)->route('see_blocs', [
                'name_room_slug' => $computedNameRoomSlug,
                'id' => $id
            ]);
        }

        $data = RouteController::returnViewByType($id, 'B');

        return view('site/boulder', [
            'routesBloc' => $data['routes'],
            'room' => $data['room'],
            'users' => $data['users'],
            'sectors'=>$data['sectors'],
            'difficulties' => $data['difficulties'],
            'colors'=>$data['colors']
        ]);
    }

    /**
     * @param string $roomSlug
     * @param int $idRoom
     * @param string $sectorSlug
     * @param int $idSector
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function seeRoutesAdmin(string $roomSlug,int $idRoom, string $sectorSlug, int $idSector)
    {
        $sector = Sector::find($idSector);
        $room = Room::find($idRoom);
        $computedNameRoomSlug = Str::slug($room->name_room);
        $computedNameSectorSlug = Str::slug($sector->name);
        if ($computedNameRoomSlug !== $roomSlug || $computedNameSectorSlug !== $sectorSlug) {
            return redirect(null, 301)->route('see_routes_admin', [
                'name_room_slug' => $computedNameRoomSlug,
                'id_room' =>$idRoom,
                'name_sector_slug'=>$computedNameSectorSlug,
                'id_sector'=>$idSector
            ]);
        }
        $routes = Route::byRoomAndSector($room->id_room, $sector->id_sector);

        return view('admin/management-route', [
            'routes' => $routes,
            'sector' => $sector,
            'room' => $room
        ]);
    }

    /**
     * @param string $name_room
     * @param string $name_sector
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function seeAddRoutes(string $name_room, string $name_sector)
    {
        $sector = Sector::where('name', $name_sector)->first();

        return view('admin/add-route', [
            'sector' => $sector,
            'name_room' => $name_room
        ]);
    }

    /**
     * @param Request $request
     * @param string $name_room
     * @param string $name_sector
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Admin management
     * @param string $name_room
     * @param string $name_sector
     * @param int $idroute
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteRoute(string $name_room, string $name_sector, int $idroute)
    {
        Route::find($idroute)->delete();
        return redirect()->back();
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
        $route->color_route = trim($color);
        $route->difficulty_route = trim($difficulty);
        $route->score_route = trim($score);
        $route->save();

        return \response('OK', 200);
    }
    /*
    public function filterRoute(Request $request,string $roomSlug ,int $id) {
        $room = Room::find($id);
        $computedNameRoomSlug = Str::slug($room->name_room);
        if ($computedNameRoomSlug !== $roomSlug) {
            return redirect(null, 301)->route('filter_route', [
                'name_room_slug' => $computedNameRoomSlug,
                'id_room' => $id
            ]);
        }




        $data = RouteController::returnViewByType($id, 'V');

        $idsSector = [];
        foreach($data['sectors'] as $sector) {
            $idsSector[] = $sector->id_sector;
        }

        $routes = Route::select('routes.*')
        ->join('sectors', 'routes.id_sector', 'sectors.id_sector')
        ->whereIn('sectors.id_sector',array_unique($idsSector)); // load only sector on the room and not all

        if($nameSector !== null) {
            $routes = $routes->where('sectors.name',$nameSector);
        }
        if($colorRoute !== null) {
            $routes = $routes->where('routes.color_route',$colorRoute);
        }
        if($difficulty !== null) {
            $routes = $routes->where('routes.difficulty_route',$difficulty);
        }

        $routes = $routes->distinct()->get();

        if (isset(Auth::user()->id)) {
            $doneByUser = Route::select('routes.*')
                ->join('finished_routes', 'finished_routes.id_route', 'routes.id_route')
                ->join('sectors', 'sectors.id_sector', 'routes.id_sector')
                ->where(['finished_routes.id_user' => Auth::user()->id, 'sectors.climbing_type' => 'V'])->get();

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


        return view('site/route', [
            'routes' => $routes,
            'room' => $data['room'],
            'users' => $data['users'],
            'sectors'=>$data['sectors'],
            'difficulties' => $data['difficulties'],
            'colors'=>$data['colors']
        ]);
    }
*/
}

