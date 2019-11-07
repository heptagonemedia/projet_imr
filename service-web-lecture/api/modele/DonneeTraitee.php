<?php


class DonneeTraitee extends HistoriqueDonneMesuree
{
    const CLE_ID_DONNEE_TRAITEE = "id_donnee_traitee";
    const CLE_ID_HISTORIQUE_DONNEE_BOUEE = "id_historique_donnee_bouee";
    const CLE_VALIDE = "valide";

    private $idDonneeTraitee;
    private $historiqueDonneeBouee;
    private $valide;

    /**
     * DonneeTraitee constructor.
     * @param $idDonneeTraitee
     * @param $historiqueDonneeBouee
     * @param $valide
     */
    public function __construct($idDonneeTraitee, $historiqueDonneeBouee, $valide)
    {
        $this->idDonneeTraitee = $idDonneeTraitee;
        $this->historiqueDonneeBouee = $historiqueDonneeBouee;
        $this->valide = $valide;
    }

    /**
     * @return mixed
     */
    public function getIdDonneeTraitee()
    {
        return $this->idDonneeTraitee;
    }

    /**
     * @param mixed $idDonneeTraitee
     */
    public function setIdDonneeTraitee($idDonneeTraitee)
    {
        $this->idDonneeTraitee = $idDonneeTraitee;
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

    /**
     * @return mixed
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * @param mixed $valide
     */
    public function setValide($valide)
    {
        $this->valide = $valide;
    }
}
