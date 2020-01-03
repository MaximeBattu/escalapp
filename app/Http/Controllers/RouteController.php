<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\FinishedRoute;
use Illuminate\Http\Request;
use App\Route;
use App\Room;

class RouteController extends Controller
{
    public function viewRoutes(int $id)
    {
        $idRoute = $id;
        $routes = Route::all()->where('id_room', $id);
        return view('site/route', [
            "routes" => $routes,
            'idRoute'=>$idRoute
        ]);
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
        $idRoom = $idroom;
        $route = Route::find($id);
        $finishedRoute = FinishedRoute::where([
            'id_route'=>$id,
            'id_user'=>Auth::user()->id
        ])->get();

        if($idroom == $route->id_room) {
            return view('site/specificRoute', [
                "route" => $route,
                'finishedRoute'=>$finishedRoute,
                'idRoom'=>$idroom
            ]);
        } else {
            return abort(404);
        }
    }

    public function viewBlocRoutes(int $id)
    {
        $idRoute = $id;
        $routesBloc = Route::all()->where('id_room', $id);
        return view('site/bloc', [
            "routesBloc" => $routesBloc,
            'idRoute'=>$idRoute
        ]);
    }

    public function viewSpecificRouteBloc(int $idroom, int $id)
    {
        $routeBloc = Route::find($id);
        return view('site/specificRouteBloc', [
            "routeBloc" => $routeBloc
        ]);
    }

    public function seeRoutesAdmin(int $id)
    {
        $routes = Route::all()->where('id_room', $id);
        $room = Room::find($id);
        return view('admin/routes-admin', [
            'routes' => $routes,
            'room' => $room
        ]);
    }

    public function seeAddRoutes(int $id)
    {
        $room = Room::find($id);
        return view('admin/adding-routes', [
            'room' => $room
        ]);
    }

    public function addRoute(Request $request, int $id)
    {
        $color = $request->input('colorRouteSelect');
        $type = $request->input('typeRouteSelect');
        $difficulty = $request->input('difficultySelect');
        $score = $request->input('scoreRoute');
        $url = $request->input('urlPhotoRoute');
        Route::create([
            'color_route' => $color,
            'difficulty_route' => $difficulty,
            'type_route' => $type,
            'url_photo' => $url,
            'score_route' => $score,
            'updated_at' => null,
            'id_room' => $id
        ]);

        if ($request->submit == "Ajouter et recommencer") {
            return redirect()->back()->with('succes-route', 'You have added a new route to the room number : ' . $id);
        } else {
            return redirect('/admin/gestion-salle/salle' . $id . '/voir-voie')->with('succes-route', 'You have added a new route to the room number : ' . $id);
        }
    }

    public function deleteRoute(int $id, int $idroute)
    {
        Route::find($idroute)->delete();
        return redirect()->back();
    }

    public function modifyRoute(int $id, int $idroute)
    {
        $route = Route::find($idroute);
        return view('admin/update-route', [
            'route' => $route
        ]);
    }

    public function updateRoute(Request $request, int $id, int $idroute)
    {
        $color = $request->input('colorRouteSelect');
        $type = $request->input('typeRouteSelect');
        $difficulty = $request->input('difficultySelect');
        $score = $request->input('scoreRoute');
        $url = $request->input('urlPhotoRoute');

        Route::find($idroute)->update([
            'color_route' => $color,
            'difficulty_route' => $difficulty,
            'type_route' => $type,
            'url_photo' => $url,
            'score_route' => $score,
            'updated_at' => now()
        ]);

        return redirect('admin/gestion-salle/salle' . $id . '/voir-voie')->with('modify-success', 'Modifications successful');
    }


}
