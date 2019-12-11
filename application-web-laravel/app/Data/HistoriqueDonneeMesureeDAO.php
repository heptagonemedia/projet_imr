<?php

namespace App\Data;

use App\HistoriqueDonneeBouee;
use App\Models\Bouee;
use Illuminate\Support\Facades\DB;

class HistoriqueDonneeMesureeDAO
{
    private static $instance;
    private $connection;
    private $conformes;
    private $nonConformes;

    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new HistoriqueDonneeMesureeDAO();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->connection = DB::connection("mongodb");
    }

    public function nombreBoueesConformes(){
       return $this->connection->collection("historique_donnee_bouee")->select('id_bouee')->distinct()->where("valide", true)->count();
    }

    public function nombreBoueesNonConformes(){
       return $this->connection->collection("historique_donnee_bouee")->select('id_bouee')->distinct()->where("valide", false)->count();
    }

    public function recupererDerniereDateSaisie(){
        return $this->connection->collection("historique_donnee_bouee")->value("date_saisie");
    }

    public function getConformes()
    {
        return $this->conformes;
    }


    public function getNonConformes()
    {
        return $this->nonConformes;
    }

}
