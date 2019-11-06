<?php

namespace App\Models;


use DemeterChain\C;

class Calcul
{
    protected $id;
    protected $typeDonneeMesuree;
    protected $typeCalcul;
    protected $prevu; //TODO : mettre prevu dans le modele Resultat
    protected $cheminFichierXml;

    public function __construct($id, $typeDonneeMesuree, $cheminFichierXml, $typeCalcul)
    {
        $this->id = $id;
        $this->typeDonneeMesuree = $typeDonneeMesuree;
        $this->cheminFichierXml = $cheminFichierXml;
        $this->typeCalcul = $typeCalcul;
    }


    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getTypeDonneeMesuree(){
        return $this->typeDonneeMesuree;
    }

    public function setTypeDonneeMesuree($typeDonneeMesuree){
        $this->typeDonneeMesuree = $typeDonneeMesuree;
    }

    public function getTypeCalcul(){
        return $this->typeCalcul;
    }

    public function setTypeCalcul($typeCalcul){
        $this->typeCalcul = $typeCalcul;
    }

    public function getCheminFichierXml(){
        return $this->cheminFichierXml;
    }


    public function setCheminFichierXml($cheminFichierXml){
        $this->cheminFichierXml = $cheminFichierXml;
    }


    public static function mockCalculEnregistre(){
        $tableauCalculsEnregitres = array();
        array_push($tableauCalculsEnregitres, new Calcul(0, "temperature" , "xml/fichier.xml", "moyenne"));
        array_push($tableauCalculsEnregitres, new Calcul(0, "courant" , "xml/fichier.xml", "ecart-type"));
        array_push($tableauCalculsEnregitres, new Calcul(0, "salinite" , "xml/fichier.xml", "mediane"));
        return $tableauCalculsEnregitres;
    }


}
