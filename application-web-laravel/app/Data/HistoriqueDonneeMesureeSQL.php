<?php

namespace App\Data;

interface HistoriqueDonneeMesureeSQL
{
    const RECUPERER_NOMBRE_CONFORMES = "select count(id_bouee) from historique_donnee_bouee where valide = TRUE ";
    const RECUPERER_NOMBRE_NON_CONFORMES = "select count(id_bouee) from historique_donnee_bouee where valide = FALSE ";
}
