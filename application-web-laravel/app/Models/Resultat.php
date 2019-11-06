<?php


namespace App\Models;


class Resultat
{
    protected $id;
    protected $etiquette;
    protected $enregistre;
    protected $calculSalinite;
    protected $calculTemperature;
    protected $calculCourant;

    public function __construct($id, $etiquette, $enregistre, $calculCourant, $calculSalinite, $calculTemperature)
    {
        $this->id = $id;
        $this->etiquette = $etiquette;
        $this->enregistre = $enregistre;
        $this->calculCourant = $calculCourant;
        $this->calculSalinite = $calculSalinite;
        $this->calculTemperature = $calculTemperature;
    }

    public function getId(){
        return $this->id;
    }
    public function getEtiquette(){
        return $this->etiquette;
    }
    public function isEnregistre(){
        return $this->enregistre;
    }
    public function getCalculSalinite(){
        return $this->calculSalinite;
    }
    public function getCalculTemperature(){
        return $this->calculTemperature;
    }
    public function getCalculCourant(){
        return $this->calculCourant;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function setEtiquette($etiquette){
        $this->etiquette = $etiquette;
    }
    public function setEnregistre($enregistre){
        $this->enregistre = $enregistre;
    }
    public function setCalculSalinite($calculSalinite){
        $this->calculSalinite = $calculSalinite;
    }
    public function setCalculTemperature($calculTemperature){
        $this->calculTemperature = $calculTemperature;
    }
    public function setCalculCourant($calculCourant){
        $this->calculCourant = $calculCourant;
    }

    public static function mockListeResulats(){
        $tableauResultats = array();
        $tableauCalculs = Calcul::mockCalculEnregistre();
        array_push($tableauResultats,new Resultat(1, "moyenne 02-05-2019", true, $tableauCalculs[0], $tableauCalculs[1], $tableauCalculs[2] ));
        return $tableauResultats;
    }

}
