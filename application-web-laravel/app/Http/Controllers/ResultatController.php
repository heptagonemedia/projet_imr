<?php

namespace App\Http\Controllers;

use App\Data\CalculDAO;
use App\Data\RegionDAO;
use Illuminate\Http\Request;

class ResultatController extends Controller
{
    public function store(){
        //TODO:
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

    public function enregistrerCalcul($id){
        $calculDAO = CalculDAO::getInstance();
        $calcul = $calculDAO->recupererCalculParId((int)$id);
        $calcul->setEnregistre(false);
        $calculDAO->modifierCalcul($calcul);
        $enregistre = true;
        return view('resultat.show', compact("calcul", "id", "enregistre"))->with('Succes', 'Calcul enregistre avec succes');
    }

    public function navigerVersResultatNonEnregistre($id){
        $calculDao = CalculDAO::getInstance();
        $calcul = $calculDao->recupererCalculParId((int)$id);
        $enregistre = false;
        return view('resultat.show', compact("calcul", "id", "enregistre"));
    }

    public function naviguerVersResultat($id){
        $calculDao = CalculDAO::getInstance();
        $calcul = $calculDao->recupererCalculParId((int)$id);
        return view('resultat.show', compact("calcul"), compact("id"));
    }


    // CF routes > web.php
    // public function showOne($nomResultat){
    //     dd($nomResultat);
    // }

}
