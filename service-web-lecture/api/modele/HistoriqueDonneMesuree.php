<?php


class HistoriqueDonneMesuree
{
    const CLE_ID_HISTORIQUE_DONNEE_BOUEE = "id_historique_donnee_bouee";
    const CLE_ID_BOUEE = "id_bouee";
    const CLE_LONGITUDE_REELLE = "longitude_reelle";
    const CLE_LATITUDE_REELLE = "latitude_reelle";
    const CLE_DATE_SAISIE = "date_saisie";
    const CLE_BATTERIE = "batterie";

    private $idHistoriqueDonneeBouee;
    private $bouee;
    private $longitudeReelle;
    private $latitudeReelle;
    private $dateSaisie;
    private $batterie;

    /**
     * HistoriqueDonneMesuree constructor.
     * @param $idHistoriqueDonneeBouee
     * @param $bouee
     * @param $longitudeReelle
     * @param $latitudeReelle
     * @param $dateSaisie
     * @param $batterie
     */
    public function __construct($idHistoriqueDonneeBouee, $bouee, $longitudeReelle, $latitudeReelle, $dateSaisie, $batterie)
    {
        $this->idHistoriqueDonneeBouee = $idHistoriqueDonneeBouee;
        $this->bouee = $bouee;
        $this->longitudeReelle = $longitudeReelle;
        $this->latitudeReelle = $latitudeReelle;
        $this->dateSaisie = $dateSaisie;
        $this->batterie = $batterie;
    }

    /**
     * @return mixed
     */
    public function getIdHistoriqueDonneeBouee()
    {
        return $this->idHistoriqueDonneeBouee;
    }

    /**
     * @param mixed $idHistoriqueDonneeBouee
     */
    public function setIdHistoriqueDonneeBouee($idHistoriqueDonneeBouee)
    {
        $this->idHistoriqueDonneeBouee = $idHistoriqueDonneeBouee;
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
    public function getLongitudeReelle()
    {
        return $this->longitudeReelle;
    }

    /**
     * @param mixed $longitudeReelle
     */
    public function setLongitudeReelle($longitudeReelle)
    {
        $this->longitudeReelle = $longitudeReelle;
    }

    /**
     * @return mixed
     */
    public function getLatitudeReelle()
    {
        return $this->latitudeReelle;
    }

    /**
     * @param mixed $latitudeReelle
     */
    public function setLatitudeReelle($latitudeReelle)
    {
        $this->latitudeReelle = $latitudeReelle;
    }

    /**
     * @return mixed
     */
    public function getDateSaisie()
    {
        return $this->dateSaisie;
    }

    /**
     * @param mixed $dateSaisie
     */
    public function setDateSaisie($dateSaisie)
    {
        $this->dateSaisie = $dateSaisie;
    }

    /**
     * @return mixed
     */
    public function getBatterie()
    {
        return $this->batterie;
    }

    /**
     * @param mixed $batterie
     */
    public function setBatterie($batterie)
    {
        $this->batterie = $batterie;
    }
}