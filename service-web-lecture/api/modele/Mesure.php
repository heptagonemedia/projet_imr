<?php


class Mesure
{
    const CLE_ID_MESURE = "id_mesure";
    const CLE_VALEUR = "valeur";
    const CLE_ID_TYPE_DONNEE = "id_type_donnee";
    const CLE_ID_HISTORIQUE_DONNEE_BOUEE = "id_historique_donnee_bouee";

    private $idMesure;
    private $valeur;
    private $typeDonnee;
    private $historiqueDonneeBouee;

    /**
     * Mesure constructor.
     * @param $idMesure
     * @param $valeur
     * @param $typeDonnee
     * @param $historiqueDonneeBouee
     */
    public function __construct($idMesure, $valeur, $typeDonnee, $historiqueDonneeBouee)
    {
        $this->idMesure = $idMesure;
        $this->valeur = $valeur;
        $this->typeDonnee = $typeDonnee;
        $this->historiqueDonneeBouee = $historiqueDonneeBouee;
    }

    /**
     * @return mixed
     */
    public function getIdMesure()
    {
        return $this->idMesure;
    }

    /**
     * @param mixed $idMesure
     */
    public function setIdMesure($idMesure)
    {
        $this->idMesure = $idMesure;
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
    public function getTypeDonnee()
    {
        return $this->typeDonnee;
    }

    /**
     * @param mixed $typeDonnee
     */
    public function setTypeDonnee($typeDonnee)
    {
        $this->typeDonnee = $typeDonnee;
    }

    /**
     * @return mixed
     */
    public function getHistoriqueDonneeBouee()
    {
        return $this->historiqueDonneeBouee;
    }

    /**
     * @param mixed $historiqueDonneeBouee
     */
    public function setHistoriqueDonneeBouee($historiqueDonneeBouee)
    {
        $this->historiqueDonneeBouee = $historiqueDonneeBouee;
    }
}