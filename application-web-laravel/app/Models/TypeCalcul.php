<?php

namespace App\Models;


class TypeCalcul
{
    const CLE_ID = "id";
    const CLE_ETIQUETTE = "etiquette";

    protected $id;
    protected $etiquette;

    public function __construct($id, $etiquette){
        $this->id = $id;
        $this->etiquette = $etiquette;
    }

    public static function mockTypesCalcul()
    {
        $tableauTypesDeCalculs = array();
        array_push($tableauTypesDeCalculs, new TypeCalcul(0, "moyenne"));
        array_push($tableauTypesDeCalculs, new TypeCalcul(1, "mediane"));
        array_push($tableauTypesDeCalculs, new TypeCalcul(2, "ecart-type"));
        return $tableauTypesDeCalculs;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setEtiquette($etiquette){
        $this->etiquette = $etiquette;
    }

    public function getEtiquette(){
        return $this->etiquette;
    }
}
