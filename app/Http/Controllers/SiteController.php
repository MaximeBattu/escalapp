<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index() {
        return view("accueil");
    }

    public function salleView() {
        return view('site/salle');
    }

    public function blocView() {
        return view('site/bloc');
    }
}