<?php

namespace App\Http\Controllers;

use App\ColorRoute;
use App\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation;
use App\User;

class UserController extends Controller
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function seeMyProfil()
    {
        $user = User::find(Auth::user()->id);
        $user->score = $this->user->getUserScore($user->id)->SCORE;

        $doneByUser = Route::select('routes.*','sectors.*','rooms.*')
            ->join('finished_routes', 'finished_routes.id_route', 'routes.id_route')
            ->join('sectors', 'sectors.id_sector', 'routes.id_sector')
            ->join('rooms','rooms.id_room','sectors.id_room')
            ->where('finished_routes.id_user',Auth::user()->id)->get();

        foreach ($doneByUser as $route) {
            $route->color = null;
            $route->color = ColorRoute::where('id_color',$route->id_color)->get()->first();
        }

        return view('site/profile', [
            'user' => $user,
            'finishedRoutes'=>$doneByUser,
        ]);
    }

    public function seeUpdateProfile() {
        $user = User::find(Auth::user()->id);
        return view('site/update-profile', [
            'user' => $user
        ]);
    }

    /**
     * Enable to change password and informations (like name, email)
     * Check if old password and new password are differents
     * Check if new password and password confirmation are the same
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws Validation\ValidationException
     */
    public function updateProfile(Request $request) {

        $user = User::find(Auth::user()->id);
        $name = $user->name;
        $firstname = $user->firstname;
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
            $firstname = $request->firstname;
            $email = $request->email;
        }

        User::find($user->id)->update([
            'name' => $name,
            'firstname' => $firstname,
            'email' => $email,
            'password' => $password
        ]);
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
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

    /**
     * Delete user directly on the database
     * Admin Management
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser(int $id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('success-delete-user', 'You have deleted the user');
    }

    /**
     * Admin can make a other admin
     * Admin Management
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function modifyUser(int $id)
    {
        $name = User::find($id)->name;
        User::find($id)->update([
            'isAdmin'=>true
        ]);
        return redirect()->back()->with('add-administrator-right',$name.' is now administrator on Escalapp !');
    }

    /**
     * Admin can remove the right of administration for a administrator
     * BUT Admin can't reamove the admin right for him-self => protection : have always one administrator on the site
     * Admin Management
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeAdministratorRight(int $id) {
        $name = User::find($id)->name;
        User::find($id)->update([
            'isAdmin'=>false
        ]);
        return redirect()->back()->with('remove-administrator-right','You have removed administrator right to '.$name);
    }

    public function orderByName() {
        $users = User::orderBy('name','asc')->get();
        return view('admin/management-user', [
            'users' => $users
        ]);
    }

    public function orderByFirstname() {
        $users = User::orderBy('firstname','asc')->get();
        return view('admin/management-user', [
            'users' => $users
        ]);
    }

    public function orderByEmail() {
        $users = User::orderBy('email','asc')->get();
        return view('admin/management-user', [
            'users' => $users
        ]);
    }

    public function orderByDate() {
        $users = User::orderBy('created_at','asc')->get();
        return view('admin/management-user', [
            'users' => $users
        ]);
    }

    public function orderByAdmin() {
        $users = User::orderBy('isAdmin','asc')->get();
        return view('admin/management-user', [
            'users' => $users
        ]);
    }
}
