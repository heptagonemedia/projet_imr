<?php

namespace App\Data;
use App\Models\Region;
use Illuminate\Support\Facades\DB;

class RegionDAO implements RegionSQL
{
    private $instance;

    private $listeRegions;

    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new ResultatDAO();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->listeRegions = array();
    }

    public function recupererRegionParId($id){
        DB::select(RegionSQL::RECUPERER_REGION_PAR_ID_SQL, [$id]);
    }

    public function recuperListeRegions(){
        $this->listeRegions = array();

        $regions = DB::select(self::RECUPERER_REGIONS_SQL);

        foreach ($regions as $region){
            array_push($listeRegions, new Region($region[Region::CLE_ID], $regions[Region::CLE_ETIQUETTE]));
        }

        return $this->listeRegions;
    }

}
