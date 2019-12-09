<?php

namespace App\Http\Controllers;

use App\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function viewRoutes(int $id) {
        $routes = Route::all()->where('id_room',$id);
        return view('site/route',[
            "routes"=>$routes
        ]);
    }

    public function viewSpecificRoute(int $id) {
        $route = Route::all()->where('id_route',$id);
        return view('site/specificRoute',[
            "route"=>$route
        ]);
    }

    public function viewBlocRoutes(int $id) {
        $routesBloc = Route::all()->where('id_room',$id);
        return view('site/bloc',[
            "routesBloc"=>$routesBloc
        ]);
    }

    public function viewSpecificRouteBloc(int $id) {
        $routeBloc = Route::all()->where('id_route',$id);
        return view('site/specificRouteBloc',[
            "routeBloc"=>$routeBloc
        ]);
    }
}
