<?php

namespace App\Models;

class Bouee
{
    protected $id;
    protected $etiquette;
    protected $longitude;
    protected $latitude;
    protected $region;

    public function __construct($id, $etiquette, $longitude, $latitude, $region) {
        $this->id = $id;
        $this->etiquette = $etiquette;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->region = $region;
    }



    public function __destruct() {

    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function getEtiquette()
    {
        return $this->etiquette;
    }

    public function getLongitude(){
        return $this->longitude;
    }

    public function getRegion(){
        return $this->region;
    }

    public function getLatitude(){
        return $this->latitude;
    }

    public static function mockBouee(){
        $tableauRegion = Region::mockRegions();
        $tableauBouees = array();
        array_push($tableauBouees, new Bouee(0,"bouee0", 49.32, -65.41, $tableauRegion[0]));
        array_push($tableauBouees, new Bouee(1,"bouee1", 45.720013, -67.347493, $tableauRegion[1]));
        array_push($tableauBouees, new Bouee(2,"bouee2", 42.620013, -63.347493, $tableauRegion[2]));
        return $tableauBouees;
    }

}

