<?php

namespace App\Http\Controllers;

use App\Data\BoueeDAO;
use App\Data\CalculDAO;
use App\Data\RegionDAO;
use App\Data\TypeCalculDAO;
use App\Models\TypeCalcul;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Compound;

class PagesController extends Controller
{
    public function naviguerVersAccueil()
    {
        $boueeDAO = BoueeDAO::getInstance();
        $conformes = $boueeDAO->recupererDonneesConformes();
        $nonConformes = $boueeDAO->recupererDonneesNonConformes();
        $regionDAO = RegionDAO::getInstance();
        $regions = $regionDAO->recuperListeRegions();
        return view('accueil', compact("regions", "conformes", "nonConformes"));
    }

    public function naviguerVersFormulaire()
    {
        $regionDAO = RegionDAO::getInstance();
        $regions = $regionDAO->recuperListeRegions();
        $typeCalculDao = TypeCalculDAO::getInstance();
        $typesCalcul = $typeCalculDao->recuperListeTypesDeCalcul();
        return view('formulaire', compact("regions"), compact("typesCalcul"));
    }

    public function naviguerVersResultat($id){
        $regionDAO = RegionDAO::getInstance();
        $regions = $regionDAO->recupererRegionParId($id);
        return view('layoutResultat', compact("regions"));
    }

    public function test()
    {
        return view('layoutResultat');
    }

    public function naviguerVersAccueilRegion($id_region){
        $boueeDAO = BoueeDAO::getInstance();
        $conformes = $boueeDAO->recupererDonneesConformes();
        $nonConformes = $boueeDAO->recupererDonneesNonConformes();
        $coordonnees = $boueeDAO->recupererCoordonneesBoueesParRegion((int)$id_region);
        $regionDAO = RegionDAO::getInstance();
        $regions = $regionDAO->recuperListeRegions();
        return view('accueil', compact('regions', 'coordonnees', 'id_region', 'conformes', 'nonConformes'));
    }

}
