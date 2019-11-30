<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bouee extends Model
{
    const  CLE_ID = "id";
    const  CLE_ETIQUETTE = "etiquette";
    const  CLE_LONGITUDE_REFERENCE = "longitude_reference";
    const  CLE_LATITUDE_REFERENCE = "latitude_reference";
    const  CLE_ID_REGION = "id_region";

    private $id;
    private $etiquette;
    private $longitudeReference;
    private $latitudereference;
    private $region;

    public function __construct($id, $etiquette, $longitude, $latitude, $region) {
        $this->id = $id;
        $this->etiquette = $etiquette;
        $this->longitudeReference = $longitude;
        $this->latitudereference = $latitude;
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

    public function getLongitudeReference(){
        return $this->longitudeReference;
    }

    public function getRegion(){
        return $this->region;
    }

    public function getLatitudereference(){
        return $this->latitudereference;
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

