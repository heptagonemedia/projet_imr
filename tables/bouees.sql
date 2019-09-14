-- Table: public.bouees

-- DROP TABLE public.bouees;

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