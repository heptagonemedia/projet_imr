--------------------------------------------------------------------------------
-- Mise en place du modèle

-- DROP FUNCTION IF EXISTS nomDeLaFonction;

DROP TABLE IF EXISTS calcul_enregistre;
DROP TABLE IF EXISTS type_calcul;
DROP TABLE IF EXISTS mesure;
DROP TABLE IF EXISTS type_donnee_mesuree;
DROP TABLE IF EXISTS donnee_traitee;
DROP TABLE IF EXISTS historique_donnee_bouee;
DROP TABLE IF EXISTS bouee;
DROP TABLE IF EXISTS region;

CREATE TABLE region(
	id_region serial PRIMARY KEY,
	etiquette text
);

CREATE TABLE bouee(
	id_bouee serial PRIMARY KEY,
	etiquette text,
	longitude_reference float NOT NULL,
	latitude_reference float NOT NULL,
	id_region integer NOT NULL,
	CONSTRAINT region_bouee_fk
	  FOREIGN KEY (id_region)
	      REFERENCES region(id_region)
	      ON DELETE CASCADE
	      ON UPDATE CASCADE
);

CREATE TABLE historique_donnee_bouee(
	id_historique_donnee_bouee bigserial PRIMARY KEY,
	id_bouee integer NOT NULL,
	longitude_reelle float NOT NULL,
	latitude_reelle float NOT NULL,
	date_saisie timestamp without time zone NOT NULL,
	CONSTRAINT bouee_historique_donnee_bouee_fk
	    FOREIGN KEY (id_bouee)
	        REFERENCES bouee(id_bouee)
	        ON DELETE CASCADE
	        ON UPDATE CASCADE
);

CREATE TABLE donnee_traitee(
	id_donnee_traitee serial PRIMARY KEY,
	id_historique_donnee_bouee bigint NOT NULL,
	valide boolean NOT NULL,
	CONSTRAINT historique_donnee_bouee_donnee_traitee_fk
	   FOREIGN KEY (id_historique_donnee_bouee)
	       REFERENCES historique_donnee_bouee(id_historique_donnee_bouee)
	       ON DELETE CASCADE
	       ON UPDATE CASCADE
);

CREATE TABLE type_donnee_mesuree(
	id_type_donnee_mesuree serial PRIMARY KEY,
	etiquette text NOT NULL
);

CREATE TABLE mesure(
	id_mesure serial PRIMARY KEY,
	id_historique_donnee_bouee bigint NOT NULL,
	id_type_donnee_mesuree integer NOT NULL,
	valeur float NOT NULL,
	CONSTRAINT historique_donnee_bouee_mesure_fk
	   FOREIGN KEY (id_historique_donnee_bouee)
	       REFERENCES historique_donnee_bouee(id_historique_donnee_bouee)
	       ON DELETE CASCADE
	       ON UPDATE CASCADE,
	CONSTRAINT type_donnee_mesuree_mesure_fk
	   FOREIGN KEY (id_type_donnee_mesuree)
	       REFERENCES type_donnee_mesuree(id_type_donnee_mesuree)
	       ON DELETE CASCADE
	       ON UPDATE CASCADE
);

CREATE TABLE type_calcul(
	id_type_calcul serial PRIMARY KEY,
	etiquette text
);

CREATE TABLE calcul_enregistre(
	id_calcul_enregistre serial PRIMARY KEY,
	date_debut timestamp without time zone NOT NULL,
	date_fin timestamp without time zone NOT NULL,
	frequence float NOT NULL,
	valeur float NOT NULL,
	id_bouee integer NOT NULL,
	id_type_donnee_mesuree integer NOT NULL,
	id_type_calcul integer NOT NULL,
	prevu boolean NOT NULL,
	CONSTRAINT donnee_mesuree_calcul_enregistre_fk
	  FOREIGN KEY (id_type_donnee_mesuree)
	      REFERENCES type_donnee_mesuree(id_type_donnee_mesuree)
	      ON DELETE CASCADE
	      ON UPDATE CASCADE,
	CONSTRAINT type_calcul_enregistre_fk
	  FOREIGN KEY (id_type_calcul)
	      REFERENCES type_calcul(id_type_calcul)
	      ON DELETE CASCADE
	      ON UPDATE CASCADE,
	CONSTRAINT bouee_calcul_enregistrer_fk
	  FOREIGN KEY (id_bouee)
	      REFERENCES bouee(id_bouee)
	      ON DELETE CASCADE
	      ON UPDATE CASCADE
);


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

--------------------------------------------------------------------------------
-- jeu de données pour tester les requêtes de la fonction

INSERT INTO region (etiquette)
VALUES ('Region1');

INSERT INTO bouee (etiquette, longitude_reference, latitude_reference, id_region)
VALUES ('bouée 1', 12, 12, 1);

INSERT INTO type_donnee_mesuree (etiquette)
VALUES ('salinite'); -- type 1 = salinite

INSERT INTO type_donnee_mesuree (etiquette)
VALUES ('debit'); -- type 2 = debit

INSERT INTO type_donnee_mesuree (etiquette)
VALUES ('temperature'); -- type 3 = temperature

INSERT INTO historique_donnee_bouee (id_bouee, longitude_reelle, latitude_reelle, date_saisie)
VALUES (1, 12, 12, '2019-09-30 12:15:00'); -- historique 1

INSERT INTO mesure (id_historique_donnee_bouee, id_type_donnee_mesuree, valeur)
VALUES (1, 1, 24.990); -- historique 1 et type 1

INSERT INTO mesure (id_historique_donnee_bouee, id_type_donnee_mesuree, valeur)
VALUES (1, 2, 24.990); -- historique 1 et type 2

INSERT INTO mesure (id_historique_donnee_bouee, id_type_donnee_mesuree, valeur)
VALUES (1, 3, 24.990); -- historique 1 et type 3

INSERT INTO donnee_traitee (id_historique_donnee_bouee, valide)
VALUES (1, true);

INSERT INTO historique_donnee_bouee (id_bouee, longitude_reelle, latitude_reelle, date_saisie)
VALUES (1, 12, 12, '2019-09-30 12:25:00'); -- histo 2

INSERT INTO mesure (id_historique_donnee_bouee, id_type_donnee_mesuree, valeur)
VALUES (2, 1, 25.010); -- histo 2 type 1

INSERT INTO mesure (id_historique_donnee_bouee, id_type_donnee_mesuree, valeur)
VALUES (2, 2, 24.990); -- histo 2 et type 2

INSERT INTO mesure (id_historique_donnee_bouee, id_type_donnee_mesuree, valeur)
VALUES (2, 3, 24.990); -- histo 2 et type 3

INSERT INTO donnee_traitee (id_historique_donnee_bouee, valide)
VALUES (2, true);

INSERT INTO historique_donnee_bouee (id_bouee, longitude_reelle, latitude_reelle, date_saisie)
VALUES (1, 12, 12, '2019-09-30 12:35:00'); -- histo 3

INSERT INTO mesure (id_historique_donnee_bouee, id_type_donnee_mesuree, valeur)
VALUES (3, 1, 25.004); -- marge de 5%, donc 25.004 == true; 25.005 == false. -- histo 3 type 1

INSERT INTO mesure (id_historique_donnee_bouee, id_type_donnee_mesuree, valeur)
VALUES (3, 2, 24.990); -- histo 3 et type 2

INSERT INTO mesure (id_historique_donnee_bouee, id_type_donnee_mesuree, valeur)
VALUES (3, 3, 24.990); -- histo 3 et type 3

INSERT INTO donnee_traitee (id_historique_donnee_bouee, valide)
VALUES (3, true);

INSERT INTO type_calcul (etiquette)
VALUES ('moyenne');

INSERT INTO calcul_enregistre (date_debut, date_fin, frequence, valeur, id_bouee, id_type_donnee_mesuree, id_type_calcul, prevu)
VALUES ('2019-09-30 12:00:00', '2019-09-30 12:30:00', 1.0, 0.0, 1, 1, 1, true);


