<?php


class Region
{
    const CLE_ID_REGION = "id_region";
    const CLE_ETIQUETTE = "etiquette";

    private $idRegion;
    private $etiquette;

    /**
     * Region constructor.
     * @param $idRegion
     * @param $etiquette
     */
    public function __construct($idRegion, $etiquette)
    {
        $this->idRegion = $idRegion;
        $this->etiquette = $etiquette;
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