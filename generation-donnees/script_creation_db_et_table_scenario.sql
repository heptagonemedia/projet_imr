-- Database: generation_scenario

-- DROP DATABASE generation_scenario;

CREATE DATABASE generation_scenario
    WITH 
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'French_Canada.1252'
    LC_CTYPE = 'French_Canada.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;

GRANT ALL ON DATABASE generation_scenario TO generateur_scenario;

ALTER DEFAULT PRIVILEGES
GRANT ALL ON TABLES TO generateur_scenario;


-- Table: public.scenario

-- DROP TABLE public.scenario;

CREATE TABLE public.scenario
(
    id integer NOT NULL DEFAULT nextval('scenario_id_seq'::regclass),
    type integer,
    description text COLLATE pg_catalog."default",
    erreur_temperature numeric,
    erreur_debit numeric,
    erreur_salinite numeric,
    erreur_longitude real,
    erreur_latitude real,
    valeur_decrementation_batterie integer,
    valeur_depart_temperature numeric,
    valeur_depart_debit numeric,
    valeur_depart_salinite numeric,
    valeur_depart_longitude numeric,
    valeur_depart_latitude numeric,
    valeur_depart_batterie integer,
    prendre_compte boolean,
    CONSTRAINT scenario_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.scenario
    OWNER to postgres;

GRANT ALL ON TABLE public.scenario TO generateur_scenario;

GRANT ALL ON TABLE public.scenario TO postgres;