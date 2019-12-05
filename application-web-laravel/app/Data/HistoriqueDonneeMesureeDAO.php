<?php

namespace App\Data;

use App\HistoriqueDonneeBouee;
use App\Models\Bouee;

class HistoriqueDonneeMesureeDAO
{
    private static $instance;

    private $conformes;
    private $nonConformes;

    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new BoueeDAO();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->nombreBoueesConformes();
        $this->nombreBoueesNonConformes();
    }

    public function nombreBoueesConformes(){
        $this->conformes = $this->collection("historique_donnee_bouee")->where("valide", true);
    }

    public function nombreBoueesNonConformes(){
        $this->nonConformes = $this->collection("historique_donnee_bouee")->where("valide", false);
    }

    public function getConformes()
    {
        return $this->conformes;
    }

    public function setConformes($conformes)
    {
        $this->conformes = $conformes;
    }

    public function getNonConformes()
    {
        return $this->nonConformes;
    }

    public function setNonConformes($nonConformes)
    {
        $this->nonConformes = $nonConformes;
    }

}
