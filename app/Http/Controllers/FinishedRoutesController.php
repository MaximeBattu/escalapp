<?php

namespace Http\Controllers;

use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Facades\Auth;
use App\FinishedRoute;
use App\Route;
use App\Sector;

class FinishedRoutesController extends Controller
{
    public function addValidatedRoute(int $id)
    {
        $route = Route::find($id);
        $sector = Sector::find($route->id_sector);

        try {
            FinishedRoute::create([
                'id_route' => $id,
                'id_user' => Auth::user()->id,
                'id_sector' => $sector->id_sector,
                'type_route' => $sector->climbing_type
            ]);
        } catch (QueryException $e) {
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function deleteValidatedRoute(int $id)
    {
        FinishedRoute::where(['id_route' => $id, 'id_user' => Auth::user()->id])->delete();

        return redirect()->back();
    }
}
