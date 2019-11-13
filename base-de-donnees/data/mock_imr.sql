\COPY region (etiquette) FROM './mockdata/region.csv' DELIMITER ',' CSV;
\COPY bouee (etiquette, longitude_reference, latitude_reference, id_region) FROM './mockdata/bouee.csv' DELIMITER ',' CSV;
\COPY type_donnee (etiquette, unite) FROM './mockdata/type_donnee_mesuree.csv' DELIMITER ',' CSV;
\COPY historique_donnee_bouee (id_bouee, date_saisie) FROM './mockdata/historique_donnee_bouee.csv' DELIMITER ',' CSV;
\COPY mesure (id_historique_donnee_bouee, id_type_donnee, valeur) FROM './mockdata/mesure.csv' DELIMITER ',' CSV;
\COPY type_calcul (etiquette) FROM './mockdata/type_calcul.csv' DELIMITER ',' CSV;
\COPY calcul (etiquette, date_generation, date_prochaine_generation, date_debut_plage, date_fin_plage, frequence_valeur, enregistre, id_bouee, id_type_calcul) FROM './mockdata/calcul.csv' DELIMITER ',' CSV;
\COPY resultat (id_type_donnee, id_calcul, xml_graphique) FROM './mockdata/resultat.csv' DELIMITER ',' CSV;
