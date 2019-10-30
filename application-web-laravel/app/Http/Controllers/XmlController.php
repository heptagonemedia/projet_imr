<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;


class XmlController extends Controller
{
    function lireXml(){

        $fichierXml = simplexml_load_file("..\\administratif\\Representation Donnees Service Web Lecture\\nouveau-xml\\page-resultat.xml");

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

    function lireXmlAccueil(){

        $fichierXml = simplexml_load_file("..\\administratif\\Representation Donnees Service Web Lecture\\nouveau-xml\\page-accueil.xml");
        $dateMaj = $fichierXml->date_maj;
        $nombreConformes = $fichierXml->etat_bouees->conformes;
        $nombreNonConformes = $fichierXml->etat_bouees->non_conformes;
        foreach($fichierXml->liste_bouees->bouee as $bouee) {
            $longitudeReelle = $bouee->latitude_reelle;
            $latitudeReelle = $bouee->longitude_reelle;
        }

    }

    function lireXmlsideBar(){

        $fichierXml = simplexml_load_file("..\\administratif\\Representation Donnees Service Web Lecture\\nouveau-xml\\sidebar.xml");

        foreach($fichierXml->liste_calculs_enregistres->calcul as $calcul) {
            $etiquette = $calcul->etiquette;
            $id = $calcul->id;
        }
        foreach($fichierXml->liste_calculs_previsualises->calcul as $calcul) {
            $etiquette = $calcul->etiquette;
            $id = $calcul->id;
        }
    }
}
