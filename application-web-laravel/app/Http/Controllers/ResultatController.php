<?php

namespace App\Http\Controllers;

use App\Data\BoueeDAO;
use App\Data\CalculDAO;
use App\Data\RegionDAO;
use App\Data\TypeCalculDAO;
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
        //generation de l'etiquette
        $region = RegionDAO::getInstance()->recupererRegionParId((int)request('region'));
        $typeCalcul = TypeCalculDAO::getInstance()->recupererTypeDeCalculParId((int)request("calcul"));
        $etiquette = $typeCalcul->getEtiquette().date("m/d/Y", strtotime( request('dateDeb'))).$region->getEtiquette();
        $data = array(
            'etiquette' => $etiquette,
            'calcul' => (int)request("calcul"),
            'annee' => (int)request("annee"),
            'mois' => (int)request("mois"),
            'jour' => (int)request("jour"),
            'heure' =>(int) request("heure"),
            'minute' => (int)request("minute"),
            'region' =>(int) request("region"),
            'dateDeb' => request("dateDeb"),
            'heureDeb' => request("heureDeb"),
            'dateFin' => request("dateFin"),
            'heureFin' => request("heureFin"),
            'enregistre' => request("enregistre"),
            'recursif' => request("recursif"),
            'recursivite' => request("recursivite")
        );

    # Create a connection
        $url = 'http://localhost:3000';
        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */ }


        $calculDao = CalculDAO::getInstance();
        do{
            $calcul = $calculDao->recupererCalculParEtiquette($etiquette);
        }while($calcul->getCheminFichierXmlTemperature()== null);
        $boueesDAO = BoueeDAO::getInstance();
        $coordonnees = $boueesDAO->recupererCoordonneesBoueesParRegion((int) $calcul->getRegion()->getId());
        return view('resultat.show', compact("calcul", "coordonnees"));
    }

    public function enregistrerCalcul($id){
        $calculDAO = CalculDAO::getInstance();
        $calcul = $calculDAO->recupererCalculParId((int)$id);
        $calcul->setEnregistre(true);
        $boueesDAO = BoueeDAO::getInstance();
        $coordonnees = $boueesDAO->recupererCoordonneesBoueesParRegion((int) $calcul->getRegion()->getId());
        $calculDAO->modifierCalcul($calcul);
        $enregistre = true;
        return view('resultat.show', compact("calcul", "id", "enregistre", "coordonnees"))->with('Succes', 'Calcul enregistre avec succes');
    }

    public function navigerVersResultatNonEnregistre($id){
        $calculDao = CalculDAO::getInstance();
        $calcul = $calculDao->recupererCalculParId((int)$id);
        $boueesDAO = BoueeDAO::getInstance();

        $coordonnees = $boueesDAO->recupererCoordonneesBoueesParRegion((int) $calcul->getRegion()->getId());
        $enregistre = false;
        return view('resultat.show', compact("calcul", "id", "enregistre", "coordonnees"));
    }

    public function naviguerVersResultat($id){

        $calculDao = CalculDAO::getInstance();
        $calcul = $calculDao->recupererCalculParId((int)$id);
        $boueesDAO = BoueeDAO::getInstance();
        $coordonnees = $boueesDAO->recupererCoordonneesBoueesParRegion((int) $calcul->getRegion()->getId());
        return view('resultat.show', compact("calcul", "id", "coordonnees"));
    }

    public function modifier(){

        $region = RegionDAO::getInstance()->recupererRegionParId((int)request('region'));
        $typeCalcul = TypeCalculDAO::getInstance()->recupererTypeDeCalculParId((int)\request("calcul"));
        $etiquette = $typeCalcul->getEtiquette().date("m/d/Y", strtotime( request('dateDeb'))).$region->getEtiquette();
        $data = array(
            'etiquette' => $etiquette,
            'calcul' => request("calcul"),
            'annee' => request("annee"),
            'mois' => request("mois"),
            'jour' => request("jour"),
            'heure' => request("heure"),
            'minute' => request("minute"),
            'region' => request("region"),
            'dateDeb' => request("dateDeb"),
            'heureDeb' => request("heureDeb"),
            'dateFin' => request("dateFin"),
            'heureFin' => request("heureFin"),
            'enregistre' => request("enregistre"),
            'recursif' => request("recursif"),
            'recursivite' => request("recursivite")
        );
        # Create a connection
        $url = 'http://localhost:3000';
        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */ }

        $calculDao = CalculDAO::getInstance();
        $calcul = $calculDao->recupererCalculParId((int)request('id'));
        $calculDao->supprimerCalculParEtiquette($calcul->getEtiquette());
        $boueesDAO = BoueeDAO::getInstance();
        $coordonnees = $boueesDAO->recupererCoordonneesBoueesParRegion((int) $calcul->getRegion()->getId());
        return view('resultat.show', compact("calcul", "id", "coordonnees"));
    }

    // CF routes > web.php
    // public function showOne($nomResultat){
    //     dd($nomResultat);
    // }

}
