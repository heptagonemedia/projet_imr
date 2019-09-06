-- Table: public.donnee_valides

-- DROP TABLE public.donnee_valides;

CREATE TABLE public.donnee_valides
(
    id serial PRIMARY KEY,
    id_bouee integer NOT NULL,
    temperature numeric(4,2) NOT NULL,
    salinite numeric(4,2) NOT NULL,
    debit numeric(5,2) NOT NULL,
    date_temps time without time zone NOT NULL,
    longitude numeric(10,8) NOT NULL,
    latitude numeric(10,8) NOT NULL,
    batterie integer NOT NULL,
    CONSTRAINT donnee_valides_pkey PRIMARY KEY (id),
    CONSTRAINT donnee_bouees_id_bouee_fkey FOREIGN KEY (id_bouee)
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