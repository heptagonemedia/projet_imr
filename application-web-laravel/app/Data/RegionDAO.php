<?php

namespace App\Data;
use App\Models\Region;
use Illuminate\Support\Facades\DB;

class RegionDAO implements RegionSQL
{
    private $instance;
    private $connection;

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
        $listeRegions = array();
    }

    public function recuperListeRegions(){
        $listeRegions = array();

        $regions = DB::select('select * from region');

        foreach ($regions as $region){
            array_push($listeRegions, new Region($region["id"], $regions["etiquette"]));
        }

        return $listeRegions;
    }
    
}
