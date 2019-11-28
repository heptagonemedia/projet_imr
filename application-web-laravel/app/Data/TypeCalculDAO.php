<?php

namespace App\Data;

use App\Models\TypeCalcul;
use Illuminate\Support\Facades\DB;

class TypeCalculDAO implements TypeCalculSQL
{
    private $instance;

    private $listeTypesCalcul;

    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new ResultatDAO();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->listeTypesCalcul = array();
    }

    public function recupererTypeDeCalculParId($id){
        DB::select(TypeCalculSQL::RECUPERER_TYPES_CALCUL_PAR_ID_SQL, [$id]);
    }

    public function recuperListeTypesDeCalcul(){
        $this->listeTypesCalcul = array();

        $typesCalcul = DB::select(TypeCalculSQL::RECUPERER_TYPES_CALCUL_SQL);

        foreach ($typesCalcul as $typeCalcul){
            array_push($listeRegions, new TypeCalcul($typeCalcul[TypeCalcul::CLE_ID], $typesCalcul[TypeCalcul::CLE_ETIQUETTE]));
        }

        return $this->listeTypesCalcul;
    }
}
