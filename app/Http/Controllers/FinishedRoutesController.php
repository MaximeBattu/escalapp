<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\FinishedRoute;
use App\Route;

class FinishedRoutesController extends Controller
{
    public function addValidatedRoute(int $idroom, int $id)
    {
        $idsUserFinishedRoute = FinishedRoute::all();

        if ($idsUserFinishedRoute->isNotEmpty()) {
            $route = Route::find($id);
            foreach ($idsUserFinishedRoute as $idUserFinishedRoute) {
                if ($idUserFinishedRoute->id_user == Auth::user()->id && $idUserFinishedRoute->id_route == $id) {
                    return abort(404);
                }
            }

            FinishedRoute::create([
                'id_route' => $id,
                'id_user' => Auth::user()->id,
                'id_room'=>$route->id_room,
                'score_contest'=>$route->score_route
            ]);
        } else {
            $route = Route::find($id);
            FinishedRoute::create([
                'id_route' => $id,
                'id_user' => Auth::user()->id,
                'id_room'=>$route->id_room,
                'score_contest'=>$route->score_route
            ]);
        }

        $finishedRoute = FinishedRoute::all()->where('id_route', $id);
        return redirect('/salle'.$idroom.'/voie')->with(['finishedRoute' => $finishedRoute]);
    }
}
