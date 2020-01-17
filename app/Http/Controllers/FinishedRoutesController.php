<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\FinishedRoute;
use App\Route;
use App\Sector;

class FinishedRoutesController extends Controller
{
    public function addValidatedRoute($name, int $id)
    {
        $idsUserFinishedRoute = FinishedRoute::all();
        $route = Route::find($id);

        $sectors = Sector::select('sectors.*')
                        ->join('rooms', 'sectors.id_room', '=', 'rooms.id_room')
                        ->where('rooms.name_room', $name)->get();

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

    public function deleteValidatedRoute(string $name, int $id) {
        FinishedRoute::where(['id_route'=>$id, 'id_user'=>Auth::user()->id])->delete();

        return redirect()->back();
    }
}
