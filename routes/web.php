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

Route::get('/admin/gestion-salle/salle', 'SectorController@seeAllSectors')->name('see_sectors_admin')->middleware('auth','admin');
Route::get('admin/gestion-salle/salle/delete-sector', 'SectorController@deleteSector')->name('delete_sector')->middleware('auth','admin');
Route::get('admin/gestion-salle/salle/ajouter-secteur', 'SectorController@seeAddSector')->name('see_add_sector')->middleware('auth','admin');
Route::post('admin/gestion-salle/salle/ajouter-secteur', 'SectorController@addSector')->name('add_sector')->middleware('auth','admin');
Route::get('/admin/gestion-salle/salle{id}/secteur{idsector}','RouteController@seeRoutesAdmin')->name('see_routes_admin')->middleware('auth','admin');

Route::get('admin/gestion-salle/salle{id}/secteur{idsector}/delete{idroute}', 'RouteController@deleteRoute')->name('delete_route')->middleware('auth','admin');
Route::get('admin/gestion-salle/salle{id}/secteur{idsector}/update{idroute}', 'RouteController@seeUpdateRoute')->name('see_update_route')->middleware('auth','admin');
Route::post('admin/gestion-salle/salle{id}/secteur{idsector}/update{idroute}', 'RouteController@updateRoute')->name('update_route')->middleware('auth','admin');
Route::get('admin/gestion-salle/salle{id}/secteur{idsector}/add', 'RouteController@seeAddRoutes')->name('see_add_routes')->middleware('auth','admin');
Route::post('admin/gestion-salle/salle{id}/secteur{idsector}/add', 'RouteController@addRoute')->name('add_route')->middleware('auth','admin');

// GESTION COMPTES
Route::get('/admin/gestion-compte', 'UserController@seeUserManagement')->name('see_user_management')->middleware('auth', 'admin');
Route::get('/admin/gestion-compte/supprimer/{id}','UserController@deleteUser')->name('delete_user')->middleware('auth','admin');
Route::get('/admin/gestion/modifier/mettre-administrateur/{id}','UserController@modifyUser')->name('modify_user')->middleware('auth','admin');
Route::get('/admin/gestion/modifier/enlever-adminstrateur/{id}','UserController@removeAdministratorRight')->name('remove_administrator_right')->middleware('auth','admin');

//VALIDER/ESSAYER UNE VOIE / UN BLOC
Route::get('/salle{id}', 'RoomController@viewRoom')->name('see_room');
Route::get('/salle{id}/voie', 'RouteController@viewRoutes')->name('see_route');
Route::get('/salle{id}/bloc', 'RouteController@viewBlocRoutes')->name('see_bloc');
Route::get('/salle{idroom}/voie{id}', 'RouteController@viewSpecificRoute')->name('see_specific_route')->middleware('auth');
Route::get('/salle{idroom}/voie{id}/valider','FinishedRoutesController@addValidatedRoute')->name('add_validated_route')->middleware('auth');
Route::get('/salle{idroom}/voie{id}/supprimer','FinishedRoutesController@deleteValidatedRoute')->name('delete_validated_route')->middleware('auth');


Route::get('/classement', 'ClassificationController@index')->name('see_classification');

//PROFIL

Route::get('/profil', 'UserController@seeMyProfil')->name('see_my_profil')->middleware('auth');
Route::get('/profil/update', 'UserController@seeUpdateProfile')->name('update_profile');
Route::post('/profil/update', 'UserController@updateProfile')->name('set_update_profile');


