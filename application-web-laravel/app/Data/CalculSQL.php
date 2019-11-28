<?php

namespace App\Data;

interface CalculSQL
{
    const RECUPERER_CALCULS_SQL="select * form calcul";
    const RECUPERER_CALCUL_PAR_ID = "select * form calcul where id + ?";
    const MODIFIER_CALCUL = "update calcul set etiquette = ?, date_generation = ?,date_prochaine_generation = ?,enregistre = ?,id_region = ?,id_type_calcul = ?,date_debut_plage = ?,date_fin_plage = ?,frequence_valeur = ?,xml_graphique_temperature = ?,xml_graphique_salinite = ?,xml_graphique_debit = ? , where id = ?";
    const AJOUTER_CALCUL = "insert into calcul  (id, etiquette, date_generation,date_prochaine_generation,enregistre,id_region,id_type_calcul ,date_debut_plage,date_fin_plage ,frequence_valeur,xml_graphique_temperature,xml_graphique_salinite ,xml_graphique_debit ) values( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
}
