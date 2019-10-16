--------------------------------------------------------------------------------
-- Procédure engegistrée de traitement des calculs récurents

CREATE OR REPLACE FUNCTION calcul(id_calcul BIGINT)

    RETURNS VOID
    LANGUAGE 'plpgsql'

AS $BODY$

DECLARE
    fk_bouee BIGINT;
    date_debut_calcul TIMESTAMP;
    date_fin_calcul TIMESTAMP;
    frequence_calcul FLOAT; -- Que représente ce nombre ? Comment l'interpréter ?
    fk_type_donnee_mesuree INT;
    fk_type_calcul INT;
    calcul_prevu BOOLEAN;
    champ_type_calcul TEXT;

    valeurs_lues FLOAT[];
    valeur_lue FLOAT;

    moyenne FLOAT; -- résultat de la moyenne pour l'écart-type.
    resultat FLOAT; -- valeur à INSERT dans la BDD.
    nb_valeurs INT;  -- nb d'éléments du tableau, nécéssaire à tous les calculs.

    temporaire FLOAT; -- pour le tri du tableau pour trouver la médiane.

BEGIN
    fk_bouee := (
        SELECT id_bouee
        FROM calcul_enregistre
        WHERE id_calcul_enregistre = id_calcul
    );
    date_debut_calcul := (
        SELECT date_debut
        FROM calcul_enregistre
        WHERE id_calcul_enregistre = id_calcul
    );
    date_fin_calcul := (
        SELECT date_fin
        FROM calcul_enregistre
        WHERE id_calcul_enregistre = id_calcul
    );
    frequence_calcul := (
        SELECT frequence
        FROM calcul_enregistre
        WHERE id_calcul_enregistre = id_calcul
    );
    fk_type_donnee_mesuree := (
        SELECT id_type_donnee_mesuree
        FROM calcul_enregistre
        WHERE id_calcul_enregistre = id_calcul
    );
    fk_type_calcul := (
        SELECT id_type_calcul
        FROM calcul_enregistre
        WHERE id_calcul_enregistre = id_calcul
    );
    calcul_prevu := (
        SELECT prevu
        FROM calcul_enregistre
        WHERE id_type_calcul = fk_type_calcul
    );
    champ_type_calcul := (
        SELECT etiquette
        FROM type_calcul
        WHERE id_type_calcul = fk_type_calcul
    );
    valeurs_lues := (
        SELECT m.valeur
        FROM calcul_enregistre AS ce
        JOIN type_donnee_mesuree AS tdm
            ON ce.id_type_donnee_mesuree = tdm.id_type_donnee_mesuree
        JOIN mesure AS m
            ON tdm.id_type_donnee_mesuree = m.id_type_donnee_mesuree
        JOIN historique_donnee_bouee AS hdb
            ON m.id_historique_donnee_bouee = hdb.id_historique_donnee_bouee
        JOIN bouee AS b
            ON hdb.id_bouee = b.id_bouee
        JOIN donnee_traitee AS dt
            ON hdb.id_historique_donnee_bouee = dt.id_historique_donnee_bouee
        WHERE b.id_bouee = fk_bouee
        AND hdb.date_saisie < date_fin_calcul
        AND hdb.date_saisie > date_debut_calcul
        AND dt.valide = true
    );
    valeur_lue := 0; -- valeur lue dans le tableau par les FOREACH
    moyenne := 0; -- résultat de la moyenne pour le calcul de l'écart-type
    resultat := 0; -- valeur à INSERT dans l'élément calcul_enregistre
    nb_valeurs := 0; -- nb de valeurs définies dans le tableau récupéré
    temporaire := 0; -- valeur temporaire pour le calcul de la médiane.

    IF champ_type_calcul = 'moyenne' THEN
        FOREACH valeur_lue IN ARRAY valeurs_lues LOOP
            resultat := resultat + valeur_lue;
            nb_valeurs := nb_valeurs + 1;
        END LOOP;
        resultat := resultat / nb_valeurs;

    ELSEIF champ_type_calcul = 'ecart type' THEN
        FOREACH valeur_lue IN ARRAY valeurs_lues LOOP
            moyenne := moyenne + valeur_lue;
            nb_valeurs := nb_valeurs + 1;
        END LOOP;
        moyenne := moyenne / nb_valeurs;

        FOREACH valeur_lue IN ARRAY valeurs_lues LOOP
            resultat := resultat + POWER((valeur_lue)-moyenne, 2);
        END LOOP;
        resultat := SQRT((1/nb_valeurs) * resultat);

    ELSEIF champ_type_calcul = 'mediane' THEN
        -- calcul de la médiane

        -- on compte le nombre de valeurs de notre array.
        FOREACH valeur_lue IN ARRAY valeurs_lues LOOP
            nb_valeurs := nb_valeurs + 1;
        END LOOP;

        -- on trie notre array dans l'ordre croissant des valeurs.
        FOR i IN 0..nb_valeurs LOOP
            FOR j IN 1..nb_valeurs LOOP
                IF valeurs_lues[j-1] > valeurs_lues[j] THEN
                    temporaire := valeurs_lues[j-1];
                    valeurs_lues[j] = valeurs_lues[j-1];
                    valeurs_lues[j-1] = temporaire;
                END IF;
            END LOOP;
        END LOOP;

        IF nb_valeurs%2 <> 0 THEN -- si le nombre de valeurs est impair
            -- on prend la valeur au milieu du tableau (total_row/2 arrondi à l'entier supérieur)
            resultat := valeurs_lues[CEIL(nb_valeurs/2)];
        ELSE -- si le nombre de valeurs du tableau est pair
            resultat := (valeurs_lues[nb_valeurs/2]+valeurs_lues[(nb_valeurs/2)+1])/2
        END IF;
    END IF;

    -- insert du résultat obtenu à la suite du calcul dans la BDD.
    INSERT INTO calcul_enregistre (date_debut, date_fin, frequence, valeur, id_bouee, id_type_donnee_mesuree, id_type_calcul, prevu)
    VALUES (date_debut_calcul, date_fin_calcul, frequence_calcul, resultat, fk_bouee, fk_type_donnee_mesuree, fk_type_calcul, calcul_prevu);

END;

$BODY$;