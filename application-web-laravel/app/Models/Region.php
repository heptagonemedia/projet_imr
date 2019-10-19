<?php

namespace App\Models;


class Region
{
    protected $id;
    protected $etiquette;

    public function __construct($id, $etiquette)
    {
        $this->$id = $id;
        $this->$etiquette = $etiquette;
    }

    public function __destruct()
    {
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setEtiquette($etiquette){
        $this->etiquette = $etiquette;
    }

    public function getId(){
        return $this->id;
    }

    public function getEtiquette(){
        return $this->etiquette;
    }
}
