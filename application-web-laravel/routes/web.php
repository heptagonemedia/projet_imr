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
use Illuminate\Support\Facades\Route;

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/' , 'PagesController@naviguerVersAccueil');
Route::get('accueil' , 'PagesController@naviguerVersAccueil');
Route::get('accueil/{id}' , 'PagesController@naviguerVersAccueilRegion');
Route::get('nouveauCalcul', 'PagesController@naviguerVersFormulaire');
Route::get('nouveauCalcul/{id}', 'PagesController@retourFormulaire');

//TODO: A supprimer, pour utiliser le ResultatController
Route::get('test', 'PagesController@test');
Route::post('resultat', 'ResultatController@store');
//Route::post('/resultat/{id}', 'PagesController@naviguerVersResultat');
Route::get('resultat/{id}', 'ResultatController@naviguerVersResultat');
Route::get('resultat/{id}/prev', 'ResultatController@navigerVersResultatNonEnregistre');
Route::get('resultat/{id}/enr', 'ResultatController@enregistrerCalcul');
Route::get('/FAQ' , 'PagesController@naviguerVersFAQ');
