<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation;

class UserController extends Controller
{
    public function seeMyProfil()
    {
        $user = User::find(Auth::user()->id);
        return view('site/profil', [
            'user' => $user
        ]);
    }

    public function seeUpdateProfile() {
        $user = User::find(Auth::user()->id);
        return view('site/update-profile', [
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request) {
        $user = User::find(Auth::user()->id);
        $name = $user->name;
        $email = $user->email;
        $password = $user->password;

        if ($request->password != null) {
            $this->validate($request, [
                'old_password' => function ($attribute, $value, $fail) {
                    if (! Hash::check($value, Auth::user()->password)) {
                        $fail('Mot de passe incorrect');
                    }
                },
                'password' => 'required|min:8|confirmed',
            ]);

            $password = Hash::make($request->password);
        }
        else {
            $name = $request->name;
            $email = $request->email;
        }

        User::find($user->id)->update([
            'name' => $name, 
            'email' => $email, 
            'password' => $password
        ]);

        return redirect()->route('update_profile')->with('updated','Changements enregistrés');
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
