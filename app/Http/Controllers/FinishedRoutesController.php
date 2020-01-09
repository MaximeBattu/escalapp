<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\FinishedRoute;
use App\Route;
use App\Sector;

class FinishedRoutesController extends Controller
{
    public function addValidatedRoute(int $idroom, int $id)
    {
        $idsUserFinishedRoute = FinishedRoute::all();
        $route = Route::find($id);
        $sectors = Sector::all()->where('id_room',$idroom);

        if ($idsUserFinishedRoute->isNotEmpty()) {
            foreach ($idsUserFinishedRoute as $idUserFinishedRoute) {
                if ($idUserFinishedRoute->id_user == Auth::user()->id && $idUserFinishedRoute->id_route == $id) {
                    return abort(404);
                }
            }

            FinishedRoute::create([
                'id_route' => $id,
                'id_user' => Auth::user()->id,
                'score_contest'=>$route->score_route,
                'id_room'=>$sectors[$route->id_sector-1]->id_room,
                'type_route'=>$sectors[$route->id_sector-1]->climbing_type
            ]);
        } else {
            FinishedRoute::create([
                'id_route' => $id,
                'id_user' => Auth::user()->id,
                'score_contest'=>$route->score_route,
                'id_room'=>$sectors[$route->id_sector-1]->id_room,
                'type_route'=>$sectors[$route->id_sector-1]->climbing_type
            ]);

        }

        $finishedRoute = FinishedRoute::all()->where('id_route', $id);
        return redirect()->back();
    }

    public function deleteValidatedRoute(int $idroom, int $id) {
        FinishedRoute::where('id_route',$id)->delete();

        return redirect()->back();
    }
}
