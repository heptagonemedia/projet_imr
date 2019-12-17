<?php

namespace App\Data;
use App\Models\Region;
use Illuminate\Support\Facades\DB;
use Jenssegers\Mongodb\Eloquent\Model;

class RegionDAO
{
    private static $instance;
    protected $connection;
    private $listeRegions;

    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new RegionDAO();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->listeRegions = array();
        $this->connection = DB::connection('mongodb');
    }

    public function recupererRegionParId($id){
        $region = $this->connection->collection('region')->where("id_region", (int)$id)->first();
        return new Region($region[Region::CLE_ID], $region[Region::CLE_ETIQUETTE]);
    }

    public function recuperListeRegions(){
        $this->listeRegions = array();

        $regions = $this->connection->collection('region')->get();

        foreach ($regions as $region){
            array_push($this->listeRegions, new Region($region[Region::CLE_ID], $region[Region::CLE_ETIQUETTE]));
        }

        return  $this->listeRegions;
    }

}
