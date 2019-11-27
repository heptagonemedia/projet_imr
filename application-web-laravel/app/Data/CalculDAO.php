<?php

namespace App\Data;

use App\Models\Calcul;
use Illuminate\Support\Facades\DB;

class CalculDAO implements CalculSQL
{
    private static $instance;

    private $listeCalculs;

    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new CalculDAO();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->listeCalculs = array();
    }

    public function recupererListeCalcul()
    {
        $calculs = DB::select(self::RECUPERER_BOUEES_SQL);
        $this->listeBouees = array();

        foreach ($calculs as $item) {
            $id = $item[Bouee::CLE_ID];
            $etiquette = $item[Bouee::CLE_ETIQUETTE];
            $longitudeReference = $item[Bouee::CLE_LONGITUDE_REFERENCE];
            $latitudereference = $item[Bouee::CLE_LATITUDE_REFERENCE];
            $id_region = $item[Bouee::CLE_ID_REGION];

            $region = Region::getInstance()->trouverRegionParId($id_region);

            $calcul = new Calcul(
                $id,
                $etiquette,
                $longitudeReference,
                $latitudereference,
                $region
            );
            array_push($this->listeCalculs, $calcul);
        }
        return $this->listeCalculs;
    }
}
