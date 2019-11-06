<?php


class Calcul
{
    const CLE_ID_CALCUL = "id_calcul";
    const CLE_ETIQUETTE = "etiquette";
    const CLE_DATE_GENERATION = "date_generation";
    const CLE_DATE_PROCHAINE_GENERATION = "date_prochaine_generation";
    const CLE_ENREGISTRE = "enregistre";
    const CLE_ID_BOUEE = "id_bouee";
    const CLE_ID_TYPE_CALCUL = "id_type_calcul";
    const CLE_DATE_DEBUT_PLAGE = "date_debut_plage";
    const CLE_DATE_FIN_PLAGE = "date_fin_plage";
    const CLE_FREQUENCE_VALEUR = "frequence_valeur";

    private $idCalcul;
    private $etiquette;
    private $dateGeneration;
    private $dateProchaineGeneration;
    private $enregistre;
    private $bouee;
    private $typeCalcul;
    private $dateDebutPlage;
    private $dateFinPlage;
    private $frequenceValeur;

    /**
     * Calcul constructor.
     * @param $idCalcul
     * @param $etiquette
     * @param $dateGeneration
     * @param $dateProchaineGeneration
     * @param $enregistre
     * @param $bouee
     * @param $typeCalcul
     * @param $dateDebutPlage
     * @param $dateFinPlage
     * @param $frequenceValeur
     */
    public function __construct($idCalcul, $etiquette, $dateGeneration, $dateProchaineGeneration, $enregistre, $bouee, $typeCalcul, $dateDebutPlage, $dateFinPlage, $frequenceValeur)
    {
        $this->idCalcul = $idCalcul;
        $this->etiquette = $etiquette;
        $this->dateGeneration = $dateGeneration;
        $this->dateProchaineGeneration = $dateProchaineGeneration;
        $this->enregistre = $enregistre;
        $this->bouee = $bouee;
        $this->typeCalcul = $typeCalcul;
        $this->dateDebutPlage = $dateDebutPlage;
        $this->dateFinPlage = $dateFinPlage;
        $this->frequenceValeur = $frequenceValeur;
    }

    /**
     * @return mixed
     */
    public function getIdCalcul()
    {
        return $this->idCalcul;
    }

    /**
     * @param mixed $idCalcul
     */
    public function setIdCalcul($idCalcul)
    {
        $this->idCalcul = $idCalcul;
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

    /**
     * @return mixed
     */
    public function getDateGeneration()
    {
        return $this->dateGeneration;
    }

    /**
     * @param mixed $dateGeneration
     */
    public function setDateGeneration($dateGeneration)
    {
        $this->dateGeneration = $dateGeneration;
    }

    /**
     * @return mixed
     */
    public function getDateProchaineGeneration()
    {
        return $this->dateProchaineGeneration;
    }

    /**
     * @param mixed $dateProchaineGeneration
     */
    public function setDateProchaineGeneration($dateProchaineGeneration)
    {
        $this->dateProchaineGeneration = $dateProchaineGeneration;
    }

    /**
     * @return mixed
     */
    public function getEnregistre()
    {
        return $this->enregistre;
    }

    /**
     * @param mixed $enregistre
     */
    public function setEnregistre($enregistre)
    {
        $this->enregistre = $enregistre;
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
    public function getDateDebutPlage()
    {
        return $this->dateDebutPlage;
    }

    /**
     * @param mixed $dateDebutPlage
     */
    public function setDateDebutPlage($dateDebutPlage)
    {
        $this->dateDebutPlage = $dateDebutPlage;
    }

    /**
     * @return mixed
     */
    public function getDateFinPlage()
    {
        return $this->dateFinPlage;
    }

    /**
     * @param mixed $dateFinPlage
     */
    public function setDateFinPlage($dateFinPlage)
    {
        $this->dateFinPlage = $dateFinPlage;
    }

    /**
     * @return mixed
     */
    public function getFrequenceValeur()
    {
        return $this->frequenceValeur;
    }

    /**
     * @param mixed $frequenceValeur
     */
    public function setFrequenceValeur($frequenceValeur)
    {
        $this->frequenceValeur = $frequenceValeur;
    }
}