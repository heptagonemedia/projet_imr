<?php

namespace App\Data;

use App\Models\Bouee;
use Illuminate\Support\Facades\DB;

class BoueeDAO implements BoueeSQL
{
    private static $instance;

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
        $this->listeBouees = array();
    }

    public function recupererListeCalcul()
    {
        $bouees = DB::select(self::SQL_LISTER_BOUEE);
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
        return DB::select(BoueeSQL::SQL_RECUPERER_BOUEE_PAR_ID, [$id]);
    }
}
