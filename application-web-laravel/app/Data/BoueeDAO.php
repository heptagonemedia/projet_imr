<?php

namespace App\Data;

use App\Models\Bouee;
use App\Models\Region;
use Illuminate\Support\Facades\DB;

class BoueeDAO implements BoueeSQL
{
    private static $instance;
    private $connection;
    private $listeBouees;

    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new BoueeDAO();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->connection = DB::connection('mongodb');
        $this->listeBouees = array();
    }

    public function recupererListeCalcul()
    {
        $bouees = $this->connection->collection('bouee')->get();
        $this->listeBouees = array();

        foreach ($bouees as $item) {
            $id = $item[Bouee::CLE_ID];
            $etiquette = $item[Bouee::CLE_ETIQUETTE];
            $longitudeReference = $item[Bouee::CLE_LONGITUDE_REFERENCE];
            $latitudereference = $item[Bouee::CLE_LATITUDE_REFERENCE];
            $id_region = $item[Bouee::CLE_ID_REGION];

            $region = Region::getInstance()->trouverRegionParId($id_region);

            $bouee = new Bouee(
                $id,
                $etiquette,
                $longitudeReference,
                $latitudereference,
                $region
            );
            array_push($this->listeBouees, $bouee);
        }
        return $this->listeBouees;
    }

    public function recupererBoueeParId($id){
        $bouee = $this->connection->collection('bouee')->where("id_bouee", $id)->first();
        $regionDAO = new RegionDAO();
        $region = $regionDAO->recupererRegionParId($bouee[Bouee::CLE_ID_REGION]);
        return new Bouee($bouee[Bouee::CLE_ID], $bouee[Bouee::CLE_ETIQUETTE], $bouee[Bouee::CLE_LONGITUDE_REFERENCE], $bouee[Bouee::CLE_LATITUDE_REFERENCE], $region  );
    }
}
