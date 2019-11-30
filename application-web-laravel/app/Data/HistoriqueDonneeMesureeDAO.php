<?php

namespace App\Data;

class HistoriqueDonneeMesureeDAO implements HistoriqueDonneeMesureeSQL
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
        $this->conformes = DB::select(HistoriqueDonneeMesureeSQL::RECUPERER_NOMBRE_CONFORMES);
    }

    public function nombreBoueesNonConformes(){
        $this->nonConformes = DB::select(HistoriqueDonneeMesureeSQL::RECUPERER_NOMBRE_NON_CONFORMES);
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
