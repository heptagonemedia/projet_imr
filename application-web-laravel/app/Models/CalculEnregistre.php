<?php

namespace App\Models;


class CalculEnregistre
{
    protected $id;
    protected $dateDebut;
    protected $dateFin;
    protected $frequence;
    protected $valeur;
    protected $typeDonneeMesuree;
    protected $typeCalcul;
    protected $prevu;
    protected $cheminFichierXml;
    protected $etiquette;

    public function __construct($id, $dateDebut, $dateFin, $frequence, $valeur, $typeDonneeMesuree, $typeCalcul, $prevu, $cheminFichierXml, $etiquette)
    {
        $this->id = $id;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->frequence = $frequence;
        $this->valeur = $valeur;
        $this->typeDonneeMesuree = $typeDonneeMesuree;
        $this->typeCalcul = $typeCalcul;
        $this->prevu = $prevu;
        $this->cheminFichierXml = $cheminFichierXml;
        $this->etiquette = $etiquette;
    }


    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getDateDebut(){
        return $this->dateDebut;
    }

    public function setDateDebut($dateDebut){
        $this->dateDebut = $dateDebut;
    }

    public function getDateFin(){
        return $this->dateFin;
    }

    public function setDateFin($dateFin){
        $this->dateFin = $dateFin;
    }

    public function getFrequence(){
        return $this->frequence;
    }

    public function setFrequence($frequence){
        $this->frequence = $frequence;
    }

    public function getValeur(){
        return $this->valeur;
    }

    public function setValeur($valeur){
        $this->valeur = $valeur;
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

    public function getPrevu(){
        return $this->prevu;
    }

    public function setPrevu($prevu){
        $this->prevu = $prevu;
    }


    public function getCheminFichierXml(){
        return $this->cheminFichierXml;
    }


    public function setCheminFichierXml($cheminFichierXml){
        $this->cheminFichierXml = $cheminFichierXml;
    }

    public function getEtiquette(){
        return $this->etiquette;
    }

    public function setEtiquette($etiquette){
        $this->etiquette = $etiquette;
    }


}
