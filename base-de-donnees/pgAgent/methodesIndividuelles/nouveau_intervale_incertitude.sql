--------------------------------------------------------------------------------
-- Nouvelle version de la fonction de vérification de la fiabilité d'une donnée.

CREATE OR REPLACE FUNCTION nouveau_intervale_incertitude(id_historique INT, type_donnee TEXT)

    RETURNS BOOLEAN
    LANGUAGE 'plpgsql'

AS $BODY$

DECLARE
    id_bouee_a_check INT;
    valeur_mesure NUMERIC(5,2); -- valeur à vérifier
    temps_present TIMESTAMP; -- valeur de x dans l'équation.
    -- On ne peut pas prendre l'id → 75 000 entrées par secondes.
    -- dans l'équation, y(x) désigne "SELECT mesure.qqch WHERE temps = x"; x-i désigne "x - i secondes"

    profondeur_verification INT; -- valeur de n dans l'équation
    moyenne NUMERIC(5,2);
    ecart_type NUMERIC(5,2);
    constante_confiance INT; -- valeur de k dans l'intervalle de confiance

    copie_valeurs NUMERIC(5,2)[]; -- tableau de données pour ne faire qu'un SELECT sur la bdd.

    -- soit l'équation :
    -- moyenne = ( SIGMA de i = 1 à n, de y(x-i) ) le tout divisé par n
    -- ecart_type = racine carrée de 1/n multiplié par SIGMA de i = 1 à n, de y(x-i)^2 - moyenne^2
    -- confiance : [moyenne - k*ecart_type/racine carrée de n ; moyenne + k*ecart_type/racine carrée de n ]

    resultat BOOLEAN;

BEGIN

    --DÉBUG
    moyenne := 0.0;
    ecart_type := 0.0;

    valeur_mesure := (
        SELECT m.valeur
        FROM historique_donnee_bouee AS hdb
        JOIN mesure AS m ON m.id_historique_donnee_bouee = hdb.id_historique_donnee_bouee
        JOIN type_donnee_mesuree tdm ON m.id_type_donnee_mesuree = tdm.id_type_donnee_mesuree
        WHERE hdb.id_historique_donnee_bouee = id_historique
        AND tdm.etiquette = type_donnee
    ); -- valeur à tester

    id_bouee_a_check := (
        SELECT hdb.id_bouee
        FROM historique_donnee_bouee AS hdb
        WHERE hdb.id_historique_donnee_bouee = id_historique
    ); -- id de la bouée à check
    temps_present := (
        SELECT hdb.date_saisie
        FROM historique_donnee_bouee AS hdb
        WHERE hdb.id_historique_donnee_bouee = id_historique
    ); -- temps à x

    -- En début d'insertion des données, si la profondeur 'sort' des données précédentes → la moyenne vaut NULL
    profondeur_verification := 2; -- On consulte ces valeurs pour établir la moyenne de l'intervale d'incertitude.
    constante_confiance := 2; -- k = 1 : confiance à 68% ; 2 : 95% ; 3 : 99,7%.

    -- Calcul de la moyenne
    FOR i IN 1..profondeur_verification LOOP
        copie_valeurs[i] := (
            SELECT m.valeur
            FROM historique_donnee_bouee AS hdb
            JOIN mesure m ON hdb.id_historique_donnee_bouee = m.id_historique_donnee_bouee
            JOIN type_donnee_mesuree tdm ON m.id_type_donnee_mesuree = tdm.id_type_donnee_mesuree
            WHERE hdb.id_bouee = id_bouee_a_check
            AND hdb.date_saisie = temps_present::timestamp - (i * INTERVAL '1 SECOND')
            AND tdm.etiquette = type_donnee
        ); -- val actu - x
        moyenne := moyenne + copie_valeurs[i];

    END LOOP;

    moyenne := moyenne/(profondeur_verification);

    -- PROBLÈME : ICI LA MOYENNE EST À NULL SI ON SORT DU JEU DE DONNÉES.
    -- On peut le tourner à notre avantage dans verification_donnees_bouee() → LAISSER TEL QUEL.

    -- Calcul de l'écart type
    FOR i IN 1..profondeur_verification LOOP

        ecart_type := ecart_type + POWER((copie_valeurs[i])-moyenne, 2);
        -- L'array évite un deuxième SELECT identique au premier : gain de performances.

    END LOOP;

    ecart_type := SQRT((1/profondeur_verification) * ecart_type);

    -- Calcul de l'intervale de confiance.
	-- PLPGSQL ne gère pas un return direct, je suis obligé de passer par des IF ELSE
    IF ((moyenne - constante_confiance * (ecart_type / SQRT(profondeur_verification)) <= valeur_mesure) AND (valeur_mesure <= moyenne + constante_confiance * (ecart_type / SQRT(profondeur_verification)))) THEN
    	resultat := TRUE;
    ELSE
    	resultat := FALSE;
    END IF;

    -- LIGNE UTILE AU DÉBUG UNIQUEMENT. À COMMENTER.
    RAISE INFO 'Le test donnée_historique % type % renvoie %', id_historique, type_donnee, resultat;
    RETURN resultat;

END;

$BODY$;