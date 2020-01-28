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

// PROFILE

Route::get('/profil', 'UserController@seeMyProfil')->name('see_my_profil')->middleware('auth');
Route::get('/profil/update', 'UserController@seeUpdateProfile')->name('update_profile');
Route::post('/profil/update', 'UserController@updateProfile')->name('set_update_profile');

// ROOM ADMINISTRATION
Route::get('/admin/gestion-salles', 'RoomController@seeRoomManagement')->name('see_room_management')->middleware('auth', 'admin');
Route::get('/admin/gestion-salles/supprimmer{id}', 'RoomController@deleteRoom')->name('delete_room')->middleware('auth', 'admin');
Route::get('/admin/gestion-salles/modifier{id}', 'RoomController@modifyRoom')->name('modify_room')->middleware('auth','admin');
Route::post('/admin/gestion-salles/modifier{id}', 'RoomController@updateRoom')->name('update_room')->middleware('auth','admin');
Route::get('/admin/gestion-salles/ajouter', 'RoomController@seeAddingRoom')->name('see_adding_room')->middleware('auth', 'admin');
Route::post('/admin/gestion-salles/ajouter', 'RoomController@addRoom')->name('add_room')->middleware('auth', 'admin');
Route::put('/admin/gestion-salles/modifier/route/{idRoute}','RoomController@ajaxUpdate')->middleware('auth','admin');

Route::get('/admin/gestion-salles/{name_room}', 'SectorController@seeAllSectors')->name('see_sectors_admin')->middleware('auth','admin');
Route::get('admin/gestion-salles/{name_room}/supprimer-secteur', 'SectorController@deleteSector')->name('delete_sector')->middleware('auth','admin');
Route::get('admin/gestion-salles/{name_room}/ajouter-secteur', 'SectorController@seeAddSector')->name('see_add_sector')->middleware('auth','admin');
Route::post('admin/gestion-salles/{name_room}/ajouter-secteur', 'SectorController@addSector')->name('add_sector')->middleware('auth','admin');
Route::get('/admin/gestion-salles/{name_room}/{name_sector}','RouteController@seeRoutesAdmin')->name('see_routes_admin')->middleware('auth','admin');

Route::get('admin/gestion-salles/{name_room}/{name_sector}/delete{idroute}', 'RouteController@deleteRoute')->name('delete_route')->middleware('auth','admin');
Route::get('admin/gestion-salles/{name_room}/{name_sector}/modifier-voie{idroute}', 'RouteController@seeUpdateRoute')->name('see_update_route')->middleware('auth','admin');
Route::post('admin/gestion-salles/{name_room}/{name_sector}/modifier-voie{idroute}', 'RouteController@updateRoute')->name('update_route')->middleware('auth','admin');
Route::get('admin/gestion-salles/{name_room}/{name_sector}/ajouter-voie', 'RouteController@seeAddRoutes')->name('see_add_routes')->middleware('auth','admin');
Route::post('admin/gestion-salles/{name_room}/{name_sector}/ajouter-voie', 'RouteController@addRoute')->name('add_route')->middleware('auth','admin');

// ACCOUNT ADMINISTRATION
Route::get('/admin/gestion-comptes', 'UserController@seeUserManagement')->name('see_user_management')->middleware('auth', 'admin');
Route::get('/admin/gestion-comptes/supprimer/{id}','UserController@deleteUser')->name('delete_user')->middleware('auth','admin');
Route::get('/admin/gestion/modifier/mettre-administrateur/{id}','UserController@modifyUser')->name('modify_user')->middleware('auth','admin');
Route::get('/admin/gestion/modifier/enlever-adminstrateur/{id}','UserController@removeAdministratorRight')->name('remove_administrator_right')->middleware('auth','admin');


//Route::get('/classement', 'UserController@ranking')->name('see_classification');

// VALIDATE/TRY CLIBING ROUTE
Route::get('/{name_room}', 'RoomController@viewRoom')->name('see_room');
Route::get('/{name_room}/voies', 'RouteController@viewRoutes')->name('see_routes');
Route::get('/{name_room}/blocs', 'RouteController@viewBlocs')->name('see_blocs');
Route::get('/{name_room}/valider{id}','FinishedRoutesController@addValidatedRoute')->name('validate_route')->middleware('auth');
Route::get('/{name_room}/supprimer{id}','FinishedRoutesController@deleteValidatedRoute')->name('delete_validated_route')->middleware('auth');
