<?php

namespace App\Models;

class HistoriqueDonneeBouee
{
    protected $id;
    protected $bouee;
    protected $longitudeReelle;
    protected $latitudeReelle;
    protected $dateSaisie;

    public function __construct($id, $bouee, $longitudeReelle, $latitudeReelle, $dateSaisie){
        $this->id = $id;
        $this->bouee= $bouee;
        $this->longitudeReelle = $longitudeReelle;
        $this->latitudeReelle = $latitudeReelle;
        $this->dateSaisie = $dateSaisie;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setBouee($bouee){
        $this->bouee = $bouee;
    }

    public function getBouee(){
        return $this->bouee;
    }

    public function setlongitudeReelle($longitudeReelle){
        $this->longitudeReelle = $longitudeReelle;
    }

    public function getLongitudeReelle(){
        return $this->longitudeReelle;
    }

    public function setLatitudeReelle($latitudeReelle){
        $this->latitudeReelle = $latitudeReelle;
    }

    public function getLatitudeReelle(){
        return $this->latitudeReelle;
    }

    public function setDateSaisie($dateSaisie){
        $this->dateSaisie = $dateSaisie;
    }

    public function getDateSaisie(){
        return $this->dateSaisie;
    }

    public static function mockHistoriqueDonneesBouees(){
        $tableauHistoriqueDonneeBouees = array();
        $tableauBouees = Bouee::mockBouee();
        array_push($tableauHistoriqueDonneeBouees, new HistoriqueDonneeBouee(0, $tableauBouees[0], 49.620013, -65.347493, "2019-05-23"));
        array_push($tableauHistoriqueDonneeBouees, new HistoriqueDonneeBouee(0, $tableauBouees[1], 45.620013, -67.347493, "2019-10-21"));
        array_push($tableauHistoriqueDonneeBouees, new HistoriqueDonneeBouee(0, $tableauBouees[2], 42.620013, -63.347493, "2019-08-12"));
        return $tableauHistoriqueDonneeBouees;
    }

}
