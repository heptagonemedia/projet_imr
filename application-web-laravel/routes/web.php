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

// Permet la définition de la langue de la locale dans la session
// un lien <a href="{{ url('locale/en') }}">anglais</a>
// permet le passage à la langue anglaise. fr pour le français.
// la locale par défaut est définie dans /config/app.php, j'ai mis 'fr'.
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/' , 'PagesController@naviguerVersAccueil');
Route::get('/accueil' , 'PagesController@naviguerVersAccueil');

Route::get('/nouveauCalcul', 'PagesController@naviguerVersFormulaire');

//TODO: A supprimer, pour utiliser le ResultatController
Route::get('/test', 'PagesController@test');

Route::post('/resultat', 'ResultatController@store');
// Route::post('/resultat/{resultat}', 'ResultatController@showOne');
