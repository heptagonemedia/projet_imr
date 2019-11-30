<?php

namespace App\Models;


use DemeterChain\C;
use Illuminate\Database\Eloquent\Model;

class Calcul extends Model
{

    const CLE_ID = "id";
    const CLE_ETIQUETTE = "etiquette";
    const CLE_DATE_GENERATION = "date_generation";
    const CLE_PROCHAINE_GENERATION = "date_prochaine_generation";
    const CLE_ENREGISTRE = "enregistre";
    const CLE_ID_REGION = "id_region";
    const CLE_ID_TYPE_CALCUL = "id_type_calcul";
    const CLE_DATE_DEBUT_PLAGE = "date_debut_plage";
    const CLE_DATE_FIN_PLAGE = "date_fin_plage";
    const CLE_FREQUENCE_VALEUR = "frequence_valeur";
    const CLE_XML_TEMPERATURE = "xml_graphique_temperature";
    const CLE_XML_SALINITE = "xml_graphique_salinite";
    const CLE_XML_DEBIT = "xml_graphique_debit";





    private $id;
    private $etiquette;
    private $dateGeneration;
    private $dateProchaineGeneration;
    private $enregistre;
    private $region;
    private $dateDebutPlage;
    private $dateFinPlage;
    private $frequenceValeur;
    private $typeCalcul;
    private $cheminFichierXmlTemperature;
    private $cheminFichierXmlSalinite;
    private $cheminFichierXmlDebit;

    public function __construct($id, $etiquette, $cheminFichierXmlTemperature, $cheminFichierXmlSalinite,$cheminFichierXmlDebit, $dateDebutPlage, $dateFinPlage, $dateGeneration, $dateProchaineGeneration, $enregistre, $region, $frequenceValeur, $typeCalcul)
    {
        $this->id = $id;
        $this->etiquette = $etiquette;
        $this->cheminFichierXmlTemperature = $cheminFichierXmlTemperature;
        $this->cheminFichierXmlSalinite = $cheminFichierXmlSalinite;
        $this->cheminFichierXmlDebit = $cheminFichierXmlDebit;
        $this->typeCalcul = $typeCalcul;
        $this->dateGeneration = $dateGeneration;
        $this->dateProchaineGeneration = $dateProchaineGeneration;
        $this->enregistre = $enregistre;
        $this->region = $region;
        $this->dateDebutPlage = $dateDebutPlage;
        $this->dateFinPlage = $dateFinPlage;
        $this->frequenceValeur = $frequenceValeur;
    }


    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setEtiquette($etiquette){
        $this->etiquette = $etiquette;
    }

    public function getEtiquette(){
        return $this->etiquette;
    }

    public function getDateGeneration()
    {
        return $this->dateGeneration;
    }

    public function setDateGeneration($dateGeneration): void
    {
        $this->dateGeneration = $dateGeneration;
    }

    public function getDateProchaineGeneration()
    {
        return $this->dateProchaineGeneration;
    }

    public function setDateProchaineGeneration($dateProchaineGeneration): void
    {
        $this->dateProchaineGeneration = $dateProchaineGeneration;
    }

    public function getEnregistre()
    {
        return $this->enregistre;
    }

    public function setEnregistre($enregistre): void
    {
        $this->enregistre = $enregistre;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function setRegion($region): void
    {
        $this->region = $region;
    }

    public function getDateDebutPlage()
    {
        return $this->dateDebutPlage;
    }

    public function setDateDebutPlage($dateDebutPlage): void
    {
        $this->dateDebutPlage = $dateDebutPlage;
    }

    public function getDateFinPlage()
    {
        return $this->dateFinPlage;
    }


    public function setDateFinPlage($dateFinPlage): void
    {
        $this->dateFinPlage = $dateFinPlage;
    }

    public function getFrequenceValeur()
    {
        return $this->frequenceValeur;
    }

    public function setFrequenceValeur($frequenceValeur): void
    {
        $this->frequenceValeur = $frequenceValeur;
    }

    public function getCheminFichierXmlSalinite()
    {
        return $this->cheminFichierXmlSalinite;
    }

    public function setCheminFichierXmlSalinite($cheminFichierXmlSalinite): void
    {
        $this->cheminFichierXmlSalinite = $cheminFichierXmlSalinite;
    }

    public function getCheminFichierXmlDebit()
    {
        return $this->cheminFichierXmlDebit;
    }

    public function setCheminFichierXmlDebit($cheminFichierXmlDebit): void
    {
        $this->cheminFichierXmlDebit = $cheminFichierXmlDebit;
    }



    public function getTypeCalcul(){
        return $this->typeCalcul;
    }

    public function setTypeCalcul($typeCalcul){
        $this->typeCalcul = $typeCalcul;
    }

    public function getCheminFichierXmlTemperature(){
        return $this->cheminFichierXmlTemperature;
    }


    public function setCheminFichierXmlTemperature($cheminFichierXmlTemperature){
        $this->cheminFichierXmlTemperature = $cheminFichierXmlTemperature;
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
