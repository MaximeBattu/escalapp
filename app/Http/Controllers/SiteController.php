<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class SiteController extends Controller
{
    public function index() {

        $salles = Room::all();
        dump($salles);die();

        return view("accueil", [
            'salles'=>$salles
        ]);
    }

    public function salleView() {
        return view('site/salle');
    }

    public function blocView() {
        return view('site/bloc');
    }

    public function murView() {
        return view('site/wall');
    }
}
