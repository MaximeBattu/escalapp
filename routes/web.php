<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route("see_home");
});

Auth::routes();

Route::get('/accueil', 'HomeController@index')->name('see_home');

Route::get('/admin/accueil', 'AdminController@index')->name('see_home_admin')->middleware('auth', 'admin');

// GESTION SALLES
Route::get('/admin/gestion-salle', 'RoomController@seeRoomManagement')->name('see_room_management')->middleware('auth', 'admin');
Route::get('/admin/gestion-salle/supprimmer/{id}', 'RoomController@deleteRoom')->name('delete_room')->middleware('auth', 'admin');
Route::get('/admin/gestion-salle/modifier/{id}', 'RoomController@modifyRoom')->name('modify_room')->middleware('auth','admin');
Route::post('/admin/gestion-salle/modifier/{id}', 'RoomController@updateRoom')->name('update_room')->middleware('auth','admin');
Route::get('/admin/gestion-salle/ajouter', 'RoomController@seeAddingRoom')->name('see_adding_room')->middleware('auth', 'admin');
Route::post('/admin/gestion-salle/ajouter', 'RoomController@addRoom')->name('add_room')->middleware('auth', 'admin');
Route::get('/admin/gestion-salle/salle{id}/voir-voie','RouteController@seeRoutesAdmin')->name('see_routes_admin')->middleware('auth','admin');
Route::get('/admin/gestion-salle/salle{id}/voir-voir/ajouter-voie','RouteController@seeAddRoutes')->name('see_add_routes')->middleware('auth','admin');

// GESTION COMPTES
Route::get('/admin/gestion-compte', 'UserController@seeUserManagement')->name('see_user_management')->middleware('auth', 'admin');


Route::get('/salle/{id}', 'RoomController@viewRoom')->name('see_room');
Route::get('/salle/{id}/voie', 'RouteController@viewRoutes')->name('see_route');
Route::get('/salle/{id}/bloc', 'RouteController@viewBlocRoutes')->name('see_bloc');

Route::get('/voie/{id}', 'RouteController@viewSpecificRoute')->name('see_specific_route');
Route::get('/voie-bloc/{id}', 'RouteController@viewSpecificRouteBloc')->name('see_specific_routeBloc');
Route::get('/classement', 'ClassificationController@index')->name('see_classification');

Route::get('/profil/{id}', 'UserController@seeMyProfil')->name('see_my_profil')->middleware('auth');


