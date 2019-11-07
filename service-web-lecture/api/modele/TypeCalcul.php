<?php


class TypeCalcul
{
    const CLE_ID_TYPE_CALCUL = "id_type_calcul";
    const CLE_ETIQUETTE = "etiquette";

    private $idTypeCalcul;
    private $etiquette;

    /**
     * TypeCalcul constructor.
     * @param $idTypeCalcul
     * @param $etiquette
     */
    public function __construct($idTypeCalcul, $etiquette)
    {
        $this->idTypeCalcul = $idTypeCalcul;
        $this->etiquette = $etiquette;
    }

    /**
     * @return mixed
     */
    public function getIdTypeCalcul()
    {
        return $this->idTypeCalcul;
    }

    /**
     * @param mixed $idTypeCalcul
     */
    public function setIdTypeCalcul($idTypeCalcul)
    {
        $this->idTypeCalcul = $idTypeCalcul;
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