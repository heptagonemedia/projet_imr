<?php

namespace App\Data;

class BoueeDAO implements BoueeSQL
{
    private static $instance;

    private $connection;
    private $listeBouee;

    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new BoueeDAO();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->connection = BaseDeDonnees::getInstance()->getConnection();
        $this->listeBouee = array();
    }

    public function recupererListeCalcul()
    {
        $curseur = $this->connection->query(CalculSQL::SQL_LISTER_CALCUL);
        $this->listeBouee = array();

        foreach ($curseur as $item) {
            $idCalcul = $item[Calcul::CLE_ID_CALUL];
            $idTypeDonneeMesuree = $item[Calcul::CLE_ID_TYPE_DONNEE_MESUREE];
            $idUnite = $item[Calcul::CLE_ID_UNITE];
            $valeur = $item[Calcul::CLE_VALEUR];
            $etiquette = $item[Calcul::CLE_ETIQUETTE];
            $dateDebut = $item[Calcul::CLE_DATE_DEBUT];
            $dateFin = $item[Calcul::CLE_DATE_FIN];

            $typeDonneeMesuree = TypeDonneeMesureeDAO::getInstance()->trouverTypeDonneeMesureeParId($idTypeDonneeMesuree);
            $unite = UniteDAO::getInstance()->trouverUniteParId($idUnite);

            $calcul = new Calcul(
                $idCalcul,
                $typeDonneeMesuree,
                $unite,
                $valeur,
                $etiquette,
                $dateDebut,
                $dateFin
            );
            array_push($this->listeBouee, $calcul);
        }
        return $this->listeBouee;
    }

    public function recupererListeCalculParTypeDonneeEtPlage($typeDonnee, $plage)
    {
        $query = "";

        if ($typeDonnee == 'luminosite') {
            switch ($plage) {
                case 'jour':
                    $query = CalculSQL::SQL_LISTER_CALCUL_LUMINOSITE_JOUR;
                    break;
                case 'mois':
                    $query = CalculSQL::SQL_LISTER_CALCUL_LUMINOSITE_MOIS;
                    break;
                case 'annee':
                    $query = CalculSQL::SQL_LISTER_CALCUL_LUMINOSITE_ANNEE;
                    break;
            }
        }
        if ($typeDonnee == 'temperature') {
            switch ($plage) {
                case 'jour':
                    $query = CalculSQL::SQL_LISTER_CALCUL_TEMPERATURE_JOUR;
                    break;
                case 'mois':
                    $query = CalculSQL::SQL_LISTER_CALCUL_TEMPERATURE_MOIS;
                    break;
                case 'annee':
                    $query = CalculSQL::SQL_LISTER_CALCUL_TEMPERATURE_ANNEE;
                    break;
            }
        }

        $curseur = $this->connection->query($query);
        $this->listeBouee = array();

        foreach ($curseur as $item) {
            $idCalcul = $item[Calcul::CLE_ID_CALUL];
            $idTypeDonneeMesuree = $item[Calcul::CLE_ID_TYPE_DONNEE_MESUREE];
            $idUnite = $item[Calcul::CLE_ID_UNITE];
            $valeur = $item[Calcul::CLE_VALEUR];
            $etiquette = $item[Calcul::CLE_ETIQUETTE];
            $dateDebut = $item[Calcul::CLE_DATE_DEBUT];
            $dateFin = $item[Calcul::CLE_DATE_FIN];

            $typeDonneeMesuree = TypeDonneeMesureeDAO::getInstance()->trouverTypeDonneeMesureeParId($idTypeDonneeMesuree);
            $unite = UniteDAO::getInstance()->trouverUniteParId($idUnite);

            $calcul = new Calcul(
                $idCalcul,
                $typeDonneeMesuree,
                $unite,
                $valeur,
                $etiquette,
                $dateDebut,
                $dateFin
            );
            array_push($this->listeBouee, $calcul);
        }
        return $this->listeBouee;
    }

    public function exporter()
    {
        $xml = "";
        foreach ($this->listeBouee as $calcul) {
            $xml .= "<calcul>" . "\n" .
                "\t" . "<idCalcul>" . $calcul->getIdCalcul() . "</idCalcul>" . "\n" .
                "\t" . "<typeDonneeMesuree>" . $calcul->getTypeDonneeMesuree()->getEtiquette() . "</typeDonneeMesuree>" . "\n" .
                "\t" . "<unite>" . $calcul->getUnite()->getEtiquette() . "</unite>" . "\n" .
                "\t" . "<valeur>" . $calcul->getValeur() . "</valeur>" . "\n" .
                "\t" . "<etiquette>" . $calcul->getEtiquette() . "</etiquette>" . "\n" .
                "\t" . "<dateDebut>" . $calcul->getDateDebut() . "</dateDebut>" . "\n" .
                "\t" . "<dateFin>" . $calcul->getDateFin() . "</dateFin>" . "\n" .
                "</calcul>" . "\n";
        }
        return $xml;
    }
}
