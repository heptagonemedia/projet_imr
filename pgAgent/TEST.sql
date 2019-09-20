--------------------------------------------------------------------------------
-- -- PURGE TOTALE
-- DROP DATABASE projet_imr;
-- CREATE DATABASE projet_imr;
-- -- USE projet_imr;

--------------------------------------------------------------------------------
-- Suppression de tous vestige de l'ancien modèle

-- DROP TABLE IF EXISTS public.recherche_enregistrees;
-- DROP TABLE IF EXISTS public.donnee_valides;
-- DROP TABLE IF EXISTS public.donnee_invalides;
-- DROP TABLE IF EXISTS public.donnee_bouees;
-- DROP TABLE IF EXISTS public.bouees;
-- DROP FUNCTION IF EXISTS distance;
-- DROP FUNCTION IF EXISTS intervale_incertiture;

--------------------------------------------------------------------------------
-- Mise en place du nouveau modèle

DROP FUNCTION IF EXISTS nouveau_intervale_incertitude;

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
-- Nouvelle version de la fonction de vérification des données.

CREATE OR REPLACE FUNCTION nouveau_intervale_incertitude(id_historique INT, type_donnee TEXT)

    RETURNS BOOLEAN
    LANGUAGE 'plpgsql'

AS $BODY$

DECLARE
    id_bouee_a_check INT;
    valeur_mesure NUMERIC(5,2); -- valeur à vérifier
    temps_present TIMESTAMP; -- valeur de x dans l'équation.
    -- On ne peut pas prendre l'id → 75 000 entrées par secondes.
    -- dans l'équation, y(x) désigne "SELECT mesure.qqch WHERE temps = x";

    profondeur_verification INT; -- valeur de n dans l'équation
    moyenne NUMERIC(5,2);
    ecart_type NUMERIC(5,2);
    constante_confiance INT; -- valeur de k dans l'intervalle de confiance

    -- soit l'équation :
    -- moyenne = ( SIGMA de i = 1 à n, de y(x-i) ) le tout divisé par n-1
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

    profondeur_verification := 2; -- On consulte ces valeurs pour établir la moyenne de l'intervale d'incertitude.
    -- Attention ! En début d'insertion des données, si la profondeur 'sort' des données précédentes → la moyenne vaut NULL
    constante_confiance := 2; -- k = 1 : confiance à 68% ; 2 : 95% ; 3 : 99,7%.

    -- Calcul de la moyenne
    FOR i IN 1..profondeur_verification LOOP
        moyenne := moyenne + (
            SELECT m.valeur
            FROM historique_donnee_bouee AS hdb
            JOIN mesure m ON hdb.id_historique_donnee_bouee = m.id_historique_donnee_bouee
            JOIN type_donnee_mesuree tdm ON m.id_type_donnee_mesuree = tdm.id_type_donnee_mesuree
            WHERE hdb.id_bouee = id_bouee_a_check
            AND hdb.date_saisie = temps_present::timestamp - (i * INTERVAL '1 SECOND')
            AND tdm.etiquette = type_donnee
        ); -- val actu - x

        RAISE INFO 'itération %, moyenne=%.', i, moyenne;

    END LOOP;

    RAISE INFO 'fin de boucle, moyenne=%.', moyenne;

    --PROBLÈME : ICI LA MOYENNE EST A NULL SI ON SORT DU JEU DE DONNÉES.

    moyenne := moyenne/(profondeur_verification); -- pas n-1 !

    RAISE INFO 'réctification, moyenne=%.', moyenne;

    -- Calcul de l'écart type
    FOR i IN 1..profondeur_verification LOOP
        ecart_type := ecart_type + POWER((
            SELECT m.valeur
            FROM historique_donnee_bouee AS hdb
            JOIN mesure m ON hdb.id_historique_donnee_bouee = m.id_historique_donnee_bouee
            JOIN type_donnee_mesuree tdm ON m.id_type_donnee_mesuree = tdm.id_type_donnee_mesuree
            WHERE hdb.id_bouee = id_bouee_a_check
            AND hdb.date_saisie = temps_present::timestamp - (i * INTERVAL '1 SECOND')
            AND tdm.etiquette = type_donnee
        )-moyenne, 2);

        -- REMPLACER LE SELECT PAR UN ARRAY (on utilise le même SELECT pour la moyenne et l'écart-type)

        RAISE INFO 'itération %, écart-type=%.', i, ecart_type;

    END LOOP;

    RAISE INFO 'fin de boucle, écart-type=%.', ecart_type;

    ecart_type := SQRT((1/profondeur_verification) * ecart_type);

    RAISE INFO 'réctification, écart-type=%.', ecart_type;

    -- Calcul de l'intervale de confiance.

	-- PLPGSQL ne gère pas un return direct, je suis obligé de passer par des IF ELSE
    IF ((moyenne - constante_confiance * (ecart_type / SQRT(profondeur_verification)) <= valeur_mesure) AND (valeur_mesure <= moyenne + constante_confiance * (ecart_type / SQRT(profondeur_verification)))) THEN
    	resultat := TRUE;
    ELSE
    	resultat := FALSE;
    END IF;

    RETURN resultat;

END;

$BODY$;

--------------------------------------------------------------------------------
-- données de test de la fonction

INSERT INTO region (etiquette)
VALUES ('Region1');

INSERT INTO bouee (etiquette, longitude_reference, latitude_reference, id_region)
VALUES ('bouée 1', 12, 12, 1);

INSERT INTO type_donnee_mesuree (etiquette)
VALUES ('salinite'); -- type 1 = salinite

INSERT INTO historique_donnee_bouee (id_bouee, longitude_reelle, latitude_reelle, date_saisie)
VALUES (1, 12, 12, '2019-09-19 15:00:00'); -- historique 1

INSERT INTO mesure (id_historique_donnee_bouee, id_type_donnee_mesuree, valeur)
VALUES (1, 1, 25); -- historique 1 et type 1

INSERT INTO historique_donnee_bouee (id_bouee, longitude_reelle, latitude_reelle, date_saisie)
VALUES (1, 12, 12, '2019-09-19 15:00:01'); -- histo 2

INSERT INTO mesure (id_historique_donnee_bouee, id_type_donnee_mesuree, valeur)
VALUES (2, 1, 25);

INSERT INTO historique_donnee_bouee (id_bouee, longitude_reelle, latitude_reelle, date_saisie)
VALUES (1, 12, 12, '2019-09-19 15:00:02'); -- histo 3

INSERT INTO mesure (id_historique_donnee_bouee, id_type_donnee_mesuree, valeur)
VALUES (3, 1, 25);

SELECT nouveau_intervale_incertitude(3, 'salinite');



