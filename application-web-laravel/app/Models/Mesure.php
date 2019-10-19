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


}
