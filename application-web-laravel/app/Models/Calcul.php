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
        $tableauTypeDonnee = TypeDonneeMesuree::mockDonneesMesurees();
        $tableauTypeCalcul = TypeCalcul::mockTypesCalcul();
        $tableauCalculs = array();
        array_push($tableauCalculs, new Calcul(0, $tableauTypeDonnee[0], "xml/fichier.xml", $tableauTypeCalcul[0]));
        array_push($tableauCalculs, new Calcul(0, $tableauTypeDonnee[1], "xml/fichier.xml", $tableauTypeCalcul[1]));
        array_push($tableauCalculs, new Calcul(0, $tableauTypeDonnee[2] , "xml/fichier.xml", $tableauTypeCalcul[2]));
        return $tableauCalculs;
    }


}
