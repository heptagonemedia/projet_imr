DROP TABLE IF EXISTS public.recherche_enregistrees;
DROP TABLE IF EXISTS public.donnee_valides;
DROP TABLE IF EXISTS public.donnee_invalides;
DROP TABLE IF EXISTS public.donnee_bouees;
DROP TABLE IF EXISTS public.bouees;
DROP FUNCTION IF EXISTS distance;
DROP FUNCTION IF EXISTS intervale_incertiture;

CREATE TABLE public.bouees (
    id            serial        PRIMARY KEY
    , numero      integer       NOT NULL
    , description text COLLATE pg_catalog."default" NOT NULL
    , date_debut  timestamp without time zone NOT NULL
    , longitude   numeric(10,8) NOT NULL
    , latitude    numeric(10,8) NOT NULL
    )
    WITH (
        OIDS = FALSE
    )
    TABLESPACE pg_default;

ALTER TABLE public.bouees
    OWNER to postgres;

CREATE TABLE public.donnee_bouees (
    id            bigserial     PRIMARY KEY
    , id_bouee    integer       NOT NULL
    , temperature numeric(4,2)  NOT NULL
    , salinite    numeric(4,2)  NOT NULL
    , debit       numeric(5,2)  NOT NULL
    , date_temps  timestamp without time zone NOT NULL
    , longitude   numeric(10,8) NOT NULL
    , latitude    numeric(10,8) NOT NULL
    , batterie    integer       NOT NULL
    , CONSTRAINT donnee_bouees_id_bouee_fkey FOREIGN KEY (id_bouee)
        REFERENCES public.bouees (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
    )
    WITH (
        OIDS = FALSE
    )
    TABLESPACE pg_default;

ALTER TABLE public.donnee_bouees
    OWNER to postgres;

CREATE TABLE public.donnee_invalides (
    id            bigserial     PRIMARY KEY
    , id_bouee    integer       NOT NULL
    , temperature numeric(4,2)  NOT NULL
    , salinite    numeric(4,2)  NOT NULL
    , debit       numeric(5,2)  NOT NULL
    , date_temps  timestamp without time zone NOT NULL
    , longitude   numeric(10,8) NOT NULL
    , latitude    numeric(10,8) NOT NULL
    , batterie    integer       NOT NULL
    , CONSTRAINT donnee_bouees_id_bouee_fkey FOREIGN KEY (id_bouee)
        REFERENCES public.bouees (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
    )
    WITH (
        OIDS = FALSE
    )
    TABLESPACE pg_default;

ALTER TABLE public.donnee_invalides
    OWNER to postgres;

CREATE TABLE public.donnee_valides (
    id            bigserial     PRIMARY KEY
    , id_bouee    integer       NOT NULL
    , temperature numeric(4,2)  NOT NULL
    , salinite    numeric(4,2)  NOT NULL
    , debit       numeric(5,2)  NOT NULL
    , date_temps  timestamp without time zone NOT NULL
    , longitude   numeric(10,8) NOT NULL
    , latitude    numeric(10,8) NOT NULL
    , batterie    integer       NOT NULL
    , CONSTRAINT donnee_bouees_id_bouee_fkey FOREIGN KEY (id_bouee)
        REFERENCES public.bouees (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
    )
    WITH (
        OIDS = FALSE
    )
    TABLESPACE pg_default;

ALTER TABLE public.donnee_valides
    OWNER to postgres;

CREATE TABLE IF NOT EXISTS public.recherche_enregistrees (
    id                  serial  NOT NULL
    , id_bouee          integer NOT NULL
    , frequence_annee   integer NOT NULL
    , frequence_mois    integer NOT NULL
    , frequence_jour    integer NOT NULL
    , frequence_heure   integer NOT NULL
    , frequence_minute  integer NOT NULL
    , frequence_seconde integer NOT NULL
    , CONSTRAINT recherche_enregistrees_pkey PRIMARY KEY (id)
    , CONSTRAINT recherche_enregistrees_id_bouee_fkey FOREIGN KEY (id_bouee)
        REFERENCES public.bouees (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE
    )
    WITH (
        OIDS = FALSE
    )
    TABLESPACE pg_default;

ALTER TABLE public.recherche_enregistrees
    OWNER to "userLambda";

--------------------------------------------------------------------------------

CREATE OR REPLACE FUNCTION distance(lat1 FLOAT, lon1 FLOAT, lat2 FLOAT, lon2 FLOAT)

    RETURNS FLOAT
AS $$

DECLARE
    x float = 111.12 * (lat2 - lat1);
    y float = 111.12 * (lon2 - lon1) * cos(lat1 / 92.215);
BEGIN
    RETURN sqrt(x * x + y * y);
END
$$ LANGUAGE plpgsql;
;


--------------------------------------------------------------------------------

CREATE OR REPLACE FUNCTION intervale_incertiture(val FLOAT, colonne TEXT, temps TIMESTAMP)

    RETURNS BOOLEAN
AS $$

DECLARE

valeurLue FLOAT;
moyenne FLOAT;
cycles INT;

-- SELECT donnee_bouees.colonne INTO john FROM donnee_bouees WHERE date_temps = temps;

BEGIN

    cycles := 25; -- On consulte ces dernières valeurs pour établir la moyenne de comparaison

    FOR i IN 1..cycles LOOP
            valeurLue := (SELECT colonne FROM donnee_bouees WHERE date_temps = temps - (i * INTERVAL '1 SECOND'));
            moyenne := moyenne + valeurLue;
    END LOOP;
    moyenne := moyenne/cycles;

    RETURN NOT (val*0.2 < moyenne OR val*1.8 > moyenne); -- Si la valeur est trop petite ou trop grande : FALSE.

END
$$ LANGUAGE plpgsql;
;

----------------------
-- données de test de la fonction

INSERT INTO bouees (numero, description, date_debut, longitude, latitude)
VALUES (1, 'bouée 1', '2019-09-13 21:00:00', 12, 12);

INSERT INTO donnee_bouees (id_bouee, temperature, salinite, debit, date_temps, longitude, latitude, batterie)
VALUES (1, 12.3, 12, 12, '2019-09-13 21:06:00', 12, 12, 12);

INSERT INTO donnee_bouees (id_bouee, temperature, salinite, debit, date_temps, longitude, latitude, batterie)
VALUES (1, 12.4, 12, 12, '2019-09-13 21:06:01', 12, 12, 12);

INSERT INTO donnee_bouees (id_bouee, temperature, salinite, debit, date_temps, longitude, latitude, batterie)
VALUES (1, 12.5, 12, 12, '2019-09-13 21:06:03', 12, 12, 12);

INSERT INTO donnee_bouees (id_bouee, temperature, salinite, debit, date_temps, longitude, latitude, batterie)
VALUES (1, 12.4, 12, 12, '2019-09-13 21:06:04', 12, 12, 12);

SELECT intervale_incertiture(12.4, 'temperature', '2019-09-13 21:06:04');



