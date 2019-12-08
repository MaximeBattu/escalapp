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

Route::get('/classement', 'ClassificationController@index')->name('see_classification');


Route::get('/salle/bloc', 'SiteController@blocView')->name('see_bloc');
Route::get('/salle/mur', 'SiteController@murView')->name('see_wall');
