-- Database: generation_donnees
 -- DROP DATABASE generation_donnees;

CREATE DATABASE generation_donnees 
    WITH OWNER = postgres 
    ENCODING = 'UTF8' 
    LC_COLLATE = 'French_Canada.1252' 
    LC_CTYPE = 'French_Canada.1252' 
    TABLESPACE = pg_default 
    CONNECTION LIMIT = -1;

GRANT ALL ON DATABASE generation_donnees TO generateur_scenario;


ALTER DEFAULT PRIVILEGES GRANT ALL ON TABLES TO generateur_scenario;


-- Table: public.scenario
 -- DROP TABLE public.scenario;

CREATE TABLE public.scenario ( id integer NOT NULL DEFAULT nextval('scenario_id_seq'::regclass),
    type integer, description text COLLATE pg_catalog."default",
    erreur_temperature numeric, 
    erreur_debit numeric, 
    erreur_salinite numeric, 
    erreur_longitude real, 
    erreur_latitude real, 
    valeur_decrementation_batterie integer, 
    valeur_depart_temperature numeric, 
    valeur_depart_debit numeric, 
    valeur_depart_salinite numeric, 
    prendre_compte boolean, 
    CONSTRAINT scenario_pkey PRIMARY KEY (id)) WITH ( OIDS = FALSE) TABLESPACE pg_default;


ALTER TABLE public.scenario OWNER to postgres;

GRANT ALL ON TABLE public.scenario TO generateur_scenario;

GRANT ALL ON TABLE public.scenario TO postgres;

-- Table: public.bouee
 -- DROP TABLE public.bouee;

CREATE TABLE public.bouee ( id integer NOT NULL DEFAULT nextval('bouee_id_seq'::regclass),
    valeur_depart_longitude real, 
    valeur_depart_latitude real, 
    valeur_depart_batterie integer, 
    id_region integer, 
    etiquette text COLLATE pg_catalog."default";
                                                                                                                                                                                             CONSTRAINT bouee_pkey PRIMARY KEY (id)) WITH ( OIDS = FALSE) TABLESPACE pg_default;


ALTER TABLE public.bouee OWNER to postgres;

GRANT ALL ON TABLE public.bouee TO generateur_scenario;