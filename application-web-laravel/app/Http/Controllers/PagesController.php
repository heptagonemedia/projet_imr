<?php

namespace App\Http\Controllers;

use App\Data\BoueeDAO;
use App\Data\CalculDAO;
use App\Data\HistoriqueDonneeMesureeDAO;
use App\Data\RegionDAO;
use App\Data\TypeCalculDAO;
use App\Models\TypeCalcul;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Compound;

class PagesController extends Controller
{
    public function naviguerVersAccueil()
    {
        $historiqueDonneeDAO = HistoriqueDonneeMesureeDAO::getInstance();
        $regionDAO = RegionDAO::getInstance();
            $conformes = $historiqueDonneeDAO->nombreBoueesConformes();
            $nonConformes = $historiqueDonneeDAO->nombreBoueesNonConformes();
            $dateSaisie = $historiqueDonneeDAO->recupererDerniereDateSaisie();
            $regions = $regionDAO->recuperListeRegions();
        return view('accueil', compact("regions", "conformes", "nonConformes", "dateSaisie"));
    }

    public function naviguerVersFormulaire()
    {
        $regionDAO = RegionDAO::getInstance();
        $regions = $regionDAO->recuperListeRegions();
        $typeCalculDao = TypeCalculDAO::getInstance();
        $typesCalcul = $typeCalculDao->recuperListeTypesDeCalcul();
        return view('formulaire', compact("regions"), compact("typesCalcul"));
    }

    public function test()
    {
        return view('layoutResultat');
    }

    public function naviguerVersFAQ()
    {
        return view('FAQ');
    }


    public function naviguerVersAccueilRegion($id_region){
        $boueeDAO = BoueeDAO::getInstance();
        $historiqueDonneeDAO = HistoriqueDonneeMesureeDAO::getInstance();
        $regionDAO = RegionDAO::getInstance();
        $conformes = $historiqueDonneeDAO->nombreBoueesConformes();
        $nonConformes = $historiqueDonneeDAO->nombreBoueesNonConformes();
        $dateSaisie = $historiqueDonneeDAO->recupererDerniereDateSaisie();
        $regions = $regionDAO->recuperListeRegions();

        $coordonnees = $boueeDAO->recupererCoordonneesBoueesParRegion((int)$id_region);

        return view('accueil', compact('regions', 'coordonnees', 'id_region', 'conformes', 'nonConformes', "dateSaisie"));
    }

}
