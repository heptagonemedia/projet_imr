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
        $regionDAO = new RegionDAO();
        $regions = $regionDAO->recuperListeRegions();
        return view('accueil', compact("regions"));
    }

    public function naviguerVersFormulaire()
    {
        $regionDAO = new RegionDAO();
        $regions = $regionDAO->recuperListeRegions();
        $typeCalculDao = new TypeCalculDAO();
        $typesCalcul = $typeCalculDao->recuperListeTypesDeCalcul();
        return view('formulaire', compact("regions"), compact("typesCalcul"));
    }

    public function naviguerVersResultat($id){
        $regionDAO = new RegionDAO();
        $regions = $regionDAO->recupererRegionParId($id);
        return view('layoutResultat', compact("regions"));
    }

    public function test()
    {
        return view('layoutResultat');
    }

    public function naviguerVersAccueilRegion($id_region){
        $boueeDAO = BoueeDAO::getInstance();
        $coordonnees = $boueeDAO->recupererCoordonneesBoueesParRegion((int)$id_region);
        $regionDAO = new RegionDAO();
        $regions = $regionDAO->recuperListeRegions();
        return view('accueil', compact('regions', 'coordonnees', 'id_region'));
    }

}
