<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function seeMyProfil(int $id) {
        $user = User::all()->where('id',$id);
        return view('site/profil', [
            'user'=>$user
        ]);
    }
}
