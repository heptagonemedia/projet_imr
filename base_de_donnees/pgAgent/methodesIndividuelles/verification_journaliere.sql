--------------------------------------------------------------------------------
-- Fonction journalière de vérification des données.

CREATE OR REPLACE FUNCTION verification_journaliere(heure_lancement TIMESTAMP)

    RETURNS VOID
    LANGUAGE 'plpgsql'

AS $BODY$

DECLARE
    heure_a_verifier TIMESTAMP; -- heure qu'on check, de heure_lancement (now) à heure_lancement - 24h.
    -- intervale_temps pour pouvoir régler l'intervale à vérifer ? (changer 24h à 5minutes)
    no_bouee_a_verifier INT; -- va de 1 inclus à mas_bouee inclus.
    max_bouee INT; -- 75 000
    id_historique INT; -- id de l'élément qu'on cherche par no_bouee_a_verifier et heure_a_verifier

BEGIN
    heure_a_verifier := heure_lancement;
    max_bouee := 75000;

    FOR no_bouee_a_verifier IN 1..max_bouee LOOP
        WHILE heure_a_verifier < heure_lancement::timestamp + (INTERVAL '24 HOUR') LOOP --::timestamp
            id_historique := (
                SELECT id_historique_donnee_bouee
                FROM historique_donnee_bouee
                WHERE id_bouee = no_bouee_a_verifier
                AND date_saisie = heure_a_verifier
            );

            INSERT INTO donnee_traitee (id_historique_donnee_bouee, valide)
            VALUES (id_historique, verification_donnees_bouee(id_historique));
            -- LIGNE UTILE AU DÉBUG UNIQUEMENT. À COMMENTER.
            RAISE INFO 'La donnée liée à id_historique = % a valide = %', id_historique, verification_donnees_bouee(id_historique);

            heure_a_verifier := heure_a_verifier::timestamp + (INTERVAL '1 SECOND');
        END LOOP; -- fin du While (cadre temporel par bouée)
        heure_a_verifier := heure_lancement; -- On change de bouée, donc on reprend à 0s
    END LOOP; -- fin du For (cadre du nombre des bouées)

END;

$BODY$;