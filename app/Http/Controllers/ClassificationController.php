<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ClassificationController extends Controller
{
    public function index() {
        $users = User::all();
        return view('site/classification', [
            'users'=>$users
        ]);
    }
}
