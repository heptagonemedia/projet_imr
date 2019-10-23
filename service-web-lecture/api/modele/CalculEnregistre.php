<?php


class CalculEnregistre
{
    const CLE_ID_CALCUL_ENREGISTRE = "id_calcul_enregistre";
    const CLE_ID_BOUEE = "id_bouee";
    const CLE_DATE_DEBUT = "date_debut";
    const CLE_DATE_FIN = "date_fin";
    const CLE_FREQUENCE = "frequence";
    const CLE_VALEUR = "id_calcul_enregistre";
    const CLE_ID_TYPE_DONNEE_MESUREE = "id_type_donnee_mesuree";
    const CLE_ID_TYPE_CALCUL = "id_type_calcul";
    const CLE_PREVU = "prevu";
    const CLE_CHEMIN_FICHIER_XML = "chemin_fichier_xml";
    const CLE_ETIQUETTE = "etiquette";

    private $idCalculEnregistre;
    private $bouee;
    private $dateDebut;
    private $dateFin;
    private $frequence;
    private $valeur;
    private $typeDonneeMesuree;
    private $typeCalcul;
    private $prevue;
    private $cheminFichierXml;
    private $etiquette;

    /**
     * CalculEnregistre constructor.
     * @param $idCalculEnregistre
     * @param $bouee
     * @param $dateDebut
     * @param $dateFin
     * @param $frequence
     * @param $valeur
     * @param $typeDonneeMesuree
     * @param $typeCalcul
     * @param $prevue
     * @param $cheminFichierXml
     * @param $etiquette
     */
    public function __construct($idCalculEnregistre, $bouee, $dateDebut, $dateFin, $frequence, $valeur, $typeDonneeMesuree, $typeCalcul, $prevue, $cheminFichierXml, $etiquette)
    {
        $this->idCalculEnregistre = $idCalculEnregistre;
        $this->bouee = $bouee;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->frequence = $frequence;
        $this->valeur = $valeur;
        $this->typeDonneeMesuree = $typeDonneeMesuree;
        $this->typeCalcul = $typeCalcul;
        $this->prevue = $prevue;
        $this->cheminFichierXml = $cheminFichierXml;
        $this->etiquette = $etiquette;
    }

    /**
     * @return mixed
     */
    public function getIdCalculEnregistre()
    {
        return $this->idCalculEnregistre;
    }

    /**
     * @param mixed $idCalculEnregistre
     */
    public function setIdCalculEnregistre($idCalculEnregistre)
    {
        $this->idCalculEnregistre = $idCalculEnregistre;
    }

    /**
     * @return mixed
     */
    public function getBouee()
    {
        return $this->bouee;
    }

    /**
     * @param mixed $bouee
     */
    public function setBouee($bouee)
    {
        $this->bouee = $bouee;
    }

    /**
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param mixed $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param mixed $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return mixed
     */
    public function getFrequence()
    {
        return $this->frequence;
    }

    /**
     * @param mixed $frequence
     */
    public function setFrequence($frequence)
    {
        $this->frequence = $frequence;
    }

    /**
     * @return mixed
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * @param mixed $valeur
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;
    }

    /**
     * @return mixed
     */
    public function getTypeDonneeMesuree()
    {
        return $this->typeDonneeMesuree;
    }

    /**
     * @param mixed $typeDonneeMesuree
     */
    public function setTypeDonneeMesuree($typeDonneeMesuree)
    {
        $this->typeDonneeMesuree = $typeDonneeMesuree;
    }

    /**
     * @return mixed
     */
    public function getTypeCalcul()
    {
        return $this->typeCalcul;
    }

    /**
     * @param mixed $typeCalcul
     */
    public function setTypeCalcul($typeCalcul)
    {
        $this->typeCalcul = $typeCalcul;
    }

    /**
     * @return mixed
     */
    public function getPrevue()
    {
        return $this->prevue;
    }

    /**
     * @param mixed $prevue
     */
    public function setPrevue($prevue)
    {
        $this->prevue = $prevue;
    }

    /**
     * @return mixed
     */
    public function getCheminFichierXml()
    {
        return $this->cheminFichierXml;
    }

    /**
     * @param mixed $cheminFichierXml
     */
    public function setCheminFichierXml($cheminFichierXml)
    {
        $this->cheminFichierXml = $cheminFichierXml;
    }

    /**
     * @return mixed
     */
    public function getEtiquette()
    {
        return $this->etiquette;
    }

    /**
     * @param mixed $etiquette
     */
    public function setEtiquette($etiquette)
    {
        $this->etiquette = $etiquette;
    }
}