<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function seeMyProfil(int $id)
    {
        $connectedUserId = Auth::user()->id;
        if($id !== $connectedUserId) {
            return abort(404);
        }
        $user = User::find($id);
        return view('site/profil', [
            'user' => $user
        ]);
    }
}
