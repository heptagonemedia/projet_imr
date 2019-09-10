-- Table: public.recherche_enregistrees

-- DROP TABLE public.recherche_enregistrees

CREATE TABLE IF NOT EXISTS public.recherche_enregistrees (
	id serial NOT NULL
	, id_bouee integer NOT NULL
	, frequence_annee integer NOT NULL
	, frequence_mois integer NOT NULL
	, frequence_jour integer NOT NULL
	, frequence_heure integer NOT NULL
	, frequence_minute integer NOT NULL
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