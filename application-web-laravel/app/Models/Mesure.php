<?php

namespace App\Models;

class Mesure
{
    protected $id;
    protected $historiqueDonneeBouee;
    protected $typeDonneeMesuree;
    protected $valeur;

    public function __construct($id, $historiqueDonneeBouee, $typeDonneeMesuree, $valeur)
    {
        $this->id = $id;
        $this->historiqueDonneeBouee = $historiqueDonneeBouee;
        $this->typeDonneeMesuree = $typeDonneeMesuree;
        $this->valeur = $valeur;
    }

    public function setId($id){
        $this->id = $id;
    }

   public function setHistoriqueDonneeBouee($historiqueDonneeBouee){
        $this->historiqueDonneeBoue = $historiqueDonneeBouee;
   }

   public function setTypeDonneeMesuree($typeDonneeMesuree){
        $this->typeDonneeMesuree = $typeDonneeMesuree;
   }

   public function setValeur($valeur){
        $this->valeur = $valeur;
   }

    public function getId(){
        return $this->id;
    }

    public function getHistoriqueDonneeBouee(){
        return $this->historiqueDonneeBouee;
    }

    public function getTypeDonneeMesuree(){
        return $this->typeDonneeMesuree;
    }

    public function getValeur(){
        return $this->valeur;
    }
    public function mockMesure(){
        $tableauMesures = array();
        $tableauHistoriqueDonneesBouees = HistoriqueDonneeBouee::mockHistoriqueDonneesBouees();
        $tableauTypesDonneesMesurees = TypeDonneeMesuree::mockDonneesMesurees();
        array_push($tableauMesures, new Mesure(0, $tableauHistoriqueDonneesBouees[0], $tableauTypesDonneesMesurees[0], 8.5));
        array_push($tableauMesures, new Mesure(1, $tableauHistoriqueDonneesBouees[1], $tableauTypesDonneesMesurees[1], 12.7));
        array_push($tableauMesures, new Mesure(2, $tableauHistoriqueDonneesBouees[2], $tableauTypesDonneesMesurees[2], 45.5));
        return $tableauMesures;
    }


}
