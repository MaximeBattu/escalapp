<?php

namespace App\Http\Controllers;

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

        $updt_users = $route->nb_user_done+1;
        $updt_score = 1000/$updt_users >= 1 ? 1000/$updt_users : 1; 

        FinishedRoute::create([
            'id_route' => $id,
            'id_user' => Auth::user()->id,
            'id_sector' => $sector->id_sector,
            'type_route' => $sector->climbing_type
        ]);

        Route::where('id_route',$id)
            ->update([
                'nb_user_done'=>$updt_users,
                'score_route'=>$updt_score
            ]);

        return redirect()->back();
    }

    public function deleteValidatedRoute(int $id)
    {
        FinishedRoute::where(['id_route' => $id, 'id_user' => Auth::user()->id])->delete();

        $route = Route::find($id);

        $updt_users = $route->nb_user_done-1;
        $updt_score = $updt_users >= 1 ? 1000/$updt_users : 1000;

        Route::where('id_route',$id)
            ->update([
                'nb_user_done'=>$updt_users,
                'score_route'=>$updt_score
            ]);

        return redirect()->back();
    }
}
