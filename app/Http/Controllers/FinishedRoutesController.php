<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\FinishedRoute;
use App\Route;
use App\Sector;

class FinishedRoutesController extends Controller
{
    public function addValidatedRoute(string $name, int $id)
    {
        $route = Route::find($id);
        $sector = Sector::find($route->id_sector);

        $check = FinishedRoute::where(['id_route'=>$id, 'id_user'=>Auth::user()->id])->get();

        if (count($check) == 0) {
            FinishedRoute::create([
                'id_route' => $id,
                'id_user' => Auth::user()->id,
                'id_sector' => $sector->id_sector,
                'type_route'=>$sector->climbing_type
            ]);            
        }

        return redirect()->back();
    }

    public function deleteValidatedRoute(string $name, int $id) {
        FinishedRoute::where(['id_route'=>$id, 'id_user'=>Auth::user()->id])->delete();

        return redirect()->back();
    }
}
