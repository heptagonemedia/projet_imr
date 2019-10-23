<?php

namespace App\Models;

class TypeDonneeMesuree
{
    protected $id;
    protected $etiquette;

    public function __construct($id, $etiquette){
        $this->id = $id;
        $this->etiquette = $etiquette;
    }

    public static function mockDonneesMesurees()
    {
        $tableauTypeDonneeMesuree = array();
        array_push($tableauTypeDonneeMesuree, new TypeDonneeMesuree(0, "température"));
        array_push($tableauTypeDonneeMesuree, new TypeDonneeMesuree(1, "salinité"));
        array_push($tableauTypeDonneeMesuree, new TypeDonneeMesuree(2, "vitesse courant"));
        return $tableauTypeDonneeMesuree;
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
