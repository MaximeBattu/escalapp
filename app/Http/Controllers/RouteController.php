<?php

namespace App\Http\Controllers;

use App\FinishedRoute;
use Doctrine\DBAL\Query\QueryException;
use App\ColorRoute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Route;
use App\Room;
use App\Sector;
use App\User;
use App\LikedRoute;
use PHPUnit\Util\Color;

class RouteController extends Controller
{

    /**
     * @var Route
     * @var User
     */
    private $route;
    private $user;

    public function __construct(Route $route, User $user)
    {
        $this->route = $route;
        $this->user = $user;
    }

    public function returnViewByType(int $idRoom, string $type, array $routeExtraParameters = [])
    {
        $room = Room::find($idRoom);

        $routes = $this->route->byRoomAndType($idRoom, $type, $routeExtraParameters);
        $finishedRoutes = FinishedRoute::all();
        $routesIntiales = $this->route->byRoomAndType($idRoom, $type, []);

        $idsSector = [];
        $difficultiesRoute = [];
        $colorsName = [];
        foreach ($routesIntiales as $route => $sector) {
            $idsSector[] = $sector->id_sector;
            $difficultiesRoute[] = $sector->difficulty_route;
            $sector->color = ColorRoute::find($sector->id_color);
            $colorsName[] = $sector->color->name_color;
        }
        $sectors = Sector::findMany($idsSector)->sortBy('name');

        $users = $this->user->select('users.*')
            ->join('finished_routes', 'users.id', 'finished_routes.id_user')
            ->join('sectors', 'finished_routes.id_sector', 'sectors.id_sector')
            ->where(['sectors.climbing_type' => $type, 'sectors.id_room' => $idRoom])->distinct()->limit(20)->get();

        if ($users->isNotEmpty()) {

            $scores = $this->user->getUsersScore(
                $users->pluck('id')->toArray(),
                $sectors->pluck('id_sector')->toArray());

            foreach ($users as $user) {
                $user->score = $scores[$user->id];
            }
            $users = $users->sortByDesc('score');
        }

        foreach ($routes as $route) {
            $route->finished = false;
            $route->number_likes = 0;
            $route->liked = false;
            $route->color = null;
            $route->color_secondary = null;
            $route->first_person = null;
        }

        if (isset(Auth::user()->id)) {
            $doneByUser = Route::select('routes.*')
                ->join('finished_routes', 'finished_routes.id_route', 'routes.id_route')
                ->join('sectors', 'sectors.id_sector', 'routes.id_sector')
                ->where(['finished_routes.id_user' => Auth::user()->id, 'sectors.climbing_type' => $type])->get();

            $likedByUser = LikedRoute::where('id_user', Auth::user()->id)->get();

            foreach ($doneByUser as $done) {
                foreach ($routes as $route) {
                    if ($route->id_route == $done->id_route) {
                        $route->finished = true;
                        break;
                    }
                }
            }
            foreach ($likedByUser as $like) {
                foreach ($routes as $route) {
                    if ($route->id_route == $like->id_route && Auth::user()->id == $like->id_user) {
                        $route->liked = true;
                        break;
                    }
                }
            }
        }
        foreach ($routes as $route) {
            $route->number_likes = LikedRoute::where('id_route', $route->id_route)->count();
            $route->color = ColorRoute::find($route->id_color);
            if($route->id_color_secondary !== null) {
                $route->color_secondary = ColorRoute::find($route->id_color_secondary);
            }
        }

        foreach ($finishedRoutes as $fr) {
            foreach ($routes as $route) {
                if ($fr->id_route === $route->id_route && $route->first_person === null) {
                    $route->first_person = User::where('id', $fr->id_user)->get('firstname')->first();
                    break;
                }
            }
        }

        return [
            'routes' => $routes,
            'room' => $room,
            'users' => $users,
            'sectors' => $sectors,
            'difficulties' => array_unique($difficultiesRoute),
            'colors' => array_unique($colorsName)
        ];
    }

    public function viewRoutes(Request $request, string $roomSlugVoie, int $id)
    {
        $room = Room::find($id);

        if ($room === null) {
            return abort('404', 'Invalid value of Room id');
        }

        $computedNameRoomSlug = Str::slug($room->name_room);
        if ($computedNameRoomSlug !== $roomSlugVoie) {
            return redirect(null, 301)->route('see_routes', [
                'name_room_slug' => $computedNameRoomSlug,
                'id' => $id
            ]);
        }

        $nameSector = $request->input('sectorName');
        $colorRoute = $request->input('color');
        $difficulty = $request->input('difficulty');


        $data = $this->returnViewByType($id, 'V', [
            'name' => $nameSector,
            'id_color' => $colorRoute,
            'difficulty_route' => $difficulty
        ]);
        return view('site/route', [
            'routes' => $data['routes'],
            'room' => $data['room'],
            'users' => $data['users'],
            'sectors' => $data['sectors'],
            'difficulties' => $data['difficulties'],
            'colors' => $data['colors'],
            'selectedName' => $nameSector,
            'selectedColor' => $colorRoute,
            'selectedDifficulty' => $difficulty,
            'nb_users'=>1
        ]);
    }

    public function viewBlocs(Request $request, string $roomSlugBloc, int $id)
    {
        $room = Room::find($id);

        if ($room === null) {
            return abort('404', 'Invalid value of Room id');
        }

        $computedNameRoomSlug = Str::slug($room->name_room);
        if ($computedNameRoomSlug !== $roomSlugBloc) {
            return redirect(null, 301)->route('see_blocs', [
                'name_room_slug' => $computedNameRoomSlug,
                'id' => $id
            ]);
        }
        $nameSector = $request->input('sectorName');
        $colorRoute = $request->input('color');
        $difficulty = $request->input('difficulty');

        $data = $this->returnViewByType($id, 'B', [
            'name' => $nameSector,
            'id_color' => $colorRoute,
            'difficulty_route' => $difficulty
        ]);

        return view('site/boulder', [
            'routes' => $data['routes'],
            'room' => $data['room'],
            'users' => $data['users'],
            'sectors' => $data['sectors'],
            'difficulties' => $data['difficulties'],
            'colors' => $data['colors'],
            'selectedName' => $nameSector,
            'selectedColor' => $colorRoute,
            'selectedDifficulty' => $difficulty,
            'nb_users'=>1
        ]);
    }

    /**
     * @param string $roomSlug
     * @param int $idRoom
     * @param string $sectorSlug
     * @param int $idSector
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function seeRoutesAdmin(string $roomSlug, int $idRoom, string $sectorSlug, int $idSector)
    {
        $sector = Sector::find($idSector);
        $room = Room::find($idRoom);
        $computedNameRoomSlug = Str::slug($room->name_room);
        $computedNameSectorSlug = Str::slug($sector->name);
        if ($computedNameRoomSlug !== $roomSlug || $computedNameSectorSlug !== $sectorSlug) {
            return redirect(null, 301)->route('see_routes_admin', [
                'name_room_slug' => $computedNameRoomSlug,
                'id_room' => $idRoom,
                'name_sector_slug' => $computedNameSectorSlug,
                'id_sector' => $idSector
            ]);
        }
        $routes = $this->route->byRoomAndSector($room->id_room, $sector->id_sector);

        foreach ($routes as $route) {
            $route->color = ColorRoute::find($route->id_color);
            if($route->id_color_secondary !== null) {
                $route->color_secondary = ColorRoute::find($route->id_color_secondary);
            }
        }
        return view('admin/management-route', [
            'routes' => $routes,
            'sector' => $sector,
            'room' => $room
        ]);
    }

    /**
     * @param string $roomSlug
     * @param int $idRoom
     * @param string $sectorSlug
     * @param int $idSector
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function seeAddRoutes(string $roomSlug, int $idRoom, string $sectorSlug, int $idSector)
    {
        $room = Room::find($idRoom);
        $sector = Sector::Find($idSector);
        $computedNameRoomSlug = Str::slug($room->name_room);
        $computedNameSectorSlug = Str::slug($sector->name);
        if ($computedNameRoomSlug !== $roomSlug || $computedNameSectorSlug !== $sectorSlug) {
            return redirect(null, 301)->route('see_add_routes', [
                'name_room_slug' => $computedNameRoomSlug,
                'id_room' => $idRoom,
                'name_sector_slug' => $computedNameSectorSlug,
                'id_sector' => $idSector
            ]);
        }
        return view('admin/add-route', [
            'sector' => $sector,
            'name_room' => $sector->name,
            'room' => $room
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
     * @param int $idroute
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteRoute(int $idroute)
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
        $id_color = json_decode($request->getContent())->id_color;
        $color_code = json_decode($request->getContent())->color;
        $name_color = json_decode($request->getContent())->nameColor;
        $difficulty = json_decode($request->getContent())->difficulty;

        $color = ColorRoute::find($id_color);
        $color->code_color = trim($color_code);
        $color->name_color = trim($name_color);
        $color->save();

        $route = Route::find($id);
        $route->difficulty_route = trim($difficulty);
        $route->save();

        return \response('OK', 200);
    }

    public function ajaxAddLike(Request $request)
    {
        $idRoute = json_decode($request->getContent())->idRoute;
        $idUser = json_decode($request->getContent())->idUser;
        try {
            LikedRoute::create([
                'id_user' => $idUser,
                'id_route' => $idRoute
            ]);
        } catch (QueryException $e) {
            return \response('Conflict', 409);
        }
        return \response('OK', 200);
    }

    public function ajaxRemoveLike(Request $request)
    {
        $idRoute = json_decode($request->getContent())->idRoute;
        $idUser = json_decode($request->getContent())->idUser;

        LikedRoute::where([
            'id_route' => $idRoute,
            'id_user' => $idUser
        ])->delete();
        return \response('OK', 200);
    }

    public function ajaxAddLabels(Request $request) {
        $idRoute = json_decode($request->getContent())->idRoute;
        $labels = json_decode($request->getContent())->labels;

        $route = Route::find($idRoute);
        $route->labels = htmlspecialchars($labels);
        $route->save();
        return \response('OK', 200);
    }

}
