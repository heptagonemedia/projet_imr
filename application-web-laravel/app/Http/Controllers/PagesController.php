<?php

namespace App\Http\Controllers;

use App\Data\RegionDAO;
use App\Data\TypeCalculDAO;
use App\Models\TypeCalcul;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function naviguerVersAccueil()
    {
        return view('accueil');
    }

    public function naviguerVersFormulaire()
    {
        $regionDAO = new RegionDAO();
        $regions = $regionDAO->recuperListeRegions();
        $typeCalculDao = new TypeCalculDAO();
        $typesCalcul = $typeCalculDao->recuperListeTypesDeCalcul();
        return view('formulaire', compact("regions"), compact("typesCalcul"));
    }

    public function test()
    {
        return view('layoutResultat');
    }

}
