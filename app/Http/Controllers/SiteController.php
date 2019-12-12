<?php

namespace App\Http\Controllers;

class SiteController extends Controller
{
    public function salleView()
    {
        return view('site/salle');
    }

    public function blocView()
    {
        return view('site/bloc');
    }

    public function murView()
    {
        return view('site/wall');
    }
}
