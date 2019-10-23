<?php


class Bouee
{
    const CLE_ID_BOUEE = "id_bouee";
    const CLE_ETIQUETTE = "etiquette";
    const CLE_LONGITUDE_REFERENCE = "longiture_reference";
    const CLE_LATITUDE_REFERENCE = "latitude_reference";
    const CLE_ID_REGION = "id_region";

    private $idBouee;
    private $etiquette;
    private $longitudeReference;
    private $latitudeReference;
    private $idRegion;

    /**
     * Bouee constructor.
     * @param $idBouee
     * @param $etiquette
     * @param $longitudeReference
     * @param $latitudeReference
     * @param $idRegion
     */
    public function __construct($idBouee, $etiquette, $longitudeReference, $latitudeReference, $idRegion)
    {
        $this->idBouee = $idBouee;
        $this->etiquette = $etiquette;
        $this->longitudeReference = $longitudeReference;
        $this->latitudeReference = $latitudeReference;
        $this->idRegion = $idRegion;
    }

    /**
     * @return mixed
     */
    public function getIdBouee()
    {
        return $this->idBouee;
    }

    /**
     * @param mixed $idBouee
     */
    public function setIdBouee($idBouee)
    {
        $this->idBouee = $idBouee;
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
    public function getLongitudeReference()
    {
        return $this->longitudeReference;
    }

    /**
     * @param mixed $longitudeReference
     */
    public function setLongitudeReference($longitudeReference)
    {
        $this->longitudeReference = $longitudeReference;
    }

    /**
     * @return mixed
     */
    public function getLatitudeReference()
    {
        return $this->latitudeReference;
    }

    /**
     * @param mixed $latitudeReference
     */
    public function setLatitudeReference($latitudeReference)
    {
        $this->latitudeReference = $latitudeReference;
    }

    /**
     * @return mixed
     */
    public function getIdRegion()
    {
        return $this->idRegion;
    }

    /**
     * @param mixed $idRegion
     */
    public function setIdRegion($idRegion)
    {
        $this->idRegion = $idRegion;
    }
}