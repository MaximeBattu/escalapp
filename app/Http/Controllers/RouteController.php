<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Route;
use App\Room;

class RouteController extends Controller
{
    public function viewRoutes(int $id)
    {
        $routes = Route::all()->where('id_room', $id);
        return view('site/route', [
            "routes" => $routes
        ]);
    }

    public function viewSpecificRoute(int $id)
    {
        $route = Route::find($id);
        return view('site/specificRoute', [
            "route" => $route
        ]);
    }

    public function viewBlocRoutes(int $id)
    {
        $routesBloc = Route::all()->where('id_room', $id);
        return view('site/bloc', [
            "routesBloc" => $routesBloc
        ]);
    }

    public function viewSpecificRouteBloc(int $id)
    {
        $routeBloc = Route::all()->where('id_route', $id);
        return view('site/specificRouteBloc', [
            "routeBloc" => $routeBloc
        ]);
    }

    public function seeRoutesAdmin(int $id) {
        $routes = Route::all()->where('id_room',$id);
        $room = Room::find($id);
        return view('admin/routes-admin', [
            'routes'=>$routes,
            'room'=>$room
        ]);
    }

    public function seeAddRoutes(int $id) {
        $room = Room::find($id);
        return view('admin/adding-routes', [
            'room'=>$room
        ]);
    }

    public function addRoute(Request $request, int $id) {
        $color = $request->input('colorRouteSelect');
        $type = $request->input('typeRouteSelect');
        $difficulty = $request->input('difficultySelect');
        $score = $request->input('scoreRoute');
        $url = $request->input('urlPhotoRoute');
        Route::create([
            'color_route'=>$color,
            'difficulty_route'=>$difficulty,
            'type_route'=>$type,
            'url_photo'=>$url,
            'score_route'=>$score,
            'updated_at'=>null,
            'id_room'=>$id
        ]);

        if($request->submit == "Ajouter et recommencer") {
            return redirect()->back()->with('succes-route','You have added a new route to the room number : ' . $id);
        } else {
            return redirect('/admin/gestion-salle/salle'.$id.'/voir-voie')->with('succes-route','You have added a new route to the room number : ' . $id);
        }
    }

    public function deleteRoute(int $id,int $idroute) {
        Route::find($idroute)->delete();
        return redirect()->back();
    }

    public function modifyRoute(int $id, int $idroute) {
        $route = Route::find($idroute);
        return view('admin/update-route', [
            'route'=>$route
        ]);
    }

    public function updateRoute(Request $request, int $id, int $idroute) {
        $color = $request->input('colorRouteSelect');
        $type = $request->input('typeRouteSelect');
        $difficulty = $request->input('difficultySelect');
        $score = $request->input('scoreRoute');
        $url = $request->input('urlPhotoRoute');

        Route::find($idroute)->update([
            'color_route'=>$color,
            'difficulty_route'=>$difficulty,
            'type_route'=>$type,
            'url_photo'=>$url,
            'score_route'=>$score,
            'updated_at'=>now()
        ]);

        return redirect('admin/gestion-salle/salle'.$id.'/voir-voie')->with('modify-success','Modifications successful');
    }
}
