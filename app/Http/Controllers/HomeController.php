<?php

namespace App\Http\Controllers;

use App\Room;

class HomeController extends Controller
{
    /**
     * Show the application dashboard => basic redirection
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $salles = Room::all();

        return view('accueil', [
            'salles' => $salles
        ]);
    }
}
