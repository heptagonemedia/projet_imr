<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultatController extends Controller
{
    public function store(){
        //TODO
        /* Création d'un nouveau résultat et remplissage des champs
        (sous-entend la création d'un modèle Resultat (mettre le nom de la tale du MR à la place)) */

        // $resultat = new Resultat();
        // $resultat->champ = request('champ');

        /* Création d'un nom unique et représentatif du calcul et affectation au résultat */
        // $resultat->nom = nomGenerer;

        /* Génération des fichiers XML (sous-entend le calcul des données au préalable) */

        /* Ajout à la table */

        /* passage à la vue show : ressources/views/resultat/show.blade.php*/

        return view('resultat.show'/*, compact('resultat')*/);

    }

    // Ne pas utiliser
    // public function showOne($nomResultat){
    //     dd($nomResultat);
    // }

}
