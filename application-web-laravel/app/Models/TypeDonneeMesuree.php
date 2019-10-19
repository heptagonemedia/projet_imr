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
