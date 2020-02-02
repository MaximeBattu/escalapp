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
Route::get('/home', function () {
    return redirect()->route("see_home");
});

Auth::routes();

Route::get('/accueil', 'HomeController@index')->name('see_home');

Route::get('/admin/accueil', 'AdminController@index')->name('see_home_admin')
    ->middleware('auth', 'admin');

// PROFILE

Route::get('/profil', 'UserController@seeMyProfil')->name('see_my_profil')
    ->middleware('auth');
Route::get('/profil/mise-a-jour', 'UserController@seeUpdateProfile')->name('update_profile')
    ->middleware('auth');
Route::post('/profil/mise-a-jour', 'UserController@updateProfile')->name('set_update_profile')
    ->middleware('auth');

// ROOM ADMINISTRATION
Route::get('/admin/gestion-salles', 'RoomController@seeRoomManagement')->name('see_room_management')
    ->middleware('auth', 'admin');
// TODO Delete HTTP Verb
Route::get('/admin/gestion-salles/supprimer/{id}', 'RoomController@deleteRoom')->name('delete_room')
    ->middleware('auth', 'admin');
Route::get('/admin/gestion-salles/ajouter-salle', 'RoomController@seeAddRoom')->name('see_add_room')
    ->middleware('auth', 'admin');
Route::post('/admin/gestion-salles/ajouter-salle', 'RoomController@addRoom')->name('add_room')
    ->middleware('auth', 'admin');
Route::put('/admin/gestion-salles/modifier/salle/{id_room}','RoomController@ajaxUpdateRoom')
    ->middleware('auth','admin');

Route::get('/admin/gestion-salles/{name_room_slug}-{id}', 'SectorController@seeAllSectors')
    ->name('see_sectors_admin')
    ->middleware('auth','admin')
    ->where(['name_room_slug'=>'[a-z0-9\-]+','id'=>'[0-9]+']);

// TODO Delete HTTP Verb
Route::get('/admin/gestion-salles/{name_room}/supprimer-secteur', 'SectorController@deleteSector')
    ->name('delete_sector')->middleware('auth','admin');

Route::get('/admin/gestion-salles/{name_room_slug}-{id}/ajouter-secteur', 'SectorController@seeAddSector')
    ->name('see_add_sector')->middleware('auth','admin')
    ->where([
        'name_room_slug'=>'[a-z0-9\-]+',
        'id'=>'[0-9]+'
    ]);

Route::post('/admin/gestion-salles/{id}', 'SectorController@addSector')
    ->name('add_sector')->middleware('auth','admin');

Route::get('/admin/gestion-salles/{name_room_slug}-{id_room}/{name_sector_slug}-{id_sector}','RouteController@seeRoutesAdmin')
    ->name('see_routes_admin')->middleware('auth','admin')
    ->where([
        'name_room_slug'=>'[a-z0-9\-]+',
        'id_room'=>'[0-9]+',
        'name_sector_slug'=>'[a-z0-9\-]+',
        'id_sector'=>'[0-9]+'
    ]);

Route::put('/admin/gestion-salles/modifier/sector/{id_sector}','SectorController@ajaxUpdateSector')
    ->middleware('auth','admin');


Route::get('admin/gestion-salles/{name_room}/{name_sector}/delete{idroute}', 'RouteController@deleteRoute')
    ->name('delete_route')->middleware('auth','admin');

// TODO pass slug name room, id room, slug name sector and id sector
Route::get('/admin/gestion-salles/{name_room}/{name_sector}/ajouter-route', 'RouteController@seeAddRoutes')
    ->name('see_add_routes')->middleware('auth','admin');
Route::post('/admin/gestion-salles/salle/{id_room}/secteur/{id_sector}', 'RouteController@addRoute')
    ->name('add_route')->middleware('auth','admin');
Route::put('/admin/gestion-salles/modifier/route/{id_route}','RouteController@ajaxUpdateRoute')
    ->middleware('auth','admin');

// ACCOUNT ADMINISTRATION
Route::get('/admin/gestion-comptes', 'UserController@seeUserManagement')->name('see_user_management')
    ->middleware('auth', 'admin');
Route::delete('/admin/gestion-comptes/supprimer/{id}','UserController@deleteUser')->name('delete_user')
    ->middleware('auth','admin');
Route::post('/admin/gestion/modifier/mettre-administrateur/{id}','UserController@modifyUser')
    ->name('modify_user')->middleware('auth','admin');
Route::post('/admin/gestion/modifier/enlever-adminstrateur/{id}','UserController@removeAdministratorRight')
    ->name('remove_administrator_right')->middleware('auth','admin');

//Route::get('/classement', 'UserController@ranking')->name('see_classification');

// VALIDATE/TRY CLIBING ROUTE

Route::get('/{name_room_slug}-{id}', 'RoomController@viewRoom')
    ->name('see_room')
    ->where(['name_room_slug'=>'[a-z0-9\-]+','id'=>'[0-9]+']);
Route::get('/{name_room_slug}-{id}/voies', 'RouteController@viewRoutes')
    ->name('see_routes')
    ->where(['name_room_slug'=>'[a-z0-9\-]+','id'=>'[0-9]+']);
Route::get('/{name_room_slug}-{id}/blocs', 'RouteController@viewBlocs')
    ->name('see_blocs')
    ->where(['name_room_slug'=>'[a-z0-9\-]+','id'=>'[0-9]+']);

// TODO make ajax request
Route::get('/{name_room}/valider{id}','FinishedRoutesController@addValidatedRoute')
    ->name('validate_route')->middleware('auth');
// TODO Delete HTTP Verb
Route::get('/{name_room}/supprimer{id}','FinishedRoutesController@deleteValidatedRoute')
    ->name('delete_validated_route')->middleware('auth');
