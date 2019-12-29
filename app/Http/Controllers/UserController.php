<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function seeMyProfil()
    {
        $user = User::find(Auth::user()->id);
        return view('site/profil', [
            'user' => $user
        ]);
    }

    /**
     * See page to manage users (delete, make admin)
     * Admin Management
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function seeUserManagement()
    {
        $users = User::all();
        return view('admin/management-user', [
            'users' => $users
        ]);
    }
}
