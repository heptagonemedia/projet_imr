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

Route::get('/' , 'PagesController@naviguerVersAccueil');
Route::get('/accueil' , 'PagesController@naviguerVersAccueil');

Route::get('/nouveauCalcul', 'PagesController@naviguerVersFormulaire');

//TODO: A supprimer, pour utiliser le ResultatController
Route::get('/test', 'PagesController@test');

Route::post('/resultat', 'ResultatController@store');
// Route::post('/resultat/{resultat}', 'ResultatController@showOne');
