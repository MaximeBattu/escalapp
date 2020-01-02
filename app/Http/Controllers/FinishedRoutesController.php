<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\FinishedRoute;

class FinishedRoutesController extends Controller
{
    public function addValidatedRoute(int $idroom, int $id)
    {
        $idsUserFinishedRoute = FinishedRoute::all()->where('id_user', Auth::user()->id);

        if ($idsUserFinishedRoute->isNotEmpty()) {

            foreach ($idsUserFinishedRoute as $idUserFinishedRoute) {
                if ($idUserFinishedRoute->id_user == Auth::user()->id && $idUserFinishedRoute->id_route == $id) {
                    return abort(404);
                }
            }
            FinishedRoute::create([
                'id_route' => $id,
                'id_user' => Auth::user()->id,
                'id_room' => $idroom
            ]);
        } else {
            FinishedRoute::create([
                'id_route' => $id,
                'id_user' => Auth::user()->id,
                'id_room' => $idroom
            ]);
        }

        $finishedRoute = FinishedRoute::all()->where('id_route', $id);
        return redirect()->back()->with(['finishedRoute' => $finishedRoute]);
    }
}
