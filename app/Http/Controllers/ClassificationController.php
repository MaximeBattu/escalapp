<?php

namespace App\Http\Controllers;

use App\User;

class ClassificationController extends Controller
{
    public function index()
    {
        $users = User::orderBy('score', 'DESC')->get();
        return view('site/classification', [
            'users' => $users
        ]);
    }
}
