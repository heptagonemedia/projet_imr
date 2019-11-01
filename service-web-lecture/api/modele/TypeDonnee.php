<?php


class TypeDonnee
{
    const CLE_ID_TYPE_DONNEE = "id_type_donnee";
    const CLE_ETIQUETTE = "etiquette";
    const CLE_UNITE = "unite";

    private $idTypeDonnee;
    private $etiquette;
    private $unite;

    /**
     * TypeDonnee constructor.
     * @param $idTypeDonnee
     * @param $etiquette
     * @param $unite
     */
    public function __construct($idTypeDonnee, $etiquette, $unite)
    {
        $this->idTypeDonnee = $idTypeDonnee;
        $this->etiquette = $etiquette;
        $this->unite = $unite;
    }

    /**
     * @return mixed
     */
    public function getIdTypeDonnee()
    {
        return $this->idTypeDonnee;
    }

    /**
     * @param mixed $idTypeDonnee
     */
    public function setIdTypeDonnee($idTypeDonnee)
    {
        $this->idTypeDonnee = $idTypeDonnee;
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