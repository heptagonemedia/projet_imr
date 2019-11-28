<?php

namespace App\Data;

use App\Models\Calcul;
use Illuminate\Support\Facades\DB;

class CalculDAO implements CalculSQL
{
    private static $instance;

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
        $this->listeCalculs = array();
    }

    public function recupererListeCalcul()
    {
        $calculs = DB::select(CalculSQL::RECUPERER_CALCULS_SQL);
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


            $region = RegionDAO::getInstance()->trouverRegionParId($id_region);
            $typeCalcul =  TypeCalculDAO::getInstance()->trouverTypeDeCalculParId($id_type_calcul);
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
        return DB::select(CalculSQL::RECUPERER_CALCUL_PAR_ID, [$id]);
    }

    public function modifierCalcul($calcul){
        DB::update(CalculSQL::MODIFIER_CALCUL, [
            $calcul->etiquette,
            $calcul->dateGeneration,
            $calcul->dateProchaineGeneration,
            $calcul->enregistre,
            $calcul->region->id,
            $calcul->typeCalcul->id,
            $calcul->dateDebutPlage,
            $calcul->dateFinPlage,
            $calcul->frequenceValeur,
            $calcul->cheminFichierXmlTemperature,
            $calcul->cheminFichierXmlSalinite,
            $calcul->cheminFichierXmlDebit,
            $calcul->id
        ]);
    }

    public function ajouterCalcul($calcul){
        DB::update(CalculSQL::AJOUTER_CALCUL, [
            $calcul->id,
            $calcul->etiquette,
            $calcul->dateGeneration,
            $calcul->dateProchaineGeneration,
            $calcul->enregistre,
            $calcul->region->id,
            $calcul->typeCalcul->id,
            $calcul->dateDebutPlage,
            $calcul->dateFinPlage,
            $calcul->frequenceValeur,
            $calcul->cheminFichierXmlTemperature,
            $calcul->cheminFichierXmlSalinite,
            $calcul->cheminFichierXmlDebit
        ]);
    }

}
