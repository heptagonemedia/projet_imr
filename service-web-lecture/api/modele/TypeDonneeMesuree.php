<?php


class TypeDonneeMesuree
{
    const CLE_ID_TYPE_DONNEE_MESUREE = "id_type_donnee_mesuree";
    const CLE_ETIQUETTE = "etiquette";

    private $idTypeDonneeMesuree;
    private $etiquette;
    private $unite;

    /**
     * TypeDonneeMesuree constructor.
     * @param $idTypeDonneeMesuree
     * @param $etiquette
     * @param $unite
     */
    public function __construct($idTypeDonneeMesuree, $etiquette, $unite)
    {
        $this->idTypeDonneeMesuree = $idTypeDonneeMesuree;
        $this->etiquette = $etiquette;
        $this->unite = $unite;
    }

    /**
     * @return mixed
     */
    public function getIdTypeDonneeMesuree()
    {
        return $this->idTypeDonneeMesuree;
    }

    /**
     * @param mixed $idTypeDonneeMesuree
     */
    public function setIdTypeDonneeMesuree($idTypeDonneeMesuree)
    {
        $this->idTypeDonneeMesuree = $idTypeDonneeMesuree;
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
    public function getUnite()
    {
        return $this->unite;
    }

    /**
     * @param mixed $unite
     */
    public function setUnite($unite)
    {
        $this->unite = $unite;
    }
}