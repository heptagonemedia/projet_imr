<?php

namespace App\Data;

use App\Models\TypeCalcul;
use Illuminate\Support\Facades\DB;
use MongoDB\BSON\Type;

class TypeCalculDAO
{
    private static $instance;
    private $connection;
    private $listeTypesCalcul;

    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new TypeCalculDAO();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->connection = DB::connection("mongodb");
        $this->listeTypesCalcul = array();
    }

    public function recupererTypeDeCalculParId($id){
        $typeCalcul = $this->connection->collection('type_calcul')->where(TypeCalcul::CLE_ID, $id)->first();
        return new TypeCalcul($typeCalcul[TypeCalcul::CLE_ID], $typeCalcul[TypeCalcul::CLE_ETIQUETTE]);
    }

    public function recuperListeTypesDeCalcul(){
        $this->listeTypesCalcul = array();

        $typesCalcul = $this->connection->collection('type_calcul')->get();

        foreach ($typesCalcul as $typeCalcul){
            array_push($this->listeTypesCalcul, new TypeCalcul($typeCalcul[TypeCalcul::CLE_ID], $typeCalcul[TypeCalcul::CLE_ETIQUETTE]));
        }

        return $this->listeTypesCalcul;
    }
}
