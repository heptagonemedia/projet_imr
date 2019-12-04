<?php

namespace App\Data;

use App\Models\Calcul;
use App\Models\Region;
use App\Models\TypeCalcul;
use Illuminate\Support\Facades\DB;

class CalculDAO implements CalculSQL
{
    private static $instance;
    private $connection;
    private $listeCalculs;

    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new CalculDAO();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->connection = DB::connection('mongodb');
        $this->listeCalculs = array();
    }

    public function recupererListeCalcul()
    {
        $calculs = $this->connection->collection('calcul')->get();
        $this->listeCalculs = array();

        foreach ($calculs as $item) {
            $id = $item[Calcul::CLE_ID];
            $etiquette = $item[Calcul::CLE_ETIQUETTE];
            $date_generation = $item[Calcul::CLE_DATE_GENERATION];
            $date_prochaine_generation = $item[Calcul::CLE_PROCHAINE_GENERATION];
            $enregistre = $item[Calcul::CLE_ENREGISTRE];
            $id_region = $item[Calcul::CLE_ID_REGION];
            $id_type_calcul = $item[Calcul::CLE_ID_TYPE_CALCUL];
            $date_debut_plage = $item[Calcul::CLE_DATE_DEBUT_PLAGE];
            $date_fin_plage = $item[Calcul::CLE_DATE_FIN_PLAGE];
            $frequence_valeur = $item[Calcul::CLE_FREQUENCE_VALEUR];
            $xml_graphique_temperature = $item[Calcul::CLE_XML_TEMPERATURE];
            $xml_graphique_salinite = $item[Calcul::CLE_XML_SALINITE];
            $xml_graphique_debit = $item[Calcul::CLE_XML_DEBIT];


            $regionDao = new RegionDAO();
            $region = $regionDao->recupererRegionParId($id_region);
            $typeCalculDao =  new TypeCalculDAO();
            $typeCalcul = $typeCalculDao->recupererTypeDeCalculParId($id_type_calcul);
            $calcul = new Calcul(
                $id,
                $etiquette,
                $xml_graphique_temperature,
                $xml_graphique_salinite,
                $xml_graphique_debit,
                $date_debut_plage,
                $date_fin_plage,
                $date_generation,
                $date_prochaine_generation,
                $enregistre,
                $region,
                $frequence_valeur,
                $typeCalcul
            );
            array_push($this->listeCalculs, $calcul);
        }
        return $this->listeCalculs;
    }

    public function recupererCalculParId($id){
        $calcul = $this->connection->collection('calcul')->where(Calcul::CLE_ID, 1)->first();
        $regionDAO = new RegionDAO();
        $region = $regionDAO->recupererRegionParId($calcul[Region::CLE_ID]);
        $typeCalculDAO = new TypeCalculDAO();
        $typeCalcul = $typeCalculDAO->recupererTypeDeCalculParId($calcul[TypeCalcul::CLE_ID]);
        return new Calcul($calcul[Calcul::CLE_ID],
            $calcul[Calcul::CLE_ETIQUETTE],
            $calcul[Calcul::CLE_XML_TEMPERATURE],
            $calcul[Calcul::CLE_XML_SALINITE],
            $calcul[Calcul::CLE_XML_DEBIT],
            $calcul[Calcul::CLE_DATE_DEBUT_PLAGE],
            $calcul[Calcul::CLE_DATE_FIN_PLAGE],
            $calcul[Calcul::CLE_DATE_GENERATION],
            $calcul[Calcul::CLE_DATE_PROCHAINE_GENERATION],
            $calcul[Calcul::CLE_ENREGISTRE],
            $region,
            $calcul[Calcul::CLE_FREQUENCE_VALEUR],
            $typeCalcul
        );
    }

    public function modifierCalcul($calcul){
        $this->connection->collection('calcul')->where(Calcul::CLE_ID, $calcul->id)->update(
            [
                Calcul::CLE_ID => $calcul->id,
                Calcul::CLE_ETIQUETTE => $calcul->etiquette,
                Calcul::CLE_DATE_GENERATION => $calcul->dateGeneration,
                Calcul::CLE_DATE_PROCHAINE_GENERATION => $calcul->dateProchaineGeneration,
                Calcul::CLE_ENREGISTRE => $calcul->enregistre,
                Calcul::CLE_ID_REGION => $calcul->region->id,
                Calcul::CLE_ID_TYPE_CALCUL => $calcul->typeCalcul->id,
                Calcul::CLE_DATE_DEBUT_PLAGE => $calcul->dateDebutPlage,
                Calcul::CLE_DATE_FIN_PLAGE => $calcul->dateFinPlage,
                Calcul::CLE_FREQUENCE_VALEUR => $calcul->frequenceValeur,
                Calcul::CLE_XML_TEMPERATURE => $calcul->cheminFichierXmlTemperature,
                Calcul::CLE_XML_SALINITE => $calcul->cheminFichierXmlSalilnite,
                Calcul::CLE_XML_DEBIT => $calcul->cheminFichierXmlDebit,
            ]

        );
    }

    public function ajouterCalcul($calcul){
        $this->connection->collection('region')->insert(
            [
                Calcul::CLE_ID => $calcul->id,
                Calcul::CLE_ETIQUETTE => $calcul->etiquette,
                Calcul::CLE_DATE_GENERATION => $calcul->dateGeneration,
                Calcul::CLE_DATE_PROCHAINE_GENERATION => $calcul->dateProchaineGeneration,
                Calcul::CLE_ENREGISTRE => $calcul->enregistre,
                Calcul::CLE_ID_REGION => $calcul->region->id,
                Calcul::CLE_ID_TYPE_CALCUL => $calcul->typeCalcul->id,
                Calcul::CLE_DATE_DEBUT_PLAGE => $calcul->dateDebutPlage,
                Calcul::CLE_DATE_FIN_PLAGE => $calcul->dateFinPlage,
                Calcul::CLE_FREQUENCE_VALEUR => $calcul->frequenceValeur,
                Calcul::CLE_XML_TEMPERATURE => $calcul->cheminFichierXmlTemperature,
                Calcul::CLE_XML_SALINITE => $calcul->cheminFichierXmlSalilnite,
                Calcul::CLE_XML_DEBIT => $calcul->cheminFichierXmlDebit,
                ]

        );
    }

}
