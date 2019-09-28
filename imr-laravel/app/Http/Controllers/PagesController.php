<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function naviguerVersAccueil()
    {
        return view('accueil');
    }

    public function naviguerVersFormulaire()
    {
        return view('formulaire');
    }

    public function test()
    {
        return view('layoutResultat');
    }

}
