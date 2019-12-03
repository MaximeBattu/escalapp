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
    return view('accueil');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/accueil', 'SiteController@index')->name('see_accueil');
Route::get('/salle', 'SiteController@salleView')->name('see_salle');
Route::get('/salle/bloc', 'SiteController@blocView')->name('see_bloc');
Route::get('/salle/mur', 'SiteController@murView')->name('see_wall');