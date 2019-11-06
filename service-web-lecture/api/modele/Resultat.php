<?php


class Resultat
{
    const CLE_ID_RESULTAT = "id_resultat";
    const CLE_ID_TYPE_DONNEE = "id_type_donnee";
    const CLE_ID_CALCUL = "id_calcul";
    const CLE_CHEMIN_FICHIER_XML = "chemin_fichier_xml";

    private $idResultat;
    private $typeDonnee;
    private $calcul;
    private $cheminFichierXml;

    /**
     * Resultat constructor.
     * @param $idResultat
     * @param $typeDonnee
     * @param $calcul
     * @param $cheminFichierXml
     */
    public function __construct($idResultat, $typeDonnee, $calcul, $cheminFichierXml)
    {
        $this->idResultat = $idResultat;
        $this->typeDonnee = $typeDonnee;
        $this->calcul = $calcul;
        $this->cheminFichierXml = $cheminFichierXml;
    }

    /**
     * @return mixed
     */
    public function getIdResultat()
    {
        return $this->idResultat;
    }

    /**
     * @param mixed $idResultat
     */
    public function setIdResultat($idResultat)
    {
        $this->idResultat = $idResultat;
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
    public function getCalcul()
    {
        return $this->calcul;
    }

    /**
     * @param mixed $calcul
     */
    public function setCalcul($calcul)
    {
        $this->calcul = $calcul;
    }

    /**
     * @return mixed
     */
    public function getCheminFichierXml()
    {
        return $this->cheminFichierXml;
    }

    /**
     * @param mixed $cheminFichierXml
     */
    public function setCheminFichierXml($cheminFichierXml)
    {
        $this->cheminFichierXml = $cheminFichierXml;
    }
}