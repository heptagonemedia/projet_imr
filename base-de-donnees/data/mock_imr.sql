\COPY region (etiquette) FROM './mockdata/region.csv' DELIMITER ',' CSV;
\COPY bouee (etiquette, longitude_reference, latitude_reference, id_region) FROM './mockdata/bouee.csv' DELIMITER ',' CSV;
\COPY type_donnee_mesuree (etiquette, unite) FROM './mockdata/type_donnee_mesuree.csv' DELIMITER ',' CSV;
\COPY historique_donnee_bouee (id_bouee, longitude_reelle, latitude_reelle, date_saisie, batterie) FROM './mockdata/historique_donnee_bouee.csv' DELIMITER ',' CSV;
\COPY mesure (id_historique_donnee_bouee, id_type_donnee_mesuree, valeur) FROM './mockdata/mesure.csv' DELIMITER ',' CSV;
\COPY donnee_traitee (id_historique_donnee_bouee, valide) FROM './mockdata/donnee_traitee.csv' DELIMITER ',' CSV;
\COPY type_calcul (etiquette) FROM './mockdata/type_calcul.csv' DELIMITER ',' CSV;
\COPY calcul_enregistre (date_debut, date_fin, frequence, valeur, id_type_donnee_mesuree, id_type_calcul, prevu, chemin_fichier_xml, etiquette, enregistre) FROM './mockdata/calcul_enregistre.csv' DELIMITER ',' CSV;
