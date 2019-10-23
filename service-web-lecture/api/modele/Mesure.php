<?php


class Mesure
{
    const CLE_ID_MESURE = "id_mesure";
    const CLE_ID_HISTORIQUE_DONNEE_MESUREE = "id_historique_donnee_bouee";
    const CLE_ID_TYPE_DONNEE_MESUREE = "id_type_donnee_mesuree";
    const CLE_VALEUR = "valeur";

    private $idMesure;
    private $historiqueDonneeMesuree;
    private $typeDonneeMesuree;
    private $valeur;

    /**
     * Mesure constructor.
     * @param $idMesure
     * @param $historiqueDonneeMesuree
     * @param $typeDonneeMesuree
     * @param $valeur
     */
    public function __construct($idMesure, $historiqueDonneeMesuree, $typeDonneeMesuree, $valeur)
    {
        $this->idMesure = $idMesure;
        $this->historiqueDonneeMesuree = $historiqueDonneeMesuree;
        $this->typeDonneeMesuree = $typeDonneeMesuree;
        $this->valeur = $valeur;
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
    public function getHistoriqueDonneeMesuree()
    {
        return $this->historiqueDonneeMesuree;
    }

    /**
     * @param mixed $historiqueDonneeMesuree
     */
    public function setHistoriqueDonneeMesuree($historiqueDonneeMesuree)
    {
        $this->historiqueDonneeMesuree = $historiqueDonneeMesuree;
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
}