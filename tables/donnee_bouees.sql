-- Table: public.donnee_bouees

-- DROP TABLE public.donnee_bouees;

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