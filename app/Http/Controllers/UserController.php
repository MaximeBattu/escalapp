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

    public function deleteUser(int $id)
    {
        $name = User::find($id)->name;
        User::find($id)->delete();
        return redirect()->back()->with('success-delete-user', 'You have deleted a user : ' . $name);
    }

    public function modifyUser(int $id)
    {
        $name = User::find($id)->name;
        User::find($id)->update([
            'isAdmin'=>true
        ]);
        return redirect()->back()->with('add-administrator-right',$name.' is now administrator on Escalapp !');
    }

    public function removeAdministratorRight(int $id) {
        $name = User::find($id)->name;
        User::find($id)->update([
            'isAdmin'=>false
        ]);
        return redirect()->back()->with('remove-administrator-right','You have removed administrator right to '.$name);
    }
}
