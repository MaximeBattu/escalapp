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

Route::get('/', function () {
    return redirect()->route("see_accueil");
});

Auth::routes();

Route::get('/accueil', 'HomeController@index')->name('see_accueil');

Route::get('/salle/{id}', 'RoomController@viewRoom')->name('see_room');
Route::get('/salle/{id}/voie','RouteController@viewRoutes')->name('see_route');
Route::get('/salle/{id}/bloc','RouteController@viewBlocRoutes')->name('see_bloc');

Route::get('/voie/{id}', 'RouteController@viewSpecificRoute')->name('see_specific_route');
Route::get('/voieBloc/{id}', 'RouteController@viewSpecificRouteBloc')->name('see_specific_routeBloc');

Route::get('/classement', 'ClassificationController@index')->name('see_classification');

Route::get('/profil/{id}', 'UserController@seeMyProfil')->name('see_my_profil');


