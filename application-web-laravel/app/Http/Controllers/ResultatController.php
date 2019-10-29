<?php

namespace App\Http\Controllers;

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

    function lireXml(){

        $fichierXml = simplexml_load_file("C:\\wamp64\\www\\fonction_lecture\\fichier.xml");

        foreach($fichierXml->donnees_carte->bouee as $bouee) {
            $etiquette = $bouee->etiquette;
            $longitudeReelle = $bouee->latitude_reelle;
            $latitudeReelle = $bouee->longitude_reelle;
            //$bouee = new Bouee($etiquette, $longitudeReelle,$latitudeReelle);
        }
        foreach ($fichierXml->donnees_courant as $donnee_courant) {
            $cheminXmlCourant = $donnee_courant->chemin_xml;
        }
        foreach ($fichierXml->donnees_temperature as $donnee_temperature) {
            $cheminXmlTemperature = $donnee_temperature->chemin_xml;
        }
        foreach ($fichierXml->donnees_salinite as $donnee_salinite) {
            $cheminXmlSalinite = $donnee_salinite->chemin_xml;
        }

    }

    // CF routes > web.php
    // public function showOne($nomResultat){
    //     dd($nomResultat);
    // }

}
